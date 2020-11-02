<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }

	if($available_gateways = WC() -> payment_gateways -> get_available_payment_gateways()){
		?>
			<form id="add_payment_method" method="post">
				<div id="payment" class="woocommerce-Payment">
					<ul class="woocommerce-PaymentMethods payment_methods methods">
						<?php
							if(count($available_gateways)){
								current($available_gateways) -> set_current();
							}

							foreach($available_gateways as $gateway){
								?>
									<li class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo($gateway -> id); ?> payment_method_<?php echo($gateway -> id); ?>">
										<input id="payment_method_<?php echo($gateway -> id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr($gateway -> id); ?>" <?php checked($gateway -> chosen, true); ?> />
										<label for="payment_method_<?php echo($gateway -> id); ?>"><?php echo($gateway -> get_title()); ?> <?php echo($gateway -> get_icon()); ?></label>
										
										<?php
											if($gateway->has_fields() or $gateway->get_description()){
												echo('<div class="woocommerce-PaymentBox woocommerce-PaymentBox--'.$gateway -> id.' payment_box payment_method_'.$gateway -> id.'" style="display: none;">');
												
												$gateway->payment_fields();
												
												echo('</div>');
											}
										?>
									</li>
								<?php
							}
						?>
					</ul>

					<div class="form-row">
						<?php wp_nonce_field( 'woocommerce-add-payment-method' ); ?>
						
						<input type="submit" class="woocommerce-Button woocommerce-Button--alt button alt" id="place_order" value="Agregar m&eacute;todo de pago" />
						<input type="hidden" name="woocommerce_add_payment_method" id="woocommerce_add_payment_method" value="1" />
					</div>
				</div>
			</form>
		<?php
	}
	else{
		?> <p class="woocommerce-notice woocommerce-notice--info woocommerce-info">Lo sentimos, parece que no hay disponibles otros m&eacute;todos de pago. Contactate con nosotros si necesita ayuda o desea hacer arreglos alternativos.</p><?php 
	}
?>