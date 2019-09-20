<?php $description = get_the_author_meta('description'); ?>
<aside class="post-author<?php if ('' == $description || strlen($description) < 40) echo ' post-author--short'; ?>">
    <figure class="post-author__avatar" style="background-image: url(<?php echo get_avatar_url(get_the_author_meta('ID'), array('size' => 256, 'default' => 'mystery')); ?>)">
        <?php echo get_avatar(get_the_author_meta('ID'), 128, null, get_the_author_meta('display_name')); ?>
    </figure><!-- .post-author__avatar -->
    <div class="post-author__about">
        <h2 class="post-author__name">
            <?php the_author_posts_link(); ?>
        </h2><!-- .post-author__name -->
        <div class="post-author__description">
            <?php echo $description; ?>
            <div class="post-author__links">
                <?php  
                foreach(social_links() as $name => $key) :
                    $url = get_the_author_meta($key);
                    if ('' != $url) :
                        ?>
                    <a class="button button--icon"  href="<?php echo $url; ?>" title="<?php echo $name; ?>" target="_blank" rel="nofollow">
                        <span class="icon-<?php echo $key; ?>"></span>
                    </a><!-- . -->
                <?php endif; endforeach; ?>
            </div><!-- .post-author__links -->
        </div><!-- .post-author__description -->
    </div><!-- post-author__about -->
</aside><!-- .post-author -->