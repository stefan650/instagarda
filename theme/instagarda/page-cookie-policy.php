<?php
/**
 * Template Name: Cookie Policy
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
        <h1 class="ig-mini-hero__title">Cookie <span>Policy</span></h1>
        <p class="ig-mini-hero__desc">Informativa sull'utilizzo dei cookie su instagarda.net</p>
    </div>
</section>

<!-- Content -->
<section class="ig-section ig-section--white">
    <div class="ig-container" style="max-width:800px">
        <div class="ig-legal">

            <p class="ig-legal__updated">Ultimo aggiornamento: 8 marzo 2026</p>

            <h2>Cosa sono i cookie</h2>
            <p>I cookie sono piccoli file di testo che vengono memorizzati sul tuo dispositivo quando visiti un sito web. Servono a migliorare la tua esperienza di navigazione, ricordare le tue preferenze e raccogliere informazioni statistiche anonime.</p>

            <h2>Cookie che utilizziamo</h2>

            <h3>Cookie tecnici (necessari)</h3>
            <p>Questi cookie sono essenziali per il funzionamento del sito e non possono essere disattivati. Includono:</p>
            <div class="ig-legal__table-wrap">
                <table class="ig-legal__table">
                    <thead>
                        <tr><th>Cookie</th><th>Finalità</th><th>Durata</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>wordpress_sec_*</td><td>Autenticazione utente</td><td>Sessione</td></tr>
                        <tr><td>wordpress_logged_in_*</td><td>Stato login</td><td>Sessione</td></tr>
                        <tr><td>wp_lang</td><td>Preferenza lingua</td><td>Sessione</td></tr>
                        <tr><td>sg_optimizer_*</td><td>Cache e ottimizzazione</td><td>30 giorni</td></tr>
                    </tbody>
                </table>
            </div>

            <h3>Cookie analitici</h3>
            <p>Utilizziamo cookie analitici per comprendere come i visitatori interagiscono con il sito. Tutti i dati sono anonimizzati.</p>
            <div class="ig-legal__table-wrap">
                <table class="ig-legal__table">
                    <thead>
                        <tr><th>Cookie</th><th>Fornitore</th><th>Finalità</th><th>Durata</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>_ga</td><td>Google Analytics</td><td>Identificazione visitatori</td><td>2 anni</td></tr>
                        <tr><td>_ga_*</td><td>Google Analytics</td><td>Stato sessione</td><td>2 anni</td></tr>
                        <tr><td>_gid</td><td>Google Analytics</td><td>Identificazione visitatori</td><td>24 ore</td></tr>
                    </tbody>
                </table>
            </div>

            <h3>Cookie di terze parti</h3>
            <p>Alcuni contenuti incorporati (come video YouTube o embed Instagram) possono installare cookie propri. Questi cookie sono soggetti alle rispettive informative privacy dei fornitori terzi.</p>

            <h2>Come gestire i cookie</h2>
            <p>Puoi controllare e gestire i cookie attraverso le impostazioni del tuo browser:</p>
            <ul>
                <li><strong>Chrome:</strong> Impostazioni &gt; Privacy e sicurezza &gt; Cookie</li>
                <li><strong>Firefox:</strong> Impostazioni &gt; Privacy &amp; Sicurezza &gt; Cookie</li>
                <li><strong>Safari:</strong> Preferenze &gt; Privacy &gt; Gestisci dati siti web</li>
                <li><strong>Edge:</strong> Impostazioni &gt; Cookie e autorizzazioni sito</li>
            </ul>
            <p>La disattivazione dei cookie tecnici potrebbe compromettere il funzionamento di alcune parti del sito.</p>

            <h2>Aggiornamenti</h2>
            <p>Questa Cookie Policy potrebbe essere aggiornata periodicamente. L'ultima versione è sempre disponibile su questa pagina.</p>

            <h2>Contatti</h2>
            <p>Per domande sui cookie, scrivi a <a href="mailto:privacy@instagarda.net">privacy@instagarda.net</a> o visita la nostra <a href="<?php echo esc_url(home_url('/contatti/')); ?>">pagina contatti</a>.</p>

        </div>
    </div>
</section>

<?php get_footer(); ?>
