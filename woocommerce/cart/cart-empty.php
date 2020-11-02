<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.5.0
	
	if(!defined('ABSPATH')){ exit; }
	
	wc_print_notices();

	//@hooked wc_empty_cart_message - 10
	//do_action('woocommerce_cart_is_empty');

?>

<div class="wc-cart-empty">
	<i class="fas fa-shopping-basket"></i>
	<h1>Tu carrito está vacío</h1>	
	
	<?php
		if(wc_get_page_id('shop') > 0){
			?>
				<h5>Podes ver todos nuestros productos, quizás te interese comprar algo.</h5>
				<a class="ui-button ui-button-primary wc-backward" href="<?php echo(esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop')))); ?>">Ver productos</a>
			<?php 
		} 
	?>		
</div>