<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 2.1.0
	
	if(!defined('ABSPATH')){ exit; } 

	if(is_user_logged_in()){
		return;
	}
?>

<form class="woocomerce-form woocommerce-form-login login" method="post" <?php echo(($hidden) ? 'style="display:none;"' : ''); ?>>
	<?php
		do_action('woocommerce_login_form_start');
		
		if($message){
			echo(wpautop( wptexturize($message )));
		}
	?>
	
	<p class="form-row form-row-first">
		<label for="username">Usuario o E-Mail <span class="required">*</span></label>
		<input type="text" class="input-text" name="username" id="username" />
	</p>
	
	<p class="form-row form-row-last">
		<label for="password">Contrase&ntilde;a <span class="required">*</span></label>
		<input class="input-text" type="password" name="password" id="password" />
	</p>
	
	<div class="clear"></div>

	<?php do_action('woocommerce_login_form'); ?>

	<p class="form-row">
		<?php wp_nonce_field('woocommerce-login'); ?>
		
		<input type="submit" class="button" name="login" value="Ingresar" />
		
		<input type="hidden" name="redirect" value="<?php echo(esc_url($redirect)); ?>" />
		
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
			<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>Recordarme</span>
		</label>
	</p>
	
	<p class="lost_password">
		<a href="<?php echo(esc_url(wp_lostpassword_url())); ?>">Olvide mi contrase&ntildea</a>
	</p>

	<div class="clear"></div>

	<?php do_action('woocommerce_login_form_end'); ?>
</form>
