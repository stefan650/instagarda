/**
 * Instagarda AI — Backend Server
 * Zero dipendenze: usa solo moduli Node.js built-in
 *
 * Avvio: node server.js
 * Richiede: ANTHROPIC_API_KEY nel file .env
 */

const http  = require('http');
const https = require('https');
const fs    = require('fs');
const path  = require('path');
const url   = require('url');

// ─── Carica variabili da .env ──────────────────────────────────────────────
function loadEnv() {
  try {
    const envPath = path.join(__dirname, '.env');
    const lines = fs.readFileSync(envPath, 'utf8').split('\n');
    lines.forEach(line => {
      const trimmed = line.trim();
      if (!trimmed || trimmed.startsWith('#')) return;
      const eqIdx = trimmed.indexOf('=');
      if (eqIdx === -1) return;
      const key = trimmed.slice(0, eqIdx).trim();
      const val = trimmed.slice(eqIdx + 1).trim().replace(/^["']|["']$/g, '');
      if (key) process.env[key] = val;
    });
  } catch (e) {
    // nessun .env trovato — usa variabili di ambiente esistenti
  }
}

loadEnv();

const ANTHROPIC_API_KEY = process.env.ANTHROPIC_API_KEY;
const PORT              = process.env.PORT || 3000;
const MODEL             = 'claude-haiku-4-5-20251001'; // veloce ed economico

// ─── Carica il system prompt ───────────────────────────────────────────────
let SYSTEM_PROMPT;
try {
  SYSTEM_PROMPT = fs.readFileSync(path.join(__dirname, 'system_prompt.txt'), 'utf8');
  console.log('✅ System prompt caricato.');
} catch (e) {
  SYSTEM_PROMPT = 'Sei Garda AI, l\'assistente del Lago di Garda. Rispondi nella lingua dell\'utente.';
  console.warn('⚠️  system_prompt.txt non trovato — uso il prompt di fallback.');
}

// ─── RAG: carica il motore di ricerca ────────────────────────────────────
const RAGSearch = require('./rag/search');
const rag = new RAGSearch();

// ─── Costruisci system prompt con contesto RAG ───────────────────────────
function buildSystemPrompt(userMessage) {
  const results = rag.search(userMessage, 3);
  if (results.length === 0) return SYSTEM_PROMPT;

  const context = results.map(r =>
    `[Fonte: ${r.title} | ${r.url}]\n${r.content}`
  ).join('\n\n---\n\n');

  return SYSTEM_PROMPT +
    '\n\n## CONTESTO DAL SITO WEB\n' +
    'Usa queste informazioni per dare risposte accurate. Cita le fonti con il link quando possibile.\n\n' +
    context;
}

// ─── Chiama l'API Anthropic ────────────────────────────────────────────────
function callClaude(messages) {
  return new Promise((resolve, reject) => {
    if (!ANTHROPIC_API_KEY) {
      return reject(new Error('ANTHROPIC_API_KEY mancante. Crea il file .env con la tua chiave.'));
    }

    // Estrai l'ultimo messaggio utente per la ricerca RAG
    const lastUserMsg = [...messages].reverse().find(m => m.role === 'user');
    const systemPrompt = lastUserMsg
      ? buildSystemPrompt(lastUserMsg.content)
      : SYSTEM_PROMPT;

    const body = JSON.stringify({
      model:      MODEL,
      max_tokens: 1024,
      system:     systemPrompt,
      messages:   messages
    });

    const options = {
      hostname: 'api.anthropic.com',
      port:     443,
      path:     '/v1/messages',
      method:   'POST',
      headers:  {
        'Content-Type':      'application/json',
        'x-api-key':         ANTHROPIC_API_KEY,
        'anthropic-version': '2023-06-01',
        'Content-Length':    Buffer.byteLength(body)
      }
    };

    const req = https.request(options, res => {
      let data = '';
      res.on('data',  chunk => data += chunk);
      res.on('end',   ()    => {
        try {
          const parsed = JSON.parse(data);
          if (parsed.error) return reject(new Error(parsed.error.message));
          resolve(parsed.content[0].text);
        } catch (e) {
          reject(new Error('Risposta API non valida: ' + data.slice(0, 200)));
        }
      });
    });

    req.on('error', reject);
    req.write(body);
    req.end();
  });
}

// ─── Leggi il body della request ──────────────────────────────────────────
function parseBody(req) {
  return new Promise((resolve, reject) => {
    let body = '';
    req.on('data',  chunk => body += chunk.toString());
    req.on('end',   ()    => {
      try   { resolve(JSON.parse(body)); }
      catch (e) { reject(new Error('JSON non valido')); }
    });
    req.on('error', reject);
  });
}

// ─── MIME types per file statici ──────────────────────────────────────────
const MIME = {
  '.html': 'text/html; charset=utf-8',
  '.js':   'application/javascript',
  '.css':  'text/css',
  '.json': 'application/json',
  '.png':  'image/png',
  '.jpg':  'image/jpeg',
  '.svg':  'image/svg+xml',
  '.ico':  'image/x-icon',
};

// ─── Server HTTP ──────────────────────────────────────────────────────────
const server = http.createServer(async (req, res) => {
  const parsed = url.parse(req.url);

  // CORS — necessario per widget embeddato su altri domini
  res.setHeader('Access-Control-Allow-Origin',  '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

  if (req.method === 'OPTIONS') {
    res.writeHead(204);
    res.end();
    return;
  }

  // ── POST /api/chat ── l'endpoint che usa il widget ──────────────────────
  if (req.method === 'POST' && parsed.pathname === '/api/chat') {
    try {
      const { messages } = await parseBody(req);

      if (!Array.isArray(messages) || messages.length === 0) {
        res.writeHead(400, { 'Content-Type': 'application/json' });
        return res.end(JSON.stringify({ error: '"messages" deve essere un array non vuoto' }));
      }

      const reply = await callClaude(messages);
      res.writeHead(200, { 'Content-Type': 'application/json' });
      res.end(JSON.stringify({ reply }));

    } catch (err) {
      console.error('❌ Errore API:', err.message);
      res.writeHead(500, { 'Content-Type': 'application/json' });
      res.end(JSON.stringify({ error: err.message }));
    }
    return;
  }

  // ── POST /api/rag/reload ── ricarica la knowledge base dopo scraping ──
  if (req.method === 'POST' && parsed.pathname === '/api/rag/reload') {
    rag.reload();
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ ok: true, ready: rag.ready, chunks: rag.chunks.length }));
    return;
  }

  // ── GET /api/rag/search?q=... ── testa la ricerca RAG ────────────────
  if (req.method === 'GET' && parsed.pathname === '/api/rag/search') {
    const params = new URLSearchParams(parsed.query);
    const q = params.get('q') || '';
    const results = rag.search(q, 5);
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ query: q, results }));
    return;
  }

  // ── GET — File statici dalla cartella public/ ─────────────────────────
  const filePath = path.join(
    __dirname, 'public',
    parsed.pathname === '/' ? 'index.html' : parsed.pathname
  );

  fs.readFile(filePath, (err, data) => {
    if (err) {
      res.writeHead(404, { 'Content-Type': 'text/plain' });
      return res.end('404 — File non trovato: ' + parsed.pathname);
    }
    const ext      = path.extname(filePath).toLowerCase();
    const mimeType = MIME[ext] || 'application/octet-stream';
    res.writeHead(200, { 'Content-Type': mimeType });
    res.end(data);
  });
});

// ─── Avvio ────────────────────────────────────────────────────────────────
server.listen(PORT, () => {
  console.log('\n' + '═'.repeat(50));
  console.log('  🌊  Instagarda AI — Server attivo');
  console.log('═'.repeat(50));
  console.log(`  → Demo:    http://localhost:${PORT}`);
  console.log(`  → API:     http://localhost:${PORT}/api/chat`);
  console.log(`  → Modello: ${MODEL}`);
  console.log('═'.repeat(50) + '\n');
});
