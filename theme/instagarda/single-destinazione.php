<?php get_header(); ?>

<?php while (have_posts()): the_post();
    $region     = ig_get_meta('regione');
    $subtitle   = ig_get_meta('subtitle');
    $highlights = ig_get_meta('highlights');
    $map_lat    = ig_get_meta('map_lat');
    $map_lng    = ig_get_meta('map_lng');
    $pin_left   = ig_get_meta('pin_left');
    $pin_bottom = ig_get_meta('pin_bottom');
    $posizione     = ig_get_meta('posizione');
    $popolazione   = ig_get_meta('popolazione');
    $altitudine    = ig_get_meta('altitudine');
    $come_arrivare = ig_get_meta('come_arrivare');

    $slug = get_post_field('post_name', get_the_ID());

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
        if (isset($coords[$slug])) {
            $map_lat = $coords[$slug][0];
            $map_lng = $coords[$slug][1];
        }
    }

    // Fallback pin positions per la mini-mappa hero
    if (!$pin_left || !$pin_bottom) {
        $pin_positions = [
            'sirmione'            => ['33%', '26%'],
            'desenzano-del-garda' => ['8%', '22%'],
            'salo'                => ['12%', '47%'],
            'gardone-riviera'     => ['37%', '62%'],
            'toscolano-maderno'   => ['30%', '52%'],
            'gargnano'            => ['46%', '68%'],
            'limone-sul-garda'    => ['76%', '88%'],
            'tremosine-sul-garda' => ['61%', '77%'],
            'peschiera-del-garda' => ['50%', '17%'],
            'lazise'              => ['54%', '21%'],
            'bardolino'           => ['63%', '35%'],
            'garda'               => ['48%', '33%'],
            'torri-del-benaco'    => ['56%', '50%'],
            'malcesine'           => ['79%', '74%'],
            'brenzone-sul-garda'  => ['70%', '65%'],
            'riva-del-garda'      => ['82%', '93%'],
            'torbole'             => ['90%', '88%'],
            'arco'                => ['90%', '95%'],
            'brescia'             => ['-40%', '30%'],
            'verona'              => ['102%', '5%'],
            'trento'              => ['105%', '105%'],
            'mantova'             => ['50%', '-15%'],
            'manerba-del-garda'   => ['18%', '38%'],
            'castelnuovo-del-garda'=> ['70%', '19%'],
            'valeggio-sul-mincio' => ['40%', '0%'],
        ];
        if (isset($pin_positions[$slug])) {
            $pin_left   = $pin_positions[$slug][0];
            $pin_bottom = $pin_positions[$slug][1];
        }
    }

    // Region labels
    $region_labels = [
        'lombardia' => 'Lombardia',
        'veneto'    => 'Veneto',
        'trentino'  => 'Trentino-Alto Adige',
    ];
    $region_label = $region_labels[$region] ?? ucfirst($region);
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
            <?php if ($region): ?>
                <span class="ig-dest-hero__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?php echo esc_html($region_label); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($pin_left && $pin_bottom): ?>
    <div class="ig-dest-hero__minimap">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/maps/lago-garda.png'); ?>" alt="Lago di Garda" class="ig-dest-hero__minimap-img">
        <div class="ig-dest-hero__minimap-pin" style="left:<?php echo esc_attr($pin_left); ?>;bottom:<?php echo esc_attr($pin_bottom); ?>">
            <svg width="14" height="18" viewBox="0 0 32 42" fill="none"><path d="M16 0C7.163 0 0 7.163 0 16c0 12 16 26 16 26s16-14 16-26C32 7.163 24.837 0 16 0z" fill="#E53E3E"/><circle cx="16" cy="16" r="6" fill="white"/></svg>
        </div>
    </div>
    <?php endif; ?>
</section>

<!-- Info Strip -->
<?php if ($map_lat && $map_lng): ?>
<section class="ig-info-strip">
    <div class="ig-container">
        <div class="ig-info-strip__grid">
            <div class="ig-info-strip__item ig-info-strip__item--weather">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 18a5 5 0 00-5-5 5 5 0 00-5 5"/><circle cx="12" cy="9" r="4"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="19.78" y1="4.22" x2="18.36" y2="5.64"/><line x1="21" y1="12" x2="23" y2="12"/></svg>
                <div>
                    <span class="ig-info-strip__label">Meteo ora</span>
                    <span class="ig-info-strip__value" id="igWeather">Caricamento...</span>
                </div>
            </div>
            <button class="ig-info-strip__item ig-info-strip__item--link ig-info-strip__item--ai" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                <div>
                    <span class="ig-info-strip__label">Garda AI</span>
                    <span class="ig-info-strip__value">Fatti consigliare a <?php the_title(); ?></span>
                </div>
            </button>
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo esc_attr($map_lat); ?>,<?php echo esc_attr($map_lng); ?>" target="_blank" rel="noopener" class="ig-info-strip__item ig-info-strip__item--link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                <div>
                    <span class="ig-info-strip__label">Come arrivare</span>
                    <span class="ig-info-strip__value">Apri in Google Maps <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle"><polyline points="7 17 17 7"/><polyline points="7 7 17 7 17 17"/></svg></span>
                </div>
            </a>
        </div>
    </div>
</section>
<script>
(function(){
    var weatherCodes = {0:'Sereno',1:'Prevalentemente sereno',2:'Parzialmente nuvoloso',3:'Coperto',45:'Nebbia',48:'Nebbia con brina',51:'Pioviggine leggera',53:'Pioviggine',55:'Pioviggine intensa',61:'Pioggia leggera',63:'Pioggia',65:'Pioggia intensa',71:'Neve leggera',73:'Neve',75:'Neve intensa',80:'Rovesci leggeri',81:'Rovesci',82:'Rovesci intensi',95:'Temporale',96:'Temporale con grandine',99:'Temporale forte'};
    fetch('https://api.open-meteo.com/v1/forecast?latitude=<?php echo esc_js($map_lat); ?>&longitude=<?php echo esc_js($map_lng); ?>&current=temperature_2m,weather_code&timezone=Europe/Rome')
        .then(function(r){return r.json()})
        .then(function(d){
            var el=document.getElementById('igWeather');
            if(el&&d.current){
                var t=Math.round(d.current.temperature_2m);
                var desc=weatherCodes[d.current.weather_code]||'';
                el.textContent=t+'\u00B0C \u2014 '+desc;
            }
        })
        .catch(function(){
            var el=document.getElementById('igWeather');
            if(el) el.textContent='Non disponibile';
        });
})();
</script>
<?php endif; ?>


<!-- ============================================================
     APPLE-STYLE EDITORIAL CONTENT
     ============================================================ -->

<!-- Intro Statement -->
<section class="ig-apple-section ig-apple-section--intro ig-reveal">
    <div class="ig-apple-container">
        <?php
        $full_content = apply_filters('the_content', get_the_content());
        // Split content into paragraphs
        preg_match_all('/<p[^>]*>(.*?)<\/p>/s', $full_content, $paragraphs);
        $para_texts = $paragraphs[0] ?? [];

        if (!empty($para_texts)):
            // First paragraph = big intro statement
        ?>
        <div class="ig-apple-intro">
            <?php echo $para_texts[0]; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Editorial Body -->
<?php if (count($para_texts) > 1): ?>
<section class="ig-apple-section ig-reveal">
    <div class="ig-apple-container--narrow">
        <div class="ig-apple-body entry-content">
            <?php
            // Remaining paragraphs in editorial format
            for ($p = 1; $p < count($para_texts); $p++) {
                echo $para_texts[$p];
            }

            // Also output any non-paragraph content (h2, h3, lists, images, etc.)
            $non_p_content = preg_replace('/<p[^>]*>.*?<\/p>/s', '', $full_content);
            $non_p_content = trim($non_p_content);
            if ($non_p_content) {
                echo $non_p_content;
            }
            ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- Cosa Vedere — Apple Feature Style -->
<?php
require_once get_template_directory() . '/inc/attrazioni-data.php';
$attrazioni_db = ig_get_attrazioni();
$attrazioni = $attrazioni_db[$slug] ?? [];

if (!empty($attrazioni)):
?>
<section class="ig-apple-section ig-apple-section--dark ig-reveal">
    <div class="ig-apple-container">
        <h2 class="ig-apple-title">Cosa vedere</h2>
        <p class="ig-apple-subtitle">I luoghi che rendono <?php the_title(); ?> indimenticabile.</p>
    </div>
</section>

<?php foreach ($attrazioni as $i => $att): ?>
<section class="ig-apple-section ig-apple-feature ig-reveal <?php echo ($i % 2 === 0) ? '' : 'ig-apple-feature--reverse'; ?> <?php echo ($i % 2 === 0) ? 'ig-apple-section--light' : 'ig-apple-section--white'; ?>">
    <div class="ig-apple-container">
        <div class="ig-apple-feature__grid">
            <div class="ig-apple-feature__visual">
                <div class="ig-placeholder-img ig-apple-feature__img">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
            </div>
            <div class="ig-apple-feature__text">
                <span class="ig-apple-feature__label">Attrazione</span>
                <h3 class="ig-apple-feature__title"><?php echo esc_html($att['name']); ?></h3>
                <p class="ig-apple-feature__excerpt"><?php echo esc_html($att['excerpt']); ?></p>
                <p class="ig-apple-feature__desc"><?php echo esc_html($att['desc']); ?></p>
            </div>
        </div>
    </div>
</section>
<?php endforeach; ?>

<?php endif; ?>


<!-- Esplora la zona -->
<section class="ig-apple-section ig-apple-section--dark ig-reveal">
    <div class="ig-apple-container">
        <h2 class="ig-apple-title">Vivi <?php the_title(); ?></h2>
        <p class="ig-apple-subtitle">Tutto quello che ti serve per la tua visita.</p>

        <div class="ig-explore-grid" style="margin-top:var(--sp-2xl)">
            <a href="<?php echo esc_url(home_url('/directory/?localita=' . $slug . '&tipo=ristorante')); ?>" class="ig-explore-card ig-explore-card--mangiare">
                <div class="ig-explore-card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                </div>
                <h3 class="ig-explore-card__title">Ristoranti</h3>
                <p class="ig-explore-card__desc">I migliori posti dove mangiare</p>
                <span class="ig-explore-card__arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </a>
            <a href="<?php echo esc_url(home_url('/directory/?localita=' . $slug . '&tipo=hotel')); ?>" class="ig-explore-card ig-explore-card--dormire">
                <div class="ig-explore-card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
                </div>
                <h3 class="ig-explore-card__title">Dove Dormire</h3>
                <p class="ig-explore-card__desc">Hotel, B&B e appartamenti</p>
                <span class="ig-explore-card__arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </a>
            <a href="<?php echo esc_url(home_url('/directory/?localita=' . $slug . '&tipo=bar')); ?>" class="ig-explore-card ig-explore-card--bar">
                <div class="ig-explore-card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 2h8l-4 9V22"/><path d="M4 2h16"/><path d="M7 22h10"/></svg>
                </div>
                <h3 class="ig-explore-card__title">Bar & Locali</h3>
                <p class="ig-explore-card__desc">Aperitivi e vita notturna</p>
                <span class="ig-explore-card__arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </a>
            <a href="<?php echo esc_url(home_url('/directory/?localita=' . $slug . '&tipo=attivita')); ?>" class="ig-explore-card ig-explore-card--attivita">
                <div class="ig-explore-card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                </div>
                <h3 class="ig-explore-card__title">Attività</h3>
                <p class="ig-explore-card__desc">Esperienze e cose da fare</p>
                <span class="ig-explore-card__arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- Strutture correlate -->
<?php
$loc_terms = get_the_terms(get_the_ID(), 'localita');
if ($loc_terms && !is_wp_error($loc_terms)):
    $strutture = new WP_Query([
        'post_type' => 'struttura',
        'posts_per_page' => 6,
        'tax_query' => [[
            'taxonomy' => 'localita',
            'terms'    => wp_list_pluck($loc_terms, 'term_id'),
        ]],
    ]);
    if ($strutture->have_posts()):
?>
<section class="ig-apple-section ig-apple-section--light ig-reveal">
    <div class="ig-apple-container">
        <h2 class="ig-apple-title">Strutture a <?php the_title(); ?></h2>
        <p class="ig-apple-subtitle">Le attività consigliate nella zona</p>
        <div class="ig-archive-grid" style="margin-top:var(--sp-xl)">
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
<section class="ig-apple-section ig-apple-section--cta">
    <div class="ig-apple-container ig-text-center">
        <h2 class="ig-apple-title ig-apple-title--white">Organizza la tua giornata<br>a <?php the_title(); ?></h2>
        <p class="ig-apple-subtitle ig-apple-subtitle--white">Il nostro assistente AI conosce ogni angolo del Lago di Garda.</p>
        <button class="ig-btn ig-btn--glass-outline ig-btn--lg" style="margin-top:var(--sp-lg)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Chiedi a Garda AI
        </button>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
