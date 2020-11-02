<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }

	global $product;
?>

<div class="product-meta">
	<?php 
		do_action('woocommerce_product_meta_start');
															
		if(wc_product_sku_enabled() && ($product -> get_sku() || $product -> is_type('variable'))){ 
			?><span class="meta-sku">Art. <span class="sku"><?php echo ( $sku = $product -> get_sku() ) ? $sku : esc_html__('N/A'); ?></span>&nbsp;|&nbsp;</span><?php
		} 

		echo(wc_get_product_category_list($product -> get_id(), ', ', '<span class="meta-categories">', '</span>'));

		//echo(wc_get_product_tag_list($product -> get_id(), ', ', '<span class="meta-tags">', '</span>'));
			 
		do_action('woocommerce_product_meta_end');
	?>
</div>