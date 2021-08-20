<?php
/**
 * shortcode loader
 *
 * @package    apus-lookbook
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
class ApusLookbook_Shortcode {

	public static function init() {
		add_shortcode( 'lookbook' , array(__CLASS__, 'render_lookbook') );
	}

	public static function render_lookbook($atts) {
		echo ApusLookbook_Template_Loader::get_template_part( 'lookbook', $atts );
	}
}

ApusLookbook_Shortcode::init();