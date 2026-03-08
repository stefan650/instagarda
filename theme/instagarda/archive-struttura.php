<?php get_header(); ?>

<section class="ig-mini-hero">
    <div class="ig-mini-hero__content">
        <div class="ig-mini-hero__badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 012 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
            Directory
        </div>
        <h1 class="ig-mini-hero__title">Directory <span>Lago di Garda</span></h1>
        <p class="ig-mini-hero__desc">Hotel, ristoranti, attività e esperienze selezionate</p>
    </div>
</section>

<section class="ig-section ig-section--light">
    <div class="ig-container">
        <div class="ig-listing-grid">
            <?php if (have_posts()): while (have_posts()): the_post();
                $tipo = get_the_terms(get_the_ID(), 'tipo_struttura');
                $loc  = get_the_terms(get_the_ID(), 'localita');
                $prezzo = ig_get_meta('prezzo');
                $prezzi = ['1' => '€', '2' => '€€', '3' => '€€€', '4' => '€€€€'];
            ?>
            <article class="ig-listing-card">
                <a href="<?php the_permalink(); ?>" class="ig-listing-card__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card-wide'); endif; ?>
                </a>
                <div class="ig-listing-card__body">
                    <?php if ($tipo && !is_wp_error($tipo)): ?>
                        <span class="ig-listing-card__type"><?php echo esc_html($tipo[0]->name); ?></span>
                    <?php endif; ?>
                    <h2 class="ig-listing-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <?php if ($loc && !is_wp_error($loc)): ?>
                        <p class="ig-listing-card__location">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <?php echo esc_html($loc[0]->name); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($prezzo && isset($prezzi[$prezzo])): ?>
                        <span class="ig-listing-card__price"><?php echo $prezzi[$prezzo]; ?></span>
                    <?php endif; ?>
                    <p class="ig-listing-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                </div>
            </article>
            <?php endwhile; endif; ?>
        </div>

        <div class="ig-text-center ig-mt-xl">
            <?php the_posts_pagination(['prev_text' => '&larr;', 'next_text' => '&rarr;']); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
