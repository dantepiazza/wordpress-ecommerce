<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 2.6.0

	if(!defined('ABSPATH')){ exit; }
?>

<div class="comentario ui-shadow" id="comentario-<?php comment_ID(); ?>">
	<div class="comentario-imagen">
		<?php
			//@hooked woocommerce_review_display_gravatar - 10

			do_action('woocommerce_review_before', $comment);
		?>								
	</div>
	
	<div class="comentario-cuerpo">
		<?php
			//@hooked woocommerce_review_display_rating - 10
			
			do_action('woocommerce_review_before_comment_meta', $comment);
			
			//@hooked woocommerce_review_display_meta - 10
			//@hooked WC_Structured_Data::generate_review_data() - 20
			
			do_action('woocommerce_review_meta', $comment);
			
			
			do_action('woocommerce_review_before_comment_text', $comment);
			
			//@hooked woocommerce_review_display_comment_text - 10
			do_action('woocommerce_review_comment_text', $comment);			
			
			do_action('woocommerce_review_after_comment_text', $comment);
		?>
	</div>
</div>