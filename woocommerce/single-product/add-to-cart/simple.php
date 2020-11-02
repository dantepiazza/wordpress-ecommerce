<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.4.0

	if(!defined('ABSPATH')){ exit; }

	global $product;

	if(!$product -> is_purchasable()){ return; }

	
	echo('<div class="product-cart">');
	echo(wc_get_stock_html($product));
	
	if($product -> is_in_stock()){
		do_action('woocommerce_before_add_to_cart_form');

		?>
			<div class="product-cart-simple">
				<form class="product-cart-form" method="post" enctype='multipart/form-data' action="<?php echo(esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product -> get_permalink()))); ?>">
					<?php
						do_action('woocommerce_before_add_to_cart_button');
						do_action('woocommerce_before_add_to_cart_quantity');

						woocommerce_quantity_input(array(
							'min_value' => apply_filters( 'woocommerce_quantity_input_min', $product -> get_min_purchase_quantity(), $product),
							'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product -> get_max_purchase_quantity(), $product),
							'input_value' => isset($_POST['quantity']) ? wc_stock_amount($_POST['quantity']) : $product -> get_min_purchase_quantity(),
						));

						do_action( 'woocommerce_after_add_to_cart_quantity' );
					?>

					<button type="submit" name="add-to-cart" value="<?php echo(esc_attr($product -> get_id())); ?>" class="single_add_to_cart_button button alt">Agregar al carrito</button>

					<?php do_action('woocommerce_after_add_to_cart_button'); ?>
				</form>
			</div>
		<?php 
		
		do_action('woocommerce_after_add_to_cart_form');
	}
	
	echo('</div>');
?>
