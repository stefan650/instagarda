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

// --- Meta Box: Work In Progress (tutti i CPT) ---
function ig_wip_meta_box() {
    $types = ['destinazione', 'itinerario', 'struttura', 'evento'];
    foreach ($types as $t) {
        add_meta_box('ig_wip', 'Stato Pagina', 'ig_wip_render', $t, 'side', 'high');
    }
}
add_action('add_meta_boxes', 'ig_wip_meta_box');

function ig_wip_render($post) {
    $wip = get_post_meta($post->ID, '_ig_wip', true);
    ?>
    <label>
        <input type="checkbox" name="ig_wip" value="1" <?php checked($wip, '1'); ?>>
        <strong>Pagina in lavorazione</strong>
    </label>
    <p class="description">Mostra un avviso "in lavorazione" ai visitatori.</p>
    <?php
}

function ig_wip_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['ig_wip'])) {
        update_post_meta($post_id, '_ig_wip', '1');
    } else {
        delete_post_meta($post_id, '_ig_wip');
    }
}
add_action('save_post', 'ig_wip_save');

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

    $fields = ['data_inizio', 'data_fine', 'orario', 'luogo', 'prezzo_evento'];
    foreach ($fields as $f) {
        if (isset($_POST['ig_' . $f])) {
            update_post_meta($post_id, '_ig_' . $f, sanitize_text_field($_POST['ig_' . $f]));
        }
    }
    // Link esterno e' un URL: usa esc_url_raw per la sanitizzazione
    if (isset($_POST['ig_link_esterno'])) {
        update_post_meta($post_id, '_ig_link_esterno', esc_url_raw($_POST['ig_link_esterno']));
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
        <tr><th><label>Stato</label></th><td>
            <select name="ig_itin_status">
                <option value="aperto" <?php selected($m('status'), 'aperto'); ?>>Aperto</option>
                <option value="chiuso" <?php selected($m('status'), 'chiuso'); ?>>Chiuso</option>
                <option value="parziale" <?php selected($m('status'), 'parziale'); ?>>Parzialmente aperto</option>
            </select>
        </td></tr>
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
        <tr><th><label>Superficie</label></th><td><textarea name="ig_itin_surface" rows="2" class="large-text" placeholder='JSON: [["Sentiero",2.5,"#10B981"],["Asfalto",1.0,"#374151"]]'><?php echo esc_textarea($m('surface')); ?></textarea></td></tr>
        <tr><th><label>Parcheggio</label></th><td><textarea name="ig_itin_parking" rows="3" class="large-text" placeholder="Info su dove parcheggiare"><?php echo esc_textarea($m('parking')); ?></textarea></td></tr>
        <tr><th><label>Come arrivare</label></th><td><textarea name="ig_itin_how_to_reach" rows="3" class="large-text" placeholder="Indicazioni per raggiungere il punto di partenza"><?php echo esc_textarea($m('how_to_reach')); ?></textarea></td></tr>
        <tr><th><label>Attrezzatura</label></th><td><textarea name="ig_itin_equipment" rows="3" class="large-text" placeholder="Attrezzatura consigliata"><?php echo esc_textarea($m('equipment')); ?></textarea></td></tr>
        <tr><th><label>Direzioni</label></th><td><textarea name="ig_itin_directions" rows="5" class="large-text" placeholder="Indicazioni passo-passo del percorso"><?php echo esc_textarea($m('directions')); ?></textarea></td></tr>
        <tr><th><label>Sicurezza</label></th><td><textarea name="ig_itin_safety" rows="3" class="large-text" placeholder="Consigli sulla sicurezza"><?php echo esc_textarea($m('safety')); ?></textarea></td></tr>
        <tr><th><label>URL OutdoorActive</label></th><td><input type="url" name="ig_outdooractive_url" value="<?php echo esc_attr(get_post_meta($post->ID, '_ig_outdooractive_url', true)); ?>" class="large-text" placeholder="https://www.outdooractive.com/..."></td></tr>
        <tr><th><label>Credito foto</label></th><td><input type="text" name="ig_itin_photo_credit" value="<?php echo esc_attr($m('photo_credit')); ?>" class="large-text" placeholder="Es: Archivio Garda Trentino (ph. Watchsome)"></td></tr>
        <tr><th><label>Instagram</label></th><td><textarea name="ig_itin_instagram" rows="2" class="large-text" placeholder="URL Instagram (uno per riga)&#10;https://www.instagram.com/p/Czvq1RILKP9/"><?php echo esc_textarea($m('instagram')); ?></textarea></td></tr>
    </table>
    <?php
}

function ig_itin_save($post_id) {
    if (!isset($_POST['ig_itin_nonce']) || !wp_verify_nonce($_POST['ig_itin_nonce'], 'ig_itin_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['status', 'type', 'difficulty', 'km', 'elevation', 'descent', 'hours', 'zone', 'lat', 'lng', 'oa_id', 'tags'];
    foreach ($fields as $f) {
        if (isset($_POST['ig_itin_' . $f])) {
            update_post_meta($post_id, '_ig_itin_' . $f, sanitize_text_field($_POST['ig_itin_' . $f]));
        }
    }
    $textarea_fields = ['surface', 'parking', 'how_to_reach', 'equipment', 'directions', 'safety', 'instagram'];
    foreach ($textarea_fields as $f) {
        if (isset($_POST['ig_itin_' . $f])) {
            update_post_meta($post_id, '_ig_itin_' . $f, sanitize_textarea_field($_POST['ig_itin_' . $f]));
        }
    }
    if (isset($_POST['ig_outdooractive_url'])) {
        update_post_meta($post_id, '_ig_outdooractive_url', esc_url_raw($_POST['ig_outdooractive_url']));
    }
    if (isset($_POST['ig_itin_photo_credit'])) {
        update_post_meta($post_id, '_ig_itin_' . 'photo_credit', sanitize_text_field($_POST['ig_itin_photo_credit']));
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

    $fields = ['subtitle', 'regione', 'posizione', 'popolazione', 'altitudine', 'come_arrivare', 'map_lat', 'map_lng'];
    foreach ($fields as $f) {
        if (isset($_POST['ig_' . $f])) {
            update_post_meta($post_id, '_ig_' . $f, sanitize_text_field($_POST['ig_' . $f]));
        }
    }
    // Highlights e' un textarea: usa sanitize_textarea_field per preservare i ritorni a capo
    if (isset($_POST['ig_highlights'])) {
        update_post_meta($post_id, '_ig_highlights', sanitize_textarea_field($_POST['ig_highlights']));
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

    $fields = ['indirizzo', 'telefono', 'prezzo', 'orari'];
    foreach ($fields as $f) {
        if (isset($_POST['ig_' . $f])) {
            update_post_meta($post_id, '_ig_' . $f, sanitize_text_field($_POST['ig_' . $f]));
        }
    }
    // Email: sanitizzazione specifica
    if (isset($_POST['ig_email'])) {
        update_post_meta($post_id, '_ig_email', sanitize_email($_POST['ig_email']));
    }
    // Website e' un URL: usa esc_url_raw
    if (isset($_POST['ig_website'])) {
        update_post_meta($post_id, '_ig_website', esc_url_raw($_POST['ig_website']));
    }
}
add_action('save_post_struttura', 'ig_str_save');

// --- CPT: Attrazione ---
function ig_register_attrazione() {
    register_post_type('attrazione', [
        'labels' => [
            'name'               => 'Attrazioni',
            'singular_name'      => 'Attrazione',
            'add_new'            => 'Aggiungi Attrazione',
            'add_new_item'       => 'Aggiungi Nuova Attrazione',
            'edit_item'          => 'Modifica Attrazione',
            'view_item'          => 'Vedi Attrazione',
            'all_items'          => 'Tutte le Attrazioni',
            'search_items'       => 'Cerca Attrazioni',
            'not_found'          => 'Nessuna attrazione trovata',
        ],
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'attrazione'],
        'menu_icon'     => 'dashicons-location-alt',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true,
    ]);

    register_taxonomy_for_object_type('localita', 'attrazione');
}
add_action('init', 'ig_register_attrazione');

// --- Meta Boxes: Attrazione ---
function ig_att_meta_boxes() {
    add_meta_box('ig_att_info', 'Dati Attrazione', 'ig_att_info_render', 'attrazione', 'normal', 'high');
}
add_action('add_meta_boxes', 'ig_att_meta_boxes');

function ig_att_info_render($post) {
    wp_nonce_field('ig_att_save', 'ig_att_nonce');
    $m = function($k) use ($post) { return get_post_meta($post->ID, '_ig_att_' . $k, true); };
    ?>
    <table class="form-table">
        <tr><th><label>Video Hero</label></th><td>
            <input type="text" name="ig_att_hero_video" value="<?php echo esc_attr($m('hero_video')); ?>" class="regular-text" placeholder="nome-file.mp4">
            <p class="description">Nome file video in assets/video/</p>
        </td></tr>
        <tr><th><label>Categoria</label></th><td>
            <select name="ig_att_category">
                <?php foreach (['monumento'=>'Monumento','museo'=>'Museo','chiesa'=>'Chiesa','natura'=>'Natura','spiaggia'=>'Spiaggia','terme'=>'Terme','centro-storico'=>'Centro Storico','panorama'=>'Panorama'] as $v=>$l): ?>
                <option value="<?php echo $v; ?>" <?php selected($m('category'), $v); ?>><?php echo $l; ?></option>
                <?php endforeach; ?>
            </select>
        </td></tr>
        <tr><th><label>Latitudine</label></th><td><input type="text" name="ig_att_lat" value="<?php echo esc_attr($m('lat')); ?>" class="regular-text"></td></tr>
        <tr><th><label>Longitudine</label></th><td><input type="text" name="ig_att_lng" value="<?php echo esc_attr($m('lng')); ?>" class="regular-text"></td></tr>
        <tr><th><label>Indirizzo</label></th><td><input type="text" name="ig_att_indirizzo" value="<?php echo esc_attr($m('indirizzo')); ?>" class="regular-text" placeholder="Via Roma 1, Sirmione (BS)"></td></tr>
        <tr><th><label>Orari</label></th><td>
            <textarea name="ig_att_orari" rows="3" class="large-text" placeholder="Mar-Dom 8:30-17:00&#10;Chiuso lunedì"><?php echo esc_textarea($m('orari')); ?></textarea>
        </td></tr>
        <tr><th><label>Prezzo</label></th><td><input type="text" name="ig_att_prezzo" value="<?php echo esc_attr($m('prezzo')); ?>" class="regular-text" placeholder="10€ intero, 2€ ridotto"></td></tr>
        <tr><th><label>URL Biglietti</label></th><td><input type="url" name="ig_att_biglietti_url" value="<?php echo esc_attr($m('biglietti_url')); ?>" class="regular-text" placeholder="https://..."></td></tr>
        <tr><th><label>Telefono</label></th><td><input type="text" name="ig_att_telefono" value="<?php echo esc_attr($m('telefono')); ?>" class="regular-text" placeholder="030 916157"></td></tr>
        <tr><th><label>Sito Web</label></th><td><input type="url" name="ig_att_sito_web" value="<?php echo esc_attr($m('sito_web')); ?>" class="regular-text" placeholder="https://..."></td></tr>
    </table>
    <?php
}

function ig_att_save($post_id) {
    if (!isset($_POST['ig_att_nonce']) || !wp_verify_nonce($_POST['ig_att_nonce'], 'ig_att_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    foreach (['hero_video', 'category', 'lat', 'lng', 'indirizzo', 'orari', 'prezzo', 'biglietti_url', 'telefono', 'sito_web'] as $k) {
        if (isset($_POST['ig_att_' . $k])) {
            update_post_meta($post_id, '_ig_att_' . $k, sanitize_text_field($_POST['ig_att_' . $k]));
        }
    }
}
add_action('save_post_attrazione', 'ig_att_save');
