<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 1.6.4

	if(!defined('ABSPATH')){ exit; }

	global $product;
	
	if($price_html = $product -> get_price_html()){
		echo('<span class="price">'.$price_html.'</span>');
	}
?>