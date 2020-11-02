<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 1.6.4
	
	//@hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	//@hooked woocommerce_breadcrumb - 20
	//do_action('woocommerce_before_main_content');
	
	//@hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	//do_action('woocommerce_after_main_content');
		
	//@hooked woocommerce_get_sidebar - 10
	//do_action('woocommerce_sidebar');
	
	if(!defined('ABSPATH')){ exit; }

	get_header('shop');
	
	if (have_posts()){
		?>
			<div class="wc-product">				
				<?php 
					if(post_password_required()){
						?>
							<div class="wc-product-contenedor">
								<div class="contenedor">
									<?php echo(get_the_password_form()); ?>
								</div>
							</div>
						<?php						
					}
					else{
						?>
							<div class="wc-product-contenedor">
								<div class="contenedor">
									<?php 
										
										//@hooked wc_print_notices - 10
										
										do_action('woocommerce_before_single_product');
										
										while(have_posts()){ the_post();
											wc_get_template_part('content', 'single-product');
										};
										
										do_action('woocommerce_after_single_product');
										
									?>
								</div>
							</div>
						<?php
						
						woocommerce_output_related_products();
					}
				?>
			</div>
		<?php
	}
	else{	
		require_once('404.php');
	}; 
	
	get_footer('shop'); 
?>