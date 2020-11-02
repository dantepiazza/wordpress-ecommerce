<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.6.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<div class="woocommerce-billing-fields ui-shadow">
	<?php
		if(wc_ship_to_billing_address_only() and WC() -> cart -> needs_shipping()){
			echo('<h3>Facturación y Envío</h3>');
		}
		else{
			echo('<h3>Detalles de facturación</h3>');
		}
		
		do_action('woocommerce_before_checkout_billing_form', $checkout);	
	?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
			$fields = $checkout->get_checkout_fields('billing');

			foreach($fields as $key => $field){
				//if(isset($field['country_field'], $fields[$field['country_field']])){
				//	$field['country'] = $checkout -> get_value($field['country_field']);
				//}
				
				woocommerce_form_field($key, $field, $checkout -> get_value($key));
			}
		?>
	</div>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
	
	<?php
	if(!is_user_logged_in() and $checkout->is_registration_enabled()){
		?>
			<div class="woocommerce-account-fields">
				<?php
					if(!$checkout -> is_registration_required()){
						?>
							<p class="form-row form-row-wide create-account">
								<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
									<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <span>Crear una cuenta</span>
								</label>
							</p>

						<?php 
					}
					
					do_action('woocommerce_before_checkout_registration_form', $checkout);
					
					if($checkout -> get_checkout_fields('account')){
						?>
							<div class="create-account">
								<?php 
									foreach($checkout -> get_checkout_fields('account') as $key => $field){
										woocommerce_form_field($key, $field, $checkout -> get_value($key));
									}
								?>
								
								<div class="clear"></div>
							</div>
						<?php 
					}
					
					do_action('woocommerce_after_checkout_registration_form', $checkout);
				?>
			</div>
		<?php 
	}
?>
</div>


