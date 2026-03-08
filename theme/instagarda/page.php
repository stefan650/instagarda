<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>

<section class="ig-section ig-section--light ig-page-top">
    <div class="ig-page">
        <h1 class="ig-page__title"><?php the_title(); ?></h1>

        <div class="ig-page__body entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
