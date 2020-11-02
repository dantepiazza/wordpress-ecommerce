<?php 
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0
	
	//@hooked woocommerce_template_loop_product_link_open - 10
	//do_action('woocommerce_before_shop_loop_item');
	
	//@hooked woocommerce_show_product_loop_sale_flash - 10
	//@hooked woocommerce_template_loop_product_thumbnail - 10
	//do_action('woocommerce_before_shop_loop_item_title');
				
	//@hooked woocommerce_template_loop_product_title - 10
	//do_action('woocommerce_shop_loop_item_title');
				
	//@hooked woocommerce_template_loop_rating - 5
	//@hooked woocommerce_template_loop_price - 10
	//do_action('woocommerce_after_shop_loop_item_title');
						
	//@hooked woocommerce_template_loop_product_link_close - 5
	//@hooked woocommerce_template_loop_add_to_cart - 10
	//do_action('woocommerce_after_shop_loop_item');
	
	global $product;

	if(!empty($product) || $product -> is_visible()){
		?>
			<li <?php post_class(array('wc-product', 'ui-shadow')); ?>>
				<?php 				
					do_action('woocommerce_before_shop_loop_item');
					
					//woocommerce_template_loop_product_link_open();				
				?>
				
				<div class="product-image" style="background-image:url(<?php echo((has_post_thumbnail()) ? get_the_post_thumbnail_url(null, 'productos') : wc_placeholder_img_src()); ?>);">
					<?php 											
						//woocommerce_template_loop_product_thumbnail();
						
						woocommerce_show_product_loop_sale_flash();
						
						//woocommerce_template_loop_rating();							
					?>
				</div>	

				<?php woocommerce_template_loop_product_link_close(); ?>
				
				<div class="product-content">
					<div class="product-content-container">
						<div class="product-description">
							<?php echo((!empty($product -> get_sku()) ? 'Art. '.$product -> get_sku().' | ' : '')); ?>
							
							<?php echo(wc_get_product_category_list($product -> get_id())); ?>
						</div>
						<h2 class="product-title"><?php the_title(); ?></h2>
						<h6 class="product-price"><?php woocommerce_template_loop_price(); ?></h6>
					</div>
					
					<?php //woocommerce_template_loop_add_to_cart(); ?>
				</div>
			</li>
		<?php
	}
?>