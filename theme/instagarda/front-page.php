<?php get_header(); ?>

<?php
// ============================================================
// SECTION 1: HERO
// ============================================================
?>
<section class="ig-hero">
    <div class="ig-hero__bg">
        <video class="ig-hero__video" autoplay muted loop playsinline preload="auto">
            <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/hero.mp4'); ?>" type="video/mp4">
        </video>
    </div>

    <div class="ig-hero__content">
        <h1 class="ig-hero__title">
            Il Lago di Garda<br>
            <span>come non l'hai mai visto</span>
        </h1>

        <!-- CTA Buttons -->
        <div class="ig-hero__ctas">
            <button class="ig-hero__cta ig-hero__cta--active" data-tab="destinazioni" role="tab" aria-selected="true">Destinazioni</button>
            <button class="ig-hero__cta" data-tab="vivi" role="tab" aria-selected="false">Esperienze</button>
        </div>

        <!-- Dynamic Suggestion Pills -->
        <div class="ig-hero__suggestions" id="igHeroSuggestions">
            <div class="ig-hero__suggestion-group is-active" data-group="destinazioni">
                <?php
                $hero_dests = new WP_Query([
                    'post_type'      => 'destinazione',
                    'posts_per_page' => 6,
                    'orderby'        => 'rand',
                ]);
                if ($hero_dests->have_posts()):
                    while ($hero_dests->have_posts()): $hero_dests->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="ig-hero__pill"><?php the_title(); ?></a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                <a href="<?php echo esc_url(get_post_type_archive_link('destinazione')); ?>" class="ig-hero__pill ig-hero__pill--all">Vedi tutte →</a>
            </div>
            <div class="ig-hero__suggestion-group" data-group="vivi">
                <a href="<?php echo esc_url(home_url('/esperienze/attivita/')); ?>" class="ig-hero__pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                    Attività & Tour
                </a>
                <a href="<?php echo esc_url(home_url('/esperienze/cultura/')); ?>" class="ig-hero__pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="22" x2="21" y2="22"/><line x1="6" y1="18" x2="6" y2="11"/><line x1="10" y1="18" x2="10" y2="11"/><line x1="14" y1="18" x2="14" y2="11"/><line x1="18" y1="18" x2="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>
                    Cultura & Musei
                </a>
                <a href="<?php echo esc_url(home_url('/eventi/')); ?>" class="ig-hero__pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Eventi
                </a>
                <a href="<?php echo esc_url(home_url('/esperienze/ristoranti/')); ?>" class="ig-hero__pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 002-2V2"/><path d="M7 2v20"/><path d="M21 15V2a5 5 0 00-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"/></svg>
                    Ristoranti
                </a>
                <a href="<?php echo esc_url(home_url('/esperienze/soggiorni/')); ?>" class="ig-hero__pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
                    Soggiorni
                </a>
                <a href="<?php echo esc_url(home_url('/esperienze/bar-nightlife/')); ?>" class="ig-hero__pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 22h8"/><path d="M12 11v11"/><path d="M20 3H4l2 8h12l2-8z"/></svg>
                    Bar & Nightlife
                </a>
            </div>
        </div>
    </div>

</section>


<?php
// ============================================================
// SECTION 2: DESTINAZIONI
// ============================================================
?>
<section class="ig-section ig-section--destinazioni ig-section--fullbleed ig-reveal">

        <!-- Carousel -->
        <div class="ig-dest-carousel ig-dest-carousel--fullbleed" id="igDestCarousel">
            <div class="ig-dest-carousel__track" id="igDestTrack">
                <?php
                $dest_query = new WP_Query([
                    'post_type'      => 'destinazione',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ]);
                if ($dest_query->have_posts()):
                    while ($dest_query->have_posts()): $dest_query->the_post();
                        $subtitle = ig_get_meta('subtitle');
                        $regione  = ig_get_meta('regione');
                ?>
                <a href="<?php the_permalink(); ?>" class="ig-dest-card">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('card-portrait'); ?>
                    <?php else: ?>
                        <div class="ig-placeholder-img">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                    <?php endif; ?>
                    <h3 class="ig-dest-card__title"><?php the_title(); ?></h3>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    // Fallback destinations
                    $fallback_dests = [
                        'Sirmione', 'Riva del Garda', 'Malcesine', 'Limone sul Garda',
                        'Bardolino', 'Salò', 'Desenzano del Garda', 'Lazise',
                        'Gardone Riviera', 'Torri del Benaco', 'Peschiera del Garda', 'Gargnano',
                    ];
                    foreach ($fallback_dests as $fd):
                ?>
                <div class="ig-dest-card">
                    <div class="ig-placeholder-img">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3 class="ig-dest-card__title"><?php echo esc_html($fd); ?></h3>
                </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>

            <!-- Nav arrows -->
            <button class="ig-dest-carousel__btn ig-dest-carousel__btn--prev" id="igDestPrev" aria-label="Precedente">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <button class="ig-dest-carousel__btn ig-dest-carousel__btn--next" id="igDestNext" aria-label="Successivo">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 6 15 12 9 18"/></svg>
            </button>
        </div>

        <div class="ig-text-center" style="margin-top:var(--sp-lg)">
            <a href="<?php echo esc_url(get_post_type_archive_link('destinazione')); ?>" class="ig-btn ig-btn--outline ig-btn--sm">
                Scopri le destinazioni →
            </a>
        </div>

</section>


<?php
// ============================================================
// SECTION 3: BLOG
// ============================================================
?>
<section class="ig-section ig-section--blog ig-reveal">
    <div class="ig-container">

        <!-- Section Header -->
        <div class="ig-section__header">
            <span class="ig-section__badge">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
                Il Blog
            </span>
            <h2 class="ig-section__title">Storie dal Lago</h2>
        </div>

        <!-- Blog Carousel (Apple-style) -->
        <div class="ig-blog-carousel" id="igBlogCarousel">
            <div class="ig-blog-carousel__track" id="igBlogTrack">
                <?php
                $blog_posts = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 8,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);

                if ($blog_posts->have_posts()):
                    while ($blog_posts->have_posts()): $blog_posts->the_post();
                        $cats = get_the_category();
                ?>
                <a href="<?php the_permalink(); ?>" class="ig-blog-card">
                    <div class="ig-blog-card__body">
                        <?php if ($cats): ?>
                            <span class="ig-blog-card__cat"><?php echo esc_html($cats[0]->name); ?></span>
                        <?php endif; ?>
                        <h3 class="ig-blog-card__title"><?php the_title(); ?></h3>
                        <p class="ig-blog-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <div class="ig-blog-card__img">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('card-wide'); ?>
                        <?php else: ?>
                            <div class="ig-placeholder-img">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    $fallback_articles = [
                        ['title' => 'Le 10 spiagge più belle del Lago di Garda', 'excerpt' => 'Una guida completa alle spiagge da non perdere, dalla Jamaica Beach alle calette nascoste.', 'cat' => 'Guide'],
                        ['title' => 'Cosa fare a Riva del Garda: itinerario di 3 giorni', 'excerpt' => 'Sport, cultura e gastronomia nella capitale nord del lago.', 'cat' => 'Itinerari'],
                        ['title' => 'I migliori ristoranti sul lago', 'excerpt' => 'Da trattorie familiari a ristoranti stellati: dove mangiare con vista lago.', 'cat' => 'Food'],
                        ['title' => 'Trekking sul Monte Baldo: guida completa', 'excerpt' => 'Sentieri panoramici, funivia e consigli pratici per un\'escursione indimenticabile.', 'cat' => 'Outdoor'],
                        ['title' => 'Weekend romantico a Sirmione', 'excerpt' => 'Terme, castello e cene con vista: il programma perfetto per una fuga a due.', 'cat' => 'Esperienze'],
                        ['title' => 'I vini del Garda: dalla Lugana al Bardolino', 'excerpt' => 'Un viaggio tra le cantine e i vigneti che circondano il lago.', 'cat' => 'Food'],
                    ];
                    foreach ($fallback_articles as $article):
                ?>
                <div class="ig-blog-card">
                    <div class="ig-blog-card__body">
                        <span class="ig-blog-card__cat"><?php echo esc_html($article['cat']); ?></span>
                        <h3 class="ig-blog-card__title"><?php echo esc_html($article['title']); ?></h3>
                        <p class="ig-blog-card__excerpt"><?php echo esc_html($article['excerpt']); ?></p>
                    </div>
                    <div class="ig-blog-card__img">
                        <div class="ig-placeholder-img">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>

            <!-- Nav arrows -->
            <button class="ig-blog-carousel__btn ig-blog-carousel__btn--prev" id="igBlogPrev" aria-label="Precedente">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <button class="ig-blog-carousel__btn ig-blog-carousel__btn--next" id="igBlogNext" aria-label="Successivo">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 6 15 12 9 18"/></svg>
            </button>
        </div>

    </div>
</section>


<?php
// ============================================================
// SECTION 4: VIVI IL LAGO (Marketplace)
// ============================================================
?>
<section class="ig-section ig-section--vivi ig-reveal">
    <div class="ig-container">

        <!-- Section Header -->
        <div class="ig-section__header">
            <span class="ig-section__badge ig-section__badge--gradient">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Esperienze
            </span>
            <h2 class="ig-section__title">Scopri, Gusta, Vivi</h2>
        </div>

        <!-- Category Grid -->
        <div class="ig-vivi-grid">

            <!-- Attività & Tour -->
            <div class="ig-vivi-card ig-vivi-card--teal">
                <div class="ig-vivi-card__img"><?php echo wp_get_attachment_image(34, 'card-wide'); ?></div>
                <div class="ig-vivi-card__body">
                    <div class="ig-vivi-card__icon ig-vivi-card__icon--teal">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                    </div>
                    <h3 class="ig-vivi-card__title">Attività &amp; Tour</h3>
                    <p class="ig-vivi-card__desc">Tour guidati, escursioni in barca, parchi e esperienze uniche.</p>
                    <div class="ig-vivi-card__tags">
                        <span class="ig-vivi-card__tag">Tour</span>
                        <span class="ig-vivi-card__tag">Escursioni</span>
                        <span class="ig-vivi-card__tag">Parchi</span>
                        <span class="ig-vivi-card__tag">Esperienze</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/esperienze/attivita/')); ?>" class="ig-vivi-card__cta">Esplora <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                </div>
            </div>

            <!-- Cultura & Musei -->
            <div class="ig-vivi-card ig-vivi-card--blue">
                <div class="ig-vivi-card__img"><?php echo wp_get_attachment_image(37, 'card-wide'); ?></div>
                <div class="ig-vivi-card__body">
                    <div class="ig-vivi-card__icon ig-vivi-card__icon--blue">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="22" x2="21" y2="22"/><line x1="6" y1="18" x2="6" y2="11"/><line x1="10" y1="18" x2="10" y2="11"/><line x1="14" y1="18" x2="14" y2="11"/><line x1="18" y1="18" x2="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>
                    </div>
                    <h3 class="ig-vivi-card__title">Cultura &amp; Musei</h3>
                    <p class="ig-vivi-card__desc">Musei, monumenti, castelli e chiese che raccontano la storia del Garda.</p>
                    <div class="ig-vivi-card__tags">
                        <span class="ig-vivi-card__tag">Musei</span>
                        <span class="ig-vivi-card__tag">Castelli</span>
                        <span class="ig-vivi-card__tag">Monumenti</span>
                        <span class="ig-vivi-card__tag">Chiese</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/esperienze/cultura/')); ?>" class="ig-vivi-card__cta">Esplora <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                </div>
            </div>

            <!-- Eventi -->
            <div class="ig-vivi-card ig-vivi-card--emerald">
                <div class="ig-vivi-card__img"><?php echo wp_get_attachment_image(37, 'card-wide'); ?></div>
                <div class="ig-vivi-card__body">
                    <div class="ig-vivi-card__icon ig-vivi-card__icon--emerald">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <h3 class="ig-vivi-card__title">Eventi</h3>
                    <p class="ig-vivi-card__desc">Feste, sagre, concerti e manifestazioni sul Lago di Garda.</p>
                    <div class="ig-vivi-card__tags">
                        <span class="ig-vivi-card__tag">Feste</span>
                        <span class="ig-vivi-card__tag">Sagre</span>
                        <span class="ig-vivi-card__tag">Concerti</span>
                        <span class="ig-vivi-card__tag">Mercatini</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/eventi/')); ?>" class="ig-vivi-card__cta">Esplora <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                </div>
            </div>

            <!-- Ristoranti -->
            <div class="ig-vivi-card ig-vivi-card--orange">
                <div class="ig-vivi-card__img"><?php echo wp_get_attachment_image(35, 'card-wide'); ?></div>
                <div class="ig-vivi-card__body">
                    <div class="ig-vivi-card__icon ig-vivi-card__icon--orange">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 002-2V2"/><path d="M7 2v20"/><path d="M21 15V2v0a5 5 0 00-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"/></svg>
                    </div>
                    <h3 class="ig-vivi-card__title">Ristoranti</h3>
                    <p class="ig-vivi-card__desc">Ristoranti, trattorie e pizzerie con i sapori autentici del Garda.</p>
                    <div class="ig-vivi-card__tags">
                        <span class="ig-vivi-card__tag">Ristoranti</span>
                        <span class="ig-vivi-card__tag">Trattorie</span>
                        <span class="ig-vivi-card__tag">Pizzerie</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/esperienze/ristoranti/')); ?>" class="ig-vivi-card__cta">Esplora <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                </div>
            </div>

            <!-- Soggiorni -->
            <div class="ig-vivi-card ig-vivi-card--violet">
                <div class="ig-vivi-card__img"><?php echo wp_get_attachment_image(34, 'card-wide'); ?></div>
                <div class="ig-vivi-card__body">
                    <div class="ig-vivi-card__icon ig-vivi-card__icon--violet">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
                    </div>
                    <h3 class="ig-vivi-card__title">Soggiorni</h3>
                    <p class="ig-vivi-card__desc">Hotel, B&amp;B, agriturismi e campeggi per ogni stile di vacanza.</p>
                    <div class="ig-vivi-card__tags">
                        <span class="ig-vivi-card__tag">Hotel</span>
                        <span class="ig-vivi-card__tag">B&amp;B</span>
                        <span class="ig-vivi-card__tag">Agriturismi</span>
                        <span class="ig-vivi-card__tag">Campeggi</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/esperienze/soggiorni/')); ?>" class="ig-vivi-card__cta">Esplora <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                </div>
            </div>

            <!-- Bar & Nightlife -->
            <div class="ig-vivi-card ig-vivi-card--pink">
                <div class="ig-vivi-card__img"><?php echo wp_get_attachment_image(36, 'card-wide'); ?></div>
                <div class="ig-vivi-card__body">
                    <div class="ig-vivi-card__icon ig-vivi-card__icon--pink">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 22h8"/><path d="M12 11v11"/><path d="M20 3H4l2 8h12l2-8z"/></svg>
                    </div>
                    <h3 class="ig-vivi-card__title">Bar &amp; Nightlife</h3>
                    <p class="ig-vivi-card__desc">Bar, enoteche, aperitivi al tramonto e discoteche sul lago.</p>
                    <div class="ig-vivi-card__tags">
                        <span class="ig-vivi-card__tag">Bar</span>
                        <span class="ig-vivi-card__tag">Enoteche</span>
                        <span class="ig-vivi-card__tag">Aperitivi</span>
                        <span class="ig-vivi-card__tag">Discoteche</span>
                    </div>
                    <a href="<?php echo esc_url(home_url('/esperienze/bar-nightlife/')); ?>" class="ig-vivi-card__cta">Esplora <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
                </div>
            </div>

        </div>

        <!-- Featured Listings -->
        <div class="ig-featured-listings">
            <h3 class="ig-featured-listings__title">Strutture in evidenza</h3>
            <div class="ig-featured-listings__grid">
                <?php
                $featured = new WP_Query([
                    'post_type'      => 'struttura',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);

                if ($featured->have_posts()):
                    while ($featured->have_posts()): $featured->the_post();
                        $tipo = get_the_terms(get_the_ID(), 'tipo_struttura');
                        $loc  = get_the_terms(get_the_ID(), 'localita');
                ?>
                <a href="<?php the_permalink(); ?>" class="ig-featured-card">
                    <div class="ig-featured-card__img">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('listing-thumb'); ?>
                        <?php else: ?>
                            <div class="ig-placeholder-img">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="ig-featured-card__body">
                        <?php if ($tipo && !is_wp_error($tipo)): ?>
                            <span class="ig-featured-card__type"><?php echo esc_html($tipo[0]->name); ?></span>
                        <?php endif; ?>
                        <h4 class="ig-featured-card__title"><?php the_title(); ?></h4>
                        <?php if ($loc && !is_wp_error($loc)): ?>
                            <span class="ig-featured-card__location">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <?php echo esc_html($loc[0]->name); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    // Hardcoded fallback listings
                    $fallback_listings = [
                        ['name' => 'Hotel Lido Palace', 'type' => 'Hotel', 'location' => 'Riva del Garda'],
                        ['name' => 'Ristorante La Tortuga', 'type' => 'Ristorante', 'location' => 'Sirmione'],
                        ['name' => 'Windsurf Center', 'type' => 'Attività', 'location' => 'Torbole'],
                        ['name' => 'Castello Scaligero', 'type' => 'Monumento', 'location' => 'Malcesine'],
                    ];
                    foreach ($fallback_listings as $listing):
                ?>
                <div class="ig-featured-card">
                    <div class="ig-featured-card__img">
                        <div class="ig-placeholder-img">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                    </div>
                    <div class="ig-featured-card__body">
                        <span class="ig-featured-card__type"><?php echo esc_html($listing['type']); ?></span>
                        <h4 class="ig-featured-card__title"><?php echo esc_html($listing['name']); ?></h4>
                        <span class="ig-featured-card__location">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <?php echo esc_html($listing['location']); ?>
                        </span>
                    </div>
                </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>

    </div>
</section>


<?php
// ============================================================
// SECTION 5: SOCIAL / COMMUNITY
// ============================================================
?>
<section class="ig-section ig-section--social ig-reveal">
    <div class="ig-container">

        <!-- Section Header -->
        <div class="ig-section__header">
            <h2 class="ig-section__title">La community del Lago di Garda</h2>
        </div>

        <!-- Reels Carousel -->
        <div class="ig-reels" id="igReelsCarousel">
            <div class="ig-reels__track" id="igReelsTrack">
                <?php
                $reels = [
                    ['code' => 'C5oWGKLNMuC', 'img' => 'reel-1.jpg'],
                    ['code' => 'DUdKukMCPFA', 'img' => 'reel-2.jpg'],
                    ['code' => 'DUYx5jkCIdL', 'img' => 'reel-3.jpg'],
                    ['code' => 'DUJXTjJiPnw', 'img' => 'reel-4.jpg'],
                    ['code' => 'DTvp4TjiKwx', 'img' => 'reel-5.jpg'],
                    ['code' => 'DQCphpViCah', 'img' => 'reel-6.jpg'],
                    ['code' => 'DO_srCeiEb3', 'img' => 'reel-7.jpg'],
                    ['code' => 'DPLUrqtiM5B', 'img' => 'reel-8.jpg'],
                    ['code' => 'DJ_J8NPIWbv', 'img' => 'reel-9.jpg'],
                    ['code' => 'DJzUsGtI4Ce', 'img' => 'reel-10.jpg'],
                    ['code' => 'DReOVtZiMbx', 'img' => 'reel-11.jpg'],
                    ['code' => 'DVB8at_iBRa', 'img' => 'reel-12.jpg'],
                    ['code' => 'DVJwMNHCP3t', 'img' => 'reel-13.jpg'],
                ];
                foreach ($reels as $reel):
                ?>
                <a href="https://www.instagram.com/reel/<?php echo esc_attr($reel['code']); ?>/" target="_blank" rel="noopener noreferrer" class="ig-reel">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/reels/' . $reel['img']); ?>" alt="Reel InstaGarda" loading="lazy">
                    <div class="ig-reel__play">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="white"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Platform Stats -->
        <div class="ig-social-stats">
            <a href="https://www.instagram.com/instagarda/" target="_blank" rel="noopener noreferrer" class="ig-social-stat">
                <svg class="ig-social-stat__icon ig-social-stat__icon--ig" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                <span class="ig-social-stat__number">620K</span>
                <span class="ig-social-stat__label">Follower</span>
            </a>
            <a href="https://www.tiktok.com/@instagarda" target="_blank" rel="noopener noreferrer" class="ig-social-stat">
                <svg class="ig-social-stat__icon ig-social-stat__icon--tt" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M12.53.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                <span class="ig-social-stat__number">176K</span>
                <span class="ig-social-stat__label">Follower</span>
            </a>
            <a href="https://www.facebook.com/profile.php?id=61582136463994" target="_blank" rel="noopener noreferrer" class="ig-social-stat">
                <svg class="ig-social-stat__icon ig-social-stat__icon--fb" width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                <span class="ig-social-stat__number">53K</span>
                <span class="ig-social-stat__label">Follower</span>
            </a>
        </div>

        <!-- Follow CTAs -->
        <div class="ig-social-ctas">
            <a href="https://www.instagram.com/instagarda/" target="_blank" rel="noopener noreferrer" class="ig-social-cta ig-social-cta--ig">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                Segui su Instagram
            </a>
            <a href="https://www.tiktok.com/@instagarda" target="_blank" rel="noopener noreferrer" class="ig-social-cta ig-social-cta--tt">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.53.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                Segui su TikTok
            </a>
            <a href="https://www.facebook.com/profile.php?id=61582136463994" target="_blank" rel="noopener noreferrer" class="ig-social-cta ig-social-cta--fb">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                Segui su Facebook
            </a>
        </div>

    </div>
</section>


<?php
// ============================================================
// SECTION 6: NEWSLETTER
// ============================================================
?>
<section class="ig-section ig-section--newsletter ig-reveal">
    <div class="ig-newsletter">
        <div class="ig-container">
            <div class="ig-newsletter__inner">

                <!-- Left: Info -->
                <div class="ig-newsletter__text">
                    <h2>Resta aggiornato sulle meraviglie del Garda</h2>
                    <p>Iscriviti alla newsletter per ricevere contenuti esclusivi direttamente nella tua casella email.</p>
                    <ul class="ig-newsletter__benefits">
                        <li class="ig-newsletter__benefit">
                            <span class="ig-newsletter__benefit-icon">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Guide esclusive sulle destinazioni
                        </li>
                        <li class="ig-newsletter__benefit">
                            <span class="ig-newsletter__benefit-icon">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            Sconti e offerte dalle strutture partner
                        </li>
                        <li class="ig-newsletter__benefit">
                            <span class="ig-newsletter__benefit-icon">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            News ed eventi sul Lago di Garda
                        </li>
                    </ul>
                </div>

                <!-- Right: Form -->
                <div class="ig-newsletter__card">
                    <form class="ig-newsletter__form" action="#" method="post">
                        <label for="igNewsletterEmail" style="display:block;font-size:.875rem;font-weight:500;color:white;margin-bottom:8px">La tua email</label>
                        <input type="email" id="igNewsletterEmail" name="email" placeholder="nome@email.com" required class="ig-newsletter__input">
                        <button type="submit" class="ig-newsletter__submit">Iscriviti</button>
                        <p style="font-size:.75rem;color:rgba(255,255,255,.6);text-align:center;margin-top:12px">Niente spam, cancellati quando vuoi.</p>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
