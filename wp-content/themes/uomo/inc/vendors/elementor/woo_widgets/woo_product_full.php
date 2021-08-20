<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Woo_Product_Full extends Widget_Base {

	public function get_name() {
        return 'apus_element_woo_product_full';
    }

	public function get_title() {
        return esc_html__( 'Apus Product Full', 'uomo' );
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

        $this->add_control(
            'product_id', [
                'label' => esc_html__( 'Product ID', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your product id here', 'uomo' ),
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
        $product_id = !empty($product_id) ? $product_id : '';

        if ( $product_id && ($post_object = get_post( $product_id )) ) {
            
        ?>
            <div class="woocommerce widget-product-full <?php echo esc_attr($el_class); ?>">
                <?php if ( !empty($title) ): ?>
                    <h3 class="widget-title">
                        <?php echo esc_attr( $title ); ?>
                    </h3>
                <?php endif; ?>
                <div class="widget-content">
                    
                    <?php
                    
                    setup_postdata( $GLOBALS['post'] =& $post_object );

                    ?>
                        <div <?php wc_product_class( '', $post_object ); ?>>
                            <?php wc_get_template_part( 'item-product/inner-full' ); ?>
                        </div>
                    <?php

                    wp_reset_postdata();
                    ?>

                </div>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Woo_Product_Full );