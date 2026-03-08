<?php get_header(); ?>

<?php while (have_posts()): the_post();
    $tipo     = get_the_terms(get_the_ID(), 'tipo_struttura');
    $loc      = get_the_terms(get_the_ID(), 'localita');
    $indirizzo = ig_get_meta('indirizzo');
    $telefono  = ig_get_meta('telefono');
    $email     = ig_get_meta('email');
    $website   = ig_get_meta('website');
    $prezzo    = ig_get_meta('prezzo');
    $orari     = ig_get_meta('orari');
    $prezzi    = ['1' => '€', '2' => '€€', '3' => '€€€', '4' => '€€€€'];
?>

<section class="ig-dest-hero" style="height:45vh; min-height:300px">
    <div class="ig-dest-hero__bg">
        <?php if (has_post_thumbnail()): the_post_thumbnail('hero'); endif; ?>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <?php if ($tipo && !is_wp_error($tipo)): ?>
                <span class="ig-dest-hero__region"><?php echo esc_html($tipo[0]->name); ?></span>
            <?php endif; ?>
            <h1 class="ig-dest-hero__title"><?php the_title(); ?></h1>
            <?php if ($loc && !is_wp_error($loc)): ?>
                <p class="ig-dest-hero__sub"><?php echo esc_html($loc[0]->name); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="ig-section ig-section--light">
    <div class="ig-container">
        <div class="ig-dest-content">
            <div class="ig-dest-content__main">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <aside class="ig-dest-sidebar">
                <div class="ig-dest-sidebar__card">
                    <h3>Informazioni</h3>
                    <ul class="ig-highlights">
                        <?php if ($indirizzo): ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ig-primary)" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <?php echo esc_html($indirizzo); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ($telefono): ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ig-primary)" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                            <a href="tel:<?php echo esc_attr($telefono); ?>"><?php echo esc_html($telefono); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if ($email): ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ig-primary)" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if ($website): ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ig-primary)" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
                            <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener noreferrer">Sito web</a>
                        </li>
                        <?php endif; ?>
                        <?php if ($orari): ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ig-primary)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <?php echo esc_html($orari); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ($prezzo && isset($prezzi[$prezzo])): ?>
                        <li>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ig-primary)" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                            Fascia prezzo: <?php echo $prezzi[$prezzo]; ?>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <div style="margin-top:var(--sp-lg)">
                        <button class="ig-btn ig-btn--primary" style="width:100%" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                            Chiedi info
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
