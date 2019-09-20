<?php 
    $categories = get_the_category(); 
    $categoryLinks = '';
    
    if (count($categories) == 1) {
        $category = $categories[0];
        do {
            $href = get_category_link($category->term_id);
            $title = __('Category', 'zenwriter') . ': ' . $category->name;
            $categoryLinks = '<a class="meta__category" href="' . $href . '" title="' . $title . '">' . $category->name . '</a> <span class="icon-right"></span> ' . $categoryLinks;
            $category = $category->parent ? get_category($category->parent) : null;
        } while ($category);
        //$categoryLinks = rtrim($categoryLinks, ' <span class="icon-right"></span> ');
    } else if (count($categories) > 1) {
        foreach ($categories as $category) {
            $href = get_category_link($category->term_id);
            $title = __('Category', 'zenwriter') . ': ' . $category->name;
            $categoryLinks = $categoryLinks . ', <a class="meta__category" href="' . $href . '" title="' . $title . '">' . $category->name . '</a>';
        }
        $categoryLinks = trim($categoryLinks, ', ');
    }
?>
<aside class="post-meta">
    <span class="meta__author">
        <?php _e('Posted by', 'zenwriter'); ?>
        <?php the_author_posts_link(); ?> 
    </span><!-- .meta__author -->
    <time class="meta__date" datetime="<?php echo get_the_date('Y-m-d H:i:s'); ?>">
        <?php _e('on day', 'zenwriter'); ?>
        <?php
            /* translators: this is a date format, see http://php.net/date 
             * in brazil, for instance: 'j \d\e F \d\e Y'
             */
            $date_format = esc_html__('m/d/Y', 'zenwriter');
        ?>
        <a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>" title="<?php printf(__('Posts on %1$s of %2$s', 'zenwriter'), get_the_date('F'), get_the_date('Y')); ?>">
            <?php echo get_the_date($date_format, '', '', true); ?>
        </a>
    </time><!-- .meta__date -->
    <?php if (!empty($categories)) : ?>
        <?php echo __('in', 'zenwriter') . ' ' . $categoryLinks; ?>
    <?php endif; ?>
</aside><!-- .post-meta -->