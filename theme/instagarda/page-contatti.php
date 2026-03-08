<?php
/**
 * Template Name: Pagina Contatti
 */
get_header();
?>

<!-- Hero -->
<section class="ig-mini-hero ig-mini-hero--contatti">
    <div class="ig-mini-hero__content">
        <div class="ig-mini-hero__badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            Contatti
        </div>
        <h1 class="ig-mini-hero__title">Parliamo</h1>
        <p class="ig-mini-hero__desc">Hai una domanda, un'idea o vuoi collaborare? Siamo qui per te.</p>
    </div>
</section>

<!-- Contatti -->
<section class="ig-section ig-section--white ig-reveal">
    <div class="ig-container">
        <div class="ig-contact-grid">

            <!-- Info -->
            <div class="ig-contact-info">
                <div class="ig-contact-info__item">
                    <div class="ig-contact-info__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                        <h4>Email</h4>
                        <a href="mailto:info@instagarda.net">info@instagarda.net</a>
                    </div>
                </div>
                <div class="ig-contact-info__item">
                    <div class="ig-contact-info__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </div>
                    <div>
                        <h4>Instagram</h4>
                        <a href="https://instagram.com/instagarda" target="_blank" rel="noopener noreferrer">@instagarda — 619K follower</a>
                    </div>
                </div>
                <div class="ig-contact-info__item">
                    <div class="ig-contact-info__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12.53.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                    </div>
                    <div>
                        <h4>TikTok</h4>
                        <a href="https://tiktok.com/@instagarda" target="_blank" rel="noopener noreferrer">@instagarda — 176K follower</a>
                    </div>
                </div>
                <div class="ig-contact-info__item">
                    <div class="ig-contact-info__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <h4>Zona</h4>
                        <p>Lago di Garda, Italia</p>
                    </div>
                </div>
                <div class="ig-contact-info__cta">
                    <p>Vuoi una risposta immediata? Chiedi al nostro AI:</p>
                    <button class="ig-btn ig-btn--primary ig-btn--lg" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                        Chiedi a Garda AI
                    </button>
                </div>
            </div>

            <!-- Form -->
            <div class="ig-contact-form-card">
                <form class="ig-contact-form" action="#" method="post">
                    <div class="ig-contact-form__row">
                        <div class="ig-contact-form__field">
                            <label for="cf-name">Nome</label>
                            <input type="text" id="cf-name" name="name" placeholder="Il tuo nome" required>
                        </div>
                        <div class="ig-contact-form__field">
                            <label for="cf-email">Email</label>
                            <input type="email" id="cf-email" name="email" placeholder="nome@email.com" required>
                        </div>
                    </div>
                    <div class="ig-contact-form__field">
                        <label for="cf-subject">Oggetto</label>
                        <select id="cf-subject" name="subject">
                            <option value="info">Informazioni generali</option>
                            <option value="partner">Diventa partner</option>
                            <option value="press">Stampa / Media</option>
                            <option value="bug">Segnala un problema</option>
                            <option value="altro">Altro</option>
                        </select>
                    </div>
                    <div class="ig-contact-form__field">
                        <label for="cf-message">Messaggio</label>
                        <textarea id="cf-message" name="message" rows="5" placeholder="Scrivi il tuo messaggio..." required></textarea>
                    </div>
                    <button type="submit" class="ig-btn ig-btn--primary ig-btn--lg ig-btn--block">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Invia messaggio
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<!-- FAQ -->
<section class="ig-section ig-section--light ig-reveal">
    <div class="ig-container" style="max-width:800px">
        <div class="ig-section__header">
            <h2 class="ig-section__title">Domande frequenti</h2>
        </div>
        <div class="ig-faq">
            <details class="ig-faq__item">
                <summary class="ig-faq__question">Come posso segnalare la mia struttura su Instagarda?</summary>
                <div class="ig-faq__answer">
                    <p>Compila il modulo contatti selezionando "Diventa partner" come oggetto. Il nostro team ti contatterà entro 48 ore per discutere le opzioni di inserimento nella directory.</p>
                </div>
            </details>
            <details class="ig-faq__item">
                <summary class="ig-faq__question">Garda AI è gratuito?</summary>
                <div class="ig-faq__answer">
                    <p>Sì, l'assistente AI è completamente gratuito per tutti i visitatori del sito. Puoi fare tutte le domande che vuoi sul Lago di Garda, 24 ore su 24.</p>
                </div>
            </details>
            <details class="ig-faq__item">
                <summary class="ig-faq__question">Le informazioni sono aggiornate?</summary>
                <div class="ig-faq__answer">
                    <p>Il nostro team e il sistema AI aggiornano costantemente le informazioni. Orari, prezzi ed eventi vengono verificati regolarmente. Se trovi un dato non aggiornato, segnalacelo.</p>
                </div>
            </details>
            <details class="ig-faq__item">
                <summary class="ig-faq__question">Posso collaborare come content creator?</summary>
                <div class="ig-faq__answer">
                    <p>Cerchiamo sempre fotografi, videomaker e scrittori appassionati del Lago di Garda. Inviaci il tuo portfolio tramite il modulo contatti e valuteremo insieme le opportunità.</p>
                </div>
            </details>
        </div>
    </div>
</section>

<?php get_footer(); ?>
