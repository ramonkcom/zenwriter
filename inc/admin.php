<?php
/* ========================================================================== */
/* ADMIN
/* This file contains all Wordpress admin related functions
/* ========================================================================== */

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
                    <span class="description"><?php printf(esc_html__('Please enter your $s profile URL.', 'zenwriter'), $name); ?></span>
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