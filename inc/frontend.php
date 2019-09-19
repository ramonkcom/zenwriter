<?php
/* ========================================================================== */
/* FRONT END
/* This file contains all Wordpress front-end related functions
/* ========================================================================== */

/* -------------------------------------------------------------------------- */
/* Styles and scripts
/* -------------------------------------------------------------------------- */
/* Includes javascript and css */
add_action('wp_enqueue_scripts', 'zenwriter_wp_enqueue_script');
function zenwriter_wp_enqueue_script() {
    /* CSS includes */
    wp_enqueue_style('google-fonts-css', 'https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700|IBM+Plex+Serif:400,400i&display=swap', array(), null, 'all');
	wp_enqueue_style('zenwriter-base-css', get_stylesheet_directory_uri() . '/style.css', array('google-fonts-css'), ZENWRITER_VERSION, 'all');
	/* JS includes */
	wp_enqueue_script('zenwriter-base-js', get_theme_file_uri('/assets/js/script.min.js'), array('jquery'), ZENWRITER_VERSION, true);
}

/* -------------------------------------------------------------------------- */
/* Post
/* -------------------------------------------------------------------------- */
/* Changes excerpt formatting */
add_filter('excerpt_more', 'zenwriter_excerpt_more');
function zenwriter_excerpt_more() {
    return ' (...)';
}

add_filter('the_content_more_link', 'zenwriter_remove_read_more_link');
function zenwriter_remove_read_more_link() {
    return '';
}

// add_filter('the_content_more_link', 'zenwriter_remove_read_more_link_scroll');
// function zenwriter_remove_read_more_link_scroll($link) {
// 	$link = preg_replace('|#more-[0-9]+|', '', $link);
// 	return $link;
// }

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
/* Search
/* -------------------------------------------------------------------------- */
//Exclude pages from WordPress Search
add_filter('pre_get_posts','zenwriter_search_filter');
function zenwriter_search_filter($query) {
    if (!is_admin()) {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }
}