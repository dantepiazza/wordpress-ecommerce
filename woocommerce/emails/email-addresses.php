<?php
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	$text_align = is_rtl() ? 'right' : 'left';
?>

<table id="addresses" cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">
	<tr>
		<td class="td" style="text-align:<?php echo $text_align; ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" valign="top" width="50%">
			<h3>Direcci&oacute;n de facturaci&oacute;n</h3>

			<p class="text"><?php echo($order -> get_formatted_billing_address()); ?></p>
		</td>
		
		<?php
			if (!wc_ship_to_billing_address_only() && $order -> needs_shipping_address() && ($shipping = $order -> get_formatted_shipping_address())){
				?>
					<td class="td" style="text-align:<?php echo($text_align); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" valign="top" width="50%">
						<h3>Direcci&oacute;n de env&iacute;o</h3>
						<p class="text"><?php echo($shipping); ?></p>
					</td>
				<?php 
			}
		?>
	</tr>
</table>