<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.6.0

	if(!defined('ABSPATH')){ exit; }
?>

<table class="woocommerce-product-attributes shop_attributes">
	<?php
		foreach($product_attributes as $product_attribute_key => $product_attribute){
			?>
				<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--<?php echo(esc_attr($product_attribute_key)); ?>">
					<th class="woocommerce-product-attributes-item__label"><?php echo(wp_kses_post($product_attribute['label'])); ?></th>
					<td class="woocommerce-product-attributes-item__value"><?php echo(wp_kses_post($product_attribute['value'])); ?></td>
				</tr>
			<?php
		}
	?>
</table>
