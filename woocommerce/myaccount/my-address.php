<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.6.0
	
	if(!defined('ABSPATH')){ exit; }

	$customer_id = get_current_user_id();

	if(!wc_ship_to_billing_address_only() && wc_shipping_enabled()){
		$get_addresses = apply_filters('woocommerce_my_account_get_addresses', array(
			'billing' => 'Direcci&oacute;n de facturaci&oacute;n',
			'shipping' =>'Direcci&oacute;n de env&iacute;o',
		), $customer_id);
	}
	else{
		$get_addresses = apply_filters('woocommerce_my_account_get_addresses', array('billing' => 'Direcci&oacute;n de facturaci&oacute;n'), $customer_id);
	}

	$oldcol = 1;
	$col = 1;
?>

<div class="wc-account-address">
	<div class="wc-account-address-welcome"><?php echo apply_filters( 'woocommerce_my_account_my_address_description', 'Las siguientes direcciones se utilizarán de forma predeterminada al realizar un pago.'); ?></div>

	<?php
		if(!wc_ship_to_billing_address_only() && wc_shipping_enabled()){
			echo('<div class="u-columns woocommerce-Addresses col2-set addresses">');
		}

		foreach($get_addresses as $name => $title){
			?>				
				<div class="ui-box ui-shadow u-column<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?> col-<?php echo ( ( $oldcol = $oldcol * -1 ) < 0 ) ? 1 : 2; ?>">	
					<div class="ui-box-header"><h3><?php echo($title); ?> <small>(<a href="<?php echo(esc_url(wc_get_endpoint_url('edit-address', $name))); ?>" class="edit">Editar</a>)</small></h3></div>
									
					<div class="ui-box-content">
							<?php
								$address = apply_filters('woocommerce_my_account_my_address_formatted_address', array(
									'first_name'  => get_user_meta($customer_id, $name.'_first_name', true),
									'last_name'   => get_user_meta($customer_id, $name.'_last_name', true),
									'company'     => get_user_meta($customer_id, $name.'_company', true),
									'address_1'   => get_user_meta($customer_id, $name.'_address_1', true),
									'address_2'   => get_user_meta($customer_id, $name.'_address_2', true),
									'city'        => get_user_meta($customer_id, $name.'_city', true),
									'state'       => get_user_meta($customer_id, $name.'_state', true),
									'postcode'    => get_user_meta($customer_id, $name.'_postcode', true),
									'country'     => get_user_meta($customer_id, $name.'_country', true),
								), $customer_id, $name);
								
								$formatted_address = WC() -> countries -> get_formatted_address($address);
								
								if(!$formatted_address){
									echo('Todavía no configuraste este tipo de dirección.');
								}
								else{
									echo($formatted_address);
								}
							?>
					</div>
				</div>
			<?php 
		} 
		
		if(!wc_ship_to_billing_address_only() && wc_shipping_enabled()){
			echo('</div>');
		}
	?>
</div>