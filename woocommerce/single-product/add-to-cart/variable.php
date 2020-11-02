<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	global $product;

	do_action('woocommerce_before_add_to_cart_form' );
	
	
	function woocommerce_add_product_tabs_variations(){			
		global $woocommerce, $product, $post, $re_wcvt_options;    
	
		$get_variations = count($product -> get_children()) <= apply_filters('woocommerce_ajax_variation_threshold', 30, $product);

        $available_variations = (($get_variations) ? $product -> get_available_variations() : false);
        $attributes = $product -> get_variation_attributes();
        $selected_attributes = $product -> get_default_attributes();

		$attribute_keys = array_keys( $attributes );
				
		if(empty($available_variations) && false !== $available_variations){
			echo('<p class="stock out-of-stock">Este producto está actualmente agotado y no está disponible.</p>');
		}
		else{
			?> <div class="variations product-variations"> <?php
			
			foreach($attributes as $attribute_name => $options){
				?>
					<div class="variation">
						<label for="<?php echo(sanitize_title($attribute_name)); ?>"><?php echo(wc_attribute_label($attribute_name)); ?></label>
						<?php
							$selected = ((isset($_REQUEST['attribute_'.sanitize_title($attribute_name)])) ? wc_clean(stripslashes(urldecode($_REQUEST['attribute_'.sanitize_title($attribute_name)]))) : $product -> get_variation_default_attribute($attribute_name));
														
							wc_dropdown_variation_attribute_options(array('options' => (array) $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected));
													
							echo((end($attribute_keys) === $attribute_name) ? apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">Restablecer</a>') : '');
						?>
					</div>				
				<?php 
			}	
			
			?> </div> <?php			
		}	
	}
?>

<div class="product-cart">
	<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product -> get_id()); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
		<div class="product-data">									
			<?php
				//@hooked woocommerce_output_product_data_tabs - 10
				//@hooked woocommerce_upsell_display - 15
				remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20, 2); 
						
				do_action('woocommerce_after_single_product_summary');
			?>
		</div>
		
		<?php 
			do_action('woocommerce_before_variations_form');
		
			if(empty($available_variations) && false !== $available_variations){
			
			}
			else{
				do_action('woocommerce_before_add_to_cart_button');  
				
				?>
						
					<div class="single_variation_wrap">
						<?php
							do_action( 'woocommerce_before_single_variation' );

							//@hooked woocommerce_single_variation - 10 Empty div for variation data.
							//@hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.

							do_action( 'woocommerce_single_variation' );

							do_action( 'woocommerce_after_single_variation' );
						?>
					</div>
				<?php
				
				do_action('woocommerce_after_add_to_cart_button');				
			}

			do_action( 'woocommerce_after_variations_form');
		?>
	</form>
</div>
	
<?php do_action('woocommerce_after_add_to_cart_form'); ?>