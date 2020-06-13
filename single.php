<?php get_header(); ?>
    <?php $use_zenwriter_formats = get_theme_mod('zenwriter_setting_zenwriter-post-format'); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('post post--full'); ?>>
            <div class="grid-container">
                <div class="post__featured-image">
                    <?php the_post_thumbnail('full'); ?>
                </div><!-- .post__featured-image -->
            </div><!-- .grid-container -->
            <?php
            if ($use_zenwriter_formats) {
                get_template_part('/template-parts/post-format-' . (get_post_format() ?: 'standard')); 
            } else {
                get_template_part('/template-parts/post-format-standard'); 
            }
            ?>
        </article><!-- .post -->
        <?php get_template_part('/template-parts/post-navigation'); ?>
        <?php comments_template(); ?>
    <?php endwhile; else : ?>
        <p>Postagem não encontrada.</p>
    <?php endif; ?>
<?php get_footer(); ?>