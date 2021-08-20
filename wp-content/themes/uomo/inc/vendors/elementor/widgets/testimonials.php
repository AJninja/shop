<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Testimonials extends Widget_Base {

	public function get_name() {
        return 'apus_element_testimonials';
    }

	public function get_title() {
        return esc_html__( 'Apus Testimonials', 'uomo' );
    }

	public function get_icon() {
        return 'eicon-testimonial';
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

        $repeater = new Repeater();

        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Header Title', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Choose Image', 'uomo' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Brand Image', 'uomo' ),
            ]
        );

        $repeater->add_control(
            'description', [
                'label' => esc_html__( 'Description', 'uomo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Description' , 'uomo' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'info',
            [
                'label' => esc_html__( 'Info', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'job',
            [
                'label' => esc_html__( 'Job', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials', 'uomo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label' => esc_html__( 'Show Nav', 'uomo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => true,
                'return_value'  => true,
                'label_on' => esc_html__( 'Hide', 'uomo' ),
                'label_off' => esc_html__( 'Show', 'uomo' ),
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => esc_html__( 'Show Pagination', 'uomo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => true,
                'return_value'  => true,
                'label_on' => esc_html__( 'Hide', 'uomo' ),
                'label_off' => esc_html__( 'Show', 'uomo' ),
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
            ]
        );
        
        $this->add_responsive_control(
            'banner_align',
            [
                'label' => esc_html__( 'Alignment', 'uomo' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'uomo' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonials-item' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'uomo' ),
                'type' => Controls_Manager::SELECT,
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
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'uomo' ),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Style', 'uomo' ),
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
            'test_description_color',
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
                'name' => 'test_description_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'test_info_color',
            [
                'label' => esc_html__( 'Info Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Info Typography', 'uomo' ),
                'name' => 'test_info_typography',
                'selector' => '{{WRAPPER}} .info',
            ]
        );

        $this->add_control(
            'job',
            [
                'label' => esc_html__( 'Job Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Job Typography', 'uomo' ),
                'name' => 'test_job_typography',
                'selector' => '{{WRAPPER}} .job',
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => esc_html__( 'Dots Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .slick-dots li button ' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dots_hover_color',
            [
                'label' => esc_html__( 'Dots Hover Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($testimonials) ) {
            ?>
            <div class="widget-testimonials <?php echo esc_attr($el_class.' '.$style); ?>">
                <div class="slick-carousel testimonial-main" data-items="1" data-smallmedium="1" data-extrasmall="1" 
                data-pagination="<?php echo esc_attr($show_pagination ? 'true' : 'false'); ?>" data-nav="<?php echo esc_attr($show_nav ? 'true' : 'false'); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>"
                >
                    <?php foreach ($testimonials as $item) { ?>
                        <div class="item">
                            <?php if($style == 'style2') { ?>
                                <div class="testimonials-item-v2">
                                    <div class="clearfix">
                                        <?php if ( !empty($item['title']) ) { ?>
                                            <h3 class="title"><?php echo trim($item['title']); ?></h3>
                                        <?php } ?>
                                        <?php if ( !empty($item['description']) ) { ?>
                                            <div class="description"><?php echo trim($item['description']); ?></div>
                                        <?php } ?>
                                        <div class="bottom-info flex-middle">
                                            <?php
                                            $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                                            $img_rating_src = ( isset( $item['img_rating_src']['id'] ) && $item['img_rating_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_rating_src']['id'] ) : '';
                                            if ( $img_src ) {
                                            ?>
                                                <div class="avarta">
                                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                                </div>
                                            <?php } ?>
                                            <div class="info-testimonials">
                                                <?php if ( !empty($item['info']) ) { ?>
                                                    <h3 class="name-client info"><?php echo trim($item['info']); ?></h3>
                                                <?php } ?>
                                                <?php if ( !empty($item['job']) ) { ?>
                                                    <div class="job"><?php echo trim($item['job']); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="testimonials-item">
                                    <div class="clearfix">

                                        <?php if ( !empty($item['description']) ) { ?>
                                            <div class="description"><?php echo trim($item['description']); ?></div>
                                        <?php } ?>

                                        <?php if ( !empty($item['info']) ) { ?>
                                            <div class="info"><?php echo trim($item['info']); ?></div>
                                        <?php } ?>

                                        <?php
                                        $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                                        $img_rating_src = ( isset( $item['img_rating_src']['id'] ) && $item['img_rating_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_rating_src']['id'] ) : '';
                                        if ( $img_src ) {
                                        ?>
                                            <div class="avarta">
                                                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Testimonials );