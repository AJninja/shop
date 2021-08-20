<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Mailchimp extends Widget_Base {

	public function get_name() {
        return 'apus_element_mailchimp';
    }

	public function get_title() {
        return esc_html__( 'Apus MailChimp Sign-Up Form', 'uomo' );
    }
    
	public function get_categories() {
        return [ 'uomo-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'MailChimp Sign-Up Form', 'uomo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'st1' => esc_html__('Style 1', 'uomo'),
                    'st2' => esc_html__('Style 2', 'uomo'),
                ),
                'default' => 'st1'
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

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Style Button', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
            $this->start_controls_tab(
                'style_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'uomo' ),
                ]
            );
                $this->add_control(
                    'button_color',
                    [
                        'label' => esc_html__( 'Text Color', 'uomo' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            // Stronger selector to avoid section style from overwriting
                            '{{WRAPPER}} .btn ' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_bg_color',
                    [
                        'label' => esc_html__( 'BG Color', 'uomo' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            // Stronger selector to avoid section style from overwriting
                            '{{WRAPPER}} .btn ' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_br_color',
                    [
                        'label' => esc_html__( 'Border Color', 'uomo' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            // Stronger selector to avoid section style from overwriting
                            '{{WRAPPER}} .btn ' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'style_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'uomo' ),
                ]
            );

                $this->add_control(
                    'button_hv_color',
                    [
                        'label' => esc_html__( 'Text Color', 'uomo' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            // Stronger selector to avoid section style from overwriting
                            '{{WRAPPER}} .btn:focus ' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .btn:hover ' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_hv_bg_color',
                    [
                        'label' => esc_html__( 'BG Color', 'uomo' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            // Stronger selector to avoid section style from overwriting
                            '{{WRAPPER}} .btn:hover ' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .btn:focus ' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_hv_br_color',
                    [
                        'label' => esc_html__( 'Border Color', 'uomo' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            // Stronger selector to avoid section style from overwriting
                            '{{WRAPPER}} .btn:hover ' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .btn:focus ' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'uomo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_input_style',
            [
                'label' => esc_html__( 'Style Input', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label' => esc_html__( 'Text Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} [type="email"] ' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'input_pl_color',
            [
                'label' => esc_html__( 'Placeholder Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} [type="email"]::-moz-placeholder ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} [type="email"]:-ms-input-placeholder ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} [type="email"]:-moz-placeholder ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label' => esc_html__( 'BG Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} [type="email"] ' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_br_color',
            [
                'label' => esc_html__( 'Border Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} [type="email"] ' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_input_radius',
            [
                'label' => esc_html__( 'Border Radius', 'uomo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} [type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-mailchimp <?php echo esc_attr($el_class.' '.$style); ?>">
            <?php
            if ( function_exists('mc4wp_show_form') ) {
                mc4wp_show_form('');
            }
            ?>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Mailchimp );