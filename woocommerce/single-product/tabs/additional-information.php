<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	global $product;

	//$heading = esc_html(apply_filters('woocommerce_product_additional_information_heading', 'Informaci&oacute;n adicional') );
	
	//if($heading){
	//	echo('<h2>'.$heading.'</h2>');
	//}
	
	do_action('woocommerce_product_additional_information', $product);
?>