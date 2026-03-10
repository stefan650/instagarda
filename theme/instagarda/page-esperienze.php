<?php
/**
 * Template Name: Esperienze
 */
get_header();
?>

<section class="ig-dest-hero">
    <div class="ig-dest-hero__bg">
        <?php if (has_post_thumbnail()):
            the_post_thumbnail('hero');
        else: ?>
            <div class="ig-placeholder-img">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
            </div>
        <?php endif; ?>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <h1 class="ig-dest-hero__title">Esperienze</h1>
            <p class="ig-dest-hero__sub" style="color:rgba(255,255,255,.85);font-size:1.125rem;margin-top:8px">Tutto quello che puoi vivere sul Lago di Garda</p>
        </div>
    </div>
</section>

<!-- Categorie principali -->
<section class="ig-apple-section ig-apple-section--white">
    <div class="ig-apple-container">
        <div class="ig-exp-grid">

            <a href="<?php echo esc_url(home_url('/esperienze/attivita/')); ?>" class="ig-exp-card">
                <div class="ig-exp-card__visual ig-exp-card__visual--attivita">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                </div>
                <div class="ig-exp-card__body">
                    <h2 class="ig-exp-card__title">Attività & Tour</h2>
                    <p class="ig-exp-card__desc">Sport acquatici, escursioni, bike tour, gite in barca e avventure all'aria aperta</p>
                    <span class="ig-exp-card__link">Scopri le attività <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></span>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/esperienze/cultura/')); ?>" class="ig-exp-card">
                <div class="ig-exp-card__visual ig-exp-card__visual--cultura">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 21v-4h6v4"/><path d="M9 10h1"/><path d="M14 10h1"/><path d="M9 14h1"/><path d="M14 14h1"/></svg>
                </div>
                <div class="ig-exp-card__body">
                    <h2 class="ig-exp-card__title">Cultura & Musei</h2>
                    <p class="ig-exp-card__desc">Castelli, ville storiche, musei, chiese e il patrimonio artistico del lago</p>
                    <span class="ig-exp-card__link">Esplora la cultura <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></span>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/eventi/')); ?>" class="ig-exp-card">
                <div class="ig-exp-card__visual ig-exp-card__visual--eventi">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div class="ig-exp-card__body">
                    <h2 class="ig-exp-card__title">Eventi</h2>
                    <p class="ig-exp-card__desc">Sagre, concerti, regate, mercatini e tutti gli appuntamenti da non perdere</p>
                    <span class="ig-exp-card__link">Vedi gli eventi <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></span>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/esperienze/ristoranti/')); ?>" class="ig-exp-card">
                <div class="ig-exp-card__visual ig-exp-card__visual--mangiare">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                </div>
                <div class="ig-exp-card__body">
                    <h2 class="ig-exp-card__title">Ristoranti</h2>
                    <p class="ig-exp-card__desc">Trattorie tipiche, ristoranti gourmet, pizzerie e cucina di lago</p>
                    <span class="ig-exp-card__link">Trova un ristorante <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></span>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/esperienze/soggiorni/')); ?>" class="ig-exp-card">
                <div class="ig-exp-card__visual ig-exp-card__visual--dormire">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
                </div>
                <div class="ig-exp-card__body">
                    <h2 class="ig-exp-card__title">Soggiorni</h2>
                    <p class="ig-exp-card__desc">Hotel, B&B, appartamenti, agriturismi e campeggi con vista lago</p>
                    <span class="ig-exp-card__link">Trova un alloggio <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></span>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/esperienze/bar-nightlife/')); ?>" class="ig-exp-card">
                <div class="ig-exp-card__visual ig-exp-card__visual--bar">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 2h8l-4 9V22"/><path d="M4 2h16"/><path d="M7 22h10"/></svg>
                </div>
                <div class="ig-exp-card__body">
                    <h2 class="ig-exp-card__title">Bar & Nightlife</h2>
                    <p class="ig-exp-card__desc">Aperitivi al tramonto, cocktail bar, locali notturni e vita serale</p>
                    <span class="ig-exp-card__link">Scopri i locali <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></span>
                </div>
            </a>

        </div>
    </div>
</section>

<!-- CTA Garda AI -->
<section class="ig-apple-section ig-apple-section--cta">
    <div class="ig-apple-container ig-text-center">
        <h2 class="ig-apple-title ig-apple-title--white">Non sai da dove iniziare?</h2>
        <p class="ig-apple-subtitle ig-apple-subtitle--white">Raccontaci cosa ti piace e il nostro assistente AI ti aiuterà a pianificare la giornata perfetta.</p>
        <button class="ig-btn ig-btn--glass-outline ig-btn--lg" style="margin-top:var(--sp-lg)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Chiedi a Garda AI
        </button>
    </div>
</section>

<?php get_footer(); ?>
