<?php
/**
 * Template Name: Pagina Progetto
 * Template for: Il Progetto + Contatti
 */
get_header();
?>

<!-- Hero -->
<section class="ig-page-hero">
    <div class="ig-page-hero__bg ig-page-hero__bg--gradient"></div>
    <div class="ig-page-hero__content">
        <div class="ig-container">
            <span class="ig-page-hero__badge">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                Il Progetto
            </span>
            <h1 class="ig-page-hero__title">Instagarda</h1>
            <p class="ig-page-hero__sub">La guida intelligente al Lago di Garda, potenziata dall'intelligenza artificiale</p>
        </div>
    </div>
</section>

<!-- Mission -->
<section class="ig-section ig-section--white">
    <div class="ig-container" style="max-width:800px">
        <div class="ig-prose">
            <h2>La nostra missione</h2>
            <p>Instagarda nasce con un obiettivo ambizioso: creare la guida definitiva al Lago di Garda, combinando la profonda conoscenza del territorio con le tecnologie più avanzate di intelligenza artificiale.</p>
            <p>Il Lago di Garda è il lago più grande d'Italia e una delle destinazioni turistiche più amate d'Europa, con oltre 25 milioni di visitatori all'anno. Eppure, trovare informazioni complete, aggiornate e affidabili resta ancora una sfida. Noi vogliamo cambiare questo.</p>
        </div>
    </div>
</section>

<!-- Come funziona -->
<section class="ig-section ig-section--light ig-reveal">
    <div class="ig-container">
        <div class="ig-section__header">
            <h2 class="ig-section__title">Come funziona</h2>
        </div>
        <div class="ig-features-grid">
            <div class="ig-feature-card">
                <div class="ig-feature-card__icon ig-feature-card__icon--blue">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <h3 class="ig-feature-card__title">Garda AI</h3>
                <p class="ig-feature-card__desc">Il nostro assistente AI conosce ogni angolo del Lago di Garda. Chiedigli qualsiasi cosa: dove mangiare, cosa vedere, come arrivare. Risponde in tempo reale, 24/7.</p>
            </div>
            <div class="ig-feature-card">
                <div class="ig-feature-card__icon ig-feature-card__icon--violet">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h3 class="ig-feature-card__title">18 Destinazioni</h3>
                <p class="ig-feature-card__desc">Guide dettagliate per ogni paese del Garda: storia, attrazioni, dove dormire, dove mangiare, attività. Tutto in un unico posto, sempre aggiornato.</p>
            </div>
            <div class="ig-feature-card">
                <div class="ig-feature-card__icon ig-feature-card__icon--emerald">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <h3 class="ig-feature-card__title">Directory Strutture</h3>
                <p class="ig-feature-card__desc">Hotel, ristoranti, attività e attrazioni: il nostro database in continua crescita raccoglie le migliori strutture del territorio con informazioni verificate.</p>
            </div>
            <div class="ig-feature-card">
                <div class="ig-feature-card__icon ig-feature-card__icon--orange">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                </div>
                <h3 class="ig-feature-card__title">Sempre Aggiornato</h3>
                <p class="ig-feature-card__desc">Eventi, novità, aperture stagionali: il nostro sistema RAG aggiorna costantemente le informazioni per offrirti sempre dati freschi e affidabili.</p>
            </div>
        </div>
    </div>
</section>

<!-- Tecnologia -->
<section class="ig-section ig-section--white ig-reveal">
    <div class="ig-container" style="max-width:800px">
        <div class="ig-prose">
            <h2>La tecnologia dietro Instagarda</h2>
            <p>Instagarda utilizza un sistema <strong>RAG (Retrieval-Augmented Generation)</strong> che combina un vasto database di conoscenze sul Lago di Garda con modelli di linguaggio avanzati. Questo significa che le risposte del nostro AI non sono generiche, ma basate su informazioni reali, verificate e specifiche del territorio.</p>
            <p>Il sistema è progettato come piattaforma <strong>SaaS multi-tenant</strong>: la stessa tecnologia che alimenta Instagarda potrà essere utilizzata da altre destinazioni turistiche, creando assistenti AI personalizzati per qualsiasi territorio.</p>
        </div>
    </div>
</section>

<!-- Roadmap -->
<section class="ig-section ig-section--light ig-reveal">
    <div class="ig-container" style="max-width:800px">
        <div class="ig-section__header" style="text-align:left">
            <h2 class="ig-section__title">Roadmap</h2>
        </div>
        <div class="ig-roadmap">
            <div class="ig-roadmap__item ig-roadmap__item--done">
                <div class="ig-roadmap__marker"></div>
                <div class="ig-roadmap__content">
                    <span class="ig-roadmap__phase">Fase 1</span>
                    <h3>Sistema RAG & Sito Web</h3>
                    <p>Database di conoscenze, assistente AI, sito web con 18 destinazioni e directory strutture.</p>
                </div>
            </div>
            <div class="ig-roadmap__item">
                <div class="ig-roadmap__marker"></div>
                <div class="ig-roadmap__content">
                    <span class="ig-roadmap__phase">Fase 2</span>
                    <h3>Endpoint WhatsApp</h3>
                    <p>Garda AI accessibile direttamente su WhatsApp per assistenza istantanea ai turisti.</p>
                </div>
            </div>
            <div class="ig-roadmap__item">
                <div class="ig-roadmap__marker"></div>
                <div class="ig-roadmap__content">
                    <span class="ig-roadmap__phase">Fase 3</span>
                    <h3>Pannello Admin</h3>
                    <p>Dashboard per le strutture partner per gestire profili, offerte e analytics.</p>
                </div>
            </div>
            <div class="ig-roadmap__item">
                <div class="ig-roadmap__marker"></div>
                <div class="ig-roadmap__content">
                    <span class="ig-roadmap__phase">Fase 4</span>
                    <h3>Multi-tenant SaaS</h3>
                    <p>Piattaforma disponibile per altre destinazioni turistiche in Italia e nel mondo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="ig-section ig-section--white ig-reveal">
    <div class="ig-container" style="max-width:800px">
        <div class="ig-prose" style="text-align:center">
            <h2>Chi siamo</h2>
            <p>Instagarda è un progetto nato dalla passione per il Lago di Garda e per la tecnologia. Combiniamo competenze in sviluppo software, intelligenza artificiale e marketing digitale per creare qualcosa di unico nel panorama turistico italiano.</p>
        </div>
    </div>
</section>

<!-- Contatti -->
<section class="ig-section ig-section--light ig-reveal" id="contatti">
    <div class="ig-container">
        <div class="ig-section__header">
            <h2 class="ig-section__title">Contattaci</h2>
            <p class="ig-section__subtitle">Hai domande sul progetto, vuoi collaborare o sei una struttura interessata? Scrivici!</p>
        </div>
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
                        <a href="https://instagram.com/instagarda" target="_blank" rel="noopener noreferrer">@instagarda</a>
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
                    <p>Oppure chiedi direttamente al nostro AI:</p>
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

<?php get_footer(); ?>
