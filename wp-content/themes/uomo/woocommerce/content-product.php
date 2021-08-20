<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

global $product, $woocommerce_loop;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$woo_display = uomo_woocommerce_get_display_mode();
if ( $woo_display == 'metro' ) {
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
	}
	
	$args = array();
	if ( in_array($woocommerce_loop['loop']%12, array(0,7)) ) {
		$classes[] = 'col-md-6 col-sm-6 col-xs-6 isotope-item';
		$args = array('image_size' => 'uomo-shop-large');
	} elseif ( in_array($woocommerce_loop['loop']%12, array(3)) ) {
		$classes[] = 'col-md-6 col-sm-6 col-xs-6 isotope-item';
		$args = array('image_size' => 'uomo-shop-horizontal');
	} else {
		$classes[] = 'col-md-3 col-sm-3 col-xs-6 isotope-item';
		$args = array('image_size' => 'uomo-shop-small');
	}
	?>

	<div <?php wc_product_class( $classes, $product ); ?>>
	 	<?php wc_get_template( 'item-product/inner-metro.php', $args ); ?>
	</div>

<?php
} else {
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
	}
	// Store column count for displaying the grid
	if(!empty($columns)){
		$woocommerce_loop['columns'] = $columns;
	}else{
		$woocommerce_loop['columns'] = uomo_woocommerce_shop_columns(4);
	}
	// Ensure visibility
	if ( ! $product || ! $product->is_visible() ) {
		return;
	}

	$bcol = 12/$woocommerce_loop['columns'];
	if($woocommerce_loop['columns'] == 5){
		$bcol = '5c';
	}
	if($woocommerce_loop['columns'] >=4 ){
		$classes[] = 'col-md-4 col-sm-4 col-xs-6 col-lg-'.$bcol;
	}else{
		$classes[] = 'col-md-'.$bcol.($woocommerce_loop['columns'] > 1 ? ' col-xs-6 ' : '').($woocommerce_loop['columns'] > 2 ? ' col-sm-4 ' : ' col-sm-6');
	}

	$item_style = uomo_get_config('product_item_style', 'v1');
	if ( $item_style == 'v1' ) {
		$item_style = '';
	}
	?>
	<div <?php wc_product_class( $classes, $product ); ?>>
		<?php wc_get_template_part( 'item-product/inner', $item_style ); ?>
	</div>
<?php } ?>