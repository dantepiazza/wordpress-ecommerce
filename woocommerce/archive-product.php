<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.4.0
 
	if(!defined('ABSPATH')){ exit; }
	
	get_header('shop');
?>
	<div class="wc-shop">
		<div class="wc-shop-encabezado estructura-encabezado">
			<div class="contenedor">
				<h1><?php if(apply_filters( 'woocommerce_show_page_title', true)){ woocommerce_page_title(); } ?></h1>
				
				<div class="navegacion"><?php woocommerce_breadcrumb(); ?></div>
				
				<?php
					//@hooked woocommerce_taxonomy_archive_description - 10
					//@hooked woocommerce_product_archive_description - 10
					//do_action('woocommerce_archive_description');
				?>
			</div>
		</div>
					
		<div class="wc-shop-contenedor">
			<div class="contenedor">
					<?php	
						//do_action('woocommerce_sidebar');
					
						//@hooked woocommerce_output_content_wrapper - 10
						//@hooked WC_Structured_Data::generate_website_data() - 30
						remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 2); 
						
						do_action('woocommerce_before_main_content');
						
						if(woocommerce_product_loop()){						
							echo('<div class="wc-shop-list">');
							wc_print_notices();
							
							//@hooked wc_print_notices - 10v
							remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 2); 
							remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30, 2); 
							 
							do_action('woocommerce_before_shop_loop');
							
							global $wp_query;
							
							woocommerce_product_loop_start();								
								
							//woocommerce_product_subcategories();		
								
							if(wc_get_loop_prop('total')){
								while(have_posts()){ the_post();
									do_action('woocommerce_shop_loop');

									wc_get_template_part('content', 'product');
								}
							}
							
							woocommerce_product_loop_end();
							
							//@hooked woocommerce_pagination - 10
							
							do_action('woocommerce_after_shop_loop');
							
							echo('</div>');						
							
							//@hooked woocommerce_get_sidebar - 10

							//do_action( 'woocommerce_sidebar' );
						}
						else if(!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))){
							//@hooked wc_no_products_found - 10				
							
							do_action('woocommerce_no_products_found');
						} 
						else{
							//@hooked wc_no_products_found - 10				
							
							do_action('woocommerce_no_products_found');
						}
						
						//@hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)

						do_action('woocommerce_after_main_content');
					?>
			</div>
		</div>
	</div>

<?php 
	do_action('woocommerce_after_main_content');

	get_footer( 'shop' ); 
?>
