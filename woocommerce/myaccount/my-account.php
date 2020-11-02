<?php 
	// @version 2.6.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<div class="wc-account">
	<?php do_action('woocommerce_account_navigation'); ?>
	
	<div class="wc-account-content">
		<div class="contenedor">
			<?php wc_print_notices(); ?>
		
			<?php do_action('woocommerce_account_content'); ?>
		</div>
	</div>
</div>

