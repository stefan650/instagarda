<?php get_header(); ?>

<section class="ig-mini-hero">
    <div class="ig-mini-hero__content">
        <h1 class="ig-mini-hero__title">Risultati per "<span><?php echo esc_html(get_search_query()); ?></span>"</h1>
        <p class="ig-mini-hero__desc"><?php echo $wp_query->found_posts; ?> risultati trovati</p>
    </div>
</section>

<section class="ig-section ig-section--light">
    <div class="ig-container">
        <div class="ig-blog-grid">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <article class="ig-blog-card">
                <div class="ig-blog-card__img">
                    <?php if (has_post_thumbnail()): the_post_thumbnail('card-wide');
                    else: ?>
                        <div class="ig-placeholder-img">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="ig-blog-card__body">
                    <span class="ig-listing-card__type"><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                    <h2 class="ig-blog-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="ig-blog-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                </div>
            </article>
            <?php endwhile; else: ?>
                <div class="ig-text-center" style="grid-column:1/-1;padding:var(--sp-3xl) 0">
                    <p class="ig-404__desc">Nessun risultato. Prova a cercare qualcos'altro o chiedi a Garda Concierge!</p>
                    <button class="ig-btn ig-btn--primary ig-mt-lg" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                        Chiedi a Garda Concierge
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
