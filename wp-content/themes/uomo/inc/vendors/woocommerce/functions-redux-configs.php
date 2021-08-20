<?php

// Shop Archive settings
function uomo_woo_redux_config($sections, $sidebars, $columns) {
    $attributes = array();
    if ( is_admin() ) {
        $attrs = wc_get_attribute_taxonomies();
        if ( $attrs ) {
            foreach ( $attrs as $tax ) {
                $attributes[wc_attribute_taxonomy_name( $tax->attribute_name )] = $tax->attribute_label;
            }
        }
    }
    $sections[] = array(
        'icon' => 'el el-shopping-cart',
        'title' => esc_html__('Shop Settings', 'uomo'),
        'fields' => array(
            array(
                'id' => 'products_general_total_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('General Setting', 'uomo').'</h3>',
            ),
            array(
                'id' => 'enable_shop_catalog',
                'type' => 'switch',
                'title' => esc_html__('Enable Shop Catalog', 'uomo'),
                'default' => 0,
                'subtitle' => esc_html__('Enable Catalog Mode for disable Add To Cart button, Cart, Checkout', 'uomo'),
            ),
            array(
                'id' => 'products_watches_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Swatches Variation Setting', 'uomo').'</h3>',
            ),
            array(
                'id' => 'show_product_swatches_on_grid',
                'type' => 'switch',
                'title' => esc_html__('Show Swatches On Product Grid', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'product_swatches_attribute',
                'type' => 'select',
                'title' => esc_html__( 'Grid swatch attribute to display', 'uomo' ),
                'subtitle' => esc_html__( 'Choose attribute that will be shown on products grid', 'uomo' ),
                'options' => $attributes
            ),
            array(
                'id' => 'show_product_swatches_use_images',
                'type' => 'switch',
                'title' => esc_html__('Use images from product variations', 'uomo'),
                'subtitle' => esc_html__( 'If enabled swatches buttons will be filled with images choosed for product variations and not with images uploaded to attribute terms.', 'uomo' ),
                'default' => 1
            ),
            array(
                'id' => 'products_breadcrumb_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Breadcrumbs Setting', 'uomo').'</h3>',
            ),
            array(
                'id' => 'show_product_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'uomo'),
                'default' => 1
            ),
            array(
                'title' => esc_html__('Breadcrumbs Background Color', 'uomo'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'uomo').'</em>',
                'id' => 'woo_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'woo_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'uomo'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'uomo'),
            ),
        )
    );
    // Archive settings
    $elementor_options = ['' => esc_html__('Choose a Elementor Template', 'uomo')];
    if ( did_action( 'elementor/loaded' ) && is_admin() && !empty($_GET['page']) && $_GET['page'] == '_options' ) {
        $ele_obj = \Elementor\Plugin::$instance;
        $templates = $ele_obj->templates_manager->get_source( 'local' )->get_items();
        
        if ( !empty( $templates ) ) {
            foreach ( $templates as $template ) {
                $elementor_options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            }
        }
    }
    $sections[] = array(
        'title' => esc_html__('Product Archives', 'uomo'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'products_top_section_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Top Categories Setting', 'uomo').'</h3>',
            ),
            array(
                'id' => 'show_shop_top_categories',
                'type' => 'switch',
                'title' => esc_html__('Show Shop Top Categories ?', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'shop_top_categories_style',
                'type' => 'select',
                'title' => esc_html__('Top categories style', 'uomo'),
                'options' => array(
                    'style1' => esc_html__('Style 1', 'uomo'),
                    'style2' => esc_html__('Style 2', 'uomo'),
                    'style3' => esc_html__('Style 3', 'uomo'),
                    'style4' => esc_html__('Style 4', 'uomo'),
                    'style5' => esc_html__('Style 5', 'uomo'),
                    'style6' => esc_html__('Style 6', 'uomo'),
                ),
                'default' => 'style1',
                'required' => array('show_shop_top_categories', '=', true)
            ),
            array(
                'id' => 'shop_top_categories_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Background Image', 'uomo'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your top categories.', 'uomo'),
                'required' => array('shop_top_categories_style', '=', array('style1', 'style2', 'style4', 'style6'))
            ),
            array(
                'id' => 'shop_top_categories_all_image',
                'type' => 'media',
                'title' => esc_html__('All Category Image', 'uomo'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your All menu.', 'uomo'),
                'required' => array('shop_top_categories_style', '=', array('style5'))
            ),
            array(
                'id' => 'shop_top_categories_all_icon',
                'type' => 'text',
                'title' => esc_html__('All category Icon Class', 'uomo'),
                'required' => array('shop_top_categories_style', '=', array('style6'))
            ),
            array(
                'id' => 'shop_elementor_template',
                'type' => 'select',
                'title' => esc_html__('Top Content (Elementor Template)', 'uomo'),
                'subtitle' => esc_html__('Choose a Elementor Template to show in top.', 'uomo'),
                'options' => $elementor_options,
                'default' => '',
            ),
            array(
                'id' => 'products_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('General Setting', 'uomo').'</h3>',
            ),
            array(
                'id' => 'show_shop_cat_title',
                'type' => 'switch',
                'title' => esc_html__('Show Shop/Category Title ?', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'product_display_mode',
                'type' => 'select',
                'title' => esc_html__('Products Layout', 'uomo'),
                'subtitle' => esc_html__('Choose a default layout archive product.', 'uomo'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'uomo'),
                    'metro' => esc_html__('Metro', 'uomo'),
                ),
                'default' => 'grid'
            ),
            array(
                'id' => 'product_columns',
                'type' => 'select',
                'title' => esc_html__('Product Columns', 'uomo'),
                'options' => $columns,
                'default' => 4,
            ),
            array(
                'id' => 'product_item_style',
                'type' => 'select',
                'title' => esc_html__('Product Style', 'uomo'),
                'options' => array(
                    'v1' => esc_html__('Style 1', 'uomo'),
                    'v2' => esc_html__('Style 2', 'uomo'),
                    'v3' => esc_html__('Style 3', 'uomo'),
                    'v4' => esc_html__('Style 4', 'uomo'),
                    'v5' => esc_html__('Style 5', 'uomo'),
                    'v6' => esc_html__('Style 6', 'uomo'),
                    'v7' => esc_html__('Style 7', 'uomo'),
                    'v8' => esc_html__('Style 8', 'uomo'),
                    'v9' => esc_html__('Style 9', 'uomo'),
                    'v10' => esc_html__('Style 10', 'uomo'),
                    'v11' => esc_html__('Style 11', 'uomo'),
                    'v12' => esc_html__('Style 12', 'uomo'),
                    'v13' => esc_html__('Style 13', 'uomo'),
                    'v14' => esc_html__('Style 14', 'uomo'),
                    'v15' => esc_html__('Style 15', 'uomo'),
                    'v16' => esc_html__('Style 16', 'uomo'),
                    'v17' => esc_html__('Style 17', 'uomo'),
                    'v18' => esc_html__('Style 18', 'uomo'),
                    'v19' => esc_html__('Style 19', 'uomo'),
                    'v20' => esc_html__('Style 20', 'uomo'),
                    'v21' => esc_html__('Style 21', 'uomo'),
                    'metro' => esc_html__('Style Metro', 'uomo'),
                ),
                'default' => 'v1',
                'required' => array('product_display_mode', '=', array('grid'))
            ),

            array(
                'id' => 'number_products_per_page',
                'type' => 'text',
                'title' => esc_html__('Number of Products Per Page', 'uomo'),
                'default' => 12,
                'min' => '1',
                'step' => '1',
                'max' => '100',
                'type' => 'slider'
            ),
            array(
                'id' => 'show_quickview',
                'type' => 'switch',
                'title' => esc_html__('Show Quick View', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'enable_swap_image',
                'type' => 'switch',
                'title' => esc_html__('Enable Swap Image', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'product_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'uomo'),
                'options' => array(
                    'default' => esc_html__('Default', 'uomo'),
                    'loadmore' => esc_html__('Load More Button', 'uomo'),
                    'infinite' => esc_html__('Infinite Scrolling', 'uomo'),
                ),
                'default' => 'default'
            ),

            array(
                'id' => 'products_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Sidebar Setting', 'uomo').'</h3>',
            ),
            array(
                'id' => 'product_archive_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'uomo'),
                'default' => false
            ),
            array(
                'id' => 'product_archive_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Product Layout', 'uomo'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive product page.', 'uomo'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'uomo'),
                        'alt' => esc_html__('Main Content', 'uomo'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'uomo'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'uomo'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'uomo'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'uomo'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'product_archive_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'uomo'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'uomo'),
                'options' => $sidebars,
                'required' => array('product_archive_layout', '=', array('left-main'))
            ),
            array(
                'id' => 'product_archive_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'uomo'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'uomo'),
                'options' => $sidebars,
                'required' => array('product_archive_layout', '=', array('main-right'))
            ),
            array(
                'id' => 'product_archive_top_filter_style',
                'type' => 'select',
                'title' => esc_html__('Top Filter Style', 'uomo'),
                'subtitle' => esc_html__('Choose a top filter style.', 'uomo'),
                'options' => array(
                    'style1' => esc_html__('Style 1', 'uomo'),
                    'style2' => esc_html__('Style 2', 'uomo'),
                ),
                'default' => 'style1',
                'required' => array('product_archive_layout', '=', array('main'))
            ),
        )
    );
    
    
    // Product Page
    $sections[] = array(
        'title' => esc_html__('Single Product', 'uomo'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'product_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('General Setting', 'uomo').'</h3>',
            ),
            array(
                'id' => 'product_header_type',
                'type' => 'select',
                'title' => esc_html__('Header Layout Type (Product Details)', 'uomo'),
                'subtitle' => esc_html__('Choose a header for your website.', 'uomo'),
                'options' => array_merge( array('global' => esc_html__( 'Global Setting', 'uomo' )), uomo_get_header_layouts() ),
                'desc' => sprintf(wp_kses(__('You can add or edit a header in <a href="%s" target="_blank">Headers Builder</a>', 'uomo'), array( 'a' => array('href' => array(), 'target' => array()) )), esc_url( admin_url( 'edit.php?post_type=apus_megamenu') )),
            ),
            array(
                'id' => 'product_single_version',
                'type' => 'select',
                'title' => esc_html__('Product Layout', 'uomo'),
                'options' => array(
                    'v1' => esc_html__('Layout 1', 'uomo'),
                    'v2' => esc_html__('Layout 2', 'uomo'),
                    'v3' => esc_html__('Layout 3', 'uomo'),
                    'v4' => esc_html__('Layout 4', 'uomo'),
                    'v5' => esc_html__('Layout 5', 'uomo'),
                    'v6' => esc_html__('Layout 6', 'uomo'),
                    'v7' => esc_html__('Layout 7', 'uomo'),
                    'v8' => esc_html__('Layout 8', 'uomo'),
                    'v9' => esc_html__('Layout 9', 'uomo'),
                    'v10' => esc_html__('Layout 10', 'uomo'),
                    'v11' => esc_html__('Layout 11', 'uomo'),
                ),
                'default' => 'v1',
            ),
            array(
                'title' => esc_html__('Background Color', 'uomo'),
                'subtitle' => '<em>'.esc_html__('The background color header.', 'uomo').'</em>',
                'id' => 'product_bg_color',
                'type' => 'color',
                'transparent' => false,
                'required' => array('product_single_version', '=', array('v2', 'v3'))
            ),
            array(
                'id' => 'enable_sticky_cart',
                'type' => 'switch',
                'title' => esc_html__('Enable Top Sticky Cart', 'uomo'),
                'default' => 1,
                'required' => array('product_single_version', '=', array('v4', 'v5', 'v6', 'v7'))
            ),
            array(
                'id' => 'product_delivery_title',
                'type' => 'text',
                'title' => esc_html__('Delivery Title', 'uomo'),
                'default' => 'Delivery and return',
            ),
            array(
                'id' => 'product_delivery_info',
                'type' => 'editor',
                'title' => esc_html__('Delivery Information', 'uomo'),
                'default' => '',
            ),
            array(
                'id' => 'product_shipping_title',
                'type' => 'text',
                'title' => esc_html__('Shipping Title', 'uomo'),
                'default' => 'Shipping Information',
            ),
            array(
                'id' => 'product_shipping_info',
                'type' => 'editor',
                'title' => esc_html__('Shipping Information', 'uomo'),
                'default' => '',
            ),
            array(
                'id' => 'product_composition_title',
                'type' => 'text',
                'title' => esc_html__('Composition Title', 'uomo'),
                'default' => 'Composition and care',
            ),
            array(
                'id' => 'product_composition_info',
                'type' => 'editor',
                'title' => esc_html__('Composition Information', 'uomo'),
                'default' => '',
            ),

            array(
                'id' => 'show_product_sticky_add_to_cart',
                'type' => 'switch',
                'title' => esc_html__('Show Bottom Sticky Add To Cart', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_meta',
                'type' => 'switch',
                'title' => esc_html__('Show Product Meta', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_review_tab',
                'type' => 'switch',
                'title' => esc_html__('Show Product Review Tab', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'hidden_product_additional_information_tab',
                'type' => 'switch',
                'title' => esc_html__('Hidden Product Additional Information Tab', 'uomo'),
                'default' => 1
            ),

            array(
                'id' => 'product_block_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Product Block Setting', 'uomo').'</h3>',
            ),
            array(
                'id' => 'show_product_releated',
                'type' => 'switch',
                'title' => esc_html__('Show Products Releated', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'releated_product_columns',
                'type' => 'select',
                'title' => esc_html__('Releated Products Columns', 'uomo'),
                'options' => $columns,
                'default' => 4,
                'required' => array('show_product_releated', '=', true)
            ),

            array(
                'id' => 'show_product_upsells',
                'type' => 'switch',
                'title' => esc_html__('Show Products upsells', 'uomo'),
                'default' => 1
            ),
            array(
                'id' => 'upsells_product_columns',
                'type' => 'select',
                'title' => esc_html__('Upsells Products Columns', 'uomo'),
                'options' => $columns,
                'default' => 4,
                'required' => array('show_product_upsells', '=', true)
            ),
        )
    );
    
    return $sections;
}
add_filter( 'uomo_redux_framwork_configs', 'uomo_woo_redux_config', 10, 3 );