<?php
/* ========================================================================== */
/* ADMIN
/* This file contains all Wordpress admin related functions
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

/* -------------------------------------------------------------------------- */
/* Extra fields for user profile
/* -------------------------------------------------------------------------- */
add_action('show_user_profile', 'zenwriter_extra_user_fields');
add_action('edit_user_profile', 'zenwriter_extra_user_fields');

function zenwriter_extra_user_fields( $user ) { ?>
    <h3><?php _e('Social networks', 'zenwriter'); ?></h3>
    <table class="form-table">
        <?php
        foreach(social_links() as $name => $key) :
        ?>
            <tr>
                <th><label for="<?php echo $key; ?>"><?php _e($name); ?></label></th>
                <td>
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo esc_attr(get_the_author_meta($key, $user->ID)); ?>" class="regular-text" /><br />
                    <span class="description"><?php printf(esc_html__('Please enter your %s profile URL.', 'zenwriter'), $name); ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php }

add_action('personal_options_update', 'zenwriter_save_extra_user_fields');
add_action('edit_user_profile_update', 'zenwriter_save_extra_user_fields');
function zenwriter_save_extra_user_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) { 
        return false; 
    }
    foreach(social_links() as $name => $key) {
        update_user_meta($user_id, $key, $_POST[$key]);
    }
}