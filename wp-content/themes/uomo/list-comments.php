<?php

$GLOBALS['comment'] = $comment;
$add_below = '';

?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	<div class="the-comment">
		<?php if(get_avatar($comment, 60)){ ?>
			<div class="avatar">
				<?php echo get_avatar($comment, 60); ?>
			</div>
		<?php } ?>
		<div class="comment-box">
			<div class="comment-author meta flex-middle">
				<div class="inner-left">
					<strong><?php echo get_comment_author_link() ?></strong>
					<?php edit_comment_link(esc_html__('Edit', 'uomo'),' ','') ?>
					<div class="date"><?php printf(esc_html__('%1$s', 'uomo'), get_comment_date()) ?></div>
				</div>
				<div class="ali-right">
					<?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__(' Reply', 'uomo'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php esc_html_e('Your comment is awaiting moderation.', 'uomo') ?></em>
				<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
		</div>
	</div>
</li>