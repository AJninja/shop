<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Our_Store extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_our_store';
    }

	public function get_title() {
        return esc_html__( 'Uomo Our Store', 'uomo' );
    }

	public function get_categories() {
        return [ 'uomo-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Our Store', 'uomo' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'goolge_maps_api',
            [
                'label'         => esc_html__( 'Google maps api key', 'uomo' ),
                'type'          => Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'goolge_maps_style',
            [
                'label'         => esc_html__( 'Google maps style', 'uomo' ),
                'type'          => Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'map_pin',
            [
                'name' => 'image',
                'label' => esc_html__( 'Map Pin', 'uomo' ),
                'type' => Elementor\Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload map Pin Image', 'uomo' ),
            ]
        );

        $this->add_control(
            'goolge_maps_latitude',
            [
                'label'         => esc_html__( 'Center Latitude', 'uomo' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'       => '40.737'
            ]
        );

        $this->add_control(
            'goolge_maps_longitude',
            [
                'label'         => esc_html__( 'Center Longitude', 'uomo' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'       => '-73.923'
            ]
        );

        $this->add_control(
            'goolge_maps_zoom',
            [
                'label'         => esc_html__( 'Zoom', 'uomo' ),
                'type'          => Elementor\Controls_Manager::NUMBER,
                'default'       => '8'
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

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $args = array(
            'post_type' => 'ourstores',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'name',
            'order' => 'ASC',
        );

        $loop = new WP_Query($args);

        if ( $loop->have_posts() ) {
            $goolge_maps_api = !empty($goolge_maps_api) ? $goolge_maps_api : '';
            wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?libraries=places&key='.$goolge_maps_api, array( 'jquery' ), '20150330', true );

            wp_enqueue_style( 'leaflet', get_template_directory_uri() . '/js/leaflet/leaflet.css', array(), '1.5.1' );
            wp_enqueue_script( 'leaflet', get_template_directory_uri() . '/js/leaflet/leaflet.js', array( 'jquery' ), '1.5.1', true );
            wp_enqueue_script( 'leaflet-GoogleMutant', get_template_directory_uri() . '/js/leaflet/Leaflet.GoogleMutant.js', array( 'jquery' ), '1.5.1', true );
            wp_enqueue_script( 'leaflet-markercluster', get_template_directory_uri() . '/js/leaflet/leaflet.markercluster.js', array( 'jquery' ), '1.5.1', true );
            wp_enqueue_script( 'leaflet-HtmlIcon', get_template_directory_uri() . '/js/leaflet/LeafletHtmlIcon.js', array( 'jquery' ), '1.5.1', true );

            wp_enqueue_script( 'uomo-stores-maps', get_template_directory_uri() . '/js/maps.js', array( 'jquery' ), '20150330', true );
            
            $map_pin_url = '';
            if ( !empty($map_pin['id']) ) {
                $map_pin_url = wp_get_attachment_url($map_pin['id']);
            }

            wp_localize_script( 'uomo-stores-maps', 'uomo_maps_opts', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'goolge_maps_style' => $goolge_maps_style,
                'pin_url' => $map_pin_url,
                'latitude' => $goolge_maps_latitude,
                'longitude' => $goolge_maps_longitude,
                'zoom' => $goolge_maps_zoom,
            ));

            ?>
            <div class="widget widget-our-stores <?php echo esc_attr($el_class); ?>">
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <div class="store-box">
                            <form class="filter-stores" method="post">
                                <div class="inner">
                                    <input type="text" name="filter-location" id="filter-location">
                                    <input type="hidden" name="filter-latitude" id="filter-latitude">
                                    <input type="hidden" name="filter-longitude" id="filter-longitude">
                                </div>
                                <button class="filter-store-btn"><i class="flaticon-loupe"></i></button>
                            </form>
                            <div class="store-box-content">
                                <?php
                                    while ( $loop->have_posts() ): $loop->the_post();
                                        get_template_part( 'template-parts/store-content' );
                                    endwhile;
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-9">
                        <div class="store-map">
                            <div id="stores-google-maps"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Our_Store );