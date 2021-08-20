<?php
/**
 * Plugin Name: Apus Salespopup
 * Plugin URI: http://apusthemes.com/plugins/apus-salespopup/
 * Description: Create Salespopups.
 * Version: 1.0.0
 * Author: ApusTheme
 * Author URI: http://apusthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.6
 *
 * Text Domain: apus-salespopup
 * Domain Path: /languages/
 *
 * @package apus-salespopup
 * @category Plugins
 * @author ApusTheme
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("ApusSalespopup") ){
	
	final class ApusSalespopup{

		/**
		 * @var ApusSalespopup The one true ApusSalespopup
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * ApusSalespopup Settings Object
		 *
		 * @var object
		 * @since 1.0.0
		 */
		public $apussalespopup_settings;

		/**
		 *
		 */
		public function __construct() {

		}

		/**
		 * Main ApusSalespopup Instance
		 *
		 * Insures that only one instance of ApusSalespopup exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since     1.0.0
		 * @static
		 * @staticvar array $instance
		 * @uses      ApusSalespopup::setup_constants() Setup the constants needed
		 * @uses      ApusSalespopup::includes() Include the required files
		 * @uses      ApusSalespopup::load_textdomain() load the language files
		 * @see       ApusSalespopup()
		 * @return    ApusSalespopup
		 */
		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ApusSalespopup ) ) {
				self::$instance = new ApusSalespopup;
				self::$instance->setup_constants();

				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

				self::$instance->libraries();
				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 *
		 */
		public function setup_constants(){
			// Plugin version
			if ( ! defined( 'APUSSALESPOPUP_VERSION' ) ) {
				define( 'APUSSALESPOPUP_VERSION', '1.0.0' );
			}

			// Plugin Folder Path
			if ( ! defined( 'APUSSALESPOPUP_PLUGIN_DIR' ) ) {
				define( 'APUSSALESPOPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'APUSSALESPOPUP_PLUGIN_URL' ) ) {
				define( 'APUSSALESPOPUP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'APUSSALESPOPUP_PLUGIN_FILE' ) ) {
				define( 'APUSSALESPOPUP_PLUGIN_FILE', __FILE__ );
			}
		}

		public function includes() {
			global $apus_salespopup_options;

			require_once APUSSALESPOPUP_PLUGIN_DIR . 'inc/class-settings.php';

			$apus_salespopup_options = apus_salespopup_get_settings();
			
			require_once APUSSALESPOPUP_PLUGIN_DIR . 'inc/class-helper.php';
			require_once APUSSALESPOPUP_PLUGIN_DIR . 'inc/class-scripts.php';
			
		}

		public static function libraries() {
			require_once APUSSALESPOPUP_PLUGIN_DIR . 'libraries/cmb2/cmb2_field_ajax_search/cmb2-field-ajax-search.php';
			require_once APUSSALESPOPUP_PLUGIN_DIR . 'libraries/cmb2/cmb2_field_min_max/cmb2-field-min-max.php';
		}
		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for ApusSalespopup's languages directory
			$lang_dir = dirname( plugin_basename( APUSSALESPOPUP_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'apussalespopup_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-salespopup' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-salespopup', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apus-salespopup/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apussalespopup folder
				load_textdomain( 'apus-salespopup', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apussalespopup/languages/ folder
				load_textdomain( 'apus-salespopup', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-salespopup', false, $lang_dir );
			}
		}

	}
}

function apus_salespopup() {
	return ApusSalespopup::getInstance();
}

apus_salespopup();
