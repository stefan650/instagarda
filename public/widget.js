/**
 * Instagarda AI — Widget Embeddabile
 *
 * Uso su qualsiasi sito (WordPress, Squarespace, HTML puro):
 *   <script src="https://TUO-SERVER/widget.js"
 *           data-api-url="https://TUO-SERVER/api/chat"
 *           data-theme-color="#1a56db"
 *           data-bot-name="Garda AI"
 *           data-welcome="Ciao! Come posso aiutarti?">
 *   </script>
 *
 * Su WordPress — aggiungi in Functions.php oppure tramite plugin "Insert Headers and Footers"
 */
(function () {
  'use strict';

  // ── Leggi configurazione dal tag <script> ────────────────────────────
  const scriptTag   = document.currentScript || (function () {
    const scripts = document.getElementsByTagName('script');
    return scripts[scripts.length - 1];
  })();

  const API_URL      = scriptTag.getAttribute('data-api-url')      || '/api/chat';
  const THEME_COLOR  = scriptTag.getAttribute('data-theme-color')   || '#1a56db';
  const BOT_NAME     = scriptTag.getAttribute('data-bot-name')      || 'Garda AI';
  const WELCOME_MSG  = scriptTag.getAttribute('data-welcome')       || 'Ciao! 🌊 Sono Garda AI, la tua guida personale al Lago di Garda. Come posso aiutarti?';

  // ── CSS ────────────────────────────────────────────────────────────
  const css = `
    #gardaai-btn {
      position: fixed;
      bottom: 24px; right: 24px;
      width: 58px; height: 58px;
      border-radius: 50%;
      background: ${THEME_COLOR};
      color: white;
      border: none; cursor: pointer;
      font-size: 26px;
      box-shadow: 0 4px 18px rgba(0,0,0,.22);
      z-index: 99998;
      transition: transform .18s, box-shadow .18s;
      display: flex; align-items: center; justify-content: center;
    }
    #gardaai-btn:hover {
      transform: scale(1.08);
      box-shadow: 0 6px 24px rgba(0,0,0,.28);
    }
    #gardaai-btn .close-icon { display: none; font-size: 22px; }
    #gardaai-btn.open .chat-icon  { display: none; }
    #gardaai-btn.open .close-icon { display: flex; }

    #gardaai-panel {
      position: fixed;
      bottom: 96px; right: 24px;
      width: 360px;
      height: 520px;
      background: white;
      border-radius: 18px;
      box-shadow: 0 8px 40px rgba(0,0,0,.18);
      z-index: 99997;
      display: flex; flex-direction: column;
      overflow: hidden;
      transform: scale(.92) translateY(12px);
      opacity: 0;
      pointer-events: none;
      transition: transform .22s cubic-bezier(.34,1.56,.64,1), opacity .18s;
    }
    #gardaai-panel.open {
      transform: scale(1) translateY(0);
      opacity: 1;
      pointer-events: all;
    }

    /* Header */
    .gai-header {
      background: ${THEME_COLOR};
      color: white;
      padding: 14px 16px;
      display: flex; align-items: center; gap: 10px;
    }
    .gai-header-avatar {
      width: 34px; height: 34px; border-radius: 50%;
      background: rgba(255,255,255,.22);
      display: flex; align-items: center; justify-content: center;
      font-size: 16px; font-weight: 700;
      flex-shrink: 0;
    }
    .gai-header-info h3 { font-size: 14px; font-weight: 700; margin: 0; }
    .gai-header-info p  { font-size: 11px; opacity: .8; margin: 0; }
    .gai-header-dot {
      width: 8px; height: 8px; border-radius: 50%;
      background: #4ade80; margin-left: auto; flex-shrink: 0;
    }

    /* Chat messages */
    .gai-messages {
      flex: 1; overflow-y: auto; padding: 14px;
      display: flex; flex-direction: column; gap: 10px;
    }
    .gai-msg { display: flex; gap: 8px; max-width: 88%; }
    .gai-msg.user { align-self: flex-end; flex-direction: row-reverse; }
    .gai-msg.ai   { align-self: flex-start; }

    .gai-avatar {
      width: 28px; height: 28px; border-radius: 50%;
      flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
      font-size: 11px; font-weight: 700;
    }
    .gai-avatar.ai   { background: ${THEME_COLOR}; color: white; }
    .gai-avatar.user { background: #e2e8f0; font-size: 14px; }

    .gai-bubble {
      padding: 9px 13px;
      border-radius: 14px;
      font-size: 13px; line-height: 1.5;
      word-break: break-word;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    .gai-msg.ai   .gai-bubble { background: #f1f5f9; color: #1e293b; border-bottom-left-radius: 4px; }
    .gai-msg.user .gai-bubble { background: ${THEME_COLOR}; color: white; border-bottom-right-radius: 4px; }
    .gai-bubble a { color: inherit; text-decoration: underline; }
    .gai-bubble p { margin: 0 0 5px; } .gai-bubble p:last-child { margin: 0; }
    .gai-bubble strong { font-weight: 700; }

    /* Typing */
    .gai-typing { display: flex; gap: 8px; align-self: flex-start; }
    .gai-typing-dots {
      background: #f1f5f9; border-radius: 14px; border-bottom-left-radius: 4px;
      padding: 10px 14px; display: flex; gap: 4px;
    }
    .gai-dot {
      width: 6px; height: 6px; border-radius: 50%; background: #94a3b8;
      animation: gaiBounce .9s ease-in-out infinite;
    }
    .gai-dot:nth-child(2) { animation-delay: .15s; }
    .gai-dot:nth-child(3) { animation-delay: .30s; }
    @keyframes gaiBounce {
      0%,80%,100% { transform: translateY(0); }
      40%          { transform: translateY(-5px); }
    }

    /* Input */
    .gai-input-wrap {
      border-top: 1px solid #e2e8f0;
      padding: 10px 12px;
      display: flex; gap: 8px; align-items: flex-end;
    }
    .gai-input {
      flex: 1; border: 1.5px solid #e2e8f0; border-radius: 18px;
      padding: 9px 14px; font-size: 13px;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      resize: none; outline: none; min-height: 38px; max-height: 90px;
      transition: border-color .18s;
    }
    .gai-input:focus { border-color: ${THEME_COLOR}; }
    .gai-send {
      width: 38px; height: 38px; border-radius: 50%;
      background: ${THEME_COLOR}; border: none; cursor: pointer;
      color: white; font-size: 16px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; transition: background .18s, transform .1s;
    }
    .gai-send:hover  { filter: brightness(1.1); }
    .gai-send:active { transform: scale(.9); }
    .gai-send:disabled { background: #94a3b8; cursor: not-allowed; }

    /* Footer */
    .gai-footer {
      text-align: center; font-size: 10px; color: #94a3b8;
      padding: 4px 12px 8px;
    }

    @media (max-width: 420px) {
      #gardaai-panel { width: calc(100vw - 16px); right: 8px; bottom: 84px; }
      #gardaai-btn   { right: 16px; bottom: 16px; }
    }
  `;

  // ── Inietta CSS ───────────────────────────────────────────────────────
  const style = document.createElement('style');
  style.textContent = css;
  document.head.appendChild(style);

  // ── Crea HTML del widget ──────────────────────────────────────────────
  const container = document.createElement('div');
  container.id = 'gardaai-widget';
  container.innerHTML = `
    <button id="gardaai-btn" aria-label="Apri Garda AI" title="${BOT_NAME}">
      <span class="chat-icon">💬</span>
      <span class="close-icon">✕</span>
    </button>

    <div id="gardaai-panel" role="dialog" aria-label="${BOT_NAME}">
      <div class="gai-header">
        <div class="gai-header-avatar">GA</div>
        <div class="gai-header-info">
          <h3>${BOT_NAME}</h3>
          <p>Assistente Lago di Garda</p>
        </div>
        <div class="gai-header-dot" title="Online"></div>
      </div>

      <div class="gai-messages" id="gai-messages"></div>

      <div class="gai-input-wrap">
        <textarea class="gai-input" id="gai-input" placeholder="Scrivi un messaggio…" rows="1"></textarea>
        <button class="gai-send" id="gai-send" title="Invia">➤</button>
      </div>
      <div class="gai-footer">
        Powered by <a href="https://instagarda.net" target="_blank" style="color:inherit">Instagarda.net</a>
      </div>
    </div>
  `;
  document.body.appendChild(container);

  // ── State ─────────────────────────────────────────────────────────────
  const msgHistory = [];
  let isOpen = false;

  // ── Markdown render (leggero, no lib) ─────────────────────────────────
  function md(text) {
    return text
      .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
      .replace(/\*\*(.*?)\*\*/g,'<strong>$1</strong>')
      .replace(/\*(.*?)\*/g,'<em>$1</em>')
      .replace(/\[(.*?)\]\((https?:\/\/[^\)]+)\)/g,'<a href="$2" target="_blank">$1</a>')
      .replace(/https?:\/\/[^\s<]+/g, u=>`<a href="${u}" target="_blank">${u}</a>`)
      .replace(/\n\n/g,'</p><p>').replace(/\n/g,'<br>')
      .replace(/^/,'<p>').replace(/$/,'</p>');
  }

  // ── Aggiungi messaggio ────────────────────────────────────────────────
  function addMsg(role, text) {
    const area = document.getElementById('gai-messages');
    const div  = document.createElement('div');
    div.className = 'gai-msg ' + role;

    const avatar = document.createElement('div');
    avatar.className = 'gai-avatar ' + role;
    avatar.textContent = role === 'ai' ? 'GA' : '👤';

    const bubble = document.createElement('div');
    bubble.className = 'gai-bubble';
    bubble.innerHTML = md(text);

    div.appendChild(avatar);
    div.appendChild(bubble);
    area.appendChild(div);
    area.scrollTop = area.scrollHeight;
  }

  function showTyping() {
    const area = document.getElementById('gai-messages');
    const div  = document.createElement('div');
    div.className = 'gai-typing'; div.id = 'gai-typing';

    const av = document.createElement('div');
    av.className = 'gai-avatar ai'; av.textContent = 'GA';

    const dots = document.createElement('div');
    dots.className = 'gai-typing-dots';
    dots.innerHTML = '<div class="gai-dot"></div><div class="gai-dot"></div><div class="gai-dot"></div>';

    div.appendChild(av); div.appendChild(dots);
    area.appendChild(div);
    area.scrollTop = area.scrollHeight;
  }

  function hideTyping() {
    const el = document.getElementById('gai-typing');
    if (el) el.remove();
  }

  // ── Toggle panel ──────────────────────────────────────────────────────
  function togglePanel() {
    isOpen = !isOpen;
    document.getElementById('gardaai-btn').classList.toggle('open', isOpen);
    document.getElementById('gardaai-panel').classList.toggle('open', isOpen);

    if (isOpen && document.getElementById('gai-messages').children.length === 0) {
      // Messaggio di benvenuto al primo avvio
      addMsg('ai', WELCOME_MSG);
    }
    if (isOpen) setTimeout(() => document.getElementById('gai-input').focus(), 250);
  }

  // ── Invia ─────────────────────────────────────────────────────────────
  async function sendMsg() {
    const inp  = document.getElementById('gai-input');
    const send = document.getElementById('gai-send');
    const text = inp.value.trim();
    if (!text) return;

    inp.value = '';
    inp.style.height = 'auto';
    send.disabled = true;

    addMsg('user', text);
    msgHistory.push({ role: 'user', content: text });
    showTyping();

    try {
      const res  = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ messages: msgHistory })
      });
      const data = await res.json();
      hideTyping();

      if (data.error) throw new Error(data.error);
      addMsg('ai', data.reply);
      msgHistory.push({ role: 'assistant', content: data.reply });

    } catch (e) {
      hideTyping();
      addMsg('ai', '⚠️ Errore: ' + e.message);
    }

    send.disabled = false;
    inp.focus();
  }

  // ── Event listeners ───────────────────────────────────────────────────
  document.getElementById('gardaai-btn').addEventListener('click', togglePanel);
  document.getElementById('gai-send').addEventListener('click', sendMsg);
  document.getElementById('gai-input').addEventListener('keydown', e => {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMsg(); }
  });
  document.getElementById('gai-input').addEventListener('input', function () {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 90) + 'px';
  });

})();
