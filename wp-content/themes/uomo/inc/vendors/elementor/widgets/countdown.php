<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Countdown extends Widget_Base {

	public function get_name() {
        return 'apus_element_countdown';
    }

	public function get_title() {
        return esc_html__( 'Apus Countdown', 'uomo' );
    }
    
	public function get_categories() {
        return [ 'uomo-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Countdown', 'uomo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'uomo' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your sub title here', 'uomo' ),
            ]
        );
        $this->add_control(
            'end_date', [
                'label' => esc_html__( 'End Date', 'uomo' ),
                'type' => Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'enableTime' => false
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'URL', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your Button Link here', 'uomo' ),
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your button text here', 'uomo' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'uomo'),
                    'style2' => esc_html__('Style 2', 'uomo'),
                ),
                'default' => 'style1'
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
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'uomo' ),
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
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'uomo' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__( 'Sub Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .sub_title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sub_title:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Sub Typography', 'uomo' ),
                'name' => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .sub_title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_deal_style',
            [
                'label' => esc_html__( 'Deal', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'deal_color',
            [
                'label' => esc_html__( 'Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-countdown .time-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .apus-countdown .times > div span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .apus-countdown .times > div::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__( 'Button', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'button_color',
                [
                    'label' => esc_html__( 'Color', 'uomo' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        // Stronger selector to avoid section style from overwriting
                        '{{WRAPPER}} .btn-banner ' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'button_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'uomo' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        // Stronger selector to avoid section style from overwriting
                        '{{WRAPPER}} .btn-banner:hover ' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'button_line_color',
                [
                    'label' => esc_html__( 'Line Color', 'uomo' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        // Stronger selector to avoid section style from overwriting
                        '{{WRAPPER}} .btn-banner::before ' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'button_line_hover_color',
                [
                    'label' => esc_html__( 'Line Hover Color', 'uomo' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        // Stronger selector to avoid section style from overwriting
                        '{{WRAPPER}} .btn-banner:hover:before ' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Typography', 'uomo' ),
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .btn-banner',
                ]
            );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        $end_date = !empty($end_date) ? strtotime($end_date) : '';
        if ( $end_date ) {
            wp_enqueue_script( 'countdown' );
            ?>
            <div class="widget-countdown <?php echo esc_attr($el_class.' '.$style); ?>">
                <?php if($style == 'style1') {?>
                    <?php if ( !empty($sub_title) ) { ?>
                        <div class="sub_title"><?php echo trim($sub_title); ?></div>
                    <?php } ?>
                    <?php if ( !empty($title) ) { ?>
                        <h2 class="title"><?php echo trim($title); ?></h2>
                    <?php } ?>
                    <?php if ( !empty($btn_text) && !empty($link) ) { ?>
                        <div class="url-bottom">
                            <a href="<?php echo esc_url($link); ?>" class="btn-banner"><?php echo trim($btn_text); ?></a>
                        </div>
                    <?php } ?>
                    <div class="time-wrapper">
                        <div class="apus-countdown clearfix" data-time="timmer"
                            data-date="<?php echo date('m', $end_date).'-'.date('d', $end_date).'-'.date('Y', $end_date).'-'. date('H', $end_date) . '-' . date('i', $end_date) . '-' .  date('s', $end_date) ; ?>">
                        </div>
                    </div>
                <?php }else{ ?>
                    <?php if ( !empty($sub_title) ) { ?>
                        <div class="sub_title"><?php echo trim($sub_title); ?></div>
                    <?php } ?>
                    <?php if ( !empty($title) ) { ?>
                        <h2 class="title"><?php echo trim($title); ?></h2>
                    <?php } ?>
                    <div class="time-wrapper">
                        <div class="apus-countdown clearfix" data-time="timmer"
                            data-date="<?php echo date('m', $end_date).'-'.date('d', $end_date).'-'.date('Y', $end_date).'-'. date('H', $end_date) . '-' . date('i', $end_date) . '-' .  date('s', $end_date) ; ?>">
                        </div>
                    </div>
                    <?php if ( !empty($btn_text) && !empty($link) ) { ?>
                        <div class="url-bottom">
                            <a href="<?php echo esc_url($link); ?>" class="btn-banner"><?php echo trim($btn_text); ?></a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <?php
        }
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Countdown );