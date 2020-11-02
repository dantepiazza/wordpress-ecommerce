<?php
	// @version 2.5.0

	if(!defined('ABSPATH')){ exit; }

	do_action('woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email);

	echo("Pedido número ".$order->get_order_number()."\n");
	echo(wc_format_datetime($order -> get_date_created())."\n");
	echo("\n" . wc_get_email_order_items($order, array(
		'show_sku' => $sent_to_admin,
		'show_image' => false,
		'image_size' => array( 32, 32 ),
		'plain_text' => true,
		'sent_to_admin' => $sent_to_admin,
	));

	echo("==========\n\n");

	if($totals = $order -> get_order_item_totals()){
		foreach($totals as $total) {
			echo($total['label']."\t ".$total['value']."\n");
		}
	}

	if($sent_to_admin){
		echo("\nVer pedido: ".admin_url('post.php?post='.$order -> get_id().'&action=edit'))."\n");
	}

	do_action('woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email);