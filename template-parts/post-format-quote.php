<?php
    $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
    $url = trim(get_the_excerpt());
    $url = filter_var($url, FILTER_VALIDATE_URL) ? $url : null;
?>
<?php if (is_single()) : ?>
    <div class="grid-container">
        <?php get_template_part('/template-parts/post-meta'); ?>
        <div class="post__content">
            <blockquote class="post__quote" <?php if ($url) echo 'cite="' . $url . '"'; ?>>
                <div>
                    <?php the_content() ?>
                </div>
                <footer>
                    <?php if ($featured_image_url) : ?>
                        <figure>
                            <img src="<?php echo $featured_image_url; ?>" alt="<?php the_title() ?>">
                        </figure>
                    <?php endif; ?>
                    <div>
                        <div class="title-small">
                            <?php if (!$featured_image_url) echo '&mdash;'; ?>
                            <?php the_title() ?> 
                        </div><!-- title-small -->
                        <?php if ($url) : ?>
                            <small>(<a href="<?php echo $url; ?>" target="_blank" rel="nofollow"><?php _e('Source', 'zenwriter'); ?></a>)</small>
                        <?php endif; ?>
                    </div>
                </footer>
            </blockquote>
        </div><!-- .post__content -->
        <?php get_template_part('/template-parts/post-tags'); ?>
        <?php get_template_part('/template-parts/post-author'); ?>
    </div><!-- .grid-container -->
<?php else : ?>
    <?php get_template_part('/template-parts/post-meta'); ?>
        <div class="post__content">
            <blockquote class="post__quote" <?php if ($url) echo 'cite="' . $url . '"'; ?>>
                <div>
                    <?php the_content() ?>
                </div>
                <footer>
                    <?php if ($featured_image_url) : ?>
                        <figure>
                            <img src="<?php echo $featured_image_url; ?>" alt="<?php the_title() ?>">
                        </figure>
                    <?php endif; ?>
                    <div>
                        <div class="title-small">
                            <?php if (!$featured_image_url) echo '&mdash;'; ?>
                            <?php the_title() ?> 
                        </div><!-- title-small -->
                        <?php if ($url) : ?>
                            <small>(<a href="<?php echo $url; ?>" target="_blank" rel="nofollow"><?php _e('Source', 'zenwriter'); ?></a>)</small>
                        <?php endif; ?>
                    </div>
                </footer>
            </blockquote>
        </div><!-- .post__content -->
    <?php get_template_part('/template-parts/post-tags'); ?>
<?php endif ?>