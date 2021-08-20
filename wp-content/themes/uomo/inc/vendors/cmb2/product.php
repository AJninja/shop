<?php

if ( !function_exists( 'uomo_product_metaboxes' ) ) {
	function uomo_product_metaboxes(array $metaboxes) {
		$prefix = 'apus_product_';
        $headers = array_merge( array('global' => esc_html__( 'Global Setting', 'uomo' )), uomo_get_header_layouts() );
	    $fields = array(
            array(
                'id' => $prefix.'header_type',
                'type' => 'select',
                'name' => esc_html__('Header Layout Type', 'uomo'),
                'options' => $headers
            ),
	    	array(
                'id' => $prefix.'layout_type',
                'type' => 'select',
                'name' => esc_html__('Layout Type', 'uomo'),
                'options' => array(
                    '' => esc_html__('Global Settings', 'uomo'),
                    'v1' => esc_html__('Layout 1', 'uomo'),
                    'v2' => esc_html__('Layout 2', 'uomo'),
                    'v3' => esc_html__('Layout 3', 'uomo'),
                    'v4' => esc_html__('Layout 4', 'uomo'),
                    'v5' => esc_html__('Layout 5', 'uomo'),
                    'v6' => esc_html__('Layout 6', 'uomo'),
                    'v7' => esc_html__('Layout 7', 'uomo'),
                    'v8' => esc_html__('Layout 8', 'uomo'),
                    'v9' => esc_html__('Layout 9', 'uomo'),
                    'v10' => esc_html__('Layout 10', 'uomo'),
                    'v11' => esc_html__('Layout 11', 'uomo'),
                )
            ),
            array(
                'id' => $prefix.'bg_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Background Color', 'uomo'),
                'description' => esc_html__('For Layout 2 and Layout 3', 'uomo'),
            ),
	    	array(
				'name' => esc_html__( 'Review Video', 'uomo' ),
				'id'   => $prefix.'review_video',
				'type' => 'text',
				'description' => esc_html__( 'You can enter a video youtube or vimeo', 'uomo' ),
			),
    	);
		
		if ( uomo_is_sizeguides_activated() ) {
			$fields[] = array(
                'id' => $prefix.'sizeguides_enable',
                'type' => 'select',
                'name' => esc_html__('Size Guides Enable', 'uomo'),
                'options' => array(
                    '' => esc_html__('Global Settings', 'uomo'),
                    'enable' => esc_html__('Enable', 'uomo'),
                    'disable' => esc_html__('Disable', 'uomo'),
                )
            );
		}

	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'More Information', 'uomo' ),
			'object_types'              => array( 'product' ),
			'context'                   => 'normal',
			'priority'                  => 'low',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'uomo_product_metaboxes' );
