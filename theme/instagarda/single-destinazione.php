<?php get_header(); ?>

<?php while (have_posts()): the_post();
    $region     = ig_get_meta('regione');
    $subtitle   = ig_get_meta('subtitle');
    $highlights = ig_get_meta('highlights');
    $map_lat    = ig_get_meta('map_lat');
    $map_lng    = ig_get_meta('map_lng');

    // Fallback coordinates per destinazione
    if (!$map_lat || !$map_lng) {
        $coords = [
            'sirmione'            => [45.4964, 10.6079],
            'desenzano-del-garda' => [45.4711, 10.5374],
            'salo'                => [45.6069, 10.5214],
            'gardone-riviera'     => [45.6219, 10.5594],
            'toscolano-maderno'   => [45.6394, 10.6097],
            'gargnano'            => [45.6844, 10.6606],
            'limone-sul-garda'    => [45.8126, 10.7918],
            'tremosine-sul-garda' => [45.7658, 10.7528],
            'peschiera-del-garda' => [45.4387, 10.6919],
            'lazise'              => [45.5050, 10.7320],
            'bardolino'           => [45.5458, 10.7228],
            'garda'               => [45.5749, 10.7089],
            'torri-del-benaco'    => [45.6097, 10.6878],
            'malcesine'           => [45.7636, 10.8107],
            'brenzone-sul-garda'  => [45.7022, 10.7620],
            'riva-del-garda'      => [45.8862, 10.8412],
            'torbole'             => [45.8748, 10.8739],
            'arco'                => [45.9178, 10.8854],
        ];
        $slug = get_post_field('post_name', get_the_ID());
        if (isset($coords[$slug])) {
            $map_lat = $coords[$slug][0];
            $map_lng = $coords[$slug][1];
        }
    }
?>

<!-- Hero -->
<?php
    $hero_video = ig_get_meta('hero_video');
    $hero_video_mobile = ig_get_meta('hero_video_mobile');
?>
<section class="ig-dest-hero">
    <div class="ig-dest-hero__bg">
        <?php if ($hero_video): ?>
            <video class="ig-dest-hero__video ig-dest-hero__video--desktop" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $hero_video); ?>" type="video/mp4">
            </video>
            <?php if ($hero_video_mobile): ?>
            <video class="ig-dest-hero__video ig-dest-hero__video--mobile" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $hero_video_mobile); ?>" type="video/mp4">
            </video>
            <?php endif; ?>
        <?php elseif (has_post_thumbnail()): the_post_thumbnail('hero');
        else: ?>
            <div class="ig-placeholder-img">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
        <?php endif; ?>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <h1 class="ig-dest-hero__title"><?php the_title(); ?></h1>
            <?php if ($subtitle): ?>
                <p class="ig-dest-hero__sub"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- Intro / Description -->
<section class="ig-section ig-section--white ig-section--compact">
    <div class="ig-container">
        <div class="ig-dest-intro-row">
            <?php if ($map_lat && $map_lng): ?>
            <div class="ig-dest-map">
                <div id="ig-dest-map" data-lat="<?php echo esc_attr($map_lat); ?>" data-lng="<?php echo esc_attr($map_lng); ?>"></div>
            </div>
            <?php endif; ?>
            <div class="ig-dest-intro entry-content">
                <?php
                // Show only first paragraph for compact intro
                $full = apply_filters('the_content', get_the_content());
                preg_match('/<p[^>]*>.*?<\/p>/s', $full, $first_p);
                echo $first_p[0] ?? $full;
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Cosa Vedere -->
<?php
require_once get_template_directory() . '/inc/attrazioni-data.php';
$attrazioni_db = ig_get_attrazioni();
$slug = get_post_field('post_name', get_the_ID());
$attrazioni = $attrazioni_db[$slug] ?? [];

if (!empty($attrazioni)):
?>
<section class="ig-section ig-section--light ig-reveal">
    <div class="ig-container">
        <div class="ig-section__header">
            <h2 class="ig-section__title">Cosa Vedere</h2>
            <p class="ig-section__desc">Le attrazioni principali di <?php the_title(); ?></p>
        </div>

        <div class="ig-poi-carousel">
            <div class="ig-poi-carousel__track" id="igPoiTrack">
                <?php foreach ($attrazioni as $i => $att): ?>
                <article class="ig-poi-card" data-index="<?php echo $i; ?>">
                    <div class="ig-poi-card__visual">
                        <div class="ig-placeholder-img">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                    </div>
                    <div class="ig-poi-card__overlay">
                        <span class="ig-poi-card__label">Attrazione</span>
                        <h3 class="ig-poi-card__title"><?php echo esc_html($att['name']); ?></h3>
                    </div>
                    <button class="ig-poi-card__expand" aria-label="Scopri <?php echo esc_attr($att['name']); ?>" data-poi="<?php echo $i; ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </button>
                </article>
                <?php endforeach; ?>
            </div>
            <div class="ig-poi-carousel__nav">
                <button class="ig-poi-carousel__btn" id="igPoiPrev" aria-label="Precedente">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <button class="ig-poi-carousel__btn" id="igPoiNext" aria-label="Successivo">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 6 15 12 9 18"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- POI Detail Panels -->
<?php foreach ($attrazioni as $i => $att): ?>
<div class="ig-poi-panel" id="igPoiPanel<?php echo $i; ?>" aria-hidden="true">
    <div class="ig-poi-panel__inner">
        <button class="ig-poi-panel__close" aria-label="Chiudi">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <div class="ig-poi-panel__header">
            <span class="ig-poi-panel__label">Attrazione</span>
            <h2 class="ig-poi-panel__title"><?php echo esc_html($att['name']); ?></h2>
        </div>
        <div class="ig-poi-panel__content">
            <div class="ig-poi-panel__block">
                <p class="ig-poi-panel__excerpt"><strong><?php echo esc_html($att['excerpt']); ?></strong> <?php echo esc_html($att['desc']); ?></p>
            </div>
            <div class="ig-poi-panel__block ig-poi-panel__block--img">
                <div class="ig-placeholder-img" style="height:360px;border-radius:20px">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php endif; ?>

<!-- Strutture correlate -->
<?php
$loc_terms = get_the_terms(get_the_ID(), 'localita');
if ($loc_terms && !is_wp_error($loc_terms)):
    $strutture = new WP_Query([
        'post_type' => 'struttura',
        'posts_per_page' => 3,
        'tax_query' => [[
            'taxonomy' => 'localita',
            'terms'    => wp_list_pluck($loc_terms, 'term_id'),
        ]],
    ]);
    if ($strutture->have_posts()):
?>
<section class="ig-section ig-section--white ig-reveal">
    <div class="ig-container">
        <div class="ig-section__header" style="text-align:left">
            <h2 class="ig-section__title">Strutture a <?php the_title(); ?></h2>
        </div>
        <div class="ig-archive-grid">
            <?php while ($strutture->have_posts()): $strutture->the_post();
                $tipo = get_the_terms(get_the_ID(), 'tipo_struttura');
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-listing-card">
                <div class="ig-listing-card__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card-wide');
                    else: ?>
                        <div class="ig-placeholder-img">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
                        </div>
                    <?php endif; ?>
                    <?php if ($tipo && !is_wp_error($tipo)): ?>
                        <span class="ig-listing-card__tag"><?php echo esc_html($tipo[0]->name); ?></span>
                    <?php endif; ?>
                </div>
                <div class="ig-listing-card__body">
                    <h3 class="ig-listing-card__name"><?php the_title(); ?></h3>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; endif; ?>

<!-- CTA Garda AI -->
<section class="ig-section ig-section--light">
    <div class="ig-container ig-text-center" style="max-width:500px">
        <div class="ig-dest-sidebar__card" style="position:static">
            <h3>Scopri <?php the_title(); ?></h3>
            <p style="color:var(--ig-text-muted);margin-bottom:var(--sp-lg)">Hai domande? Il nostro assistente AI conosce tutto del Lago di Garda!</p>
            <button class="ig-btn ig-btn--primary ig-btn--lg" style="width:100%" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Chiedi a Garda AI
            </button>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
