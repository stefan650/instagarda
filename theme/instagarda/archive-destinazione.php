<?php get_header(); ?>

<section class="ig-mini-hero">
    <div class="ig-mini-hero__content">
        <div class="ig-mini-hero__badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo $wp_query->found_posts; ?> luoghi
        </div>
        <h1 class="ig-mini-hero__title">Luoghi del <span>Lago di Garda</span></h1>
        <p class="ig-mini-hero__desc">Esplora ogni angolo del lago più bello d'Italia</p>
    </div>
</section>

<section class="ig-section ig-section--light">
    <div class="ig-container">
        <div class="ig-dest-grid">
            <?php
            $regions = ['lombardia' => 'Lombardia', 'veneto' => 'Veneto', 'trentino' => 'Trentino'];
            if (have_posts()): while (have_posts()): the_post();
                $region   = ig_get_meta('regione');
                $subtitle = ig_get_meta('subtitle');
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-dest-card">
                <div class="ig-dest-card__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card');
                    else: ?>
                        <div class="ig-placeholder-img">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="ig-dest-card__content">
                    <h3 class="ig-dest-card__title"><?php the_title(); ?></h3>
                    <?php if ($subtitle): ?>
                        <p class="ig-dest-card__tagline"><?php echo esc_html($subtitle); ?></p>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; else: ?>
                <div class="ig-text-center" style="grid-column:1/-1;padding:var(--sp-3xl) 0">
                    <p class="ig-404__desc">Nessun luogo trovato.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="ig-text-center ig-mt-xl">
            <?php the_posts_pagination(['prev_text' => '&larr;', 'next_text' => '&rarr;']); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
