<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.4.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<a href="<?php echo(esc_url(wc_get_checkout_url())); ?>" class="checkout-button ui-button ui-button-primary alt wc-forward">Proceder al pago</a>
