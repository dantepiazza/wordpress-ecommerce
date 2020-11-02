<?php
	// @version 2.5.0

	if(!defined('ABSPATH')){ exit; }

	echo("= ".$email_heading." =\n\n");

	echo('Gracias por crear una cuenta en '.$blogname.'\n\n');
	echo('Tu nombre de usuario es: '.$user_login).'\n\n');
	
	if('yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated){
		echo('Tu contraseña (ha sido generada automáticamente): '.$user_pass.'\n\n');
	}	

	echo('Podes acceder a tu cuenta para ver tus pedidos y cambiar su contraseña aquí:'.wc_get_page_permalink('myaccount').'\n\n');

	echo("\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n");

	echo(apply_filters('woocommerce_email_footer_text', get_option('woocommerce_email_footer_text')));