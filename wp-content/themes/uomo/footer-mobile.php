<div class="apus-footer-mobile hidden-md hidden-lg">
	<ul>
		<li>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
				<i class="flaticon-home"></i>
	            <span><?php esc_html_e('Home', 'uomo'); ?></span>
	        </a>
        </li>

    	<?php if ( defined('UOMO_WOOCOMMERCE_ACTIVED') && uomo_get_config('show_footer_shop', true) && !uomo_get_config( 'enable_shop_catalog' )) { 
    		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
    	?>
	    	<li>
	    		<a class="footer-shop" href="<?php echo esc_url($shop_page_url);?>">
		            <i class="flaticon-hanger"></i>
		            <span><?php esc_html_e('Shop', 'uomo'); ?></span>
		        </a> 
	    	</li>
    	<?php } ?>


    	<?php if ( defined('UOMO_WOOCOMMERCE_ACTIVED') && uomo_get_config('show_footer_wishlist', true) && class_exists( 'YITH_WCWL' ) ) { 
    		$wishlist_url = YITH_WCWL()->get_wishlist_url();
    	?>
	    	<li>
	    		<a href="<?php echo esc_url($wishlist_url);?>">
                    <i class="flaticon-heart"></i>
                    <span><?php esc_html_e('Wishlist', 'uomo'); ?></span>
                </a>
	    	</li>
    	<?php } ?>

    	<?php if ( defined('UOMO_WOOCOMMERCE_ACTIVED') && uomo_get_config('show_footer_cartbtn', true) && !uomo_get_config( 'enable_shop_catalog' )) { ?>
	    	<li>
	    		<a class="footer-mini-cart mini-cart" href="<?php echo wc_get_cart_url(); ?>">
		            <i class="flaticon-shopping-bag"></i>
		            <span class="count"><?php echo sprintf(WC()->cart->cart_contents_count); ?></span>
		            <span><?php esc_html_e('Cart', 'uomo'); ?></span>
		        </a> 
	    	</li>
    	<?php } ?>

	</ul>
</div>