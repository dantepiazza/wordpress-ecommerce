<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }

	global $product, $post;
?>

<div <?php post_class(array('product-content')); ?> id="product-<?php the_ID(); ?>">
	<div class="product-image">
		<?php			
			//@hooked woocommerce_show_product_sale_flash - 10
			//@hooked woocommerce_show_product_images - 20
		 
			do_action('woocommerce_before_single_product_summary');
		?>
	</div>
												
	<div class="product-summary">
		<?php
			//@hooked woocommerce_template_single_title - 5
			//@hooked woocommerce_template_single_rating - 10
			//@hooked woocommerce_template_single_price - 10
			//@hooked woocommerce_template_single_excerpt - 20
			//@hooked woocommerce_template_single_add_to_cart - 30
			//@hooked woocommerce_template_single_meta - 40
			//@hooked woocommerce_template_single_sharing - 50
			//@hooked WC_Structured_Data::generate_product_data() - 60
			
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5, 2); 
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 2); 
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 2); 
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 2); 
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30, 2); 
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 2); 
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50, 2); 
			
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5); 
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10); 
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20); 
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30);			
			
			do_action('woocommerce_single_product_summary');
		
			if(!$product -> is_type('variable')) {
				?>	
				
				<div class="product-data ui-shadow">									
					<?php
						//@hooked woocommerce_output_product_data_tabs - 10
						//@hooked woocommerce_upsell_display - 15
						remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20, 2); 
						
						do_action('woocommerce_after_single_product_summary');
					?>
				</div>
				
				<?php  
				
				woocommerce_template_single_add_to_cart(); 
			} 
			else{
				woocommerce_template_single_add_to_cart(); 
			}
		?>
	</div>
</div>
									
