<?php 
global $product;
$product_id = $product->get_id();
$image_size = isset($image_size) ? $image_size : 'woocommerce_thumbnail';

?>
<div class="product-block grid-v21" data-product-id="<?php echo esc_attr($product_id); ?>">
    <div class="grid-inner">
        <div class="block-inner">
            <figure class="image">
                <?php
                    uomo_product_image($image_size);
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
            </figure>
            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
        <div class="metas clearfix">
            <div class="flex">
                <div class="clearfix">
                    
                    <?php uomo_woo_display_product_cat($product_id); ?>

                    <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php
                        /**
                        * woocommerce_after_shop_loop_item_title hook
                        *
                        * @hooked woocommerce_template_loop_rating - 5
                        * @hooked woocommerce_template_loop_price - 10
                        */
                        remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
                        do_action( 'woocommerce_after_shop_loop_item_title');
                    ?>    
                </div>
                <div class="ali-right">
                    <?php
                        if ( class_exists( 'YITH_WCWL' ) ) {
                            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>