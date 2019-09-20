<?php
/* ========================================================================== */
/* ADMIN
/* ========================================================================== */

/* -------------------------------------------------------------------------- */
/* Customize login and admin bar logo
/* -------------------------------------------------------------------------- */
add_action('login_enqueue_scripts', 'zenwriter_login_logo');
function zenwriter_login_logo() { 
	?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_theme_file_uri('/assets/images/enso.png') ?>);
			background-size: 100px 100px;
			background-repeat: no-repeat;
			height: 100px;
        	padding-bottom: 10px;
			width: 100px;
        }
    </style>
	<?php 
}

add_action('wp_before_admin_bar_render', 'zenwriter_admin_bar_logo');
function zenwriter_admin_bar_logo() {
	?>
    <style type="text/css">
        #wpadminbar #wp-toolbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
            background-image: url('<?php echo get_theme_file_uri('/assets/images/enso.png') ?>') !important;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: contain;
            content: " ";
            display: block;
            filter: invert(100%);
            height: 16px;
            left: 2px;
            position: relative;
            top: 5px;
            width: 16px;
            -webkit-filter: invert(100%);
        }
    </style>
	<?php
}