# 🌊 Instagarda AI — Guida all'avvio

Assistente AI per il Lago di Garda, powered by Claude (Anthropic).
Zero dipendenze esterne — gira con solo Node.js.

---

## ⚡ Avvio rapido (5 minuti)

### 1. Prerequisiti
- [Node.js](https://nodejs.org/) versione 16 o superiore
- Una chiave API Anthropic (gratuita per iniziare su [console.anthropic.com](https://console.anthropic.com))

### 2. Configura la chiave API
```bash
# Copia il file di esempio
cp .env.example .env

# Apri .env con un editor e inserisci la tua chiave:
# ANTHROPIC_API_KEY=sk-ant-...
```

### 3. Avvia il server
```bash
node server.js
```

### 4. Apri il browser
Vai su **http://localhost:3000** — dovresti vedere la chat demo! 🎉

---

## 📁 Struttura del progetto

```
instagarda-ai/
├── server.js          ← Backend Node.js (zero dipendenze)
├── system_prompt.txt  ← Personalità e conoscenza dell'AI (modifica qui!)
├── .env               ← La tua chiave API (non condividere mai!)
├── .env.example       ← Template del file .env
├── README.md          ← Questa guida
└── public/
    ├── index.html     ← Demo chat full-page
    └── widget.js      ← Widget embeddabile (floating button)
```

---

## 🔧 Personalizzare il bot

### Cambiare la personalità / aggiungere contenuti
Modifica il file `system_prompt.txt` — nessuna competenza tecnica richiesta.
Ogni volta che aggiungi nuove destinazioni o sezioni al sito, aggiorna questo file.

### Cambiare il modello AI
Nel file `server.js`, riga `const MODEL = ...`:
- `claude-haiku-4-5-20251001` → economico e veloce (consigliato per produzione)
- `claude-sonnet-4-6` → più intelligente, leggermente più costoso

---

## 🌐 Integrare su WordPress

### Metodo 1 — Widget flottante (consigliato)
Aggiungi questo codice prima di `</body>` nel tuo tema WordPress
(oppure tramite plugin "Insert Headers and Footers"):

```html
<script
  src="https://TUO-DOMINIO/widget.js"
  data-api-url="https://TUO-DOMINIO/api/chat"
  data-theme-color="#1a56db"
  data-bot-name="Garda AI"
  data-welcome="Ciao! 🌊 Come posso aiutarti a scoprire il Lago di Garda?">
</script>
```

### Metodo 2 — Chat su pagina dedicata
Crea una pagina WordPress e usa un blocco HTML con un iframe:
```html
<iframe
  src="https://TUO-DOMINIO/"
  width="100%"
  height="600px"
  style="border:none; border-radius:16px;">
</iframe>
```

---

## 📱 QR Code per hotel partner

Il QR code per WhatsApp si genera con questo link:
```
https://wa.me/+39XXXXXXXXXX?text=Ciao+Garda+AI!+Ho+bisogno+di+aiuto+per+il+mio+soggiorno
```

Sostituisci `+39XXXXXXXXXX` con il numero WhatsApp Business.

Per stampare il QR code: usa [qr.io](https://qr.io) o [qr-code-generator.com](https://qr-code-generator.com), inserisci il link sopra, scarica in alta risoluzione e stampa su card da lasciare in reception.

---

## 💰 Costi stimati (API Claude)

| Volume mensile | Costo API stimato |
|---|---|
| 500 conversazioni | ~€3–8 |
| 2.000 conversazioni | ~€12–30 |
| 10.000 conversazioni | ~€60–150 |

*Usando il modello Haiku (il più economico). I costi esatti dipendono dalla lunghezza dei messaggi.*

---

## 🚀 Deploy in produzione

Per mettere il server online (accessibile da internet) consiglio:

**[Railway.app](https://railway.app)** — il più semplice:
1. Crea account gratuito
2. "New Project" → "Deploy from GitHub" (o drag & drop la cartella)
3. Aggiungi la variabile `ANTHROPIC_API_KEY` nelle impostazioni
4. Il server è online in 2 minuti con un URL pubblico

**Alternativa:** [Render.com](https://render.com) (piano free disponibile)

---

## 📞 Supporto
Per domande sul progetto, contatta: stefan@instagarda.net
