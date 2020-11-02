<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 1.6.4
	
	if(!defined('ABSPATH')){ exit; }

	if($notices){
		foreach($notices as $notice){
			?><div class="woocommerce-message" <?php echo(wc_get_notice_data_attr($notice)); ?> role="alert"><?php echo(wp_kses_post($notice['notice'])); ?></div><?php
		}
	}
?>