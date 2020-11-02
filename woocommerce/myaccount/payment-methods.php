<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 2.6.0
	
	if(!defined('ABSPATH')){ exit; }

	$saved_methods = wc_get_customer_saved_methods_list( get_current_user_id() );
	$has_methods = (bool) $saved_methods;
	$types = wc_get_account_payment_methods_types();

	do_action('woocommerce_before_account_payment_methods', $has_methods);
	
	if($has_methods){
		?>
			<table class="woocommerce-MyAccount-paymentMethods shop_table shop_table_responsive account-payment-methods-table">
				<thead>
					<tr>
						<?php
							foreach(wc_get_account_payment_methods_columns() as $column_id => $column_name){
								?> <th class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo(esc_attr($column_id)); ?> payment-method-<?php echo(esc_attr($column_id)); ?>"><span class="nobr"><?php echo(esc_html($column_name)); ?></span></th> <?php
							}
						?>
					</tr>
				</thead>
				
				<?php
					foreach($saved_methods as $type => $methods){
						foreach($methods as $method){
							echo('<tr class="payment-method'.((!empty($method['is_default'])) ? ' default-payment-method' : '').'">');
							
							foreach(wc_get_account_payment_methods_columns() as $column_id => $column_name){
								echo('<td class="woocommerce-PaymentMethod woocommerce-PaymentMethod'.esc_attr($column_id).' payment-method-'.esc_attr($column_id).'" data-title="'.esc_attr($column_name).'">');
							
								if(has_action('woocommerce_account_payment_methods_column_'.$column_id)) {
									do_action('woocommerce_account_payment_methods_column_'.$column_id, $method);
								}
								else if('method' === $column_id){
									if(!empty($method['method']['last4'])){
										echo(sprintf('%1$s terminando en %2$s', esc_html(wc_get_credit_card_type_label($method['method']['brand'])), esc_html($method['method']['last4'])));
									}
									else{
										echo(esc_html(wc_get_credit_card_type_label($method['method']['brand'])));
									}
								}
								else if('expires' === $column_id){
									echo(esc_html($method['expires']));
								}
								else if('actions' === $column_id){
									foreach($method['actions'] as $key => $action){
										echo('<a href="'.esc_url($action['url']).'" class="button '.sanitize_html_class($key).'">'.esc_html($action['name']).'</a>&nbsp;');
									}
								}
								
								echo('</td>');
							}
							
							echo('</tr>');
						}
					}
				?>
				
			</table>
			
		<?php 
	}
	else{
		echo('<p class="woocommerce-Message woocommerce-Message--info woocommerce-info">No se han encontrado m&eacute;todos de pago guardados.</p>');
	}
	
	do_action('woocommerce_after_account_payment_methods', $has_methods);
?>

<a class="button" href="<?php echo(esc_url(wc_get_endpoint_url('add-payment-method' ))); ?>">Agregar m&eacute;todo de pago</a>