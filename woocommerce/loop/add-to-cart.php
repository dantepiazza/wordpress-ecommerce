<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }

	global $product;

	echo('<div class="product-add-cart">');
	
	echo(apply_filters('woocommerce_loop_add_to_cart_link', sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" title="%s"></a>',
		esc_url($product -> add_to_cart_url()),
		esc_attr(1),
		esc_attr($product -> get_id()),
		esc_attr($product -> get_sku()),
		esc_attr('fa fa-cart-plus add-cart'),
		esc_html($product -> add_to_cart_text())
	), $product));
	
	echo('</div>');