<?php
/* ========================================================================== */
/* TEMPLATE
/* ========================================================================== */

/* -------------------------------------------------------------------------- */
/* Comments
/* -------------------------------------------------------------------------- */
// object(WP_Comment)[4442]
//   public 'comment_ID' => string '9' (length=1)
//   public 'comment_post_ID' => string '1148' (length=4)
//   public 'comment_author' => string 'Jane Doe' (length=8)
//   public 'comment_author_email' => string 'example@example.org' (length=19)
//   public 'comment_author_url' => string 'http://example.org/' (length=19)
//   public 'comment_author_IP' => string '' (length=0)
//   public 'comment_date' => string '2013-03-12 13:17:35' (length=19)
//   public 'comment_date_gmt' => string '2013-03-12 20:17:35' (length=19)
//   public 'comment_content' => string 'Comments? I love comments!' (length=26)
//   public 'comment_karma' => string '0' (length=1)
//   public 'comment_approved' => string '1' (length=1)
//   public 'comment_agent' => string '' (length=0)
//   public 'comment_type' => string '' (length=0)
//   public 'comment_parent' => string '0' (length=1)
//   public 'user_id' => string '0' (length=1)
//   protected 'children' => null
//   protected 'populated_children' => boolean false
//   protected 'post_fields' => 
//     array (size=21)
//       0 => string 'post_author' (length=11)
//       1 => string 'post_date' (length=9)
//       2 => string 'post_date_gmt' (length=13)
//       3 => string 'post_content' (length=12)
//       4 => string 'post_title' (length=10)
//       5 => string 'post_excerpt' (length=12)
//       6 => string 'post_status' (length=11)
//       7 => string 'comment_status' (length=14)
//       8 => string 'ping_status' (length=11)
//       9 => string 'post_name' (length=9)
//       10 => string 'to_ping' (length=7)
//       11 => string 'pinged' (length=6)
//       12 => string 'post_modified' (length=13)
//       13 => string 'post_modified_gmt' (length=17)
//       14 => string 'post_content_filtered' (length=21)
//       15 => string 'post_parent' (length=11)
//       16 => string 'guid' (length=4)
//       17 => string 'menu_order' (length=10)
//       18 => string 'post_type' (length=9)
//       19 => string 'post_mime_type' (length=14)
//       20 => string 'comment_count' (length=13)
function zenwriter_comment_callback($comment, $args, $depth) {
    /* translators: this is a date format, see http://php.net/date 
    * in brazil, for instance: 'j \d\e F \d\e Y'
    */
    $date_format = esc_html__('m/d/Y', 'zenwriter');
    ?>
    <li id="comment-<?php echo $comment->comment_ID; ?>" class="comment">
        <div class="comment__meta">
            <?php
            $avatar = get_avatar($comment, 40);
            if ($avatar) : ?>
                <div class="comment__avatar"><?php echo get_avatar($comment, 40); ?></div><!-- .comment__avatar -->
            <?php endif ?>
            <div class="comment__author">
                <?php echo $comment->comment_author; ?>:
            </div><!-- .comment__author -->
            <div class="comment__date">
                <?php echo date($date_format, strtotime($comment->comment_date_gmt)); ?>
            </div>
        </div><!-- .comment__meta -->
        <div class="comment__content">
            <?php echo $comment->comment_content; ?>
            <?php
            comment_reply_link(array(
                'add_below' => 'comment',
                'before'    => '</br>',
                'depth'     => 1,
                'max_depth' => get_option('thread_comments_depth')
            ), $comment->comment_ID);
            ?>
        </div><!-- .comment__content -->
    <?php
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