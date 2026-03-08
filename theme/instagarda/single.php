<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>

<section class="ig-section ig-section--light ig-page-top">
    <div class="ig-article">
        <p class="ig-article__meta">
            <?php echo get_the_date('d M Y'); ?> &middot; <?php the_category(', '); ?>
        </p>
        <h1 class="ig-article__title"><?php the_title(); ?></h1>

        <?php if (has_post_thumbnail()): ?>
        <div class="ig-article__hero-img">
            <?php the_post_thumbnail('hero'); ?>
        </div>
        <?php endif; ?>

        <div class="ig-article__body entry-content">
            <?php the_content(); ?>
        </div>

        <div class="ig-article__footer">
            <p>Hai domande su questo articolo?</p>
            <button class="ig-btn ig-btn--primary" onclick="window.toggleGardaChat && window.toggleGardaChat()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Chiedi a Garda AI
            </button>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
