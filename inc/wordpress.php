<?php
/* ========================================================================== */
/* WORDPRESS
/* This file contains all Wordpress functioning related functions
/* ========================================================================== */

/* -------------------------------------------------------------------------- */
/* Menus
/* -------------------------------------------------------------------------- */
/* Registers menus */
add_action('init', 'zenwriter_register_menus');
function zenwriter_register_menus() {
    register_nav_menu('main-menu', __('Main Menu', 'zenwriter'));
}

/* -------------------------------------------------------------------------- */
/* Theme support
/* -------------------------------------------------------------------------- */
/* Add post format support */
add_action('after_setup_theme', 'zenwriter_theme_support');
function zenwriter_theme_support()
{
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array(
        'audio',
        'image',
        'link',
        'quote',
        'video'
    ));
}

/* -------------------------------------------------------------------------- */
/* Customizer
/* -------------------------------------------------------------------------- */
add_action('customize_register', 'zenwriter_customize_register');
function zenwriter_customize_register($wp_customize)
{
    /* -------------------------------------------------------------------------- */
    /* Google settings */
    $wp_customize->add_section(
        'zenwriter_section_google',
        array(
            'priority' => 20,
            'title' => __('Google settings', 'zenwriter'),
            'description' => __('Google Analytics and Google Search Console settings.', 'zenwriter')
        )
    );

    $wp_customize->add_setting(
        'zenwriter_setting_google-analytics-id',
        array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );

    $wp_customize->add_control(
        'zenwriter_setting_google-analytics-id',
        array(
            'section' => 'zenwriter_section_google',
            'priority' => 10,
            'label' => __('Google Analytics ID', 'zenwriter'),
            'description' => __('The Google Analytics ID is a alphanumerical string like "UA-123456789-0" (the number of characters may vary).', 'zenwriter'),
            'type' => 'text',
            'input_attrs' => array(
                'placeholder' => 'UA-123456789-0',
            )
        )
    );

    $wp_customize->add_setting(
        'zenwriter_setting_google-search-console-meta-tag',
        array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );

    $wp_customize->add_control(
        'zenwriter_setting_google-search-console-meta-tag',
        array(
            'section' => 'zenwriter_section_google',
            'priority' => 10,
            'label' => __('Google Search Console meta tag', 'zenwriter'),
            'description' => __('The Google Search Console meta tag is a alphanumerical string like "aBc123fGHIjk456lmn_aBc123fGHIjk456lmnopQR" (the number of characters may vary).', 'zenwriter'),
            'type' => 'text',
            'input_attrs' => array(
                'placeholder' => 'aBc123fGHIjk456lmn_aBc123fGHIjk456lmnopQR)S',
            )
        )
    );
    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /* Social settings */
    $wp_customize->add_section(
        'zenwriter_section_social',
        array(
            'priority' => 30,
            'title' => __('Social networks links', 'zenwriter'),
            'description' => __('Social networks profiles.', 'zenwriter')
        )
    );

    foreach(social_links() as $name => $key) {
        $wp_customize->add_setting(
            'zenwriter_setting_' . $key . '-url',
            array(
                'default' => '',
                'transport' => 'refresh',
                'sanitize_callback' => 'esc_url_raw'
            )
        );
    
        $wp_customize->add_control(
            'zenwriter_setting_' . $key . '-url',
            array(
                'section' => 'zenwriter_section_social',
                'priority' => 10,
                'label' => $name,
                'description' => sprintf(esc_html__('The full URL for your %s profile, not just the username.', 'zenwriter'), $name),
                'type' => 'url'
            )
        );
    }

    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /* Logo */
    $wp_customize->add_setting(
        'zenwriter_setting_logo-positive',
        array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'zenwriter_setting_logo-positive',
            array(
                'section' => 'title_tagline',
                'priority' => 5,
                'label' => __('Positive logo', 'zenwriter'),
                'description' => __('Select the logo image to be used in the light backgrounds.', 'zenwriter'),
                'mime_type' => 'image'
            )
        )
    );

    $wp_customize->add_setting(
        'zenwriter_setting_logo-negative',
        array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'zenwriter_setting_logo-negative',
            array(
                'section' => 'title_tagline',
                'priority' => 5,
                'label' => __('Negative logo', 'zenwriter'),
                'description' => __('Select the logo image to be used in the dark backgrounds.', 'zenwriter'),
                'mime_type' => 'image'
            )
        )
    );
    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /* Brand color */
    $wp_customize->add_setting(
        'zenwriter_setting_brand-color',
        array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'zenwriter_setting_brand-color',
            array(
                'section' => 'title_tagline',
                'priority' => 150,
                'label' => __('Brand color', 'zenwriter'),
                'description' => __('Select the brand color to be applied on theme interactive items.', 'zenwriter'),
            )
        )
    );
    /* -------------------------------------------------------------------------- */

    /* -------------------------------------------------------------------------- */
    /* Footer */
    $wp_customize->add_setting(
        'zenwriter_setting_footer-copy',
        array(
            'default' => __('"Simplicity is the final achievement." - Frederic Chopin', 'zenwriter'),
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );

    $wp_customize->add_control(
        'zenwriter_setting_footer-copy',
        array(
            'section' => 'title_tagline',
            'priority' => 160,
            'label' => __('Footer copy', 'zenwriter'),
            'description' => __('The text that is displayed in the footer.', 'zenwriter'),
            'type' => 'text'
        )
    );
};
