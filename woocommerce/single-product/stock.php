<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }
	
	global $product;
?>

<p class="product-stock stock"><?php echo((!$product -> is_type('variable')) ? 'Disponibles<br>' : ''); echo('<span class="'.esc_attr($class).'">'.wp_kses_post($availability).'<span>'); ?></p>