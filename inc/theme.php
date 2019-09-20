<?php
/* ========================================================================== */
/* THEME
/* ========================================================================== */

/* -------------------------------------------------------------------------- */
/* Styles and scripts
/* -------------------------------------------------------------------------- */
/* Includes javascript and css */
add_action('wp_enqueue_scripts', 'zenwriter_wp_enqueue_script');
function zenwriter_wp_enqueue_script() {
    /* CSS includes */
    wp_enqueue_style('google-fonts-css', 'https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700|IBM+Plex+Serif:400,400i,700&display=swap', array(), null, 'all');
	wp_enqueue_style('zenwriter-base-css', get_stylesheet_directory_uri() . '/style.css', array('google-fonts-css'), ZENWRITER_VERSION, 'all');
	/* JS includes */
	wp_enqueue_script('zenwriter-base-js', get_theme_file_uri('/assets/js/script.min.js'), array('jquery'), ZENWRITER_VERSION, true);
}

/* -------------------------------------------------------------------------- */
/* Main Menu
/* -------------------------------------------------------------------------- */
add_action('init', 'zenwriter_register_menus');
function zenwriter_register_menus() {
    register_nav_menu('main-menu', __('Main Menu', 'zenwriter'));
}

/* -------------------------------------------------------------------------- */
/* Post
/* -------------------------------------------------------------------------- */
/* Changes excerpt formatting */
add_filter('excerpt_more', 'zenwriter_excerpt_more');
function zenwriter_excerpt_more() {
    return ' (...)';
}

/* Removes 'read more' links */
add_filter('the_content_more_link', 'zenwriter_remove_read_more_link');
function zenwriter_remove_read_more_link() {
    return '';
}

/* -------------------------------------------------------------------------- */
/* Archive
/* -------------------------------------------------------------------------- */
/* Remove the label from archives title */
add_filter( 'get_the_archive_title', 'zenwriter_archive_title' );
function zenwriter_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title('', false);
    } elseif ( is_tag() ) {
        $title = single_tag_title('', false);
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title('', false);
    } elseif ( is_tax() ) {
        $title = single_term_title('', false);
    }
    return $title;
}

/* -------------------------------------------------------------------------- */
/* Search
/* -------------------------------------------------------------------------- */
/* Exclude pages from WordPress Search */
add_filter('pre_get_posts','zenwriter_search_filter');
function zenwriter_search_filter($query) {
    if (!is_admin()) {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }
}

/* -------------------------------------------------------------------------- */
/* Pagination
/* -------------------------------------------------------------------------- */
function zenwriter_numeric_pagination() {
    if (is_singular()) return;

    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1) return;
 
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($wp_query->max_num_pages);
 
    /** Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if (($paged + 2) <= $max) {
        $links[] = $paged + 1;
        $links[] = $paged + 2;
    }
 
    echo '<div class="pagination"><div class="grid-container"><ul class="pagination__items">' . "\n";
 
    /** Previous Post Link */
    if (get_previous_posts_link())
        printf('<li class="pagination__item pagination__item--previous">%s</li>' . "\n", get_previous_posts_link('<span class="icon-left"></span> ' . __('Previous page', 'zenwriter')));
 
    /** Link to first page, plus ellipsis if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="pagination__item pagination__item--active"' : ' class="pagination__item"';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');
        if (!in_array(2, $links)) echo '<li class="pagination__item">…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="pagination__item pagination__item--active"' : ' class="pagination__item"';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }
 
    /** Link to last page, plus ellipsis if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) echo '<li class="pagination__item">…</li>' . "\n";
        $class = $paged == $link ? ' class="pagination__item pagination__item--active"' : ' class="pagination__item"';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }
 
    /** Next Post Link */
    if (get_next_posts_link()) 
        printf('<li class="pagination__item pagination__item--next">%s</li>' . "\n", get_next_posts_link(__('Next page', 'zenwriter') . '<span class="icon-right"></span>'));
    
    echo '</ul><!-- .pagination__items --></div><!-- .grid-container --></div><!-- .pagination -->' . "\n";
}

add_filter('next_posts_link_attributes', 'zenwriter_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'zenwriter_posts_link_attributes');
function zenwriter_posts_link_attributes($output) {
    return 'class="button button--large button--darker"';
}

/* -------------------------------------------------------------------------- */
/* Post format support
/* -------------------------------------------------------------------------- */
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