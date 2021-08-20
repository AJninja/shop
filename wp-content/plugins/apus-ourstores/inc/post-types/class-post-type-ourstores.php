<?php
/**
 * Store post type
 *
 * @package    apus-ourstores
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class ApusOurstores_PostType_Store{

	/**
	 * init action and filter data to define resource post type
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
		add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'fields' ) );

		// custom columns
		add_filter( 'manage_ourstores_posts_columns', array( __CLASS__, 'custom_columns' ), 100 );
		add_filter( 'manage_ourstores_posts_custom_column', array( __CLASS__, 'custom_column' ), 10, 2 );

	}
	/**
	 *
	 */
	public static function definition() {
		$labels = array(
			'name'                  => __( 'Apus Our Stores', 'apus-ourstores' ),
			'singular_name'         => __( 'Store', 'apus-ourstores' ),
			'add_new'               => __( 'Add New Store', 'apus-ourstores' ),
			'add_new_item'          => __( 'Add New Store', 'apus-ourstores' ),
			'edit_item'             => __( 'Edit Store', 'apus-ourstores' ),
			'new_item'              => __( 'New Store', 'apus-ourstores' ),
			'all_items'             => __( 'All Stores', 'apus-ourstores' ),
			'view_item'             => __( 'View Store', 'apus-ourstores' ),
			'search_items'          => __( 'Search Store', 'apus-ourstores' ),
			'not_found'             => __( 'No Stores found', 'apus-ourstores' ),
			'not_found_in_trash'    => __( 'No Stores found in Trash', 'apus-ourstores' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Apus Our Stores', 'apus-ourstores' ),
		);

		$labels = apply_filters( 'apusourstores_postype_ourstores_labels' , $labels );

		register_post_type( 'ourstores',
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'thumbnail' ),
				'public'            => false,
				'publicly_queryable' => false,
				'show_ui'            => true,
				'has_archive'        => false,
				'rewrite'           => array( 'slug' => __( 'ourstores', 'apus-ourstores' ) ),
				'menu_position'     => 51,
				'show_in_menu'  	=> true,
			)
		);
	}
	
	/**
	 * Defines custom fields
	 *
	 * @access public
	 * @param array $metaboxes
	 * @return array
	 */
	public static function fields( array $metaboxes ) {
		$prefix = '_store_';
		$metaboxes[ $prefix . 'general_information' ] = array(
			'id'                        => $prefix . 'general_information',
			'title'                     => __( 'General Information', 'apus-ourstores' ),
			'object_types'              => array( 'ourstores' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'show_in_rest'				=> true,
			'fields'                    => array(
				array(
					'id'                => $prefix . 'address',
					'name'              => __( 'Address', 'apus-ourstores' ),
					'type'              => 'text',
				),
				array(
					'id'                => $prefix . 'phone',
					'name'              => __( 'Phone', 'apus-ourstores' ),
					'type'              => 'text',
				),
				array(
					'id'                => $prefix . 'working_hours',
					'name'              => __( 'Working hours', 'apus-ourstores' ),
					'type'              => 'text',
				),
				array(
					'id'                => $prefix . 'latitude',
					'name'              => __( 'Maps Latitude', 'apus-ourstores' ),
					'type'              => 'text',
				),
				array(
					'id'                => $prefix . 'longitude',
					'name'              => __( 'Maps Longitude', 'apus-ourstores' ),
					'type'              => 'text',
				),
			),
		);

		return $metaboxes;
	}

	public static function custom_columns( $columns ) {
		if ( ! is_array( $columns ) ) {
			$columns = array();
		}
		foreach($columns as $key => $title) {
			$new[$key] = $title;
		    if ($key == 'title') {
		      	$new['address'] = esc_html__('Address', 'apus-ourstores');
		      	$new['phone'] = esc_html__('Phone', 'apus-ourstores');
		    }
	  	}
		return $new;
	}

	public static function custom_column( $column, $post_id ) {
		$post = get_post($post_id);

		switch ( $column ) {
	        case 'address' :
	        	echo get_post_meta($post->ID, 'address', true);
            break;
            case 'phone' :
	        	echo get_post_meta($post->ID, 'phone', true);
            break;
	    }
	}
}

ApusOurstores_PostType_Store::init();