<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 2.5.0

	if(!defined('ABSPATH')){ exit; }
?>

<script type="text/template" id="tmpl-variation-template">
	<div class="woocommerce-variation-description">
		{{{ data.variation.variation_description }}}
	</div>

	<div class="woocommerce-variation-price">
		{{{ data.variation.price_html }}}
	</div>

	<div class="woocommerce-variation-availability">
		{{{ data.variation.availability_html }}}
	</div>
</script>

<script type="text/template" id="tmpl-unavailable-variation-template">
	<p>Lo sentimos, este producto no está disponible. Por favor, elegí una combinación diferente.</p>
</script>
