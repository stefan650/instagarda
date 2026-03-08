<?php
/**
 * Template Name: Termini di Servizio
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
        <h1 class="ig-mini-hero__title">Termini di <span>Servizio</span></h1>
        <p class="ig-mini-hero__desc">Condizioni d'uso del sito instagarda.net e dei servizi correlati</p>
    </div>
</section>

<!-- Content -->
<section class="ig-section ig-section--white">
    <div class="ig-container" style="max-width:800px">
        <div class="ig-legal">

            <p class="ig-legal__updated">Ultimo aggiornamento: 8 marzo 2026</p>

            <h2>1. Accettazione dei termini</h2>
            <p>Accedendo e utilizzando il sito instagarda.net (di seguito "il Sito") accetti di essere vincolato ai presenti Termini di Servizio. Se non accetti questi termini, ti preghiamo di non utilizzare il Sito.</p>

            <h2>2. Descrizione del servizio</h2>
            <p>Instagarda è una piattaforma informativa dedicata al Lago di Garda che offre:</p>
            <ul>
                <li>Guide e informazioni sulle destinazioni del Lago di Garda</li>
                <li>Un assistente AI ("Garda AI") per rispondere a domande turistiche</li>
                <li>Una directory di strutture ricettive, ristoranti e attività</li>
                <li>Contenuti editoriali (articoli, guide, itinerari)</li>
                <li>Una newsletter informativa</li>
            </ul>

            <h2>3. Utilizzo del servizio</h2>
            <p>L'utente si impegna a:</p>
            <ul>
                <li>Utilizzare il Sito in modo lecito e conforme a questi termini</li>
                <li>Non tentare di compromettere la sicurezza o la funzionalità del Sito</li>
                <li>Non utilizzare l'assistente AI per generare contenuti illeciti, offensivi o fuorvianti</li>
                <li>Non raccogliere dati dal Sito tramite scraping automatizzato senza autorizzazione</li>
                <li>Fornire informazioni veritiere quando compila moduli di contatto o iscrizione</li>
            </ul>

            <h2>4. Assistente AI (Garda AI)</h2>
            <p>Garda AI è un assistente virtuale che fornisce informazioni sul Lago di Garda. Le risposte dell'AI:</p>
            <ul>
                <li>Sono generate automaticamente e potrebbero contenere imprecisioni</li>
                <li>Non costituiscono consulenza professionale (turistica, legale, medica o di altro tipo)</li>
                <li>Vengono fornite "così come sono", senza garanzie di completezza o accuratezza</li>
                <li>Dovrebbero essere verificate dall'utente prima di prendere decisioni importanti</li>
            </ul>
            <p>Instagarda si impegna a migliorare costantemente la qualità delle risposte ma non può garantire la totale assenza di errori.</p>

            <h2>5. Proprietà intellettuale</h2>
            <p>Tutti i contenuti presenti sul Sito — testi, immagini, video, grafica, logo, design e software — sono di proprietà di Instagarda o dei rispettivi licenzianti e sono protetti dalle leggi sul diritto d'autore.</p>
            <p>È consentito:</p>
            <ul>
                <li>Consultare e utilizzare i contenuti a scopo personale e non commerciale</li>
                <li>Condividere link alle pagine del Sito</li>
            </ul>
            <p>Non è consentito senza autorizzazione scritta:</p>
            <ul>
                <li>Riprodurre, distribuire o modificare i contenuti a scopo commerciale</li>
                <li>Utilizzare il marchio Instagarda o il logo senza autorizzazione</li>
            </ul>

            <h2>6. Contenuti di terze parti</h2>
            <p>Il Sito può contenere link a siti web di terze parti. Instagarda non è responsabile dei contenuti, delle politiche sulla privacy o delle pratiche di tali siti. La visita di siti esterni avviene sotto la responsabilità dell'utente.</p>

            <h2>7. Directory strutture</h2>
            <p>Le informazioni sulle strutture presenti nella directory (orari, prezzi, disponibilità) sono fornite a titolo indicativo. Instagarda si impegna a mantenerle aggiornate ma non garantisce la loro esattezza in tempo reale. Si consiglia di verificare direttamente con le strutture prima di prenotare.</p>

            <h2>8. Limitazione di responsabilità</h2>
            <p>Instagarda non è responsabile per:</p>
            <ul>
                <li>Danni diretti o indiretti derivanti dall'uso del Sito o dall'impossibilità di utilizzarlo</li>
                <li>Imprecisioni nelle informazioni fornite dall'assistente AI o dalla directory</li>
                <li>Interruzioni temporanee del servizio per manutenzione o cause di forza maggiore</li>
                <li>Contenuti di siti web di terze parti raggiungibili tramite link dal Sito</li>
            </ul>

            <h2>9. Modifiche ai termini</h2>
            <p>Ci riserviamo il diritto di modificare questi Termini di Servizio in qualsiasi momento. Le modifiche saranno pubblicate su questa pagina. L'uso continuato del Sito dopo la pubblicazione delle modifiche costituisce accettazione dei nuovi termini.</p>

            <h2>10. Legge applicabile</h2>
            <p>I presenti Termini di Servizio sono regolati dalla legge italiana. Per qualsiasi controversia sarà competente il Foro di Brescia.</p>

            <h2>11. Contatti</h2>
            <p>Per domande su questi termini: <a href="mailto:info@instagarda.net">info@instagarda.net</a> oppure visita la <a href="<?php echo esc_url(home_url('/contatti/')); ?>">pagina contatti</a>.</p>

        </div>
    </div>
</section>

<?php get_footer(); ?>
