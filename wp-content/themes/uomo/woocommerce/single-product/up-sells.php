<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$columns = uomo_get_config('upsells_product_columns', 4);

if ( $upsells ) : ?>

	<div class="related products widget">
		<div class="woocommerce">
			<h3 class="widget-title">
				<?php
				$allowed_html_array = array( 'strong' => '' );
				echo wp_kses(__('Up-Sells <strong>Products</strong>', 'uomo'), $allowed_html_array);
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

					<?php foreach ( $upsells as $upsell ) : ?>

						<?php
						$post_object = get_post( $upsell->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

						wc_get_template_part( 'item-product/inner' );

						?>

					<?php endforeach; ?>
			</div>

		</div>
	</div>

	<?php
endif;

wp_reset_postdata();