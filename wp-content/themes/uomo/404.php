<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Uomo
 * @since Uomo 1.0
 */
/*
*Template Name: 404 Page
*/
get_header();
//uomo_render_breadcrumbs();
$bgimg = uomo_get_config('bg-img');

$style = $icon_url = '';
if ( !empty($bgimg['id']) ) {
	$img = wp_get_attachment_image_src($bgimg['id'], 'full');
	if ( !empty($img[0]) ) {
		$style = 'style="background-image: url('.$img[0].');"';
	}
}
?>
<section class="page-404" <?php echo trim($style); ?>>
	<div id="main-container" class="inner">
		<div id="main-content" class="main-page">
			<section class="error-404 not-found clearfix">
				<div class="container">
					<div class="row">

						<div class="col-sm-12 text-center">
							<div class="slogan">
								<h1 class="greeting_title">
									<?php
									$title = uomo_get_config('greeting_title');
									if ( !empty($title) ) {
										echo esc_html($title);
									} else {
										esc_html_e('OOPS!', 'uomo');
									}
									?>
								</h1>
								<h4 class="title-big">
									<?php
									$title = uomo_get_config('404_title');
									if ( !empty($title) ) {
										echo esc_html($title);
									} else {
										esc_html_e('Oops! This page Could Not Be Found!', 'uomo');
									}
									?>
								</h4>
							</div>
							<div class="page-content">
								<div class="description">
									<?php
									$desc = uomo_get_config('404_description');
									if ( !empty($desc) ) {
										echo trim($desc);
									} else {
										esc_html_e('Sorry bit the page you are looking for does not exist, have been removed or name changed', 'uomo');
									}
									?>
								</div>
								<div class="return">
									<a class="btn btn-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('Go to homepage','uomo') ?></a>
								</div>
							</div><!-- .page-content -->
						</div>
					</div>
				</div>
			</section><!-- .error-404 -->
		</div><!-- .content-area -->
	</div>
</section>
<?php get_footer(); ?>