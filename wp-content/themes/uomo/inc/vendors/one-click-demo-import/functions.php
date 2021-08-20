<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function uomo_ocdi_import_files() {
    $demos = array();

    // Fashion
    for ($i=1; $i <= 8 ; $i++) {
        $demos[] = array(
            'import_file_name'             => 'Home '.$i,
            'categories'                   => array( 'Fashion (8)' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options.json',
                    'option_name' => 'uomo_theme_options',
                ),
            ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-'.$i.'.png',
            'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
            'preview_url'                  => 'http://demoapus2.com/uomo/home-'.$i.'/',
        );
    }
    // Furniture
    $demos[] = array(
        'import_file_name'             => 'Home 9',
        'categories'                   => array( 'Furniture (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-9.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-9/',
    );
    // Sports & Outdoors
    $demos[] = array(
        'import_file_name'             => 'Home 10',
        'categories'                   => array( 'Sports & Outdoors (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-10.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-10/',
    );
    // Electronics
    $demos[] = array(
        'import_file_name'             => 'Home 11',
        'categories'                   => array( 'Electronics (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-11.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-11/',
    );

    // Food & Grocery
    $demos[] = array(
        'import_file_name'             => 'Home 12',
        'categories'                   => array( 'Food & Grocery (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-12.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-12/',
    );

    // Glasses
    $demos[] = array(
        'import_file_name'             => 'Home 13',
        'categories'                   => array( 'Glasses (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-13.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-13/',
    );

    // Medical
    $demos[] = array(
        'import_file_name'             => 'Home 14',
        'categories'                   => array( 'Medical (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options14.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-14.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-14/',
    );

    // Cosmetics
    $demos[] = array(
        'import_file_name'             => 'Home 15',
        'categories'                   => array( 'Cosmetics (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options15.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-15.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-15/',
    );

    // Bikes
    $demos[] = array(
        'import_file_name'             => 'Home 16',
        'categories'                   => array( 'Bikes (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options16.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-16.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-16/',
    );

    // Wine
    $demos[] = array(
        'import_file_name'             => 'Home 17',
        'categories'                   => array( 'Wine (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options17.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-17.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-17/',
    );

    // Cars
    $demos[] = array(
        'import_file_name'             => 'Home 18',
        'categories'                   => array( 'Cars (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options18.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-18.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-18/',
    );

    // Watches
    $demos[] = array(
        'import_file_name'             => 'Home 19',
        'categories'                   => array( 'Watches (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options19.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-19.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-19/',
    );

    // Jewellery
    $demos[] = array(
        'import_file_name'             => 'Home 20',
        'categories'                   => array( 'Jewellery (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options20.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-20.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-20/',
    );

    // Baby
    $demos[] = array(
        'import_file_name'             => 'Home 21',
        'categories'                   => array( 'Baby (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options21.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-21.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-21/',
    );

    // Tools
    $demos[] = array(
        'import_file_name'             => 'Home 22',
        'categories'                   => array( 'Tools (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options22.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-22.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-22/',
    );

    // Single Product
    $demos[] = array(
        'import_file_name'             => 'Home 23',
        'categories'                   => array( 'Single Product (1)' ),
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/dummy-data.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/widgets.wie',
        'local_import_redux'           => array(
            array(
                'file_path'   => trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/redux-options.json',
                'option_name' => 'uomo_theme_options',
            ),
        ),
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'inc/vendors/one-click-demo-import/data/home-23.png',
        'import_notice'                => esc_html__( 'Import process may take 5-10 minutes. If you facing any issues please contact our support.', 'uomo' ),
        'preview_url'                  => 'http://demoapus2.com/uomo/home-23/',
    );

    return apply_filters( 'uomo_ocdi_files_args', $demos );
}
add_filter( 'pt-ocdi/import_files', 'uomo_ocdi_import_files' );

function uomo_ocdi_after_import_setup( $selected_import ) {
    // Assign menus to their locations.
    $main_menu       = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $mobile_menu       = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
    $my_account       = get_term_by( 'name', 'My Account', 'nav_menu' );
    $vertical_menu       = get_term_by( 'name', 'Vertical Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
            'mobile-primary' => $mobile_menu->term_id,
            'my-account' => $my_account->term_id,
            'vertical-menu' => $vertical_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page) and other WooCommerce pages
    $blog_page_id       = get_page_by_title( 'Blog' );
    $shop_page_id       = get_page_by_title( 'Shop' );
    $cart_page_id       = get_page_by_title( 'Cart' );
    $checkout_page_id   = get_page_by_title( 'Checkout' );
    $myaccount_page_id  = get_page_by_title( 'My Account' );
    
    update_option( 'show_on_front', 'page' );
    
    update_option( 'page_for_posts', $blog_page_id->ID );
    update_option( 'woocommerce_shop_page_id', $shop_page_id->ID );
    update_option( 'woocommerce_cart_page_id', $cart_page_id->ID );
    update_option( 'woocommerce_checkout_page_id', $checkout_page_id->ID );
    update_option( 'woocommerce_myaccount_page_id', $myaccount_page_id->ID );
    update_option( 'woocommerce_enable_myaccount_registration', 'yes' );

    // elementor
    update_option( 'elementor_global_image_lightbox', 'yes' );
    update_option( 'elementor_disable_color_schemes', 'yes' );
    update_option( 'elementor_disable_typography_schemes', 'yes' );
    update_option( 'elementor_container_width', 1440 );

    // Element kit
    $kit_page_id = get_page_by_title( 'Default Kit', OBJECT, 'elementor_library' );
    update_option( 'elementor_active_kit', $kit_page_id->ID );
    
    // Home page
    $front_page_id = get_page_by_title( $selected_import['import_file_name'] );
    update_option( 'page_on_front', $front_page_id->ID );

    $file = trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/settings.json';
    if ( file_exists($file) ) {
        uomo_ocdi_import_settings($file);
    }

    if ( uomo_is_revslider_activated() ) {
        require_once( ABSPATH . 'wp-load.php' );
        require_once( ABSPATH . 'wp-includes/functions.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );

        $slider_array = array(
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-1.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-2.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-3.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-4.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-5.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-6.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-8.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-9.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-10.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-11.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-12.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/shop-list-v3.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/shop-list-v4.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-13.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-14.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-15.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-16.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-17.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-18.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-20.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-21.zip',
            trailingslashit( get_template_directory() ) . 'inc/vendors/one-click-demo-import/data/slider-22.zip',
        );
        $slider = new RevSlider();

        foreach( $slider_array as $filepath ) {
            $slider->importSliderFromPost( true, true, $filepath );
        }
    }

    if ( did_action( 'elementor/loaded' ) ) {
      // Automatically purge and regenerate the Elementor CSS cache
        \Elementor\Plugin::$instance->files_manager->clear_cache();
    }

}
add_action( 'pt-ocdi/after_import', 'uomo_ocdi_after_import_setup' );

function uomo_ocdi_import_settings($file) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
    require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';
    $file_obj = new WP_Filesystem_Direct( array() );
    $datas = $file_obj->get_contents($file);
    $datas = json_decode( $datas, true );

    if ( count( array_filter( $datas ) ) < 1 ) {
        return;
    }

    if ( !empty($datas['page_options']) ) {
        uomo_ocdi_import_page_options($datas['page_options']);
    }
    if ( !empty($datas['metadata']) ) {
        uomo_ocdi_import_some_metadatas($datas['metadata']);
    }
}

function uomo_ocdi_import_page_options($datas) {
    if ( $datas ) {
        foreach ($datas as $option_name => $page_id) {
            update_option( $option_name, $page_id);
        }
    }
}

function uomo_ocdi_import_some_metadatas($datas) {
    if ( $datas ) {
        foreach ($datas as $slug => $post_types) {
            if ( $post_types ) {
                foreach ($post_types as $post_type => $metas) {
                    if ( $metas ) {
                        $args = array(
                            'name'        => $slug,
                            'post_type'   => $post_type,
                            'post_status' => 'publish',
                            'numberposts' => 1
                        );
                        $posts = get_posts($args);
                        if ( $posts && isset($posts[0]) ) {
                            foreach ($metas as $meta) {
                                update_post_meta( $posts[0]->ID, $meta['meta_key'], $meta['meta_value'] );
                                if ( $meta['meta_key'] == '_mc4wp_settings' ) {
                                    update_option( 'mc4wp_default_form_id', $posts[0]->ID );
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function uomo_ocdi_before_widgets_import() {

    $sidebars_widgets = get_option('sidebars_widgets');
    $all_widgets = array();

    array_walk_recursive( $sidebars_widgets, function ($item, $key) use ( &$all_widgets ) {
        if( ! isset( $all_widgets[$key] ) ) {
            $all_widgets[$key] = $item;
        } else {
            $all_widgets[] = $item;
        }
    } );

    if( isset( $all_widgets['array_version'] ) ) {
        $array_version = $all_widgets['array_version'];
        unset( $all_widgets['array_version'] );
    }

    $new_sidebars_widgets = array_fill_keys( array_keys( $sidebars_widgets ), array() );

    $new_sidebars_widgets['wp_inactive_widgets'] = $all_widgets;
    if( isset( $array_version ) ) {
        $new_sidebars_widgets['array_version'] = $array_version;
    }

    update_option( 'sidebars_widgets', $new_sidebars_widgets );
}
add_action( 'pt-ocdi/before_widgets_import', 'uomo_ocdi_before_widgets_import' );