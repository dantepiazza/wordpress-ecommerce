<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.6.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<div class="wc-account-dashboard">
	<p>
		<?php
			printf('Hola %1$s (¿No es tu cuenta? <a href="%2$s">Salir</a>) ', '<strong>'.esc_html($current_user->display_name ).'</strong>', esc_url(wc_logout_url(wc_get_page_permalink('myaccount'))));
			printf(
				'Desde el panel de tu cuenta podes ver tus <a href="%1$s">pedidos recientes</a>, administrar tus <a href="%2$s">direcciones de envío y de facturación</a> y <a href = "%3$s">editer la contraseña y los detalles de tu cuenta</a>',
				esc_url(wc_get_endpoint_url('orders')),
				esc_url(wc_get_endpoint_url('edit-address')),
				esc_url(wc_get_endpoint_url('edit-account'))
			);
		?>
	</p>

	<?php do_action('woocommerce_account_dashboard'); ?>

	<div class="wc-account-dashboard-categorias">
		<h6>Buscá los productos que necesites</h6>
		
		<?php include(get_template_directory().'/widget-categorias.php'); ?>
	</div>
</div>