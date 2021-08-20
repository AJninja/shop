<?php

if ( !function_exists('uomo_get_products') ) {
    function uomo_get_products( $args = array() ) {
        global $woocommerce, $wp_query;

        $args = wp_parse_args( $args, array(
            'categories' => array(),
            'product_type' => 'recent_product',
            'paged' => 1,
            'post_per_page' => -1,
            'orderby' => '',
            'order' => '',
            'includes' => array(),
            'excludes' => array(),
            'author' => '',
        ));
        extract($args);
        
        $query_args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        if ( isset( $query_args['orderby'] ) ) {
            if ( 'price' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_price',
                    'orderby'   => 'meta_value_num'
                ) );
            }
            if ( 'featured' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_featured',
                    'orderby'   => 'meta_value'
                ) );
            }
            if ( 'sku' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_sku',
                    'orderby'   => 'meta_value'
                ) );
            }
        }

        switch ($product_type) {
            case 'best_selling':
                $query_args['meta_key']='total_sales';
                $query_args['orderby']='meta_value_num';
                $query_args['ignore_sticky_posts']   = 1;
                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'featured_product':
                $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['featured'],
                );
                break;
            case 'top_rate':
                //add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'recent_product':
                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                break;
            case 'deals':
                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $query_args['meta_query'][] =  array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => time(),
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                );
                break;     
            case 'on_sale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $query_args['post__in'] = $product_ids_on_sale;
                break;
            case 'recent_review':
                if($post_per_page == -1) $_limit = 4;
                else $_limit = $post_per_page;
                global $wpdb;
                $query = "SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c
                        WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0
                        ORDER BY c.comment_date ASC";
                $results = $wpdb->get_results($query, OBJECT);
                $_pids = array();
                foreach ($results as $re) {
                    if(!in_array($re->comment_post_ID, $_pids))
                        $_pids[] = $re->comment_post_ID;
                    if(count($_pids) == $_limit)
                        break;
                }

                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $query_args['post__in'] = $_pids;

                break;
            case 'rand':
                $query_args['orderby'] = 'rand';
                break;
            case 'recommended':

                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = array(
                    'key' => '_apus_recommended',
                    'value' => 'yes',
                );
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'recently_viewed':
                $viewed_products = ! empty( $_COOKIE['apus_woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['apus_woocommerce_recently_viewed'] ) : array();
                $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

                if ( empty( $viewed_products ) ) {
                    return false;
                }
                $query_args['post__in'] = $viewed_products;
                break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $query_args['tax_query'][] = array(
                'taxonomy'      => 'product_cat',
                'field'         => 'slug',
                'terms'         => $categories,
                'operator'      => 'IN'
            );
        }

        if (!empty($includes) && is_array($includes)) {
            $query_args['post__in'] = $includes;
        }
        
        if ( !empty($excludes) && is_array($excludes) ) {
            $query_args['post__not_in'] = $excludes;
        }

        if ( !empty($author) ) {
            $query_args['author'] = $author;
        }
        if ( $product_type == 'top_rate' && class_exists('WC_Shortcode_Products') ) {
            add_filter( 'posts_clauses', array( 'WC_Shortcode_Products', 'order_by_rating_post_clauses' ) );
            $loop = new WP_Query($query_args);
            call_user_func( implode('_', array('remove', 'filter')), 'posts_clauses', array( 'WC_Shortcode_Products', 'order_by_rating_post_clauses' ) );
        } else {
            $loop = new WP_Query($query_args);
        }
        return $loop;
    }
}

// add product viewed
function uomo_track_product_view() {
    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $post;

    if ( empty( $_COOKIE['apus_woocommerce_recently_viewed'] ) )
        $viewed_products = array();
    else
        $viewed_products = (array) explode( '|', $_COOKIE['apus_woocommerce_recently_viewed'] );

    if ( ! in_array( $post->ID, $viewed_products ) ) {
        $viewed_products[] = $post->ID;
    }

    if ( sizeof( $viewed_products ) > 15 ) {
        array_shift( $viewed_products );
    }

    // Store for session only
    wc_setcookie( 'apus_woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}
add_action( 'template_redirect', 'uomo_track_product_view', 20 );

function uomo_woocommerce_enqueue_scripts() {
    wp_enqueue_script( 'selectWoo' );
    wp_enqueue_style( 'select2' );
    
    wp_register_script( 'sticky-kit', get_template_directory_uri() . '/js/sticky-kit.min.js', array( 'jquery' ), '20150330', true );

    wp_enqueue_script( 'uomo-quantity-increment', get_template_directory_uri() . '/js/wc-quantity-increment.js', array( 'jquery' ), '20150330', true );
    wp_register_script( 'uomo-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'jquery-unveil', 'slick' ), '20150330', true );

    $ajax_url = add_query_arg( 'wc-ajax', '%%endpoint%%', trailingslashit( site_url() ) );

    $options = array(
        'ajaxurl' => $ajax_url,
        'enable_search' => (uomo_get_config('enable_autocompleate_search', true) ? '1' : '0'),
        'empty_msg' => apply_filters( 'uomo_autocompleate_search_empty_msg', esc_html__( 'Unable to find any products that match the currenty query', 'uomo' ) ),
        'nonce' => wp_create_nonce( 'ajax-nonce' ),
        '_preset' => uomo_get_demo_preset()
    );
    wp_localize_script( 'uomo-woocommerce', 'uomo_woo_opts', $options );
    wp_enqueue_script( 'uomo-woocommerce' );
    
    if (uomo_get_config('show_quickview', false)) {
        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'uomo_woocommerce_enqueue_scripts', 10 );

// cart
if ( !function_exists('uomo_woocommerce_header_add_to_cart_fragment') ) {
    function uomo_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['.cart .count'] =  ' <span class="count"> '. $woocommerce->cart->cart_contents_count .' </span> ';
        $fragments['.footer-mini-cart .count'] =  ' <span class="count"> '. $woocommerce->cart->cart_contents_count .' </span> ';
        $fragments['.cart .total-minicart'] = '<div class="total-minicart">'. $woocommerce->cart->get_cart_total(). '</div>';
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'uomo_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('uomo_woocommerce_breadcrumb_defaults') ) {
    function uomo_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = uomo_get_config('woo_breadcrumb_image');
        $breadcrumb_color = uomo_get_config('woo_breadcrumb_color');
        $style = $classes = array();
        $show_breadcrumbs = uomo_get_config('show_product_breadcrumbs', true);

        if ( !$show_breadcrumbs ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        
        if ( !empty($breadcrumb_img['id']) ) {
            $img = wp_get_attachment_image_src($breadcrumb_img['id'], 'full');
            if ( !empty($img[0]) ) {
                $style[] = 'background-image:url(\''.esc_url($img[0]).'\')';
                $classes[] = 'has_bg';
            }
        }

        $estyle = !empty($style) ? ' style="'.implode(";", $style).'"':"";
        if ( is_single() ) {
            $classes[] = 'woo-detail';
        }

        $full_width = apply_filters('uomo_woocommerce_content_class', 'clearfix');
        
        // check woo
        if(is_product()){
            $title = '';
        }else{
            $title = '<div class="breadscrumb-inner hidden-icon"><h2 class="bread-title">'.esc_html__( 'Shop', 'uomo' ).'</h2></div>';
        }

        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb woo-breadcrumb '.esc_attr(!empty($classes) ? implode(' ', $classes) : '').'"'.$estyle.'><div class="'.$full_width.'"><div class="wrapper-breads"><div class="wrapper-breads-inner">'.$title.'
        <ol class="breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'uomo_woocommerce_breadcrumb_defaults' );
add_action( 'uomo_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );


if ( !function_exists('uomo_woocommerce_get_display_mode') ) {
    function uomo_woocommerce_get_display_mode() {
        $woo_mode = uomo_get_config('product_display_mode', 'grid');
        return $woo_mode;
    }
}

// add filter to top archive
add_action( 'woocommerce_top_pagination', 'woocommerce_pagination', 1 );


add_action( 'wc_ajax_uomo_ajax_get_products', 'uomo_woocommerce_get_ajax_products' );
function uomo_woocommerce_get_ajax_products() {
    $settings = isset($_POST['settings']) ? $_POST['settings'] : '';

    $tab = isset($_POST['tab']) ? $_POST['tab'] : '';
    
    if ( empty($settings) || empty($tab) ) {
        exit();
    }

    $woo_product_tabs_special = !empty($settings['woo_product_tabs_special']) ? true : false;

    $slugs = !empty($tab['slugs']) ? array_map('trim', explode(',', $tab['slugs'])) : array();

    $columns = isset($settings['columns']) ? $settings['columns'] : 4;
    $columns_tablet = isset($settings['columns_tablet']) ? $settings['columns_tablet'] : 4;
    $columns_mobile = isset($settings['columns_mobile']) ? $settings['columns_mobile'] : 4;
    $slides_to_scroll = isset($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : 4;
    $slides_to_scroll_tablet = isset($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : 4;
    $slides_to_scroll_mobile = isset($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : 4;
    $autoplay = isset($settings['autoplay']) ? $settings['autoplay'] : false;
    $infinite_loop = isset($settings['infinite_loop']) ? $settings['infinite_loop'] : false;
    $product_item = isset($settings['product_item']) ? $settings['product_item'] : false;

    $rows = isset($settings['rows']) ? $settings['rows'] : 1;
    $show_nav = isset($settings['show_nav']) ? $settings['show_nav'] : false;
    $show_pagination = isset($settings['show_pagination']) ? $settings['show_pagination'] : false;
    $limit = isset($settings['limit']) ? $settings['limit'] : 4;
    $product_type = isset($tab['type']) ? $tab['type'] : 'recent_product';

    $layout_type = isset($settings['layout_type']) ? $settings['layout_type'] : 'grid';

    $excludes = array();
    if ( $woo_product_tabs_special ) {
        ?>
        <div class="row">
            <?php
            $col_class_second = 12;
            if ( !empty($tab['product_id']) ) {
                $post_object = get_post( $tab['product_id'] );
                if ( $post_object ) {
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    $special_product_item = !empty($tab['product_item']) ? $tab['product_item'] : 'inner';
                    $col_class_second = 7;
                    $excludes[] = $tab['product_id'];
                    ?>
                        <div class="col-md-5 col-xs-12 primary">
                            <div <?php wc_product_class( '', $post_object ); ?>>
                                <?php wc_get_template( 'item-product/'.$special_product_item.'.php', array(
                                    'end_date' => !empty($tab['end_date']) ? $tab['end_date'] : '',
                                    'available' => !empty($tab['available']) ? $tab['available'] : '',
                                    'already_sold' => !empty($tab['already_sold']) ? $tab['already_sold'] : '',
                                    'image_size' => 'uomo-shop-special',
                                )  ); ?>
                            </div>
                        </div>
                    <?php
                    wp_reset_postdata();
                }
            ?>
                
            <?php } ?>
            <div class="col-md-<?php echo esc_attr($col_class_second); ?> col-xs-12">
            <?php
    }

    $args = array(
        'categories' => $slugs,
        'product_type' => $product_type,
        'paged' => 1,
        'post_per_page' => $limit,
        'excludes' => $excludes,
    );

    $loop = uomo_get_products( $args );
    if ( $loop->have_posts() ) {
        $max_pages = $loop->max_num_pages;
        wc_get_template( 'layout-products/'.$layout_type.'.php' , array(
            'loop' => $loop,
            'columns' => $columns,
            'columns_tablet' => $columns_tablet,
            'columns_mobile' => $columns_mobile,
            'slides_to_scroll' => $slides_to_scroll,
            'slides_to_scroll_tablet' => $slides_to_scroll_tablet,
            'slides_to_scroll_mobile' => $slides_to_scroll_mobile,
            'show_nav' => $show_nav,
            'show_pagination' => $show_pagination,
            'autoplay' => $autoplay,
            'infinite_loop' => $infinite_loop,
            'rows' => $rows,
            'product_item' => $product_item,
            'slick_top' => 'slick-carousel-top',
        ) );
    }

    if ( $woo_product_tabs_special ) {
        ?>
            </div>
        </div>
        <?php
    }
    exit();
}

// quickview
add_action( 'wc_ajax_uomo_quickview_product', 'uomo_woocommerce_quickview' );
if ( !function_exists('uomo_woocommerce_quickview') ) {
    function uomo_woocommerce_quickview() {
        if ( !empty($_GET['product_id']) ) {
            $post_object = get_post( $_GET['product_id'] );
            if ( $post_object ) {
                setup_postdata( $GLOBALS['post'] =& $post_object );

                wc_get_template_part( 'content', 'product-quickview' );
            }
            wp_reset_postdata();
        }
        die;
    }
}

// Number of products per page
if ( !function_exists('uomo_woocommerce_shop_per_page') ) {
    function uomo_woocommerce_shop_per_page($number) {
        
        if ( isset( $_REQUEST['wppp_ppp'] ) ) :
            $number = intval( $_REQUEST['wppp_ppp'] );
            WC()->session->set( 'products_per_page', intval( $_REQUEST['wppp_ppp'] ) );
        elseif ( isset( $_REQUEST['ppp'] ) ) :
            $number = intval( $_REQUEST['ppp'] );
            WC()->session->set( 'products_per_page', intval( $_REQUEST['ppp'] ) );
        elseif ( WC()->session->__isset( 'products_per_page' ) ) :
            $number = intval( WC()->session->__get( 'products_per_page' ) );
        else :
            $value = uomo_get_config('number_products_per_page', 12);
            $number = intval( $value );
        endif;
        
        return $number;

    }
}
add_filter( 'loop_shop_per_page', 'uomo_woocommerce_shop_per_page', 30 );

// Number of products per row
if ( !function_exists('uomo_woocommerce_shop_columns') ) {
    function uomo_woocommerce_shop_columns($number) {
        $value = uomo_get_config('product_columns');
        if ( in_array( $value, array(1, 2, 3, 4, 5, 6, 7, 8) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'uomo_woocommerce_shop_columns' );

// share box
if ( !function_exists('uomo_woocommerce_share_box') ) {
    function uomo_woocommerce_share_box() {
        if ( uomo_get_config('show_product_social_share', false) ) {
            get_template_part( 'template-parts/sharebox' );
        }
    }
}

function uomo_woocomerce_wishlist_share_wrapper_open( $value='' ){
    echo '<div class="clearfix wishlist-share-wrapper">';
}

function uomo_woocomerce_wishlist_share_wrapper_close() {
    echo '</div>';
}


// add div top infor for detail
function uomo_product_price_rating_open() {
    ?>
    <div class="price-rating-wrapper clearfix">
    <?php
}
function uomo_product_price_rating_close() {
    ?>
    </div>
    <?php
}
function uomo_woo_clearfix_addcart() {
    ?>
    <div class="clearfix"></div>
    <?php
}



add_filter( 'woocommerce_single_product_summary', 'uomo_woo_clearfix_addcart', 39 );
// shipping infomation
if ( !function_exists('uomo_woocommerce_delivery_info') ) {
    function uomo_woocommerce_delivery_info() {
        echo '<div class="delivery-shipping-info">';
        $delivery_title = uomo_get_config('product_delivery_title');
        $delivery_info = uomo_get_config('product_delivery_info');
        if ( !empty($delivery_title) || !empty($delivery_info) ) {
            echo '<div class="item">';
                echo '<a class="item-btn" href="#delivery_info_wrapper"><span class="title">'.trim($delivery_title).'</span></a>';
                echo '<div id="delivery_info_wrapper" class="mfp-hide info_wrapper_alert" data-effect="fadeIn">';
                echo '<span class="title">'.trim($delivery_title).'</span>';
                echo '<div class="inner">'.trim($delivery_info).'</div>';
                echo '</div>';
            echo '</div>';
        }

        $shipping_title = uomo_get_config('product_shipping_title');
        $shipping_info = uomo_get_config('product_shipping_info');
        if ( !empty($shipping_title) || !empty($shipping_info) ) {
            echo '<div class="item">';
                echo '<a class="item-btn" href="#shipping_info_wrapper"><span class="title">'.trim($shipping_title).'</a>';
                echo '<div id="shipping_info_wrapper" class="mfp-hide info_wrapper_alert" data-effect="fadeIn">';
                echo '<span class="title">'.trim($shipping_title).'</span>';
                echo '<div class="inner">'.trim($shipping_info).'</div>';
                echo '</div>';
            echo '</div>';
        }

        $composition_title = uomo_get_config('product_composition_title');
        $composition_info = uomo_get_config('product_composition_info');
        if ( !empty($composition_title) || !empty($composition_info) ) {
            echo '<div class="item">';
                echo '<a class="item-btn" href="#composition_info_wrapper"><span class="title">'.trim($composition_title).'</a>';
                echo '<div id="composition_info_wrapper" class="mfp-hide info_wrapper_alert" data-effect="fadeIn">';
                echo '<span class="title">'.trim($composition_title).'</span>';
                echo '<div class="inner">'.trim($composition_info).'</div>';
                echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }
}

function uomo_product_get_layout_type() {
    global $post;
    $layout = get_post_meta($post->ID, 'apus_product_layout_type', true);
                    
    if ( empty($layout) ) {
        $layout = uomo_get_config('product_single_version', 'v1');
    }
    return $layout;
}


function uomo_woo_display_product_cat($product_id) {
    $terms = get_the_terms( $product_id, 'product_cat' );
    if ( !empty($terms) && !empty($terms[0]) ) { ?>
        <div class="product-cat">
        <?php
            $term = $terms[0];
            echo '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>';
        ?>
        </div>
    <?php
    }
}


// Wishlist
add_filter( 'yith_wcwl_add_to_wishlist_icon_html', 'uomo_woocomerce_icon_wishlist'  );

function uomo_woocomerce_icon_wishlist( $value='' ){
    return '<span class="heart-icon"><i class="ti-heart"></i></span>';
}


function uomo_yith_wcwl_positions($positions) {
    if ( isset($positions['add-to-cart']['hook']) ) {
        $positions['add-to-cart']['hook'] = 'woocommerce_single_product_summary';
        $positions['add-to-cart']['priority'] = 35;
    }
    return $positions;
}
add_filter( 'yith_wcwl_positions', 'uomo_yith_wcwl_positions', 100 );


function uomo_product_breadcrumbs_navigation() {
    ?>
    <div class="breadcrumb-navigation-wrapper">
        <?php woocommerce_breadcrumb(); ?>
        <div class="product-navs">
            <?php
                the_post_navigation( array(
                    'next_text' => '<span>' . esc_html__( 'Next', 'uomo' ) . '</span> <i class="flaticon-next"></i>',
                    'prev_text' => '<i class="flaticon-back"></i> <span>' . esc_html__( 'Prevs', 'uomo' ) . '</span>',
                ) );
            ?>
        </div>
    </div>
    <?php
}



// swap effect
if ( !function_exists('uomo_swap_images') ) {
    function uomo_swap_images() {
        $thumb = apply_filters('uomo_swap_images_thumb', 'woocommerce_thumbnail');
        $swap_image = (bool)uomo_get_config('enable_swap_image', true);
        ?>
        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
            <?php uomo_product_get_image($thumb, $swap_image); ?>
        </a>
        <?php
    }
}
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

if ( !function_exists('uomo_product_image') ) {
    function uomo_product_image($thumb = 'woocommerce_thumbnail') {
        $swap_image = (bool)uomo_get_config('enable_swap_image', true);
        ?>
        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
            <?php uomo_product_get_image($thumb, $swap_image); ?>
        </a>
        <?php
    }
}
// get image
if ( !function_exists('uomo_product_get_image') ) {
    function uomo_product_get_image($thumb = 'woocommerce_thumbnail', $swap = true) {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = "attachment-$thumb size-$thumb image-no-effect";
        if (has_post_thumbnail()) {
            if ( $swap ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = "attachment-$thumb size-$thumb image-hover";
                    $swap_class = "attachment-$thumb size-$thumb image-effect";
                    $output .= uomo_get_attachment_thumbnail( $attachment_ids[0], $thumb , false, array('class' => $swap_class), false);
                }
            }
            $output .= uomo_get_attachment_thumbnail( get_post_thumbnail_id(), $thumb , false, array('class' => $class), false);
        } else {
            $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_attr__('Placeholder' , 'uomo').'" class="'.$class.'"/>';
        }
        echo trim($output);
    }
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


function uomo_wc_get_gallery_image_html_simple( $attachment_id, $main_image = false ) {
    $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
    $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
    $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
    $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
    $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
    $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
    $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
    
    
    $img = uomo_get_attachment_thumbnail($attachment_id, $image_size);
    return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '">' . $img . '</a></div>';
}

// layout class for woo page
if ( !function_exists('uomo_woocommerce_content_class') ) {
    function uomo_woocommerce_content_class( $class ) {
        if( uomo_get_config('product_archive_fullwidth') ) {
            return 'container-fluid max-1800';
        }
        return $class;
    }
}
add_filter( 'uomo_woocommerce_content_class', 'uomo_woocommerce_content_class' );

// get layout configs
if ( !function_exists('uomo_get_woocommerce_layout_configs') ) {
    function uomo_get_woocommerce_layout_configs() {
        $left = uomo_get_config('product_archive_left_sidebar');
        $right = uomo_get_config('product_archive_right_sidebar');
        // check full width
        if( uomo_get_config('product_archive_fullwidth') ) {
            $sidebar = 'col-lg-2';
            $main_full = 'col-lg-10';
        }else{
            $sidebar = 'col-lg-3';
            $main_full = 'col-lg-9';
        }
        switch ( uomo_get_config('product_archive_layout') ) {
            case 'left-main':
                if ( is_active_sidebar( $left ) ) {
                    $configs['left'] = array( 'sidebar' => $left, 'class' => $sidebar.' col-md-3 col-sm-12 col-xs-12 shop-sidebar-left-wrapper'  );
                    $configs['main'] = array( 'class' => $main_full.' col-md-9 col-sm-12 col-xs-12' );
                }
                break;
            case 'main-right':
                if ( is_active_sidebar( $right ) ) {
                    $configs['right'] = array( 'sidebar' => $right,  'class' => $sidebar.' col-md-3 col-sm-12 col-xs-12 shop-sidebar-right-wrapper' ); 
                    $configs['main'] = array( 'class' => $main_full.' col-md-9 col-sm-12 col-xs-12' );
                }
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
            default:
                if (is_active_sidebar( 'sidebar-default' ) && !is_shop() && !is_single() ) {
                    $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
                    $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
                } else {
                    $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                }
                break;
        }

        if ( empty($configs) ) {
            if (is_active_sidebar( 'sidebar-default' ) && !is_shop() && !is_single() ) {
                $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
            } else {
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
            }
        }

        return $configs; 
    }
}

if ( !function_exists( 'uomo_product_review_tab' ) ) {
    function uomo_product_review_tab($tabs) {
        global $post;
        if ( !uomo_get_config('show_product_review_tab', true) && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }

        if ( !uomo_get_config('hidden_product_additional_information_tab', false) && isset($tabs['additional_information']) ) {
            unset( $tabs['additional_information'] ); 
        }
        
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'uomo_product_review_tab', 90 );


// Loop
/*
 * Start for only Uomo theme
 */
function uomo_is_ajax_request() {
    if ( isset( $_REQUEST['load_type'] ) ) {
        return true;
    }
    return false;
}

function uomo_wc_product_dropdown_categories( $args = array() ) {
    global $wp_query;

    $current_product_cat = isset( $wp_query->query_vars['product_cat'] ) ? $wp_query->query_vars['product_cat'] : '';
    $defaults            = array(
        'pad_counts'         => 1,
        'show_count'         => 1,
        'hierarchical'       => 1,
        'hide_empty'         => 1,
        'show_uncategorized' => 1,
        'orderby'            => 'name',
        'selected'           => $current_product_cat,
        'menu_order'         => false,
        'option_select_text' => esc_html__( 'All', 'uomo' ),
    );

    $args = wp_parse_args( $args, $defaults );

    if ( 'order' === $args['orderby'] ) {
        $args['menu_order'] = 'asc';
        $args['orderby']    = 'name';
    }

    $terms = get_terms( 'product_cat', apply_filters( 'wc_product_dropdown_categories_get_terms_args', $args ) );

    if ( empty( $terms ) ) {
        return;
    }
    $shop_page_id = wc_get_page_id( 'shop' );
    $shopurl = esc_url ( get_permalink( $shop_page_id ) );

    $count_products = wp_count_posts('product');
    
    $count = 0;
    if ( !empty($count_products) ) {
        $count = (int)$count_products->publish;
    }

    $output  = "<ul>";
    $output .= '<li ' . ( $current_product_cat == '' ? 'class="active"' : '' ) . '>'
            . '<a href="'.esc_url($shopurl).'">'
            . esc_html( $args['option_select_text'] ) . ' ('.$count.')' 
            . '</a>'
            . '</li>';
    $output .= uomo_wc_walk_category_dropdown_tree( $terms, 0, $args );
    $output .= "</ul>";

    echo trim($output);
}

function uomo_wc_walk_category_dropdown_tree() {
    $args = func_get_args();

    // the user's options are the third parameter
    if ( empty( $args[2]['walker'] ) || ! is_a( $args[2]['walker'], 'Walker' ) ) {
        $walker = new Uomo_WC_Product_Cat_Dropdown_Walker;
    } else {
        $walker = $args[2]['walker'];
    }

    return call_user_func_array( array( &$walker, 'walk' ), $args );
}


function uomo_get_product_categories($args) {
    $transient_key = 'uomo-product-categories'.md5(json_encode($args));
    if ( false === ( $categories = get_transient( $transient_key ) ) ) {
 
        $categories = get_categories( $args );
 
        // do not set an empty transient - should help catch private or empty accounts.
        if ( ! empty( $categories ) ) {
            $categories = call_user_func( implode('_', array('base64', 'encode')), serialize( $categories ) );
            set_transient( $transient_key, $categories, apply_filters( 'null_categories_cache_time', 0 ) );
        }
    }
    if ( ! empty( $categories ) ) {
        return unserialize( call_user_func( implode('_', array('base64', 'decode')), $categories ) );
    }

    return false;
}

function uomo_edit_product_term($term_id, $tt_id, $taxonomy) {
    $term = get_term($term_id,$taxonomy);
    if (!is_wp_error($term) && is_object($term)) {
        $taxonomy = $term->taxonomy;
        if ($taxonomy == "product_cat") {
            uomo_delete_transients_with_prefix( 'uomo-product-categories' );
        }
    }
}
 
function uomo_delete_product_term($term_id, $tt_id, $taxonomy, $deleted_term) {
    if (!is_wp_error($deleted_term) && is_object($deleted_term)) {
        $taxonomy = $deleted_term->taxonomy;
        if ($taxonomy == "product_cat") {
            uomo_delete_transients_with_prefix( 'uomo-product-categories' );
        }
    }
}
add_action( 'create_term', 'uomo_edit_product_term', 99, 3 );
add_action( 'edit_term', 'uomo_edit_product_term', 99, 3 );
add_action( 'delete_term', 'uomo_delete_product_term', 99, 4 );
 
add_action( 'save_post', 'uomo_save_post_action', 99, 3);
function uomo_save_post_action( $post_id ){

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if (!current_user_can( 'edit_page', $post_id ) ) return;
 
    $post_info = get_post($post_id);
 
    if (!is_wp_error($post_info) && is_object($post_info)) {
        if ($post_info->post_type == "product") {
            uomo_delete_transients_with_prefix( 'uomo-product-categories' );
        }
    }
}

function uomo_delete_transients_with_prefix( $prefix ) {
    foreach ( uomo_get_transient_keys_with_prefix( $prefix ) as $key ) {
        delete_transient( $key );
    }
}

function uomo_get_transient_keys_with_prefix( $prefix ) {
    global $wpdb;

    $prefix = $wpdb->esc_like( '_transient_' . $prefix );
    $sql = "SELECT `option_name` FROM $wpdb->options WHERE `option_name` LIKE '%s'";
    $keys = $wpdb->get_results( $wpdb->prepare( $sql, $prefix . '%' ), ARRAY_A );

    if ( is_wp_error( $keys ) ) {
        return [];
    }
    return array_map( function( $key ) {
        return ltrim( $key['option_name'], '_transient_' );
    }, $keys );
}

function uomo_category_menu_create_list( $category, $current_cat_id, $display_type = '' ) {
    $output = '<li class="cat-item-' . $category->term_id;
                    
    if ( $current_cat_id == $category->term_id ) {
        $output .= ' current-cat';
    }
    
    $output .=  '"><a href="' . esc_url( get_term_link( (int) $category->term_id, 'product_cat' ) ) . '">';

    if ( $display_type == 'image' ) {
        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
        $output .= '<div class="icon-wrapper icon-image-wrapper">';
            if ( $thumbnail_id ) {
                $output .= uomo_get_attachment_thumbnail($thumbnail_id, 'thumbnail');
            } else {
                $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_attr__('Placeholder' , 'uomo').'" />';
            }
        $output .= '</div>';
        $output .= '<h5>'. esc_attr( $category->name ) .'</h5>';
    } elseif ( $display_type == 'icon' ) {
        $font_icon = get_term_meta( $category->term_id, 'font_icon', true );
        if ( $font_icon ) {
            $output .= '<div class="icon-wrapper"><i class="'. esc_attr( $font_icon ) .'"></i></div>';
        }
        $output .= '<h5>'. esc_attr( $category->name ) .'</h5>';
    } else {
        $output .= esc_attr( $category->name );
    }

    $output .=  '</a></li>';
    
    return $output;
}

/*
 *  Product category menu
 */
if ( ! function_exists( 'uomo_category_menu' ) ) {
    function uomo_category_menu($display_type = '') {
        global $wp_query;

        $current_cat_id = ( is_tax( 'product_cat' ) ) ? $wp_query->queried_object->term_id : '';
        $is_category = ( strlen( $current_cat_id ) > 0 ) ? true : false;
        $hide_empty = true;
        $shop_categories_top_level = true;
        // Should top-level categories be displayed?
        if ( !$shop_categories_top_level && $is_category ) {
            uomo_sub_category_menu_output( $current_cat_id, $hide_empty );
        } else {
            uomo_category_menu_output( $is_category, $current_cat_id, $hide_empty, $display_type);
        }
    }
}


/*
 *  Product category menu: Output
 */
function uomo_category_menu_output( $is_category, $current_cat_id, $hide_empty, $display_type = '' ) {
    global $wp_query;
    
    $page_id = wc_get_page_id( 'shop' );
    $page_url = get_permalink( $page_id );
    $hide_sub = true;
    $all_categories_class = '';
    
    // Is this a category page?                                                             
    if ( $is_category ) {
        $hide_sub = true;
        
        // Get current category's direct children
        $direct_children = get_terms( 'product_cat',
            array(
                'fields'        => 'ids',
                'parent'        => $current_cat_id,
                'hierarchical'  => true,
                'hide_empty'    => $hide_empty
            )
        );
        
        $category_has_children = ( empty( $direct_children ) ) ? false : true;
    } else {
        // No current category, set "All" as current (if not product tag archive or search)
        if ( ! is_product_tag() && ! isset( $_REQUEST['s'] ) ) {
            $all_categories_class = ' class="current-cat"';
        }
    }
    
    $output = '<li' . $all_categories_class . '><a href="' . esc_url ( $page_url ) . '">';
    if ( $display_type == 'image' ) {
        $thumbnail = uomo_get_config( 'shop_top_categories_all_image' );
        $output .= '<div class="icon-wrapper icon-image-wrapper">';
            if ( !empty($thumbnail['id']) ) {
                $output .= uomo_get_attachment_thumbnail($thumbnail['id'], 'thumbnail');
            } else {
                $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_attr__('Placeholder' , 'uomo').'" />';
            }
        $output .= '</div>';
        $output .= '<h5>'. esc_html__( 'All', 'uomo' ) .'</h5>';
    } elseif ( $display_type == 'icon' ) {
        $font_icon = uomo_get_config( 'shop_top_categories_all_icon' );
        if ( $font_icon ) {
            $output .= '<div class="icon-wrapper"><i class="'. esc_attr( $font_icon ) .'"></i></div>';
        }
        $output .= '<h5>'. esc_html__( 'All', 'uomo' ) .'</h5>';
    } else {
        $output .= esc_html__( 'All', 'uomo' );
    }
    $output .= '</a></li>';


    $sub_output = '';
    
    // Categories order
    
    $categories = uomo_get_product_categories( array(
        'type'          => 'post',
        'orderby'       => 'name', // Note: 'name' sorts by product category "menu/sort order"
        'order'         => 'asc',
        'hide_empty'    => $hide_empty,
        'hierarchical'  => 1,
        'taxonomy'      => 'product_cat'
    ) );
    if ( !empty($categories) ) {
        foreach( $categories as $category ) {
            // Is this a sub-category?
            if ( $category->parent != '0' ) {
                // Should sub-categories be included?
                if ( $hide_sub ) {
                    continue;
                } else {
                    if (
                        $category->term_id == $current_cat_id ||
                        $category->parent == $current_cat_id ||
                        ! $category_has_children && $category->parent == $wp_query->queried_object->parent
                    ) {
                        $sub_output .= uomo_category_menu_create_list( $category, $current_cat_id, $display_type );
                    }
                    continue;
                }
            }
            
            $output .= uomo_category_menu_create_list( $category, $current_cat_id, $display_type );
        }
    }
    
    if ( strlen( $sub_output ) > 0 ) {
        $sub_output = '<ul class="apus-shop-sub-categories">' . $sub_output . '</ul>';
    }
    
    $output = $output . $sub_output;
    
    echo trim($output);
}

/*
 *  Product category menu: Output sub-categories
 */
function uomo_sub_category_menu_output( $current_cat_id, $hide_empty ) {
    global $wp_query;
    
    
    $output_sub_categories = '';
    
    // Categories order
    $orderby = 'slug';
    $order = 'asc';
    
    $sub_categories = get_categories( array(
        'type'          => 'post',
        'parent'        => $current_cat_id,
        'orderby'       => $orderby,
        'order'         => $order,
        'hide_empty'    => $hide_empty,
        'hierarchical'  => 1,
        'taxonomy'      => 'product_cat'
    ) );
    
    $has_sub_categories = ( empty( $sub_categories ) ) ? false : true;
    
    // Is there any sub-categories available
    if ( $has_sub_categories ) {
        $current_cat_name = apply_filters( 'uomo_shop_parent_category_title', $wp_query->queried_object->name );
        
        foreach ( $sub_categories as $sub_category ) {
            $output_sub_categories .= uomo_category_menu_create_list( $sub_category, $current_cat_id );
        }
    } else {
        $current_cat_name = $wp_query->queried_object->name;
    }
    
    $current_cat_url = get_term_link( (int) $current_cat_id, 'product_cat' );
    $output_current_cat = '<li class="current-cat"><a href="' . esc_url( $current_cat_url ) . '">' . esc_html( $current_cat_name ) . '</a></li>';
    
    echo trim($output_current_cat . $output_sub_categories);
}


function uomo_show_page_title($return) {
    return false;
}
add_filter( 'woocommerce_show_page_title', 'uomo_show_page_title', 100 );


if (!function_exists('uomo_filter_before')) {
    function uomo_filter_before() {
        echo '<div class="wrapper-fillter"><div class="apus-filter clearfix">';
    }
}

if (!function_exists('uomo_filter_after')) {
    function uomo_filter_after() {
        echo '</div></div>';
    }
}

function uomo_product_filter_sidebar() {
    $layout = uomo_get_config('product_archive_layout', 'left-main');
    if ( is_active_sidebar( 'shop-filter-sidebar' ) && $layout == 'main' ) {
        $top_filter_style = uomo_get_config('product_archive_top_filter_style', 'style1');
        if ( $top_filter_style == 'style1' ) {
            ?>
            <div class="filter-btn-wrapper style1">
                <a href="javascript:void(0);" class="filter-btn"><i class="flaticon-filter-results-button"></i><?php esc_html_e('Filter', 'uomo'); ?></a>

                <div class="shop-filter-sidebar-wrapper">
                    <div class="shop-filter-sidebar-header">
                        <?php esc_html_e('Filter by', 'uomo'); ?>
                        <a href="javascript:void(0);" class="close-filter"><i class="ti-close"></i></a>
                    </div>
                    <div class="content-inner">
                        <?php dynamic_sidebar( 'shop-filter-sidebar' ); ?>
                    </div>
                </div>
                <div class="shop-filter-sidebar-overlay"></div>
            </div>
            <?php
        } else {
            ?>
            <div class="shop-filter-top-wrapper style2">
                <?php dynamic_sidebar( 'shop-filter-sidebar' ); ?>
            </div>
            <?php
        }
    }
}

function uomo_filter_colmun_before() {
    ?>
    <div class="wrapper-right">
        <div class="left-inner clearfix">
    <?php
}
function uomo_filter_colmun_after() {
    ?>
    </div></div>
    <?php
}

function uomo_woocommerce_before_shop_loop_init() {
    $top_filter_style = uomo_get_config('product_archive_top_filter_style', 'style1');
    if ( $top_filter_style == 'style1' ) {
        add_action( 'woocommerce_before_shop_loop', 'uomo_filter_before' , 11 );
        add_action( 'woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 20 );
        add_action( 'woocommerce_before_shop_loop', 'uomo_filter_colmun_before', 25 );

        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
        add_action( 'woocommerce_before_shop_loop', 'uomo_product_filter_sidebar' , 50 );

        add_action( 'woocommerce_before_shop_loop', 'uomo_filter_colmun_after' , 99 );
        add_action( 'woocommerce_before_shop_loop', 'uomo_filter_after' , 100 );
    } else {
        add_action( 'woocommerce_before_shop_loop', 'uomo_filter_before' , 11 );

        add_action( 'woocommerce_before_shop_loop', 'uomo_product_filter_sidebar' , 20 );

        add_action( 'woocommerce_before_shop_loop', 'uomo_filter_colmun_before', 25 );

        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
        
        add_action( 'woocommerce_before_shop_loop', 'uomo_filter_colmun_after' , 99 );
        add_action( 'woocommerce_before_shop_loop', 'uomo_filter_after' , 100 );
    }
}
add_action( 'init', 'uomo_woocommerce_before_shop_loop_init' );

function uomo_show_sale_percentage_loop() {
    global $product;
     
    if ( $product->is_on_sale() ) {
        if ( ! $product->is_type( 'variable' ) ) {
            $price = $product->get_regular_price();
            $sale = $product->get_sale_price();
            if ( $sale && $price ) {
                $max_percentage = ( ( $price - $sale ) / $price ) * 100;
            }
        } else {
            $max_percentage = 0;
            foreach ( $product->get_children() as $child_id ) {
                $variation = wc_get_product( $child_id );
                $price = $variation->get_regular_price();
                $sale = $variation->get_sale_price();
                $percentage = 0;
                if ( $price != 0 && ! empty( $sale ) ) {
                    $percentage = ( $price - $sale ) / $price * 100;
                }
                if ( $percentage > $max_percentage ) {
                    $max_percentage = $percentage;
                }
            }
        }
        if ( !empty($max_percentage) ) {
            echo "<div class='sale-perc'>-" . round($max_percentage) . "%</div>";
        }
    }
 
}
add_action( 'woocommerce_before_shop_loop_item_title', 'uomo_show_sale_percentage_loop', 25 );
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

function uomo_display_out_of_stock() {
    global $product;
    if ( ! $product->is_in_stock() ) {
        echo '<p class="stock out-of-stock">'.esc_html__('SOLD OUT', 'uomo').'</p>';
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'uomo_display_out_of_stock', 10 );


// catalog mode
add_action( 'wp', 'uomo_catalog_mode_init' );
add_action( 'wp', 'uomo_pages_redirect' );

function uomo_catalog_mode_init() {
    if( ! uomo_get_config( 'enable_shop_catalog' ) ) return false;

    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}

function uomo_pages_redirect() {
    if( ! uomo_get_config( 'enable_shop_catalog' ) ) return false;

    $cart     = is_page( wc_get_page_id( 'cart' ) );
    $checkout = is_page( wc_get_page_id( 'checkout' ) );

    wp_reset_postdata();

    if ( $cart || $checkout ) {
        wp_redirect( home_url() );
        exit;
    }
}

function uomo_wc_get_gallery_image_html( $attachment_id, $main_image = false ) {
    $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
    $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
    $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
    $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
    $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
    $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
    $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
    $alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
    $image             = wp_get_attachment_image(
        $attachment_id,
        $image_size,
        false,
        apply_filters(
            'woocommerce_gallery_image_html_attachment_image_params',
            array(
                'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
                'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
                'data-src'                => esc_url( $full_src[0] ),
                'data-large_image'        => esc_url( $full_src[0] ),
                'data-large_image_width'  => esc_attr( $full_src[1] ),
                'data-large_image_height' => esc_attr( $full_src[2] ),
                'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
            ),
            $attachment_id,
            $image_size,
            $main_image
        )
    );

    return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '" data-elementor-lightbox-slideshow="product-gallery">' . $image . '</a></div>';
}

add_filter( 'woocommerce_single_product_photoswipe_options', 'uomo_woocommerce_single_product_photoswipe_options');
function uomo_woocommerce_single_product_photoswipe_options($options){
    $options['captionEl'] = false;
    return $options;
}