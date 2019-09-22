<div id="post-listing" class="post-listing">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(is_sticky() ? 'post--brief post--sticky' : 'post--brief'); ?>>
            <div class="grid-container">
                <?php get_template_part('/template-parts/post-format-' . (get_post_format() ?: 'standard')); ?>
            </div><!-- .grid-container -->
        </div><!-- .post -->
    <?php endwhile; else : ?>
        <div class="grid-container">
            <div class="post-listing__no-result-message">
                <?php _e('No posts were found for your criteria.', 'zenwriter'); ?>
            </div><!-- .post-listing__no-result-message -->
        </div><!-- .grid-container -->
    <?php endif; ?>
</div><!-- .post-listing -->
<?php zenwriter_numeric_pagination(); ?>