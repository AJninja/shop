<?php


function uomo_dokan_vendor_name() {
    if( !uomo_get_config('dokan_show_vendor_name', true) || !is_singular( 'product' ) ) return;

    global $product;
    $author_id = get_post_field( 'post_author', $product->get_id() ); 
    $author    = get_user_by( 'id', $author_id );

    if ( empty( $author ) ) {
        return;
    }

    $shop_info = get_user_meta( $author_id, 'dokan_profile_settings', true );
    $shop_name = $author->display_name;
    if ( $shop_info && isset( $shop_info['store_name'] ) && $shop_info['store_name'] ) {
        $shop_name = $shop_info['store_name'];
    }

    $sold_by_text = apply_filters( 'vendor_sold_by_text', esc_html__( 'Vendor:', 'uomo' ) );
    ?>
    <div class="sold-by-meta sold-dokan">
        <span class="sold-by-label"><?php echo trim($sold_by_text); ?> </span>
        <a href="<?php echo esc_url( dokan_get_store_url( $author_id ) ); ?>"><?php echo esc_html( $shop_name ); ?></a>
    </div>

    <?php
}

add_action( 'woocommerce_single_product_summary', 'uomo_dokan_vendor_name', 60 );


function uomo_dokan_init() {
    remove_action( 'woocommerce_product_tabs', 'dokan_set_more_from_seller_tab', 10 );
    if( uomo_get_config('dokan_show_more_products', true) ) {
        add_action( 'woocommerce_after_single_product_summary', 'uomo_dokan_get_more_products_from_seller', 12 );
    }
}

add_action( 'init', 'uomo_dokan_init', 10 );

if ( !function_exists('uomo_dokan_get_more_products_from_seller') ) {
    function uomo_dokan_get_more_products_from_seller( $seller_id = 0, $posts_per_page = 6 ) {
        global $product, $post;

        if ( $seller_id == 0 ) {
            $seller_id = $post->post_author;
        }

        if ( ! abs( $posts_per_page ) ) {
            $posts_per_page = apply_filters( 'dokan_get_more_products_per_page', 6 );
        }

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => $posts_per_page,
            'orderby'        => 'rand',
            'post__not_in'   => array( $post->ID ),
            'author'         => $seller_id,
        );

        $products = new WP_Query( $args );

        $columns = uomo_get_config('releated_product_columns', 4);

        if ( $products->have_posts() ) {
            ?>
            <div class="related products widget">
                <div class="woocommerce">
                    <h3 class="widget-title">
                        <?php
                        $allowed_html_array = array( 'strong' => '' );
                        echo wp_kses(__('More Products <strong>From This Vendor</strong>', 'uomo'), $allowed_html_array);
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
                        <?php

                        while ( $products->have_posts() ) {
                            $products->the_post();
                            ?>
                            <div class="item">
                                <?php wc_get_template_part( 'item-product/inner' ); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }

        wp_reset_postdata();
    }
}

function uomo_dokan_seller_product_tab( $tabs) {

    if( !uomo_get_config('dokan_show_vendor_info', true) && isset($tabs['seller']) ) {
        unset( $tabs['seller'] );
    } 

    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'uomo_dokan_seller_product_tab', 20 );