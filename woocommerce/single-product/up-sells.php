<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	if($upsells){
		?>
		
			<section class="wc-upsells">				
				<div class="wc-products">
					<div class="wc-products-list">
						<h2 class="titulado">Te recomendamos estos productos</h2>

						<ul class="products">
							<?php 
								foreach($upsells as $upsell){ 
									$post_object = get_post($upsell -> get_id());
									
									setup_postdata($GLOBALS['post']=&$post_object);
									
									wc_get_template_part('content', 'product');
								} 
							?>
						</ul>						
					</div>
				</div>
			</section>

		<?php 
	}

	wp_reset_postdata();
?>
