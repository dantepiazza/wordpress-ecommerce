<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<div class="woocommerce-order wc-pedido">
	<?php 
		if($order){ 
			if($order -> has_status('failed')){
				?>
					<div class="wc-pedido-fallado">
						<div class="wc-pedido-fallado-contenido">
							<i class="fa fa-times-circle"></i>
							<h1>Tu pedido no pudo ser proceado</h1>
							<h5>Lamentablemente, tu pedido no puede procesarse ya que el banco o medio de pago ha rechazado la transacción. ¡Pero podés realizar tu compra nuevamente!.</h5>
						
							<a href="<?php echo(esc_url($order -> get_checkout_payment_url())); ?>" class="boton">Pagar</a>
							
							<?php
								if(is_user_logged_in()){
									echo('<a href="'.esc_url(wc_get_page_permalink('myaccount')).'" class="boton">Mi cuenta</a>');
								}
							?>
						</div>
						
						<!--<div class="wc-pedido-pago">
							<?php do_action('woocommerce_thankyou_'.$order -> get_payment_method(), $order -> get_id()); ?>
						</div>-->
					</div>
				<?php
			}
			else{
				?>
					<div class=" wc-pedido-general">
						<div class="ui-box ui-shadow wc-pedido-datos">
							<div class="ui-box-content">
								<span class="fa fa-check-circle"></span>
								
								<div class="detalles">
									<h6>Datos del pedido</h6>

									<p>
										<strong>N&uacute;mero de pedido: </strong> <?php echo($order -> get_order_number()); ?><br>
										<strong>Fecha: </strong> <?php echo(wc_format_datetime($order -> get_date_created())); ?><br>
																		
										<?php 
											if($order -> get_payment_method_title()){
												?><strong>Metodo de pago: </strong> <?php echo(wp_kses_post($order -> get_payment_method_title()));
											}
										?>
									</p>
								</div>
							</div>
						</div>

						<div class="ui-box ui-shadow wc-pedido-pago">
							<div class="ui-box-content">
								<?php do_action('woocommerce_thankyou_'.$order -> get_payment_method(), $order -> get_id()); ?>
							</div>
						</div>
					</div>
				<?php 
			}				
			
			do_action('woocommerce_thankyou', $order -> get_id());
			
			do_action('woocommerce_order_details_after_order_table', $order);

			if(is_user_logged_in() and $order -> get_user_id() === get_current_user_id()){
				wc_get_template('order/order-details-customer.php', array('order' => $order));
			}
		}
		else{
			?>
				<div class="wc-pedido-recibido">
					<div class="wc-pedido-recibido-contenido">
						<i class="fa fa-check-circle"></i>
						<h1>¡Gracias! Tu pedido fue recibido</h1>
						<h5>Ya tenemos tu pedido, a la brevedad lo procesaremos y te informaremos de su estado.</h5>
					</div>
				</div>
			<?php
		}
	?>
</div>