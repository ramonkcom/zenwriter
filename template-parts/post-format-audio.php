<?php
    $featured_image_url = get_the_post_thumbnail_url(get_the_ID(),'full');
    $url = trim(get_the_excerpt());
    $url = filter_var($url, FILTER_VALIDATE_URL) ? $url : null;
?>
<?php if (is_single()) : ?>
    <div class="grid-container">
        <div class="post__media post__media--audio">
            <?php if ($featured_image_url) : ?>
                <img src="<?php echo $featured_image_url; ?>" alt="<?php the_title(); ?>"/>
            <?php endif; ?>
            <?php echo do_shortcode('[audio src="' . $url . '" preload="auto"]'); ?>
        </div><!-- .post__media -->
        <h1 class="post__title">
            <?php the_title(); ?>
        </h1><!-- .post__title -->
        <?php get_template_part('/template-parts/post-meta'); ?>
        <section class="post__content">
            <?php the_content(); ?>
        </section><!-- .post__content -->
        <?php get_template_part('/template-parts/post-tags'); ?>
        <?php get_template_part('/template-parts/post-author'); ?>
    </div><!-- .grid-container -->
    <?php get_template_part('/template-parts/post-navigation'); ?>
<?php else : ?>
    <div class="post__media post__media--audio">
        <?php if ($featured_image_url) : ?>
            <img src="<?php echo $featured_image_url; ?>" alt="<?php the_title(); ?>"/>
        <?php endif; ?>
        <?php echo do_shortcode('[audio src="' . $url . '" preload="none"]'); ?>
    </div><!-- .post__media -->
    <<?php echo is_front_page() && !is_home() ? 'h3' : 'h2'; ?> class="post__title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </<?php echo is_front_page() && !is_home() ? 'h3' : 'h2'; ?>><!-- .post__title -->
    <?php get_template_part('/template-parts/post-meta'); ?>
    <div class="post__content">
        <?php the_content(); ?>
    </div><!-- .post__content -->
    <?php get_template_part('/template-parts/post-tags'); ?>
<?php endif ?>