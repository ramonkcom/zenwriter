<nav class="post-navigation ">
    <div class="grid-container">
        <div class="post-navigation__items">
            <?php
                $nextPost = get_next_post();
                $previousPost = get_previous_post();
            ?>
            <div class="post-navigation__item<?php echo $nextPost ? '' : ' post-navigation__item--empty' ; ?>">
                <?php if ($nextPost) : ?>
                    <h2 class="post-navigation__item-label">
                        <?php _e('Newer:', 'zenwriter'); ?>
                    </h2><!-- .post-navigation__item-label -->
                    <div class="post-navigation__item-title">
                        <?php echo $nextPost->post_title; ?>
                    </div><!-- .post-navigation__item-title -->
                    <a class="button button--darker" href="<?php echo get_permalink($nextPost); ?>">
                        <span class="icon-left"></span> <?php _e('Browse', 'zenwriter'); ?>
                    </a><!-- .button -->
                <?php endif; ?>
            </div><!-- .post-navigation__item -->
            <div class="post-navigation__item<?php echo $previousPost ? '' : ' post-navigation__item--empty' ; ?>">
                <?php if ($previousPost) : ?>
                    <h2 class="post-navigation__item-label">
                        <?php _e('Older:', 'zenwriter'); ?>
                    </h2><!-- .post-navigation__item-label -->
                    <div class="post-navigation__item-title">
                        <?php echo $previousPost->post_title; ?>
                    </div><!-- .post-navigation__item-title -->
                    <a class="button button--darker" href="<?php echo get_permalink($previousPost); ?>">
                        <?php _e('Browse', 'zenwriter'); ?> <span class="icon-right"></span>
                    </a><!-- .button -->
                <?php endif; ?>
            </div><!-- .post-navigation__item -->
        </div><!-- .post-navigation__items -->
    </div><!-- .grid-container -->
</nav><!-- .post-navigation -->