<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<p>
	<?php
		printf(
			'El pedido #%1$s fue generado el %2$s y actualmente se encuentra %3$s',
			'<mark class="order-number">' . $order->get_order_number() . '</mark>',
			'<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>',
			'<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>'
		);
	?>
</p>

<?php
	if($notes = $order -> get_customer_order_notes()){
		?>
			<div class="wc-account-form wc-order-updates">	
				<div class="wc-account-edit-form-header">Actualizaciones</div>
								
				<div class="wc-account-edit-form-content">
					<ol>
						<?php 
							foreach($notes as $note){
								?>
									<li class="wc-order-update">
										<p><strong><?php echo(date_i18n('l jS \d\e F Y, h:ia', strtotime($note -> comment_date))); ?></strong></p>
										
										<?php echo(wpautop(wptexturize($note -> comment_content))); ?>
									</li>
								<?php
							}
						?>
					</ol>
				</div>
			</div>
		<?php
	}

	do_action('woocommerce_view_order', $order_id);
?>
