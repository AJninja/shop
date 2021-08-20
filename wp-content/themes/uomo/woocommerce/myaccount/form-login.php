<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$rand_id = uomo_random_key();

$args = array('#customer_login', '#customer_register');
$action = isset($_COOKIE['uomo_login_register']) && in_array($_COOKIE['uomo_login_register'], $args) ? $_COOKIE['uomo_login_register'] : '#customer_login';
if (isset($_GET['ac']) && $_GET['ac'] == 'register') {
	$action = '#customer_register';
}

?>
<?php wc_print_notices(); ?>
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
<div class="user">

	<div id="customer_login_<?php echo esc_attr($rand_id); ?>" class="register_login_wrapper <?php echo trim($action == '#customer_login' ? 'active' : ''); ?>">
		<h2 class="title"><?php esc_html_e( 'Login', 'uomo' ); ?></h2>
		<form method="post" class="login" role="form">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="form-group form-row form-row-wide">
				<input type="text" class="form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				<label for="username" class="for-control"><?php esc_html_e( 'Username or Email', 'uomo' ); ?> <span class="required">*</span></label>
			</p>
			<p class="form-group form-row form-row-wide">
				<input class="form-control" type="password" name="password" id="password" />
				<label for="password" class="for-control"><?php esc_html_e( 'Password', 'uomo' ); ?> <span class="required">*</span></label>
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="form-group form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<div class="form-group clearfix">
					<span class="inline pull-left">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'uomo' ); ?>
					</span>
					<span class="lost_password pull-right">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'uomo' ); ?></a>
					</span>
				</div>
				<input type="submit" class="btn btn-primary btn-block" name="login" value="<?php esc_html_e( 'LOG IN', 'uomo' ); ?>" />
			</div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
			<div class="create text-center">
				<?php echo esc_html__('No account yet?','uomo') ?> <a class="creat-account register-login-action" href="#customer_register_<?php echo esc_attr($rand_id); ?>"><?php echo esc_html__('Create an account','uomo'); ?></a>
			</div>
		<?php endif; ?>

	</div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div id="customer_register_<?php echo esc_attr($rand_id); ?>" class="content-register register_login_wrapper <?php echo trim($action == '#customer_register' ? 'active' : ''); ?>">

		<h2 class="title"><?php esc_html_e( 'Register', 'uomo' ); ?></h2>
		<form method="post" class="register widget" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-group form-row form-row-wide">
					
					<input type="text" class="form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					<label for="reg_username" class="for-control"><?php esc_html_e( 'Username', 'uomo' ); ?> <span class="required">*</span></label>
				</p>

			<?php endif; ?>

			<p class="form-group form-row form-row-wide">
				
				<input type="email" class="form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				<label for="reg_email" class="for-control"><?php esc_html_e( 'Email address', 'uomo' ); ?> <span class="required">*</span></label>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="form-group form-row form-row-wide">
					<input type="password" class="form-control" name="password" id="reg_password" />
					<label for="reg_password" class="for-control"><?php esc_html_e( 'Password', 'uomo' ); ?> <span class="required">*</span></label>
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'uomo' ); ?></p>

			<?php endif; ?>


			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="form-group form-row wrapper-submit">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="btn btn-primary btn-block" name="register" value="<?php esc_attr_e( 'Register', 'uomo' ); ?>"><?php esc_html_e( 'REGISTER', 'uomo' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

		<div class="create text-center">
			<?php echo esc_html__('Have an Account.','uomo') ?> <a class="login-account register-login-action" href="#customer_login_<?php echo esc_attr($rand_id); ?>"><?php echo esc_html__('Login','uomo'); ?></a>
		</div>

	</div>

<?php endif; ?>
</div>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>