<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.1.0
	
	if(!defined('ABSPATH')){ exit; }
	
	wc_print_notices();

	do_action('woocommerce_before_cart');
?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action('woocommerce_before_cart_table'); ?>

	<table class="wc-carrito shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead class="wc-carrito-fila wc-carrito-fila-encabezado">
			<tr>
				<th class="wc-carrito-columna columna-nombre product-name" colspan="2">Producto</th>
				<th class="wc-carrito-columna columna-precio product-price">Precio</th>
				<th class="wc-carrito-columna columna-cantidad product-quantity">Cantidad</th>
				<th class="wc-carrito-columna columna-subtotal product-subtotal" colspan="2">Total</th>
			</tr>
		</thead>
		
		<tbody class="ui-shadow">
			<?php ?>

			<?php
				do_action('woocommerce_before_cart_contents');
				
				foreach(WC() -> cart -> get_cart() as $cart_item_key => $cart_item){
					$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
					$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
					
					if ($_product && $_product -> exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)){
						$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product -> is_visible() ? $_product -> get_permalink($cart_item) : '', $cart_item, $cart_item_key);
						
						?>
							
							<tr class="wc-carrito-fila woocommerce-cart-form__cart-item <?php echo(esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key))); ?>">
								
								
								<td class="wc-carrito-columna columna-imagen product-thumbnail">
									<?php
										$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product -> get_image(), $cart_item, $cart_item_key);

										if(!$product_permalink){
											echo($thumbnail);
										}
										else{
											echo('<a href="'.esc_url($product_permalink).'">'.$thumbnail.'</a>');
										}
									?>
								</td>
								
								<td class="wc-carrito-columna columna-nombre product-name" data-title="Producto">
									<h5>
										<?php
											if(!$product_permalink){
												echo(apply_filters('woocommerce_cart_item_name', $_product -> get_name(), $cart_item, $cart_item_key).'&nbsp;');
											}
											else{
												echo(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product -> get_name()), $cart_item, $cart_item_key));
											}
										?>
									</h5>
									
									<?php
										echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

										if($_product -> backorders_require_notification() && $_product -> is_on_backorder($cart_item['quantity'])){
											echo('<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce').'</p>');
										}
									?>
								</td>
								
								<td class="wc-carrito-columna columna-precio product-price" data-title="Precio">
									<?php
										echo(apply_filters('woocommerce_cart_item_price', WC() -> cart -> get_product_price($_product), $cart_item, $cart_item_key));
									?>
								</td>
																
								<td class="wc-carrito-columna columna-cantidad product-quantity" data-title="Cantidad">
									<?php
										if($_product -> is_sold_individually()){
											$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
										}
										else{
											$product_quantity = woocommerce_quantity_input( array(
												'input_name'  => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'max_value'   => $_product -> backorders_allowed() ? '' : $_product -> get_stock_quantity(),
												'min_value'   => '0',
											), $_product, false );
										}

										echo(apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item));
									?>
								</td>
								
								<td class="wc-carrito-columna columna-subtotal product-price" data-title="Total">
									<?php
										echo(apply_filters('woocommerce_cart_item_subtotal', WC() -> cart -> get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key));
									?>
								</td>
								
								<td class="wc-carrito-columna columna-eliminar product-remove">
									<?php
										echo(apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>', esc_url(wc_get_cart_remove_url($cart_item_key)), 'Eliminar este elemento', esc_attr($product_id), esc_attr($_product -> get_sku())), $cart_item_key));
									?>
								</td>
							</tr>
							
						<?php
					}
				}
			
				do_action('woocommerce_cart_contents');
			?>

			<tr class="wc-carrito-fila wc-carrito-fila-acciones">
				<td colspan="6" class="actions">
					<?php 
						if(wc_coupons_enabled()){ 
							?>
								<div class="coupon">
									<input type="text" name="coupon_code" class="ui-input input-text" id="coupon_code" value="" placeholder="C&oacute;digo de cup&oacute;n" />
									<input type="submit" class="ui-button ui-button-secondary" name="apply_coupon" value="Aplicar cup&oacute;n" />
									<?php do_action( 'woocommerce_cart_coupon' ); ?>
								</div>
							<?php 
						}
						
						?> <input type="submit" class="ui-button ui-button-secondary" name="update_cart" value="Actualizar carrito" /><?php
						
						do_action('woocommerce_cart_actions');
						wp_nonce_field('woocommerce-cart');
					?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<div class="cart-collaterals">
	<?php do_action( 'woocommerce_cart_collaterals' ); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
