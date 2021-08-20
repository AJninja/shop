<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

$columns = 4;

if ( $cross_sells ) : ?>

	<div class="cross_sells products widget">
		<div class="woocommerce">
			<h3 class="widget-title"><?php esc_html_e( 'You may be interested in&hellip;', 'uomo' ) ?></h3>
			
			<div class="slick-carousel products" data-carousel="slick"
			    data-items="<?php echo esc_attr($columns); ?>"
			    data-smallmedium="3"
			    data-extrasmall="2"

			    data-slidestoscroll="<?php echo esc_attr($columns); ?>"
			    data-slidestoscroll_smallmedium="3"
			    data-slidestoscroll_extrasmall="2"

			    data-pagination="false" data-nav="true">

					<?php wc_set_loop_prop( 'loop', 0 ); ?>

					<?php foreach ( $cross_sells as $cross_sell ) : ?>

						<?php
							$post_object = get_post( $cross_sell->get_id() );

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