<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Vertical_Menu extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_vertical_menu';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Vertical Menu', 'uomo' );
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
            'title',
            [
                'label' => esc_html__( 'Title', 'uomo' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'All Departments'
            ]
        );

        $this->add_responsive_control(
            'show_menu',
            [
                'label' => esc_html__( 'Show menu condition', 'uomo' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'show-always' => esc_html__( 'Always', 'uomo' ),
                    'show-in-home' => esc_html__( 'In home page', 'uomo' ),
                    'show-hover' => esc_html__( 'When hover', 'uomo' ),
                ],
                'default' => 'show-in-home'
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'uomo' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Style 1', 'uomo'),
                    'style2' => esc_html__('Style 2', 'uomo'),
                ),
                'default' => ''
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
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'uomo' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color Title', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .vertical-wrapper .title-vertical' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-icon' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-icon:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_title_color',
            [
                'label' => esc_html__( 'Background Color Title', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .vertical-wrapper .title-vertical' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding-title',
            [
                'label' => esc_html__( 'Title Padding', 'uomo' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .title-vertical' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius_title',
            [
                'label' => esc_html__( 'Title Border Radius', 'uomo' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .title-vertical, {{WRAPPER}} .apus-vertical-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => esc_html__( 'Link Color', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .apus-vertical-menu > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'uomo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .apus-vertical-menu > li:hover > a,{{WRAPPER}} .apus-vertical-menu > li.active > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( has_nav_menu( 'vertical-menu' ) ) { ?>
            <div class="vertical-wrapper <?php echo esc_attr($el_class.' '.$show_menu.' '.$style); ?>">

                <?php if(!empty($title)){ ?>
                    <?php if($style == 'style2') { ?>
                        <h2 class="title-vertical flex-middle"><i class="vertical-icon"></i><span><?php echo trim($title); ?></span><i class="ti-angle-down"></i></h2>
                    <?php }else{ ?>
                        <h2 class="title-vertical"><?php echo trim($title); ?></h2>
                    <?php } ?>
                <?php } ?>

                <?php
                    $args = array(
                        'theme_location' => 'vertical-menu',
                        'container_class' => 'content-vertical',
                        'menu_class' => 'apus-vertical-menu nav navbar-nav',
                        'fallback_cb' => '',
                        'menu_id' => 'vertical-menu',
                        'walker' => new Uomo_Nav_Menu()
                    );
                    wp_nav_menu($args);
                ?>
            </div>
        <?php
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Vertical_Menu );