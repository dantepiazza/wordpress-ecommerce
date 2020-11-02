<?php
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }

	$order = wc_get_order($order_id);

	$show_purchase_note = $order -> has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
?>

<div class="ui-box ui-shadow wc-pedido-detalles">
	<div class="ui-box-header"><h3>Detalles del pedido</h3></div>
	
	<div class="ui-box-content no-padding">
		<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
			<thead>
				<tr>
					<th class="woocommerce-table__product-name product-name">Producto</th>
					<th class="woocommerce-table__product-table product-total">Total</th>
				</tr>
			</thead>

			<tbody>
				<?php
					foreach($order->get_items() as $item_id => $item){
						$product = apply_filters('woocommerce_order_item_product', $item -> get_product(), $item);

						wc_get_template('order/order-details-item.php', array(
							'order' => $order,
							'item_id' => $item_id,
							'item' => $item,
							'show_purchase_note' => $show_purchase_note,
							'purchase_note' => (($product) ? $product -> get_purchase_note() : ''),
							'product' => $product,
						));
					}
					
					do_action('woocommerce_order_items_table', $order);
				?>
			</tbody>

			<tfoot>
				<?php
					foreach($order -> get_order_item_totals() as $key => $total){
						?>
							<tr>
								<th scope="row"><?php echo($total['label']); ?></th>
								<td><?php echo($total['value']); ?></td>
							</tr>
						<?php
					}
				?>
			</tfoot>
		</table>
	</div>
</div>
