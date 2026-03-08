<?php get_header(); ?>

<?php
$categorie = [
    [
        'name' => 'Sport Acquatici',
        'desc' => 'Windsurf, vela, SUP, kayak e molto altro sulle acque del Garda.',
        'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 12h20"/><path d="M2 16c1.5-1.5 3-2 4.5-2s3 .5 4.5 2c1.5-1.5 3-2 4.5-2s3 .5 4.5 2"/><path d="M12 2l-3 10h6L12 2z"/></svg>',
        'color' => '#0077B6',
    ],
    [
        'name' => 'Sentieri e Trekking',
        'desc' => 'Percorsi panoramici tra lago e montagna per tutti i livelli.',
        'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 20l5-7 4 4 5-8 4 5"/><circle cx="12" cy="4" r="2"/></svg>',
        'color' => '#2D6A4F',
    ],
    [
        'name' => 'Mountain Bike & Ciclismo',
        'desc' => 'Piste ciclabili sul lago e trail in mountain bike sul Monte Baldo.',
        'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="18.5" cy="17.5" r="3.5"/><path d="M15 6a1 1 0 100-2 1 1 0 000 2zm-3 11.5V14l-3-3 4-3 2 3h3"/></svg>',
        'color' => '#E76F51',
    ],
    [
        'name' => 'Arrampicata',
        'desc' => 'Falesie e vie ferrate ad Arco, capitale mondiale del climbing.',
        'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 21l4-9 4 4 4-8 4 6"/><circle cx="16" cy="4" r="2"/></svg>',
        'color' => '#9B2226',
    ],
    [
        'name' => 'Parapendio',
        'desc' => 'Volo libero dal Monte Baldo con atterraggio sul lago.',
        'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 2L2 10l10 2 2 10L22 2z"/></svg>',
        'color' => '#7209B7',
    ],
    [
        'name' => 'Tour in Barca',
        'desc' => 'Escursioni in barca a vela, motoscafo e battello sul lago.',
        'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 20c1.5-1.5 3-2 4.5-2s3 .5 4.5 2c1.5-1.5 3-2 4.5-2s3 .5 4.5 2"/><path d="M4 16l8-14 8 14"/><path d="M12 2v14"/></svg>',
        'color' => '#219EBC',
    ],
    [
        'name' => 'Terme e Benessere',
        'desc' => 'Spa, terme naturali e centri benessere per il relax totale.',
        'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22c4.97 0 9-2.69 9-6v-2c0-3.31-4.03-6-9-6s-9 2.69-9 6v2c0 3.31 4.03 6 9 6z"/><path d="M8 4c0 0 .5 2 4 2s4-2 4-2"/><path d="M7 2c0 0 1 3 5 3s5-3 5-3"/></svg>',
        'color' => '#D4A373',
    ],
    [
        'name' => 'Canyoning e Avventura',
        'desc' => 'Discese in forra, zipline e parchi avventura tra le valli.',
        'icon' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5 0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5c0 .83-.67 1.5-1.5 1.5z"/><path d="M20 4L8.5 15.5 4 20"/><path d="M15 4l5 0 0 5"/></svg>',
        'color' => '#F77F00',
    ],
];
?>

<!-- Hero -->
<section class="ig-mini-hero ig-mini-hero--attivita">
    <div class="ig-mini-hero__content">
        <div class="ig-mini-hero__badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
            <?php echo count($categorie); ?> categorie
        </div>
        <h1 class="ig-mini-hero__title">Attività & <span>Tour</span></h1>
        <p class="ig-mini-hero__desc">Scopri tutte le esperienze che il Lago di Garda ha da offrire</p>
    </div>
</section>

<!-- Categorie Grid -->
<section class="ig-section ig-section--white">
    <div class="ig-container">
        <div class="ig-cat-grid">
            <?php foreach ($categorie as $cat): ?>
            <a href="#" class="ig-cat-card" style="--cat-color: <?php echo $cat['color']; ?>">
                <div class="ig-cat-card__icon">
                    <?php echo $cat['icon']; ?>
                </div>
                <div class="ig-cat-card__body">
                    <h3 class="ig-cat-card__title"><?php echo esc_html($cat['name']); ?></h3>
                    <p class="ig-cat-card__desc"><?php echo esc_html($cat['desc']); ?></p>
                </div>
                <div class="ig-cat-card__arrow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="ig-section ig-section--light">
    <div class="ig-container ig-text-center" style="max-width:500px">
        <div class="ig-dest-sidebar__card" style="position:static">
            <h3>Non sai cosa fare?</h3>
            <p style="color:var(--ig-text-muted);margin-bottom:var(--sp-lg)">Chiedi al nostro assistente AI — conosce tutte le attività del Lago di Garda!</p>
            <button class="ig-btn ig-btn--primary ig-btn--lg" style="width:100%" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Chiedi a Garda AI
            </button>
        </div>
    </div>
</section>

<?php get_footer(); ?>
