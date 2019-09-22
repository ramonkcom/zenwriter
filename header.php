<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta name="language" content="pt-br" />
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="https://ramonk.com/">
    <meta name="format-detection" content="telephone=no">
    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php
    $custom_ga_id = trim(get_theme_mod('zenwriter_setting_google-analytics-id'));
    $custom_gsc_mt = trim(get_theme_mod('zenwriter_setting_google-search-console-meta-tag'));
    $custom_brand_color = trim(get_theme_mod('zenwriter_setting_brand-color'));
    $custom_logo_url = trim(get_theme_mod('zenwriter_setting_logo-positive'));
    ?>

    <?php if ('' != $custom_gsc_mt) : ?>
        <meta name="google-site-verification" content="<?php echo $custom_gsc_mt; ?>" />
    <?php endif; ?>

    <?php if ('' != $custom_ga_id) : ?>
        <!-- START: Google Analytics (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $custom_ga_id; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '<?php echo $custom_ga_id; ?>');
        </script>
        <!-- END: Google Analytics (gtag.js) -->
    <?php endif; ?>

    <?php wp_head(); ?>
    <!-- <?php echo $custom_brand_color; ?>; -->
    <?php if ('' != $custom_brand_color) : ?>
        <style type="text/css">
            a:active,
            .navigation__pages ul li a:active,
            .pagination__item--active a,
            .post__content .is-style-outline .wp-block-button__link:active { 
                border-color: <?php echo $custom_brand_color; ?>;
            }
            mark:hover, 
            button:active,
            button:hover,
            input[type=button]:active,
            input[type=button]:hover,
            input[type=reset]:active,
            input[type=reset]:hover,
            input[type=submit]:active,
            input[type=submit]:hover,
            .button:active,
            .button:hover,
            .button--important,
            .button--important:hover,
            .comments .comment-navigation .nav-links a:hover,
            .comments .comment-navigation .nav-links a:active,
            .navigation__toggle:hover,
            .navigation__checkbox:checked ~ .navigation__toggle,
            .post__content .wp-block-button__link:active,
            .post__content .wp-block-button__link:hover {            
                background-color: <?php echo $custom_brand_color; ?>;
            }
            a:hover,
            .navigation__pages ul li a:hover,
            .post__content .is-style-outline .wp-block-button__link:hover {
                border-color: <?php echo $custom_brand_color; ?>;
            }
            .button--important:hover {
                filter: brightness(92.5%);
            }
            .post__content .is-style-outline .wp-block-button__link:hover { 
                background-color: transparent;
            }
            .footer__zenwriter:hover,
            .footer__zenwriter:active {
                color: <?php echo $custom_brand_color; ?>;
            }
        </style>
    <?php endif; ?>
</head>

<body <?php body_class(is_front_page() && !is_home() ? 'front-page' : ''); ?>>
    <?php wp_body_open(); ?>
    <header class="header">
        <div class="header__content grid-container">
            <?php $tag = is_front_page() ? 'h1' : 'div'; ?>
            <<?php echo $tag ?> class="header__brand">
                <a class="header__brand-link" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                    <?php if ($custom_logo_url) : ?>
                        <img class="header__logo" src="<?php echo $custom_logo_url; ?>" alt="<?php bloginfo('name'); ?>" />
                    <?php else : ?>
                        <span class="header__title<?php if (strlen(get_bloginfo('name')) > 20) echo ' header__title--long'; ?>">
                            <?php bloginfo('name'); ?>
                        </span><!-- .header__title -->
                    <?php endif; ?>
                </a><!-- .header__brand-link -->
            </<?php echo $tag ?>><!-- .header__brand -->
            <?php get_template_part('/template-parts/navigation'); ?>
        </div><!-- .header__content -->
    </header><!-- .header -->
    <main id="main" class="main">