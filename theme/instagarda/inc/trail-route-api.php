<?php
/**
 * Trail Route API — Estrae coordinate percorso da OutdoorActive e le cacha
 */

add_action('wp_ajax_ig_trail_route', 'ig_trail_route_handler');
add_action('wp_ajax_nopriv_ig_trail_route', 'ig_trail_route_handler');

function ig_trail_route_handler() {
    $oa_id = intval($_GET['oa_id'] ?? 0);
    if (!$oa_id) {
        wp_send_json_error('Missing oa_id');
    }

    $cache_key = 'ig_trail_route_' . $oa_id;
    $cached = get_transient($cache_key);
    if ($cached) {
        wp_send_json_success($cached);
    }

    // Fetch OA page
    $url = 'https://www.outdooractive.com/it/route/' . $oa_id;
    $response = wp_remote_get($url, ['timeout' => 15, 'user-agent' => 'Mozilla/5.0']);
    if (is_wp_error($response)) {
        wp_send_json_error('Fetch failed');
    }

    $html = wp_remote_retrieve_body($response);

    // Estrai JSON-LD con GeoShape
    $points = [];
    if (preg_match_all('/<script[^>]*type=["\']application\/ld\+json["\'][^>]*>(.*?)<\/script>/si', $html, $matches)) {
        foreach ($matches[1] as $json_str) {
            $data = json_decode($json_str, true);
            if (!$data) continue;

            // Cerca geo.line nel JSON-LD (potrebbe essere annidato)
            $line = ig_find_geo_line($data);
            if ($line) {
                $coords = preg_split('/\s+/', trim($line));
                for ($i = 0; $i < count($coords) - 1; $i += 2) {
                    $lat = floatval($coords[$i]);
                    $lng = floatval($coords[$i + 1]);
                    if ($lat > 0 && $lng > 0) {
                        $points[] = [$lat, $lng];
                    }
                }
                break;
            }
        }
    }

    if (empty($points)) {
        wp_send_json_error('No route data found');
    }

    // Subsample a ~120 punti per performance
    $total = count($points);
    if ($total > 120) {
        $sampled = [];
        $step = ($total - 1) / 119;
        for ($i = 0; $i < 120; $i++) {
            $sampled[] = $points[(int)round($i * $step)];
        }
        $sampled[] = $points[$total - 1]; // ultimo punto
        $points = $sampled;
    }

    // Fetch elevation da Open-Elevation API
    $locations = [];
    foreach ($points as $p) {
        $locations[] = $p[0] . ',' . $p[1];
    }

    // Batch in gruppi da 50 (limite API)
    $elevations = [];
    $chunks = array_chunk($locations, 50);
    foreach ($chunks as $chunk) {
        $elev_url = 'https://api.open-elevation.com/api/v1/lookup?locations=' . implode('|', $chunk);
        $elev_resp = wp_remote_get($elev_url, ['timeout' => 20]);
        if (!is_wp_error($elev_resp)) {
            $elev_data = json_decode(wp_remote_retrieve_body($elev_resp), true);
            if (isset($elev_data['results'])) {
                foreach ($elev_data['results'] as $r) {
                    $elevations[] = intval($r['elevation']);
                }
            }
        }
    }

    // Combina coordinate + elevation
    $route = [];
    for ($i = 0; $i < count($points); $i++) {
        $route[] = [
            $points[$i][0],
            $points[$i][1],
            isset($elevations[$i]) ? $elevations[$i] : 0
        ];
    }

    $result = ['route' => $route];

    // Cache 30 giorni
    set_transient($cache_key, $result, 30 * DAY_IN_SECONDS);

    wp_send_json_success($result);
}

/**
 * Batch: restituisce tutte le route cached in una sola chiamata
 */
add_action('wp_ajax_ig_all_trail_routes', 'ig_all_trail_routes_handler');
add_action('wp_ajax_nopriv_ig_all_trail_routes', 'ig_all_trail_routes_handler');

function ig_all_trail_routes_handler() {
    $ids_raw = sanitize_text_field($_GET['ids'] ?? '');
    if (!$ids_raw) {
        wp_send_json_error('Missing ids');
    }

    $oa_ids = array_filter(array_map('intval', explode(',', $ids_raw)));
    $routes = [];

    foreach ($oa_ids as $oa_id) {
        $cache_key = 'ig_trail_route_' . $oa_id;
        $cached = get_transient($cache_key);
        if ($cached && !empty($cached['route'])) {
            // Subsample a ~40 punti per la mappa panoramica (più leggero)
            $full = $cached['route'];
            $total = count($full);
            if ($total > 40) {
                $sampled = [];
                $step = ($total - 1) / 39;
                for ($i = 0; $i < 40; $i++) {
                    $pt = $full[(int)round($i * $step)];
                    $sampled[] = [$pt[0], $pt[1]];
                }
                $routes[$oa_id] = $sampled;
            } else {
                $routes[$oa_id] = array_map(function($pt) {
                    return [$pt[0], $pt[1]];
                }, $full);
            }
        }
    }

    wp_send_json_success($routes);
}

/**
 * Cerca ricorsivamente geo.line nel JSON-LD
 */
function ig_find_geo_line($data) {
    if (!is_array($data)) return null;
    if (isset($data['geo']['line'])) return $data['geo']['line'];
    if (isset($data['line'])) return $data['line'];
    foreach ($data as $val) {
        if (is_array($val)) {
            $found = ig_find_geo_line($val);
            if ($found) return $found;
        }
    }
    return null;
}
