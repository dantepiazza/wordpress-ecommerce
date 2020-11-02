<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.5.0
	
	if(!defined('ABSPATH')){ exit; }

	if(!is_ajax()){
		do_action('woocommerce_review_order_before_payment');
	}
?>

<div id="payment" class="woocommerce-checkout-payment">
	<?php
		if(WC() -> cart -> needs_payment()){
			?>
				<ul class="wc_payment_methods payment_methods methods">
					<?php
						if(!empty($available_gateways)){
							foreach($available_gateways as $gateway){
								wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
							}
						}
						else{
							echo ('<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">'.apply_filters('woocommerce_no_available_payment_methods_message', WC() -> customer -> get_billing_country() ? 'Lo sentimos, parece que no hay métodos de pago disponibles para tu región. Contactate con nosotros si necesita ayuda o desea hacer arreglos alternativos.' : 'Por favor, completa tus datos para ver los m&eacute;todos de pago disponibles.') . '</li>');
						}
					?>
				</ul>
			<?php
		}
	?>
	
	<div class="form-row place-order">
		<noscript>
			Dado que tu navegador no admite JavaScript o está deshabilitado, necesitas hacer click en el botón <em>Actualizar total</em> antes de realizar tu pedido. De lo contrario, es posible que el valor final sea mayor al indicado.
			<br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Actualizar total" />
		</noscript>

		<?php 
			wc_get_template('checkout/terms.php');
			do_action('woocommerce_review_order_before_submit');

			echo(apply_filters('woocommerce_order_button_html', '<input type="submit" class="boton" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />'));
			
			do_action('woocommerce_review_order_after_submit');
			wp_nonce_field('woocommerce-process_checkout'); 
		?>
	</div>
</div>

<?php
	if(!is_ajax()){
		do_action('woocommerce_review_order_after_payment');
	}