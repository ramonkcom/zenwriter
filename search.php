<?php get_header(); ?>
    <div class="archive-header">
        <div class="grid-container">
            <h1 class="archive__title">
                <?php echo  __('Search results for', 'zenwriter') . ' "' . get_search_query() . '"' ?>
            </h1><!-- .archive__title -->
            <div class="archive-header__description">
                <?php if (absint($wp_query->found_posts) > 0) : ?>
                    <?php 
                    printf( 
                        _n(
                            'One post matching your search term was found. You can browse it below or search again using the menu.', 
                            'A total of %d posts matching your search term were found. You can browse them below or search again using the menu.',
                            $wp_query->found_posts,
                            'zenwriter'
                        ),
                        $wp_query->found_posts
                    ); 
                    ?>
                <?php else : ?>
                    <?php echo __('No posts were found for your search term', 'zenwriter') . ', "' .  get_search_query() . '". ' . __('How about trying again?', 'zenwriter'); ?>
                    <form class="archive-header__search-form" role="search" method="get" action="http://ramonk.local/">
                        <input id="s" class="search-field" type="text" name="s" value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : '' ; ?>" placeholder="<?php _e('Your search term', 'zenwriter'); ?>">
                        <button id="searchsubmit" class="button" type="submit" value="<?php _e('Search', 'zenwriter'); ?>">
                            <span class="icon-search"></span> <?php _e('Search', 'zenwriter'); ?>
                        </button><!-- .button -->
                    </form><!-- .archive-header__search-form -->
                <?php endif; ?>
            </div><!-- .archive-header__description -->
            <?php if (absint($wp_query->found_posts) > 0) : ?>
                <a class="button button--large button--important" href="#post-listing">
                    <span class="icon-down"></span>
                    <?php 
                    echo _n(
                        'See post', 
                        'See posts',
                        $wp_query->found_posts,
                        'zenwriter'
                    );
                    ?>
                </a><!-- .button -->
            <?php endif; ?>
        </div><!-- .grid-container -->
    </div><!-- .archive-header -->
    <?php get_template_part('/template-parts/post-listing'); ?>
<?php get_footer(); ?>