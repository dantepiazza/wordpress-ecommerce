<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }
	
	$envio = false;
	
	if(!wc_ship_to_billing_address_only() and $order -> needs_shipping_address()){
		$envio = true;
	}
?>

<div class="wc-pedido-cliente <?php echo(($envio) ? 'wc-pedido-cliente-con-envio' : ''); ?>">
	<div class="ui-box ui-shadow wc-pedido-cliente-general">
		<div class="ui-box-header"><h3>Detalles del comprador</h3></div>

		<div class="ui-box-content">
			<?php		
				if($order -> get_billing_email()){
					?><strong>E-Mail: </strong> <?php echo(esc_html($order -> get_billing_email())); ?><br><?php 
				}
			
				if($order -> get_billing_phone()){
					?><strong>Tel&eacute;fono: </strong> <?php echo(esc_html($order -> get_billing_phone())); ?><br><?php 
				}
				
				if($order -> get_customer_note()){
					?><strong>Nota: </strong> <?php echo(wptexturize($order -> get_customer_note())); ?><?php 
				}
				
				do_action('woocommerce_order_details_after_customer_details', $order);
			?>
		</div>
	</div>

	<div class="ui-box ui-shadow wc-pedido-cliente-facturacion">
		<div class="ui-box-header"><h3>Direcci&oacute;n de facturaci&oacute;n</h3></div>

		<div class="ui-box-content"><?php echo(($address = $order -> get_formatted_billing_address()) ? $address : 'N/A'); ?></div>
	</div>
	
	<?php
		if($envio){
			?>
				<div class="ui-box ui-shadow wc-pedido-cliente-envio">
					<div class="ui-box-header"><h3>Direcci&oacute;n de env&iacute;o</h3></div>

					<div class="ui-box-content"><?php echo(($address = $order -> get_formatted_shipping_address()) ? $address : 'N/A'); ?></div>
				</div>
			<?php 
		}
	?>
</div>

