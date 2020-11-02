<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 4.4.0
	
	if(!defined('ABSPATH')){ exit; }

	if($cross_sells){
		?>
			<div class="cross-sells">
				<h2 class="titulado">Tal vez te interese</h2>

				<?php 
					woocommerce_product_loop_start(); 
					
					foreach($cross_sells as $cross_sell){
						$post_object = get_post($cross_sell -> get_id());

						setup_postdata($GLOBALS['post'] =& $post_object);

						$descripcion = false;
						
						wc_get_template_part('content', 'product');
					}
					
					woocommerce_product_loop_end();
				?>
			</div>
		<?php 
	}

	wp_reset_postdata();
?>
