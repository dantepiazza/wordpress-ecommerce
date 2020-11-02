<?php
	// @version 2.0.0

	if(!defined('ABSPATH')){ exit; }
	
	do_action( 'woocommerce_email_header', $email_heading, $email );
?>

<p>Alguien solicit&oacute; que se restablezca la contrase&ntilde;a de tu cuenta. Para restablecer tu contraseña, hace click en el siguiente enlace:</p>
<p>
	<a class="link" href="<?php echo(esc_url(add_query_arg(array('key' => $reset_key, 'login' => rawurlencode($user_login)), wc_get_endpoint_url('lost-password', '', wc_get_page_permalink('myaccount'))))); ?>">
		Restablecer la contraseña
	</a>
</p>
<p>Si no realizaste esta solicitud, ignora este correo electr&oacute;nico.</p>

<?php do_action('woocommerce_email_footer', $email); ?>