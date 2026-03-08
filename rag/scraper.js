#!/usr/bin/env node
/**
 * Instagarda AI — Web Scraper
 *
 * Scarica le pagine di un sito web, estrae il testo e crea
 * un knowledge base locale (JSON) per il sistema RAG.
 *
 * Uso:  node rag/scraper.js [URL_BASE] [MAX_PAGINE]
 * Es:   node rag/scraper.js https://instagarda.net 50
 *
 * Zero dipendenze esterne.
 */

const https = require('https');
const http  = require('http');
const fs    = require('fs');
const path  = require('path');
const { URL } = require('url');

// --- Configurazione ---
const BASE_URL   = process.argv[2] || 'https://instagarda.net';
const MAX_PAGES  = parseInt(process.argv[3]) || 50;
const CHUNK_SIZE = 400;   // parole per chunk
const OVERLAP    = 50;    // parole di overlap tra chunk
const DELAY_MS   = 500;   // pausa tra richieste
const OUTPUT     = path.join(__dirname, 'knowledge.json');

let baseHostname;
try {
  baseHostname = new URL(BASE_URL).hostname;
} catch {
  console.error('URL non valido:', BASE_URL);
  process.exit(1);
}

// --- HTTP Fetch con redirect ---
function fetchPage(targetUrl, redirects = 5) {
  return new Promise((resolve, reject) => {
    if (redirects <= 0) return reject(new Error('Troppi redirect'));

    const lib = targetUrl.startsWith('https') ? https : http;
    const req = lib.get(targetUrl, {
      headers: { 'User-Agent': 'InstagardaBot/1.0 (+https://instagarda.net)' },
      timeout: 15000
    }, res => {
      if ([301, 302, 307, 308].includes(res.statusCode) && res.headers.location) {
        const next = new URL(res.headers.location, targetUrl).href;
        return fetchPage(next, redirects - 1).then(resolve, reject);
      }
      if (res.statusCode !== 200) {
        return reject(new Error(`HTTP ${res.statusCode}`));
      }

      // Salta risposte non-HTML
      const ct = res.headers['content-type'] || '';
      if (!ct.includes('text/html')) {
        return reject(new Error('Non HTML: ' + ct.split(';')[0]));
      }

      let data = '';
      res.setEncoding('utf8');
      res.on('data', chunk => data += chunk);
      res.on('end', () => resolve(data));
    });
    req.on('error', reject);
    req.on('timeout', () => { req.destroy(); reject(new Error('Timeout')); });
  });
}

// --- Estrai titolo ---
function extractTitle(html) {
  const h1 = html.match(/<h1[^>]*>([\s\S]*?)<\/h1>/i);
  if (h1) return h1[1].replace(/<[^>]+>/g, '').trim();

  const title = html.match(/<title[^>]*>([\s\S]*?)<\/title>/i);
  return title ? title[1].replace(/<[^>]+>/g, '').trim() : 'Senza titolo';
}

// --- Estrai meta description ---
function extractDescription(html) {
  const match = html.match(/<meta[^>]*name=["']description["'][^>]*content=["'](.*?)["']/i)
             || html.match(/<meta[^>]*content=["'](.*?)["'][^>]*name=["']description["']/i);
  return match ? match[1].trim() : '';
}

// --- Estrai testo dal corpo della pagina ---
function extractText(html) {
  let text = html;

  // Rimuovi blocchi non-content
  text = text.replace(/<(script|style|nav|footer|noscript|svg|iframe|header)[^>]*>[\s\S]*?<\/\1>/gi, '');
  text = text.replace(/<!--[\s\S]*?-->/g, '');

  // Prova a estrarre solo il contenuto principale
  const mainMatch = text.match(/<(main|article)[^>]*>([\s\S]*?)<\/\1>/i);
  if (mainMatch) {
    text = mainMatch[2];
  } else {
    // Wrapper tipici di WordPress / CMS
    const contentMatch = text.match(/<div[^>]*class="[^"]*(?:entry-content|post-content|page-content|site-content|content-area)[^"]*"[^>]*>([\s\S]*?)<\/div>/i);
    if (contentMatch) text = contentMatch[1];
  }

  // Headings -> newline + testo
  text = text.replace(/<h[1-6][^>]*>([\s\S]*?)<\/h[1-6]>/gi, '\n\n$1\n');
  // Paragrafi e br
  text = text.replace(/<\/p>/gi, '\n\n');
  text = text.replace(/<br\s*\/?>/gi, '\n');
  // Liste
  text = text.replace(/<li[^>]*>/gi, '\n- ');

  // Rimuovi tutti i tag
  text = text.replace(/<[^>]+>/g, ' ');

  // Decodifica entita HTML
  text = text
    .replace(/&amp;/g, '&')
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>')
    .replace(/&quot;/g, '"')
    .replace(/&#0?39;/g, "'")
    .replace(/&nbsp;/g, ' ')
    .replace(/&#(\d+);/g, (_, n) => String.fromCharCode(n))
    .replace(/&\w+;/g, ' ');

  // Pulisci whitespace
  text = text.replace(/[ \t]+/g, ' ');
  text = text.replace(/\n[ \t]+/g, '\n');
  text = text.replace(/\n{3,}/g, '\n\n');
  return text.trim();
}

// --- Estrai link interni ---
function extractLinks(html, pageUrl) {
  const links = new Set();
  const regex = /href=["'](.*?)["']/gi;
  let match;

  while ((match = regex.exec(html)) !== null) {
    try {
      const href = match[1];
      // Salta anchor, javascript, mailto
      if (href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:')) continue;

      const resolved = new URL(href, pageUrl);
      if (resolved.hostname !== baseHostname) continue;
      if (/\.(pdf|jpg|jpeg|png|gif|svg|webp|css|js|zip|xml|rss|ico|woff|woff2|ttf|eot)$/i.test(resolved.pathname)) continue;

      // Normalizza
      resolved.hash = '';
      const clean = resolved.href.replace(/\/+$/, '') || resolved.origin;
      links.add(clean);
    } catch {}
  }

  return [...links];
}

// --- Chunking con overlap ---
function chunkText(text, title, pageUrl) {
  const words = text.split(/\s+/).filter(w => w.length > 0);
  if (words.length === 0) return [];

  if (words.length <= CHUNK_SIZE) {
    return [{ url: pageUrl, title, content: words.join(' '), words: words.length }];
  }

  const chunks = [];
  const stride = CHUNK_SIZE - OVERLAP;

  for (let i = 0; i < words.length; i += stride) {
    const slice = words.slice(i, i + CHUNK_SIZE);
    if (slice.length < 30) break;

    chunks.push({
      url: pageUrl,
      title: title + (chunks.length > 0 ? ` (parte ${chunks.length + 1})` : ''),
      content: slice.join(' '),
      words: slice.length
    });
  }

  return chunks;
}

// --- Pausa ---
const sleep = ms => new Promise(r => setTimeout(r, ms));

// --- Crawler principale ---
async function crawl() {
  console.log(`\n  Scraping ${BASE_URL}`);
  console.log(`  Max pagine: ${MAX_PAGES}\n`);

  const visited = new Set();
  const queue = [BASE_URL.replace(/\/+$/, '') || BASE_URL];
  const allChunks = [];
  let pageCount = 0;
  let errorCount = 0;

  while (queue.length > 0 && pageCount < MAX_PAGES) {
    const currentUrl = queue.shift();
    const normalized = currentUrl.replace(/\/+$/, '') || currentUrl;
    if (visited.has(normalized)) continue;
    visited.add(normalized);

    try {
      const html = await fetchPage(currentUrl);
      pageCount++;

      const title = extractTitle(html);
      const desc  = extractDescription(html);
      const text  = extractText(html);

      const wordCount = text.split(/\s+/).length;
      if (wordCount < 20) {
        console.log(`  [${pageCount}] skip  ${normalized}  (${wordCount} parole)`);
      } else {
        // Prependi la meta description al contenuto se presente
        const fullText = desc ? desc + '\n\n' + text : text;
        const chunks = chunkText(fullText, title, normalized);
        allChunks.push(...chunks);
        console.log(`  [${pageCount}] OK    ${normalized}`);
        console.log(`          "${title}" | ${wordCount} parole | ${chunks.length} chunk`);
      }

      // Aggiungi nuovi link alla coda
      const links = extractLinks(html, currentUrl);
      for (const link of links) {
        if (!visited.has(link.replace(/\/+$/, '') || link)) {
          queue.push(link);
        }
      }

      await sleep(DELAY_MS);

    } catch (err) {
      pageCount++;
      errorCount++;
      console.log(`  [${pageCount}] ERR   ${normalized}  (${err.message})`);
    }
  }

  // --- Salva knowledge base ---
  const knowledge = {
    scraped_at: new Date().toISOString(),
    base_url:   BASE_URL,
    pages_scraped: pageCount,
    pages_errors:  errorCount,
    total_chunks:  allChunks.length,
    chunks: allChunks.map((chunk, i) => ({
      id: `chunk_${String(i + 1).padStart(3, '0')}`,
      ...chunk
    }))
  };

  fs.writeFileSync(OUTPUT, JSON.stringify(knowledge, null, 2), 'utf8');

  console.log(`\n${'='.repeat(50)}`);
  console.log(`  Scraping completato`);
  console.log(`  Pagine: ${pageCount} (${errorCount} errori)`);
  console.log(`  Chunk:  ${allChunks.length}`);
  console.log(`  File:   ${OUTPUT}`);
  console.log(`${'='.repeat(50)}\n`);
}

crawl().catch(err => {
  console.error('Errore fatale:', err.message);
  process.exit(1);
});
