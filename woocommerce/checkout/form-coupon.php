<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.2
	
	if(!defined('ABSPATH')){ exit; }

	if(!wc_coupons_enabled()){
		return;
	}

	if(empty(WC() -> cart -> applied_coupons)){
		$info_message = apply_filters('woocommerce_checkout_coupon_message', '¿Tenes un cup&oacute;n? <a href="#" class="showcoupon">Ingresa tu c&oacute;digo</a>' );
		
		wc_print_notice($info_message, 'notice');
	}
?>

<form class="checkout_coupon ui-shadow" method="post" style="display:none">
	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" placeholder="C&oacute;digo de cup&oacute;n" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<input type="submit" class="boton boton-secundario" name="apply_coupon" value="Aplicar cup&oacute;n" />
	</p>

	<div class="clear"></div>
</form>