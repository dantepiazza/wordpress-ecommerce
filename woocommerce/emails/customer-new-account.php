<?php
	// @version 1.6.4

	if(!defined('ABSPATH')){ exit; }
	
	do_action('woocommerce_email_header', $email_heading, $email);
?>

	<p>Gracias por crear una cuenta en <?php echo(esc_html($blogname)); ?>.</p>
	
	<p>
		<strong>Tu nombre de usuario es:</strong> <?php echo(esc_html($user_login)); ?>
		<?php
			if ('yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated){
				echo('<br><strong>Tu contrase&ntilde;a (ha sido generada autom&aacute;ticamente):</strong> '.esc_html($user_pass));
			}
		?>
	</p>

	<p>Podes acceder a tu cuenta para ver tus pedidos y cambiar su contrase&ntilde;a aqu&iacute;: <?php echo(make_clickable(esc_url(wc_get_page_permalink('myaccount')))); ?></p>

<?php do_action('woocommerce_email_footer', $email); ?>