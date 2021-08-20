<?php
/**
 * Plugin Name: Apus Ourstores
 * Plugin URI: http://apusthemes.com/plugins/apus-ourstores/
 * Description: Create Ourstoress.
 * Version: 1.0.0
 * Author: ApusTheme
 * Author URI: http://apusthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.6
 *
 * Text Domain: apus-ourstores
 * Domain Path: /languages/
 *
 * @package apus-ourstores
 * @category Plugins
 * @author ApusTheme
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("ApusOurstores") ){
	
	final class ApusOurstores{

		/**
		 * @var ApusOurstores The one true ApusOurstores
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 *
		 */
		public function __construct() {

		}

		/**
		 * Main ApusOurstores Instance
		 *
		 * Insures that only one instance of ApusOurstores exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since     1.0.0
		 * @static
		 * @staticvar array $instance
		 * @uses      ApusOurstores::setup_constants() Setup the constants needed
		 * @uses      ApusOurstores::includes() Include the required files
		 * @uses      ApusOurstores::load_textdomain() load the language files
		 * @see       ApusOurstores()
		 * @return    ApusOurstores
		 */
		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ApusOurstores ) ) {
				self::$instance = new ApusOurstores;
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
			if ( ! defined( 'APUSOURSTORES_VERSION' ) ) {
				define( 'APUSOURSTORES_VERSION', '1.0.0' );
			}

			// Plugin Folder Path
			if ( ! defined( 'APUSOURSTORES_PLUGIN_DIR' ) ) {
				define( 'APUSOURSTORES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'APUSOURSTORES_PLUGIN_URL' ) ) {
				define( 'APUSOURSTORES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'APUSOURSTORES_PLUGIN_FILE' ) ) {
				define( 'APUSOURSTORES_PLUGIN_FILE', __FILE__ );
			}
		}

		public function includes() {
			require_once APUSOURSTORES_PLUGIN_DIR . 'inc/post-types/class-post-type-ourstores.php';
			
		}
		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for ApusOurstores's languages directory
			$lang_dir = dirname( plugin_basename( APUSOURSTORES_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'apusourstores_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-ourstores' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-ourstores', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apus-ourstores/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apusourstores folder
				load_textdomain( 'apus-ourstores', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apusourstores/languages/ folder
				load_textdomain( 'apus-ourstores', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-ourstores', false, $lang_dir );
			}
		}

	}
}

function apus_ourstores() {
	return ApusOurstores::getInstance();
}

apus_ourstores();
