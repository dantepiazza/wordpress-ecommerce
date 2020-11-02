<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.4.0
	
	if(!defined('ABSPATH')){ exit; }

	do_action('woocommerce_auth_page_header');
	
	?>
		<h1><?php printf('%s desea conectarse a su tienda', esc_html($app_name)); ?></h1>

		<?php wc_print_notices(); ?>

		<p><?php wp_kses_post(sprintf('Para conectarse a %1$s debes iniciar sesión. Inicie sesión o <a href="%2$s">cancelar y volver a %1$s</a>', esc_html(wc_clean($app_name)), esc_url($return_url)); ?></p>
		
		<form method="post" class="wc-auth-login">
			<p class="form-row form-row-wide">
				<label for="username">Usuario o E-Mail <span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" value="<?php echo((!empty($_POST['username'])) ? esc_attr($_POST['username']) : ''); ?>" />
			</p>
			<p class="form-row form-row-wide">
				<label for="password">Contraseña <span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" />
			</p>
			<p class="wc-auth-actions">
				<?php wp_nonce_field('woocommerce-login'); ?>
				<input type="submit" class="button button-large button-primary wc-auth-login-button" name="login" value="Ingresar" />
				<input type="hidden" name="redirect" value="<?php echo esc_url($redirect_url); ?>" />
			</p>
		</form>
	<?php
	
	do_action('woocommerce_auth_page_footer');
?>