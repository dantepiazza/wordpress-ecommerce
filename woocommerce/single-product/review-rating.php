<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.6.0

	if(!defined('ABSPATH')){ exit; }

	global $comment;

	$rating = intval(get_comment_meta($comment -> comment_ID, 'rating', true));

	if($rating && wc_review_ratings_enabled()){
		echo(wc_get_rating_html($rating)); // WPCS: XSS ok.
		
		?>
			<div class="star-rating" title="<?php echo(esc_html($rating).' de 5, '); ?>">
				<span style="width:<?php echo (($rating / 5 ) * 100 ); ?>%"></span>
			</div>
		<?php
	}