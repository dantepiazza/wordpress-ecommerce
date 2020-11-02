<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	global $product;
?>

<div class="product-price">
	<?php echo($product -> get_price_html()); ?>
</div>
