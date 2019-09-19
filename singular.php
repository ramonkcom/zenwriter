<?php get_header(); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class('post post--page post--full'); ?>>
            <div class="grid-container">
                <h1 class="post__title">
                    <?php the_title(); ?>
                </h1><!-- .post__title -->
                <section class="post__content">
                    <?php the_content(); ?>
                </section><!-- .post__content -->
            </div><!-- .grid-container -->
        </article><!-- .post -->
    <?php endwhile; else : ?>
        <p>Página não encontrada.</p>
    <?php endif; ?>
<?php get_footer(); ?>