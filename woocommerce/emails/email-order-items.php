<?php
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	$text_align = is_rtl() ? 'right' : 'left';

	foreach($items as $item_id => $item){
		if(apply_filters('woocommerce_order_item_visible', true, $item)){
			$product = $item -> get_product();
			
			?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
					<td class="td" style="text-align:<?php echo $text_align; ?>; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
						<?php
							if($show_image){
								echo(apply_filters('woocommerce_order_item_thumbnail', '<div style="margin-bottom: 5px"><img src="'.($product -> get_image_id() ? current(wp_get_attachment_image_src($product -> get_image_id(), 'thumbnail')) : wc_placeholder_img_src()).'" alt="Imagen del producto" height="'.esc_attr($image_size[1]).'" width="'.esc_attr($image_size[0]).'" style="vertical-align:middle; margin-'.( is_rtl() ? 'left' : 'right').': 10px;" /></div>', $item));
							}

							echo(apply_filters( 'woocommerce_order_item_name', $item -> get_name(), $item, false));

							if($show_sku && is_object($product) && $product -> get_sku()){
								echo(' (#'.$product -> get_sku().')');
							}

							do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text);

							wc_display_item_meta($item);

							if($show_download_links ){
								wc_display_item_downloads($item);
							}

							do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text);
						?>
					</td>
					<td class="td" style="text-align:<?php echo($text_align); ?>; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
						<?php echo(apply_filters('woocommerce_email_order_item_quantity', $item -> get_quantity(), $item)); ?>
					</td>
					<td class="td" style="text-align:<?php echo($text_align); ?>; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
						<?php echo($order -> get_formatted_line_subtotal($item)); ?>
					</td>
				</tr>
			<?php
		}

		if($show_purchase_note && is_object($product) && ($purchase_note = $product -> get_purchase_note())){ 
			?>
				<tr>
					<td colspan="3" style="text-align:<?php echo($text_align); ?>; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
						<?php echo(wpautop(do_shortcode(wp_kses_post($purchase_note)))); ?>
					</td>
				</tr>
			<?php 
		}	
	}
?>
