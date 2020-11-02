<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 2.0.0

	if(!defined('ABSPATH')){ exit; }

	global $post;

	//$heading = esc_html(apply_filters('woocommerce_product_description_heading', 'Descripci&oacute;n'));

	//if($heading){
	//	echo('<h2>'.$heading.'</h2>');
	//} 
	
	echo('<div class="estructura-contenido">');
	the_content();	
	echo('</div>');
?>