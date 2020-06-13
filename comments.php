<?php
if (post_password_required()) return;
$comments = get_comments(array('post_id' => get_the_ID()));
?>
<?php if (comments_open() || count($comments) > 0) : ?>
	<div class="<?php echo comments_open() ? 'comments' : 'comments comments--closed'; ?>">
		<div class="grid-container">
			<h2 class="comments__title">
				<?php if (count($comments) > 0) : ?>
				<?php printf(_n('One reply to this post', '%d replies to this post', count($comments), 'zenwriter'), number_format_i18n(count($comments))); ?>
				<?php else : ?>
					<?php if (comments_open()) : ?>
						<?php _e('Reply to this post', 'zenwriter') ?>
					<?php else: ?>
						<?php _e('Comments are closed.', 'zenwriter'); ?>
					<?php endif; ?>
				<?php endif ?>
			</h2><!-- .comments__title -->
			<?php if (comments_open()) : ?>
				<?php comment_form(array('class_form' => 'comments__form')); ?>
			<?php else: ?>
				<p class="comments__closed">
					<?php _e('Comments are closed.', 'zenwriter'); ?>
				</p>
			<?php endif; ?>
			<?php if (have_comments()) : ?>
				<ul class="comments__list">
					<?php
					wp_list_comments(
						array(
							'callback'		=> 'zenwriter_comment_callback',
							'short_ping'  	=> true,
							'per_page'		=> (int) get_option('comments_per_page')
						)
					);
					?>
				</ul><!-- .comments__list -->
				<?php
				the_comments_navigation(
					array(
						'prev_text' => '<span class="icon-left"></span>' . __('Previous comments', 'zenwriter'),
						'next_text' => __('Next comments', 'zenwriter') . '<span class="icon-right"></span>'
					)
				);
				?>
			<?php endif; ?>
		</div><!-- .grid-container -->
	</div><!-- .comments -->
<?php endif; ?>