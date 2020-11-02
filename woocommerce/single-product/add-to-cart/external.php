<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.4.0

	if(!defined('ABSPATH')){ exit; }

	do_action('woocommerce_before_add_to_cart_form');
	
	echo('<form class="cart" action="<?php echo esc_url( $product_url ); ?>" method="get">');
	
	do_action('woocommerce_before_add_to_cart_button' );

	echo('<button type="submit" class="single_add_to_cart_button button alt">'.esc_html($button_text).'</button>');

	wc_query_string_form_fields($product_url);

	do_action('woocommerce_after_add_to_cart_button');
	
	echo('</form>');
	
	do_action('woocommerce_after_add_to_cart_form');
?>