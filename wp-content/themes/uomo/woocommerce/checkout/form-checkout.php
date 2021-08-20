<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- header -->
<div class="apus-checkout-header">
	
	<div class="apus-checkout-step">
		<ul class="clearfix">
			<li>
				<div class="inner clearfix">
					<div class="step"><?php esc_html_e('01', 'uomo'); ?></div>
					<div class="inner-right">
						<div class="inner-step-title">
							<?php esc_html_e('SHOPPING BAG','uomo'); ?>
						</div>
						<div class="inner-step">
							<?php esc_html_e('Manage Your Items List','uomo'); ?>
						</div>
					</div>
				</div>
			</li>
			<li class="active">
				<div class="inner clearfix">
					<div class="step"><?php esc_html_e('02', 'uomo'); ?></div>
					<div class="inner-right">
						<div class="inner-step-title">
							<?php esc_html_e('SHIPPING AND CHECKOUT','uomo'); ?>
						</div>

						<div class="inner-step">
							<?php esc_html_e('Checkout Your Items List','uomo'); ?>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="inner clearfix">
					<div class="step"><?php esc_html_e('03', 'uomo'); ?></div>
					<div class="inner-right">
						<div class="inner-step-title">
							<?php esc_html_e('CONFIRMATION','uomo'); ?>
						</div>

						<div class="inner-step">
							<?php esc_html_e('Review And Submit Your Order','uomo'); ?>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>

<?php
wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'uomo' ) );
	return;
}
?>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-8 col-xs-12">
		<div class="details-check">
		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set" id="customer_details">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>

				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			
		<?php endif; ?>
		</div>
	</div>
	<div class="col-md-4 col-xs-12">
		<div class="details-review">
			<div class="order-review">
				<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'uomo' ); ?></h3>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php remove_action( 'woocommerce_checkout_order_review','woocommerce_checkout_payment',20 ); ?>
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
			<?php woocommerce_checkout_payment(); ?>
		</div>	
	</div>
</div>
</form>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>