<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Search_Form extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_search_form';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Search Form', 'uomo' );
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
            'show_categories',
            [
                'label' => esc_html__( 'Show Categories', 'uomo' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Show', 'uomo' ),
                'label_off' => esc_html__( 'Hide', 'uomo' ),
            ]
        );

        $this->add_control(
            'show_auto_search',
            [
                'label' => esc_html__( 'Show Autocomplete Search', 'uomo' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Show', 'uomo' ),
                'label_off' => esc_html__( 'Hide', 'uomo' ),
            ]
        );

        $this->add_responsive_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'uomo' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style1' => esc_html__( 'Style 1', 'uomo' ),
                    'style2' => esc_html__( 'Style 2', 'uomo' ),
                    'style3' => esc_html__( 'Style 3', 'uomo' ),
                ],
                'default' => 'style1'
            ]
        );

        $this->add_control(
            'quick_links_title',
            [
                'label' => esc_html__( 'Quick Links Title', 'uomo' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'uomo' ),
                'condition' => [
                    'style' => 'style2',
                ],
            ]
        );

        $custom_menus = array();
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
        if ( is_array( $menus ) && ! empty( $menus ) ) {
            foreach ( $menus as $menu ) {
                if ( is_object( $menu ) && isset( $menu->name, $menu->slug ) ) {
                    $custom_menus[ $menu->slug ] = $menu->name;
                }
            }
        }

        $this->add_control(
            'nav_menu',
            [
                'label' => esc_html__( 'Quick Links Menu', 'uomo' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $custom_menus,
                'default' => '',
                'condition' => [
                    'style' => 'style2',
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
            'section_box_style',
            [
                'label' => esc_html__( 'Box', 'uomo' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'uomo' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'label' => esc_html__( 'Color', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .show-search-header' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Color Hover', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .show-search-header:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .show-search-header:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button', 'uomo' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Color', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .btn-search' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hv_color',
            [
                'label' => esc_html__( 'Color Hover', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .btn-search:hover, {{WRAPPER}} .btn-search:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        ?>
        
        <div class="apus-search-form <?php echo esc_attr($el_class.' '.$style); ?>">
            <?php if ( $style == 'style2' ) { ?>
                <span class="show-search-header"><i class="flaticon-loupe"></i></span>
            <?php } ?>
            <div class="apus-search-form-inner <?php echo esc_attr($style); ?>">
                <?php if ( $style == 'style2' ) { ?>
                    <div class="container">
                        <h3 class="title"><?php esc_html_e('WHAT ARE YOU LOOKING FOR?', 'uomo'); ?></h3>
                <?php } ?>
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                    <div class="main-search">
                        <?php if ( $show_auto_search ) echo '<div class="twitter-typeahead">'; ?>
                            <input type="text" placeholder="<?php esc_attr_e( 'Search products...', 'uomo' ); ?>" name="s" class="apus-search form-control <?php echo esc_attr($show_auto_search ? 'apus-autocompleate-input' : ''); ?>" autocomplete="off"/>
                        <?php if ( $show_auto_search ) echo '</div>'; ?>
                    </div>
                    <input type="hidden" name="post_type" value="product" class="post_type" />
                    <?php 
                        if ( $show_categories && uomo_is_woocommerce_activated() ) {
                            $args = array(
                                'show_count' => 0,
                                'hierarchical' => true,
                                'show_uncategorized' => 0
                            );
                            echo '<div class="select-category">';
                                wc_product_dropdown_categories( $args );
                            echo '</div>';
                        }
                    ?>
                    <button type="submit" class="btn-search">
                        <i class="flaticon-loupe"></i>
                    </button>
                </form>
                <?php if ( $style == 'style2' ) {

                        $menu_id = 0;
                        if ($nav_menu) {
                            $term = get_term_by( 'slug', $nav_menu, 'nav_menu' );
                            if ( !empty($term) ) {
                                $menu_id = $term->term_id;
                            }
                        }
                        ?>
                        <?php if ( !empty($menu_id) ) { ?>
                            <div class="quick-links-wrapper">
                                <?php if ( $quick_links_title ) {
                                    ?>
                                    <h4 class="title-quick-links"><?php echo esc_html($quick_links_title); ?></h4>
                                    <?php
                                }
                                    $nav_menu_args = array(
                                        'fallback_cb' => '',
                                        'menu'        => $menu_id
                                    );

                                    wp_nav_menu( $nav_menu_args, $menu_id );
                                ?>
                            </div>
                        <?php } ?>

                    </div>
                <?php } ?>
            </div>
            <?php if ( $style == 'style2' ) { ?>
                <div class="overlay-search-header"></div>
            <?php } ?>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Search_Form );