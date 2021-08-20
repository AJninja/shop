<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Woo_Products_Deal extends Widget_Base {

	public function get_name() {
        return 'apus_element_woo_products_deal';
    }

	public function get_title() {
        return esc_html__( 'Apus Products Deal', 'uomo' );
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'product_id', [
                'label' => esc_html__( 'Product ID', 'uomo' ),
                'type' => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'end_date', [
                'label' => esc_html__( 'End Date', 'uomo' ),
                'type' => Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'enableTime' => false
                ]
            ]
        );
        $repeater->add_control(
            'available', [
                'label' => esc_html__( 'Available', 'uomo' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5
            ]
        );
        $repeater->add_control(
            'already_sold', [
                'label' => esc_html__( 'Already Sold', 'uomo' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 10
            ]
        );

        $this->add_control(
            'products',
            [
                'label' => esc_html__( 'Products Deal', 'uomo' ),
                'type' => Controls_Manager::REPEATER,
                'placeholder' => esc_html__( 'Enter your product tabs here', 'uomo' ),
                'fields' => $repeater->get_controls(),
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
                    'inner-deal' => esc_html__('Item Deal', 'uomo'),
                ),
                'default' => 'inner-deal',
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
            'line_color',
            [
                'label' => esc_html__( 'Countdown Line Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .special-progress .progress .progress-bar' => 'background-color: {{VALUE}};',
                ],
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
        if ( $products ) {
        ?>
            <div class="woocommerce widget-products-deal <?php echo esc_attr($el_class); ?>">
                <?php if ( !empty($title) ): ?>
                    <h3 class="widget-title">
                        <?php echo esc_attr( $title ); ?>
                    </h3>
                <?php endif; ?>
                <div class="widget-content <?php echo esc_attr($layout_type); ?>">
                    <?php if ( $layout_type == 'carousel' ) { ?>

                        <?php
                        $product_item = isset($product_item) ? $product_item : 'inner-deal';

                        $show_nav = isset($show_nav) ? $show_nav : false;
                        $show_pagination = isset($show_pagination) ? $show_pagination : false;

                        $rows = isset($rows) ? $rows : 1;
                        $columns = !empty($columns) ? $columns : 3;
                        if($columns > 1){
                            $columns_tablet = 3;
                            $columns_mobile = 2;
                        }else{
                            $columns_tablet = 1;
                            $columns_mobile = 1;
                        }

                        $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
                        $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
                        $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;

                        $infinite_loop = isset($infinite_loop) ? $infinite_loop : false;
                        $autoplay = isset($autoplay) ? $autoplay : false;
                        ?>
                        <div class="slick-carousel products carousel_circle"
                            data-items="<?php echo esc_attr($columns); ?>"
                            data-smallmedium="<?php echo esc_attr( $columns_tablet ); ?>"
                            data-extrasmall="<?php echo esc_attr($columns_mobile); ?>"

                            data-slidestoscroll="<?php echo esc_attr($slides_to_scroll); ?>"
                            data-slidestoscroll_smallmedium="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
                            data-slidestoscroll_extrasmall="<?php echo esc_attr($slides_to_scroll_mobile); ?>"

                            data-pagination="<?php echo esc_attr($show_pagination ? 'true' : 'false'); ?>" data-nav="<?php echo esc_attr($show_nav ? 'true' : 'false'); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>">

                            <?php
                            foreach ($products as $data) {
                                if ( !empty($data['product_id']) ) {
                                    $post_object = get_post( $data['product_id'] );
                                    if ( $post_object ) {
                                        setup_postdata( $GLOBALS['post'] =& $post_object );
                                        ?>
                                            <div class="products-grid product">
                                                <?php wc_get_template( 'item-product/'.$product_item.'.php', array(
                                                    'end_date' => !empty($data['end_date']) ? $data['end_date'] : '',
                                                    'available' => !empty($data['available']) ? $data['available'] : '',
                                                    'already_sold' => !empty($data['already_sold']) ? $data['already_sold'] : '',
                                                ) ); ?>
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
                            $product_item = isset($product_item) ? $product_item : 'inner-deal';
                            $columns = !empty($columns) ? $columns : 3;
                            if($columns > 1){
                                $columns_tablet = 3;
                                $columns_mobile = 2;
                            }else{
                                $columns_tablet = 1;
                                $columns_mobile = 1;
                            }

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
                            foreach ($products as $data) {
                                
                                if ( !empty($data['product_id']) ) {
                                    $post_object = get_post( $data['product_id'] );
                                    if ( $post_object ) {
                                        setup_postdata( $GLOBALS['post'] =& $post_object );
                                        $pclasses = $classes;
                                        if ( $count%$columns == 0 ) {
                                            $pclasses[] = 'md-clearfix lg-clearfix ';
                                        }
                                        ?>
                                            <div <?php wc_product_class( $pclasses, $post_object ); ?>>
                                                <?php wc_get_template( 'item-product/'.$product_item.'.php', array(
                                                    'end_date' => !empty($data['end_date']) ? $data['end_date'] : '',
                                                    'available' => !empty($data['available']) ? $data['available'] : '',
                                                    'already_sold' => !empty($data['already_sold']) ? $data['already_sold'] : '',
                                                ) ); ?>
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

Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Woo_Products_Deal );