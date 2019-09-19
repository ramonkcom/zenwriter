<?php $tags = get_the_tags(); ?>
<div class="post-tags">
    <?php if ($tags) : ?>
        <?php if (is_single()) : ?>
            <h2 class="post-tags__title">
                <?php _e('Tags:', 'zenwriter'); ?>
            </h2><!-- .post-tags__title -->
        <?php else: ?>
            <h3 class="post-tags__title">
                <?php _e('Tags:', 'zenwriter'); ?>
            </h3><!-- .post-tags__title -->
        <?php endif; ?>
        <ul class="post-tags__list">
            <?php foreach($tags as $tag) : ?>
                <li class="post-tags__item">
                    <a class="tags_link" href="<?php echo get_tag_link($tag->term_id); ?>" title="Palavra-chave: <?php echo trim($tag->name); ?> ">
                        <?php echo trim($tag->name); ?> 
                    </a><!-- .post-tags__link -->
                </li><!-- .post-tags__item -->
            <?php endforeach; ?>
        </ul><!-- .post-tags__list -->
    <?php else: ?>
        <span class="post-tags__title">
            <?php _e('No tags.', 'zenwriter'); ?>
        </span><!-- .post-tags__title -->
    <?php endif; ?>
</div><!-- .post-tags -->