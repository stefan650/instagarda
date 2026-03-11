<?php
/**
 * Template Name: Esperienze — Categoria
 * Description: Template per le sottopagine esperienze (Ristoranti, Soggiorni, Bar, Attività, Cultura)
 */
get_header();

// Config per categoria basata sullo slug della pagina
$page_slug = get_post_field('post_name', get_the_ID());
$categorie = [
    'attivita' => [
        'tipo'       => 'attivita',
        'titolo'     => 'Percorsi & Sport',
        'headline'   => 'Vivi il lago,<br>non solo guardarlo',
        'intro'      => 'Dal windsurf al tramonto alle escursioni tra i borghi, il Lago di Garda è un parco giochi naturale dove ogni giornata diventa un ricordo indimenticabile.',
        'icon'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>',
        'color'      => '#10B981',
        'gradient'   => 'linear-gradient(135deg, #10B981, #059669)',
        'outdooractive' => true,
    ],
    'cultura' => [
        'tipo'       => 'cultura',
        'titolo'     => 'Cultura & Musei',
        'headline'   => 'Duemila anni di storia,<br>un lago da scoprire',
        'intro'      => 'Castelli medievali, ville romane, chiese affrescate e musei che raccontano la storia millenaria delle sponde del Garda.',
        'icon'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 21v-4h6v4"/></svg>',
        'color'      => '#06B6D4',
        'gradient'   => 'linear-gradient(135deg, #06B6D4, #0891B2)',
        'outdooractive' => false,
    ],
    'ristoranti' => [
        'tipo'       => 'ristorante',
        'titolo'     => 'Ristoranti',
        'headline'   => 'I sapori del lago,<br>a tavola',
        'intro'      => 'Dalle trattorie con vista lago ai ristoranti gourmet stellati, passando per le pizzerie e le osterie di paese. Il Garda è anche una destinazione gastronomica.',
        'icon'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
        'color'      => '#F97316',
        'gradient'   => 'linear-gradient(135deg, #F97316, #EA580C)',
        'outdooractive' => false,
    ],
    'soggiorni' => [
        'tipo'       => 'hotel',
        'titolo'     => 'Dove Dormire',
        'headline'   => 'Svegliarsi<br>vista lago',
        'intro'      => 'Hotel con spa, B&B nel centro storico, agriturismi tra gli uliveti, appartamenti sul lungolago. Trova il posto perfetto per la tua vacanza al Garda.',
        'icon'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>',
        'color'      => '#6366F1',
        'gradient'   => 'linear-gradient(135deg, #6366F1, #4F46E5)',
        'outdooractive' => false,
    ],
    'bar-nightlife' => [
        'tipo'       => 'bar',
        'titolo'     => 'Bar & Nightlife',
        'headline'   => 'Aperitivi al tramonto,<br>notti sul lago',
        'intro'      => 'Cocktail bar con terrazza, enoteche nei borghi antichi, lounge bar sul lungolago e discoteche per chi vuole ballare fino all\'alba.',
        'icon'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 2h8l-4 9V22"/><path d="M4 2h16"/><path d="M7 22h10"/></svg>',
        'color'      => '#F59E0B',
        'gradient'   => 'linear-gradient(135deg, #F59E0B, #D97706)',
        'outdooractive' => false,
    ],
    'enogastronomia' => [
        'tipo'       => 'enogastronomia',
        'titolo'     => 'Enogastronomia',
        'headline'   => 'Vini, olio e sapori<br>tra le colline del Garda',
        'intro'      => 'Degustazioni in cantina, frantoi aperti, corsi di cucina e picnic tra gli uliveti. Scopri i prodotti tipici del territorio gardesano.',
        'icon'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8h1a4 4 0 110 8h-1"/><path d="M3 8h14v9a4 4 0 01-4 4H7a4 4 0 01-4-4V8z"/><path d="M6 2v4"/><path d="M10 2v4"/></svg>',
        'color'      => '#9333EA',
        'gradient'   => 'linear-gradient(135deg, #9333EA, #7C3AED)',
        'outdooractive' => false,
    ],
    'benessere' => [
        'tipo'       => 'benessere',
        'titolo'     => 'Benessere & Spa',
        'headline'   => 'Rilassati<br>sulle rive del Garda',
        'intro'      => 'Acque termali sulfuree, spa con vista lago, massaggi e percorsi sensoriali. Il benessere al Garda è un\'esperienza unica tra natura e relax.',
        'icon'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
        'color'      => '#EC4899',
        'gradient'   => 'linear-gradient(135deg, #EC4899, #DB2777)',
        'outdooractive' => false,
    ],
    'tour' => [
        'tipo'       => 'tour',
        'titolo'     => 'Tour & Escursioni',
        'headline'   => 'Scopri il lago<br>con una guida',
        'intro'      => 'Crociere in battello, visite guidate alle isole, tour in barca privata e escursioni organizzate. Lasciati accompagnare alla scoperta del Garda.',
        'icon'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 000 20 14.5 14.5 0 000-20"/><path d="M2 12h20"/></svg>',
        'color'      => '#0EA5E9',
        'gradient'   => 'linear-gradient(135deg, #0EA5E9, #0284C7)',
        'outdooractive' => false,
    ],
];

$cat = $categorie[$page_slug] ?? $categorie['attivita'];
?>

<!-- Hero -->
<section class="ig-dest-hero ig-dest-hero--short">
    <div class="ig-dest-hero__bg">
        <?php if (has_post_thumbnail()):
            the_post_thumbnail('hero');
        else: ?>
            <div class="ig-placeholder-img" style="background:<?php echo esc_attr($cat['gradient']); ?>">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.3)" stroke-width="1"><?php echo $cat['icon']; ?></svg>
            </div>
        <?php endif; ?>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <span class="ig-dest-hero__badge">
                <?php echo $cat['icon']; ?>
                Esperienze
            </span>
            <h1 class="ig-dest-hero__title"><?php echo $cat['titolo']; ?></h1>
        </div>
    </div>
</section>

<?php if (!$cat['outdooractive']): ?>
<!-- Intro narrativa Apple-style -->
<section class="ig-apple-section ig-apple-section--intro ig-reveal">
    <div class="ig-apple-container">
        <div class="ig-apple-intro">
            <p><?php echo esc_html($cat['intro']); ?></p>
        </div>
    </div>
</section>

<!-- Filtro per località -->
<section class="ig-apple-section ig-apple-section--white" style="padding-top:0">
    <div class="ig-apple-container">
        <div class="ig-exp-filters" id="igExpFilters">
            <button class="ig-exp-filters__btn is-active" data-filter="tutti">Tutto il lago</button>
            <?php
            $localita_terms = get_terms(['taxonomy' => 'localita', 'hide_empty' => true]);
            if ($localita_terms && !is_wp_error($localita_terms)):
                foreach ($localita_terms as $loc):
            ?>
            <button class="ig-exp-filters__btn" data-filter="<?php echo esc_attr($loc->slug); ?>"><?php echo esc_html($loc->name); ?></button>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<!-- Griglia strutture -->
<section class="ig-apple-section ig-apple-section--light" style="padding-top:var(--sp-lg)">
    <div class="ig-apple-container">
        <?php
        $strutture = new WP_Query([
            'post_type'      => 'struttura',
            'posts_per_page' => 24,
            'tax_query'      => [[
                'taxonomy' => 'tipo_struttura',
                'field'    => 'slug',
                'terms'    => $cat['tipo'],
            ]],
            'orderby' => 'title',
            'order'   => 'ASC',
        ]);

        if ($strutture->have_posts()):
        ?>
        <div class="ig-exp-listing" id="igExpListing">
            <?php while ($strutture->have_posts()): $strutture->the_post();
                $loc = get_the_terms(get_the_ID(), 'localita');
                $loc_slug = ($loc && !is_wp_error($loc)) ? $loc[0]->slug : '';
                $loc_name = ($loc && !is_wp_error($loc)) ? $loc[0]->name : '';
                $prezzo = ig_get_meta('prezzo');
                $prezzi = ['1' => '€', '2' => '€€', '3' => '€€€', '4' => '€€€€'];
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-exp-item" data-localita="<?php echo esc_attr($loc_slug); ?>">
                <div class="ig-exp-item__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card-wide');
                    else: ?>
                        <div class="ig-placeholder-img">
                            <?php echo $cat['icon']; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($prezzo && isset($prezzi[$prezzo])): ?>
                        <span class="ig-exp-item__badge"><?php echo $prezzi[$prezzo]; ?></span>
                    <?php endif; ?>
                </div>
                <div class="ig-exp-item__body">
                    <h3 class="ig-exp-item__title"><?php the_title(); ?></h3>
                    <?php if ($loc_name): ?>
                    <p class="ig-exp-item__loc">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <?php echo esc_html($loc_name); ?>
                    </p>
                    <?php endif; ?>
                    <?php if (has_excerpt()): ?>
                    <p class="ig-exp-item__desc"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 15)); ?></p>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <div class="ig-text-center" style="padding:var(--sp-3xl) 0">
            <p style="font-size:var(--fs-lg);color:var(--ig-text-muted)">Presto troverai qui tutte le proposte. Stiamo lavorando per te!</p>
            <button class="ig-btn ig-btn--primary ig-btn--lg" style="margin-top:var(--sp-lg)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Chiedi consiglio a Garda AI
            </button>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- Itinerari & Percorsi (solo per Attività) -->
<?php if ($cat['outdooractive']):
    $filtro_tipo_itin = isset($_GET['tipo']) ? sanitize_text_field($_GET['tipo']) : '';
?>

<!-- Sub-nav per tipo itinerario -->
<section class="ig-itin-subnav">
    <div class="ig-container">
        <div class="ig-itin-subnav__pills">
            <a href="?tipo=" class="ig-itin-subnav__pill <?php echo !$filtro_tipo_itin ? 'is-active' : ''; ?>" data-tipo="all">Tutti i percorsi</a>
            <a href="?tipo=hiking" class="ig-itin-subnav__pill <?php echo $filtro_tipo_itin === 'hiking' ? 'is-active' : ''; ?>" data-tipo="hiking">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 4v16"/><path d="M17 4l-4 4-4-4"/><path d="M7 20l4-4 4 4"/></svg>
                Trekking
            </a>
            <a href="?tipo=mtb" class="ig-itin-subnav__pill <?php echo $filtro_tipo_itin === 'mtb' ? 'is-active' : ''; ?>" data-tipo="mtb">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5" cy="18" r="3"/><circle cx="19" cy="18" r="3"/><path d="M12 18V6l4 4"/></svg>
                Mountain Bike
            </a>
            <a href="?tipo=cycling" class="ig-itin-subnav__pill <?php echo $filtro_tipo_itin === 'cycling' ? 'is-active' : ''; ?>" data-tipo="cycling">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5" cy="18" r="3"/><circle cx="19" cy="18" r="3"/><path d="M12 18l-3-8h8"/></svg>
                Ciclismo
            </a>
            <a href="?tipo=ferrata" class="ig-itin-subnav__pill <?php echo $filtro_tipo_itin === 'ferrata' ? 'is-active' : ''; ?>" data-tipo="ferrata">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20L20 4"/><path d="M8 16l2-2"/><path d="M12 12l2-2"/><path d="M16 8l2-2"/></svg>
                Vie Ferrate
            </a>
            <a href="?tipo=water" class="ig-itin-subnav__pill <?php echo $filtro_tipo_itin === 'water' ? 'is-active' : ''; ?>" data-tipo="water">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12c2-2 4-2 6 0s4 2 6 0 4-2 6 0"/><path d="M2 18c2-2 4-2 6 0s4 2 6 0 4-2 6 0"/></svg>
                Sport Acquatici
            </a>
            <a href="?tipo=drive" class="ig-itin-subnav__pill <?php echo $filtro_tipo_itin === 'drive' ? 'is-active' : ''; ?>" data-tipo="drive">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 17h14"/><path d="M5 12h14"/><path d="M7 7h10"/></svg>
                Scenic Drive
            </a>
        </div>
    </div>
</section>

<!-- Filtri pill -->
<section class="ig-itin-filters">
    <div class="ig-container">
        <!-- Nascosto, usato dal JS per compatibilità -->
        <select id="igTbarCat" style="display:none">
            <option value="all">Tutte</option>
            <option value="hiking">Trekking</option>
            <option value="cycling">Ciclismo</option>
            <option value="mtb">Mountain Bike</option>
            <option value="ferrata">Via Ferrata</option>
            <option value="water">Sport Acquatici</option>
            <option value="drive">Scenic Drive</option>
        </select>

        <div class="ig-itin-filters__row">
            <span class="ig-itin-filters__label">Difficoltà</span>
            <div class="ig-itin-filters__pills" id="igFilterDiff">
                <button class="ig-itin-filters__pill is-active" data-diff="all">Tutte</button>
                <button class="ig-itin-filters__pill" data-diff="facile">Facile</button>
                <button class="ig-itin-filters__pill" data-diff="media">Media</button>
                <button class="ig-itin-filters__pill" data-diff="difficile">Difficile</button>
            </div>
        </div>
        <div class="ig-itin-filters__row">
            <span class="ig-itin-filters__label">Periodo</span>
            <div class="ig-itin-filters__pills" id="igFilterSeason">
                <button class="ig-itin-filters__pill is-active" data-season="all">Tutto l'anno</button>
                <button class="ig-itin-filters__pill" data-season="primavera">Primavera</button>
                <button class="ig-itin-filters__pill" data-season="estate">Estate</button>
                <button class="ig-itin-filters__pill" data-season="autunno">Autunno</button>
                <button class="ig-itin-filters__pill" data-season="inverno">Inverno</button>
            </div>
        </div>
    </div>
</section>

<!-- Mappa Leaflet -->
<section class="ig-apple-section ig-apple-section--white" style="padding-top:var(--sp-lg);padding-bottom:0">
    <div class="ig-apple-container ig-apple-container--wide">
        <div class="ig-trail-map-wrap">
            <div id="igTrailMap"></div>
        </div>
    </div>
</section>

<!-- Griglia itinerari -->
<section class="ig-apple-section ig-apple-section--light">
    <div class="ig-apple-container">
        <div class="ig-trail-grid" id="igTrailGrid"></div>
        <p class="ig-trail-count" id="igTrailCount"></p>
    </div>
</section>

<!-- Dettaglio itinerario — Modal centrato Apple-style -->
<div class="ig-td-overlay" id="igTrailDetail">
    <div class="ig-td-overlay__bg" id="igTrailDetailClose"></div>
    <div class="ig-td-modal">
        <button class="ig-td-modal__close" id="igTrailDetailX">&times;</button>
        <div class="ig-td-modal__map" id="igTrailDetailMap"></div>
        <div class="ig-td-modal__content" id="igTrailDetailBody"></div>
    </div>
</div>

<!-- Leaflet CSS/JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ─── Database itinerari Lago di Garda ───
    var trails = [
        { id:1, name:'Sentiero del Ponale', type:'hiking', lat:45.8730, lng:10.8340, difficulty:'facile', km:5.2, elevation:290, descent:250, hours:'2:00', zone:'Riva del Garda', tags:['vista-lago','panoramico','consigliato','culturale','famiglie','ristori'], desc:'Spettacolare sentiero scavato nella roccia a picco sul lago. Ex strada militare austro-ungarica, oggi il sentiero più iconico del Garda. Partenza dal porto vecchio di Riva, arrivo al Lago di Ledro con possibilità di sosta al rifugio. Vista costante sul lago e le montagne.' },
        { id:2, name:'Rocca di Manerba', type:'hiking', lat:45.5520, lng:10.5530, difficulty:'facile', km:3.5, elevation:120, descent:120, hours:'1:15', zone:'Manerba del Garda', tags:['vista-lago','panoramico','circolare','famiglie','culturale','cani','balneabile'], desc:'Sentiero panoramico sulla penisola con resti del castello medievale e vista a 360° sul basso lago. Parco archeologico naturalistico con pannelli informativi. Percorso ad anello adatto a tutti.' },
        { id:3, name:'Sentiero dei Limoni', type:'hiking', lat:45.8090, lng:10.7900, difficulty:'facile', km:2.8, elevation:80, descent:80, hours:'1:00', zone:'Limone sul Garda', tags:['panoramico','famiglie','culturale','accessibile'], desc:'Passeggiata tra le antiche limonaie con terrazzamenti e viste sulla sponda bresciana. Percorso storico che racconta la tradizione agrumicola del Garda. Facile e adatto a tutti.' },
        { id:4, name:'Cima Comer da Gargnano', type:'hiking', lat:45.6940, lng:10.6460, difficulty:'difficile', km:12.5, elevation:1150, descent:1150, hours:'5:30', zone:'Gargnano', tags:['panoramico'], desc:'Salita impegnativa verso la Cima Comer (1279m). Sentiero nel bosco con tratti esposti nella parte finale. Dalla vetta si vede l\'intero lago, dal Trentino a Sirmione. Solo per escursionisti esperti.' },
        { id:5, name:'Sentiero del Ventrar', type:'hiking', lat:45.7650, lng:10.7600, difficulty:'media', km:7.0, elevation:420, descent:420, hours:'3:00', zone:'Tremosine', tags:['panoramico','circolare'], desc:'Percorso panoramico sull\'altopiano di Tremosine. Vista vertiginosa sulla Strada della Forra e sul lago. Partenza da Pieve di Tremosine con ritorno ad anello tra borghi e uliveti.' },
        { id:6, name:'Monte Baldo — Cresta', type:'hiking', lat:45.7250, lng:10.8520, difficulty:'media', km:8.5, elevation:480, descent:480, hours:'3:30', zone:'Malcesine', tags:['vista-lago','panoramico','consigliato','mezzi'], desc:'Traversata in cresta sul Monte Baldo con vista lago e Dolomiti. Si sale in funivia da Malcesine (1760m) e si cammina lungo il crinale tra prati fioriti e panorami infiniti. Discesa a piedi o in funivia.' },
        { id:7, name:'Punta San Vigilio', type:'hiking', lat:45.5660, lng:10.7100, difficulty:'facile', km:4.0, elevation:50, descent:50, hours:'1:30', zone:'Garda', tags:['vista-lago','panoramico','famiglie','cani','consigliato','balneabile','ombreggiato'], desc:'Passeggiata tra uliveti e cipressi verso la punta più romantica del lago. Baia nascosta, villa cinquecentesca e locanda storica. Percorso pianeggiante adatto a tutti.' },
        { id:8, name:'Cascate di Molina', type:'hiking', lat:45.5850, lng:10.8450, difficulty:'media', km:6.0, elevation:350, descent:350, hours:'2:30', zone:'Fumane', tags:['panoramico','ristori'], desc:'Percorso nel Parco delle Cascate con passerelle sospese tra gole e salti d\'acqua. Tre percorsi di diversa lunghezza. Ingresso a pagamento. Fresco anche in estate.' },
        { id:9, name:'Eremo di San Giorgio', type:'hiking', lat:45.5430, lng:10.7050, difficulty:'facile', km:3.2, elevation:180, descent:180, hours:'1:15', zone:'Bardolino', tags:['panoramico','culturale','circolare'], desc:'Breve salita all\'eremo con panorama sulla distesa del lago e i vigneti del Bardolino. Sentiero tra cipressi e uliveti. Ritorno per lo stesso sentiero o variante ad anello.' },
        { id:10, name:'Busatte — Tempesta', type:'hiking', lat:45.8540, lng:10.8740, difficulty:'facile', km:4.0, elevation:200, descent:400, hours:'1:30', zone:'Torbole', tags:['vista-lago','panoramico','famiglie','consigliato','mezzi'], desc:'Il sentiero più famoso dell\'alto Garda: 400 gradini di ferro a picco sul lago con vista mozzafiato. Da Busatte (Nago) si scende a Tempesta. Facile ma spettacolare. Bus navetta per il ritorno.' },
        { id:11, name:'Monte Brione', type:'hiking', lat:45.8780, lng:10.8810, difficulty:'facile', km:5.5, elevation:200, descent:200, hours:'2:00', zone:'Riva del Garda', tags:['panoramico','circolare','famiglie','culturale','cani'], desc:'Anello sulla collina tra Riva e Torbole. Forte austro-ungarico, flora mediterranea e viste su entrambi i paesi. Percorso botanico con orchidee selvatiche. Uno dei migliori per principianti.' },
        { id:12, name:'Rifugio Altissimo', type:'hiking', lat:45.8200, lng:10.9100, difficulty:'difficile', km:14.0, elevation:1100, descent:1100, hours:'6:00', zone:'Brentonico', tags:['panoramico','ristori'], desc:'Escursione impegnativa fino al Monte Altissimo (2079m), il balcone panoramico del Garda. Dal rifugio Damiano Chiesa si domina l\'intero lago. Possibilità di pernottamento in rifugio.' },
        { id:13, name:'Ciclabile Limone — Riva', type:'cycling', lat:45.8350, lng:10.8020, difficulty:'facile', km:15.0, elevation:60, descent:60, hours:'1:00', zone:'Limone sul Garda', tags:['vista-lago','panoramico','famiglie','accessibile','ebike','consigliato','passeggino'], desc:'La ciclabile a sbalzo sul lago più famosa d\'Europa. Passerelle agganciate alla roccia a picco sull\'acqua. Percorso pianeggiante e protetto, adatto anche a bambini e e-bike. Vista spettacolare per tutto il tragitto.' },
        { id:14, name:'Ciclopista del Mincio', type:'cycling', lat:45.4390, lng:10.6880, difficulty:'facile', km:43.0, elevation:40, descent:40, hours:'3:00', zone:'Peschiera del Garda', tags:['famiglie','accessibile','ebike','ristori','cani','consigliato','passeggino','ombreggiato','culturale'], desc:'Da Peschiera del Garda a Mantova lungo il fiume Mincio. Percorso completamente pianeggiante su pista ciclabile separata. Attraversa Borghetto (uno dei borghi più belli d\'Italia), Valeggio e il Parco del Mincio.' },
        { id:15, name:'Colline Moreniche', type:'cycling', lat:45.4600, lng:10.6300, difficulty:'media', km:38.0, elevation:450, descent:450, hours:'2:30', zone:'Desenzano del Garda', tags:['panoramico','circolare','ebike','ristori'], desc:'Percorso tra le colline moreniche del basso lago. Vigneti, castelli, borghi medievali e panorami sul Garda. Alcuni strappi in salita ma nulla di impegnativo con e-bike.' },
        { id:16, name:'Ciclabile della Vallagarina', type:'cycling', lat:45.8900, lng:10.9800, difficulty:'facile', km:25.0, elevation:80, descent:80, hours:'1:45', zone:'Riva del Garda', tags:['famiglie','accessibile','ebike'], desc:'Da Rovereto a Riva del Garda su pista ciclabile separata. Lungo il fiume Adige e il suggestivo lago di Loppio. Percorso in leggera discesa verso il lago — ideale con bambini.' },
        { id:17, name:'Tremalzo Trail', type:'mtb', lat:45.8100, lng:10.7200, difficulty:'difficile', km:32.0, elevation:1500, descent:1800, hours:'5:00', zone:'Limone sul Garda', tags:['panoramico'], desc:'Il trail MTB più iconico del Garda. Salita su strada sterrata al Passo Tremalzo (1665m), poi discesa mozzafiato su single trail tecnici con viste aeree sul lago. Solo per biker esperti con buona preparazione fisica.' },
        { id:18, name:'Trail 601 Monte Baldo', type:'mtb', lat:45.7350, lng:10.8600, difficulty:'difficile', km:18.0, elevation:1700, descent:1700, hours:'3:30', zone:'Malcesine', tags:['panoramico'], desc:'Funivia da Malcesine + discesa dal Monte Baldo su trail tecnico con viste aeree sul lago. Trail 601: il più famoso downhill del Garda. Solo per esperti con protezioni.' },
        { id:19, name:'Ponale MTB', type:'mtb', lat:45.8720, lng:10.8350, difficulty:'media', km:12.0, elevation:600, descent:600, hours:'2:00', zone:'Riva del Garda', tags:['panoramico','circolare','ristori'], desc:'Variante MTB del sentiero del Ponale. Salita al Lago di Ledro e ritorno su sentiero panoramico. Percorso misto strada e trail, adatto a biker di livello intermedio.' },
        { id:20, name:'San Michele — Monte Cas', type:'mtb', lat:45.6300, lng:10.5800, difficulty:'media', km:22.0, elevation:850, descent:850, hours:'3:00', zone:'Salò', tags:['panoramico','circolare'], desc:'Trail da Salò verso l\'entroterra. Single track tra i boschi con viste sul golfo. Percorso ad anello con mix di salita su forestale e discesa su sentiero.' },
        { id:21, name:'Via Ferrata Cima Capi', type:'ferrata', lat:45.8650, lng:10.8200, difficulty:'difficile', km:4.5, elevation:600, descent:600, hours:'4:00', zone:'Riva del Garda', tags:['panoramico'], desc:'Ferrata con vista aerea sul lago, cenge esposte e tratti verticali. Tra le più belle ferrate delle Alpi. Partenza dal Sentiero del Ponale. Necessaria attrezzatura completa da ferrata. Vista indimenticabile dalla cima.' },
        { id:22, name:'Via Ferrata Monte Colodri', type:'ferrata', lat:45.9200, lng:10.8850, difficulty:'media', km:2.5, elevation:350, descent:350, hours:'2:30', zone:'Arco', tags:['panoramico','culturale'], desc:'Ferrata breve ma intensa sopra la città di Arco. Panorama sulla valle del Sarca e sul Garda. Tratti verticali ma ben attrezzati. Castello di Arco alla partenza. Ideale come prima ferrata.' },
        { id:23, name:'Via Ferrata Che Guevara', type:'ferrata', lat:45.7680, lng:10.7450, difficulty:'difficile', km:3.0, elevation:450, descent:450, hours:'3:30', zone:'Pietramurata', tags:['panoramico'], desc:'Ferrata atletica su parete verticale con ponti tibetani e strapiombi sulla Valle del Sarca. Richiede ottima forma fisica e assenza di vertigini. Una delle più impegnative della zona.' },
        { id:24, name:'Windsurf & Kitesurf Torbole', type:'water', lat:45.8680, lng:10.8760, difficulty:'media', km:0, elevation:0, descent:0, hours:'—', zone:'Torbole', tags:['panoramico'], desc:'Torbole è la capitale mondiale del windsurf grazie al vento Ora (pomeridiano da sud) e Pelér (mattutino da nord). Spot perfetto per kite e windsurf da aprile a ottobre. Numerose scuole e noleggi sulla spiaggia.' },
        { id:25, name:'SUP Tour Sirmione', type:'water', lat:45.4960, lng:10.6080, difficulty:'facile', km:0, elevation:0, descent:0, hours:'2:00', zone:'Sirmione', tags:['panoramico','famiglie'], desc:'Tour in Stand-Up Paddle attorno al castello scaligero e le grotte di Catullo. Acqua cristallina, fonti termali sul lago e vista unica sulla penisola. Adatto anche a principianti con guida.' },
        { id:26, name:'Vela — Regate del Garda', type:'water', lat:45.5800, lng:10.6400, difficulty:'media', km:0, elevation:0, descent:0, hours:'—', zone:'Gargnano', tags:['panoramico'], desc:'Il Garda è la meta velica numero uno in Italia. Sede della Centomiglia, regata internazionale con 300+ barche. Scuole vela a Riva, Gargnano e Malcesine. Vento costante e affidabile tutto l\'anno.' },
        { id:27, name:'Canyoning Rio Nero', type:'water', lat:45.8550, lng:10.8300, difficulty:'difficile', km:0, elevation:0, descent:0, hours:'3:00', zone:'Torbole', tags:[], desc:'Discesa nelle gole del Rio Nero con tuffi, toboggan naturali e calate in corda. Brivido puro in un ambiente mozzafiato. Solo con guida autorizzata. Da maggio a settembre.' },

        // --- Batch 2: 34 nuovi itinerari ---

        // Hiking — Sponda Ovest & Nord
        { id:28, name:'Punta Larici da Pregasina', type:'hiking', lat:45.8680, lng:10.8050, difficulty:'media', km:5.0, elevation:350, descent:350, hours:'2:00', zone:'Riva del Garda', tags:['vista-lago','panoramico','consigliato'], desc:'Il belvedere più spettacolare dell\'intero Lago di Garda. Un balcone naturale a 900 metri che si affaccia a strapiombo sul lago, con vista su Limone, Malcesine, Brenzone e il Monte Baldo.' },
        { id:29, name:'Sentiero del Sole', type:'hiking', lat:45.8130, lng:10.7850, difficulty:'media', km:9.0, elevation:500, descent:500, hours:'3:30', zone:'Limone sul Garda', tags:['panoramico','culturale'], desc:'Passeggiata panoramica da Limone tra oliveti, bouganville e una passerella sospesa sul lago. Tracce delle due Guerre Mondiali lungo il percorso.' },
        { id:30, name:'Monte Tremalzo e Corno della Marogna', type:'hiking', lat:45.8200, lng:10.7100, difficulty:'difficile', km:14.0, elevation:1000, descent:1000, hours:'5:30', zone:'Limone sul Garda', tags:['panoramico'], desc:'Trekking alpino lungo sentieri militari WWI fino al Monte Tremalzo e al Corno della Marogna. Vista a 360° su Garda, Ledro e Dolomiti di Brenta.' },

        // Hiking — Sponda Veronese
        { id:31, name:'Ponte Tibetano di Torri del Benaco', type:'hiking', lat:45.6200, lng:10.6850, difficulty:'facile', km:3.0, elevation:50, descent:50, hours:'1:00', zone:'Torri del Benaco', tags:['panoramico','famiglie'], desc:'Ponte tibetano sospeso a 45 metri nella Val Vanzana. 34 metri di adrenalina inaugurati nel 2019. Passeggiata breve adatta a famiglie.' },
        { id:32, name:'Monte Luppia e Petroglifi', type:'hiking', lat:45.5750, lng:10.7050, difficulty:'facile', km:6.0, elevation:200, descent:200, hours:'2:00', zone:'Garda', tags:['panoramico','culturale','famiglie'], desc:'Incisioni rupestri neolitiche ai piedi del Monte Luppia tra oliveti e macchia mediterranea. Un percorso unico che unisce natura e archeologia.' },
        { id:33, name:'Cima Valdritta da Novezzina', type:'hiking', lat:45.7400, lng:10.8850, difficulty:'difficile', km:13.0, elevation:965, descent:965, hours:'5:30', zone:'Ferrara di Monte Baldo', tags:['panoramico','ristori'], desc:'La vetta più alta del Monte Baldo (2218m) dal versante est. Si parte dal Rifugio Novezzina vicino all\'Orto Botanico. Vista a 360° dalle Dolomiti alla Pianura Padana.' },
        { id:34, name:'Prada Alta — Rifugio Mondini', type:'hiking', lat:45.6400, lng:10.7600, difficulty:'facile', km:8.0, elevation:400, descent:400, hours:'3:00', zone:'San Zeno di Montagna', tags:['panoramico','famiglie','circolare','ristori'], desc:'Anello dolce sulla terrazza di Prada, il balcone del Garda. Prati alpini con mucche, antichi abbeveratoi e malghe tradizionali. Da San Zeno di Montagna (680m).' },
        { id:35, name:'Forte Naole — Sentiero 662', type:'hiking', lat:45.7300, lng:10.8800, difficulty:'media', km:10.0, elevation:600, descent:600, hours:'4:30', zone:'Ferrara di Monte Baldo', tags:['panoramico','culturale'], desc:'Salita lungo il sentiero 662 fino al Forte Naole (1675m), la più alta fortificazione militare italiana del sistema difensivo di Rivoli (1905-1913).' },
        { id:36, name:'Cresta di Naole', type:'hiking', lat:45.6600, lng:10.7800, difficulty:'media', km:12.0, elevation:650, descent:650, hours:'5:00', zone:'San Zeno di Montagna', tags:['panoramico','circolare','ristori'], desc:'Cresta alternativa meno affollata del Monte Baldo. Prati fioriti, Rifugio Fiori del Baldo e Rifugio Chierego. Vista su Garda e Val d\'Adige.' },
        { id:37, name:'Sentiero della Salute', type:'hiking', lat:45.7630, lng:10.8100, difficulty:'facile', km:8.0, elevation:250, descent:250, hours:'2:30', zone:'Malcesine', tags:['vista-lago','panoramico','famiglie','cani'], desc:'Anello tra lungolago Malcesine-Cassone e sentiero collinare. A Cassone il fiume Aril, il più corto del mondo (175m). Borghi di pescatori e oliveti.' },
        { id:38, name:'Brenzone Nordic Walking Park', type:'hiking', lat:45.7200, lng:10.7700, difficulty:'facile', km:20.0, elevation:300, descent:300, hours:'3:00', zone:'Brenzone sul Garda', tags:['vista-lago','famiglie','circolare','cani'], desc:'Primo Nordic Walking Park del Garda. 4 anelli tra 16 borghi medievali: Verde (4km), Blu (6km), Rosso (7km), Nero (5km). Borgo di Campo con chiesa di San Pietro in Vincoli.' },
        { id:39, name:'Rocca di Garda & Eremo Camaldolesi', type:'hiking', lat:45.5700, lng:10.7050, difficulty:'facile', km:7.0, elevation:200, descent:200, hours:'2:00', zone:'Garda', tags:['panoramico','culturale','circolare'], desc:'Anello sul promontorio tra Garda e Bardolino. Eremo dei Camaldolesi (1663). Panorama a 360° da Malcesine a Sirmione. Nome Garda dal germanico Warda (torre di guardia).' },
        { id:40, name:'Circuito Storico di Rivoli Veronese', type:'hiking', lat:45.5800, lng:10.8100, difficulty:'facile', km:8.0, elevation:200, descent:200, hours:'3:00', zone:'Rivoli Veronese', tags:['culturale','circolare'], desc:'Battaglia di Napoleone 1797. Museo Napoleonico, Forte Wohlgemuth (1854), Tagliata di Incanale. Il forte ospita un museo della Prima Guerra Mondiale.' },
        { id:41, name:'Mura UNESCO di Peschiera', type:'hiking', lat:45.4400, lng:10.6900, difficulty:'facile', km:3.0, elevation:10, descent:10, hours:'1:00', zone:'Peschiera del Garda', tags:['culturale','famiglie','accessibile'], desc:'Mura veneziane pentagonali XVI-XVII secolo, Patrimonio UNESCO 2017. Camminamento di ronda tra 5 bastioni con vista sui canali e sul Mincio.' },
        { id:42, name:'Monte Moscal', type:'hiking', lat:45.5300, lng:10.7700, difficulty:'facile', km:8.0, elevation:250, descent:250, hours:'2:30', zone:'Cavaion Veronese', tags:['panoramico','circolare'], desc:'Colline moreniche con bunker NATO della Guerra Fredda in cima (434m). Panorama a 360° dal Garda alla Val d\'Adige. Val Sorda e borgo di Incaffi.' },
        { id:43, name:'Costermano — Oliveti e Memoriale', type:'hiking', lat:45.5600, lng:10.7300, difficulty:'facile', km:5.0, elevation:100, descent:100, hours:'1:30', zone:'Costermano sul Garda', tags:['culturale','famiglie'], desc:'Passeggiata tra oliveti fino al Cimitero Militare Tedesco (20.000 soldati). Memoriale WW2 con mosaici e portale in bronzo. Valle dei Mulini per estensione.' },
        { id:44, name:'CamminaCustoza', type:'hiking', lat:45.3900, lng:10.7800, difficulty:'facile', km:8.0, elevation:150, descent:150, hours:'2:30', zone:'Custoza', tags:['panoramico','culturale','circolare'], desc:'Colline moreniche teatro del Risorgimento (1848 e 1866). Ossario, vigneti Custoza DOC, Forte Degenfeld a Pastrengo. Paesaggio dolce 100-250m.' },

        // Cycling — Nuovi
        { id:45, name:'Peschiera — Sirmione — Desenzano', type:'cycling', lat:45.4400, lng:10.6900, difficulty:'facile', km:36.0, elevation:30, descent:30, hours:'2:30', zone:'Peschiera del Garda', tags:['vista-lago','famiglie','accessibile','ebike','consigliato'], desc:'Giro della sponda sud: Castello Scaligero di Sirmione, Grotte di Catullo, tre località top del Garda. Percorso piano, ideale per famiglie.' },
        { id:46, name:'Peschiera — Garda Lungolago', type:'cycling', lat:45.4400, lng:10.6900, difficulty:'facile', km:18.0, elevation:30, descent:30, hours:'1:30', zone:'Peschiera del Garda', tags:['vista-lago','famiglie','accessibile','ebike'], desc:'Ciclabile della riviera veronese: fortezza UNESCO, Lazise medievale, vigneti di Bardolino, paese di Garda. Completamente piano.' },
        { id:47, name:'Strada del Vino Bardolino', type:'cycling', lat:45.5400, lng:10.7300, difficulty:'media', km:35.0, elevation:300, descent:300, hours:'2:30', zone:'Bardolino', tags:['panoramico','circolare','ebike','ristori','culturale'], desc:'16 comuni, 60+ cantine, Bardolino DOC. Cammino del Bardolino: 18 sentieri segnalati, 53 pannelli informativi. Degustazioni in cantina.' },
        { id:48, name:'Ciclovia del Sole — Rivoli — Verona', type:'cycling', lat:45.5800, lng:10.8200, difficulty:'facile', km:20.0, elevation:30, descent:30, hours:'1:30', zone:'Rivoli Veronese', tags:['famiglie','accessibile','ebike','culturale'], desc:'EuroVelo 7 lungo il Canale Biffis. Forti austriaci, chiuse storiche, dal campo di battaglia di Napoleone a Verona. Asfaltato e separato dal traffico.' },
        { id:49, name:'Salò — Valtenesi Loop', type:'cycling', lat:45.6100, lng:10.5200, difficulty:'media', km:48.0, elevation:400, descent:400, hours:'3:00', zone:'Salò', tags:['panoramico','circolare','ebike','ristori'], desc:'Colline della Valtenesi: Chiaretto, Groppello, castelli medievali. Manerba, Moniga, Padenghe. Terreno ondulato con vista costante sul lago.' },
        { id:50, name:'Ciclopedonale Brenzone — Malcesine', type:'cycling', lat:45.7200, lng:10.7700, difficulty:'facile', km:20.0, elevation:20, descent:20, hours:'1:30', zone:'Brenzone sul Garda', tags:['vista-lago','famiglie','accessibile','ebike','passeggino'], desc:'Percorso piano e asfaltato tra 10 borghi della sponda nord-est. Castello Scaligero di Malcesine, museo del lago a Cassone. Adatto a tutti.' },

        // MTB — Nuovi
        { id:51, name:'Monte Baldo Red Tour', type:'mtb', lat:45.7650, lng:10.8100, difficulty:'difficile', km:35.0, elevation:375, descent:1958, hours:'4:00', zone:'Malcesine', tags:['panoramico','mezzi'], desc:'Funivia + mega discesa di 2000m! Versante trentino verso Brentonico, Loppio, Torbole. Da ambiente alpino alle rive del lago. 24 bici/ora in funivia.' },
        { id:52, name:'Prada Enduro Trails', type:'mtb', lat:45.6400, lng:10.7700, difficulty:'media', km:15.0, elevation:600, descent:600, hours:'3:00', zone:'San Zeno di Montagna', tags:['panoramico','circolare'], desc:'17 trail dedicati a Prada/San Zeno di Montagna. Trail 51/54: 5km singletrack blu. Malga Valfredda: 3.6km, 361m dislivello. Meno affollata della funivia.' },

        // Via Ferrata — Nuove
        { id:53, name:'Via Ferrata Gerardo Sega', type:'ferrata', lat:45.7500, lng:10.9400, difficulty:'difficile', km:5.0, elevation:1000, descent:1000, hours:'5:00', zone:'Avio', tags:['panoramico'], desc:'Ferrata scenografica con Cascata della Preafessa. Scale su parete strapiombante, cavi su cenge esposte. Difficoltà C, molto esposta.' },
        { id:54, name:'Via Ferrata delle Taccole', type:'ferrata', lat:45.7300, lng:10.8600, difficulty:'difficile', km:3.0, elevation:400, descent:400, hours:'6:00', zone:'Malcesine', tags:['panoramico'], desc:'La ferrata più difficile del Garda. Dal Rifugio Telegrafo, tre sezioni crescenti: camino verticale, placca strapiombante, crack-camino. Solo esperti. Difficoltà C/D.' },

        // Scenic Drive — Nuova categoria
        { id:55, name:'Strada della Forra', type:'drive', lat:45.7800, lng:10.7700, difficulty:'media', km:6.0, elevation:400, descent:0, hours:'0:30', zone:'Tremosine sul Garda', tags:['panoramico','consigliato'], desc:'L\'ottava meraviglia del mondo (Churchill). Gallerie nella gola del torrente Brasa. Set di James Bond Quantum of Solace. Solo veicoli piccoli.' },
        { id:56, name:'Strada Panoramica del Monte Baldo', type:'drive', lat:45.6000, lng:10.8000, difficulty:'media', km:25.0, elevation:800, descent:0, hours:'1:00', zone:'Caprino Veronese', tags:['panoramico','culturale'], desc:'Tornanti sul versante orientale del Monte Baldo. Santuario Madonna della Corona incastonato nella roccia a 774m. San Zeno di Montagna e funivia per la cresta.' },
        { id:57, name:'Valvestino e Cima Rest', type:'drive', lat:45.7100, lng:10.5500, difficulty:'media', km:30.0, elevation:600, descent:0, hours:'1:00', zone:'Gargnano', tags:['panoramico','culturale'], desc:'Entroterra segreto. Cima Rest: fienili con tetto in paglia austro-ungarici. Osservatorio astronomico (maggio-settembre). Valle selvaggia dietro il lungolago.' },

        // Multi-day
        { id:58, name:'Garda Trek — Top Loop', type:'hiking', lat:45.8850, lng:10.8430, difficulty:'difficile', km:95.0, elevation:5500, descent:5500, hours:'7 tappe', zone:'Riva del Garda', tags:['panoramico','consigliato','ristori','multiday'], desc:'Il trekking definitivo: 7 tappe rifugio in rifugio attorno alle vette trentine, dal lago a 2000m+. Solo giugno-ottobre.' },
        { id:59, name:'Garda Trek — Medium Loop', type:'hiking', lat:45.8850, lng:10.8430, difficulty:'media', km:73.0, elevation:3275, descent:3275, hours:'4 tappe', zone:'Riva del Garda', tags:['panoramico','consigliato','ristori','multiday','culturale'], desc:'4 tappe a quota media. Borgo medievale di Tenno, turchese Lago di Tenno, villaggio artisti di Canale. Quasi tutto l\'anno.' },
        { id:60, name:'Garda Trek — Low Loop', type:'hiking', lat:45.8850, lng:10.8430, difficulty:'facile', km:33.0, elevation:1045, descent:1045, hours:'2 tappe', zone:'Riva del Garda', tags:['panoramico','famiglie','ristori','multiday'], desc:'Mini-trek 2 tappe: Riva-Arco (castello) e ritorno via Nago-Torbole (windsurf). Accessibile tutto l\'anno, anche in giornata.' },
        { id:61, name:'GranGarda Bikepacking', type:'cycling', lat:45.6500, lng:10.7500, difficulty:'difficile', km:350.0, elevation:10000, descent:10000, hours:'3-5 giorni', zone:'Lago di Garda', tags:['panoramico','consigliato','multiday'], desc:'Circumnavigazione gravel 350km, 10.000m+ dislivello. 40% asfalto, 40% sterrato, 20% mulattiere. Gomme 40mm+. Aprile-maggio o settembre-ottobre.' },
    ];

    // Slugs per link a pagine single
    var slugs = {1:'sentiero-del-ponale',2:'rocca-di-manerba',3:'sentiero-dei-limoni',4:'cima-comer-gargnano',5:'sentiero-del-ventrar',6:'monte-baldo-cresta',7:'punta-san-vigilio',8:'cascate-di-molina',9:'eremo-di-san-giorgio',10:'busatte-tempesta',11:'monte-brione',12:'rifugio-altissimo',13:'ciclabile-limone-riva',14:'ciclopista-del-mincio',15:'colline-moreniche',16:'ciclabile-vallagarina',17:'tremalzo-trail',18:'trail-601-monte-baldo',19:'ponale-mtb',20:'san-michele-monte-cas',21:'via-ferrata-cima-capi',22:'via-ferrata-monte-colodri',23:'via-ferrata-che-guevara',24:'windsurf-kitesurf-torbole',25:'sup-tour-sirmione',26:'vela-regate-del-garda',27:'canyoning-rio-nero',28:'punta-larici-pregasina',29:'sentiero-del-sole',30:'monte-tremalzo-corno-marogna',31:'ponte-tibetano-torri',32:'monte-luppia-petroglifi',33:'cima-valdritta-novezzina',34:'prada-alta-rifugio-mondini',35:'forte-naole-sentiero-662',36:'cresta-di-naole',37:'sentiero-della-salute-malcesine',38:'brenzone-nordic-walking',39:'rocca-di-garda-camaldolesi',40:'circuito-storico-rivoli',41:'mura-unesco-peschiera',42:'monte-moscal',43:'costermano-oliveti-memoriale',44:'cammina-custoza',45:'peschiera-sirmione-desenzano',46:'peschiera-garda-lungolago',47:'strada-vino-bardolino',48:'ciclovia-sole-rivoli-verona',49:'salo-valtenesi-loop',50:'ciclopedonale-brenzone-malcesine',51:'monte-baldo-red-tour',52:'prada-enduro-trails',53:'via-ferrata-gerardo-sega',54:'via-ferrata-delle-taccole',55:'strada-della-forra',56:'strada-panoramica-monte-baldo',57:'valvestino-cima-rest',58:'garda-trek-top-loop',59:'garda-trek-medium-loop',60:'garda-trek-low-loop',61:'grangarda-bikepacking'};
    trails.forEach(function(t) { t.slug = slugs[t.id] || ''; });

    // OutdoorActive IDs per embed mappa con percorso + profilo altimetrico
    var oaIds = {1:1481019, 2:1530226, 3:1505183, 4:1497954, 5:14352779, 6:215009748, 7:265353721, 8:58399382, 9:804061398, 10:1541894, 11:1490743, 12:14373302, 13:800639914, 14:56764715, 15:209343437, 16:8350452, 17:15856288, 18:17856272, 19:15866611, 20:235469274, 21:8270049, 22:1374487, 23:58397823};
    trails.forEach(function(t) { t.oaId = oaIds[t.id] || 0; });

    var typeColors = { hiking:'#10B981', cycling:'#3B82F6', mtb:'#F59E0B', ferrata:'#EF4444', water:'#06B6D4', drive:'#8B5CF6' };
    var typeLabels = { hiking:'Trekking', cycling:'Ciclismo', mtb:'MTB', ferrata:'Via Ferrata', water:'Acquatici', drive:'Scenic Drive' };
    var diffLevels = ['facile','media','difficile'];
    var diffColors = { facile:'#10B981', media:'#F59E0B', difficile:'#EF4444' };
    var tagLabels = { 'vista-lago':'Vista lago', panoramico:'Panoramico', circolare:'Circolare', famiglie:'Famiglie', passeggino:'Passeggino', cani:'Dog-friendly', ebike:'E-bike', mezzi:'Con mezzi', consigliato:'Consigliato', balneabile:'Balneabile', ombreggiato:'Ombreggiato', culturale:'Interesse culturale', ristori:'Punti ristoro', accessibile:'Accessibile' };

    // ─── Stagioni per tipo ───
    var typeSeasons = {
        hiking:  ['primavera','estate','autunno','inverno'],
        cycling: ['primavera','estate','autunno','inverno'],
        mtb:     ['primavera','estate','autunno'],
        ferrata: ['primavera','estate','autunno'],
        water:   ['estate'],
        drive:   ['primavera','estate','autunno','inverno']
    };

    // ─── Filtri pill: Difficoltà ───
    var activeDiff = 'all';
    document.querySelectorAll('#igFilterDiff .ig-itin-filters__pill').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#igFilterDiff .ig-itin-filters__pill').forEach(function(b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            activeDiff = btn.getAttribute('data-diff');
            applyFilters();
        });
    });

    // ─── Filtri pill: Periodo ───
    var activeSeason = 'all';
    document.querySelectorAll('#igFilterSeason .ig-itin-filters__pill').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#igFilterSeason .ig-itin-filters__pill').forEach(function(b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            activeSeason = btn.getAttribute('data-season');
            applyFilters();
        });
    });

    // ─── Mappa Leaflet (OpenTopoMap come pagine single) ───
    var map = L.map('igTrailMap', { scrollWheelZoom: false }).setView([45.65, 10.72], 10);
    map.setMaxBounds(L.latLngBounds([45.35,10.40],[45.95,11.05]).pad(0.1));
    map.setMinZoom(9);
    L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenTopoMap &copy; OSM', maxZoom: 17
    }).addTo(map);

    var markers = [];
    function createMarker(t) {
        var color = typeColors[t.type];
        var icon = L.divIcon({
            className: 'ig-trail-marker',
            html: '<div style="background:'+color+'"><span>'+t.id+'</span></div>',
            iconSize: [32,32], iconAnchor: [16,32], popupAnchor: [0,-34]
        });
        var m = L.marker([t.lat, t.lng], { icon: icon }).addTo(map);
        m.trailData = t;
        m.bindPopup(
            '<div class="ig-trail-popup"><strong>'+t.name+'</strong>' +
            '<div class="ig-trail-popup__meta"><span class="ig-trail-popup__badge" style="background:'+diffColors[t.difficulty]+'">'+t.difficulty+'</span> ' +
            (t.km > 0 ? t.km+' km · ' : '') + (t.elevation > 0 ? '+'+t.elevation+'m · ' : '') + t.hours + '</div>' +
            '<p>'+t.zone+'</p></div>',
            { maxWidth: 280, className: 'ig-trail-popup-wrap' }
        );
        m.on('click', function() {
            if (t.slug) { window.location.href = '<?php echo esc_url(home_url('/itinerario/')); ?>' + t.slug + '/'; }
        });
        markers.push(m);
    }
    trails.forEach(createMarker);

    // ─── Filtra ───
    function getFiltered() {
        var cat = document.getElementById('igTbarCat').value;

        return trails.filter(function(t) {
            // Filtro categoria (dalla sub-nav pill)
            if (cat !== 'all' && t.type !== cat) return false;
            // Filtro difficoltà
            if (activeDiff !== 'all' && t.difficulty !== activeDiff) return false;
            // Filtro stagione
            if (activeSeason !== 'all') {
                var seasons = typeSeasons[t.type] || ['primavera','estate','autunno'];
                if (seasons.indexOf(activeSeason) === -1) return false;
            }
            return true;
        });
    }

    var grid = document.getElementById('igTrailGrid');
    var countEl = document.getElementById('igTrailCount');

    function renderCards(filtered) {
        grid.innerHTML = '';
        filtered.forEach(function(t) {
            var color = typeColors[t.type];
            var tagsHtml = '';
            t.tags.forEach(function(tag) {
                if (tagLabels[tag]) tagsHtml += '<span class="ig-trail-card__tag">' + tagLabels[tag] + '</span>';
            });

            var statsHtml = '';
            if (t.km > 0) statsHtml += '<span class="ig-trail-card__stat"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18"/><path d="M8 6h10v10"/></svg>'+t.km+' km</span>';
            if (t.elevation > 0) statsHtml += '<span class="ig-trail-card__stat"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 20l5-16 5 10 3-4 5 10"/></svg>+'+t.elevation+'m</span>';
            if (t.hours !== '—') statsHtml += '<span class="ig-trail-card__stat"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>'+t.hours+'</span>';

            var card = document.createElement('div');
            card.className = 'ig-trail-card';
            card.innerHTML =
                '<div class="ig-trail-card__top">' +
                    '<span class="ig-trail-card__num" style="background:'+color+'">'+t.id+'</span>' +
                    '<div><span class="ig-trail-card__type" style="color:'+color+'">'+typeLabels[t.type]+'</span>' +
                    '<span class="ig-trail-card__diff" style="background:'+diffColors[t.difficulty]+'">'+t.difficulty+'</span></div>' +
                '</div>' +
                '<h3 class="ig-trail-card__title">'+t.name+'</h3>' +
                '<p class="ig-trail-card__zone"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg> '+t.zone+'</p>' +
                (tagsHtml ? '<div class="ig-trail-card__tags">'+tagsHtml+'</div>' : '') +
                (statsHtml ? '<div class="ig-trail-card__stats">'+statsHtml+'</div>' : '') +
                '<span class="ig-trail-card__cta">Scopri <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></span>';

            card.addEventListener('click', function() {
                if (t.slug) { window.location.href = '<?php echo esc_url(home_url('/itinerario/')); ?>' + t.slug + '/'; }
            });
            grid.appendChild(card);
        });
        countEl.textContent = filtered.length + ' itinerar' + (filtered.length === 1 ? 'io' : 'i') + (filtered.length < trails.length ? ' su ' + trails.length : '');
    }

    function applyFilters() {
        var filtered = getFiltered();
        renderCards(filtered);
        // Aggiorna marker e polyline
        var ids = filtered.map(function(t) { return t.id; });
        markers.forEach(function(m) {
            if (ids.indexOf(m.trailData.id) !== -1) {
                m.getElement().style.display = '';
            } else {
                m.getElement().style.display = 'none';
                m.closePopup();
            }
        });
        // Mostra/nascondi polyline
        Object.keys(routePolylines).forEach(function(oaId) {
            var rp = routePolylines[oaId];
            if (ids.indexOf(rp.trailId) !== -1) {
                if (!map.hasLayer(rp.line)) { rp.shadow.addTo(map); rp.line.addTo(map); }
            } else {
                map.removeLayer(rp.line); map.removeLayer(rp.shadow);
            }
        });
        // Fit bounds
        if (filtered.length > 0 && filtered.length < trails.length) {
            var bounds = L.latLngBounds(filtered.map(function(t) { return [t.lat, t.lng]; }));
            map.fitBounds(bounds.pad(0.15), { maxZoom: 13 });
        } else if (filtered.length === trails.length) {
            map.flyTo([45.65, 10.72], 10, { duration: 0.5 });
        }
    }

    // Sub-nav pill click → filtra per tipo
    var subnavPills = document.querySelectorAll('.ig-itin-subnav__pill');
    subnavPills.forEach(function(pill) {
        pill.addEventListener('click', function(e) {
            e.preventDefault();
            var tipo = pill.getAttribute('data-tipo');
            subnavPills.forEach(function(p) { p.classList.remove('is-active'); });
            pill.classList.add('is-active');
            document.getElementById('igTbarCat').value = tipo === 'all' ? 'all' : tipo;
            applyFilters();
        });
    });

    // Pre-filtra da URL ?tipo=
    var urlTipo = new URLSearchParams(window.location.search).get('tipo');
    if (urlTipo && urlTipo !== '') {
        document.getElementById('igTbarCat').value = urlTipo;
    }

    // Init
    renderCards(urlTipo ? getFiltered() : trails);

    // ─── Carica e disegna percorsi (polyline) sulla mappa ───
    var routePolylines = {}; // oaId -> L.polyline
    var ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
    var allOaIds = [];
    trails.forEach(function(t) { if (t.oaId) allOaIds.push(t.oaId); });

    if (allOaIds.length > 0) {
        fetch(ajaxUrl + '?action=ig_all_trail_routes&ids=' + allOaIds.join(','))
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (!res.success || !res.data) return;
                trails.forEach(function(t) {
                    if (!t.oaId || !res.data[t.oaId]) return;
                    var latlngs = res.data[t.oaId];
                    if (latlngs.length < 2) return;
                    var color = typeColors[t.type] || '#10B981';
                    // Bordo scuro + linea colorata
                    var shadow = L.polyline(latlngs, { color: '#333', weight: 5, opacity: 0.25, className: 'ig-route-shadow' }).addTo(map);
                    var line = L.polyline(latlngs, { color: color, weight: 3, opacity: 0.85, className: 'ig-route-line' }).addTo(map);
                    // Hover: evidenzia
                    line.on('mouseover', function() { line.setStyle({ weight: 5, opacity: 1 }); shadow.setStyle({ weight: 8, opacity: 0.4 }); });
                    line.on('mouseout', function() { line.setStyle({ weight: 3, opacity: 0.85 }); shadow.setStyle({ weight: 5, opacity: 0.25 }); });
                    // Click: vai alla pagina
                    line.on('click', function() {
                        if (t.slug) window.location.href = '<?php echo esc_url(home_url('/itinerario/')); ?>' + t.slug + '/';
                    });
                    routePolylines[t.oaId] = { shadow: shadow, line: line, trailId: t.id };
                });
            }).catch(function(){});
    }

    // Filtri auto-apply (nessun bottone "Cerca" necessario)

    // ─── Dettaglio itinerario (pannello laterale con mappa) ───
    var detailEl = document.getElementById('igTrailDetail');
    var detailMapEl = document.getElementById('igTrailDetailMap');
    var detailBody = document.getElementById('igTrailDetailBody');
    var detailMap = null;
    var detailMarker = null;

    function openDetail(t) {
        var color = typeColors[t.type];

        // Body
        var statsRows = '';
        if (t.km > 0) statsRows += '<div class="ig-td__stat-row"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18"/><path d="M8 6h10v10"/></svg><span>Distanza</span><strong>'+t.km+' km</strong></div>';
        statsRows += '<div class="ig-td__stat-row"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/></svg><span>Difficoltà</span><strong><span class="ig-trail-card__diff" style="background:'+diffColors[t.difficulty]+'">'+t.difficulty+'</span></strong></div>';
        if (t.elevation > 0) statsRows += '<div class="ig-td__stat-row"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 17 9 11 13 15 21 7"/></svg><span>Salita</span><strong>+'+t.elevation+' m</strong></div>';
        if (t.descent > 0) statsRows += '<div class="ig-td__stat-row"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 7 9 13 13 9 21 17"/></svg><span>Discesa</span><strong>-'+t.descent+' m</strong></div>';
        if (t.hours !== '—') statsRows += '<div class="ig-td__stat-row"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><span>Durata</span><strong>'+t.hours+'</strong></div>';

        var tagsHtml = '';
        t.tags.forEach(function(tag) {
            if (tagLabels[tag]) tagsHtml += '<span class="ig-trail-card__tag">' + tagLabels[tag] + '</span>';
        });

        detailBody.innerHTML =
            '<span class="ig-trail-card__type" style="color:'+color+';font-size:12px">'+typeLabels[t.type]+'</span>' +
            '<h2 class="ig-td__title">'+t.name+'</h2>' +
            '<p class="ig-td__zone"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg> '+t.zone+'</p>' +
            '<div class="ig-td__stats">'+statsRows+'</div>' +
            (tagsHtml ? '<div class="ig-trail-card__tags" style="margin:16px 0">'+tagsHtml+'</div>' : '') +
            '<div class="ig-td__desc">'+t.desc+'</div>' +
            '<div class="ig-td__actions" style="display:flex;flex-direction:column;gap:10px;margin-top:20px">' +
            '<a href="https://www.google.com/maps/dir/?api=1&destination='+t.lat+','+t.lng+'" target="_blank" rel="noopener" class="ig-btn ig-btn--primary ig-btn--lg" style="width:100%;justify-content:center">' +
            '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg> Come arrivare</a>' +
            (t.oaId ? '<a href="https://www.outdooractive.com/it/route/' + t.oaId + '" target="_blank" rel="noopener" class="ig-btn ig-btn--outline ig-btn--lg" style="width:100%;justify-content:center">' +
            '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg> Vedi su OutdoorActive</a>' : '') +
            '</div>';

        // Mostra pannello
        detailEl.classList.add('is-open');
        document.body.style.overflow = 'hidden';

        // Mappa: OutdoorActive embed (percorso + profilo altimetrico) o Leaflet fallback
        setTimeout(function() {
            if (detailMap) { detailMap.remove(); detailMap = null; }
            detailMapEl.innerHTML = '';

            if (t.oaId) {
                // OutdoorActive iframe — mostra percorso su mappa topografica + profilo altimetrico
                var iframe = document.createElement('iframe');
                iframe.src = 'https://www.outdooractive.com/it/embed/' + t.oaId + '/iframe?mw=false_metric';
                iframe.setAttribute('allowfullscreen', '');
                detailMapEl.appendChild(iframe);
            } else {
                // Fallback Leaflet per itinerari senza ID OutdoorActive
                detailMap = L.map(detailMapEl, { zoomControl: true, scrollWheelZoom: false, dragging: true }).setView([t.lat, t.lng], 14);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', { maxZoom: 17 }).addTo(detailMap);
                var mIcon = L.divIcon({
                    className: 'ig-trail-marker ig-trail-marker--lg',
                    html: '<div style="background:'+color+'"><span>'+t.id+'</span></div>',
                    iconSize: [40,40], iconAnchor: [20,40]
                });
                detailMarker = L.marker([t.lat, t.lng], { icon: mIcon }).addTo(detailMap);
            }
        }, 100);
    }

    function closeDetail() {
        detailEl.classList.remove('is-open');
        document.body.style.overflow = '';
        if (detailMap) { detailMap.remove(); detailMap = null; }
    }
    document.getElementById('igTrailDetailClose').addEventListener('click', closeDetail);
    document.getElementById('igTrailDetailX').addEventListener('click', closeDetail);
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeDetail(); });
});
</script>

<?php endif; ?>

<!-- CTA -->
<section class="ig-apple-section ig-apple-section--cta">
    <div class="ig-apple-container ig-text-center">
        <h2 class="ig-apple-title ig-apple-title--white">Non trovi quello che cerchi?</h2>
        <p class="ig-apple-subtitle ig-apple-subtitle--white">Il nostro assistente AI conosce ogni angolo del Lago di Garda e può aiutarti a trovare l'esperienza perfetta.</p>
        <button class="ig-btn ig-btn--glass-outline ig-btn--lg" style="margin-top:var(--sp-lg)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Chiedi a Garda AI
        </button>
    </div>
</section>

<!-- Filtro JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var btns = document.querySelectorAll('.ig-exp-filters__btn');
    var items = document.querySelectorAll('.ig-exp-item[data-localita]');
    btns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var f = btn.getAttribute('data-filter');
            btns.forEach(function(b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            items.forEach(function(item) {
                if (f === 'tutti' || item.getAttribute('data-localita') === f) {
                    item.classList.remove('is-hidden');
                } else {
                    item.classList.add('is-hidden');
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>
