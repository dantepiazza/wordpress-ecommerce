<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 1.6.4
	
	if(!defined('ABSPATH')){ exit; }

	if($notices){
		?><ul class="woocommerce-error" role="alert"><?php
		
		foreach($notices as $notice){
			?><li <?php echo(wc_get_notice_data_attr($notice)); ?>><?php echo(wp_kses_post($notice['notice'])); ?></li><?php
		}
		
		?></ul><?php
	}
?>
