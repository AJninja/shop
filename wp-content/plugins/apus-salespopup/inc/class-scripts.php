<?php
/**
 * Scripts
 *
 * @package    apus-salespopup
 * @author     Habq 
 * @license    GNU General Public License, version 3
 */

if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class ApusSalespopup_Scripts {
	/**
	 * Initialize scripts
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_frontend' ) );
	}

	/**
	 * Loads front files
	 *
	 * @access public
	 * @return void
	 */
	public static function enqueue_frontend() {
		
		wp_register_script( 'apus-salespopup-script', APUSSALESPOPUP_PLUGIN_URL . 'assets/script.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_style( 'apus-salespopup-style', APUSSALESPOPUP_PLUGIN_URL . 'assets/style.css', array(), '1.0.0' );

		$sales_popup_data = ApusSalespopup_Helper::get_sales_popup_data();
			
		$opts = array(
			'ajaxurl'          => admin_url( 'admin-ajax.php' ),
			'datas' => $sales_popup_data,
			'text'             => array(
				'second'  => esc_html__( 'second', 'apus-salespopup' ),
				'seconds' => esc_html__( 'seconds', 'apus-salespopup' ),
				'minute'  => esc_html__( 'minute', 'apus-salespopup' ),
				'minutes' => esc_html__( 'minutes', 'apus-salespopup' ),
				'hour'    => esc_html__( 'hour', 'apus-salespopup' ),
				'hours'   => esc_html__( 'hours', 'apus-salespopup' ),
				'day'     => esc_html__( 'day', 'apus-salespopup' ),
				'days'    => esc_html__( 'days', 'apus-salespopup' ),
			)
		);

		wp_localize_script( 'apus-salespopup-script', 'apus_salespopup_opts', $opts );
		wp_enqueue_script( 'apus-salespopup-script' );
	}

}

ApusSalespopup_Scripts::init();
