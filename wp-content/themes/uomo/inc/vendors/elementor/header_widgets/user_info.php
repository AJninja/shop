<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_User_Info extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_user_info';
    }

    public function get_title() {
        return esc_html__( 'Apus Header User Info', 'uomo' );
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
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'uomo' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'uomo' ),
            ]
        );

        $this->add_control(
            'login_layout',
            [
                'label' => esc_html__( 'Login Form', 'uomo' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'link_to_page' => esc_html__( 'Link To Page', 'uomo' ),
                    'popup' => esc_html__( 'Popup', 'uomo' ),
                    'dropdown_box' => esc_html__( 'Dropdown Box', 'uomo' ),
                    'offcanvas' => esc_html__( 'Offcanvas', 'uomo' ),
                ],
                'default' => 'link_to_page'
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'uomo' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color Icon', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .account-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( is_user_logged_in() ) { ?>
            <?php if( has_nav_menu( 'my-account' ) ) { ?>
                <div class="top-wrapper-menu <?php echo esc_attr($el_class); ?>">
                    <span class="account-icon"><i class="flaticon-user"></i></span>
                    <?php
                    if ( has_nav_menu( 'my-account' ) ) {
                        $args = array(
                            'theme_location' => 'my-account',
                            'container_class' => 'inner-top-menu',
                            'menu_class' => 'nav navbar-nav topmenu-menu',
                            'fallback_cb' => '',
                            'menu_id' => '',
                            'walker' => new Uomo_Nav_Menu()
                        );
                        wp_nav_menu($args);
                    }
                    ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="top-wrapper-menu wrapper-account-action <?php echo esc_attr($el_class.' '.$login_layout); ?>">
                <?php
                    if ( $login_layout == 'dropdown_box' ) { ?>
                        <div class="dropdown">
                            <a class="login account-icon <?php echo esc_attr($login_layout); ?>" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign in','uomo'); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flaticon-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php get_template_part( 'woocommerce/myaccount/form-login' ); ?>
                            </div>
                        </div>
                    <?php } elseif ( $login_layout == 'popup' ) { ?>
                        <a class="login account-icon <?php echo esc_attr($login_layout); ?>" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign in','uomo'); ?>"><i class="flaticon-user"></i>
                        </a>
                        <div class="header-customer-login-wrapper hidden">
                            <button title="<?php echo esc_html('Close (Esc)', 'uomo'); ?>" type="button" class="mfp-close apus-mfp-close"><i class="ti-close"></i></button>
                            <?php get_template_part( 'woocommerce/myaccount/form-login' ); ?>
                        </div>
                    <?php } elseif ( $login_layout == 'link_to_page' ) { ?>
                        <a class="login account-icon <?php echo esc_attr($login_layout); ?>" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign in','uomo'); ?>"><i class="flaticon-user"></i>
                        </a>
                    <?php } elseif ( $login_layout == 'offcanvas' ) { ?>
                        <span class="offcanvas-account account-icon">
                            <i class="flaticon-user"></i>
                        </span>
                        <div class="offcanvas-content-login">
                            <span class="close-offcanvas-account"><i class="ti-close"></i></span>
                            <?php get_template_part( 'woocommerce/myaccount/form-login' ); ?>
                        </div>
                        <div class="overlay-offcanvas-content-login"></div>
                    <?php } ?>
            </div>
        <?php }
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_User_Info );