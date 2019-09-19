<?php get_header(); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('post ' . (is_single() ? 'post--full' : 'post--brief')); ?>>
            <?php get_template_part('/template-parts/post-format-' . (get_post_format() ? : 'standard')); ?>
        </article><!-- .post -->
    <?php endwhile; else : ?>
        <p>Postagem não encontrada.</p>
    <?php endif; ?>
<?php get_footer(); ?>