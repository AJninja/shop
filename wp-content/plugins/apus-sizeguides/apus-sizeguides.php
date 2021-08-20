<?php
/**
 * Plugin Name: Apus Sizeguides
 * Plugin URI: http://apusthemes.com/plugins/apus-sizeguides/
 * Description: Create Sizeguidess.
 * Version: 1.0.0
 * Author: ApusTheme
 * Author URI: http://apusthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.6
 *
 * Text Domain: apus-sizeguides
 * Domain Path: /languages/
 *
 * @package apus-sizeguides
 * @category Plugins
 * @author ApusTheme
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("ApusSizeguides") ){
	
	final class ApusSizeguides{

		/**
		 * @var ApusSizeguides The one true ApusSizeguides
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * ApusSizeguides Settings Object
		 *
		 * @var object
		 * @since 1.0.0
		 */
		public $apussizeguides_settings;

		/**
		 *
		 */
		public function __construct() {

		}

		/**
		 * Main ApusSizeguides Instance
		 *
		 * Insures that only one instance of ApusSizeguides exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since     1.0.0
		 * @static
		 * @staticvar array $instance
		 * @uses      ApusSizeguides::setup_constants() Setup the constants needed
		 * @uses      ApusSizeguides::includes() Include the required files
		 * @uses      ApusSizeguides::load_textdomain() load the language files
		 * @see       ApusSizeguides()
		 * @return    ApusSizeguides
		 */
		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ApusSizeguides ) ) {
				self::$instance = new ApusSizeguides;
				self::$instance->setup_constants();

				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				
				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 *
		 */
		public function setup_constants(){
			// Plugin version
			if ( ! defined( 'APUSSIZEGUIDES_VERSION' ) ) {
				define( 'APUSSIZEGUIDES_VERSION', '1.0.0' );
			}

			// Plugin Folder Path
			if ( ! defined( 'APUSSIZEGUIDES_PLUGIN_DIR' ) ) {
				define( 'APUSSIZEGUIDES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'APUSSIZEGUIDES_PLUGIN_URL' ) ) {
				define( 'APUSSIZEGUIDES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'APUSSIZEGUIDES_PLUGIN_FILE' ) ) {
				define( 'APUSSIZEGUIDES_PLUGIN_FILE', __FILE__ );
			}
		}

		public function includes() {
			require_once APUSSIZEGUIDES_PLUGIN_DIR . 'inc/class-settings.php';
			require_once APUSSIZEGUIDES_PLUGIN_DIR . 'inc/class-helper.php';
			
			require_once APUSSIZEGUIDES_PLUGIN_DIR . 'inc/class-template-loader.php';
			require_once APUSSIZEGUIDES_PLUGIN_DIR . 'inc/class-scripts.php';
		}
		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for ApusSizeguides's languages directory
			$lang_dir = dirname( plugin_basename( APUSSIZEGUIDES_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'apussizeguides_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-sizeguides' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-sizeguides', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apus-sizeguides/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apussizeguides folder
				load_textdomain( 'apus-sizeguides', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apussizeguides/languages/ folder
				load_textdomain( 'apus-sizeguides', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-sizeguides', false, $lang_dir );
			}
		}

	}
}

function apus_sizeguides() {
	return ApusSizeguides::getInstance();
}

apus_sizeguides();
