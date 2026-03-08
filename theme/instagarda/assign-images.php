<?php
/**
 * Import destination images and set as featured images
 * Run: wp eval-file wp-content/themes/instagarda/assign-images.php
 */

$base = ABSPATH . 'wp-content/uploads/instagarda-images/destinazioni/';

$map = [
    'sirmione'            => 'sirmione.jpg',
    'riva-del-garda'      => 'riva-del-garda.jpg',
    'malcesine'           => 'malcesine.jpg',
    'limone-sul-garda'    => 'limone-sul-garda.jpg',
    'desenzano-del-garda' => 'desenzano-del-garda.jpg',
    'bardolino'           => 'bardolino.jpg',
    'peschiera-del-garda' => 'peschiera-del-garda.jpg',
    'lazise'              => 'lazise.jpg',
    'garda'               => 'garda.jpg',
    'torbole'             => 'torbole.jpg',
    'salo'                => 'salo.jpg',
    'gardone-riviera'     => 'gardone-riviera.jpg',
    'toscolano-maderno'   => 'toscolano-maderno.jpg',
    'gargnano'            => 'gargnano.jpg',
    'tremosine'           => 'tremosine.jpg',
    'nago-torbole'        => 'nago-torbole.jpg',
    'torri-del-benaco'    => 'torri-del-benaco.jpg',
    'arco'                => 'arco.jpg',
];

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

foreach ($map as $slug => $filename) {
    $posts = get_posts([
        'post_type'   => 'destinazione',
        'name'        => $slug,
        'numberposts' => 1,
    ]);

    if (empty($posts)) {
        WP_CLI::warning("Post not found: $slug");
        continue;
    }

    $post = $posts[0];
    $file = $base . $filename;

    if (!file_exists($file)) {
        WP_CLI::warning("File not found: $file");
        continue;
    }

    // Check if already has a featured image
    if (has_post_thumbnail($post->ID)) {
        WP_CLI::log("Skip (already has thumbnail): $slug");
        continue;
    }

    // Copy file to uploads
    $upload = wp_upload_bits($filename, null, file_get_contents($file));
    if ($upload['error']) {
        WP_CLI::warning("Upload error for $slug: " . $upload['error']);
        continue;
    }

    // Create attachment
    $attach_id = wp_insert_attachment([
        'post_mime_type' => 'image/jpeg',
        'post_title'     => ucwords(str_replace('-', ' ', $slug)) . ' - Lago di Garda',
        'post_status'    => 'inherit',
    ], $upload['file'], $post->ID);

    // Generate metadata (thumbnails)
    $metadata = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $metadata);

    // Set as featured image
    set_post_thumbnail($post->ID, $attach_id);

    WP_CLI::success("$slug -> attachment #$attach_id");
}

WP_CLI::success("Done! All destination images assigned.");
