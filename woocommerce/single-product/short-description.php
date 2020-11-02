<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.3.0

	if(!defined('ABSPATH')){ exit; }

	global $post, $product;
	
	if($post -> post_excerpt){
		echo('<div class="product-description">'.apply_filters('woocommerce_short_description', $post -> post_excerpt).'</div>');
	}
	
	/*
	Esta opcion es por si la plantilla tiene variables personalizadas 
	
	$other = $product -> get_attribute('other');
		
	if(!empty($other)){
		echo('
			<div class="product-options">
				<a href="'.$other.'" target="_blank"><span class="fa fa-download"></span> Detalles</a>
			</div>
		');
	}
	*/
?>
