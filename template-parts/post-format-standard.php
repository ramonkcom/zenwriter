<?php if (is_single()) : ?>
    <div class="grid-container">
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
    <<?php echo is_front_page() && !is_home() ? 'h3' : 'h2'; ?> class="post__title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </<?php echo is_front_page() && !is_home() ? 'h3' : 'h2'; ?>><!-- .post__title -->
    <?php get_template_part('/template-parts/post-meta'); ?>
    <div class="post__content">
        <?php has_excerpt() ? the_excerpt() : the_content(); ?>
    </div><!-- .post__content -->
    <?php get_template_part('/template-parts/post-tags'); ?>
    <a class="post__read-more button<?php echo is_front_page() && !is_home() ? ' button--small' : ''; ?>" href="<?php the_permalink(); ?>" title="<?php echo __('Read the full post', 'zenwriter') . ': ' . get_the_title(); ?>">
        <?php _e('Read the full post', 'zenwriter'); ?>
        <span class="icon-right"></span>
    </a><!-- .post__read-more -->
<?php endif ?>