<?php
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }

	do_action('woocommerce_before_account_orders', $has_orders);

	if($has_orders){
		?>
			<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
				<thead>
					<tr>
						<?php
							foreach(wc_get_account_orders_columns() as $column_id => $column_name){
								?> <th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo(esc_attr($column_id)); ?>"><span class="nobr"><?php echo(esc_html($column_name)); ?></span></th><?php
							}
						?>
					</tr>
				</thead>

				<tbody>
					<?php
						foreach($customer_orders -> orders as $customer_order){							
							$order = wc_get_order($customer_order);
							$item_count = $order -> get_item_count();
							
							
							echo('<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-'.esc_attr($order -> get_status()).' order">');
							
							foreach(wc_get_account_orders_columns() as $column_id => $column_name){
								echo('<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-'.esc_attr($column_id).'" data-title="'.esc_attr($column_name).'">');
							
								if(has_action('woocommerce_my_account_my_orders_column_'.$column_id)){
									do_action( 'woocommerce_my_account_my_orders_column_'.$column_id, $order);
								}
								else if('order-number' === $column_id){
									echo('<a href="'.esc_url($order -> get_view_order_url()).'">#'.$order -> get_order_number().'</a>');
								}
								else if('order-date' === $column_id){
									echo('<time datetime="'.esc_attr($order -> get_date_created() -> date('c')).'">'.esc_html(wc_format_datetime($order -> get_date_created())).'</time>');
								}
								else if('order-status' === $column_id){
									echo(esc_html(wc_get_order_status_name($order -> get_status())));
								}
								elseif ( 'order-total' === $column_id ){
									printf(_n('%1$s de %2$s item', '%1$s de %2$s items', $item_count), $order -> get_formatted_order_total(), $item_count);
								}
								elseif ( 'order-actions' === $column_id ){
									$actions = array(
										'pay'    => array(
											'url'  => $order->get_checkout_payment_url(),
											'name' => 'Pagar',
										),
										'view'   => array(
											'url'  => $order->get_view_order_url(),
											'name' => 'Ver',
										),
										'cancel' => array(
											'url'  => $order->get_cancel_order_url( wc_get_page_permalink( 'myaccount' ) ),
											'name' => 'Cancelar',
										),
									);

									if(!$order->needs_payment()){
										unset($actions['pay']);
									}

									if(!in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array('pending', 'failed'), $order))){
										unset($actions['cancel']);
									}

									if($actions = apply_filters('woocommerce_my_account_my_orders_actions', $actions, $order)){
										foreach($actions as $key => $action){
											echo('<a href="'.esc_url($action['url']).'" class="woocommerce-button button '.sanitize_html_class($key).'">'.esc_html($action['name']).'</a>');
										}
									}
								}
								
								echo('</td>');						
							}
							
							echo('</tr>');							
						}	
					?>
				</tbody>
			</table>
		<?php
	
		do_action('woocommerce_before_account_orders_pagination'); 

		if(1 < $customer_orders -> max_num_pages){
			?>
				<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
					<?php 
						if (1 !== $current_page){
							echo('<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="'.esc_url(wc_get_endpoint_url('orders', $current_page - 1)).'">Anterior</a>');
						}
						
						if(intval($customer_orders -> max_num_pages) !== $current_page){
							echo('<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="'.esc_url(wc_get_endpoint_url('orders', $current_page + 1)).'">Siguiente</a>');
						}
					?>
				</div>
			<?php
		}
	}
	else{
		?>
			<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
				<a class="woocommerce-Button button" href="<?php echo(esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop')))); ?>">
					Ir a la tienda
				</a>
				No se ha hecho ningún pedido
			</div>
		<?php
	}
	
	do_action('woocommerce_after_account_orders', $has_orders);
?>