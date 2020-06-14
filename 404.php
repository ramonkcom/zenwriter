<?php get_header(); ?>
<div class="e404">
    <div class="grid-container">
        <h1 class="e404__title">
            404 - <?php _e('Page not found', 'zenwriter'); ?>
        </h1><!-- .e404__title -->
        <div class="e404__description">
            <p>
                <?php
                printf(__('The page you were looking for doesn\'t exist anymore or never existed.  Check the typed URL or browse to the <a href="%1$s" title="%2$s">home page</a>.', 'zenwriter'), get_home_url(), get_bloginfo('name'));
                ?>
            </p>
        </div><!-- .e404__description -->
        <a class="button button--large button--important"  href="<?php echo esc_url(get_home_url()); ?>">
            <i class="icon-left"></i>
            <?php _e('Browse to the home page', 'zenwriter'); ?>
        </a><!-- .button -->
    </div><!-- .grid-container -->
<?php get_footer(); ?>