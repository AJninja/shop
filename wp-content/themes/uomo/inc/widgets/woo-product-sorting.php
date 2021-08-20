<?php


if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists('WC_Widget') ) {
	return;
}

class Uomo_Widget_Woo_Product_Sorting extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    	= 'apus_widget apus_widget_product_sorting woocommerce';
		$this->widget_description	= esc_html__( 'Display a product sorting list.', 'uomo' );
		$this->widget_id          	= 'apus_woocommerce_widget_product_sorting';
		$this->widget_name        	= esc_html__( 'Apus WooCommerce Product Sorting', 'uomo' );
		$this->settings           	= array(
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Sort By', 'uomo' ),
				'label'	=> esc_html__( 'Title', 'uomo' )
			)
		);
		
		parent::__construct();
	}

	public function getTemplate() {
		return 'woo-product-sorting.php';
	}
	/**
	 * Widget function
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {
		global $wp_query;
		
		extract( $args );
		
		$title = ( ! empty( $instance['title'] ) ) ? $before_title . $instance['title'] . $after_title : '';
		
		$output = '';
		
		if ( 1 != $wp_query->found_posts || woocommerce_products_will_display() ) {
			$output .= '<div class="wrapper-limit">';
			$output .= '<ul id="apus-product-sorting" class="apus-product-sorting">';
			
			$orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
			$orderby == ( $orderby ===  'title' ) ? 'menu_order' : $orderby; // Fixed: 'title' is default before WooCommerce settings are saved
			
			$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
				'menu_order'	=> esc_html__( 'Default', 'uomo' ),
				'popularity' 	=> esc_html__( 'Popularity', 'uomo' ),
				'rating'     	=> esc_html__( 'Average rating', 'uomo' ),
				'date'       	=> esc_html__( 'Newness', 'uomo' ),
				'price'      	=> esc_html__( 'Price: Low to High', 'uomo' ),
				'price-desc'	=> esc_html__( 'Price: High to Low', 'uomo' )
			) );
	
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
				unset( $catalog_orderby_options['rating'] );
			}
			
			
			/* Build entire current page URL (including query strings) */
			global $wp;
			$link = home_url( $wp->request ); // Base page URL
					
			// Unset query strings used for Ajax shop filters
			unset( $_GET['shop_load'] );
			unset( $_GET['_'] );
			
			$qs_count = count( $_GET );
			
			// Any query strings to add?
			if ( $qs_count > 0 ) {
				$i = 0;
				$link .= '?';
				
				// Build query string
				foreach ( $_GET as $key => $value ) {
					$i++;
					$link .= $key . '=' . $value;
					if ( $i != $qs_count ) {
						$link .= '&';
					}
				}
			}
			
			
            foreach ( $catalog_orderby_options as $id => $name ) {
				if ( $orderby == $id ) {
					$output .= '<li class="active">' . esc_attr( $name ) . '</li>';
				} else {
					// Add 'orderby' URL query string
					$link = add_query_arg( 'orderby', $id, $link );
					$output .= '<li><a href="' . esc_url( $link ) . '">' . esc_attr( $name ) . '</a></li>';
				}
            }
			       
        	$output .= '</ul>';
        	$output .= '</div>';
		}
		
		echo trim($before_widget . $title . $output . $after_widget);
	}
	
}
if ( function_exists('apus_framework_reg_widget') ) {
    apus_framework_reg_widget('Uomo_Widget_Woo_Product_Sorting');
}