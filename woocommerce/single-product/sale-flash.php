<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 1.6.4

	if(!defined('ABSPATH')){ exit; }

	global $post, $product;
	
	if($product -> is_on_sale()){
		 echo(apply_filters('woocommerce_sale_flash', '<span class="product-onsale">En oferta</span>', $post, $product));
	}