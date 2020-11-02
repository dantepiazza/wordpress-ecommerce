<?php 
	// @version 2.6.0
	
	if(!defined('ABSPATH')){ exit; }

	do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="wc-account-navigation estructura-encabezado">
	<div class="contenedor">
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.wc-account-navigation-button').click(function(){
					jQuery('.wc-account-navigation-menu').slideToggle();
				});
			});
		</script>
		
		<div class="wc-account-navigation-nav">
			<a class="wc-account-navigation-button fa fa-bars"></a>
		</div>
		
		<ul class="wc-account-navigation-menu">
			<?php 
				foreach(wc_get_account_menu_items() as $endpoint => $label){
					?>
						<li class="<?php echo(wc_get_account_menu_item_classes($endpoint)); ?>">
							<a href="<?php echo(esc_url( wc_get_account_endpoint_url($endpoint))); ?>"><?php echo(esc_html($label)); ?></a>
						</li>
					<?php 
				}
			?>
		</ul>
	</div>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>
