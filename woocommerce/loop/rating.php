<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	global $product;

	if(get_option('woocommerce_enable_review_rating') !== 'no'){
		echo(wc_get_rating_html($product -> get_average_rating()));
	}