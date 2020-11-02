<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.0.9
	
	if(!defined('ABSPATH')){ exit; }

	$page_title = ( 'billing' === $load_address ) ? __( 'Billing address', 'woocommerce' ) : __( 'Shipping address', 'woocommerce' );

	do_action( 'woocommerce_before_edit_account_address_form' );
	
	if(!$load_address){
		wc_get_template('myaccount/my-address.php');
	}
	else{
		?>		
			
		<div class="wc-account-address-edit">
			<form method="post">
				<div class="wc-account-address-edit-content">
					<div class="ui-form ui-shadow">	
						<div class="ui-form-header"><h3><?php echo(apply_filters('woocommerce_my_account_edit_address_title', $page_title, $load_address)); ?></h3></div>
										
						<div class="ui-form-content">
							<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

							<div class="woocommerce-address-fields__field-wrapper">
								<?php
									foreach($address as $key => $field){
										if(isset($field['country_field'], $address[$field['country_field']])){
											$field['country'] = wc_get_post_data_by_key($field['country_field'], $address[$field['country_field']]['value']);
										}
												
										woocommerce_form_field($key, $field, wc_get_post_data_by_key($key, $field['value']));
									}
								?>
							</div>

							<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
						</div>
					</div>
					
					<div class="ui-actions">
						<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
						<input type="hidden" name="action" value="edit_address" />
						<input type="submit" class="boton" name="save_address" value="Guardar direcci&oacute;n" />
					</div>	
				</div>
			</form>
		</div>
		
		<?php
	}
	
	do_action('woocommerce_after_edit_account_address_form');
?>