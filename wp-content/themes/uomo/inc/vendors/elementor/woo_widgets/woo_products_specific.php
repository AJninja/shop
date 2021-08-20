<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Woo_Products_Specific extends Widget_Base {

	public function get_name() {
        return 'apus_element_woo_products_specific';
    }

	public function get_title() {
        return esc_html__( 'Apus Products Specific', 'uomo' );
    }

    public function get_icon() {
        return 'fa fa-shopping-bag';
    }

	public function get_categories() {
        return [ 'uomo-elements' ];
    }

	protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'uomo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'title', [
                'label' => esc_html__( 'Widget Title', 'uomo' ),
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'product_ids', [
                'label' => esc_html__( 'Product IDS', 'uomo' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your product id here', 'uomo' ),
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'uomo'),
                    'carousel' => esc_html__('Carousel', 'uomo'),
                ),
                'default' => 'grid'
            ]
        );

        $this->add_control(
            'product_item',
            [
                'label' => esc_html__( 'Product Item', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'inner' => esc_html__('Item 1', 'uomo'),
                    'inner-v2' => esc_html__('Item 2', 'uomo'),
                    'inner-v3' => esc_html__('Item 3', 'uomo'),
                    'inner-v4' => esc_html__('Item 4', 'uomo'),
                    'inner-v5' => esc_html__('Item 5', 'uomo'),
                    'inner-v6' => esc_html__('Item 6', 'uomo'),
                    'inner-v7' => esc_html__('Item 7', 'uomo'),
                    'inner-v8' => esc_html__('Item 8', 'uomo'),
                    'inner-v9' => esc_html__('Item 9', 'uomo'),
                    'inner-deal' => esc_html__('Item Deal', 'uomo'),
                    'inner-list' => esc_html__('Item List', 'uomo'),
                ),
                'default' => 'inner',
            ]
        );

        $columns = range( 1, 12 );
        $columns = array_combine( $columns, $columns );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => $columns,
                'frontend_available' => true,
                'default' => 3,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'label' => esc_html__( 'Slides to Scroll', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'uomo' ),
                'options' => $columns,
                'condition' => [
                    'columns!' => '1',
                    'layout_type' => 'carousel',
                ],
                'frontend_available' => true,
                'default' => 1,
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => esc_html__( 'Rows', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your rows number here', 'uomo' ),
                'default' => 1,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label'         => esc_html__( 'Show Navigation', 'uomo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'uomo' ),
                'label_off'     => esc_html__( 'Hide', 'uomo' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'         => esc_html__( 'Show Pagination', 'uomo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'uomo' ),
                'label_off'     => esc_html__( 'Hide', 'uomo' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'uomo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'uomo' ),
                'label_off'     => esc_html__( 'No', 'uomo' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'uomo' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'uomo' ),
                'label_off'     => esc_html__( 'No', 'uomo' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'carousel_style',
            [
                'label' => esc_html__( 'Carousel Style', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'uomo'),
                    'carousel_vertical' => esc_html__('Vertical', 'uomo'),
                    'carousel_vertical carousel_2' => esc_html__('Vertical 2', 'uomo'),
                    'carousel_white' => esc_html__('White', 'uomo'),
                    'carousel_circle' => esc_html__('Circle', 'uomo'),
                    'carousel_circle st_center' => esc_html__('Circle Center', 'uomo'),
                ),
                'default' => '',
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'uomo' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'uomo' ),
            ]
        );

        $this->end_controls_section();


        // Style
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Box Style', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'widget_title_color',
            [
                'label' => esc_html__( 'Widget Title Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .widget-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Widget Title Typography', 'uomo' ),
                'name' => 'widget_title_typography',
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'uomo' ),
                'selector' => '{{WRAPPER}} .product-block',
            ]
        );

        $this->add_control(
            'box_hover_border_color',
            [
                'label' => esc_html__( 'Border Hover Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-block:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow Hover', 'uomo' ),
                'selector' => '{{WRAPPER}} .product-block:hover',
            ]
        );

        $this->end_controls_section();

        
        $this->start_controls_section(
            'section_product_style',
            [
                'label' => esc_html__( 'Product Style', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} h3.name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block h3.name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block h3.name a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'uomo' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} h3.name a',
            ]
        );

        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__( 'Category Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-cat' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Category Typography', 'uomo' ),
                'name' => 'cat_typography',
                'selector' => '{{WRAPPER}} .product-cat',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .price' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-block .price ins' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'price_old_color',
            [
                'label' => esc_html__( 'Price Old Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .price del' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Price Typography', 'uomo' ),
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .product-block .price',
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => esc_html__( 'Info Action Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .quickview' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-block .added_to_cart' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-block .button' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-block .added_to_cart:before' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-block .button:before' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'Wishlist_color',
            [
                'label' => esc_html__( 'Wishlist Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .add_to_wishlist' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'Wishlisted_color',
            [
                'label' => esc_html__( 'Wishlist Added Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .yith-wcwl-wishlistexistsbrowse a' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-block .yith-wcwl-wishlistaddedbrowse a' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        $product_ids = !empty($product_ids) ? array_filter(explode(',', $product_ids)) : '';
        if ( $product_ids ) {
        ?>
            <div class="woocommerce widget-products-deal <?php echo esc_attr($product_item.' '.$el_class); ?>">
                <?php if ( !empty($title) ): ?>
                    <h3 class="widget-title">
                        <?php echo esc_attr( $title ); ?>
                    </h3>
                <?php endif; ?>
                <div class="widget-content <?php echo esc_attr($layout_type); ?>">
                    <?php if ( $layout_type == 'carousel' ) { ?>

                        <?php
                        $product_item = isset($product_item) ? $product_item : 'inner';

                        $show_nav = isset($show_nav) ? $show_nav : false;
                        $show_pagination = isset($show_pagination) ? $show_pagination : false;

                        $rows = isset($rows) ? $rows : 1;
                        $columns = !empty($columns) ? $columns : 3;
                        if($columns > 1){
                            $columns_tablet = 2;
                        }else{
                            $columns_tablet = 1;
                        }
                        $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;

                        $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
                        $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
                        $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;

                        $infinite_loop = isset($infinite_loop) ? $infinite_loop : false;
                        $autoplay = isset($autoplay) ? $autoplay : false;
                        ?>
                        <div class="slick-carousel products carousel_small <?php echo trim($carousel_style); ?>"
                            data-items="<?php echo esc_attr($columns); ?>"
                            data-smallmedium="<?php echo esc_attr( $columns_tablet ); ?>"
                            data-extrasmall="<?php echo esc_attr($columns_mobile); ?>"

                            data-slidestoscroll="<?php echo esc_attr($slides_to_scroll); ?>"
                            data-slidestoscroll_smallmedium="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
                            data-slidestoscroll_extrasmall="<?php echo esc_attr($slides_to_scroll_mobile); ?>"

                            data-pagination="<?php echo esc_attr($show_pagination ? 'true' : 'false'); ?>" data-nav="<?php echo esc_attr($show_nav ? 'true' : 'false'); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>">

                            <?php
                            foreach ($product_ids as $product_id) {
                                if ( !empty($product_id) ) {
                                    $post_object = get_post( $product_id );
                                    if ( $post_object ) {
                                        setup_postdata( $GLOBALS['post'] =& $post_object );
                                        ?>
                                            <div class="products-grid product">
                                                <?php wc_get_template_part( 'item-product/'.$product_item ); ?>
                                            </div>
                                        <?php
                                    }
                                }
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <?php
                            $product_item = isset($product_item) ? $product_item : 'inner';
                            $columns = !empty($columns) ? $columns : 3;
                            if($columns > 1){
                                $columns_tablet = 2;
                            }else{
                                $columns_tablet = 1;
                            }
                            $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;

                            $mdcol = 12/$columns;
                            $smcol = 12/$columns_tablet;
                            $xscol = 12/$columns_mobile;

                            if( $columns == 5 ){
                                $mdcol = '5c';
                            }

                            if( $columns_tablet == 5 ){
                                $smcol = '5c';
                            }

                            if( $columns_mobile == 5 ){
                                $xscol = '5c';
                            }

                            $classes = array();

                            $classes[] = 'col-md-'.$mdcol.' col-sm-'.$smcol.' col-xs-'.$xscol;

                            $count = 0;
                            foreach ($product_ids as $product_id) {
                                
                                if ( !empty($product_id) ) {
                                    $post_object = get_post( $product_id );
                                    if ( $post_object ) {
                                        setup_postdata( $GLOBALS['post'] =& $post_object );
                                        $pclasses = $classes;
                                        if ( $count%$columns == 0 ) {
                                            $pclasses[] = 'md-clearfix lg-clearfix ';
                                        }
                                        ?>
                                            <div <?php wc_product_class( $pclasses, $post_object ); ?>>
                                                <?php wc_get_template_part( 'item-product/'.$product_item ); ?>
                                            </div>
                                        <?php
                                        $count++;
                                    }
                                }
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Woo_Products_Specific );