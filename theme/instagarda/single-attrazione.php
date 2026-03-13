<?php
/**
 * Single: Attrazione
 */
get_header();

while (have_posts()): the_post();

$hero_video = get_post_meta(get_the_ID(), '_ig_att_hero_video', true);
$category   = get_post_meta(get_the_ID(), '_ig_att_category', true) ?: 'monumento';
$lat        = get_post_meta(get_the_ID(), '_ig_att_lat', true);
$lng        = get_post_meta(get_the_ID(), '_ig_att_lng', true);

$cat_labels = [
    'monumento'      => 'Monumento',
    'museo'          => 'Museo',
    'chiesa'         => 'Chiesa',
    'natura'         => 'Natura',
    'spiaggia'       => 'Spiaggia',
    'terme'          => 'Terme',
    'centro-storico' => 'Centro Storico',
    'panorama'       => 'Panorama',
];
$cat_colors = [
    'monumento'      => '#8B5CF6',
    'museo'          => '#3B82F6',
    'chiesa'         => '#F59E0B',
    'natura'         => '#10B981',
    'spiaggia'       => '#06B6D4',
    'terme'          => '#EC4899',
    'centro-storico' => '#F97316',
    'panorama'       => '#14B8A6',
];

$color = $cat_colors[$category] ?? '#8B5CF6';
$label = $cat_labels[$category] ?? 'Attrazione';

// Get localita
$loc_terms = get_the_terms(get_the_ID(), 'localita');
$loc_name  = ($loc_terms && !is_wp_error($loc_terms)) ? $loc_terms[0]->name : '';
$loc_slug  = ($loc_terms && !is_wp_error($loc_terms)) ? $loc_terms[0]->slug : '';
?>

<!-- Hero -->
<section class="ig-dest-hero ig-dest-hero--compact">
    <div class="ig-dest-hero__bg">
        <?php if ($hero_video): ?>
            <video class="ig-dest-hero__video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $hero_video); ?>" type="video/mp4">
            </video>
        <?php elseif (has_post_thumbnail()):
            the_post_thumbnail('hero');
        else: ?>
            <div class="ig-placeholder-img" style="background:<?php echo esc_attr($color); ?>">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.3)" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
        <?php endif; ?>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <span class="ig-dest-hero__badge" style="background:<?php echo esc_attr($color); ?>">
                <?php echo esc_html($label); ?>
            </span>
            <h1 class="ig-dest-hero__title"><?php the_title(); ?></h1>
            <?php if ($loc_name): ?>
            <p style="color:rgba(255,255,255,.85);font-size:1.125rem;margin-top:8px;display:flex;align-items:center;gap:6px">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <?php echo esc_html($loc_name); ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Info Strip -->
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
                    <span class="ig-info-strip__value">Chiedi info su <?php the_title(); ?></span>
                </div>
            </button>
            <?php if ($lat && $lng): ?>
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo esc_attr($lat); ?>,<?php echo esc_attr($lng); ?>" target="_blank" rel="noopener" class="ig-info-strip__item ig-info-strip__item--link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                <div>
                    <span class="ig-info-strip__label">Come arrivare</span>
                    <span class="ig-info-strip__value">Apri in Google Maps <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle"><polyline points="7 17 17 7"/><polyline points="7 7 17 7 17 17"/></svg></span>
                </div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Content -->
<section class="ig-apple-section ig-apple-section--white">
    <div class="ig-apple-container" style="max-width:800px">
        <?php if (has_excerpt()): ?>
        <p style="font-size:1.2rem;font-weight:500;color:var(--ig-text);line-height:1.6;margin-bottom:var(--sp-lg)"><?php echo esc_html(get_the_excerpt()); ?></p>
        <?php endif; ?>

        <div class="ig-att-content" style="font-size:1.05rem;line-height:1.8;color:var(--ig-text-muted)">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php if ($hero_video): ?>
<!-- Video Section -->
<section class="ig-apple-section ig-apple-section--light">
    <div class="ig-apple-container" style="max-width:900px">
        <video autoplay muted loop playsinline style="width:100%;border-radius:16px;aspect-ratio:16/9;object-fit:cover">
            <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/' . $hero_video); ?>" type="video/mp4">
        </video>
    </div>
</section>
<?php endif; ?>

<!-- Back to destination -->
<?php if ($loc_slug): ?>
<section class="ig-apple-section ig-apple-section--white" style="padding:var(--sp-lg) 0 var(--sp-2xl)">
    <div class="ig-apple-container" style="text-align:center">
        <a href="<?php echo esc_url(home_url('/destinazione/' . $loc_slug . '/')); ?>" class="ig-btn ig-btn--outline" style="display:inline-flex;align-items:center;gap:8px">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Torna a <?php echo esc_html($loc_name); ?>
        </a>
    </div>
</section>
<?php endif; ?>

<!-- CTA Garda Concierge -->
<section class="ig-apple-section ig-apple-section--dark" style="padding:var(--sp-2xl) 0">
    <div class="ig-apple-container" style="text-align:center">
        <button onclick="window.toggleGardaChat && window.toggleGardaChat()" class="ig-cta-pill" style="font-size:1.1rem;padding:16px 32px">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Chiedi a Garda Concierge
        </button>
    </div>
</section>

<?php
// Weather script
if ($lat && $lng):
?>
<script>
(function(){
    var lat=<?php echo json_encode((float)$lat); ?>,lng=<?php echo json_encode((float)$lng); ?>;
    fetch('https://api.open-meteo.com/v1/forecast?latitude='+lat+'&longitude='+lng+'&current=temperature_2m,weather_code&timezone=Europe%2FRome')
    .then(r=>r.json()).then(d=>{
        var t=Math.round(d.current.temperature_2m),
            wmo={0:'Sereno',1:'Prevalentemente sereno',2:'Parzialmente nuvoloso',3:'Coperto',45:'Nebbia',48:'Nebbia gelata',51:'Pioggerella leggera',53:'Pioggerella',55:'Pioggerella intensa',61:'Pioggia leggera',63:'Pioggia moderata',65:'Pioggia forte',71:'Neve leggera',73:'Neve moderata',75:'Neve forte',80:'Rovescio leggero',81:'Rovescio moderato',82:'Rovescio forte',95:'Temporale',96:'Temporale con grandine',99:'Temporale forte'},
            desc=wmo[d.current.weather_code]||'';
        document.getElementById('igWeather').textContent=t+'° — '+desc;
    }).catch(function(){document.getElementById('igWeather').textContent='Non disponibile';});
})();
</script>
<?php endif; ?>

<?php endwhile; get_footer(); ?>
