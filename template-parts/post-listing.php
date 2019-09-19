<div id="post-listing" class="post-listing">
    <div class="grid-container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('post ' . (is_single() ? 'post--full' : 'post--brief')); ?>>
                <?php get_template_part('/template-parts/post-format-' . (get_post_format() ?: 'standard')); ?>
            </div><!-- .post -->
        <?php endwhile; else : ?>
            <div class="post-listing__no-result-message">
                <?php _e('No posts were found for your criteria.', 'zenwriter'); ?>
            </div><!-- .post-listing__no-result-message -->
        <?php endif; ?>
    </div><!-- .grid-container -->
</div><!-- .post-listing -->
<?php zenwriter_numeric_pagination(); ?>