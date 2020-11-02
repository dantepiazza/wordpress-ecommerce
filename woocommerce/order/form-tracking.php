<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.6.0
	
	if(!defined('ABSPATH')){ exit; } 

	global $post;
?>

<form action="<?php echo(esc_url(get_permalink($post -> ID))); ?>" method="post" class="woocommerce-form woocommerce-form-track-order track_order">
	<p>Para realizar un seguimiento de tu pedido, ingresa el n&uacute;mero de pedido debajo. Esta informaci&oacute;n se encuentra en el correo electr&oacute;nico de confirmaci&oacute;n que recibiste al confirmar tu pedido.</p>

	<p class="form-row form-row-first"><label for="orderid">N&uacute;mero de pedido</label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="Se encuentra en el correo electrónico de confirmación del pedido." value="<?php echo(isset($_REQUEST['orderid']) ? esc_attr( wp_unslash($_REQUEST['orderid'])) : ''); ?>" /></p>
	<p class="form-row form-row-last"><label for="order_email">E-Mail de facturaci&oacute;n</label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="Correo electrónico que utilizaste durante el proceso de pago." value="<?php echo(isset($_REQUEST['order_email']) ? esc_attr(wp_unslash($_REQUEST['order_email'])) : ''); ?>"/></p>
	
	<div class="clear"></div>

	<p class="form-row"><input type="submit" class="button" name="track" value="Seguimiento" /></p>
	
	<?php wp_nonce_field('woocommerce-order_tracking', 'woocommerce-order-tracking-nonce'); ?>
</form>