<?php get_header(); ?>

<section class="ig-section ig-section--light ig-404">
    <div class="ig-404__inner">
        <div class="ig-404__icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#007AFF" stroke-width="1.5">
                <path d="M1 22s2-4 6.5-4c1.5 0 3.2.6 4.5 1.2 1.3.6 3 1.2 4.5 1.2C21 20.4 23 16 23 16"/>
                <path d="M1 16s2-4 6.5-4c1.5 0 3.2.6 4.5 1.2 1.3.6 3 1.2 4.5 1.2C21 14.4 23 10 23 10"/>
            </svg>
        </div>
        <h1 class="ig-404__title">Pagina non trovata</h1>
        <p class="ig-404__desc">Sembra che questa pagina sia stata portata via dalla corrente del lago.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="ig-btn ig-btn--primary ig-btn--lg">Torna alla Homepage</a>
    </div>
</section>

<?php get_footer(); ?>
