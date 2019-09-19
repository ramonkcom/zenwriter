<?php get_header(); ?>
<div class="e404">
    <div class="grid-container">
        <h1 class="e404__title">
            404 - <?php _e('Page not found', 'zenwriter'); ?>
        </h1><!-- .e404__title -->
        <div class="e404__description">
            <p>
                <?php 
                $p1 = "The page you were looking for doesn't exist anymore or never existed." ;
                $p1 .= " Check the typed URL or browse to the ";
                $p1 .= '<a href="' .  esc_url(home_url('/')) . '" title="' . get_bloginfo('name') . '">' . "home page.</a>";
                _e($p1, 'zenwriter');
                ?>
            </p>
        </div><!-- .e404__description -->
        <a class="button button--large button--important"  href="<?php echo esc_url(home_url('/')); ?>">
            <i class="icon-left"></i>
            <?php _e('Browse to the home page'); ?>
        </a><!-- .button -->
    </div><!-- .grid-container -->
<?php get_footer(); ?>