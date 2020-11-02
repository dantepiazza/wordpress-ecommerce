<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.9.0
	
	if(!defined('ABSPATH')){ exit; }

	if($notices){
		foreach($notices as $notice){
			?><div class="woocommerce-info" <?php echo(wc_get_notice_data_attr($notice)); ?>><?php echo(wp_kses_post($notice['notice'])); ?></div><?php
		}
	}
?>