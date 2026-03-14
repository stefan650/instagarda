<?php
/**
 * Instagarda — Theme Functions
 */

// --- Theme Setup ---
function instagarda_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // Menu
    register_nav_menus([
        'primary'  => __('Menu Principale', 'instagarda'),
        'footer'   => __('Menu Footer', 'instagarda'),
    ]);

    // Image sizes
    add_image_size('hero', 1920, 1080, true);
    add_image_size('card', 600, 400, true);
    add_image_size('card-wide', 640, 420, true);
    add_image_size('card-square', 400, 400, true);
    add_image_size('card-portrait', 420, 747, true);
    add_image_size('listing-thumb', 320, 200, true);
}
add_action('after_setup_theme', 'instagarda_setup');

// --- Disable WordPress emoji (removes s.w.org external request) ---
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// --- SEO: Meta description, canonical, Open Graph, Twitter Cards ---
function ig_seo_meta() {
    $site_name = 'Instagarda';
    $default_img = get_template_directory_uri() . '/assets/images/og-default.jpg';
    $og_type = 'website';

    if (is_front_page()) {
        $title = 'Instagarda — La guida completa al Lago di Garda';
        $desc = 'Scopri il Lago di Garda: destinazioni, percorsi, sport, ristoranti e cultura. La guida completa per organizzare la tua vacanza al Garda.';
        $url = home_url('/');
        $img = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : $default_img;
    } elseif (is_singular()) {
        $title = get_the_title() . ' — ' . $site_name;
        $raw_desc = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30, '...');
        $desc = wp_strip_all_tags($raw_desc);
        $url = get_permalink();
        $img = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : $default_img;
        if (is_singular('post')) $og_type = 'article';
    } elseif (is_post_type_archive('destinazione')) {
        $title = 'Destinazioni Lago di Garda — ' . $site_name;
        $desc = 'Esplora tutte le destinazioni del Lago di Garda: da Sirmione a Riva del Garda, scopri i borghi, le spiagge e i paesaggi del più grande lago d\'Italia.';
        $url = get_post_type_archive_link('destinazione');
        $img = $default_img;
    } elseif (is_post_type_archive('evento')) {
        $title = 'Eventi Lago di Garda — ' . $site_name;
        $desc = 'Tutti gli eventi sul Lago di Garda: concerti, feste, sagre, mercatini, sport e cultura. Scopri cosa fare oggi e nei prossimi mesi.';
        $url = get_post_type_archive_link('evento');
        $img = $default_img;
    } elseif (is_home()) {
        $title = 'Magazine — ' . $site_name;
        $desc = 'Articoli, guide e consigli sul Lago di Garda: itinerari, enogastronomia, sport, borghi e segreti del più grande lago d\'Italia.';
        $url = get_permalink(get_option('page_for_posts')) ?: home_url('/blog/');
        $img = $default_img;
    } else {
        $title = get_bloginfo('name') . ' — La guida completa al Lago di Garda';
        $desc = 'Scopri il Lago di Garda: destinazioni, percorsi, sport, ristoranti e cultura. La guida completa per organizzare la tua vacanza al Garda.';
        $url = home_url(add_query_arg([], false));
        $img = $default_img;
    }

    $desc = mb_substr(wp_strip_all_tags($desc), 0, 160);

    // Meta description (critical for SEO)
    echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    // Canonical URL
    echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
    // Open Graph
    echo '<meta property="og:type" content="' . esc_attr($og_type) . '">' . "\n";
    echo '<meta property="og:locale" content="it_IT">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($img) . '">' . "\n";
    echo '<meta property="og:image:width" content="1200">' . "\n";
    echo '<meta property="og:image:height" content="630">' . "\n";
    // Twitter
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($img) . '">' . "\n";
    // Article-specific
    if (is_singular('post')) {
        echo '<meta property="article:published_time" content="' . esc_attr(get_the_date('c')) . '">' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr(get_the_modified_date('c')) . '">' . "\n";
    }
}
add_action('wp_head', 'ig_seo_meta', 1);

// --- SEO: Schema.org JSON-LD Structured Data ---
function ig_schema_jsonld() {
    $schemas = [];

    // Global: Organization + WebSite (on every page)
    $schemas[] = [
        '@type' => 'Organization',
        '@id'   => home_url('/#organization'),
        'name'  => 'Instagarda',
        'url'   => home_url('/'),
        'logo'  => [
            '@type' => 'ImageObject',
            'url'   => get_template_directory_uri() . '/assets/images/logo-cropped.png',
        ],
        'sameAs' => [
            'https://instagram.com/instagarda',
            'https://facebook.com/instagarda',
            'https://youtube.com/@instagarda',
            'https://tiktok.com/@instagarda',
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'email' => 'info@instagarda.net',
            'contactType' => 'customer service',
            'availableLanguage' => ['Italian', 'English'],
        ],
    ];

    $schemas[] = [
        '@type' => 'WebSite',
        '@id'   => home_url('/#website'),
        'name'  => 'Instagarda',
        'url'   => home_url('/'),
        'publisher' => ['@id' => home_url('/#organization')],
        'inLanguage' => 'it-IT',
    ];

    // BreadcrumbList (not on homepage)
    if (!is_front_page()) {
        $crumbs = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')]];
        $pos = 2;
        if (is_singular('destinazione')) {
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos++, 'name' => 'Destinazioni', 'item' => get_post_type_archive_link('destinazione')];
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos, 'name' => get_the_title()];
        } elseif (is_singular('itinerario')) {
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos++, 'name' => 'Percorsi & Sport', 'item' => home_url('/esperienze/attivita/')];
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos, 'name' => get_the_title()];
        } elseif (is_singular('post')) {
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos++, 'name' => 'Magazine', 'item' => get_permalink(get_option('page_for_posts')) ?: home_url('/blog/')];
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos, 'name' => get_the_title()];
        } elseif (is_singular('evento')) {
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos++, 'name' => 'Eventi', 'item' => home_url('/eventi/')];
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos, 'name' => get_the_title()];
        } elseif (is_singular('struttura')) {
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos++, 'name' => 'Esperienze', 'item' => home_url('/esperienze/')];
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos, 'name' => get_the_title()];
        }
        $schemas[] = ['@type' => 'BreadcrumbList', 'itemListElement' => $crumbs];
    }

    // Article schema for blog posts
    if (is_singular('post')) {
        $schemas[] = [
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => mb_substr(wp_strip_all_tags(has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30)), 0, 160),
            'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : '',
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => ['@type' => 'Organization', 'name' => 'Instagarda'],
            'publisher' => ['@id' => home_url('/#organization')],
            'mainEntityOfPage' => get_permalink(),
        ];
    }

    // TouristDestination for destinazioni
    if (is_singular('destinazione')) {
        $lat = get_post_meta(get_the_ID(), '_ig_lat', true);
        $lng = get_post_meta(get_the_ID(), '_ig_lng', true);
        $dest_schema = [
            '@type' => 'TouristDestination',
            'name' => get_the_title(),
            'description' => mb_substr(wp_strip_all_tags(has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 40)), 0, 200),
            'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : '',
            'url' => get_permalink(),
            'touristType' => ['Turisti', 'Famiglie', 'Sportivi', 'Coppie'],
            'containedInPlace' => [
                '@type' => 'Lake',
                'name' => 'Lago di Garda',
                'geo' => ['@type' => 'GeoCoordinates', 'latitude' => 45.65, 'longitude' => 10.72],
            ],
        ];
        if ($lat && $lng) {
            $dest_schema['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => (float)$lat, 'longitude' => (float)$lng];
        }
        $schemas[] = $dest_schema;
    }

    // SportsActivityLocation for itinerari
    if (is_singular('itinerario')) {
        $lat = get_post_meta(get_the_ID(), '_ig_itin_lat', true);
        $lng = get_post_meta(get_the_ID(), '_ig_itin_lng', true);
        $km = get_post_meta(get_the_ID(), '_ig_itin_km', true);
        $hours = get_post_meta(get_the_ID(), '_ig_itin_hours', true);
        $difficulty = get_post_meta(get_the_ID(), '_ig_itin_difficulty', true);
        $itin_schema = [
            '@type' => 'SportsActivityLocation',
            'name' => get_the_title(),
            'description' => mb_substr(wp_strip_all_tags(has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 40)), 0, 200),
            'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : '',
            'url' => get_permalink(),
        ];
        if ($lat && $lng) {
            $itin_schema['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => (float)$lat, 'longitude' => (float)$lng];
        }
        if ($km) $itin_schema['additionalProperty'][] = ['@type' => 'PropertyValue', 'name' => 'Distanza', 'value' => $km . ' km'];
        if ($hours) $itin_schema['additionalProperty'][] = ['@type' => 'PropertyValue', 'name' => 'Durata', 'value' => $hours];
        if ($difficulty) $itin_schema['additionalProperty'][] = ['@type' => 'PropertyValue', 'name' => 'Difficoltà', 'value' => $difficulty];
        $schemas[] = $itin_schema;
    }

    // Event schema
    if (is_singular('evento')) {
        $start = get_post_meta(get_the_ID(), '_ig_evento_data_inizio', true);
        $end = get_post_meta(get_the_ID(), '_ig_evento_data_fine', true);
        $luogo = get_post_meta(get_the_ID(), '_ig_evento_luogo', true);
        $evt_schema = [
            '@type' => 'Event',
            'name' => get_the_title(),
            'description' => mb_substr(wp_strip_all_tags(has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30)), 0, 200),
            'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : '',
            'url' => get_permalink(),
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
            'organizer' => ['@type' => 'Organization', 'name' => 'Instagarda'],
        ];
        if ($start) $evt_schema['startDate'] = $start;
        if ($end) $evt_schema['endDate'] = $end;
        if ($luogo) $evt_schema['location'] = ['@type' => 'Place', 'name' => $luogo, 'address' => ['@type' => 'PostalAddress', 'addressRegion' => 'Lago di Garda, Italia']];
        $schemas[] = $evt_schema;
    }

    // Output
    $output = ['@context' => 'https://schema.org', '@graph' => $schemas];
    echo '<script type="application/ld+json">' . wp_json_encode($output, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'ig_schema_jsonld', 2);

// --- SEO: Remove duplicate title tag from wp_head if theme already handles it ---
remove_action('wp_head', 'rel_canonical');

// --- Destinazioni: ordine alfabetico e mostra tutte ---
function ig_destinazioni_order($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('destinazione')) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
}
add_action('pre_get_posts', 'ig_destinazioni_order');

// --- Enqueue Styles & Scripts ---
function instagarda_assets() {
    // Self-hosted fonts — GDPR compliant (no external requests)
    wp_enqueue_style('instagarda-fonts',
        get_template_directory_uri() . '/assets/css/fonts.css',
        [], '1.0.0'
    );

    wp_enqueue_style('instagarda-style',
        get_template_directory_uri() . '/assets/css/main.css',
        ['instagarda-fonts'], '1.0.5'
    );

    wp_enqueue_script('instagarda-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [], '1.0.5', true
    );

    // Garda Concierge Chat Widget
    wp_enqueue_style('garda-chat',
        get_template_directory_uri() . '/assets/css/garda-chat.css',
        [], '1.0.3'
    );
    wp_enqueue_script('garda-chat',
        get_template_directory_uri() . '/assets/js/garda-chat.js',
        [], '1.0.3', true
    );

    // Passa dati al JS
    wp_localize_script('instagarda-js', 'instagarda', [
        'ajax_url'  => admin_url('admin-ajax.php'),
        'theme_url' => get_template_directory_uri(),
        'chat_api'  => '/api/chat',
    ]);

    // Leaflet per pagine destinazione, itinerari e pagine con mappa
    if (is_singular('destinazione') || is_post_type_archive('destinazione') || is_singular('itinerario')) {
        wp_enqueue_style('leaflet-css',
            get_template_directory_uri() . '/assets/css/leaflet.css',
            [], '1.9.4'
        );
        wp_enqueue_script('leaflet-js',
            get_template_directory_uri() . '/assets/js/leaflet.js',
            [], '1.9.4', true
        );
        // Mappa singola destinazione
        if (is_singular('destinazione')) {
            wp_enqueue_script('instagarda-map',
                get_template_directory_uri() . '/assets/js/dest-map.js',
                ['leaflet-js'], '1.0.0', true
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'instagarda_assets');

// --- Custom Post Types ---
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/trail-route-api.php';

// --- Widget Areas ---
function instagarda_widgets() {
    register_sidebar([
        'name'          => __('Footer Col 1', 'instagarda'),
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ]);
    register_sidebar([
        'name'          => __('Footer Col 2', 'instagarda'),
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'instagarda_widgets');

// --- Excerpt length ---
function instagarda_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'instagarda_excerpt_length');

// --- Custom excerpt more ---
function instagarda_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'instagarda_excerpt_more');

// --- Body classes ---
function instagarda_body_classes($classes) {
    if (is_singular('destinazione') || is_singular('struttura') || is_singular('evento') || is_post_type_archive('evento')) {
        $classes[] = 'has-hero-header';
    }
    return $classes;
}
add_filter('body_class', 'instagarda_body_classes');

// --- Helper: get destination meta ---
function ig_get_meta($key, $post_id = null) {
    if (!$post_id) $post_id = get_the_ID();
    return get_post_meta($post_id, '_ig_' . $key, true);
}

// --- Banner "In Lavorazione" per pagine WIP ---
function ig_wip_banner($content) {
    if (!is_singular()) return $content;
    $wip = get_post_meta(get_the_ID(), '_ig_wip', true);
    if ($wip !== '1') return $content;
    $banner = '<div class="ig-wip-banner">'
        . '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v4m0 4h.01M3.6 20h16.8a1.6 1.6 0 001.37-2.41L13.37 4.18a1.6 1.6 0 00-2.74 0L2.23 17.59A1.6 1.6 0 003.6 20z"/></svg>'
        . '<span>Questa pagina è ancora in lavorazione. Alcuni contenuti potrebbero essere incompleti.</span>'
        . '</div>';
    return $banner . $content;
}
add_filter('the_content', 'ig_wip_banner');

// --- Invalida cache footer quando si modifica/elimina una destinazione ---
function ig_invalidate_footer_cache($post_id) {
    if (get_post_type($post_id) === 'destinazione') {
        delete_transient('ig_footer_destinations');
    }
}
add_action('save_post', 'ig_invalidate_footer_cache');
add_action('delete_post', 'ig_invalidate_footer_cache');

// --- Iubenda Liquid Glass (loaded via wp_footer to override Iubenda's dynamic CSS) ---
function ig_iubenda_glass() { ?>
<script>
(function(){
var styled=false;
var o=new MutationObserver(function(){
    var b=document.getElementById('iubenda-cs-banner');
    if(b&&!styled){
        styled=true;
        // Banner: full-width bar fixed at very bottom
        b.style.setProperty('position','fixed','important');
        b.style.setProperty('bottom','0','important');
        b.style.setProperty('top','auto','important');
        b.style.setProperty('left','0','important');
        b.style.setProperty('right','0','important');
        b.style.setProperty('transform','none','important');
        b.style.setProperty('width','100%','important');
        b.style.setProperty('max-width','100%','important');
        b.style.setProperty('margin','0','important');
        b.style.setProperty('border-radius','0','important');
        // Container
        var ct=b.querySelector('.iubenda-cs-container');
        if(ct){ct.style.setProperty('max-width','100%','important');ct.style.setProperty('margin','0','important');ct.style.setProperty('width','100%','important');ct.style.setProperty('padding','0','important');}
        // Kill all extra padding/margin on inner wrappers
        b.querySelectorAll('div').forEach(function(d){d.style.setProperty('padding-top','0','important');d.style.setProperty('padding-bottom','0','important');d.style.setProperty('margin-top','0','important');d.style.setProperty('margin-bottom','0','important');});
        // Content: opaque glass
        var c=b.querySelector('.iubenda-cs-content');
        if(c){
            c.style.setProperty('background','rgba(15,15,18,0.75)','important');
            c.style.setProperty('backdrop-filter','blur(40px) saturate(1.8)','important');
            c.style.setProperty('-webkit-backdrop-filter','blur(40px) saturate(1.8)','important');
            c.style.setProperty('border','1px solid rgba(255,255,255,0.12)','important');
            c.style.setProperty('border-radius','0','important');
            c.style.setProperty('box-shadow','0 -4px 30px rgba(0,0,0,0.15), inset 0 1px 0 rgba(255,255,255,0.08)','important');
            c.style.setProperty('margin','0','important');
            c.style.setProperty('max-width','100%','important');
            c.style.setProperty('width','100%','important');
            c.style.setProperty('padding','8px 24px','important');
        }
        // Force single row layout
        b.querySelectorAll('div').forEach(function(d){
            var s=getComputedStyle(d);
            if(s.display==='flex'&&s.flexDirection==='column'){
                d.style.setProperty('flex-direction','row','important');
                d.style.setProperty('align-items','center','important');
                d.style.setProperty('gap','20px','important');
                d.style.setProperty('flex-wrap','nowrap','important');
            }
        });
        // Text smaller
        b.querySelectorAll('.iubenda-banner-content,.iubenda-cs-message,p').forEach(function(t){
            t.style.setProperty('font-size','11px','important');
            t.style.setProperty('line-height','1.4','important');
            t.style.setProperty('margin','0','important');
        });
        // All buttons smaller
        b.querySelectorAll('.iubenda-cs-opt-group button,[class*="iubenda-cs"] button').forEach(function(btn){
            btn.style.setProperty('font-size','11px','important');
            btn.style.setProperty('padding','6px 16px','important');
        });
        // Buttons
        b.querySelectorAll('.iubenda-cs-accept-btn').forEach(function(a){
            a.style.setProperty('background','rgba(0,122,255,0.85)','important');
            a.style.setProperty('border','1px solid rgba(0,122,255,0.5)','important');
            a.style.setProperty('border-radius','100px','important');
            a.style.setProperty('box-shadow','0 2px 16px rgba(0,122,255,0.25), inset 0 1px 0 rgba(255,255,255,0.2)','important');
        });
        b.querySelectorAll('.iubenda-cs-reject-btn').forEach(function(a){
            a.style.setProperty('background','rgba(255,255,255,0.1)','important');
            a.style.setProperty('border','1px solid rgba(255,255,255,0.18)','important');
            a.style.setProperty('border-radius','100px','important');
        });
        b.querySelectorAll('.iubenda-cs-customize-btn').forEach(function(a){
            a.style.setProperty('background','rgba(255,255,255,0.06)','important');
            a.style.setProperty('border','1px solid rgba(255,255,255,0.12)','important');
            a.style.setProperty('border-radius','100px','important');
        });
        o.disconnect();
    }
});
o.observe(document.documentElement,{childList:true,subtree:true});
setTimeout(function(){o.disconnect();},15000);
})();
</script>
<?php }
add_action('wp_footer', 'ig_iubenda_glass', 99);
