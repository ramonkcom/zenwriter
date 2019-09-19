<div class="navigation">
    <input id="navigation__checkbox" class="navigation__checkbox" type="checkbox">
    <label class="navigation__toggle" for="navigation__checkbox">
        <span>&nbsp;</span>
    </label><!-- .navigation__toggle -->
    <nav class="navigation__content">
        <?php //$pages = count(get_pages(array('parent' => 0))); print($pages); ?>
        <div class="navigation__group">
            <form class="navigation__search-form" role="search" method="get" action="http://ramonk.local/">
                <label class="screen-reader-text title-medium" for="s"><?php _e('Search', 'zenwriter'); ?>:</label>
                <input id="s" class="search-field" type="text" name="s" value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : '' ; ?>" placeholder="<?php _e('Your search term', 'zenwriter'); ?>">
                <button id="searchsubmit" class="button" type="submit" value="<?php _e('Search', 'zenwriter'); ?>">
                    <span class="icon-search"></span> <?php _e('Search', 'zenwriter'); ?>
                </button><!-- .button -->
            </form><!-- .navigation__search-form -->
        </div><!-- .navigation__group -->
        <?php if (has_nav_menu('main-menu')) : ?>
        <?php 
            $locations = get_nav_menu_locations();
            $menu_id = $locations['main-menu'] ;
            $pages = wp_get_nav_menu_items($menu_id);
            foreach ($pages as $page) {
                if ($page->post_parent === 0) {
                    $topLevelPages[] = $page;
                    //echo $page->title . '<br/>';
                }
            }
            //echo count($topLevelPages);
        ?>
        <div class="navigation__group">
            <?php
            $menu = wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => 'nav',
                'container_class' => 'navigation__pages',
                'echo' => false
            ));
            if ($menu) echo $menu;
            ?>
        </div><!-- .navigation__group -->
        <?php endif; ?>
        <?php
        $hasSocialLinks = false;
        foreach (social_links() as $name => $key) {
            if ('' != get_theme_mod('zenwriter_setting_' . $key . '-url')) {
                $hasSocialLinks = true;
                break;
            }
        }
        ?>
        <?php if ($hasSocialLinks) : ?>
            <div class="navigation__group">
                <div class="navigation__social-links">
                    <h2 class="title-medium"><?php _e('Follow', 'zenwriter'); ?>:</h2><!-- .title-medium -->
                    <?php foreach (social_links() as $name => $key) : ?>
                        <?php 
                        $url = trim(get_theme_mod('zenwriter_setting_' . $key . '-url'));
                        if ($url) :
                        ?>
                        <a class="button button--icon" href="<?php echo $url ?>" title="<?php echo $name ?>" target="_blank" rel="nofollow">
                            <span class="icon-<?php echo $key; ?>"></span>
                        </a><!-- .button -->
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div><!-- .navigation__social-links -->
            </div><!-- .navigation__group -->
        <?php endif ?>
        <?php 
        /*
        $links = 0; 
        foreach (social_links() as $name => $key) {
            $url = get_theme_mod('zenwriter_setting_' . $key . '-url'); 
            if ('' != $url) {
                $links++;
                if ($links == 1) {
                    echo '<div class="navigation__group">';
                    echo '<div class="navigation__social-links">';
                    echo '<h2 class="title-medium">' . __('Follow', 'zenwriter') . ':</h2>';
                    echo '<div class="navigation__social-links__row">';
                } else if ($links == 6) { 
                    echo '</div><!-- .navigation__social-links__row -->';
                    echo '<div class="navigation__social-links__row">';
                }
                echo '<a class="button button--icon"  href="' . $url .'" title="' . $name .'" target="_blank" rel="nofollow">';
                echo '<span class="icon-' .  $key . '"></span>';
                echo '</a><!-- .button -->';
            }
        }
        if ($links > 0) {
            echo '</div><!-- .navigation__social-links__row -->';
            echo '</div><!-- .navigation__social-links -->';
            echo '</div><!-- .navigation__group -->';
        }
        */
        ?>
    </nav><!-- .navigation__content -->
</div><!-- .navigation -->