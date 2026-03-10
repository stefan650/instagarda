<?php
/**
 * Archive: Eventi
 */
get_header();

// Mese corrente per filtro default
$mese_corrente = date('Y-m');
$filtro_tempo = isset($_GET['periodo']) ? sanitize_text_field($_GET['periodo']) : 'prossimi';
?>

<!-- Hero -->
<section class="ig-dest-hero ig-dest-hero--short">
    <div class="ig-dest-hero__bg">
        <div class="ig-placeholder-img" style="background:linear-gradient(135deg, #EC4899, #8B5CF6)">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.3)" stroke-width="1"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <span class="ig-dest-hero__badge">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Lago di Garda
            </span>
            <h1 class="ig-dest-hero__title">Eventi</h1>
        </div>
    </div>
</section>

<!-- Intro -->
<section class="ig-apple-section ig-apple-section--intro ig-reveal">
    <div class="ig-apple-container">
        <div class="ig-apple-intro">
            <p>Sagre, concerti, regate, mercatini, mostre e festival: il Lago di Garda è vivo tutto l'anno con eventi che celebrano la cultura, la tradizione e lo sport.</p>
        </div>
    </div>
</section>

<!-- Filtri -->
<section class="ig-apple-section ig-apple-section--white" style="padding-top:0">
    <div class="ig-apple-container">
        <!-- Filtro periodo -->
        <div class="ig-exp-filters" id="igEvtFiltriTempo">
            <button class="ig-exp-filters__btn <?php echo $filtro_tempo === 'prossimi' ? 'is-active' : ''; ?>" data-periodo="prossimi">Prossimi</button>
            <button class="ig-exp-filters__btn <?php echo $filtro_tempo === 'questo-mese' ? 'is-active' : ''; ?>" data-periodo="questo-mese">Questo mese</button>
            <button class="ig-exp-filters__btn <?php echo $filtro_tempo === 'tutti' ? 'is-active' : ''; ?>" data-periodo="tutti">Tutti</button>
        </div>
        <!-- Filtro tipo -->
        <div class="ig-exp-filters" id="igEvtFiltriTipo" style="margin-top:-8px">
            <button class="ig-exp-filters__btn is-active" data-tipo="tutti">Tutti i tipi</button>
            <?php
            $tipi = get_terms(['taxonomy' => 'tipo_evento', 'hide_empty' => true]);
            if ($tipi && !is_wp_error($tipi)):
                foreach ($tipi as $tipo):
            ?>
            <button class="ig-exp-filters__btn" data-tipo="<?php echo esc_attr($tipo->slug); ?>"><?php echo esc_html($tipo->name); ?></button>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<!-- Listing eventi -->
<section class="ig-apple-section ig-apple-section--light" style="padding-top:var(--sp-lg)">
    <div class="ig-apple-container">
        <?php
        $today = date('Y-m-d');
        $meta_query = [];

        if ($filtro_tempo === 'prossimi') {
            $meta_query[] = [
                'relation' => 'OR',
                ['key' => '_ig_data_inizio', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
                ['key' => '_ig_data_fine', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'],
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
            'posts_per_page' => 30,
            'orderby'        => 'meta_value',
            'meta_key'       => '_ig_data_inizio',
            'order'          => 'ASC',
        ];
        if (!empty($meta_query)) {
            $args['meta_query'] = $meta_query;
        }

        $eventi = new WP_Query($args);

        if ($eventi->have_posts()):
        ?>
        <div class="ig-evt-listing" id="igEvtListing">
            <?php while ($eventi->have_posts()): $eventi->the_post();
                $data_inizio = get_post_meta(get_the_ID(), '_ig_data_inizio', true);
                $data_fine   = get_post_meta(get_the_ID(), '_ig_data_fine', true);
                $orario      = get_post_meta(get_the_ID(), '_ig_orario', true);
                $luogo       = get_post_meta(get_the_ID(), '_ig_luogo', true);
                $prezzo      = get_post_meta(get_the_ID(), '_ig_prezzo_evento', true);
                $loc         = get_the_terms(get_the_ID(), 'localita');
                $loc_name    = ($loc && !is_wp_error($loc)) ? $loc[0]->name : '';
                $tipo_evt    = get_the_terms(get_the_ID(), 'tipo_evento');
                $tipo_slug   = ($tipo_evt && !is_wp_error($tipo_evt)) ? $tipo_evt[0]->slug : '';
                $tipo_name   = ($tipo_evt && !is_wp_error($tipo_evt)) ? $tipo_evt[0]->name : '';

                // Formattazione date
                $data_display = '';
                if ($data_inizio) {
                    $dt = DateTime::createFromFormat('Y-m-d', $data_inizio);
                    $mesi = ['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'];
                    if ($dt) {
                        $giorno = $dt->format('j');
                        $mese = $mesi[(int)$dt->format('n') - 1];
                        $data_display = $giorno . ' ' . $mese;
                        if ($data_fine && $data_fine !== $data_inizio) {
                            $dt2 = DateTime::createFromFormat('Y-m-d', $data_fine);
                            if ($dt2) {
                                $data_display .= ' — ' . $dt2->format('j') . ' ' . $mesi[(int)$dt2->format('n') - 1];
                            }
                        }
                    }
                }
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-evt-card" data-tipo="<?php echo esc_attr($tipo_slug); ?>">
                <div class="ig-evt-card__date-col">
                    <?php if ($data_inizio):
                        $dt = DateTime::createFromFormat('Y-m-d', $data_inizio);
                        if ($dt): ?>
                    <span class="ig-evt-card__day"><?php echo $dt->format('j'); ?></span>
                    <span class="ig-evt-card__month"><?php echo $mesi[(int)$dt->format('n') - 1]; ?></span>
                    <?php endif; endif; ?>
                </div>
                <div class="ig-evt-card__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card-wide');
                    else: ?>
                        <div class="ig-placeholder-img">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                    <?php endif; ?>
                    <?php if ($tipo_name): ?>
                        <span class="ig-evt-card__type-badge"><?php echo esc_html($tipo_name); ?></span>
                    <?php endif; ?>
                </div>
                <div class="ig-evt-card__body">
                    <h3 class="ig-evt-card__title"><?php the_title(); ?></h3>
                    <div class="ig-evt-card__meta">
                        <?php if ($data_display): ?>
                        <span class="ig-evt-card__meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <?php echo esc_html($data_display); ?>
                        </span>
                        <?php endif; ?>
                        <?php if ($orario): ?>
                        <span class="ig-evt-card__meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <?php echo esc_html($orario); ?>
                        </span>
                        <?php endif; ?>
                        <?php if ($loc_name || $luogo): ?>
                        <span class="ig-evt-card__meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <?php echo esc_html($luogo ?: $loc_name); ?>
                        </span>
                        <?php endif; ?>
                        <?php if ($prezzo): ?>
                        <span class="ig-evt-card__meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                            <?php echo esc_html($prezzo); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php if (has_excerpt()): ?>
                    <p class="ig-evt-card__desc"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <div class="ig-text-center" style="padding:var(--sp-3xl) 0">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--ig-text-muted)" stroke-width="1" style="opacity:.4;margin-bottom:var(--sp-lg)"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <p style="font-size:var(--fs-lg);color:var(--ig-text-muted)">Nessun evento in programma al momento.</p>
            <p style="font-size:var(--fs-base);color:var(--ig-text-muted);margin-top:8px">Stiamo aggiornando il calendario — torna presto!</p>
            <button class="ig-btn ig-btn--primary ig-btn--lg" style="margin-top:var(--sp-xl)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Chiedi a Garda AI
            </button>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA -->
<section class="ig-apple-section ig-apple-section--cta">
    <div class="ig-apple-container ig-text-center">
        <h2 class="ig-apple-title ig-apple-title--white">Vuoi organizzare una giornata?</h2>
        <p class="ig-apple-subtitle ig-apple-subtitle--white">Il nostro assistente AI può suggerirti gli eventi migliori in base ai tuoi interessi e alle date del tuo soggiorno.</p>
        <button class="ig-btn ig-btn--glass-outline ig-btn--lg" style="margin-top:var(--sp-lg)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Chiedi a Garda AI
        </button>
    </div>
</section>

<!-- Filtro JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtro periodo (reload pagina)
    var tempoBtns = document.querySelectorAll('#igEvtFiltriTempo .ig-exp-filters__btn');
    tempoBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var periodo = btn.getAttribute('data-periodo');
            var url = new URL(window.location.href);
            url.searchParams.set('periodo', periodo);
            window.location.href = url.toString();
        });
    });

    // Filtro tipo (client-side)
    var tipoBtns = document.querySelectorAll('#igEvtFiltriTipo .ig-exp-filters__btn');
    var cards = document.querySelectorAll('.ig-evt-card[data-tipo]');
    tipoBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var f = btn.getAttribute('data-tipo');
            tipoBtns.forEach(function(b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            cards.forEach(function(card) {
                if (f === 'tutti' || card.getAttribute('data-tipo') === f) {
                    card.classList.remove('is-hidden');
                } else {
                    card.classList.add('is-hidden');
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>
