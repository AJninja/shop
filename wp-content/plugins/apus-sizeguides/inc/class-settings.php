<?php
/**
 * Settings
 *
 * @package    apus-sizeguides
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
class ApusSizeguides_Settings {
	
	/**
	 * Constructor
	 * @since 1.0
	 */
	public function __construct() {
	
		add_action( 'admin_menu', array( $this, 'admin_menu' ) , 10 );
	}

	public function admin_menu() {
		//Settings
	 	add_menu_page(__( 'Size Guides', 'apus-sizeguides' ), __( 'Size Guides', 'apus-sizeguides' ), 'manage_options', 'sizeguides-settings', array( $this, 'admin_page_display' ), '', 10 );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  1.0
	 */
	public function admin_page_display() {
		self::save();
		$size_guides = get_option('size_guides');
		$size_guides_enable = get_option('size_guides_enable');
		$size_guides_image = get_option('size_guides_image');
		?>
		<div class="wrap apus_sizeguides_settings_page">
			<h1><?php esc_html_e('Size Guides Settings', 'apus-sizeguides'); ?></h1>
			<form class="sizeguides-manager-options" method="post" action="admin.php?page=sizeguides-settings">

				<section class="sizeguides-section">
					<div class="header"><h2><?php esc_html_e('General Settings', 'apus-sizeguides'); ?></h2></div>
					<div class="inside">
						<div class="form-wrapper">
							<label><?php esc_html_e('Enable', 'apus-sizeguides'); ?></label>
							<input type="checkbox" name="_size_guides_enable" value="on" <?php echo trim($size_guides_enable == 'on' ? 'checked="checked"' : ''); ?>> <span><?php esc_html_e('Enable Size Guides', 'apus-sizeguides'); ?></span>
						</div>

						<div class="form-wrapper from-image-wrapper">
							<label><?php esc_html_e('Image', 'apus-sizeguides'); ?></label>

							<div class="inner">
								<div class="sizeguides_screenshot">
						            <?php if ( $size_guides_image ) {
						            	$img_url = wp_get_attachment_url($size_guides_image);
					            	?>
						                <img src="<?php echo esc_url($img_url); ?>" />
						            <?php } ?>
						        </div>
						        <input class="widefat upload_image" name="_size_guides_image" type="hidden" value="<?php echo esc_attr($size_guides_image); ?>" />
						        <div class="sizeguides_upload_image_action">
						            <input type="button" class="button add-image" value="Add">
						            <input type="button" class="button remove-image" value="Remove">
						        </div>
					        </div>
						</div>
					</div>
				</section>

				<div class="sizeguides-section-wrapper">
					<?php
					ob_start();
					?>
					<section class="sizeguides-section">
						<div class="header"><h2><?php esc_html_e('Section', 'apus-sizeguides'); ?> #{{d}}</h2></div>
						<div class="inside">
							<div class="form-wrapper">
								<label><?php esc_html_e('Section Name', 'apus-sizeguides'); ?></label>
								<input type="text" name="_size_guides[section_name][]">
							</div>

							<h4 class="field-label"><?php esc_html_e('Size Guides Table', 'apus-sizeguides'); ?></h4>
							<textarea class="widefat sizeguides-table-data hidden" name="_size_guides[tables][]"></textarea>
							<table class="sizeguides-table-edit wh">
								<thead>
									<tr>
										<th><a class="addcol icon-button" href="javascript:void(0);">+</a></th>
										<th><a class="addcol icon-button" href="javascript:void(0);">+</a> <a class="delcol icon-button" href="javascript:void(0);">-</a></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="text" value=""></td>
										<td><input type="text" value=""></td>
										<td><a class="addrow icon-button" href="javascript:void(0);">+</a></td>
									</tr>
									<tr>
										<td><input type="text" value=""></td>
										<td><input type="text" value=""></td>
										<td><a class="addrow icon-button" href="javascript:void(0);">+</a> <a class="delrow icon-button" href="javascript:void(0);">-</a></td>
									</tr>
								</tbody>
							</table>

							<div class="button-actions">
								<a class="delsection icon-button button" href="javascript:void(0);"><?php esc_html_e('Delete Section', 'apus-sizeguides'); ?></a>
							</div>
						</div>
					</section>
					<?php
					$default_html = ob_get_clean();

					if ( !empty($size_guides['section_name']) && is_array($size_guides['section_name']) ) {
						$tables = !empty($size_guides['tables']) ? $size_guides['tables'] : array();
						$i = 1;
						foreach ($size_guides['section_name'] as $key => $section_name) {
							$table = !empty($tables[$key]) ? stripslashes($tables[$key]) : '';
							$array_table = !empty($table) ? json_decode( $table, true ) : array();
							?>
							<section class="sizeguides-section">
								<div class="header"><h2><?php echo sprintf(esc_html__('Section #%d', 'apus-sizeguides'), $i); ?></h2></div>
								<div class="inside">
									<div class="form-wrapper">
										<label><?php esc_html_e('Section Name', 'apus-sizeguides'); ?></label>
										<input type="text" name="_size_guides[section_name][]" value="<?php echo esc_attr($section_name); ?>">
									</div>

									<h4 class="field-label"><?php esc_html_e('Size Guides Table', 'apus-sizeguides'); ?></h4>
									<textarea class="widefat sizeguides-table-data hidden" name="_size_guides[tables][]"><?php echo trim($table); ?></textarea>
									<table class="sizeguides-table-edit wh">

										<?php
										if ( !empty($array_table[0]) ) {
											?>
											<thead>
												<tr>
													<?php
													foreach ($array_table[0] as $key => $val) {
														if ( $key == 0 ) {
															?>
															<th><a class="addcol icon-button" href="javascript:void(0);">+</a></th>
														<?php } else { ?>
															<th>
																<a class="addcol icon-button" href="javascript:void(0);">+</a>
																<a class="delcol icon-button" href="javascript:void(0);">-</a>
															</th>
															<?php
														}
													}
													?>
												</tr>
											</thead>
											<?php
										}
										echo '<tbody>';
										foreach ( $array_table as $row => $columns ) {
											echo '<tr>';

												foreach ($columns as $val) {
													echo '<td><input type="text" value="'.$val.'"></td>';
												}
												if ( $row == 0 ) {
													echo '<td><a class="addrow icon-button" href="javascript:void(0);">+</a></td>';
												} else {
													echo '<td><a class="addrow icon-button" href="javascript:void(0);">+</a> <a class="delrow icon-button" href="javascript:void(0);">-</a></td>';
												}
												
											echo '</tr>';
										}
										echo '</tbody>';
										?>
										
									</table>

									<div class="button-actions">
										<a class="delsection icon-button button" href="javascript:void(0);"><?php esc_html_e('Delete Section', 'apus-sizeguides'); ?></a>
									</div>
								</div>
							</section>
							<?php
							$i++;
						}
					} else {
						echo trim($default_html);
					}
					?>

				</div>

				<div class="button-actions-wrapper">
					<a class="addsection icon-button button" href="javascript:void(0);" data-section="<?php echo esc_attr($default_html); ?>"><?php esc_html_e('Add Section', 'apus-sizeguides'); ?></a>
				</div>
				
				<button type="submit" class="button button-primary" name="updateSizeguidesManager"><?php esc_html_e('Update', 'apus-sizeguides'); ?></button>
			</form>
		</div><!-- .wrap -->

		<?php
	}

	public static function save() {
        if ( isset( $_POST['updateSizeguidesManager'] ) ) {
        	if ( ! empty( $_POST['_size_guides_enable'] ) ) {
 				update_option( 'size_guides_enable', $_POST['_size_guides_enable'] );
	  		} else {
	  			update_option( 'size_guides_enable', '' );
	  		}

	  		if ( isset( $_POST['_size_guides_image'] ) ) {
 				update_option( 'size_guides_image', $_POST['_size_guides_image'] );
	  		}
        	if ( ! empty( $_POST['_size_guides'] ) ) {
 				update_option( 'size_guides', $_POST['_size_guides'] );
	  		}
        }
    }

}

// Get it started
$ApusSizeguides_Settings = new ApusSizeguides_Settings();
