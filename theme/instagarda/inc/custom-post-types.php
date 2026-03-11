<?php
/**
 * Instagarda — Custom Post Types & Taxonomies
 */

// --- CPT: Destinazione ---
function ig_register_destinazione() {
    register_post_type('destinazione', [
        'labels' => [
            'name'               => 'Destinazioni',
            'singular_name'      => 'Destinazione',
            'add_new'            => 'Aggiungi Destinazione',
            'add_new_item'       => 'Aggiungi Nuova Destinazione',
            'edit_item'          => 'Modifica Destinazione',
            'view_item'          => 'Vedi Destinazione',
            'all_items'          => 'Tutte le Destinazioni',
            'search_items'       => 'Cerca Destinazioni',
            'not_found'          => 'Nessuna destinazione trovata',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'destinazioni'],
        'menu_icon'     => 'dashicons-location-alt',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true,
    ]);

    // Tassonomia: Zona del Lago
    register_taxonomy('zona_lago', 'destinazione', [
        'labels' => [
            'name'          => 'Zone del Lago',
            'singular_name' => 'Zona',
            'add_new_item'  => 'Aggiungi Zona',
        ],
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'zona'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'ig_register_destinazione');

// --- CPT: Struttura (Directory) ---
function ig_register_struttura() {
    register_post_type('struttura', [
        'labels' => [
            'name'               => 'Strutture',
            'singular_name'      => 'Struttura',
            'add_new'            => 'Aggiungi Struttura',
            'add_new_item'       => 'Aggiungi Nuova Struttura',
            'edit_item'          => 'Modifica Struttura',
            'view_item'          => 'Vedi Struttura',
            'all_items'          => 'Tutte le Strutture',
            'search_items'       => 'Cerca Strutture',
            'not_found'          => 'Nessuna struttura trovata',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'directory'],
        'menu_icon'     => 'dashicons-building',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true,
    ]);

    // Tassonomia: Tipo Struttura
    register_taxonomy('tipo_struttura', 'struttura', [
        'labels' => [
            'name'          => 'Tipi di Struttura',
            'singular_name' => 'Tipo',
            'add_new_item'  => 'Aggiungi Tipo',
        ],
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'tipo'],
        'show_in_rest' => true,
    ]);

    // Tassonomia: Localita (condivisa)
    register_taxonomy('localita', ['struttura', 'destinazione'], [
        'labels' => [
            'name'          => 'Località',
            'singular_name' => 'Località',
            'add_new_item'  => 'Aggiungi Località',
        ],
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'localita'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'ig_register_struttura');

// --- CPT: Evento ---
function ig_register_evento() {
    register_post_type('evento', [
        'labels' => [
            'name'               => 'Eventi',
            'singular_name'      => 'Evento',
            'add_new'            => 'Aggiungi Evento',
            'add_new_item'       => 'Aggiungi Nuovo Evento',
            'edit_item'          => 'Modifica Evento',
            'view_item'          => 'Vedi Evento',
            'all_items'          => 'Tutti gli Eventi',
            'search_items'       => 'Cerca Eventi',
            'not_found'          => 'Nessun evento trovato',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'eventi'],
        'menu_icon'     => 'dashicons-calendar-alt',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true,
    ]);

    register_taxonomy('tipo_evento', 'evento', [
        'labels' => [
            'name'          => 'Tipi di Evento',
            'singular_name' => 'Tipo Evento',
            'add_new_item'  => 'Aggiungi Tipo',
        ],
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'tipo-evento'],
        'show_in_rest' => true,
    ]);

    // Condividi localita con eventi
    register_taxonomy_for_object_type('localita', 'evento');
}
add_action('init', 'ig_register_evento');

// --- Meta Boxes: Evento ---
function ig_evento_meta_boxes() {
    add_meta_box('ig_evt_info', 'Info Evento', 'ig_evt_info_render', 'evento', 'normal', 'high');
}
add_action('add_meta_boxes', 'ig_evento_meta_boxes');

function ig_evt_info_render($post) {
    wp_nonce_field('ig_evt_save', 'ig_evt_nonce');
    $data_inizio = get_post_meta($post->ID, '_ig_data_inizio', true);
    $data_fine   = get_post_meta($post->ID, '_ig_data_fine', true);
    $orario      = get_post_meta($post->ID, '_ig_orario', true);
    $luogo       = get_post_meta($post->ID, '_ig_luogo', true);
    $prezzo_evt  = get_post_meta($post->ID, '_ig_prezzo_evento', true);
    $link_ext    = get_post_meta($post->ID, '_ig_link_esterno', true);
    ?>
    <table class="form-table">
        <tr><th><label>Data inizio</label></th><td><input type="date" name="ig_data_inizio" value="<?php echo esc_attr($data_inizio); ?>"></td></tr>
        <tr><th><label>Data fine</label></th><td><input type="date" name="ig_data_fine" value="<?php echo esc_attr($data_fine); ?>"></td></tr>
        <tr><th><label>Orario</label></th><td><input type="text" name="ig_orario" value="<?php echo esc_attr($orario); ?>" class="regular-text" placeholder="Es: 20:00 - 23:00"></td></tr>
        <tr><th><label>Luogo</label></th><td><input type="text" name="ig_luogo" value="<?php echo esc_attr($luogo); ?>" class="large-text" placeholder="Es: Piazza Malvezzi, Desenzano"></td></tr>
        <tr><th><label>Prezzo</label></th><td><input type="text" name="ig_prezzo_evento" value="<?php echo esc_attr($prezzo_evt); ?>" class="regular-text" placeholder="Es: Gratuito / €15"></td></tr>
        <tr><th><label>Link esterno</label></th><td><input type="url" name="ig_link_esterno" value="<?php echo esc_attr($link_ext); ?>" class="large-text" placeholder="https://"></td></tr>
    </table>
    <?php
}

function ig_evt_save($post_id) {
    if (!isset($_POST['ig_evt_nonce']) || !wp_verify_nonce($_POST['ig_evt_nonce'], 'ig_evt_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['data_inizio', 'data_fine', 'orario', 'luogo', 'prezzo_evento', 'link_esterno'];
    foreach ($fields as $f) {
        if (isset($_POST['ig_' . $f])) {
            update_post_meta($post_id, '_ig_' . $f, sanitize_text_field($_POST['ig_' . $f]));
        }
    }
}
add_action('save_post_evento', 'ig_evt_save');

// --- CPT: Itinerario ---
function ig_register_itinerario() {
    register_post_type('itinerario', [
        'labels' => [
            'name'               => 'Itinerari',
            'singular_name'      => 'Itinerario',
            'add_new'            => 'Aggiungi Itinerario',
            'add_new_item'       => 'Aggiungi Nuovo Itinerario',
            'edit_item'          => 'Modifica Itinerario',
            'view_item'          => 'Vedi Itinerario',
            'all_items'          => 'Tutti gli Itinerari',
            'search_items'       => 'Cerca Itinerari',
            'not_found'          => 'Nessun itinerario trovato',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'itinerario'],
        'menu_icon'     => 'dashicons-chart-line',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true,
    ]);

    register_taxonomy('tipo_itinerario', 'itinerario', [
        'labels' => [
            'name'          => 'Tipi di Itinerario',
            'singular_name' => 'Tipo Itinerario',
            'add_new_item'  => 'Aggiungi Tipo',
        ],
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'tipo-itinerario'],
        'show_in_rest' => true,
    ]);

    register_taxonomy_for_object_type('localita', 'itinerario');
}
add_action('init', 'ig_register_itinerario');

// --- Meta Boxes: Itinerario ---
function ig_itin_meta_boxes() {
    add_meta_box('ig_itin_info', 'Dati Itinerario', 'ig_itin_info_render', 'itinerario', 'normal', 'high');
}
add_action('add_meta_boxes', 'ig_itin_meta_boxes');

function ig_itin_info_render($post) {
    wp_nonce_field('ig_itin_save', 'ig_itin_nonce');
    $m = function($k) use ($post) { return get_post_meta($post->ID, '_ig_itin_' . $k, true); };
    ?>
    <table class="form-table">
        <tr><th><label>Tipo</label></th><td>
            <select name="ig_itin_type">
                <option value="hiking" <?php selected($m('type'), 'hiking'); ?>>Trekking</option>
                <option value="cycling" <?php selected($m('type'), 'cycling'); ?>>Ciclismo</option>
                <option value="mtb" <?php selected($m('type'), 'mtb'); ?>>Mountain Bike</option>
                <option value="ferrata" <?php selected($m('type'), 'ferrata'); ?>>Via Ferrata</option>
                <option value="water" <?php selected($m('type'), 'water'); ?>>Sport Acquatici</option>
                <option value="drive" <?php selected($m('type'), 'drive'); ?>>Scenic Drive</option>
            </select>
        </td></tr>
        <tr><th><label>Difficoltà</label></th><td>
            <select name="ig_itin_difficulty">
                <option value="facile" <?php selected($m('difficulty'), 'facile'); ?>>Facile</option>
                <option value="media" <?php selected($m('difficulty'), 'media'); ?>>Media</option>
                <option value="difficile" <?php selected($m('difficulty'), 'difficile'); ?>>Difficile</option>
            </select>
        </td></tr>
        <tr><th><label>Distanza (km)</label></th><td><input type="number" step="0.1" name="ig_itin_km" value="<?php echo esc_attr($m('km')); ?>" class="small-text"></td></tr>
        <tr><th><label>Salita (m)</label></th><td><input type="number" name="ig_itin_elevation" value="<?php echo esc_attr($m('elevation')); ?>" class="small-text"></td></tr>
        <tr><th><label>Discesa (m)</label></th><td><input type="number" name="ig_itin_descent" value="<?php echo esc_attr($m('descent')); ?>" class="small-text"></td></tr>
        <tr><th><label>Durata</label></th><td><input type="text" name="ig_itin_hours" value="<?php echo esc_attr($m('hours')); ?>" class="small-text" placeholder="Es: 2:30"></td></tr>
        <tr><th><label>Zona</label></th><td><input type="text" name="ig_itin_zone" value="<?php echo esc_attr($m('zone')); ?>" class="regular-text" placeholder="Es: Riva del Garda"></td></tr>
        <tr><th><label>Coordinate</label></th><td>
            <input type="text" name="ig_itin_lat" value="<?php echo esc_attr($m('lat')); ?>" placeholder="Lat" style="width:120px">
            <input type="text" name="ig_itin_lng" value="<?php echo esc_attr($m('lng')); ?>" placeholder="Lng" style="width:120px">
        </td></tr>
        <tr><th><label>OutdoorActive ID</label></th><td><input type="text" name="ig_itin_oa_id" value="<?php echo esc_attr($m('oa_id')); ?>" class="regular-text" placeholder="Es: 1481019"></td></tr>
        <tr><th><label>Tags</label></th><td><input type="text" name="ig_itin_tags" value="<?php echo esc_attr($m('tags')); ?>" class="large-text" placeholder="vista-lago,panoramico,famiglie"></td></tr>
    </table>
    <?php
}

function ig_itin_save($post_id) {
    if (!isset($_POST['ig_itin_nonce']) || !wp_verify_nonce($_POST['ig_itin_nonce'], 'ig_itin_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['type', 'difficulty', 'km', 'elevation', 'descent', 'hours', 'zone', 'lat', 'lng', 'oa_id', 'tags'];
    foreach ($fields as $f) {
        if (isset($_POST['ig_itin_' . $f])) {
            update_post_meta($post_id, '_ig_itin_' . $f, sanitize_text_field($_POST['ig_itin_' . $f]));
        }
    }
}
add_action('save_post_itinerario', 'ig_itin_save');

// --- Meta Boxes: Destinazione ---
function ig_destinazione_meta_boxes() {
    add_meta_box('ig_dest_info', 'Info Destinazione', 'ig_dest_info_render', 'destinazione', 'normal', 'high');
}
add_action('add_meta_boxes', 'ig_destinazione_meta_boxes');

function ig_dest_info_render($post) {
    wp_nonce_field('ig_dest_save', 'ig_dest_nonce');
    $region     = get_post_meta($post->ID, '_ig_regione', true);
    $subtitle   = get_post_meta($post->ID, '_ig_subtitle', true);
    $highlights = get_post_meta($post->ID, '_ig_highlights', true);
    $map_lat    = get_post_meta($post->ID, '_ig_map_lat', true);
    $map_lng    = get_post_meta($post->ID, '_ig_map_lng', true);
    $posizione     = get_post_meta($post->ID, '_ig_posizione', true);
    $popolazione   = get_post_meta($post->ID, '_ig_popolazione', true);
    $altitudine    = get_post_meta($post->ID, '_ig_altitudine', true);
    $come_arrivare = get_post_meta($post->ID, '_ig_come_arrivare', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ig_subtitle">Sottotitolo</label></th>
            <td><input type="text" id="ig_subtitle" name="ig_subtitle" value="<?php echo esc_attr($subtitle); ?>" class="large-text" placeholder="Es: La Perla del Lago di Garda"></td>
        </tr>
        <tr>
            <th><label for="ig_regione">Regione</label></th>
            <td>
                <select id="ig_regione" name="ig_regione">
                    <option value="">— Seleziona —</option>
                    <option value="lombardia" <?php selected($region, 'lombardia'); ?>>Lombardia</option>
                    <option value="veneto" <?php selected($region, 'veneto'); ?>>Veneto</option>
                    <option value="trentino" <?php selected($region, 'trentino'); ?>>Trentino-Alto Adige</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="ig_posizione">Posizione</label></th>
            <td><input type="text" id="ig_posizione" name="ig_posizione" value="<?php echo esc_attr($posizione); ?>" class="large-text" placeholder="Es: Sponda sud, Lombardia"></td>
        </tr>
        <tr>
            <th><label for="ig_popolazione">Popolazione</label></th>
            <td><input type="text" id="ig_popolazione" name="ig_popolazione" value="<?php echo esc_attr($popolazione); ?>" class="regular-text" placeholder="Es: 8.200 abitanti"></td>
        </tr>
        <tr>
            <th><label for="ig_altitudine">Altitudine</label></th>
            <td><input type="text" id="ig_altitudine" name="ig_altitudine" value="<?php echo esc_attr($altitudine); ?>" class="regular-text" placeholder="Es: 68 m s.l.m."></td>
        </tr>
        <tr>
            <th><label for="ig_come_arrivare">Come arrivare</label></th>
            <td><input type="text" id="ig_come_arrivare" name="ig_come_arrivare" value="<?php echo esc_attr($come_arrivare); ?>" class="large-text" placeholder="Es: A4 uscita Sirmione, 10 min dal casello"></td>
        </tr>
        <tr>
            <th><label for="ig_highlights">Highlights</label></th>
            <td><textarea id="ig_highlights" name="ig_highlights" rows="3" class="large-text" placeholder="Un highlight per riga"><?php echo esc_textarea($highlights); ?></textarea></td>
        </tr>
        <tr>
            <th><label>Coordinate Mappa</label></th>
            <td>
                <input type="text" name="ig_map_lat" value="<?php echo esc_attr($map_lat); ?>" placeholder="Latitudine" style="width:150px">
                <input type="text" name="ig_map_lng" value="<?php echo esc_attr($map_lng); ?>" placeholder="Longitudine" style="width:150px">
            </td>
        </tr>
    </table>
    <?php
}

function ig_dest_save($post_id) {
    if (!isset($_POST['ig_dest_nonce']) || !wp_verify_nonce($_POST['ig_dest_nonce'], 'ig_dest_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['subtitle', 'regione', 'posizione', 'popolazione', 'altitudine', 'come_arrivare', 'highlights', 'map_lat', 'map_lng'];
    foreach ($fields as $f) {
        if (isset($_POST['ig_' . $f])) {
            update_post_meta($post_id, '_ig_' . $f, sanitize_text_field($_POST['ig_' . $f]));
        }
    }
}
add_action('save_post_destinazione', 'ig_dest_save');

// --- Meta Boxes: Struttura ---
function ig_struttura_meta_boxes() {
    add_meta_box('ig_str_info', 'Info Struttura', 'ig_str_info_render', 'struttura', 'normal', 'high');
}
add_action('add_meta_boxes', 'ig_struttura_meta_boxes');

function ig_str_info_render($post) {
    wp_nonce_field('ig_str_save', 'ig_str_nonce');
    $fields = [
        'indirizzo'  => get_post_meta($post->ID, '_ig_indirizzo', true),
        'telefono'   => get_post_meta($post->ID, '_ig_telefono', true),
        'email'      => get_post_meta($post->ID, '_ig_email', true),
        'website'    => get_post_meta($post->ID, '_ig_website', true),
        'prezzo'     => get_post_meta($post->ID, '_ig_prezzo', true),
        'orari'      => get_post_meta($post->ID, '_ig_orari', true),
    ];
    ?>
    <table class="form-table">
        <tr><th><label>Indirizzo</label></th><td><input type="text" name="ig_indirizzo" value="<?php echo esc_attr($fields['indirizzo']); ?>" class="large-text"></td></tr>
        <tr><th><label>Telefono</label></th><td><input type="text" name="ig_telefono" value="<?php echo esc_attr($fields['telefono']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Email</label></th><td><input type="email" name="ig_email" value="<?php echo esc_attr($fields['email']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Sito Web</label></th><td><input type="url" name="ig_website" value="<?php echo esc_attr($fields['website']); ?>" class="regular-text" placeholder="https://"></td></tr>
        <tr><th><label>Fascia Prezzo</label></th><td>
            <select name="ig_prezzo">
                <option value="">— Seleziona —</option>
                <option value="1" <?php selected($fields['prezzo'], '1'); ?>>€ — Economico</option>
                <option value="2" <?php selected($fields['prezzo'], '2'); ?>>€€ — Medio</option>
                <option value="3" <?php selected($fields['prezzo'], '3'); ?>>€€€ — Alto</option>
                <option value="4" <?php selected($fields['prezzo'], '4'); ?>>€€€€ — Lusso</option>
            </select>
        </td></tr>
        <tr><th><label>Orari</label></th><td><input type="text" name="ig_orari" value="<?php echo esc_attr($fields['orari']); ?>" class="large-text" placeholder="Es: Lun-Dom 9:00-22:00"></td></tr>
    </table>
    <?php
}

function ig_str_save($post_id) {
    if (!isset($_POST['ig_str_nonce']) || !wp_verify_nonce($_POST['ig_str_nonce'], 'ig_str_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['indirizzo', 'telefono', 'email', 'website', 'prezzo', 'orari'];
    foreach ($fields as $f) {
        if (isset($_POST['ig_' . $f])) {
            update_post_meta($post_id, '_ig_' . $f, sanitize_text_field($_POST['ig_' . $f]));
        }
    }
}
add_action('save_post_struttura', 'ig_str_save');
