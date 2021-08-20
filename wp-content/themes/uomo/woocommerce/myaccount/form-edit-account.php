<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="edit-account" action="" method="post">
	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
	<div class="clearfix">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<p class="form-group form-row">
					<input type="text" class="input-text form-control" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
					<label for="account_first_name" class="for-control"><?php esc_html_e( 'First name', 'uomo' ); ?> <span class="required">*</span></label>
				</p>
			</div>
			<div class="col-xs-12 col-sm-6">
				<p class="form-group form-row">
					<input type="text" class="input-text form-control" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
					<label for="account_last_name" class="for-control"><?php esc_html_e( 'Last name', 'uomo' ); ?> <span class="required">*</span></label>
				</p>
			</div>
		</div>
		<p class="form-group form-row">
			<input type="text" class="input-text form-control" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> 
			<label for="account_display_name" class="for-control"><?php esc_html_e( 'Display name', 'uomo' ); ?>&nbsp;<span class="required">*</span></label>
		</p>
		<p class="form-group form-row">
			<input type="email" class="input-text form-control" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
			<label for="account_email" class="for-control"><?php esc_html_e( 'Email address', 'uomo' ); ?> <span class="required">*</span></label>
		</p>
	</div>
	<div class="clearfix">
		<h3 class="title"><?php esc_html_e( 'Password Change', 'uomo' ); ?></h3>
		<p class="form-group form-row form-row-thirds">
			<input type="password" class="input-text form-control" name="password_current" id="password_current" />
			<label for="password_current" class="for-control"><?php esc_html_e( 'Current Password', 'uomo' ); ?></label>
		</p>
		<p class="form-group form-row form-row-thirds">
			
			<input type="password" class="input-text form-control" name="password_1" id="password_1" />
			<label for="password_1" class="for-control"><?php esc_html_e( 'New Password', 'uomo' ); ?></label>
		</p>
		<p class="form-group form-row form-row-thirds">
			<input type="password" class="input-text form-control" name="password_2" id="password_2" />
			<label for="password_2" class="for-control"><?php esc_html_e( 'Confirm New Password', 'uomo' ); ?></label>
		</p>
	</div>
	<!-- <div class="clear"></div> -->
	<?php do_action( 'woocommerce_edit_account_form' ); ?>
	<p class="form-group">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<input type="submit" class="button" name="save_account_details" value="<?php esc_html_e( 'Save changes', 'uomo' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p>
	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>