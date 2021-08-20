<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

$layout = uomo_product_get_layout_type();

?>
<?php if ( $layout == 'v2' || $layout == 'v3' || $layout == 'v4' ) { ?>
	<div class="container-fluid no-padding">
<?php } else { ?>
	<div class="container">
<?php }

	/**
	 * Hook: woocommerce_before_single_product.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form(); // WPCS: XSS ok.
		return;
	}

	if ( method_exists('ApusSizeguides_Helper', 'display') ) {
		add_action( 'woocommerce_single_product_summary', array('ApusSizeguides_Helper', 'display'), 25 );
	}

	if(class_exists( 'YITH_WCWL' ) || (uomo_get_config('show_product_social_share', false)) ){
	    add_action( 'woocommerce_single_product_summary', 'uomo_woocomerce_wishlist_share_wrapper_open', 30 );
	    add_filter( 'woocommerce_single_product_summary', 'uomo_woocommerce_share_box', 38 );
	    add_action( 'woocommerce_single_product_summary', 'uomo_woocomerce_wishlist_share_wrapper_close', 39 );
	}
?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'details-product layout-'.$layout, $product ); ?>>
		<?php if ( $layout == 'v5' ) {
			$main_class = $sticky_class = '';
	        if ( uomo_get_config('enable_sticky_cart', true) ) {
	        	wp_enqueue_script( 'sticky-kit' );
	        	$main_class = 'product-v-wrapper';
	        	$sticky_class = 'sticky-this';
	        }
		?>
			<div class="row top-content <?php echo esc_attr($main_class); ?>">

				<div class="col-xs-12 col-md-4 left-content <?php echo esc_attr($sticky_class); ?>">
					<div class="information-left">
						<?php
							add_action( 'uomo_woocommerce_single_product_summary', 'woocommerce_breadcrumb', 1 );
							add_action( 'uomo_woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
							add_filter( 'uomo_woocommerce_single_product_summary', 'uomo_product_price_rating_open', 9 );
							add_action( 'uomo_woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
							if ( uomo_get_config('show_product_review_tab', true) ) {
								add_action( 'uomo_woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );
							}
							add_filter( 'uomo_woocommerce_single_product_summary', 'uomo_product_price_rating_close', 12 );

							add_action( 'uomo_woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

							do_action( 'uomo_woocommerce_single_product_summary' );
						?>
					</div>
				</div>

				<div class="col-xs-12 col-md-4 main-images">
					<div class="image-mains clearfix">
						<?php
							/**
							 * woocommerce_before_single_product_summary hook
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
							do_action( 'woocommerce_before_single_product_summary' );
						?>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-4 right-content <?php echo esc_attr($sticky_class); ?>">
					<div class="information">
						<div class="product-navs clearfix">
							<div class="pull-right">
					            <?php
					                the_post_navigation( array(
					                    'next_text' => '<span>' . esc_html__( 'Next', 'uomo' ) . '</span> <i class="flaticon-next"></i>',
					                    'prev_text' => '<i class="flaticon-back"></i> <span>' . esc_html__( 'Prevs', 'uomo' ) . '</span>',
					                ) );
					            ?>
				            </div>
				        </div>
						<div class="summary entry-summary">
							<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50
								 */

								remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
								remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
								remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

								add_action( 'woocommerce_single_product_summary', 'uomo_woocommerce_delivery_info', 300 );
								
								do_action( 'woocommerce_single_product_summary' );
							?>
						</div><!-- .summary -->
					</div>
				</div>
			</div>
		<?php } else { ?>
			<?php
				$style = '';
				if( $layout == 'v2' || $layout == 'v3' ){
					$bg_color = get_post_meta($post->ID, 'apus_product_bg_color', true);
					
					if ( $bg_color ) {
						$style = 'style="background-color:'.$product_bg_color.'"';
					} else {
						$bg_color = uomo_get_config('product_bg_color');
						if ( $bg_color  ) {
				            $style = 'style="background-color:'.$bg_color.'"';
				        }
			        }
		        }
		        // sticky
		        $main_class = $sticky_class = '';
		        if ( in_array($layout, array('v4', 'v5', 'v6', 'v7')) ) {
		        	if ( uomo_get_config('enable_sticky_cart', true) ) {
			        	wp_enqueue_script( 'sticky-kit' );
			        	$main_class = 'product-v-wrapper';
			        	$sticky_class = 'sticky-this';
			        }
		        }
			?>
			<div class="top-content" <?php echo trim($style);?>>
				<?php if($layout == 'v2' || $layout == 'v3'){ ?>
					<div class="container">
				<?php } ?>
					<div class="row top-row <?php echo esc_attr($main_class); ?>">
						<div class="col-md-7 col-xs-12">
							<div class="image-mains clearfix">
								<?php
									/**
									 * woocommerce_before_single_product_summary hook
									 *
									 * @hooked woocommerce_show_product_sale_flash - 10
									 * @hooked woocommerce_show_product_images - 20
									 */
									do_action( 'woocommerce_before_single_product_summary' );
									if($layout == 'v7'){
										uomo_woocommerce_delivery_info();
									}
								?>
							</div>
						</div>
						<div class="col-md-5 col-xs-12 right-info <?php echo esc_attr($sticky_class); ?>">
							<div class="information">
								<div class="summary entry-summary">
									<?php
										/**
										 * woocommerce_single_product_summary hook
										 *
										 * @hooked woocommerce_template_single_title - 5
										 * @hooked woocommerce_template_single_rating - 10
										 * @hooked woocommerce_template_single_price - 10
										 * @hooked woocommerce_template_single_excerpt - 20
										 * @hooked woocommerce_template_single_add_to_cart - 30
										 * @hooked woocommerce_template_single_meta - 40
										 * @hooked woocommerce_template_single_sharing - 50
										 */

										remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

										add_action( 'woocommerce_single_product_summary', 'uomo_product_breadcrumbs_navigation', 1 );
										add_action( 'woocommerce_single_product_summary', 'uomo_product_price_rating_open', 9 );
										add_action( 'woocommerce_single_product_summary', 'uomo_product_price_rating_close', 12 );

										
										if ( uomo_get_config('show_product_review_tab', true) ) {
											add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );
										}

										if ( $layout == 'v4' || $layout == 'v6' || $layout == 'v7' || $layout == 'v9' || $layout == 'v10' ) {
											add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 200 );
										}
										if ( $layout == 'v1' || $layout == 'v2' || $layout == 'v3' || $layout == 'v6' || $layout == 'v8' || $layout == 'v10' || $layout == 'v11' ) {
											add_action( 'woocommerce_single_product_summary', 'uomo_woocommerce_delivery_info', 300 );
										}

										do_action( 'woocommerce_single_product_summary' );
									?>
								</div><!-- .summary -->
							</div>
						</div>
					</div>
				<?php if($layout == 'v2' || $layout == 'v3'){ ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if($layout == 'v2' || $layout == 'v3' || $layout == 'v4'){ ?>
			<div class="container">
		<?php } ?>
			<?php
				/**
				 * woocommerce_after_single_product_summary hook
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				if ( $layout == 'v4' || $layout == 'v6' || $layout == 'v7' || $layout == 'v9' || $layout == 'v10' ) {
					remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
				}
				do_action( 'woocommerce_after_single_product_summary' );
			?>

			<meta itemprop="url" content="<?php the_permalink(); ?>" />
		<?php if($layout == 'v2' || $layout == 'v3' || $layout == 'v4'){ ?>
			</div>
		<?php } ?>
	</div><!-- #product-<?php the_ID(); ?> -->
	<?php if ( uomo_get_config('show_product_sticky_add_to_cart') && $product->get_type() !== 'grouped' ) { ?>
		<div class="add-to-cart-bottom-wrapper hidden-xs hidden-sm">
			<div class="container">
				<div class="flex-middle row">
					<div class="inner-left col-xs-4">
						<div class="flex-middle">
					        <div class="product-image">
					            <?php uomo_product_get_image('uomo-shop-thumbnail', false); ?>
					        </div>
					        <h3 class="name"><?php the_title(); ?></h3>
				        </div>
			        </div>
			        <div class="inner-right col-xs-8">
			        	<div class="pull-right">
			        		<div class="flex-middle">
				        		<?php echo trim($product->get_price_html()); ?>
				        		<?php woocommerce_template_single_add_to_cart(); ?>
			        		</div>
			        	</div>
			        </div>
		        </div>
	        </div>
	    </div>
    <?php } ?>
	<?php do_action( 'woocommerce_after_single_product' ); ?>
</div>