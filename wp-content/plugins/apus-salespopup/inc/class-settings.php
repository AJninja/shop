<?php
/**
 * Settings
 *
 * @package    apus-salespopup
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
class ApusSalespopup_Settings {
	/**
	 * Option key, and option page slug
	 * @var string
	 */
	private $key = 'apus_salespopup_settings';

	/**
	 * Array of metaboxes/fields
	 * @var array
	 */
	protected $option_metabox = array();

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor
	 * @since 1.0
	 */
	public function __construct() {
	
		add_action( 'admin_menu', array( $this, 'admin_menu' ) , 10 );

		add_action( 'admin_init', array( $this, 'init' ) );

		//Custom CMB2 Settings Fields
		add_action( 'cmb2_render_apus_salespopup_title', 'apus_salespopup_title_callback', 10, 5 );

		add_action( "cmb2_save_options-page_fields", array( $this, 'settings_notices' ), 10, 3 );


		add_action( 'cmb2_render_api_keys', 'apus_salespopup_api_keys_callback', 10, 5 );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-apus_salespopup_properties_page_job_listing-settings", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	public function admin_menu() {
		//Settings
	 	// $apus_salespopup_settings_page = add_submenu_page( 'edit.php?post_type=job_listing', __( 'Settings', 'apus-salespopup' ), __( 'Settings', 'apus-salespopup' ), 'manage_options', 'job_listing-settings',
	 	// 	array( $this, 'admin_page_display' ) );

	 	add_menu_page(__( 'Sales Popup', 'apus-salespopup' ), __( 'Sales Popup', 'apus-salespopup' ), 'manage_options', 'salespopup-settings', array( $this, 'admin_page_display' ), '', 10 );
	}

	/**
	 * Register our setting to WP
	 * @since  1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Retrieve settings tabs
	 *
	 * @since 1.0
	 * @return array $tabs
	 */
	public function get_settings_tabs() {
		$tabs             	  = array();
		$tabs['general']  	  = __( 'General', 'apus-salespopup' );
		$tabs['popup_data']   = __( 'Popup data', 'apus-salespopup' );

		return apply_filters( 'apus_salespopup_settings_tabs', $tabs );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  1.0
	 */
	public function admin_page_display() {

		$active_tab = isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $this->get_settings_tabs() ) ? $_GET['tab'] : 'general';

		?>

		<div class="wrap apus_salespopup_settings_page cmb2_options_page <?php echo $this->key; ?>">
			<h2 class="nav-tab-wrapper">
				<?php
				foreach ( $this->get_settings_tabs() as $tab_id => $tab_name ) {

					$tab_url = esc_url( add_query_arg( array(
						'settings-updated' => false,
						'tab'              => $tab_id
					) ) );

					$active = $active_tab == $tab_id ? ' nav-tab-active' : '';

					echo '<a href="' . esc_url( $tab_url ) . '" title="' . esc_attr( $tab_name ) . '" class="nav-tab' . $active . '">';
					echo esc_html( $tab_name );

					echo '</a>';
				}
				?>
			</h2>
			
			<?php cmb2_metabox_form( $this->apus_salespopup_settings( $active_tab ), $this->key ); ?>

		</div><!-- .wrap -->

		<?php
	}

	/**
	 * Define General Settings Metabox and field configurations.
	 *
	 * Filters are provided for each settings section to allow add-ons and other plugins to add their own settings
	 *
	 * @param $active_tab active tab settings; null returns full array
	 *
	 * @return array
	 */
	public function apus_salespopup_settings( $active_tab ) {

		$pages = apus_salespopup_cmb2_get_post_options( array(
			'post_type'   => 'page',
			'numberposts' => - 1
		) );

		$apus_salespopup_settings = array();

		// General
		$apus_salespopup_settings['general'] = array(
			'id'         => 'options_page',
			'apus_salespopup_title' => __( 'General Settings', 'apus-salespopup' ),
			'show_on'    => array( 'key' => 'options-page', 'value' => array( $this->key, ), ),
			'fields'     => apply_filters( 'apus_salespopup_settings_general', array(
				
				array(
					'name'    => __( 'Enable Sales Popup', 'apus-salespopup' ),
					'id'      => 'enable_sales_popup',
					'type'    => 'select',
					'options' => array(
						'on' 	=> __( 'Enable', 'apus-salespopup' ),
						'off'   => __( 'Disable', 'apus-salespopup' ),
					),
					'default' => 'on',
				),

				array(
					'name'    => __( 'Disable On Mobile', 'apus-salespopup' ),
					'id'      => 'disable_on_mobile',
					'type'    => 'select',
					'options' => array(
						'on' 	=> __( 'Enable', 'apus-salespopup' ),
						'off'   => __( 'Disable', 'apus-salespopup' ),
					),
					'default' => 'on',
				),

				array(
					'name'    => __( 'Minimum Time Thresholds', 'apus-salespopup' ),
					'id'      => 'min_time',
					'type'    => 'text',
					'default' => '15000',
				),

				array(
					'name'    => __( 'Maximum Time Thresholds', 'apus-salespopup' ),
					'id'      => 'max_time',
					'type'    => 'text',
					'default' => '25000',
				),

				array(
					'name'    => __( 'Popup Text', 'apus-salespopup' ),
					'id'      => 'popup_text',
					'type'    => 'textarea_code',
					'default' => 'Someone in {address} purchased a {product_name} <small>About {purchased_time} {time_unit} ago</small>',
				),

			) )		 
		);

		// Popup Data
		$apus_salespopup_settings['popup_data'] = array(
			'id'         => 'options_page',
			'apus_salespopup_title' => __( 'Popup Data', 'apus-salespopup' ),
			'show_on'    => array( 'key' => 'options-page', 'value' => array( $this->key, ), ),
			'fields'     => apply_filters( 'apus_salespopup_settings_popup_data', array(
				array(
					'name'          => __( 'Products', 'apus-salespopup' ),
					
					'id'            => 'products',
					'type'          => 'post_ajax_search',
					'multiple'      => true,
					'query_args'	=> array(
						'post_type'			=> array( 'product' ),
						'posts_per_page'	=> -1
					),
					'attributes' => array(
						'placeholder'   => __( 'Type any keyword to search', 'apus-salespopup' ),
					)
				),
				array(
					'name'    => __( 'Add Multiple Addresses', 'apus-salespopup' ),
					'desc' => __('Each address per line', 'apus-salespopup'),
					'id'      => 'multiple_address',
					'type'    => 'textarea',
				),
				array(
					'name' => __( 'Buy Time Randomly', 'wp-salespopup' ),
					'type' => 'wp_salespopup_title',
					'id'   => 'wp_salespopup_title_general_settings_1',
					'before_row' => '<hr>',
					'after_row'  => '<hr>'
				),
				array(
					'name'    => __( 'Time In Second', 'apus-salespopup' ),
					'id'      => 'time_in_second',
					'type'    => 'min_max',
				),

				array(
					'name'    => __( 'Time In Minutes', 'apus-salespopup' ),
					'id'      => 'time_in_minutes',
					'type'    => 'min_max',
				),

				array(
					'name'    => __( 'Time In Hours', 'apus-salespopup' ),
					'id'      => 'time_in_hours',
					'type'    => 'min_max',
				),

				array(
					'name'    => __( 'Time In Days', 'apus-salespopup' ),
					'id'      => 'time_in_days',
					'type'    => 'min_max',
				),

			) )		 
		);

		if ( $active_tab === null   ) {  
			return apply_filters( 'apus_salespopup_registered_settings', $apus_salespopup_settings );
		}

		// Add other tabs and settings fields as needed
		return apply_filters( 'apus_salespopup_registered_'.$active_tab.'_settings', isset($apus_salespopup_settings[ $active_tab ])?$apus_salespopup_settings[ $active_tab ]:array() );
	}


	/**
	 * Show Settings Notices
	 *
	 * @param $object_id
	 * @param $updated
	 * @param $cmb
	 */
	public function settings_notices( $object_id, $updated, $cmb ) {

		//Sanity check
		if ( $object_id !== $this->key ) {
			return;
		}

		if ( did_action( 'cmb2_save_options-page_fields' ) === 1 ) {
			settings_errors( 'apus_salespopup-notices' );
		}

		add_settings_error( 'apus_salespopup-notices', 'global-settings-updated', __( 'Settings updated.', 'apus-salespopup' ), 'updated' );

	}


	/**
	 * Public getter method for retrieving protected/private variables
	 *
	 * @since  1.0
	 *
	 * @param  string $field Field to retrieve
	 *
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {

		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'fields', 'apus_salespopup_title', 'options_page' ), true ) ) {
			return $this->{$field};
		}
		if ( 'option_metabox' === $field ) {
			return $this->option_metabox();
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}


// Get it started
$ApusSalespopup_Settings = new ApusSalespopup_Settings();

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 *
 * @param  string $key Options array key
 *
 * @return mixed        Option value
 */
function apus_salespopup_get_option( $key = '', $default = false ) {
	global $apus_salespopup_options;
	$value = isset( $apus_salespopup_options[ $key ] ) ? $apus_salespopup_options[ $key ] : $default;
	$value = apply_filters( 'apus_salespopup_get_option', $value, $key, $default );

	return apply_filters( 'apus_salespopup_get_option_' . $key, $value, $key, $default );
}



/**
 * Get Settings
 *
 * Retrieves all WP_Job_Board plugin settings
 *
 * @since 1.0
 * @return array WP_Job_Board settings
 */
function apus_salespopup_get_settings() {
	return apply_filters( 'apus_salespopup_get_settings', get_option( 'apus_salespopup_settings' ) );
}


/**
 * WP_Job_Board Title
 *
 * Renders custom section titles output; Really only an <hr> because CMB2's output is a bit funky
 *
 * @since 1.0
 *
 * @param       $field_object , $escaped_value, $object_id, $object_type, $field_type_object
 *
 * @return void
 */
function apus_salespopup_title_callback( $field_object, $escaped_value, $object_id, $object_type, $field_type_object ) {

	$id                = $field_type_object->field->args['id'];
	$title             = $field_type_object->field->args['name'];
	$field_description = $field_type_object->field->args['desc'];
	if ( $field_description ) {
		echo '<div class="desc">'.$field_description.'</div>';
	}
}


/**
 * Gets a number of posts and displays them as options
 *
 * @param  array $query_args Optional. Overrides defaults.
 * @param  bool  $force      Force the pages to be loaded even if not on settings
 *
 * @see: https://github.com/WebDevStudios/CMB2/wiki/Adding-your-own-field-types
 * @return array An array of options that matches the CMB2 options array
 */
function apus_salespopup_cmb2_get_post_options( $query_args, $force = false ) {

	$post_options = array( '' => '' ); // Blank option

	if ( ( ! isset( $_GET['page'] ) || 'job_listing-settings' != $_GET['page'] ) && ! $force ) {
		return $post_options;
	}

	$args = wp_parse_args( $query_args, array(
		'post_type'   => 'page',
		'numberposts' => 10,
	) );

	$posts = get_posts( $args );

	if ( $posts ) {
		foreach ( $posts as $post ) {

			$post_options[ $post->ID ] = $post->post_title;

		}
	}

	return $post_options;
}


/**
 * Modify CMB2 Default Form Output
 *
 * @param string @args
 *
 * @since 1.0
 */

add_filter( 'cmb2_get_metabox_form_format', 'apus_salespopup_modify_cmb2_form_output', 10, 3 );

function apus_salespopup_modify_cmb2_form_output( $form_format, $object_id, $cmb ) {

	//only modify the apus_salespopup settings form
	if ( 'apus_salespopup_settings' == $object_id && 'options_page' == $cmb->cmb_id ) {

		return '<form class="cmb-form" method="post" id="%1$s" enctype="multipart/form-data" encoding="multipart/form-data"><input type="hidden" name="object_id" value="%2$s">%3$s<div class="apus_salespopup-submit-wrap"><input type="submit" name="submit-cmb" value="' . __( 'Save Settings', 'apus-salespopup' ) . '" class="button-primary"></div></form>';
	}

	return $form_format;

}