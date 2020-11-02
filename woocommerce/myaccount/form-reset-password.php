<?php 
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<div class="contenedor">
	<div class="wc-lost-password">
		<?php wc_print_notices(); ?>
		
		<form method="post" class="woocommerce-ResetPassword lost_reset_password">
			<p><?php echo apply_filters( 'woocommerce_reset_password_message', 'Ingresa una nueva contrase&ntilde;a a continuaci&oacute;n'); ?></p>

			<input type="password" class="campo" name="password_1" id="password_1" placeholder="Nueva contrase&ntilde;a"/>
			<input type="password" class="campo" name="password_2" id="password_2" placeholder="Confirmar nueva contrase&ntilde;a "/>
			
			<?php do_action('woocommerce_resetpassword_form'); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field('reset_password'); ?>
				<input type="hidden" name="reset_key" value="<?php echo(esc_attr($args['key'])); ?>" />
				<input type="hidden" name="reset_login" value="<?php echo(esc_attr($args['login'])); ?>" />
				<input type="hidden" name="wc_reset_password" value="true" />
				<input type="submit" class="boton" value="Guardar" />
			</p>
		</form>
	</div>
</div>