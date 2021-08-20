<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$show_product_releated = uomo_get_config('show_product_releated', true);
if ( !$show_product_releated  ) {
    return;
}

$columns = uomo_get_config('releated_product_columns', 4);

if ( $related_products ) : ?>

	<div class="related products widget">
		<div class="woocommerce">
			<h3 class="widget-title">
				<?php
				$allowed_html_array = array( 'strong' => '' );
				echo wp_kses(__('Related <strong>Products</strong>', 'uomo'), $allowed_html_array);
				?>
			</h3>
			
			<div class="slick-carousel products" data-carousel="slick"
			    data-items="<?php echo esc_attr($columns); ?>"
			    data-smallmedium="3"
			    data-extrasmall="2"

			    data-slidestoscroll="<?php echo esc_attr($columns); ?>"
			    data-slidestoscroll_smallmedium="3"
			    data-slidestoscroll_extrasmall="2"

			    data-pagination="false" data-nav="true">

					<?php wc_set_loop_prop( 'loop', 0 ); ?>

					<?php foreach ( $related_products as $related_product ) : ?>
							<div class="item">
								<?php
								$post_object = get_post( $related_product->get_id() );

								setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

								wc_get_template_part( 'item-product/inner' );

								?>
							</div>
					<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
endif;

wp_reset_postdata();