<?php

get_header();

$sidebar_configs = uomo_get_blog_layout_configs();
//uomo_render_breadcrumbs();
$checksidebar = uomo_get_config('blog_single_layout');
?>
<section id="main-container" class="main-content single-blog <?php echo apply_filters( 'uomo_blog_content_class', 'container' ); ?> inner">
	<?php uomo_before_content( $sidebar_configs ); ?>
	<div class="row">
		<?php uomo_display_sidebar_left( $sidebar_configs ); ?>

		<div id="main-content" class="col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content detail-post <?php echo (($checksidebar == 'main')?'only-content':''); ?>" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'template-posts/single/inner' );
							
							?>

			                <?php

			                // If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

							if ( uomo_get_config('show_blog_releated', false) ){
								get_template_part( 'template-parts/posts-releated' );
							}

						// End the loop.
						endwhile;
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>
		
		<?php uomo_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>	
</section>
<?php get_footer(); ?>