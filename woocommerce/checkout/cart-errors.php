<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.5.0
	
	if(!defined('ABSPATH')){ exit; }
	
	wc_print_notices();
	
	echo('<p>Hay algunos problemas con los elementos de su carrito (mostrados arriba). Vuelva por favor al carrito y resuelva estos problemas antes de continuar.</p>');
	
	do_action('woocommerce_cart_has_errors');
	
	echo('<p><a class="button wc-backward" href="'.esc_url(wc_get_cart_url()).'">Volver al carrito</a></p>');
?>



