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
    add_image_size('listing-thumb', 320, 200, true);
}
add_action('after_setup_theme', 'instagarda_setup');

// --- Enqueue Styles & Scripts ---
function instagarda_assets() {
    // Google Fonts — Poppins + Playfair Display
    wp_enqueue_style('google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700;800&display=swap',
        [], null
    );

    wp_enqueue_style('instagarda-style',
        get_template_directory_uri() . '/assets/css/main.css',
        ['google-fonts'], '1.0.2'
    );

    wp_enqueue_script('instagarda-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [], '1.0.2', true
    );

    // Garda AI Chat Widget
    wp_enqueue_style('garda-chat',
        get_template_directory_uri() . '/assets/css/garda-chat.css',
        [], '1.0.2'
    );
    wp_enqueue_script('garda-chat',
        get_template_directory_uri() . '/assets/js/garda-chat.js',
        [], '1.0.2', true
    );

    // Passa dati al JS
    wp_localize_script('instagarda-js', 'instagarda', [
        'ajax_url'  => admin_url('admin-ajax.php'),
        'theme_url' => get_template_directory_uri(),
        'chat_api'  => '/api/chat',
    ]);

    // Leaflet per pagine destinazione (singola e archive)
    if (is_singular('destinazione') || is_post_type_archive('destinazione')) {
        wp_enqueue_style('leaflet-css',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
            [], '1.9.4'
        );
        wp_enqueue_script('leaflet-js',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
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
    if (is_singular('destinazione') || is_singular('struttura')) {
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
