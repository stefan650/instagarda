/**
 * Garda Concierge — Chat Widget
 */
(function() {
  'use strict';

  const API_URL = (window.instagarda && window.instagarda.chat_api) || '/api/chat';
  let isOpen = false;
  let messages = [];

  // Build widget HTML
  function createWidget() {
    const widget = document.createElement('div');
    widget.id = 'gardaChat';
    widget.innerHTML = `
      <button class="gc-fab" id="gcFab" aria-label="Apri Garda Concierge">
        <span class="gc-fab__icon gc-fab__icon--chat">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        </span>
        <span class="gc-fab__icon gc-fab__icon--close" style="display:none">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </span>
        <span class="gc-fab__pulse"></span>
      </button>
      <div class="gc-panel" id="gcPanel">
        <div class="gc-panel__header">
          <div class="gc-panel__header-info">
            <div class="gc-panel__avatar">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            </div>
            <div>
              <h3 class="gc-panel__title">Garda Concierge</h3>
              <span class="gc-panel__status">Online</span>
            </div>
          </div>
          <button class="gc-panel__close" id="gcClose" aria-label="Chiudi">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
        <div class="gc-panel__messages" id="gcMessages">
          <div class="gc-msg gc-msg--bot">
            <div class="gc-msg__avatar">AI</div>
            <div class="gc-msg__bubble">
              Ciao! Sono <strong>Garda Concierge</strong>, la tua guida al Lago di Garda. Chiedimi qualsiasi cosa: dove mangiare, cosa vedere, come arrivare, eventi e molto altro!
            </div>
          </div>
        </div>
        <div class="gc-panel__suggestions" id="gcSuggestions">
          <button class="gc-suggestion" data-q="Cosa vedere a Sirmione?">Cosa vedere a Sirmione?</button>
          <button class="gc-suggestion" data-q="Migliori ristoranti sul lago">Migliori ristoranti</button>
          <button class="gc-suggestion" data-q="Attivita sportive sul Garda">Sport e attivita</button>
        </div>
        <form class="gc-panel__input" id="gcForm">
          <input type="text" id="gcInput" placeholder="Scrivi un messaggio..." autocomplete="off">
          <button type="submit" class="gc-panel__send" id="gcSend" aria-label="Invia">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>
        </form>
      </div>
    `;
    document.body.appendChild(widget);
    bindEvents();
  }

  function toggle() {
    isOpen = !isOpen;
    const panel = document.getElementById('gcPanel');
    const fab = document.getElementById('gcFab');
    if (!panel || !fab) return;
    const chatIcon = fab.querySelector('.gc-fab__icon--chat');
    const closeIcon = fab.querySelector('.gc-fab__icon--close');
    const pulse = fab.querySelector('.gc-fab__pulse');

    panel.classList.toggle('gc-panel--open', isOpen);
    fab.classList.toggle('gc-fab--active', isOpen);
    if (chatIcon) chatIcon.style.display = isOpen ? 'none' : '';
    if (closeIcon) closeIcon.style.display = isOpen ? '' : 'none';
    if (pulse) pulse.style.display = 'none';

    if (isOpen) {
      setTimeout(() => {
        const input = document.getElementById('gcInput');
        if (input) input.focus();
      }, 300);
    }
  }

  function addMessage(text, isUser) {
    const container = document.getElementById('gcMessages');
    if (!container) return;
    const msg = document.createElement('div');
    msg.className = 'gc-msg ' + (isUser ? 'gc-msg--user' : 'gc-msg--bot');

    if (isUser) {
      msg.innerHTML = `<div class="gc-msg__bubble">${escapeHtml(text)}</div>`;
    } else {
      msg.innerHTML = `<div class="gc-msg__avatar">AI</div><div class="gc-msg__bubble">${escapeHtml(text)}</div>`;
    }

    container.appendChild(msg);
    container.scrollTop = container.scrollHeight;

    // Hide suggestions after first message
    const sug = document.getElementById('gcSuggestions');
    if (sug) sug.style.display = 'none';
  }

  function addTypingIndicator() {
    const container = document.getElementById('gcMessages');
    const typing = document.createElement('div');
    typing.className = 'gc-msg gc-msg--bot gc-msg--typing';
    typing.id = 'gcTyping';
    typing.innerHTML = `<div class="gc-msg__avatar">AI</div><div class="gc-msg__bubble"><span class="gc-typing"><span></span><span></span><span></span></span></div>`;
    container.appendChild(typing);
    container.scrollTop = container.scrollHeight;
  }

  function removeTypingIndicator() {
    const typing = document.getElementById('gcTyping');
    if (typing) typing.remove();
  }

  // Offline knowledge base
  var offlineReplies = [
    { keys: ['sirmione', 'grotte', 'catullo', 'terme'],
      reply: 'Sirmione è una delle perle del Lago di Garda! Da non perdere le <strong>Grotte di Catullo</strong>, il <strong>Castello Scaligero</strong> e le terme. Passeggia lungo la penisola per panorami mozzafiato. Il centro storico è pedonale e pieno di ristorantini e gelaterie.' },
    { keys: ['riva', 'torbole', 'nord'],
      reply: 'Riva del Garda si trova sulla sponda nord ed è il paradiso del <strong>windsurf e della vela</strong>. Visita la Rocca, il MAG museo, e fai una passeggiata fino alla cascata del Varone. Da qui parte anche la ciclabile fino a Torbole!' },
    { keys: ['malcesine', 'baldo', 'funivia'],
      reply: 'Malcesine è famosa per il <strong>Castello Scaligero</strong> e la <strong>funivia del Monte Baldo</strong> che ti porta a 1800m con vista spettacolare sul lago. Perfetta per trekking, parapendio e mountain bike.' },
    { keys: ['limone', 'limonaia'],
      reply: 'Limone sul Garda è un borgo pittoresco con le sue famose <strong>limonaie</strong> storiche. Percorri la spettacolare <strong>pista ciclabile</strong> sospesa sul lago e goditi il centro storico con i suoi vicoli colorati.' },
    { keys: ['bardolino', 'vino', 'chiaretto'],
      reply: 'Bardolino è la capitale del <strong>vino</strong> sul Garda! Visita il Museo del Vino, assaggia il Chiaretto e il Bardolino DOC. Il lungolago è perfetto per passeggiate e il centro è pieno di enoteche e ristoranti tipici.' },
    { keys: ['salo', 'salò'],
      reply: 'Salò ha un elegante lungolago con portici, boutique e il magnifico <strong>Duomo</strong>. È la cittadina più grande della sponda bresciana, ottima base per esplorare il Vittoriale degli Italiani a Gardone.' },
    { keys: ['ristorante', 'mangiare', 'cibo', 'cucina', 'ristoranti'],
      reply: 'Il Lago di Garda offre una cucina fantastica! Prova i <strong>tortellini di Valeggio</strong>, il <strong>pesce di lago</strong> (coregone, tinca), l\'<strong>olio extravergine del Garda</strong> e il gelato artigianale. Ogni paese ha i suoi ristoranti tipici — che zona ti interessa?' },
    { keys: ['dormire', 'hotel', 'alloggio', 'dove stare'],
      reply: 'Sul Lago di Garda trovi ogni tipo di alloggio: <strong>hotel</strong> con vista lago, <strong>agriturismi</strong> nell\'entroterra, <strong>campeggi</strong> sulla riva e <strong>B&B</strong> nei borghi. Le zone più richieste sono Sirmione, Riva del Garda e Malcesine. Che tipo di vacanza cerchi?' },
    { keys: ['sport', 'attivit', 'fare', 'vela', 'surf', 'trekking', 'bici'],
      reply: 'Il Garda è perfetto per lo sport! <strong>Windsurf e vela</strong> a Torbole/Riva, <strong>mountain bike</strong> sul Monte Baldo, <strong>trekking</strong> ovunque, <strong>arrampicata</strong> ad Arco, <strong>parapendio</strong> a Malcesine, e <strong>kayak</strong> lungo tutta la costa.' },
    { keys: ['arriv', 'come', 'treno', 'aereo', 'auto', 'bus'],
      reply: 'Puoi raggiungere il Lago di Garda in <strong>auto</strong> (A4 Milano-Venezia, uscite Desenzano/Peschiera/Sirmione), in <strong>treno</strong> (stazione Desenzano-Sirmione o Peschiera), o dagli <strong>aeroporti</strong> di Verona (20min), Bergamo (1h) e Milano (1.5h). I battelli collegano tutti i paesi del lago!' },
    { keys: ['cosa vedere', 'visit', 'attrazio'],
      reply: 'Le attrazioni imperdibili: <strong>Grotte di Catullo</strong> a Sirmione, <strong>Vittoriale</strong> a Gardone, <strong>Monte Baldo</strong> in funivia, <strong>Cascata del Varone</strong> a Riva, i <strong>borghi</strong> di Limone e Malcesine. Vuoi approfondire una zona specifica?' },
  ];

  function getOfflineReply(text) {
    var q = text.toLowerCase();
    for (var i = 0; i < offlineReplies.length; i++) {
      var entry = offlineReplies[i];
      for (var j = 0; j < entry.keys.length; j++) {
        if (q.indexOf(entry.keys[j]) !== -1) return entry.reply;
      }
    }
    return 'Ottima domanda! Al momento posso aiutarti con info su <strong>destinazioni</strong> (Sirmione, Riva, Malcesine, Limone, Bardolino, Salò), <strong>dove mangiare</strong>, <strong>dove dormire</strong>, <strong>attività sportive</strong> e <strong>come arrivare</strong>. Prova a chiedermi qualcosa di più specifico!';
  }

  async function sendMessage(text) {
    if (!text.trim()) return;

    addMessage(text, true);
    messages.push({ role: 'user', content: text });

    document.getElementById('gcInput').value = '';
    addTypingIndicator();

    try {
      var resp = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message: text, history: messages.slice(-10) }),
      });

      removeTypingIndicator();

      if (resp.ok) {
        var data = await resp.json();
        var reply = data.reply || data.response || data.message || 'Mi dispiace, non ho capito. Puoi riformulare?';
        addMessage(reply, false);
        messages.push({ role: 'assistant', content: reply });
      } else {
        // Fallback to offline replies
        var offReply = getOfflineReply(text);
        addMessage(offReply, false);
        messages.push({ role: 'assistant', content: offReply });
      }
    } catch (e) {
      removeTypingIndicator();
      // Fallback to offline replies
      var offReply = getOfflineReply(text);
      addMessage(offReply, false);
      messages.push({ role: 'assistant', content: offReply });
    }
  }

  function escapeHtml(text) {
    const d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
  }

  function bindEvents() {
    document.getElementById('gcFab').addEventListener('click', toggle);
    document.getElementById('gcClose').addEventListener('click', toggle);

    document.getElementById('gcForm').addEventListener('submit', function(e) {
      e.preventDefault();
      sendMessage(document.getElementById('gcInput').value);
    });

    document.querySelectorAll('.gc-suggestion').forEach(function(btn) {
      btn.addEventListener('click', function() {
        sendMessage(this.dataset.q);
      });
    });
  }

  // Global toggle function (used by CTA buttons across the site)
  window.toggleGardaChat = function() {
    toggle();
  };

  // Init
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', createWidget);
  } else {
    createWidget();
  }
})();
