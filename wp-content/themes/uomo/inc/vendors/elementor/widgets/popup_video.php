<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Popup_Video extends Widget_Base {

	public function get_name() {
        return 'apus_element_popup_video';
    }

	public function get_title() {
        return esc_html__( 'Apus Popup Video', 'uomo' );
    }

	public function get_icon() {
        return 'eicon-youtube';
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

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'uomo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .video-inner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'uomo' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'uomo' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => esc_html__( 'Youtube Video Link', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your button text here', 'uomo' ),
                'condition' => [
                    'style' => ['style1', 'style2'],
                ],
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your Button Link here', 'uomo' ),
                'condition' => [
                    'style' => ['style1', 'style2'],
                ],
            ]
        );
        
        $this->add_control(
            'btn_style',
            [
                'label' => esc_html__( 'Button Style', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'btn-default' => esc_html__('Default ', 'uomo'),
                    'btn-primary' => esc_html__('Primary ', 'uomo'),
                    'btn-success' => esc_html__('Success ', 'uomo'),
                    'btn-info' => esc_html__('Info ', 'uomo'),
                    'btn-warning' => esc_html__('Warning ', 'uomo'),
                    'btn-danger' => esc_html__('Danger ', 'uomo'),
                    'btn-pink' => esc_html__('Pink ', 'uomo'),
                    'btn-yellow' => esc_html__('Yellow ', 'uomo'),
                ),
                'default' => 'btn-yellow',
                'condition' => [
                    'style' => ['style1', 'style2'],
                ],
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
                    'style3' => esc_html__('Style 3', 'uomo'),
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
            'section_box',
            [
                'label' => esc_html__( 'Style Box', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'uomo' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .widget-video',
            ]
        );

        $this->end_controls_section();

        // Section Column Background Overlay.
        $this->start_controls_section(
            'box_background_overlay',
            [
                'label' => esc_html__( 'Background Overlay', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'background_background' => [ 'classic', 'gradient' ],
                ],
            ]
        );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'background_overlay',
                    'selector' => '{{WRAPPER}} .bg-overlay',
                ]
            );

            $this->add_control(
                'background_overlay_opacity',
                [
                    'label' => esc_html__( 'Opacity', 'uomo' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => .5,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 1,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bg-overlay' => 'opacity: {{SIZE}};',
                    ],
                    'condition' => [
                        'background_overlay_background' => [ 'classic', 'gradient' ],
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'css_filters',
                    'selector' => '{{WRAPPER}} .bg-overlay',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Style Inner', 'uomo' ),
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
                    '{{WRAPPER}} .title-video' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'uomo' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title-video',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'uomo' ),
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );
        $has_background_overlay = in_array( $settings['background_overlay_background'], [ 'classic', 'gradient' ], true );
        ?>

        <?php if($style == 'style3') { ?>
            <div class="widget-video-v2 text-center <?php echo esc_attr($el_class.' '.$style);?>">
                <?php if($has_background_overlay) { ?>
                    <div class="bg-overlay"></div>
                <?php } ?>
                <div class="container">
                    <div class="video-inner-v2">
                        <?php if ( !empty($title) ) { ?>
                            <h2 class="title-video">
                                <?php echo trim($title); ?>
                            </h2>
                        <?php } ?>
                        <a class="popup-video" href="<?php echo esc_url($video_link); ?>">
                            <span class="description">
                                <?php echo trim($content); ?>
                                <span class="popup-video-inner">
                                    <i class="flaticon-play"></i>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
            <div class="widget-video <?php echo esc_attr($el_class.' '.$style);?>">
                <?php if($has_background_overlay) { ?>
                    <div class="bg-overlay"></div>
                <?php } ?>
                <div class="container">
                    <div class="video-inner">
                        <a class="popup-video st-circle clearfix" href="<?php echo esc_url($video_link); ?>">
                            <span class="popup-video-inner">
                                <i class="flaticon-play"></i>
                            </span>
                        </a>
                        <div class="video-content">

                            <?php if ( !empty($title) ) { ?>
                                <h2 class="title-video">
                                    <?php echo trim($title); ?>
                                </h2>
                            <?php } ?>

                            <?php if ( !empty($content) ) { ?>
                                <div class="description"><?php echo trim($content); ?></div>
                            <?php } ?>

                            <?php if( !empty($btn_link) && !empty($btn_text) ) { ?>
                                <div class="action">
                                    <a class="btn radius-6x <?php echo esc_attr(!empty($btn_style) ? $btn_style : ''); ?>" href="<?php echo esc_url( $btn_link ); ?>"><?php echo trim( $btn_text ); ?></a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Popup_Video );