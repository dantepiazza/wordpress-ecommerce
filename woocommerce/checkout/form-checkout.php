<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.3.0
	
	if(!defined('ABSPATH')){ exit; }
	
	wc_print_notices();

	do_action('woocommerce_before_checkout_form', $checkout);

	if(!$checkout -> is_registration_enabled() and $checkout -> is_registration_required() and ! is_user_logged_in()){
		echo(apply_filters('woocommerce_checkout_must_be_logged_in_message', 'Necesitas estar registrado para pagar.'));
		
		return;
	}
?>

<form name="checkout" method="post" class="wc-checkout checkout woocommerce-checkout" action="<?php echo(esc_url(wc_get_checkout_url())); ?>" enctype="multipart/form-data">
	<?php 
		if($checkout -> get_checkout_fields()){
			do_action( 'woocommerce_checkout_before_customer_details' );			
			
			?>
				<div class="col2-set" id="customer_details">
					<div class="col-1">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<div class="col-2">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>
			<?php 
			
			do_action('woocommerce_checkout_after_customer_details');	
		}
	?>

	<h3 id="order_review_heading">Tu pedido</h3>

	<?php do_action('woocommerce_checkout_before_order_review'); ?>

	<div id="order_review" class="woocommerce-checkout-review-order ui-shadow">
		<?php do_action('woocommerce_checkout_order_review'); ?>
	</div>

	<?php do_action('woocommerce_checkout_after_order_review'); ?>
</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>