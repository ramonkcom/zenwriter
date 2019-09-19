<?php get_header(); ?>
<?php if (!is_home() && have_posts()) : ?>
    <div class="archive-header">
        <div class="grid-container">
            <?php while (have_posts()) : the_post(); ?>
                <h2 class="archive-header__title title-x-large">
                    <?php the_title(); ?>
                </h2><!-- .archive-header__title -->
                <div class="archive-header__description">
                    <?php echo the_content();  ?>
                </div><!-- .archive-header__description -->
            <?php endwhile; ?>
        </div><!-- .grid-container -->
    </div><!-- .archive-header -->
    <div class="latest-posts">
        <div class="grid-container">
            <?php
            $the_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 5
            )); ?>
            <?php if (have_posts()) : ?> 
                <h2 class="latest-posts__title">
                    <?php _e('Latest posts:', 'zenwriter'); ?>
                </h2><!-- .latest-posts__title -->
                <?php while ($the_query -> have_posts()) : $the_query->the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('post--brief'); ?>>
                        <?php get_template_part('/template-parts/post-format-' . (get_post_format() ?: 'standard')); ?>
                    </div><!-- .post -->
                <?php endwhile; ?> 
                <?php 
                    $blog_page_id = get_option('page_for_posts'); 
                    $blog_page = get_post($blog_page_id);
                ?>
                <?php if ($blog_page_id) : ?>
                    <a class="latest-posts__read-more button button--large button--justified" href="<?php echo get_permalink($blog_page_id) ?>" title="<?php echo apply_filters('the_title', $blog_page->post_title); ?>">
                        <?php _e('You can see all posts in', 'zenwriter'); ?> <?php echo apply_filters('the_title', $blog_page->post_title); ?>
                    </a><!-- .latest-posts__read-more -->
                <?php endif; ?>
            <?php else : ?>
                <p><?php _e('No post found.', 'zenwriter'); ?></p>
            <?php endif; ?>
        </div><!-- .grid-container -->
    </div><!-- .latest-posts -->
<?php elseif (is_home()) : ?>
<?php get_template_part('/template-parts/post-listing'); ?>
<?php endif; ?>
<?php get_footer(); ?>