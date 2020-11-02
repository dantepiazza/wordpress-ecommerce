<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 2.2.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<div class="wc-products-order">
	<form class="woocommerce-ordering" method="get">
		<?php $orderby = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby')); ?>
										
		<select name="orderby" class="orderby">
			<?php 
				//foreach($catalog_orderby_options as $id => $name){
				//	echo('<option value="'.esc_attr($id).'" '.selected($orderby, $id).'>'.esc_html($name).'</option>');
				//}
			?>
			
			<option value="menu_order" <?php selected($orderby, 'menu_order'); ?>>Orden por defecto</option>
			<option value="popularity" <?php selected($orderby, 'popularity'); ?>>Ordenar por popularidad</option>
			<option value="rating" <?php selected($orderby, 'rating'); ?>>Ordenar por calificación media</option>
			<option value="date" <?php selected($orderby, 'date'); ?>>Ordenar por fecha</option>
			<option value="price" <?php selected($orderby, 'price'); ?>>Ordenar por menor precio</option>
			<option value="price-desc" <?php selected($orderby, 'price-desc'); ?>>Ordenar por mayor precio</option>
		</select>										
										
		<?php wc_query_string_form_fields(null, array('orderby', 'submit')); ?>
	</form>
</div>