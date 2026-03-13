<?php
/**
 * Single: Evento
 */
get_header();

while (have_posts()): the_post();

$data_inizio = get_post_meta(get_the_ID(), '_ig_data_inizio', true);
$data_fine   = get_post_meta(get_the_ID(), '_ig_data_fine', true);
$orario      = get_post_meta(get_the_ID(), '_ig_orario', true);
$luogo       = get_post_meta(get_the_ID(), '_ig_luogo', true);
$prezzo      = get_post_meta(get_the_ID(), '_ig_prezzo_evento', true);
$link_ext    = get_post_meta(get_the_ID(), '_ig_link_esterno', true);
$loc         = get_the_terms(get_the_ID(), 'localita');
$loc_name    = ($loc && !is_wp_error($loc)) ? $loc[0]->name : '';
$tipo_evt    = get_the_terms(get_the_ID(), 'tipo_evento');
$tipo_name   = ($tipo_evt && !is_wp_error($tipo_evt)) ? $tipo_evt[0]->name : '';

// Formattazione date italiane
$mesi_full = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
$giorni = ['Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato'];
$data_display = '';
$data_short = '';
if ($data_inizio) {
    $dt = DateTime::createFromFormat('Y-m-d', $data_inizio);
    if ($dt) {
        $data_display = $giorni[(int)$dt->format('w')] . ' ' . $dt->format('j') . ' ' . $mesi_full[(int)$dt->format('n') - 1] . ' ' . $dt->format('Y');
        $data_short = $dt->format('j') . ' ' . $mesi_full[(int)$dt->format('n') - 1];
        if ($data_fine && $data_fine !== $data_inizio) {
            $dt2 = DateTime::createFromFormat('Y-m-d', $data_fine);
            if ($dt2) {
                $data_display .= ' — ' . $giorni[(int)$dt2->format('w')] . ' ' . $dt2->format('j') . ' ' . $mesi_full[(int)$dt2->format('n') - 1] . ' ' . $dt2->format('Y');
                $data_short .= ' — ' . $dt2->format('j') . ' ' . $mesi_full[(int)$dt2->format('n') - 1];
            }
        }
    }
}

// Determina se evento passato
$is_passato = false;
$check_date = $data_fine ?: $data_inizio;
if ($check_date && $check_date < date('Y-m-d')) {
    $is_passato = true;
}
?>

<!-- Hero -->
<section class="ig-dest-hero">
    <div class="ig-dest-hero__bg">
        <?php if (has_post_thumbnail()):
            the_post_thumbnail('hero');
        else: ?>
            <div class="ig-placeholder-img" style="background:linear-gradient(135deg, #EC4899, #8B5CF6)">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.3)" stroke-width="1"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
        <?php endif; ?>
    </div>
    <div class="ig-dest-hero__content">
        <div class="ig-container">
            <span class="ig-dest-hero__badge">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <?php echo $tipo_name ? esc_html($tipo_name) : 'Evento'; ?>
            </span>
            <h1 class="ig-dest-hero__title"><?php the_title(); ?></h1>
            <?php if ($data_short): ?>
            <p style="color:rgba(255,255,255,.85);font-size:1.125rem;margin-top:8px"><?php echo esc_html($data_short); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Info Strip -->
<section class="ig-info-strip">
    <div class="ig-container">
        <div class="ig-info-strip__inner">
            <?php if ($data_display): ?>
            <div class="ig-info-strip__item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <div>
                    <small>Quando</small>
                    <strong><?php echo esc_html($data_display); ?></strong>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($orario): ?>
            <div class="ig-info-strip__item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <div>
                    <small>Orario</small>
                    <strong><?php echo esc_html($orario); ?></strong>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($luogo || $loc_name): ?>
            <a class="ig-info-strip__item ig-info-strip__item--link" href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode(($luogo ?: $loc_name) . ' Lago di Garda'); ?>" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <div>
                    <small>Dove</small>
                    <strong><?php echo esc_html($luogo ?: $loc_name); ?></strong>
                </div>
            </a>
            <?php endif; ?>
            <?php if ($prezzo): ?>
            <div class="ig-info-strip__item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                <div>
                    <small>Prezzo</small>
                    <strong><?php echo esc_html($prezzo); ?></strong>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if ($is_passato): ?>
<section class="ig-apple-section ig-apple-section--white" style="padding:var(--sp-lg) 0 0">
    <div class="ig-apple-container">
        <div class="ig-evt-past-banner">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Questo evento si è già svolto
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Contenuto -->
<section class="ig-apple-section ig-apple-section--white">
    <div class="ig-apple-container">
        <div class="ig-apple-body">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<!-- Azioni -->
<?php if ($link_ext || !$is_passato): ?>
<section class="ig-apple-section ig-apple-section--light" style="padding:var(--sp-xl) 0">
    <div class="ig-apple-container">
        <div class="ig-evt-actions">
            <?php if ($link_ext): ?>
            <a href="<?php echo esc_url($link_ext); ?>" class="ig-btn ig-btn--primary ig-btn--lg" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Sito ufficiale / Biglietti
            </a>
            <?php endif; ?>
            <?php if ($luogo || $loc_name): ?>
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo urlencode(($luogo ?: $loc_name) . ' Lago di Garda'); ?>" class="ig-btn ig-btn--outline ig-btn--lg" target="_blank" rel="noopener">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                Come arrivare
            </a>
            <?php endif; ?>
            <button class="ig-btn ig-btn--outline ig-btn--lg" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Chiedi info a Garda Concierge
            </button>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Eventi correlati -->
<?php
$related_args = [
    'post_type'      => 'evento',
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'meta_key'       => '_ig_data_inizio',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    'meta_query'     => [
        [
            'relation' => 'OR',
            ['key' => '_ig_data_inizio', 'value' => date('Y-m-d'), 'compare' => '>=', 'type' => 'DATE'],
            ['key' => '_ig_data_fine', 'value' => date('Y-m-d'), 'compare' => '>=', 'type' => 'DATE'],
        ],
    ],
];

// Se ha località, prova prima eventi nella stessa zona
if ($loc && !is_wp_error($loc)) {
    $related_args['tax_query'] = [[
        'taxonomy' => 'localita',
        'field'    => 'term_id',
        'terms'    => $loc[0]->term_id,
    ]];
}

$related = new WP_Query($related_args);

// Se non abbastanza risultati con la stessa località, riprova senza filtro
if ($related->found_posts < 2) {
    unset($related_args['tax_query']);
    $related = new WP_Query($related_args);
}

if ($related->have_posts()):
$mesi_short = ['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'];
?>
<section class="ig-apple-section ig-apple-section--light ig-reveal">
    <div class="ig-apple-container">
        <h2 class="ig-apple-title">Prossimi eventi</h2>
        <div class="ig-exp-listing" style="margin-top:var(--sp-xl)">
            <?php while ($related->have_posts()): $related->the_post();
                $r_data = get_post_meta(get_the_ID(), '_ig_data_inizio', true);
                $r_luogo = get_post_meta(get_the_ID(), '_ig_luogo', true);
                $r_loc = get_the_terms(get_the_ID(), 'localita');
                $r_loc_name = ($r_loc && !is_wp_error($r_loc)) ? $r_loc[0]->name : '';
                $r_tipo = get_the_terms(get_the_ID(), 'tipo_evento');
                $r_tipo_name = ($r_tipo && !is_wp_error($r_tipo)) ? $r_tipo[0]->name : '';
                $r_date_display = '';
                if ($r_data) {
                    $rdt = DateTime::createFromFormat('Y-m-d', $r_data);
                    if ($rdt) $r_date_display = $rdt->format('j') . ' ' . $mesi_short[(int)$rdt->format('n') - 1];
                }
            ?>
            <a href="<?php the_permalink(); ?>" class="ig-exp-item">
                <div class="ig-exp-item__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card-wide');
                    else: ?>
                        <div class="ig-placeholder-img">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                    <?php endif; ?>
                    <?php if ($r_tipo_name): ?>
                        <span class="ig-exp-item__badge"><?php echo esc_html($r_tipo_name); ?></span>
                    <?php endif; ?>
                </div>
                <div class="ig-exp-item__body">
                    <h3 class="ig-exp-item__title"><?php the_title(); ?></h3>
                    <?php if ($r_date_display): ?>
                    <p class="ig-exp-item__loc">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <?php echo esc_html($r_date_display); ?>
                        <?php if ($r_loc_name || $r_luogo): ?> · <?php echo esc_html($r_luogo ?: $r_loc_name); ?><?php endif; ?>
                    </p>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="ig-text-center" style="margin-top:var(--sp-xl)">
            <a href="<?php echo esc_url(home_url('/eventi/')); ?>" class="ig-btn ig-btn--outline">Tutti gli eventi</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="ig-apple-section ig-apple-section--cta">
    <div class="ig-apple-container ig-text-center">
        <h2 class="ig-apple-title ig-apple-title--white">Scopri cosa fare al Garda</h2>
        <p class="ig-apple-subtitle ig-apple-subtitle--white">Il nostro assistente AI ti aiuta a trovare eventi, attività e ristoranti per la tua giornata perfetta.</p>
        <button class="ig-btn ig-btn--glass-outline ig-btn--lg" style="margin-top:var(--sp-lg)" onclick="window.toggleGardaChat && window.toggleGardaChat()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            Chiedi a Garda Concierge
        </button>
    </div>
</section>

<?php endwhile; get_footer(); ?>
