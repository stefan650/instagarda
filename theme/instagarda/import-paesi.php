<?php
/**
 * Instagarda - Import Paesi
 * Run via WP-CLI: wp eval-file wp-content/themes/instagarda/import-paesi.php
 */

if (!defined('ABSPATH')) {
    echo "Run this via WP-CLI: wp eval-file wp-content/themes/instagarda/import-paesi.php\n";
    exit;
}

$paesi = [
    // LOMBARDIA
    [
        'nome' => 'Sirmione',
        'slug' => 'sirmione',
        'regione' => 'Lombardia',
        'zona' => 'Sponda Sud',
        'tagline' => 'La perla del Lago di Garda',
        'descrizione' => "Sirmione è una delle località più affascinanti del Lago di Garda. Situata su una lunga e stretta penisola, è famosa in tutto il mondo per le sue acque termali, il Castello Scaligero e le Grotte di Catullo. Il borgo antico, con le sue case colorate e i vicoli pittoreschi, offre un'atmosfera unica che attrae milioni di visitatori ogni anno.",
        'posizione' => 'Penisola sul Lago di Garda',
        'popolazione' => '8.200 abitanti',
        'altitudine' => '68 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Sirmione. Treno: stazione Desenzano (10 km)',
        'highlights' => "Castello Scaligero\nGrotte di Catullo\nJamaica Beach\nTerme di Sirmione\nChiesa di Santa Maria Maggiore",
    ],
    [
        'nome' => 'Desenzano del Garda',
        'slug' => 'desenzano-del-garda',
        'regione' => 'Lombardia',
        'zona' => 'Sponda Sud',
        'tagline' => 'Eleganza e stile',
        'descrizione' => "Desenzano è la città più grande del lago, elegante e raffinata. Il suo porto turistico è uno dei più importanti d'Italia, mentre il centro storico è ricco di negozi, ristoranti e locali alla moda.",
        'posizione' => 'Sponda sud-occidentale del Lago di Garda',
        'popolazione' => '29.000 abitanti',
        'altitudine' => '67 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Desenzano. Treno: stazione Desenzano (in centro)',
        'highlights' => "Castello di Desenzano\nPorto Turistico\nVilla Romana\nPiazza Malvezzi\nLungolago",
    ],
    [
        'nome' => 'Salò',
        'slug' => 'salo',
        'regione' => 'Lombardia',
        'zona' => 'Sponda Ovest',
        'tagline' => "L'eleganza del lago",
        'descrizione' => "Salò è una delle località più eleganti del Lago di Garda. Il suo lungo viale sul lago, chiamato Lungolago Zanardelli, è fiancheggiato da palme e negozi di lusso.",
        'posizione' => 'Sponda occidentale del Lago di Garda',
        'popolazione' => '10.500 abitanti',
        'altitudine' => '65 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Desenzano. Treno: stazione Desenzano (20 km)',
        'highlights' => "Lungolago Zanardelli\nDuomo di Salò\nMuseo di Salò\nPorto Turistico\nIsola di Garda",
    ],
    [
        'nome' => 'Gardone Riviera',
        'slug' => 'gardone-riviera',
        'regione' => 'Lombardia',
        'zona' => 'Sponda Ovest',
        'tagline' => 'Arte e natura',
        'descrizione' => "Gardone Riviera è famosa per il Vittoriale degli Italiani, la residenza monumentale di Gabriele d'Annunzio. Il Giardino Botanico Hruska e le ville liberty la rendono una delle perle culturali del lago.",
        'posizione' => 'Sponda occidentale del Lago di Garda',
        'popolazione' => '2.700 abitanti',
        'altitudine' => '85 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Desenzano. Treno: stazione Desenzano (25 km)',
        'highlights' => "Il Vittoriale degli Italiani\nGiardino Botanico Hruska\nVille Liberty\nLungolago\nTorre di San Marco",
    ],
    [
        'nome' => 'Toscolano-Maderno',
        'slug' => 'toscolano-maderno',
        'regione' => 'Lombardia',
        'zona' => 'Sponda Ovest',
        'tagline' => 'Tra carta e olivi',
        'descrizione' => "Toscolano-Maderno è un comune composto da due borghi storici uniti. Famoso per la Valle delle Cartiere, dove si produceva carta sin dal XIV secolo, e per gli uliveti che producono un olio extravergine pregiato.",
        'posizione' => 'Sponda occidentale del Lago di Garda',
        'popolazione' => '8.000 abitanti',
        'altitudine' => '86 m s.l.m.',
        'come_arrivare' => 'Auto: da Salò (10 min). Traghetto da Torri del Benaco',
        'highlights' => "Valle delle Cartiere\nBasilica di Sant'Andrea\nSpiaggia di Maderno\nUliveti\nTraghetto per Torri",
    ],
    [
        'nome' => 'Gargnano',
        'slug' => 'gargnano',
        'regione' => 'Lombardia',
        'zona' => 'Sponda Ovest',
        'tagline' => 'Autenticità gardesana',
        'descrizione' => "Gargnano è il borgo più autentico della sponda ovest. Lontano dal turismo di massa, conserva un'atmosfera genuina con i suoi porticcioli, le limonaie storiche e le ville aristocratiche.",
        'posizione' => 'Sponda occidentale del Lago di Garda',
        'popolazione' => '3.000 abitanti',
        'altitudine' => '66 m s.l.m.',
        'come_arrivare' => 'Auto: SS45bis da Salò. Battello dalla sponda est',
        'highlights' => "Limonaie storiche\nVilla Feltrinelli\nChiostro di San Francesco\nPorto di Bogliaco\nCentennale del lago",
    ],
    [
        'nome' => 'Limone sul Garda',
        'slug' => 'limone-sul-garda',
        'regione' => 'Lombardia',
        'zona' => 'Sponda Ovest',
        'tagline' => 'Il paese dei limoni',
        'descrizione' => "Limone sul Garda è famosa per le sue limonaie storiche e per la spettacolare ciclabile sospesa sul lago. Il borgo colorato è incastonato tra le montagne e il lago, creando panorami mozzafiato.",
        'posizione' => 'Sponda nord-occidentale del Lago di Garda',
        'popolazione' => '1.200 abitanti',
        'altitudine' => '66 m s.l.m.',
        'come_arrivare' => 'Auto: SS45bis da Riva. Battello da Malcesine',
        'highlights' => "Limonaie del Castèl\nCiclabile sospesa\nBorgo antico\nChiesa di San Rocco\nPorto turistico",
    ],
    [
        'nome' => 'Tremosine sul Garda',
        'slug' => 'tremosine-sul-garda',
        'regione' => 'Lombardia',
        'zona' => 'Sponda Ovest',
        'tagline' => 'La terrazza del brivido',
        'descrizione' => "Tremosine sul Garda è un comune sparso su un altopiano a strapiombo sul lago. La famosa Terrazza del Brivido offre una vista vertiginosa sul lago da 350 metri di altezza. La Strada della Forra è considerata una delle strade più belle del mondo.",
        'posizione' => 'Altopiano sopra il Lago di Garda',
        'popolazione' => '2.100 abitanti',
        'altitudine' => '414 m s.l.m.',
        'come_arrivare' => 'Auto: Strada della Forra da Limone o da Gargnano',
        'highlights' => "Terrazza del Brivido\nStrada della Forra\nPieve di Tremosine\nAltopiano panoramico\nSentieri trekking",
    ],

    // VENETO
    [
        'nome' => 'Peschiera del Garda',
        'slug' => 'peschiera-del-garda',
        'regione' => 'Veneto',
        'zona' => 'Sponda Sud',
        'tagline' => 'La cittadella fortificata',
        'descrizione' => "Peschiera del Garda è un gioiello architettonico dichiarato Patrimonio dell'Umanità UNESCO. Le sue mura fortificate cinquecentesche, i canali che attraversano il centro storico e il pittoresco porto creano un'atmosfera unica.",
        'posizione' => 'Sponda sud-orientale del Lago di Garda',
        'popolazione' => '10.500 abitanti',
        'altitudine' => '68 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Peschiera. Treno: stazione Peschiera (in centro)',
        'highlights' => "Mura Venete UNESCO\nPorto Vecchio\nGardaland\nParco Sigurtà\nCanali del Centro",
    ],
    [
        'nome' => 'Lazise',
        'slug' => 'lazise',
        'regione' => 'Veneto',
        'zona' => 'Sponda Est',
        'tagline' => 'Il borgo dei mille colori',
        'descrizione' => "Lazise è uno dei borghi più pittoreschi del Lago di Garda, con il suo castello Scaligero, il porticciolo colorato e il lungolago affollato di ristoranti e caffè.",
        'posizione' => 'Sponda orientale del Lago di Garda',
        'popolazione' => '7.200 abitanti',
        'altitudine' => '76 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Peschiera. Treno: stazione Peschiera (8 km)',
        'highlights' => "Castello Scaligero\nPorto Vecchio\nChiesa di San Nicolò\nLungolago\nMercato del Giovedì",
    ],
    [
        'nome' => 'Bardolino',
        'slug' => 'bardolino',
        'regione' => 'Veneto',
        'zona' => 'Sponda Est',
        'tagline' => 'Tra vino e lago',
        'descrizione' => "Bardolino è sinonimo di vino, olio e romanticismo. Il suo elegante lungolago è fiancheggiato da ristoranti e caffè, mentre le colline circostanti sono coperte di vigneti che producono il celebre Bardolino DOC.",
        'posizione' => 'Sponda orientale del Lago di Garda',
        'popolazione' => '6.800 abitanti',
        'altitudine' => '65 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Affi. Treno: stazione Peschiera (15 km)',
        'highlights' => "Lungolago\nCantine del Bardolino\nChiesa di San Severo\nSagra del Vino\nMuseo del Vino",
    ],
    [
        'nome' => 'Garda',
        'slug' => 'garda',
        'regione' => 'Veneto',
        'zona' => 'Sponda Est',
        'tagline' => 'Il cuore del Lago',
        'descrizione' => "Garda dà il nome all'intero lago ed è una delle località più amate. La Baia delle Sirene e la Punta San Vigilio sono tra le spiagge più belle del lago.",
        'posizione' => 'Sponda orientale del Lago di Garda',
        'popolazione' => '4.200 abitanti',
        'altitudine' => '67 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Affi. Treno: stazione Peschiera (20 km)',
        'highlights' => "Baia delle Sirene\nPunta San Vigilio\nVilla Albertini\nRocca di Garda\nLungolago",
    ],
    [
        'nome' => 'Torri del Benaco',
        'slug' => 'torri-del-benaco',
        'regione' => 'Veneto',
        'zona' => 'Sponda Est',
        'tagline' => 'Il borgo della torre',
        'descrizione' => "Torri del Benaco è un incantevole borgo dominato dalla sua torre medievale. Il porticciolo è uno dei più pittoreschi del lago.",
        'posizione' => 'Sponda orientale del Lago di Garda',
        'popolazione' => '3.100 abitanti',
        'altitudine' => '65 m s.l.m.',
        'come_arrivare' => 'Auto: A4 uscita Affi. Treno: stazione Peschiera (25 km)',
        'highlights' => "Torre Scaligera\nPorto Vecchio\nMuseo del Lago\nLungolago\nTraghetto per Maderno",
    ],
    [
        'nome' => 'Malcesine',
        'slug' => 'malcesine',
        'regione' => 'Veneto',
        'zona' => 'Sponda Est',
        'tagline' => 'Borgo medievale con vista',
        'descrizione' => "Malcesine è uno dei borghi più pittoreschi del Lago di Garda. Il suo Castello Scaligero offre viste mozzafiato. La funivia per il Monte Baldo porta i visitatori fino a 1.800 metri di altitudine.",
        'posizione' => 'Sponda orientale del Lago di Garda',
        'popolazione' => '3.700 abitanti',
        'altitudine' => '89 m s.l.m.',
        'come_arrivare' => 'Auto: A22 uscita Rovereto Sud. Treno: stazione Rovereto (25 km)',
        'highlights' => "Castello Scaligero\nFunivia Monte Baldo\nPalazzo dei Capitani\nVia Paina\nPorto Vecchio",
    ],
    [
        'nome' => 'Brenzone sul Garda',
        'slug' => 'brenzone-sul-garda',
        'regione' => 'Veneto',
        'zona' => 'Sponda Est',
        'tagline' => 'Autenticità sul Lago',
        'descrizione' => "Brenzone è un borgo di pescatori che conserva intatta l'autenticità delle tradizioni lacustri. Le sue frazioni sparse sulle colline offrono scorci panoramici mozzafiato.",
        'posizione' => 'Sponda orientale del Lago di Garda',
        'popolazione' => '2.500 abitanti',
        'altitudine' => '65 m s.l.m.',
        'come_arrivare' => 'Auto: A22 uscita Rovereto Sud. Treno: stazione Rovereto (30 km)',
        'highlights' => "Borgo di Castelletto\nChiesa di San Giovanni\nSentiero delle Torri\nPorto di Brenzone\nSpiaggia di Castelletto",
    ],

    // TRENTINO
    [
        'nome' => 'Riva del Garda',
        'slug' => 'riva-del-garda',
        'regione' => 'Trentino',
        'zona' => 'Sponda Nord',
        'tagline' => 'La città degli sport',
        'descrizione' => "Riva del Garda è la città più settentrionale del lago, incastonata tra le imponenti pareti del Monte Rocchetta e il lago. È la capitale europea del windsurf e della vela.",
        'posizione' => 'Estremità nord del Lago di Garda',
        'popolazione' => '17.000 abitanti',
        'altitudine' => '70 m s.l.m.',
        'come_arrivare' => 'Auto: A22 uscita Rovereto Nord. Treno: stazione Rovereto (20 km)',
        'highlights' => "Rocca di Riva\nSentiero del Ponale\nPiazza III Novembre\nCascate del Varone\nPorto di Riva",
    ],
    [
        'nome' => 'Torbole',
        'slug' => 'torbole',
        'regione' => 'Trentino',
        'zona' => 'Sponda Nord',
        'tagline' => 'Il paradiso del windsurf',
        'descrizione' => "Torbole è la mecca del windsurf e della vela sul Lago di Garda. Le costanti brezze del Pelér e dell'Ora attirano appassionati da tutto il mondo.",
        'posizione' => 'Estremità nord del Lago di Garda',
        'popolazione' => '2.800 abitanti',
        'altitudine' => '68 m s.l.m.',
        'come_arrivare' => 'Auto: A22 uscita Rovereto Nord. Treno: stazione Rovereto (22 km)',
        'highlights' => "Spiaggia di Torbole\nPorto San Nicolò\nSentiero del Ponale\nMonte Baldo\nCasa del Dazio",
    ],
    [
        'nome' => 'Arco',
        'slug' => 'arco',
        'regione' => 'Trentino',
        'zona' => 'Sponda Nord',
        'tagline' => 'Il giardino del Garda',
        'descrizione' => "Arco è famosa per il suo castello che domina la città e per il clima mediterraneo. È un paradiso per gli appassionati di arrampicata, con centinaia di vie su calcare.",
        'posizione' => 'Valle del Sarca, a nord del Lago di Garda',
        'popolazione' => '17.500 abitanti',
        'altitudine' => '77 m s.l.m.',
        'come_arrivare' => 'Auto: A22 uscita Rovereto Nord. Treno: stazione Rovereto (15 km)',
        'highlights' => "Castello di Arco\nParco Arciducale\nFalesie di Arco\nCentro Storico\nLago di Cavedine",
    ],
];

// Create taxonomy terms first
$zone = ['Sponda Nord', 'Sponda Sud', 'Sponda Est', 'Sponda Ovest'];
foreach ($zone as $z) {
    if (!term_exists($z, 'zona_lago')) {
        wp_insert_term($z, 'zona_lago');
        echo "Created zona: $z\n";
    }
}

$count = 0;
foreach ($paesi as $p) {
    // Check if already exists
    $existing = get_page_by_path($p['slug'], OBJECT, 'destinazione');
    if ($existing) {
        echo "Skipping {$p['nome']} (already exists)\n";
        continue;
    }

    $post_id = wp_insert_post([
        'post_title'   => $p['nome'],
        'post_name'    => $p['slug'],
        'post_content' => $p['descrizione'],
        'post_type'    => 'destinazione',
        'post_status'  => 'publish',
    ]);

    if (is_wp_error($post_id)) {
        echo "ERROR creating {$p['nome']}: " . $post_id->get_error_message() . "\n";
        continue;
    }

    // Set meta
    update_post_meta($post_id, '_ig_subtitle', $p['tagline']);
    update_post_meta($post_id, '_ig_regione', $p['regione']);
    update_post_meta($post_id, '_ig_highlights', $p['highlights']);
    update_post_meta($post_id, '_ig_posizione', $p['posizione']);
    update_post_meta($post_id, '_ig_popolazione', $p['popolazione']);
    update_post_meta($post_id, '_ig_altitudine', $p['altitudine']);
    update_post_meta($post_id, '_ig_come_arrivare', $p['come_arrivare']);

    // Set zona_lago taxonomy
    wp_set_object_terms($post_id, $p['zona'], 'zona_lago');

    echo "Created: {$p['nome']} (ID: $post_id)\n";
    $count++;
}

echo "\nDone! Created $count destinations.\n";
