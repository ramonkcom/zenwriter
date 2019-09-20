<?php
    $page = get_post(get_the_ID());
    $breadcrumb = $page->post_title;

    while ($page->post_parent > 0) {
        $page = get_post($page->post_parent);
        $breadcrumb = 
            '<a class="breadcrumb__item" href="' . get_permalink($page->ID) . '" title="' . $page->post_title . '">' . 
            $page->post_title .
            '</a><!-- .breadcrumb__item --> <span class="icon-right"></span> ' .
            $breadcrumb;
    }
    $breadcrumb =
        '<a class="breadcrumb__item" href="' . get_home_url() . '" title="' . get_bloginfo('sitename') . '">' . 
        __('Home', 'zenwriter') .
        '</a><!-- .breadcrumb__item --> <span class="icon-right"></span> ' .
        $breadcrumb;
?>
<div class="breadcrumb">
    <?php if (is_page()) : ?>
        <?php echo $breadcrumb; ?>
    <?php endif; ?>
</div><!-- .breadcrumb -->