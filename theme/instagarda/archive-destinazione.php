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

<!-- Mappa Interattiva -->
<section class="ig-section ig-section--white ig-section--compact">
    <div class="ig-container">
        <div id="ig-luoghi-map" style="height: 450px; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);"></div>
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

<!-- Script Mappa Leaflet -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Coordinate fallback per le principali località
    var coords = {
        'sirmione': [45.4964, 10.6079],
        'desenzano-del-garda': [45.4711, 10.5374],
        'salo': [45.6069, 10.5214],
        'gardone-riviera': [45.6219, 10.5594],
        'toscolano-maderno': [45.6394, 10.6097],
        'gargnano': [45.6844, 10.6606],
        'limone-sul-garda': [45.8126, 10.7918],
        'tremosine-sul-garda': [45.7658, 10.7528],
        'peschiera-del-garda': [45.4387, 10.6919],
        'lazise': [45.5050, 10.7320],
        'bardolino': [45.5458, 10.7228],
        'garda': [45.5749, 10.7089],
        'torri-del-benaco': [45.6097, 10.6878],
        'malcesine': [45.7636, 10.8107],
        'brenzone-sul-garda': [45.7022, 10.7620],
        'riva-del-garda': [45.8862, 10.8412],
        'torbole': [45.8748, 10.8739],
        'arco': [45.9178, 10.8854],
        'brescia': [45.5415, 10.2115],
        'verona': [45.4384, 10.9916],
        'trento': [46.0748, 11.1217],
        'mantova': [45.1564, 10.7914]
    };
    
    // Inizializza mappa centrata sul Lago di Garda
    var map = L.map('ig-luoghi-map').setView([45.6, 10.7], 10);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 18
    }).addTo(map);
    
    // Crea marker per ogni destinazione
    var bounds = L.latLngBounds();
    var markers = [];
    
    document.querySelectorAll('.ig-dest-card').forEach(function(card) {
        var link = card.getAttribute('href');
        var slug = link.split('/').filter(Boolean).pop();
        var title = card.querySelector('.ig-dest-card__title').textContent;
        var latLng = coords[slug];
        
        if (latLng) {
            var marker = L.marker(latLng).addTo(map);
            marker.bindPopup('<strong>' + title + '</strong><br><a href="' + link + '">Scopri →</a>');
            
            marker.on('click', function() {
                // Scroll alla card corrispondente
                card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                card.style.transform = 'scale(1.05)';
                card.style.boxShadow = '0 8px 30px rgba(0,122,255,0.3)';
                setTimeout(function() {
                    card.style.transform = '';
                    card.style.boxShadow = '';
                }, 1500);
            });
            
            markers.push(marker);
            bounds.extend(latLng);
        }
    });
    
    // Adatta mappa per mostrare tutti i marker
    if (markers.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50] });
    }
});
</script>

<?php get_footer(); ?>
