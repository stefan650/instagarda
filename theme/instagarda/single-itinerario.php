<?php
/**
 * Single: Itinerario
 */
get_header();

while (have_posts()): the_post();

$type       = get_post_meta(get_the_ID(), '_ig_itin_type', true) ?: 'hiking';
$status     = get_post_meta(get_the_ID(), '_ig_itin_status', true) ?: 'aperto';
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
$parking     = get_post_meta(get_the_ID(), '_ig_itin_parking', true);
$how_to_reach = get_post_meta(get_the_ID(), '_ig_itin_how_to_reach', true);
$equipment   = get_post_meta(get_the_ID(), '_ig_itin_equipment', true);
$directions  = get_post_meta(get_the_ID(), '_ig_itin_directions', true);
$safety      = get_post_meta(get_the_ID(), '_ig_itin_safety', true);
$oa_url      = get_post_meta(get_the_ID(), '_ig_outdooractive_url', true);
$photo_credit = get_post_meta(get_the_ID(), '_ig_itin_photo_credit', true);
$instagram_raw = get_post_meta(get_the_ID(), '_ig_itin_instagram', true);
$instagram_urls = $instagram_raw ? array_filter(array_map('trim', explode("\n", $instagram_raw))) : [];

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
                <?php echo wp_kses_post($type_icons[$type] ?? ''); ?>
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
<?php if ($photo_credit): ?>
    <div class="ig-dest-hero__credit">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <?php echo esc_html($photo_credit); ?>
    </div>
<?php endif; ?>
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
                    <div class="ig-itin-surface__segment" style="width:<?php echo esc_attr($pct); ?>%;background:<?php echo esc_attr($s[2]); ?>"></div>
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

    // ─── Profilo altimetrico (stile Outdooractive) ───
    function drawElevationProfile(route) {
        var wrap = document.getElementById('igItinProfileWrap');
        var canvas = document.getElementById('igItinProfile');
        var tooltip = document.getElementById('igItinTooltip');
        wrap.style.display = 'block';

        var ctx = canvas.getContext('2d');
        var dpr = window.devicePixelRatio || 1;
        var w = wrap.offsetWidth;
        var h = 180;
        canvas.width = w * dpr;
        canvas.height = h * dpr;
        canvas.style.width = w + 'px';
        canvas.style.height = h + 'px';
        ctx.scale(dpr, dpr);

        // Calcola distanze cumulative
        var rawDist = [0];
        for (var i = 1; i < route.length; i++) {
            var d = haversine(route[i-1][0], route[i-1][1], route[i][0], route[i][1]);
            rawDist.push(rawDist[i-1] + d);
        }
        var totalDist = rawDist[rawDist.length - 1];
        var rawElevs = route.map(function(p) { return p[2]; });

        // ─── Downsample a ~300 punti equidistanti e smooth ───
        var N = Math.min(300, route.length);
        var pts = []; // {d, e} — distanza e quota
        for (var i = 0; i < N; i++) {
            var targetD = (i / (N - 1)) * totalDist;
            // Trova segmento
            var j = 1;
            while (j < rawDist.length - 1 && rawDist[j] < targetD) j++;
            var segLen = rawDist[j] - rawDist[j-1];
            var t = segLen > 0 ? (targetD - rawDist[j-1]) / segLen : 0;
            var elev = rawElevs[j-1] + t * (rawElevs[j] - rawElevs[j-1]);
            pts.push({ d: targetD, e: elev });
        }

        // Smooth: media mobile 3 passate
        for (var pass = 0; pass < 3; pass++) {
            var smoothed = [];
            var win = Math.max(3, Math.round(N / 60));
            for (var i = 0; i < pts.length; i++) {
                var sum = 0, count = 0;
                for (var k = Math.max(0, i - win); k <= Math.min(pts.length - 1, i + win); k++) {
                    sum += pts[k].e; count++;
                }
                smoothed.push({ d: pts[i].d, e: sum / count });
            }
            pts = smoothed;
        }

        var elevs = pts.map(function(p) { return p.e; });
        var distances = pts.map(function(p) { return p.d; });

        var rawMin = Math.min.apply(null, elevs);
        var rawMax = Math.max.apply(null, elevs);

        // Step "belli" per asse Y
        var rawRange = rawMax - rawMin || 1;
        var niceStep = rawRange / 4;
        var mag = Math.pow(10, Math.floor(Math.log10(niceStep)));
        var residual = niceStep / mag;
        if (residual <= 1.5) niceStep = mag;
        else if (residual <= 3.5) niceStep = 2 * mag;
        else if (residual <= 7.5) niceStep = 5 * mag;
        else niceStep = 10 * mag;
        niceStep = Math.max(niceStep, 1);

        var minElev = Math.floor(rawMin / niceStep) * niceStep;
        var maxElev = Math.ceil(rawMax / niceStep) * niceStep;
        if (maxElev === minElev) maxElev = minElev + niceStep;
        var elevRange = maxElev - minElev;
        var elevSteps = Math.round(elevRange / niceStep);

        var padL = 56, padR = 20, padT = 14, padB = 14;
        var chartW = w - padL - padR;
        var chartH = h - padT - padB;

        // Coordinate canvas per i punti smooth
        var pxPts = [];
        for (var i = 0; i < pts.length; i++) {
            pxPts.push({
                x: padL + (distances[i] / totalDist) * chartW,
                y: padT + chartH - ((elevs[i] - minElev) / elevRange) * chartH
            });
        }

        // Disegna il profilo con curva spline
        function drawSmooth(ctx, points, close) {
            if (close) {
                ctx.moveTo(padL, padT + chartH);
                ctx.lineTo(points[0].x, points[0].y);
            } else {
                ctx.moveTo(points[0].x, points[0].y);
            }
            for (var i = 0; i < points.length - 1; i++) {
                var x0 = points[i].x, y0 = points[i].y;
                var x1 = points[i+1].x, y1 = points[i+1].y;
                var cpx = (x0 + x1) / 2;
                ctx.bezierCurveTo(cpx, y0, cpx, y1, x1, y1);
            }
            if (close) {
                ctx.lineTo(points[points.length-1].x, padT + chartH);
                ctx.closePath();
            }
        }

        function redraw() {
            ctx.clearRect(0, 0, w, h);
            // Sfondo
            ctx.fillStyle = '#f5f6f8';
            ctx.fillRect(padL, padT, chartW, chartH);
            // Griglia
            ctx.font = '12px -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';
            ctx.textAlign = 'right';
            ctx.textBaseline = 'middle';
            for (var s = 0; s <= elevSteps; s++) {
                var elev = minElev + niceStep * s;
                var y = padT + chartH - (chartH * s / elevSteps);
                ctx.strokeStyle = '#e0e2e6';
                ctx.lineWidth = 1;
                ctx.beginPath(); ctx.moveTo(padL, y); ctx.lineTo(padL + chartW, y); ctx.stroke();
                ctx.fillStyle = '#6b7280';
                ctx.fillText(Math.round(elev) + ' m', padL - 8, y);
            }
            // Area morbida
            ctx.beginPath();
            drawSmooth(ctx, pxPts, true);
            ctx.fillStyle = '#d5d8de';
            ctx.fill();
            // Linea morbida
            ctx.beginPath();
            drawSmooth(ctx, pxPts, false);
            ctx.strokeStyle = '#2d3748';
            ctx.lineWidth = 2;
            ctx.lineJoin = 'round';
            ctx.lineCap = 'round';
            ctx.stroke();
        }

        redraw();

        // ─── Hover interattivo ───
        canvas.addEventListener('mousemove', function(e) {
            var rect = canvas.getBoundingClientRect();
            var mx = (e.clientX - rect.left);
            if (mx < padL || mx > padL + chartW) { tooltip.style.display = 'none'; redraw(); return; }

            var ratio = (mx - padL) / chartW;
            var dist = ratio * totalDist;
            // Trova punto smooth più vicino
            var idx = 0;
            for (var i = 1; i < distances.length; i++) {
                if (distances[i] >= dist) { idx = i; break; }
            }
            var py = pxPts[idx].y;

            redraw();
            // Linea verticale tratteggiata
            ctx.save();
            ctx.strokeStyle = 'rgba(45,55,72,0.4)';
            ctx.lineWidth = 1;
            ctx.setLineDash([4, 3]);
            ctx.beginPath(); ctx.moveTo(mx, padT); ctx.lineTo(mx, padT + chartH); ctx.stroke();
            ctx.restore();
            // Punto
            ctx.beginPath();
            ctx.arc(mx, py, 4, 0, Math.PI * 2);
            ctx.fillStyle = '#2d3748';
            ctx.fill();
            ctx.strokeStyle = '#fff';
            ctx.lineWidth = 2;
            ctx.stroke();

            tooltip.innerHTML = '<strong>' + Math.round(elevs[idx]) + ' m</strong><span style="color:rgba(255,255,255,.7);margin-left:8px">' + dist.toFixed(1) + ' km</span>';
            tooltip.style.display = 'flex';
            tooltip.style.left = Math.min(Math.max(mx, 60), w - 60) + 'px';
        });
        canvas.addEventListener('mouseleave', function() { tooltip.style.display = 'none'; redraw(); });
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

<!-- Dettagli con Tab stile Outdooractive -->
<section class="ig-apple-section ig-apple-section--white" style="padding-top:0">
    <div class="ig-apple-container">
        <div class="ig-itin-detail">
            <div class="ig-itin-detail__main">

                <!-- Tab navigation -->
                <nav class="ig-itin-tabs">
                    <button class="ig-itin-tabs__btn ig-itin-tabs__btn--active" data-tab="dettagli">Dettagli</button>
                    <button class="ig-itin-tabs__btn" data-tab="direzioni">Direzioni da seguire</button>
                    <button class="ig-itin-tabs__btn" data-tab="arrivare">Come arrivare</button>
                    <button class="ig-itin-tabs__btn" data-tab="attrezzatura">Attrezzatura</button>
                    <?php if ($lat && $lng): ?>
                    <button class="ig-itin-tabs__btn" data-tab="meteo">Meteo</button>
                    <?php endif; ?>
                </nav>

                <!-- Tab: Dettagli -->
                <div class="ig-itin-tab-panel ig-itin-tab-panel--active" id="igTab-dettagli">
                    <div class="ig-apple-body">
                        <?php the_content(); ?>
                    </div>

                    <?php if (!empty($instagram_urls)): ?>
                    <h3 class="ig-itin-detail__subheading">Video</h3>
                    <div class="ig-itin-reels">
                        <?php foreach ($instagram_urls as $ig_url):
                            // Estrai il codice dal URL Instagram
                            if (preg_match('#instagram\.com/(?:p|reel)/([A-Za-z0-9_-]+)#', $ig_url, $ig_match)):
                                $ig_code = $ig_match[1];
                        ?>
                        <div class="ig-itin-reel">
                            <iframe src="https://www.instagram.com/p/<?php echo esc_attr($ig_code); ?>/embed/" frameborder="0" scrolling="no" allowtransparency="true" loading="lazy"></iframe>
                        </div>
                        <?php endif; endforeach; ?>
                    </div>
                    <?php endif; ?>

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

                <!-- Tab: Direzioni da seguire -->
                <div class="ig-itin-tab-panel" id="igTab-direzioni">
                    <?php if ($directions): ?>
                    <h3 class="ig-itin-detail__subheading" style="margin-top:0">Direzioni da seguire</h3>
                    <div class="ig-apple-body"><?php echo wp_kses_post(wpautop($directions)); ?></div>
                    <?php else: ?>
                    <p style="color:var(--ig-muted)">Le direzioni dettagliate del percorso non sono ancora disponibili per questo itinerario.</p>
                    <?php endif; ?>
                </div>

                <!-- Tab: Come arrivare -->
                <div class="ig-itin-tab-panel" id="igTab-arrivare">
                    <?php if ($how_to_reach): ?>
                    <h3 class="ig-itin-detail__subheading" style="margin-top:0">Come arrivare</h3>
                    <div class="ig-apple-body"><?php echo wp_kses_post(wpautop($how_to_reach)); ?></div>
                    <?php endif; ?>

                    <?php if ($parking): ?>
                    <h3 class="ig-itin-detail__subheading"<?php echo !$how_to_reach ? ' style="margin-top:0"' : ''; ?>>Dove parcheggiare</h3>
                    <div class="ig-apple-body"><?php echo wp_kses_post(wpautop($parking)); ?></div>
                    <?php endif; ?>

                    <?php if ($lat && $lng):
                        // Calcola coordinate DMS
                        $lat_f = floatval($lat);
                        $lng_f = floatval($lng);
                        $lat_dir = $lat_f >= 0 ? 'N' : 'S';
                        $lng_dir = $lng_f >= 0 ? 'E' : 'W';
                        $lat_abs = abs($lat_f);
                        $lng_abs = abs($lng_f);
                        $lat_deg = floor($lat_abs);
                        $lat_min = floor(($lat_abs - $lat_deg) * 60);
                        $lat_sec = round(($lat_abs - $lat_deg - $lat_min / 60) * 3600, 1);
                        $lng_deg = floor($lng_abs);
                        $lng_min = floor(($lng_abs - $lng_deg) * 60);
                        $lng_sec = round(($lng_abs - $lng_deg - $lng_min / 60) * 3600, 1);
                        $dms = $lat_deg . '°' . $lat_min . "'" . $lat_sec . '"' . $lat_dir . ' ' . $lng_deg . '°' . $lng_min . "'" . $lng_sec . '"' . $lng_dir;
                    ?>
                    <h3 class="ig-itin-detail__subheading">Coordinate punto di partenza</h3>
                    <div class="ig-itin-coords">
                        <div class="ig-itin-coords__row">
                            <span class="ig-itin-coords__label">DD</span>
                            <span class="ig-itin-coords__value" id="igCoordDD"><?php echo esc_html($lat . ', ' . $lng); ?></span>
                            <button class="ig-itin-coords__copy" onclick="navigator.clipboard.writeText('<?php echo esc_js($lat . ', ' . $lng); ?>')" title="Copia">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
                            </button>
                        </div>
                        <div class="ig-itin-coords__row">
                            <span class="ig-itin-coords__label">DMS</span>
                            <span class="ig-itin-coords__value"><?php echo esc_html($dms); ?></span>
                            <button class="ig-itin-coords__copy" onclick="navigator.clipboard.writeText('<?php echo esc_js($dms); ?>')" title="Copia">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
                            </button>
                        </div>
                    </div>

                    <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:var(--sp-lg)">
                        <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo esc_attr($lat); ?>,<?php echo esc_attr($lng); ?>" target="_blank" rel="noopener" class="ig-btn ig-btn--primary" style="display:inline-flex;align-items:center;gap:6px">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                            Naviga al punto di partenza
                        </a>
                        <a href="https://www.google.com/maps/@<?php echo esc_attr($lat); ?>,<?php echo esc_attr($lng); ?>,15z" target="_blank" rel="noopener" class="ig-btn ig-btn--outline" style="display:inline-flex;align-items:center;gap:6px">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            Mostra sulla mappa
                        </a>
                    </div>
                    <?php elseif (!$how_to_reach && !$parking): ?>
                    <p style="color:var(--ig-muted)">Le indicazioni per raggiungere questo itinerario non sono ancora disponibili.</p>
                    <?php endif; ?>
                </div>

                <!-- Tab: Attrezzatura -->
                <div class="ig-itin-tab-panel" id="igTab-attrezzatura">
                    <?php if ($equipment): ?>
                    <h3 class="ig-itin-detail__subheading" style="margin-top:0">Attrezzatura consigliata</h3>
                    <div class="ig-apple-body"><?php echo wp_kses_post(wpautop($equipment)); ?></div>
                    <?php endif; ?>

                    <?php if ($safety): ?>
                    <h3 class="ig-itin-detail__subheading"<?php echo !$equipment ? ' style="margin-top:0"' : ''; ?>>Sicurezza</h3>
                    <div class="ig-apple-body"><?php echo wp_kses_post(wpautop($safety)); ?></div>
                    <?php endif; ?>

                    <?php if (!$equipment && !$safety): ?>
                    <p style="color:var(--ig-muted)">Le informazioni sull'attrezzatura non sono ancora disponibili per questo itinerario.</p>
                    <?php endif; ?>
                </div>

                <!-- Tab: Meteo -->
                <?php if ($lat && $lng): ?>
                <div class="ig-itin-tab-panel" id="igTab-meteo">
                    <div id="igWeatherForecast" class="ig-itin-weather">
                        <p style="color:var(--ig-muted)">Caricamento previsioni...</p>
                    </div>
                </div>
                <script>
                (function(){
                    var weatherCodes = {0:'Sereno',1:'Prevalentemente sereno',2:'Parzialmente nuvoloso',3:'Coperto',45:'Nebbia',48:'Nebbia con brina',51:'Pioviggine leggera',53:'Pioviggine',55:'Pioviggine intensa',61:'Pioggia leggera',63:'Pioggia',65:'Pioggia intensa',71:'Neve leggera',73:'Neve',75:'Neve intensa',80:'Rovesci leggeri',81:'Rovesci',82:'Rovesci intensi',95:'Temporale',96:'Temporale con grandine',99:'Temporale forte'};
                    var weatherIcons = {0:'\u2600\uFE0F',1:'\u26C5',2:'\u26C5',3:'\u2601\uFE0F',45:'\uD83C\uDF2B\uFE0F',48:'\uD83C\uDF2B\uFE0F',51:'\uD83C\uDF26',53:'\uD83C\uDF27',55:'\uD83C\uDF27',61:'\uD83C\uDF26',63:'\uD83C\uDF27',65:'\uD83C\uDF27',71:'\uD83C\uDF28',73:'\u2744\uFE0F',75:'\u2744\uFE0F',80:'\uD83C\uDF26',81:'\uD83C\uDF27',82:'\u26C8',95:'\u26C8',96:'\u26C8',99:'\u26C8'};
                    var days = ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'];
                    fetch('https://api.open-meteo.com/v1/forecast?latitude=<?php echo esc_js($lat); ?>&longitude=<?php echo esc_js($lng); ?>&daily=weather_code,temperature_2m_max,temperature_2m_min,precipitation_probability_max&timezone=Europe/Rome&forecast_days=7')
                        .then(function(r){return r.json()})
                        .then(function(d){
                            var el=document.getElementById('igWeatherForecast');
                            if(!el||!d.daily) return;
                            var html='<div class="ig-itin-weather__grid">';
                            for(var i=0;i<d.daily.time.length;i++){
                                var dt=new Date(d.daily.time[i]+'T12:00:00');
                                var day=days[dt.getDay()];
                                var date=dt.getDate()+'/'+(dt.getMonth()+1);
                                var code=d.daily.weather_code[i];
                                var icon=weatherIcons[code]||'\u2601\uFE0F';
                                var desc=weatherCodes[code]||'';
                                var tMax=Math.round(d.daily.temperature_2m_max[i]);
                                var tMin=Math.round(d.daily.temperature_2m_min[i]);
                                var rain=d.daily.precipitation_probability_max[i]||0;
                                html+='<div class="ig-itin-weather__day'+(i===0?' ig-itin-weather__day--today':'')+'">';
                                html+='<span class="ig-itin-weather__label">'+(i===0?'Oggi':day)+'</span>';
                                html+='<span class="ig-itin-weather__date">'+date+'</span>';
                                html+='<span class="ig-itin-weather__icon">'+icon+'</span>';
                                html+='<span class="ig-itin-weather__temp"><strong>'+tMax+'\u00B0</strong> / '+tMin+'\u00B0</span>';
                                html+='<span class="ig-itin-weather__desc">'+desc+'</span>';
                                if(rain>0) html+='<span class="ig-itin-weather__rain">\uD83D\uDCA7 '+rain+'%</span>';
                                html+='</div>';
                            }
                            html+='</div>';
                            el.innerHTML=html;
                        }).catch(function(){ document.getElementById('igWeatherForecast').innerHTML='<p>Previsioni non disponibili</p>'; });
                })();
                </script>
                <?php endif; ?>

            </div>

            <aside class="ig-itin-detail__sidebar">
                <div class="ig-itin-sidebar-card">
                    <h4 class="ig-itin-sidebar-card__title">Dati tecnici</h4>
                    <?php
                        $status_labels = ['aperto' => 'Aperto', 'chiuso' => 'Chiuso', 'parziale' => 'Parzialmente aperto'];
                        $status_colors = ['aperto' => '#10B981', 'chiuso' => '#EF4444', 'parziale' => '#F59E0B'];
                    ?>
                    <div class="ig-itin-sidebar-card__rows">
                        <div class="ig-itin-sidebar-card__row">
                            <span>Stato</span>
                            <strong><span class="ig-itin-status-badge" style="background:<?php echo esc_attr($status_colors[$status] ?? '#10B981'); ?>"><?php echo esc_html($status_labels[$status] ?? 'Aperto'); ?></span></strong>
                        </div>
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

                <?php if ($oa_url): ?>
                <a href="<?php echo esc_url($oa_url); ?>" target="_blank" rel="noopener" class="ig-btn ig-btn--outline ig-btn--lg" style="width:100%;justify-content:center;margin-top:var(--sp-md)">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    Vedi su OutdoorActive
                </a>
                <?php elseif ($oa_id): ?>
                <a href="https://www.outdooractive.com/it/route/<?php echo esc_attr($oa_id); ?>" target="_blank" rel="noopener" class="ig-btn ig-btn--outline ig-btn--lg" style="width:100%;justify-content:center;margin-top:var(--sp-md)">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    Vedi su OutdoorActive
                </a>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</section>

<!-- Tab switching -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var btns = document.querySelectorAll('.ig-itin-tabs__btn');
    btns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            btns.forEach(function(b) { b.classList.remove('ig-itin-tabs__btn--active'); });
            btn.classList.add('ig-itin-tabs__btn--active');
            document.querySelectorAll('.ig-itin-tab-panel').forEach(function(p) { p.classList.remove('ig-itin-tab-panel--active'); });
            var panel = document.getElementById('igTab-' + btn.getAttribute('data-tab'));
            if (panel) panel.classList.add('ig-itin-tab-panel--active');
        });
    });
});
</script>

<!-- Itinerari correlati -->
<?php
$related_args = [
    'post_type'      => 'itinerario',
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'date',
    'order'          => 'DESC',
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
