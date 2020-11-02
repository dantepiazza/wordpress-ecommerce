<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.0.0
	
	if(!defined('ABSPATH')){ exit; }

	if(is_user_logged_in() or 'no' === get_option('woocommerce_enable_checkout_login_reminder')){
		return;
	}

	wc_print_notice(apply_filters('woocommerce_checkout_login_message', '¿Soy Cliente?').' <a href="#" class="showlogin">Ingresar a tu cuenta</a>', 'notice');

	woocommerce_login_form(
		array(
			'message' => 'Si ya comprante antes, con nosotros, ingresa tus datos en las siguientes casillas. Si sos un nuevo cliente, revisa la p&aacute;gina de Facturaci&oacute;n y Env&iacute;o.',
			'redirect' => wc_get_page_permalink('checkout'),
			'hidden' => true,
		)
	);