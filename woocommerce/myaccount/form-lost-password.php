<?php 
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<div class="contenedor">
	<div class="wc-lost-password">
		<?php wc_print_notices(); ?>
		
		<form method="post" class="woocommerce-ResetPassword lost_reset_password">
			<p><?php echo(apply_filters('woocommerce_lost_password_message', '¿Perdiste tu contraseña? Por favor, ingresa tu nombre de usuario o dirección de correo. Recibirás un enlace para crear una nueva contraseña.')); ?></p>

			<input class="campo" type="text" name="user_login" id="user_login" placeholder="Usuario o E-Mail"/>
		
			<?php do_action('woocommerce_lostpassword_form'); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field('lost_password'); ?>
				<input type="hidden" name="wc_reset_password" value="true" />
				<input type="submit" class="boton" value="Restablecer contrase&ntilde;a" />
			</p>		
		</form>
	</div>
</div>
