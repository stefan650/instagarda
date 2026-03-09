<?php get_header(); ?>

<section class="ig-dest-hero">
    <div class="ig-dest-hero__bg">
        <video class="ig-dest-hero__video ig-dest-hero__video--desktop" autoplay muted loop playsinline>
            <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/destinazioni-hero.mp4'); ?>" type="video/mp4">
        </video>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <h1 class="ig-dest-hero__title">Destinazioni</h1>
        </div>
    </div>
</section>

<!-- Mappa Interattiva + Preview -->
<section class="ig-section ig-section--white">
    <div class="ig-container">
        <div class="ig-map-explorer">
            <!-- Left: Map -->
            <div class="ig-map-explorer__map">
                <div class="ig-svg-map ig-svg-map--transparent">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/maps/lago-garda.png'); ?>" alt="Lago di Garda" class="ig-svg-map__img">
                    <?php
                    $pin_positions = [
                        'sirmione'            => ['28%', '24%'],
                        'desenzano-del-garda' => ['8%', '32%'],
                        'salo'                => ['20%', '35%'],
                        'gardone-riviera'     => ['28%', '55%'],
                        'toscolano-maderno'   => ['35%', '45%'],
                        'gargnano'            => ['32%', '55%'],
                        'limone-sul-garda'    => ['71%', '82%'],
                        'tremosine-sul-garda' => ['70%', '85%'],
                        'peschiera-del-garda' => ['55%', '20%'],
                        'lazise'              => ['63%', '30%'],
                        'bardolino'           => ['62%', '37%'],
                        'garda'               => ['65%', '48%'],
                        'torri-del-benaco'    => ['58%', '65%'],
                        'malcesine'           => ['80%', '76%'],
                        'brenzone-sul-garda'  => ['60%', '70%'],
                        'riva-del-garda'      => ['82%', '91%'],
                        'torbole'             => ['90%', '88%'],
                        'arco'                => ['90%', '95%'],
                        'manerba-del-garda'   => ['15%', '38%'],
                    ];
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
                                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'card-wide') ?: '';
                                $excerpt = wp_trim_words(get_the_excerpt(), 20, '…');
                                $link = get_the_permalink();
                    ?>
                    <a href="<?php echo esc_url($link); ?>"
                       class="ig-svg-map__pin"
                       style="left:<?php echo esc_attr($pl); ?>;bottom:<?php echo esc_attr($pb); ?>"
                       data-title="<?php the_title_attribute(); ?>"
                       data-thumb="<?php echo esc_attr($thumb_url); ?>"
                       data-excerpt="<?php echo esc_attr($excerpt); ?>"
                       data-link="<?php echo esc_url($link); ?>">
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

            <!-- Right: Preview Panel -->
            <?php
            // Random default preview
            $random_dest = new WP_Query([
                'post_type' => 'destinazione',
                'posts_per_page' => 1,
                'orderby' => 'rand',
                'meta_query' => [['key' => '_thumbnail_id', 'compare' => 'EXISTS']],
            ]);
            $default_thumb = '';
            $default_excerpt = '';
            $default_link = '#';
            $default_title = '';
            if ($random_dest->have_posts()):
                $random_dest->the_post();
                $default_thumb = get_the_post_thumbnail_url(get_the_ID(), 'card-wide') ?: '';
                $default_excerpt = wp_trim_words(get_the_excerpt(), 20, '…');
                $default_link = get_permalink();
                $default_title = get_the_title();
                wp_reset_postdata();
            endif;
            ?>
            <div class="ig-map-explorer__preview" id="igMapPreview">
                <div class="ig-map-explorer__card" id="igMapCard">
                    <div class="ig-map-explorer__card-img" id="igMapCardImg" style="<?php if ($default_thumb): ?>background-image:url(<?php echo esc_url($default_thumb); ?>)<?php endif; ?>"></div>
                    <div class="ig-map-explorer__card-body">
                        <h3 class="ig-map-explorer__card-title" id="igMapCardTitle"><?php echo esc_html($default_title); ?></h3>
                        <p class="ig-map-explorer__card-desc" id="igMapCardDesc"><?php echo esc_html($default_excerpt); ?></p>
                        <a href="<?php echo esc_url($default_link); ?>" class="ig-btn ig-btn--glass" id="igMapCardBtn">Scopri <?php echo esc_html($default_title); ?> →</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ig-text-center" style="margin-top:24px">
            <button class="ig-map-explorer__scroll-cta" onclick="document.getElementById('ig-dest-grid').scrollIntoView({behavior:'smooth',block:'start'})">
                Vedi tutte le destinazioni
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    var pins = document.querySelectorAll('.ig-svg-map__pin');
    var cardImg = document.getElementById('igMapCardImg');
    var cardTitle = document.getElementById('igMapCardTitle');
    var cardDesc = document.getElementById('igMapCardDesc');
    var cardBtn = document.getElementById('igMapCardBtn');
    var card = document.getElementById('igMapCard');

    pins.forEach(function(pin) {
        pin.addEventListener('mouseenter', function() {
            var title = pin.getAttribute('data-title');
            var thumb = pin.getAttribute('data-thumb');
            var excerpt = pin.getAttribute('data-excerpt');
            var link = pin.getAttribute('data-link');

            cardTitle.textContent = title;
            cardDesc.textContent = excerpt;
            cardBtn.href = link;
            cardBtn.textContent = 'Scopri ' + title + ' →';

            if (thumb) {
                cardImg.style.backgroundImage = 'url(' + thumb + ')';
                cardImg.style.display = 'block';
            } else {
                cardImg.style.display = 'none';
            }

            // Animate card
            card.style.animation = 'none';
            card.offsetHeight;
            card.style.animation = 'igFadeIn 0.25s ease';

            pins.forEach(function(p) { p.classList.remove('is-active'); });
            pin.classList.add('is-active');
        });
    });
});
</script>

<?php get_footer(); ?>
