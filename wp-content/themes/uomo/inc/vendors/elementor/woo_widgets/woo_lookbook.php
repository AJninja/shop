<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Woo_Lookbook extends Widget_Base {

	public function get_name() {
        return 'apus_element_woo_lookbook';
    }

	public function get_title() {
        return esc_html__( 'Apus Lookbook', 'uomo' );
    }

    public function get_icon() {
        return 'fa fa-shopping-bag';
    }

	public function get_categories() {
        return [ 'uomo-elements' ];
    }

	protected function _register_controls() {
        $posts = get_posts(
            array(
                'post_type' => 'lookbook',
                'number' => -1,
            )
        );
        $pposts = [ '' => esc_html__('Choose a lookbook', 'uomo') ];
        if ( !empty($posts) ) {
            foreach ($posts as $post) {
                $pposts[$post->post_name] = $post->post_title;
            }
        }
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'uomo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'lookbook',
            [
                'label' => esc_html__( 'Lookbook', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => $pposts,
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Carousel Style', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'uomo'),
                    'style2' => esc_html__('Style 2', 'uomo'),
                    'style3' => esc_html__('Style 3', 'uomo'),
                ),
                'default' => 'style1',
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

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($lookbook) ) {
            ?>
            <div class="widget widget-lookbook <?php echo esc_attr($el_class); ?>">
               <?php echo do_shortcode('[lookbook slug="'.$lookbook.'" style="'.$style.'"]'); ?>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Woo_Lookbook );