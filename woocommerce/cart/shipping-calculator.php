<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.0.8
	
	if(!defined('ABSPATH')){ exit; }
	
	if(get_option('woocommerce_enable_shipping_calc') === 'no' or !WC() -> cart -> needs_shipping()){
		return;
	}
	
	do_action('woocommerce_before_shipping_calculator');
	
	?>
		<form class="woocommerce-shipping-calculator" action="<?php echo(esc_url(wc_get_cart_url())); ?>" method="post">
			<p><a href="#" class="shipping-calculator-button">Calcular envio</a></p>

			<section class="shipping-calculator-form" style="display:none;">
				<p class="form-row form-row-wide" id="calc_shipping_country_field">
					<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
						<option value="">Seleccionar pa&iacute;s</option>
						<?php
							foreach(WC() -> countries -> get_shipping_countries() as $key => $value){
								echo('<option value="'.esc_attr($key).'" '.selected(WC() -> customer -> get_shipping_country(), esc_attr($key), false).'>'.esc_html($value).'</option>');
							}
						?>
					</select>
				</p>

				<p class="form-row form-row-wide" id="calc_shipping_state_field">
					<?php
						$current_cc = WC() -> customer -> get_shipping_country();
						$current_r  = WC() -> customer -> get_shipping_state();
						$states     = WC() -> countries -> get_states($current_cc);

						if(is_array($states) && empty($states)){
							echo('<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="Provincia" />');
						}
						else if(is_array($states)){
							?>
								<span>
									<select name="calc_shipping_state" id="calc_shipping_state" placeholder="Provincia">
										<option value="">Seleccionar provincia</option>
										<?php
											foreach($states as $ckey => $cvalue){
												echo('<option value="'.esc_attr($ckey).'" '.selected($current_r, $ckey, false) . '>'.esc_html($cvalue).'</option>');
											}
										?>
									</select>
								</span>
							<?php
						}
						else{
							echo('<input type="text" class="input-text" value="'.esc_attr($current_r).'" placeholder="Provincia" name="calc_shipping_state" id="calc_shipping_state" />');
						}
					?>
				</p>

				<?php
					if(apply_filters( 'woocommerce_shipping_calculator_enable_city', false)){
						?>
							<p class="form-row form-row-wide" id="calc_shipping_city_field">
								<input type="text" class="input-text" value="<?php echo(esc_attr(WC() -> customer -> get_shipping_city())); ?>" placeholder="Ciudad" name="calc_shipping_city" id="calc_shipping_city" />
							</p>
						<?php
					} 
				?>

				<?php
					if(apply_filters('woocommerce_shipping_calculator_enable_postcode', true)){ 
						?>
							<p class="form-row form-row-wide" id="calc_shipping_postcode_field">
								<input type="text" class="input-text" value="<?php echo(esc_attr(WC() -> customer -> get_shipping_postcode())); ?>" placeholder="C&oacute;digo postal" name="calc_shipping_postcode" id="calc_shipping_postcode" />
							</p>
						<?php 
					} 
				?>

				<p><button type="submit" name="calc_shipping" value="1" class="boton boton-secundario">Actualizar total</button></p>

				<?php wp_nonce_field('woocommerce-cart'); ?>
			</section>
		</form>
	<?php
	
	do_action('woocommerce_after_shipping_calculator');
?>