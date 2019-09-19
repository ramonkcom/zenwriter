<?php
$url = trim(get_the_excerpt());
$url = filter_var($url, FILTER_VALIDATE_URL) ? $url : '#';
?>
<?php if (is_single()) : ?>
    <div class="grid-container">
        <h1 class="post__title">
            <?php the_title(); ?>
        </h1><!-- .post__title -->
        <?php get_template_part('/template-parts/post-meta'); ?>
        <section class="post__content">
            <?php the_content(); ?>
            <a class="post__read-more button" href="<?php echo $url ?>" title="<?php echo __('Browse link', 'zenwriter') . the_title(); ?>">
                <?php _e('Browse link', 'zenwriter'); ?>
            </a><!-- .post__read-more -->
        </section><!-- .post__content -->
        <?php get_template_part('/template-parts/post-tags'); ?>
        <?php get_template_part('/template-parts/post-author'); ?>
    </div><!-- .grid-container -->
    <?php get_template_part('/template-parts/post-navigation'); ?>
<?php else : ?>
    <<?php echo is_front_page() && !is_home() ? 'h3' : 'h2'; ?> class="post__title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </<?php echo is_front_page() && !is_home() ? 'h3' : 'h2'; ?>><!-- .post__title -->
    <?php get_template_part('/template-parts/post-meta'); ?>
    <div class="post__content">
        <?php the_content(); ?>
    </div><!-- .post__content -->
    <?php get_template_part('/template-parts/post-tags'); ?>
    <a class="post__read-more button<?php echo is_front_page() && !is_home() ? ' button--small' : ''; ?>" href="<?php echo $url ?>" title="<?php echo __('Browse link', 'zenwriter') . ': ' . get_the_title(); ?>" target="_blank" rel="nofollow">
        <span class="icon-link"></span>
        <?php _e('Browse link', 'zenwriter'); ?>
    </a><!-- .post__read-more -->
<?php endif ?>