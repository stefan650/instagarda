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
        ['instagarda-fonts'], '1.0.3'
    );

    wp_enqueue_script('instagarda-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [], '1.0.3', true
    );

    // Garda AI Chat Widget
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
