<?php
/**
 * Template Name: Privacy Policy
 */
get_header();
?>

<!-- Hero -->
<section class="ig-mini-hero ig-mini-hero--legal">
    <div class="ig-mini-hero__content">
        <div class="ig-mini-hero__badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            Legale
        </div>
        <h1 class="ig-mini-hero__title">Privacy <span>Policy</span></h1>
        <p class="ig-mini-hero__desc">Come raccogliamo, utilizziamo e proteggiamo i tuoi dati personali</p>
    </div>
</section>

<!-- Content -->
<section class="ig-section ig-section--white">
    <div class="ig-container" style="max-width:800px">
        <div class="ig-legal">

            <p class="ig-legal__updated">Ultimo aggiornamento: 8 marzo 2026</p>

            <h2>1. Titolare del trattamento</h2>
            <p>Il titolare del trattamento dei dati personali è Instagarda, con sede operativa presso il Lago di Garda, Italia. Per qualsiasi comunicazione relativa alla privacy puoi scriverci a: <a href="mailto:privacy@instagarda.net">privacy@instagarda.net</a>.</p>

            <h2>2. Dati raccolti</h2>
            <p>Raccogliamo le seguenti categorie di dati:</p>
            <ul>
                <li><strong>Dati di navigazione:</strong> indirizzo IP, tipo di browser, sistema operativo, pagine visitate, durata della sessione. Questi dati vengono raccolti automaticamente tramite i sistemi di log del server e strumenti di analisi.</li>
                <li><strong>Dati forniti volontariamente:</strong> nome, indirizzo email e messaggio quando compili il modulo contatti o ti iscrivi alla newsletter.</li>
                <li><strong>Dati di interazione AI:</strong> le domande che invii al nostro assistente Garda AI. Questi dati vengono utilizzati per migliorare la qualità delle risposte.</li>
            </ul>

            <h2>3. Finalità del trattamento</h2>
            <p>I tuoi dati personali vengono trattati per le seguenti finalità:</p>
            <ul>
                <li>Fornitura e miglioramento dei servizi del sito web</li>
                <li>Risposta alle richieste inviate tramite il modulo contatti</li>
                <li>Invio della newsletter (solo previo consenso esplicito)</li>
                <li>Analisi statistiche anonime sull'utilizzo del sito</li>
                <li>Miglioramento dell'assistente AI Garda AI</li>
                <li>Adempimento di obblighi di legge</li>
            </ul>

            <h2>4. Base giuridica</h2>
            <p>Il trattamento dei dati si basa su:</p>
            <ul>
                <li><strong>Consenso:</strong> per l'invio della newsletter e l'utilizzo di cookie non essenziali</li>
                <li><strong>Legittimo interesse:</strong> per l'analisi statistica e il miglioramento dei servizi</li>
                <li><strong>Esecuzione contrattuale:</strong> per rispondere alle richieste di contatto</li>
                <li><strong>Obbligo legale:</strong> per adempimenti fiscali e normativi</li>
            </ul>

            <h2>5. Conservazione dei dati</h2>
            <p>I dati personali vengono conservati per il tempo strettamente necessario alle finalità per cui sono stati raccolti:</p>
            <ul>
                <li>Dati di navigazione: 26 mesi</li>
                <li>Dati del modulo contatti: 12 mesi dalla richiesta</li>
                <li>Dati newsletter: fino alla cancellazione dell'iscrizione</li>
                <li>Conversazioni AI: 6 mesi, poi anonimizzate</li>
            </ul>

            <h2>6. Condivisione con terze parti</h2>
            <p>Non vendiamo i tuoi dati personali. Potremmo condividerli con:</p>
            <ul>
                <li><strong>Provider di hosting:</strong> SiteGround (per l'erogazione del servizio web)</li>
                <li><strong>Servizi di analisi:</strong> Google Analytics (dati anonimizzati)</li>
                <li><strong>Provider AI:</strong> per l'elaborazione delle risposte dell'assistente Garda AI</li>
            </ul>
            <p>Tutti i fornitori terzi sono vincolati a trattare i dati in conformità al GDPR.</p>

            <h2>7. Cookie</h2>
            <p>Il sito utilizza cookie tecnici e, previo consenso, cookie analitici. Per maggiori dettagli consulta la nostra <a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>">Cookie Policy</a>.</p>

            <h2>8. I tuoi diritti</h2>
            <p>In qualità di interessato, hai diritto a:</p>
            <ul>
                <li><strong>Accesso:</strong> ottenere conferma dell'esistenza di un trattamento e conoscerne le modalità</li>
                <li><strong>Rettifica:</strong> correggere dati inesatti o incompleti</li>
                <li><strong>Cancellazione:</strong> richiedere l'eliminazione dei tuoi dati ("diritto all'oblio")</li>
                <li><strong>Limitazione:</strong> limitare il trattamento in determinate circostanze</li>
                <li><strong>Portabilità:</strong> ricevere i tuoi dati in formato strutturato e leggibile</li>
                <li><strong>Opposizione:</strong> opporti al trattamento basato sul legittimo interesse</li>
            </ul>
            <p>Per esercitare i tuoi diritti, scrivi a <a href="mailto:privacy@instagarda.net">privacy@instagarda.net</a>. Risponderemo entro 30 giorni.</p>

            <h2>9. Sicurezza</h2>
            <p>Adottiamo misure tecniche e organizzative adeguate per proteggere i tuoi dati: connessione HTTPS, accesso limitato ai dati, backup cifrati e monitoraggio continuo.</p>

            <h2>10. Modifiche alla policy</h2>
            <p>Ci riserviamo il diritto di aggiornare questa Privacy Policy. Le modifiche saranno pubblicate su questa pagina con la data di ultimo aggiornamento. Ti invitiamo a consultarla periodicamente.</p>

            <h2>11. Contatti</h2>
            <p>Per qualsiasi domanda relativa a questa Privacy Policy, puoi contattarci:</p>
            <ul>
                <li>Email: <a href="mailto:privacy@instagarda.net">privacy@instagarda.net</a></li>
                <li>Modulo: <a href="<?php echo esc_url(home_url('/contatti/')); ?>">Pagina contatti</a></li>
            </ul>

        </div>
    </div>
</section>

<?php get_footer(); ?>
