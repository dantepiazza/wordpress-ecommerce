<?php
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	foreach($items as $item_id => $item){
		if(apply_filters('woocommerce_order_item_visible', true, $item)){
			$product = $item -> get_product();
			
			echo(apply_filters('woocommerce_order_item_name', $item -> get_name(), $item, false));
			
			if($show_sku && $product -> get_sku()){
				echo(' (#'.$product->get_sku().')');
			}
			
			echo(' X '.apply_filters('woocommerce_email_order_item_quantity', $item -> get_quantity(), $item));
			echo(' = '.$order -> get_formatted_line_subtotal($item)."\n");
					
			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text );
			
			echo(strip_tags(wc_display_item_meta($item, array(
				'before' => "\n- ",
				'separator' => "\n- ",
				'after' => "",
				'echo' => false,
				'autop' => false,
			)));
			
			if($show_download_links){
				echo(strip_tags(wc_display_item_downloads($item, array(
					'before' => "\n- ",
					'separator' => "\n- ",
					'after'  => "",
					'echo' => false,
					'show_url' => true,
				))));
			}

			do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text);
		}
		
		if($show_purchase_note && is_object($product) && ($purchase_note = $product -> get_purchase_note())){
			echo("\n".do_shortcode(wp_kses_post($purchase_note)));
		}
		
		echo("\n\n");
	}