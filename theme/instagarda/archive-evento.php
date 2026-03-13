<?php
/**
 * Archive: Eventi
 */
get_header();

$filtro_tempo = isset($_GET['periodo']) ? sanitize_text_field($_GET['periodo']) : 'prossimi';
$filtro_search = isset($_GET['s_evt']) ? sanitize_text_field($_GET['s_evt']) : '';
$filtro_loc = isset($_GET['loc']) ? sanitize_text_field($_GET['loc']) : '';
$today = date('Y-m-d');

// Query eventi
$meta_query = [];
if ($filtro_tempo === 'prossimi' || $filtro_tempo === '') {
    $meta_query[] = [
        'relation' => 'OR',
        ['key' => '_ig_data_inizio', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
        ['key' => '_ig_data_fine', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
    ];
} elseif ($filtro_tempo === 'oggi') {
    $meta_query[] = [
        'relation' => 'OR',
        [
            'relation' => 'AND',
            ['key' => '_ig_data_inizio', 'value' => $today, 'compare' => '<=', 'type' => 'DATE'],
            ['key' => '_ig_data_fine', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
        ],
        ['key' => '_ig_data_inizio', 'value' => $today, 'compare' => '=', 'type' => 'DATE'],
    ];
} elseif ($filtro_tempo === 'questa-settimana') {
    $dow = date('N'); // 1=lun, 7=dom
    $lunedi = date('Y-m-d', strtotime('-' . ($dow - 1) . ' days'));
    $domenica = date('Y-m-d', strtotime('+' . (7 - $dow) . ' days'));
    $meta_query[] = [
        'relation' => 'OR',
        [
            'relation' => 'AND',
            ['key' => '_ig_data_inizio', 'value' => $domenica, 'compare' => '<=', 'type' => 'DATE'],
            ['key' => '_ig_data_fine', 'value' => $lunedi, 'compare' => '>=', 'type' => 'DATE'],
        ],
        [
            'relation' => 'AND',
            ['key' => '_ig_data_inizio', 'value' => $lunedi, 'compare' => '>=', 'type' => 'DATE'],
            ['key' => '_ig_data_inizio', 'value' => $domenica, 'compare' => '<=', 'type' => 'DATE'],
        ],
    ];
} elseif ($filtro_tempo === 'questo-mese') {
    $fine_mese = date('Y-m-t');
    $meta_query[] = [
        'relation' => 'OR',
        [
            'relation' => 'AND',
            ['key' => '_ig_data_inizio', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
            ['key' => '_ig_data_inizio', 'value' => $fine_mese, 'compare' => '<=', 'type' => 'DATE'],
        ],
        [
            'relation' => 'AND',
            ['key' => '_ig_data_fine', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
            ['key' => '_ig_data_fine', 'value' => $fine_mese, 'compare' => '<=', 'type' => 'DATE'],
        ],
    ];
}

$args = [
    'post_type'      => 'evento',
    'posts_per_page' => 60,
    'orderby'        => 'meta_value',
    'meta_key'       => '_ig_data_inizio',
    'order'          => 'ASC',
];
if (!empty($meta_query)) {
    $args['meta_query'] = $meta_query;
}
if ($filtro_search) {
    $args['s'] = $filtro_search;
}
if ($filtro_loc) {
    $args['tax_query'] = [
        ['taxonomy' => 'localita', 'field' => 'slug', 'terms' => $filtro_loc],
    ];
}

$eventi = new WP_Query($args);
$mesi = ['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'];
$mesi_full = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];

// Raccogli tipi evento
$tipi = get_terms(['taxonomy' => 'tipo_evento', 'hide_empty' => true]);
$tipi_list = ($tipi && !is_wp_error($tipi)) ? $tipi : [];

// Raccogli località
$localita = get_terms(['taxonomy' => 'localita', 'hide_empty' => true, 'orderby' => 'name']);
$loc_list = ($localita && !is_wp_error($localita)) ? $localita : [];
?>

<!-- Hero -->
<section class="ig-evt-hero">
    <div class="ig-evt-hero__bg">
        <div class="ig-evt-hero__gradient"></div>
    </div>
    <div class="ig-evt-hero__content">
        <div class="ig-container">
            <h1 class="ig-evt-hero__title">Il lago prende vita</h1>

            <!-- Filtro per località -->
            <nav class="ig-evt-hero-filters" aria-label="Filtra per località">
                <a href="<?php echo esc_url(remove_query_arg('loc')); ?>" class="ig-evt-hero-pill <?php echo !$filtro_loc ? 'is-active' : ''; ?>" <?php echo !$filtro_loc ? 'aria-current="true"' : ''; ?>>Tutto il lago</a>
                <?php foreach ($loc_list as $loc_item): ?>
                <a href="<?php echo esc_url(add_query_arg('loc', $loc_item->slug)); ?>" class="ig-evt-hero-pill <?php echo $filtro_loc === $loc_item->slug ? 'is-active' : ''; ?>" <?php echo $filtro_loc === $loc_item->slug ? 'aria-current="true"' : ''; ?>><?php echo esc_html($loc_item->name); ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
    </div>
</section>

<!-- Filtri + Ricerca -->
<section class="ig-evt-filters-section">
    <div class="ig-container">
        <!-- Filtri periodo -->
        <div class="ig-evt-quick">
            <a href="?periodo=oggi" class="ig-evt-quick__btn <?php echo $filtro_tempo === 'oggi' ? 'is-active' : ''; ?>">Oggi</a>
            <a href="?periodo=questa-settimana" class="ig-evt-quick__btn <?php echo $filtro_tempo === 'questa-settimana' ? 'is-active' : ''; ?>">Questa settimana</a>
            <a href="?periodo=questo-mese" class="ig-evt-quick__btn <?php echo $filtro_tempo === 'questo-mese' ? 'is-active' : ''; ?>">Questo mese</a>
            <a href="?periodo=prossimi" class="ig-evt-quick__btn <?php echo $filtro_tempo === 'prossimi' ? 'is-active' : ''; ?>">Prossimamente</a>
            <a href="?periodo=tutti" class="ig-evt-quick__btn <?php echo $filtro_tempo === 'tutti' ? 'is-active' : ''; ?>">Tutti</a>
        </div>

        <!-- Filtro tipo + Search -->
        <div class="ig-evt-toolbar">
            <?php if ($tipi_list): ?>
            <div class="ig-evt-cats" id="igEvtCats">
                <button class="ig-evt-cats__btn is-active" data-tipo="tutti">Tutto</button>
                <?php foreach ($tipi_list as $tipo): ?>
                <button class="ig-evt-cats__btn" data-tipo="<?php echo esc_attr($tipo->slug); ?>"><?php echo esc_html($tipo->name); ?></button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Griglia eventi 3 colonne -->
<section class="ig-evt-grid-section">
    <div class="ig-container">
        <?php if ($eventi->have_posts()): ?>
        <div class="ig-evt-grid" id="igEvtGrid">
            <?php while ($eventi->have_posts()): $eventi->the_post();
                $data_inizio = get_post_meta(get_the_ID(), '_ig_data_inizio', true);
                $data_fine   = get_post_meta(get_the_ID(), '_ig_data_fine', true);
                $luogo       = get_post_meta(get_the_ID(), '_ig_luogo', true);
                $loc         = get_the_terms(get_the_ID(), 'localita');
                $loc_name    = ($loc && !is_wp_error($loc)) ? $loc[0]->name : '';
                $tipo_evt    = get_the_terms(get_the_ID(), 'tipo_evento');
                $tipo_slug   = ($tipo_evt && !is_wp_error($tipo_evt)) ? $tipo_evt[0]->slug : '';

                // Date formattate
                $data_display = '';
                if ($data_inizio) {
                    $dt = DateTime::createFromFormat('Y-m-d', $data_inizio);
                    if ($dt) {
                        $data_display = $dt->format('d/m/Y');
                        if ($data_fine && $data_fine !== $data_inizio) {
                            $dt2 = DateTime::createFromFormat('Y-m-d', $data_fine);
                            if ($dt2) $data_display .= ' - ' . $dt2->format('d/m/Y');
                        }
                    }
                }
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-evt-tile" data-tipo="<?php echo esc_attr($tipo_slug); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                <div class="ig-evt-tile__img">
                    <?php if (has_post_thumbnail()):
                        the_post_thumbnail('medium_large', ['loading' => 'lazy', 'alt' => esc_attr(get_the_title())]);
                    else: ?>
                        <div class="ig-evt-tile__placeholder">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="ig-evt-tile__body">
                    <?php if ($loc_name): ?>
                    <span class="ig-evt-tile__location">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <?php echo esc_html($loc_name); ?>
                    </span>
                    <?php endif; ?>
                    <h3 class="ig-evt-tile__title"><?php the_title(); ?></h3>
                    <?php if ($data_display): ?>
                    <span class="ig-evt-tile__date"><?php echo esc_html($data_display); ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <div class="ig-evt-empty" role="status">
            <div class="ig-evt-empty__icon" aria-hidden="true">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <p class="ig-evt-empty__title">Nessun evento trovato</p>
            <p class="ig-evt-empty__sub">Non ci sono eventi per i filtri selezionati. Prova a cambiare il periodo o la località.</p>
            <a href="?periodo=prossimi" class="ig-btn ig-btn--primary" style="margin-top:var(--sp-md)">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/></svg>
                Vedi prossimi eventi
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA -->
<section class="ig-apple-section ig-apple-section--cta">
    <div class="ig-apple-container ig-text-center">
        <h2 class="ig-apple-title ig-apple-title--white">Vuoi organizzare una giornata?</h2>
        <p class="ig-apple-subtitle ig-apple-subtitle--white">Il nostro assistente AI può suggerirti gli eventi migliori in base ai tuoi interessi.</p>
        <button class="ig-btn ig-btn--glass-outline ig-btn--lg" style="margin-top:var(--sp-lg)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Chiedi a Garda Concierge
        </button>
    </div>
</section>

<!-- Filtro JS client-side per tipo -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var catBtns = document.querySelectorAll('#igEvtCats .ig-evt-cats__btn');
    var tiles = document.querySelectorAll('.ig-evt-tile[data-tipo]');

    catBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var f = btn.getAttribute('data-tipo');
            catBtns.forEach(function(b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            tiles.forEach(function(tile) {
                if (f === 'tutti' || tile.getAttribute('data-tipo') === f) {
                    tile.style.display = '';
                } else {
                    tile.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>
