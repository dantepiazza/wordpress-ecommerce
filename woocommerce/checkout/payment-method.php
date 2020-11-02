<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.3.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<li class="wc_payment_method payment_method_<?php echo($gateway -> id); ?>">
	<input id="payment_method_<?php echo($gateway -> id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo(esc_attr($gateway -> id)); ?>" <?php checked($gateway -> chosen, true); ?> data-order_button_text="<?php echo(esc_attr($gateway -> order_button_text)); ?>" />

	<label for="payment_method_<?php echo($gateway -> id); ?>">
		<?php echo($gateway -> get_title().' '.$gateway -> get_icon()); ?>
	</label>
	
	<?php
		if($gateway -> has_fields() or $gateway -> get_description()){
			?>
				<div class="payment_box payment_method_<?php echo($gateway -> id); ?>" <?php if(!$gateway -> chosen){ ?> style="display:none;" <?php } ?>>
					<?php $gateway -> payment_fields(); ?>
				</div>
			<?php 
		}
	?>
</li>