<?php
/**
 * Single: Itinerario
 */
get_header();

while (have_posts()): the_post();

$type       = get_post_meta(get_the_ID(), '_ig_itin_type', true) ?: 'hiking';
$difficulty  = get_post_meta(get_the_ID(), '_ig_itin_difficulty', true) ?: 'media';
$km         = get_post_meta(get_the_ID(), '_ig_itin_km', true);
$elevation  = get_post_meta(get_the_ID(), '_ig_itin_elevation', true);
$descent    = get_post_meta(get_the_ID(), '_ig_itin_descent', true);
$hours      = get_post_meta(get_the_ID(), '_ig_itin_hours', true);
$zone       = get_post_meta(get_the_ID(), '_ig_itin_zone', true);
$lat        = get_post_meta(get_the_ID(), '_ig_itin_lat', true);
$lng        = get_post_meta(get_the_ID(), '_ig_itin_lng', true);
$oa_id      = get_post_meta(get_the_ID(), '_ig_itin_oa_id', true);
$tags_raw   = get_post_meta(get_the_ID(), '_ig_itin_tags', true);
$tags       = $tags_raw ? array_filter(array_map('trim', explode(',', $tags_raw))) : [];
$surface_raw = get_post_meta(get_the_ID(), '_ig_itin_surface', true);
$surfaces    = $surface_raw ? json_decode($surface_raw, true) : [];

$type_labels  = ['hiking' => 'Trekking', 'cycling' => 'Ciclismo', 'mtb' => 'Mountain Bike', 'ferrata' => 'Via Ferrata', 'water' => 'Sport Acquatici', 'drive' => 'Scenic Drive'];
$type_colors  = ['hiking' => '#10B981', 'cycling' => '#3B82F6', 'mtb' => '#F59E0B', 'ferrata' => '#EF4444', 'water' => '#06B6D4', 'drive' => '#8B5CF6'];
$type_icons   = [
    'hiking'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>',
    'cycling' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="18.5" cy="17.5" r="3.5"/><path d="M15 6a1 1 0 100-2 1 1 0 000 2zm-3 11.5V14l-3-3 4-3 2 3h2"/></svg>',
    'mtb'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 17l5-10 4 6 4-8 5 12"/></svg>',
    'ferrata' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19l4-14 4 8 4-6 4 12"/></svg>',
    'water'   => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12c2-2 4-2 6 0s4 2 6 0 4-2 6 0"/><path d="M2 18c2-2 4-2 6 0s4 2 6 0 4-2 6 0"/></svg>',
    'drive'   => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 17h2m10 0h2M5 17a2 2 0 01-2-2V9a2 2 0 012-2h2l2-3h6l2 3h2a2 2 0 012 2v6a2 2 0 01-2 2"/><circle cx="7.5" cy="17.5" r="1.5"/><circle cx="16.5" cy="17.5" r="1.5"/></svg>',
];
$diff_colors = ['facile' => '#10B981', 'media' => '#F59E0B', 'difficile' => '#EF4444'];
$tag_labels  = [
    'vista-lago' => 'Vista lago', 'panoramico' => 'Panoramico', 'circolare' => 'Percorso circolare',
    'famiglie' => 'Adatto a famiglie', 'passeggino' => 'Adatto a passeggino', 'cani' => 'Dog-friendly',
    'ebike' => 'E-bike', 'mezzi' => 'Raggiungibile con mezzi', 'consigliato' => 'Consigliato',
    'balneabile' => 'Balneabile', 'ombreggiato' => 'Ombreggiato', 'culturale' => 'Interesse culturale',
    'ristori' => 'Punti ristoro', 'accessibile' => 'Accessibile',
    'multiday' => 'Multi-giorno',
];

$color = $type_colors[$type] ?? '#10B981';
$gradient = 'linear-gradient(135deg, ' . $color . ', ' . $color . 'cc)';
?>

<!-- Hero -->
<section class="ig-dest-hero ig-dest-hero--compact">
    <div class="ig-dest-hero__bg">
        <?php if (has_post_thumbnail()):
            the_post_thumbnail('hero');
        else: ?>
            <div class="ig-placeholder-img" style="background:<?php echo esc_attr($gradient); ?>">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.3)" stroke-width="1"><path d="M3 17l5-10 4 6 4-8 5 12"/></svg>
            </div>
        <?php endif; ?>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <span class="ig-dest-hero__badge" style="background:<?php echo esc_attr($color); ?>">
                <?php echo $type_icons[$type] ?? ''; ?>
                <?php echo esc_html($type_labels[$type] ?? 'Itinerario'); ?>
            </span>
            <h1 class="ig-dest-hero__title"><?php the_title(); ?></h1>
            <?php if ($zone): ?>
            <p style="color:rgba(255,255,255,.85);font-size:1.125rem;margin-top:8px;display:flex;align-items:center;gap:6px">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <?php echo esc_html($zone); ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Info Strip -->
<?php if ($lat && $lng): ?>
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
                    <span class="ig-info-strip__value">Chiedi info su <?php the_title(); ?></span>
                </div>
            </button>
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo esc_attr($lat); ?>,<?php echo esc_attr($lng); ?>" target="_blank" rel="noopener" class="ig-info-strip__item ig-info-strip__item--link">
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
    fetch('https://api.open-meteo.com/v1/forecast?latitude=<?php echo esc_js($lat); ?>&longitude=<?php echo esc_js($lng); ?>&current=temperature_2m,weather_code&timezone=Europe/Rome')
        .then(function(r){return r.json()})
        .then(function(d){
            var el=document.getElementById('igWeather');
            if(el&&d.current){
                var t=Math.round(d.current.temperature_2m);
                var desc=weatherCodes[d.current.weather_code]||'';
                el.textContent=t+'\u00B0C \u2014 '+desc;
            }
        }).catch(function(){});
})();
</script>
<?php endif; ?>

<!-- Mappa percorso + profilo altimetrico -->
<section class="ig-apple-section ig-apple-section--white" style="padding:var(--sp-xl) 0">
    <div class="ig-apple-container ig-apple-container--wide">
        <div class="ig-itin-map-wrap">
            <div id="igItinMap"></div>
        </div>
        <div class="ig-itin-profile-wrap" id="igItinProfileWrap" style="display:none">
            <canvas id="igItinProfile"></canvas>
            <div class="ig-itin-profile-tooltip" id="igItinTooltip"></div>
            <?php if (!empty($surfaces)):
                $total_km = array_sum(array_column($surfaces, 1));
            ?>
            <div class="ig-itin-surface">
                <h4 class="ig-itin-surface__title">Tipo di strada</h4>
                <div class="ig-itin-surface__bar">
                    <?php foreach ($surfaces as $s):
                        $pct = $total_km > 0 ? ($s[1] / $total_km * 100) : 0;
                        if ($pct < 0.5) continue;
                    ?>
                    <div class="ig-itin-surface__segment" style="width:<?php echo $pct; ?>%;background:<?php echo esc_attr($s[2]); ?>"></div>
                    <?php endforeach; ?>
                </div>
                <div class="ig-itin-surface__legend">
                    <?php foreach ($surfaces as $s): if ($s[1] <= 0) continue; ?>
                    <div class="ig-itin-surface__item">
                        <span class="ig-itin-surface__dot" style="background:<?php echo esc_attr($s[2]); ?>"></span>
                        <span class="ig-itin-surface__label"><?php echo esc_html($s[0]); ?></span>
                        <span class="ig-itin-surface__km"><?php echo $s[1] >= 1 ? number_format($s[1], 1, '.', '') . ' km' : round($s[1] * 1000) . ' m'; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var oaId = <?php echo intval($oa_id); ?>;
    var startLat = <?php echo floatval($lat); ?>;
    var startLng = <?php echo floatval($lng); ?>;
    var ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
    var trailColor = '#1B3A5C';

    // Init mappa con OpenTopoMap
    var map = L.map('igItinMap', { scrollWheelZoom: false }).setView([startLat, startLng], 14);
    L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        maxZoom: 17,
        attribution: '&copy; OpenTopoMap &copy; OSM'
    }).addTo(map);

    if (!oaId) {
        // Nessun OA ID — solo marker
        L.marker([startLat, startLng]).addTo(map);
        return;
    }

    // Fetch percorso dal proxy
    fetch(ajaxUrl + '?action=ig_trail_route&oa_id=' + oaId)
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (!res.success || !res.data.route || res.data.route.length < 2) {
                L.marker([startLat, startLng]).addTo(map);
                return;
            }

            var route = res.data.route;
            var latlngs = route.map(function(p) { return [p[0], p[1]]; });

            // Disegna percorso blu scuro con bordo
            L.polyline(latlngs, { color: '#0a1e33', weight: 7, opacity: 0.3 }).addTo(map);
            L.polyline(latlngs, { color: trailColor, weight: 4, opacity: 1 }).addTo(map);

            // Marker start/end
            var startIcon = L.divIcon({ className:'ig-route-marker ig-route-marker--start', html:'<div>S</div>', iconSize:[28,28], iconAnchor:[14,14] });
            var endIcon = L.divIcon({ className:'ig-route-marker ig-route-marker--end', html:'<div>F</div>', iconSize:[28,28], iconAnchor:[14,14] });
            L.marker(latlngs[0], { icon: startIcon }).addTo(map);
            L.marker(latlngs[latlngs.length - 1], { icon: endIcon }).addTo(map);

            // Fit mappa al percorso
            map.fitBounds(L.latLngBounds(latlngs).pad(0.1));

            // Profilo altimetrico
            var hasElevation = route.some(function(p) { return p[2] > 0; });
            if (hasElevation) {
                drawElevationProfile(route);
            }
        })
        .catch(function() {
            L.marker([startLat, startLng]).addTo(map);
        });

    // ─── Profilo altimetrico ───
    function drawElevationProfile(route) {
        var wrap = document.getElementById('igItinProfileWrap');
        var canvas = document.getElementById('igItinProfile');
        var tooltip = document.getElementById('igItinTooltip');
        wrap.style.display = 'block';

        var ctx = canvas.getContext('2d');
        var dpr = window.devicePixelRatio || 1;
        var w = wrap.offsetWidth;
        var h = 160;
        canvas.width = w * dpr;
        canvas.height = h * dpr;
        canvas.style.width = w + 'px';
        canvas.style.height = h + 'px';
        ctx.scale(dpr, dpr);

        // Calcola distanze cumulative
        var distances = [0];
        for (var i = 1; i < route.length; i++) {
            var d = haversine(route[i-1][0], route[i-1][1], route[i][0], route[i][1]);
            distances.push(distances[i-1] + d);
        }
        var totalDist = distances[distances.length - 1];

        var elevs = route.map(function(p) { return p[2]; });
        var minElev = Math.min.apply(null, elevs) - 20;
        var maxElev = Math.max.apply(null, elevs) + 20;
        var elevRange = maxElev - minElev || 1;

        var padL = 50, padR = 16, padT = 16, padB = 30;
        var chartW = w - padL - padR;
        var chartH = h - padT - padB;

        // Griglia
        ctx.strokeStyle = '#e5e7eb';
        ctx.lineWidth = 1;
        ctx.font = '11px -apple-system, sans-serif';
        ctx.fillStyle = '#9ca3af';
        ctx.textAlign = 'right';

        var elevSteps = 4;
        for (var s = 0; s <= elevSteps; s++) {
            var elev = minElev + (elevRange * s / elevSteps);
            var y = padT + chartH - (chartH * s / elevSteps);
            ctx.beginPath(); ctx.moveTo(padL, y); ctx.lineTo(w - padR, y); ctx.stroke();
            ctx.fillText(Math.round(elev) + ' m', padL - 6, y + 4);
        }

        // Etichette distanza
        ctx.textAlign = 'center';
        var distSteps = Math.min(6, Math.floor(totalDist));
        for (var d = 0; d <= distSteps; d++) {
            var dist = totalDist * d / distSteps;
            var x = padL + (chartW * d / distSteps);
            ctx.fillText((dist).toFixed(1) + ' km', x, h - 6);
        }

        // Area riempita
        ctx.beginPath();
        ctx.moveTo(padL, padT + chartH);
        for (var i = 0; i < route.length; i++) {
            var x = padL + (distances[i] / totalDist) * chartW;
            var y = padT + chartH - ((elevs[i] - minElev) / elevRange) * chartH;
            ctx.lineTo(x, y);
        }
        ctx.lineTo(padL + chartW, padT + chartH);
        ctx.closePath();

        var grad = ctx.createLinearGradient(0, padT, 0, padT + chartH);
        grad.addColorStop(0, 'rgba(27,58,92,0.3)');
        grad.addColorStop(1, 'rgba(27,58,92,0.05)');
        ctx.fillStyle = grad;
        ctx.fill();

        // Linea profilo
        ctx.beginPath();
        for (var i = 0; i < route.length; i++) {
            var x = padL + (distances[i] / totalDist) * chartW;
            var y = padT + chartH - ((elevs[i] - minElev) / elevRange) * chartH;
            if (i === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
        }
        ctx.strokeStyle = trailColor;
        ctx.lineWidth = 2.5;
        ctx.stroke();

        // Hover tooltip
        canvas.addEventListener('mousemove', function(e) {
            var rect = canvas.getBoundingClientRect();
            var mx = e.clientX - rect.left;
            if (mx < padL || mx > w - padR) { tooltip.style.display = 'none'; return; }
            var ratio = (mx - padL) / chartW;
            var dist = ratio * totalDist;
            // Trova punto più vicino
            var idx = 0;
            for (var i = 1; i < distances.length; i++) {
                if (distances[i] >= dist) { idx = i; break; }
            }
            var elev = elevs[idx];
            tooltip.innerHTML = '<strong>' + dist.toFixed(1) + ' km</strong><br>' + Math.round(elev) + ' m';
            tooltip.style.display = 'block';
            tooltip.style.left = mx + 'px';
        });
        canvas.addEventListener('mouseleave', function() { tooltip.style.display = 'none'; });
    }

    function haversine(lat1, lon1, lat2, lon2) {
        var R = 6371;
        var dLat = (lat2 - lat1) * Math.PI / 180;
        var dLon = (lon2 - lon1) * Math.PI / 180;
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(lat1*Math.PI/180) * Math.cos(lat2*Math.PI/180) * Math.sin(dLon/2) * Math.sin(dLon/2);
        return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    }
});
</script>

<!-- Descrizione + Dettagli -->
<section class="ig-apple-section ig-apple-section--white" style="padding-top:0">
    <div class="ig-apple-container">
        <div class="ig-itin-detail">
            <div class="ig-itin-detail__main">
                <h2 class="ig-itin-detail__heading">Descrizione</h2>
                <div class="ig-apple-body">
                    <?php the_content(); ?>
                </div>

                <?php if (!empty($tags)): ?>
                <h3 class="ig-itin-detail__subheading">Caratteristiche</h3>
                <div class="ig-itin-tags">
                    <?php foreach ($tags as $tag):
                        if (isset($tag_labels[$tag])): ?>
                        <span class="ig-itin-tag">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                            <?php echo esc_html($tag_labels[$tag]); ?>
                        </span>
                    <?php endif; endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <aside class="ig-itin-detail__sidebar">
                <div class="ig-itin-sidebar-card">
                    <h4 class="ig-itin-sidebar-card__title">Dati tecnici</h4>
                    <div class="ig-itin-sidebar-card__rows">
                        <?php if ($km): ?>
                        <div class="ig-itin-sidebar-card__row">
                            <span>Distanza</span><strong><?php echo esc_html($km); ?> km</strong>
                        </div>
                        <?php endif; ?>
                        <?php if ($hours && $hours !== '—'): ?>
                        <div class="ig-itin-sidebar-card__row">
                            <span>Durata</span><strong><?php echo esc_html($hours); ?></strong>
                        </div>
                        <?php endif; ?>
                        <?php if ($elevation): ?>
                        <div class="ig-itin-sidebar-card__row">
                            <span>Salita</span><strong>+<?php echo esc_html($elevation); ?> m</strong>
                        </div>
                        <?php endif; ?>
                        <?php if ($descent): ?>
                        <div class="ig-itin-sidebar-card__row">
                            <span>Discesa</span><strong>-<?php echo esc_html($descent); ?> m</strong>
                        </div>
                        <?php endif; ?>
                        <div class="ig-itin-sidebar-card__row">
                            <span>Difficoltà</span>
                            <strong><span class="ig-itin-diff-badge" style="background:<?php echo esc_attr($diff_colors[$difficulty] ?? '#F59E0B'); ?>"><?php echo esc_html(ucfirst($difficulty)); ?></span></strong>
                        </div>
                        <div class="ig-itin-sidebar-card__row">
                            <span>Tipo</span><strong style="color:<?php echo esc_attr($color); ?>"><?php echo esc_html($type_labels[$type] ?? ''); ?></strong>
                        </div>
                        <?php if ($zone): ?>
                        <div class="ig-itin-sidebar-card__row">
                            <span>Zona</span><strong><?php echo esc_html($zone); ?></strong>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($oa_id): ?>
                <a href="https://www.outdooractive.com/it/route/<?php echo esc_attr($oa_id); ?>" target="_blank" rel="noopener" class="ig-btn ig-btn--outline ig-btn--lg" style="width:100%;justify-content:center;margin-top:var(--sp-md)">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    Vedi su OutdoorActive
                </a>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</section>

<!-- Itinerari correlati -->
<?php
$related_args = [
    'post_type'      => 'itinerario',
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'rand',
];

// Prova prima stessa zona
$related_zone = new WP_Query(array_merge($related_args, [
    'meta_query' => [['key' => '_ig_itin_zone', 'value' => $zone]],
]));

if ($related_zone->found_posts >= 2) {
    $related = $related_zone;
} else {
    // Stesso tipo
    $related = new WP_Query(array_merge($related_args, [
        'meta_query' => [['key' => '_ig_itin_type', 'value' => $type]],
    ]));
    if ($related->found_posts < 2) {
        $related = new WP_Query($related_args);
    }
}

if ($related->have_posts()):
$r_type_colors = $type_colors;
$r_type_labels = $type_labels;
$r_diff_colors = $diff_colors;
?>
<section class="ig-apple-section ig-apple-section--light ig-reveal">
    <div class="ig-apple-container">
        <h2 class="ig-apple-title">Itinerari simili</h2>
        <div class="ig-exp-listing" style="margin-top:var(--sp-xl)">
            <?php while ($related->have_posts()): $related->the_post();
                $r_type = get_post_meta(get_the_ID(), '_ig_itin_type', true) ?: 'hiking';
                $r_diff = get_post_meta(get_the_ID(), '_ig_itin_difficulty', true) ?: 'media';
                $r_km   = get_post_meta(get_the_ID(), '_ig_itin_km', true);
                $r_zone = get_post_meta(get_the_ID(), '_ig_itin_zone', true);
                $r_hrs  = get_post_meta(get_the_ID(), '_ig_itin_hours', true);
                $r_col  = $r_type_colors[$r_type] ?? '#10B981';
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-exp-item">
                <div class="ig-exp-item__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card-wide');
                    else: ?>
                        <div class="ig-placeholder-img" style="background:<?php echo esc_attr($r_col); ?>22">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="<?php echo esc_attr($r_col); ?>" stroke-width="1.5"><path d="M3 17l5-10 4 6 4-8 5 12"/></svg>
                        </div>
                    <?php endif; ?>
                    <span class="ig-exp-item__badge" style="background:<?php echo esc_attr($r_col); ?>"><?php echo esc_html($r_type_labels[$r_type] ?? ''); ?></span>
                </div>
                <div class="ig-exp-item__body">
                    <h3 class="ig-exp-item__title"><?php the_title(); ?></h3>
                    <p class="ig-exp-item__loc">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <?php echo esc_html($r_zone); ?>
                        <?php if ($r_km): ?> · <?php echo esc_html($r_km); ?> km<?php endif; ?>
                        <?php if ($r_hrs && $r_hrs !== '—'): ?> · <?php echo esc_html($r_hrs); ?><?php endif; ?>
                    </p>
                    <p class="ig-exp-item__desc">
                        <span class="ig-itin-diff-badge" style="background:<?php echo esc_attr($r_diff_colors[$r_diff] ?? '#F59E0B'); ?>;font-size:11px"><?php echo esc_html(ucfirst($r_diff)); ?></span>
                    </p>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="ig-text-center" style="margin-top:var(--sp-xl)">
            <a href="<?php echo esc_url(home_url('/esperienze/attivita/')); ?>" class="ig-btn ig-btn--outline">Tutti gli itinerari</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA compatto -->
<section class="ig-apple-section ig-apple-section--cta" style="padding:var(--sp-2xl) 0">
    <div class="ig-apple-container ig-text-center">
        <p class="ig-apple-subtitle ig-apple-subtitle--white" style="margin:0">Hai bisogno di aiuto per pianificare? <button style="background:none;border:none;color:white;text-decoration:underline;font:inherit;cursor:pointer;padding:0" onclick="window.toggleGardaChat && window.toggleGardaChat()">Chiedi a Garda AI</button></p>
    </div>
</section>

<?php endwhile; get_footer(); ?>
