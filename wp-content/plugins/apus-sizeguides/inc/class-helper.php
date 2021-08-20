<?php
/**
 * helper
 *
 * @package    apus-sizeguides
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  23/12/2020 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
class ApusSizeguides_Helper {
	public static function display() {
		echo ApusSizeguides_Template_Loader::get_template_part('content');
	}
}