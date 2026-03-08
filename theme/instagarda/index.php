<?php get_header(); ?>

<section class="ig-mini-hero">
    <div class="ig-mini-hero__content">
        <div class="ig-mini-hero__badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
            Blog
        </div>
        <h1 class="ig-mini-hero__title">Guide & <span>Consigli</span></h1>
        <p class="ig-mini-hero__desc">Itinerari, spiagge, eventi e tutto sul Lago di Garda</p>
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
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="ig-blog-card__body">
                    <div class="ig-blog-card__meta">
                        <span class="ig-blog-card__date"><?php echo get_the_date('d M Y'); ?></span>
                        <?php $cats = get_the_category(); if ($cats): ?>
                            <span class="ig-blog-card__cat"><?php echo esc_html($cats[0]->name); ?></span>
                        <?php endif; ?>
                    </div>
                    <h2 class="ig-blog-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="ig-blog-card__excerpt"><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="ig-blog-card__link">
                        Leggi tutto
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </article>
            <?php endwhile; else: ?>
                <div class="ig-text-center" style="grid-column:1/-1;padding:var(--sp-3xl) 0">
                    <p class="ig-404__desc">Nessun articolo trovato. Torna presto per nuovi contenuti!</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="ig-text-center ig-mt-xl">
            <?php the_posts_pagination([
                'prev_text' => '&larr;',
                'next_text' => '&rarr;',
            ]); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
