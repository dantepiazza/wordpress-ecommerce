<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.2.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<p class="order-info">
	<?php
		echo(wp_kses_post(apply_filters('woocommerce_order_tracking_status', sprintf(
			'El pedido #%1$s fue generado el %2$s y actualmente se encuentra %3$s',
			'<mark class="order-number">'.$order -> get_order_number().'</mark>',
			'<mark class="order-date">'.wc_format_datetime($order -> get_date_created()).'</mark>',
			'<mark class="order-status">'.wc_get_order_status_name($order -> get_status()).'</mark>'
		))));	
	?>
</p>

<?php
	if($notes = $order->get_customer_order_notes()){
		?>
			<h2>Seguimiento del pedido</h2>
			
			<ol class="commentlist notes">
				<?php
					foreach($notes as $note){
						?>
							<li class="comment note">
								<div class="comment_container">
									<div class="comment-text">
										<p class="meta"><?php echo(date_i18n('l jS \d\e F Y, h:ia'), strtotime($note -> comment_date))); ?></p>
										
										<div class="description">
											<?php echo(wpautop(wptexturize($note -> comment_content))); ?>
										</div>
										
										<div class="clear"></div>
									</div>
									
									<div class="clear"></div>
								</div>
							</li>
						<?php
					} 
				?>
			</ol>
		<?php 
	}
	
	do_action('woocommerce_view_order', $order -> get_id());
?>