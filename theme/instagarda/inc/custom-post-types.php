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
