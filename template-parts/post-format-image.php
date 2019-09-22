<?php $featured_image_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
<?php if (is_single()) : ?>
    <div class="grid-container">
        <div class="post__media post__media--image">
            <?php if ($featured_image_url) : ?>
                <img src="<?php echo $featured_image_url; ?>" alt="<?php the_title(); ?>"/>
            <?php else : ?>
                <?php _e('Featured image not found.', 'zenwriter'); ?>
            <?php endif; ?>
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
<?php else : ?>
    <div class="post__media post__media--image">
        <?php if ($featured_image_url) : ?>
            <img src="<?php echo $featured_image_url; ?>" alt="<?php the_title(); ?>"/>
        <?php else : ?>
            <?php _e('Featured image not found.', 'zenwriter'); ?>
        <?php endif; ?>
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