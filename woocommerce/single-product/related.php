<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.9.0

	if(!defined('ABSPATH')){ exit; }

	if($related_products){
		?>
		
			<section class="wc-related">
				<div class="contenedor">
					<div class="wc-products">
						<div class="wc-products-list">
							<h2 class="titulado"><span>Otros</span>Productos relacionados</h2>

							<ul class="products">
								<?php 
									woocommerce_product_loop_start();
									
									foreach($related_products as $related_product){ 
										$post_object = get_post($related_product -> get_id());

										setup_postdata($GLOBALS['post']=&$post_object);

										wc_get_template_part('content', 'product');
									} 
									
									woocommerce_product_loop_end();
								?>
							</ul>
						</div>
					</div>
				</div>
			</section>

		<?php 
	}

	wp_reset_postdata();
?>