<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.1.0
	
	if(!defined('ABSPATH')){ exit; }
	
	do_action('woocommerce_before_mini_cart');
?>

<ul class="cart_list product_list_widget <?php echo(esc_attr($args['list_class'])); ?>">
	<?php 
		if(!WC() -> cart -> is_empty()){
			do_action('woocommerce_before_mini_cart_contents');
		
			foreach(WC() -> cart -> get_cart() as $cart_item_key => $cart_item){
				$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

				if($_product and $_product->exists() and $cart_item['quantity'] > 0 and apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)){
					$product_name = apply_filters('woocommerce_cart_item_name', $_product -> get_name(), $cart_item, $cart_item_key);
					$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product -> get_image(), $cart_item, $cart_item_key);
					$product_price = apply_filters('woocommerce_cart_item_price', WC() -> cart -> get_product_price($_product), $cart_item, $cart_item_key);
					$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product -> is_visible() ? $_product -> get_permalink($cart_item) : '', $cart_item, $cart_item_key);
					
					?>
						<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
							<?php
								echo(apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>', esc_url(WC() -> cart -> get_remove_url($cart_item_key)), 'Eliminar este item', esc_attr( $product_id ), esc_attr($_product -> get_sku())), $cart_item_key));
							
								if(!$_product -> is_visible()){
									echo(str_replace(array('http:', 'https:'), '', $thumbnail).$product_name.'&nbsp;');
								}
								else{
									echo('<a href="'.esc_url($product_permalink).'">'.str_replace(array('http:', 'https:'), '', $thumbnail).$product_name.'&nbsp;</a>');
								}
							
								echo(WC() -> cart -> get_item_data($cart_item));
								echo(apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">'.sprintf( '%s &times; %s', $cart_item['quantity'], $product_price).'</span>', $cart_item, $cart_item_key));
							?>
						</li>
					<?php
				}
			}
		
			do_action('woocommerce_mini_cart_contents');
		}
		else{
			echo('<li class="empty">No hay productos en el carrito</li>');
		}
	?>
</ul>

<?php 
	if(!WC() -> cart -> is_empty()){
		?>
			<p class="total"><strong>Subtotal:</strong> <?php echo(WC() -> cart -> get_cart_subtotal()); ?></p>

			<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

			<p class="buttons"><?php do_action('woocommerce_widget_shopping_cart_buttons'); ?></p>
		<?php 
	} 
	
	do_action('woocommerce_after_mini_cart');
?>
