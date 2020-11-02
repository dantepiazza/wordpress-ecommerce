<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 4.3.0
	
	if(!defined('ABSPATH')){ exit; }

	do_action('woocommerce_auth_page_header');
	
	?>
	
		<h1><?php printf('%s desea conectarse a su tienda', esc_html($app_name)); ?></h1>

		<?php wc_print_notices(); ?>

		<p><?php printf('Esto le dará un acceso "%1$s" %2$s que le permitirá:', '<strong>'.esc_html($app_name).'</strong>', '<strong>'.esc_html($scope).'</strong>'); ?></p>

		<ul class="wc-auth-permissions">
			<?php 
				foreach($permissions as $permission){ 
					?> <li><?php echo(esc_html($permission)); ?></li> <?php
				}
			?>
		</ul>

		<div class="wc-auth-logged-in-as">
			<?php echo(get_avatar($user -> ID, 70)); ?>
			
			<p><?php printf('Conectado como %s', esc_html($user -> display_name)); ?> <a href="<?php echo(esc_url($logout_url)); ?>" class="wc-auth-logout">Salir</a>
		</div>

		<p class="wc-auth-actions">
			<a href="<?php echo(esc_url($granted_url)); ?>" class="button button-primary wc-auth-approve">Aprovar</a>
			<a href="<?php echo(esc_url($return_url)); ?>" class="button wc-auth-deny">Denegar</a>
		</p>
	
	<?php

	do_action('woocommerce_auth_page_footer');
?>