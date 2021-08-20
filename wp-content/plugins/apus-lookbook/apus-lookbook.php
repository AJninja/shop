<?php
/**
 * Plugin Name: Apus Lookbook
 * Plugin URI: http://apusthemes.com/plugins/apus-lookbook/
 * Description: Create Lookbooks.
 * Version: 1.0.0
 * Author: ApusTheme
 * Author URI: http://apusthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.6
 *
 * Text Domain: apus-lookbook
 * Domain Path: /languages/
 *
 * @package apus-lookbook
 * @category Plugins
 * @author ApusTheme
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("ApusLookbook") ){
	
	final class ApusLookbook{

		/**
		 * @var ApusLookbook The one true ApusLookbook
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * ApusLookbook Settings Object
		 *
		 * @var object
		 * @since 1.0.0
		 */
		public $apuslookbook_settings;

		/**
		 *
		 */
		public function __construct() {

		}

		/**
		 * Main ApusLookbook Instance
		 *
		 * Insures that only one instance of ApusLookbook exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since     1.0.0
		 * @static
		 * @staticvar array $instance
		 * @uses      ApusLookbook::setup_constants() Setup the constants needed
		 * @uses      ApusLookbook::includes() Include the required files
		 * @uses      ApusLookbook::load_textdomain() load the language files
		 * @see       ApusLookbook()
		 * @return    ApusLookbook
		 */
		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ApusLookbook ) ) {
				self::$instance = new ApusLookbook;
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
			if ( ! defined( 'APUSLOOKBOOK_VERSION' ) ) {
				define( 'APUSLOOKBOOK_VERSION', '1.0.0' );
			}

			// Plugin Folder Path
			if ( ! defined( 'APUSLOOKBOOK_PLUGIN_DIR' ) ) {
				define( 'APUSLOOKBOOK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'APUSLOOKBOOK_PLUGIN_URL' ) ) {
				define( 'APUSLOOKBOOK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'APUSLOOKBOOK_PLUGIN_FILE' ) ) {
				define( 'APUSLOOKBOOK_PLUGIN_FILE', __FILE__ );
			}
		}

		public function includes() {
			require_once APUSLOOKBOOK_PLUGIN_DIR . 'inc/class-template-loader.php';
			require_once APUSLOOKBOOK_PLUGIN_DIR . 'inc/shortcode.php';
			require_once APUSLOOKBOOK_PLUGIN_DIR . 'inc/class-helper.php';
			
			ApusLookbook_Helper::includes( APUSLOOKBOOK_PLUGIN_DIR . 'inc/post-types/*.php' );

			add_action( 'wp_enqueue_scripts', array( $this, 'style' ) );
		}

		public function style() {
			wp_enqueue_style( 'apus-lookbook-style', APUSLOOKBOOK_PLUGIN_URL . 'assets/style.css' );
		}
		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for ApusLookbook's languages directory
			$lang_dir = dirname( plugin_basename( APUSLOOKBOOK_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'apuslookbook_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-lookbook' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-lookbook', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apus-lookbook/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apuslookbook folder
				load_textdomain( 'apus-lookbook', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apuslookbook/languages/ folder
				load_textdomain( 'apus-lookbook', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-lookbook', false, $lang_dir );
			}
		}

	}
}

function apus_lookbook() {
	return ApusLookbook::getInstance();
}

apus_lookbook();
