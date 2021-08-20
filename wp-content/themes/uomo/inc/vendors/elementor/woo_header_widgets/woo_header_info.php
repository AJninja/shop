<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Woo_Header_Info extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_woo_header';
    }

    public function get_title() {
        return esc_html__( 'Apus Header Woo Button', 'uomo' );
    }
    
    public function get_categories() {
        return [ 'uomo-header-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'uomo' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hide_wishlist',
            [
                'label' => esc_html__( 'Wishlist', 'uomo' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'uomo' ),
                'label_off' => esc_html__( 'Show', 'uomo' ),
            ]
        );

        $this->add_control(
            'hide_cart',
            [
                'label' => esc_html__( 'Cart', 'uomo' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'uomo' ),
                'label_off' => esc_html__( 'Show', 'uomo' ),
            ]
        );

        $this->add_control(
            'mini_cart',
            [
                'label' => esc_html__( 'Mini Cart Layout', 'uomo' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'offcanvas' => esc_html__( 'Offcanvas', 'uomo' ),
                    'dropdown_box' => esc_html__( 'Dropdown Box', 'uomo' ),
                ],
                'default' => 'dropdown_box'
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'uomo' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'uomo' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'uomo' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'uomo' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'uomo' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'uomo' ),
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon', 'uomo' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .wishlist-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mini-cart' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label' => esc_html__( 'Color Count', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_count_color',
            [
                'label' => esc_html__( 'Bg Count', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .count' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $add_class = '';
        if ( !empty($align) ) {
            $add_class = 'menu-'.$align;
        }
        ?>
        <div class="header-button-woo clearfix <?php echo esc_attr($add_class.' '.$el_class); ?>">
            <?php
            global $woocommerce;
            if ( $hide_cart && is_object($woocommerce) && is_object($woocommerce->cart) ) {
            ?>
                <div class="pull-right">
                    <div class="apus-topcart">
                        <div class="cart">
                            <?php if ( $mini_cart == 'dropdown_box' ) { ?>
                                <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" href="#" title="<?php esc_attr_e('View your shopping cart', 'uomo'); ?>">
                                    <i class="flaticon-shopping-bag"></i>
                                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="widget_shopping_cart_content">
                                        <?php woocommerce_mini_cart(); ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <a class="offcanvas mini-cart" href="#" title="<?php esc_attr_e('View your shopping cart', 'uomo'); ?>">
                                    <i class="flaticon-shopping-bag"></i>
                                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                </a>
                                <div class="offcanvas-content">
                                    <h3 class="title-cart-canvas"><i class="ti-close close-cart"></i> <?php echo esc_html__(' Your Cart', 'uomo'); ?></h3>
                                    <div class="widget_shopping_cart_content">
                                        <?php woocommerce_mini_cart(); ?>
                                    </div>
                                </div>
                                <div class="overlay-offcanvas-content"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                ?>
                <div class="pull-right">
                    <div class="apus-topcart">
                        <div class="cart">
                            <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" href="#" title="<?php esc_attr_e('View your shopping cart', 'uomo'); ?>">
                                <i class="flaticon-shopping-bag"></i>
                                <span class="count">0</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }

            if ( $hide_wishlist && class_exists( 'YITH_WCWL' ) ) {
                $wishlist_url = YITH_WCWL()->get_wishlist_url();
            ?>
                <div class="pull-right">
                    <a class="wishlist-icon" href="<?php echo esc_url($wishlist_url);?>">
                        <i class="flaticon-heart"></i>
                        <?php if ( function_exists('yith_wcwl_count_products') ) { ?>
                            <span class="count"><?php echo yith_wcwl_count_products(); ?></span>
                        <?php } ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Woo_Header_Info );