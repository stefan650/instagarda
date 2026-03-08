/**
 * Instagarda AI — Motore di ricerca BM25
 *
 * Carica la knowledge base (knowledge.json) e cerca
 * i chunk piu rilevanti per una query utente.
 *
 * Zero dipendenze esterne.
 */

const fs   = require('fs');
const path = require('path');

const KNOWLEDGE_PATH = path.join(__dirname, 'knowledge.json');

// --- Stop words multilingue (IT, EN, DE, NL) ---
const STOP_WORDS = new Set([
  // Italiano
  'il','lo','la','le','li','gli','un','una','uno','di','del','della',
  'dei','delle','dello','degli','da','dal','dalla','dai','dalle','in',
  'nel','nella','nei','nelle','su','sul','sulla','sui','sulle','con',
  'per','tra','fra','che','chi','cui','non','sono','sei','siamo',
  'siete','ho','hai','ha','abbiamo','avete','hanno','questo','questa',
  'questi','queste','quello','quella','quelli','quelle','come','dove',
  'quando','cosa','anche','ancora','molto','poi',
  'qui','tutto','tutti','ogni','altro','altri','altra','altre','suo',
  'sua','suoi','sue','mio','mia','nostro','loro','essere','avere',
  'fare','dire','andare','potere','volere','dovere','stare',
  // English
  'the','a','an','is','are','was','were','be','been','being',
  'have','has','had','do','does','did','will','would','could','should',
  'may','might','must','shall','can','need','to','of','in','for',
  'on','with','at','by','from','as','into','through','during','before',
  'after','above','below','between','and','but','or','not','so',
  'both','either','each','every','all','any','few','more','most',
  'other','some','such','no','only','own','same','than','too','very',
  'i','me','my','we','our','you','your','he','him','his','she',
  'her','it','its','they','them','their','what','which','who',
  'this','that','these','those','am',
  // Deutsch
  'der','die','das','ein','eine','einer','einem','einen','und',
  'ist','sind','war','waren','hat','haben','wird','werden',
  'mit','auf','von','aus','nach','bei','bis','unter',
  'vor','hinter','neben','zwischen','ohne','gegen','durch',
  'ich','du','er','sie','es','wir','ihr','nicht','sich','auch',
  'noch','nur','dann','aber','oder','wenn','als','wie','was',
  'den','dem','des','dass','so','sehr','kann',
  // Nederlands
  'de','het','een','en','van','dat','op','te',
  'zijn','voor','met','niet','aan','er','maar','om','ook',
  'bij','dan','nog','wel','naar','uit','tot','over',
  'dit','deze','wat','wie','waar','hoe','veel','meer'
]);

// --- Tokenizer multilingue ---
function tokenize(text) {
  return text
    .toLowerCase()
    .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // rimuovi accenti
    .replace(/[^\w\s]/g, ' ')
    .split(/\s+/)
    .filter(t => t.length > 1 && !STOP_WORDS.has(t));
}

// --- BM25 Search Engine ---
class RAGSearch {
  constructor() {
    this.chunks = [];
    this.ready = false;
    this.k1 = 1.5;
    this.b = 0.75;
    this.avgDl = 0;
    this.docFreqs = {};
    this.docTokens = [];
    this.docLengths = [];

    this._load();
  }

  _load() {
    try {
      if (!fs.existsSync(KNOWLEDGE_PATH)) {
        console.log('  RAG: knowledge.json non trovato. Esegui: node rag/scraper.js [URL]');
        return;
      }

      const data = JSON.parse(fs.readFileSync(KNOWLEDGE_PATH, 'utf8'));
      this.chunks = data.chunks || [];

      if (this.chunks.length === 0) {
        console.log('  RAG: knowledge base vuota');
        return;
      }

      this._buildIndex();
      this.ready = true;
      console.log(`  RAG: ${this.chunks.length} chunk indicizzati (${data.pages_scraped || '?'} pagine)`);
    } catch (err) {
      console.warn('  RAG: errore caricamento:', err.message);
    }
  }

  _buildIndex() {
    const N = this.chunks.length;
    let totalLen = 0;

    for (let i = 0; i < N; i++) {
      // Il titolo viene ripetuto per dargli piu peso
      const tokens = tokenize(
        this.chunks[i].title + ' ' +
        this.chunks[i].title + ' ' +
        this.chunks[i].content
      );

      this.docTokens[i] = {};
      this.docLengths[i] = tokens.length;
      totalLen += tokens.length;

      const seen = new Set();
      for (const t of tokens) {
        this.docTokens[i][t] = (this.docTokens[i][t] || 0) + 1;
        if (!seen.has(t)) {
          this.docFreqs[t] = (this.docFreqs[t] || 0) + 1;
          seen.add(t);
        }
      }
    }

    this.avgDl = totalLen / N;
  }

  /**
   * Cerca i chunk piu rilevanti per la query.
   * @param {string} query - La domanda dell'utente
   * @param {number} topK - Numero massimo di risultati (default: 3)
   * @param {number} minScore - Score minimo per includere un risultato (default: 0.5)
   * @returns {Array} Chunk ordinati per rilevanza
   */
  search(query, topK = 3, minScore = 0.5) {
    if (!this.ready) return [];

    const queryTokens = tokenize(query);
    if (queryTokens.length === 0) return [];

    const N = this.chunks.length;
    const scores = [];

    for (let i = 0; i < N; i++) {
      let score = 0;
      for (const t of queryTokens) {
        const df = this.docFreqs[t] || 0;
        if (df === 0) continue;

        const idf = Math.log((N - df + 0.5) / (df + 0.5) + 1);
        const tf  = this.docTokens[i][t] || 0;
        const dl  = this.docLengths[i];

        score += idf * (tf * (this.k1 + 1)) /
                 (tf + this.k1 * (1 - this.b + this.b * dl / this.avgDl));
      }
      if (score >= minScore) {
        scores.push({ index: i, score });
      }
    }

    scores.sort((a, b) => b.score - a.score);

    return scores.slice(0, topK).map(s => ({
      id:      this.chunks[s.index].id,
      url:     this.chunks[s.index].url,
      title:   this.chunks[s.index].title,
      content: this.chunks[s.index].content,
      score:   Math.round(s.score * 100) / 100
    }));
  }

  /**
   * Ricarica la knowledge base (utile dopo un nuovo scraping).
   */
  reload() {
    this.chunks = [];
    this.ready = false;
    this.docFreqs = {};
    this.docTokens = [];
    this.docLengths = [];
    this._load();
  }
}

module.exports = RAGSearch;
