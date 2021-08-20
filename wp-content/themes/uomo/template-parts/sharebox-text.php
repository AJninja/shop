<?php
global $post;
?>
<div class="apus-social-share">
	<div class="bo-social-icons social-text">
		<?php if ( uomo_get_config('facebook_share', 1) ): ?>
 			<a class="bo-social-facebook facebook" href="http://www.facebook.com/sharer.php?s=100&u=<?php the_permalink(); ?>" target="_blank">
				<?php echo esc_html__('Facebook', 'uomo'); ?>
			</a>
		<?php endif; ?>
		<?php if ( uomo_get_config('twitter_share', 1) ): ?>
 			<a class="bo-social-twitter twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank">
				<?php echo esc_html__('Twitter', 'uomo'); ?>
			</a>
		<?php endif; ?>
		<?php if ( uomo_get_config('linkedin_share', 1) ): ?>
 			<a class="bo-social-linkedin linkedin" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank">
				<?php echo esc_html__('Linkedin', 'uomo'); ?>
			</a>
		<?php endif; ?>
		
		<?php if ( uomo_get_config('pinterest_share', 1) ): ?>
			<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
 			<a class="bo-social-pinterest pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;media=<?php echo urlencode($full_image[0]); ?>" target="_blank">
				<?php echo esc_html__('Pinterest','uomo') ?>
			</a>
		<?php endif; ?>

	</div>
</div>