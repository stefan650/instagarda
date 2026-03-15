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
            'nago-torbole'        => [45.8748, 10.8739],
            'arco'                => [45.9178, 10.8854],
            'lonato-del-garda'    => [45.4604, 10.4858],
            'polpenazze-del-garda'=> [45.5567, 10.5033],
            'moniga-del-garda'    => [45.5297, 10.5411],
            'padenghe-sul-garda'  => [45.5089, 10.5128],
            'san-felice-del-benaco'=> [45.5811, 10.5517],
            'soiano-del-lago'     => [45.5433, 10.5139],
        ];
        if (isset($coords[$slug])) {
            $map_lat = $coords[$slug][0];
            $map_lng = $coords[$slug][1];
        }
    }

    // Fallback pin positions per la mini-mappa hero
    if (!$pin_left || !$pin_bottom) {
        $pin_positions = [
            'sirmione'            => ['30%', '25%'],
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
            'nago-torbole'        => ['90%', '88%'],
            'arco'                => ['90%', '95%'],
            'brescia'             => ['-40%', '30%'],
            'verona'              => ['102%', '5%'],
            'trento'              => ['105%', '105%'],
            'mantova'             => ['50%', '-15%'],
            'manerba-del-garda'   => ['18%', '38%'],
            'moniga-del-garda'    => ['16%', '34%'],
            'padenghe-sul-garda'  => ['14%', '30%'],
            'lonato-del-garda'    => ['5%', '17%'],
            'polpenazze-del-garda'=> ['5%', '42%'],
            'san-felice-del-benaco'=> ['21%', '43%'],
            'soiano-del-lago'     => ['8%', '38%'],
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
        <?php if ($hero_video && $hero_video_mobile): ?>
            <video class="ig-dest-hero__video ig-dest-hero__video--desktop" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $hero_video); ?>" type="video/mp4">
            </video>
            <video class="ig-dest-hero__video ig-dest-hero__video--mobile" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $hero_video_mobile); ?>" type="video/mp4">
            </video>
        <?php elseif ($hero_video): ?>
            <video class="ig-dest-hero__video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $hero_video); ?>" type="video/mp4">
            </video>
        <?php elseif ($hero_video_mobile): ?>
            <?php if (has_post_thumbnail()): ?>
            <div class="ig-dest-hero__video ig-dest-hero__video--desktop"><?php the_post_thumbnail('hero'); ?></div>
            <?php endif; ?>
            <video class="ig-dest-hero__video ig-dest-hero__video--mobile" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $hero_video_mobile); ?>" type="video/mp4">
            </video>
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
                <div>
                    <span class="ig-info-strip__label">Meteo ora</span>
                    <span class="ig-info-strip__value" id="igWeather">Caricamento...</span>
                </div>
            </div>
            <button class="ig-info-strip__item ig-info-strip__item--link ig-info-strip__item--ai" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                <div>
                    <span class="ig-info-strip__label">Garda Concierge</span>
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
    var weatherCodes = {0:'Sereno',1:'Prev. sereno',2:'Parz. nuvoloso',3:'Coperto',45:'Nebbia',48:'Nebbia con brina',51:'Pioviggine leggera',53:'Pioviggine',55:'Pioviggine intensa',61:'Pioggia leggera',63:'Pioggia',65:'Pioggia intensa',71:'Neve leggera',73:'Neve',75:'Neve intensa',80:'Rovesci leggeri',81:'Rovesci',82:'Rovesci intensi',95:'Temporale',96:'Temporale con grandine',99:'Temporale forte'};
    var weatherIcons = {0:'\u2600\uFE0F',1:'\uD83C\uDF24',2:'\u26C5',3:'\u2601\uFE0F',45:'\uD83C\uDF2B',48:'\uD83C\uDF2B',51:'\uD83C\uDF26',53:'\uD83C\uDF27',55:'\uD83C\uDF27',61:'\uD83C\uDF26',63:'\uD83C\uDF27',65:'\uD83C\uDF27',71:'\uD83C\uDF28',73:'\u2744\uFE0F',75:'\u2744\uFE0F',80:'\uD83C\uDF26',81:'\uD83C\uDF27',82:'\u26C8',95:'\u26C8',96:'\u26C8',99:'\u26C8'};
    fetch('https://api.open-meteo.com/v1/forecast?latitude=<?php echo esc_js($map_lat); ?>&longitude=<?php echo esc_js($map_lng); ?>&current=temperature_2m,weather_code&timezone=Europe/Rome')
        .then(function(r){return r.json()})
        .then(function(d){
            var el=document.getElementById('igWeather');
            if(el&&d.current){
                var t=Math.round(d.current.temperature_2m);
                var desc=weatherCodes[d.current.weather_code]||'';
                var icon=weatherIcons[d.current.weather_code]||'';
                el.textContent=icon+' '+t+'\u00B0C \u2014 '+desc;
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
     EDITORIAL CONTENT — Zigzag layout (ispirato a Visit Abu Dhabi)
     ============================================================ -->

<?php
$full_content = apply_filters('the_content', get_the_content());

// Parse content into ordered blocks: paragraphs, figures, headings
preg_match_all('/<(p|figure|h[2-6])[^>]*>.*?<\/\1>/s', $full_content, $blocks_match);
$blocks = $blocks_match[0] ?? [];

// Separate first paragraph as intro
$intro_block = '';
$content_blocks = [];
$found_intro = false;
foreach ($blocks as $block) {
    if (!$found_intro && strpos($block, '<p') === 0) {
        $intro_block = $block;
        $found_intro = true;
    } else {
        $content_blocks[] = $block;
    }
}

// Group content into zigzag sections: pair figures with adjacent text
$sections = [];
$current_text = [];
foreach ($content_blocks as $block) {
    if (strpos($block, '<figure') === 0) {
        // If there's accumulated text without a figure, flush as text-only section
        if (!empty($current_text) && empty($sections)) {
            $sections[] = ['type' => 'text', 'text' => implode("\n", $current_text)];
            $current_text = [];
        }
        // Create zigzag section: figure + any accumulated text
        $sections[] = ['type' => 'zigzag', 'figure' => $block, 'text' => implode("\n", $current_text)];
        $current_text = [];
    } else {
        $current_text[] = $block;
    }
}
// Flush remaining text
if (!empty($current_text)) {
    // If there are zigzag sections, attach remaining text to last one
    $last_idx = count($sections) - 1;
    if ($last_idx >= 0 && $sections[$last_idx]['type'] === 'zigzag' && empty($sections[$last_idx]['text'])) {
        $sections[$last_idx]['text'] = implode("\n", $current_text);
    } else {
        $sections[] = ['type' => 'text', 'text' => implode("\n", $current_text)];
    }
}
?>

<!-- Intro — all text in one block -->
<?php
// Collect all text-only content to merge with intro
$has_zigzag = false;
foreach ($sections as $s) { if ($s['type'] === 'zigzag') { $has_zigzag = true; break; } }

$all_text_blocks = [];
if ($intro_block) $all_text_blocks[] = $intro_block;
if (!$has_zigzag) {
    foreach ($sections as $s) {
        if ($s['type'] === 'text' && $s['text']) $all_text_blocks[] = $s['text'];
    }
}
?>
<?php if (!empty($all_text_blocks)): ?>
<section class="ig-apple-section ig-apple-section--intro ig-reveal">
    <div class="ig-apple-container">
        <div class="ig-apple-intro">
            <?php echo implode("\n", $all_text_blocks); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Content Sections (zigzag) -->
<?php
$zigzag_index = 0;
foreach ($sections as $section):
    if ($section['type'] === 'text' && !$has_zigzag):
        continue; // already shown in intro
    elseif ($section['type'] === 'zigzag'):
        $reverse = ($zigzag_index % 2 === 1);
        $bg = ($zigzag_index % 2 === 0) ? 'ig-apple-section--white' : 'ig-apple-section--light';
        // Extract img src and figcaption from figure
        preg_match('/src=["\']([^"\']+)["\']/s', $section['figure'], $img_match);
        preg_match('/<figcaption>(.*?)<\/figcaption>/s', $section['figure'], $cap_match);
        $img_src = $img_match[1] ?? '';
        $img_cap = $cap_match[1] ?? '';
?>
<section class="ig-apple-section ig-apple-feature ig-reveal <?php echo $reverse ? 'ig-apple-feature--reverse' : ''; ?> <?php echo $bg; ?>">
    <div class="ig-apple-container">
        <div class="ig-apple-feature__grid">
            <div class="ig-apple-feature__visual">
                <?php if ($img_src): ?>
                <img class="ig-apple-feature__img" src="<?php echo esc_url($img_src); ?>" alt="" loading="lazy" style="border-radius:12px;width:100%;height:auto">
                <?php if ($img_cap): ?>
                <p class="ig-apple-feature__caption"><?php echo wp_kses_post($img_cap); ?></p>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="ig-apple-feature__text">
                <div class="ig-editorial-text">
                    <?php echo $section['text']; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
        $zigzag_index++;
    elseif ($section['type'] === 'text'):
?>
<section class="ig-apple-section ig-reveal">
    <div class="ig-apple-container--narrow">
        <div class="ig-apple-body entry-content">
            <?php echo $section['text']; ?>
        </div>
    </div>
</section>
<?php
    endif;
endforeach;
?>


<!-- Cosa Vedere — Carousel Cards -->
<?php
require_once get_template_directory() . '/inc/attrazioni-data.php';
$attrazioni_db = ig_get_attrazioni();
$attrazioni = $attrazioni_db[$slug] ?? [];

if (!empty($attrazioni)):
?>
<section class="ig-apple-section ig-apple-section--white ig-reveal" style="padding: var(--sp-xl) 0">
    <div class="ig-apple-container">
        <h2 style="font-family:var(--font-heading);font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:700;color:var(--ig-text);margin:0">Cosa vedere</h2>
        <p style="color:var(--ig-text-muted);margin:8px 0 24px;font-size:1rem">Le attrazioni principali</p>
        <div class="ig-activity-carousel">
            <?php foreach ($attrazioni as $att): ?>
            <a href="<?php echo !empty($att['slug']) ? esc_url(home_url('/attrazione/' . $att['slug'] . '/')) : 'javascript:void(0)'; ?>" class="ig-sight-card">
                <div class="ig-sight-card__img">
                    <?php if (!empty($att['video'])): ?>
                    <video muted loop playsinline preload="metadata">
                        <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $att['video']); ?>" type="video/mp4">
                    </video>
                    <?php elseif (!empty($att['img'])): ?>
                    <img src="<?php echo esc_url($att['img']); ?>" alt="<?php echo esc_attr($att['name']); ?>" loading="lazy">
                    <?php else: ?>
                    <div class="ig-placeholder-img">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <?php endif; ?>
                </div>
                <h3 class="ig-sight-card__title"><?php echo esc_html($att['name']); ?></h3>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script>
(function(){
    var videos = document.querySelectorAll('.ig-sight-card video');
    if (!videos.length) return;
    var isMobile = window.matchMedia('(max-width:767px)').matches;

    if (isMobile) {
        // Mobile: IntersectionObserver — play one at a time
        var observer = new IntersectionObserver(function(entries){
            entries.forEach(function(e){
                if (e.isIntersecting && e.intersectionRatio >= 0.6) {
                    videos.forEach(function(v){ if(v!==e.target) v.pause(); });
                    e.target.play();
                } else {
                    e.target.pause();
                }
            });
        }, {threshold: [0, 0.6]});
        videos.forEach(function(v){ observer.observe(v); });
    } else {
        // Desktop: hover to play
        document.querySelectorAll('.ig-sight-card').forEach(function(card){
            var v = card.querySelector('video');
            if (!v) return;
            card.addEventListener('mouseenter', function(){ v.play(); });
            card.addEventListener('mouseleave', function(){ v.pause(); v.currentTime = 0; });
        });
    }
})();
</script>
<?php endif; ?>


<!-- Cosa Fare — Itinerari e attività sportive nella zona -->
<?php
require_once get_template_directory() . '/inc/itinerari-zona.php';
$itinerari_zona = ig_get_itinerari_zona();
$itinerari = $itinerari_zona[$slug] ?? [];
$type_colors = ['hiking'=>'#10B981','cycling'=>'#3B82F6','mtb'=>'#F59E0B','ferrata'=>'#EF4444','water'=>'#06B6D4','drive'=>'#8B5CF6'];
$diff_colors = ['facile'=>'#10B981','media'=>'#F59E0B','difficile'=>'#EF4444'];

if (!empty($itinerari)):
?>
<section class="ig-apple-section ig-apple-section--light ig-reveal" style="padding: var(--sp-xl) 0">
    <div class="ig-apple-container">
        <h2 style="font-family:var(--font-heading);font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:700;color:var(--ig-text);margin:0 0 4px">Cosa fare</h2>
        <p style="color:var(--ig-text-muted);font-size:0.95rem;margin:0 0 var(--sp-lg)">Percorsi e attività sportive nella zona</p>
        <div class="ig-activity-carousel">
            <?php foreach ($itinerari as $it):
                $color = $type_colors[$it['type']] ?? '#666';
                $diff_color = $diff_colors[$it['difficulty']] ?? '#666';
                // Try to get thumbnail from itinerario post
                $itin_posts = get_posts(['post_type'=>'itinerario','name'=>$it['slug'],'posts_per_page'=>1]);
                $thumb_url = '';
                if ($itin_posts) {
                    $thumb_url = get_the_post_thumbnail_url($itin_posts[0]->ID, 'card-wide');
                }
            ?>
            <a href="<?php echo esc_url(home_url('/itinerario/' . $it['slug'] . '/')); ?>" class="ig-activity-card">
                <div class="ig-activity-card__img">
                    <?php if ($thumb_url): ?>
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($it['name']); ?>" loading="lazy">
                    <?php else: ?>
                    <div class="ig-placeholder-img"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div>
                    <?php endif; ?>
                    <span class="ig-activity-card__badge" style="background:<?php echo $color; ?>"><?php echo esc_html($it['type_label']); ?></span>
                </div>
                <div class="ig-activity-card__body">
                    <h3 class="ig-activity-card__title"><?php echo esc_html($it['name']); ?></h3>
                    <p class="ig-activity-card__desc"><?php echo esc_html($it['desc']); ?></p>
                    <div class="ig-activity-card__meta">
                        <?php if ($it['km'] > 0): ?><span><?php echo $it['km']; ?> km</span><?php endif; ?>
                        <?php if ($it['hours'] !== '—'): ?><span><?php echo esc_html($it['hours']); ?></span><?php endif; ?>
                        <span style="color:<?php echo $diff_color; ?>;font-weight:600"><?php echo ucfirst($it['difficulty']); ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>



<!-- Eventi in zona -->
<?php
$today_str = date('Y-m-d');
$dest_loc_term = get_term_by('slug', $slug, 'localita');
if ($dest_loc_term && !is_wp_error($dest_loc_term)):
    $eventi_q = new WP_Query([
        'post_type'      => 'evento',
        'posts_per_page' => 12,
        'meta_key'       => '_ig_data_fine',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => [['key' => '_ig_data_fine', 'value' => $today_str, 'compare' => '>=', 'type' => 'DATE']],
        'tax_query'      => [['taxonomy' => 'localita', 'terms' => $dest_loc_term->term_id]],
    ]);
    if ($eventi_q->have_posts()):
        $mesi_it = ['01'=>'Gen','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mag','06'=>'Giu','07'=>'Lug','08'=>'Ago','09'=>'Set','10'=>'Ott','11'=>'Nov','12'=>'Dic'];
?>
<section class="ig-apple-section ig-apple-section--white ig-reveal" style="padding: var(--sp-xl) 0">
    <div class="ig-apple-container">
        <h2 style="font-family:var(--font-heading);font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:700;color:var(--ig-text);margin:0 0 4px">Prossimi eventi</h2>
        <p style="color:var(--ig-text-muted);font-size:0.95rem;margin:0 0 var(--sp-lg)">Cosa succede a <?php the_title(); ?></p>
        <div class="ig-activity-carousel">
            <?php while ($eventi_q->have_posts()): $eventi_q->the_post();
                $ev_inizio = get_post_meta(get_the_ID(), '_ig_data_inizio', true);
                $ev_fine   = get_post_meta(get_the_ID(), '_ig_data_fine', true);
                $ev_luogo  = get_post_meta(get_the_ID(), '_ig_luogo', true);
                $ev_tipo   = get_the_terms(get_the_ID(), 'tipo_evento');
                $ev_tipo_name = ($ev_tipo && !is_wp_error($ev_tipo)) ? $ev_tipo[0]->name : '';
                $ev_day   = $ev_inizio ? date('j', strtotime($ev_inizio)) : '';
                $ev_month = $ev_inizio ? ($mesi_it[date('m', strtotime($ev_inizio))] ?? '') : '';
                $tipo_colors = ['Concerto & Musica'=>'#8B5CF6','Sport & Regata'=>'#3B82F6','Enogastronomia'=>'#F59E0B','Mostra & Arte'=>'#EC4899','Sagra & Festival'=>'#10B981','Mercatino'=>'#F97316','Teatro & Spettacolo'=>'#EF4444'];
                $badge_color = $tipo_colors[$ev_tipo_name] ?? '#6B7280';
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-activity-card">
                <div class="ig-activity-card__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card-wide', ['loading'=>'lazy']); else: ?>
                    <div class="ig-placeholder-img"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></div>
                    <?php endif; ?>
                    <?php if ($ev_day): ?>
                    <span class="ig-activity-card__date-badge"><?php echo $ev_day; ?><small><?php echo $ev_month; ?></small></span>
                    <?php endif; ?>
                    <?php if ($ev_tipo_name): ?>
                    <span class="ig-activity-card__badge" style="background:<?php echo $badge_color; ?>"><?php echo esc_html($ev_tipo_name); ?></span>
                    <?php endif; ?>
                </div>
                <div class="ig-activity-card__body">
                    <h3 class="ig-activity-card__title"><?php the_title(); ?></h3>
                    <?php if ($ev_luogo): ?>
                    <p class="ig-activity-card__desc">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-1px"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <?php echo esc_html($ev_luogo); ?>
                    </p>
                    <?php endif; ?>
                    <?php if ($ev_inizio && $ev_fine && $ev_inizio !== $ev_fine): ?>
                    <div class="ig-activity-card__meta"><span><?php echo date('j', strtotime($ev_inizio)) . ' ' . $mesi_it[date('m', strtotime($ev_inizio))]; ?> — <?php echo date('j', strtotime($ev_fine)) . ' ' . $mesi_it[date('m', strtotime($ev_fine))]; ?></span></div>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div style="text-align:center;margin-top:var(--sp-lg)">
            <a href="<?php echo esc_url(home_url('/eventi/')); ?>" class="ig-btn ig-btn--outline" style="font-size:0.9rem;padding:10px 28px">Tutti gli eventi →</a>
        </div>
    </div>
</section>
<?php endif; endif; ?>


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


<!-- CTA Garda Concierge -->
<section class="ig-apple-section ig-apple-section--cta">
    <div class="ig-apple-container ig-text-center">
        <h2 class="ig-apple-title ig-apple-title--white">Organizza la tua giornata<br>a <?php the_title(); ?></h2>
        <p class="ig-apple-subtitle ig-apple-subtitle--white">Il nostro assistente AI conosce ogni angolo del Lago di Garda.</p>
        <button class="ig-btn ig-btn--glass-outline ig-btn--lg" style="margin-top:var(--sp-lg)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Chiedi a Garda Concierge
        </button>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
