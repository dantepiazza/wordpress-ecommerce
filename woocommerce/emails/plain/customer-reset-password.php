<?php
	// @version 2.3.0

	if(!defined('ABSPATH')){ exit; }

	echo("= ".$email_heading." =\n\n");
	
	echo("Alguien solicitó que se restablezca la contraseña de tu cuenta. Para restablecer tu contraseña, hace click en el siguiente enlace:\r\n\r\n");
	echo(esc_url(add_query_arg(array('key' => $reset_key, 'login' => $user_login), wc_get_endpoint_url('lost-password', '', wc_get_page_permalink('myaccount'))))."\r\n\r\n");
	echo("Si no realizaste esta solicitud, ignora este correo electrónico.\r\n\r\n");
	
	echo("\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n");

	echo(apply_filters( 'woocommerce_email_footer_text', get_option('woocommerce_email_footer_text')));