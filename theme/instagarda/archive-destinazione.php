<?php get_header(); ?>

<section class="ig-mini-hero">
    <div class="ig-mini-hero__content">
        <div class="ig-mini-hero__badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo $wp_query->found_posts; ?> destinazioni
        </div>
        <h1 class="ig-mini-hero__title">Destinazioni del <span>Lago di Garda</span></h1>
        <p class="ig-mini-hero__desc">Esplora ogni angolo del lago più bello d'Italia</p>
    </div>
</section>

<!-- Mappa SVG con Pin -->
<section class="ig-section ig-section--white ig-section--compact">
    <div class="ig-container">
        <div class="ig-svg-map">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/maps/lago-garda.png'); ?>" alt="Lago di Garda" class="ig-svg-map__img">
            <?php
            $pin_positions = [
                'sirmione'            => ['28%', '24%'],
                'desenzano-del-garda' => ['8%', '22%'],
                'salo'                => ['20%', '35%'],
                'gardone-riviera'     => ['28%', '55%'],
                'toscolano-maderno'   => ['35%', '45%'],
                'gargnano'            => ['32%', '55%'],
                'limone-sul-garda'    => ['61%', '67%'],
                'tremosine-sul-garda' => ['60%', '70%'],
                'peschiera-del-garda' => ['25%', '10%'],
                'lazise'              => ['63%', '30%'],
                'bardolino'           => ['62%', '37%'],
                'garda'               => ['65%', '48%'],
                'torri-del-benaco'    => ['48%', '45%'],
                'malcesine'           => ['70%', '66%'],
                'brenzone-sul-garda'  => ['55%', '55%'],
                'riva-del-garda'      => ['82%', '91%'],
                'torbole'             => ['85%', '88%'],
                'arco'                => ['90%', '95%'],
                'manerba-del-garda'   => ['15%', '38%'],
                'castelnuovo-del-garda'=> ['70%', '8%'],
                'valeggio-sul-mincio' => ['40%', '0%'],
            ];
            // Collect all posts for pins
            $all_dests = new WP_Query([
                'post_type' => 'destinazione',
                'posts_per_page' => -1,
            ]);
            if ($all_dests->have_posts()):
                while ($all_dests->have_posts()): $all_dests->the_post();
                    $slug = get_post_field('post_name', get_the_ID());
                    if (isset($pin_positions[$slug])):
                        $pl = $pin_positions[$slug][0];
                        $pb = $pin_positions[$slug][1];
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-svg-map__pin" style="left:<?php echo esc_attr($pl); ?>;bottom:<?php echo esc_attr($pb); ?>" title="<?php the_title_attribute(); ?>">
                <svg width="18" height="24" viewBox="0 0 32 42" fill="none"><path d="M16 0C7.163 0 0 7.163 0 16c0 12 16 26 16 26s16-14 16-26C32 7.163 24.837 0 16 0z" fill="#E53E3E"/><circle cx="16" cy="16" r="6" fill="white"/></svg>
                <span class="ig-svg-map__label"><?php the_title(); ?></span>
            </a>
            <?php
                    endif;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<section class="ig-section ig-section--light">
    <div class="ig-container">
        <div class="ig-section__header" style="text-align: center; margin-bottom: 2rem;">
            <h2 class="ig-section__title">Esplora i Comuni</h2>
            <p class="ig-section__desc">Clicca sulla mappa o scegli dalla lista</p>
        </div>
        <div class="ig-dest-grid" id="ig-dest-grid">
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
