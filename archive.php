<?php get_header(); ?>
    <div class="archive-header">
        <div class="grid-container">
            <?php if (is_category()) : ?>
                <h1 class="archive-header__title">
                    <?php _e('Posts in category', 'zenwriter'); ?>
                    <?php the_archive_title(); ?>
                </h1><!-- .archive-header__title -->
                <div class="archive-header__description">
                    <?php echo category_description();  ?>
                </div><!-- .archive-header__description -->
            <?php elseif (is_tag()) : ?>
                <h1 class="archive-header__title">
                    <?php _e('Posts tagged', 'zenwriter'); ?>
                    "<?php the_archive_title(); ?>"
                </h1><!-- .archive-header__title -->
                <div class="archive-header__description">
                    <?php echo tag_description(); ?>
                </div><!-- .archive-header__description -->
            <?php elseif (is_author()) : ?>
                <h1 class="archive-header__title archive-header__title--author">
                    <?php _e('Posts by', 'zenwriter'); ?>
                    <?php the_archive_title(); ?>
                </h1><!-- .archive-header__title -->
                <div class="archive-header__description">
                    <?php echo get_the_author_meta('description'); ?>
                </div><!-- .archive-header__description -->
            <?php elseif (is_date()) : ?>
                <h1 class="archive-header__title">
                    <?php _e('Posted on', 'zenwriter'); ?>
                    <?php
                        echo
                            get_query_var('day') ? get_query_var('day') . ' de ' : '';
                        echo
                            get_query_var('monthnum') ?
                                get_the_date('F') . ' de' : '';
                        ?>
                    <?php echo get_query_var('year'); ?>
                </h1><!-- .archive-header__title -->
            <?php endif ?>
            <a class="button button--large button--important" href="#post-listing">
                <span class="icon-down"></span>
                <?php _e('See posts', 'zenwriter'); ?>
            </a><!-- .button -->
        </div><!-- .grid-container -->
    </div><!-- .archive-header -->
    <?php get_template_part('/template-parts/post-listing'); ?>
<?php get_footer(); ?>