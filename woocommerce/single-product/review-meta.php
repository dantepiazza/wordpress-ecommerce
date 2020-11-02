<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.4.0

	if(!defined('ABSPATH')){ exit; }

	global $comment;

	$verified = wc_review_is_from_verified_owner($comment -> comment_ID);
?>

<div class="comentario-meta">
	<strong class="comentario-author" itemprop="author"><?php comment_author(); ?>:</strong>							
	
	<?php 
		if('yes' === get_option('woocommerce_review_rating_verification_label') && $verified){
			echo('<em class="woocommerce-review__verified verified">(Calificador verificado)</em> ');
		}
	?>
	
	<time class="comentario-date" itemprop="datePublished" datetime="<?php echo(get_comment_date('c')); ?>"><?php echo(get_comment_date(wc_date_format())); ?></time>

	<?php
		if ($comment -> comment_approved == '0'){ 
			echo('<small>(Tu calificaci&oacute;n ser&aacute; p&uacute;blica cuando un administrador la apruebe)</small> ');
		}
	?>
</div>