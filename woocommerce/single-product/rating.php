<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.6.0

	if(!defined('ABSPATH')){ exit; }

	global $product;

	if(wc_review_ratings_enabled()){
		$rating_count = $product -> get_rating_count();
		$review_count = $product -> get_review_count();
		$average = $product -> get_average_rating();

		if($rating_count > 0){
			?>
														
				<div class="product-rating">
					<?php echo(wc_get_rating_html($average, $rating_count)); // WPCS: XSS ok. ?>
					
					<div class="star-rating" title="<?php echo(esc_html($average).' de 5'); printf(_n( 'basado en el puntaje de %s comprador', 'basado en el puntaje de %s compradores', $rating_count), esc_html($rating_count)); ?>">
						<span style="width:<?php echo (($average / 5 ) * 100 ); ?>%"></span>
					</div>
																	
					<?php
						if(comments_open()){
							?> <a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('%s calificaci&oacute;n', '%s calificaciones', $review_count), '<span class="count">'.esc_html($review_count).'</span>' ); ?></a><?php
						}
					?>
				</div>
			
			<?php 
		}
	}