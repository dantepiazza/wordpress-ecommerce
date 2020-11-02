<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.5.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<form id="order_review" method="post">
	<table class="shop_table ui-shadow">
		<thead>
			<tr>
				<th class="product-name">Producto</th>
				<th class="product-quantity">Cantidad</th>
				<th class="product-total">Total</th>
			</tr>
		</thead>
		
		<tbody>
			<?php 
				if(sizeof($order -> get_items()) > 0){
					foreach($order -> get_items() as $item_id => $item){
						if(!apply_filters( 'woocommerce_order_item_visible', true, $item)){
							continue;
						}
						
						?>
							<tr class="<?php echo(esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order))); ?>">
								<td class="product-name">
									<?php
										echo(apply_filters('woocommerce_order_item_name', esc_html($item -> get_name()), $item, false));

										do_action('woocommerce_order_item_meta_start', $item_id, $item, $order);

										wc_display_item_meta($item);

										do_action('woocommerce_order_item_meta_end', $item_id, $item, $order);
									?>
								</td>
								<td class="product-quantity"><?php echo(apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">'.sprintf('&times; %s', esc_html($item -> get_quantity())).'</strong>', $item)); ?></td>
								<td class="product-subtotal"><?php echo($order -> get_formatted_line_subtotal($item)); ?></td>
							</tr>
						<?php 
					}
				}
			?>
		</tbody>
		
		<tfoot>
			<?php
				if($totals = $order->get_order_item_totals()){ 
					foreach($totals as $total){
						?>
							<tr>
								<th scope="row" colspan="2"><?php echo($total['label']); ?></th>
								<td class="product-total"><?php echo($total['value']); ?></td>
							</tr>
						<?php 
					}
				}
			?>
		</tfoot>
	</table>

	<div id="payment">
		<?php
			if($order -> needs_payment()){
				?>
					<ul class="wc_payment_methods payment_methods methods">
						<?php
							if(!empty($available_gateways)){
								foreach($available_gateways as $gateway){
									wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
								}
							}
							else{
								echo('<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">'.apply_filters('woocommerce_no_available_payment_methods_message', 'Lo sentimos, parece que no hay métodos de pago disponibles para tu ubicación. Contactate con nosotros si necesitas ayuda o deseas hacer arreglos alternativos.').'</li>');
							}
						?>
					</ul>
				<?php
			}
		?>
		<div class="form-row">
			<input type="hidden" name="woocommerce_pay" value="1" />

			<?php 
				wc_get_template('checkout/terms.php');
				do_action('woocommerce_pay_order_before_submit');
				
				echo(apply_filters('woocommerce_pay_order_button_html', '<input type="submit" class="button alt" id="place_order" value="'.esc_attr($order_button_text).'" data-value="'.esc_attr($order_button_text).'" />'));
				
				do_action('woocommerce_pay_order_after_submit');
				wp_nonce_field('woocommerce-pay');
			 ?>
		</div>
	</div>
</form>
