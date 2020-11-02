<?php
	// @version 3.0.0
 
	if(!defined('ABSPATH')){ exit; }

	$text_align = ((is_rtl()) ? 'right' : 'left');

	do_action('woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email); 

	if(!$sent_to_admin){
		echo('<h2>Pedido #'.$order -> get_order_number().'</h2>');
	}
	else{
		echo('<h2><a class="link" href="'.esc_url(admin_url('post.php?post='.$order -> get_id().'&action=edit')).'">Pedido #'.$order -> get_order_number().'</a> (<time datetime="'.$order -> get_date_created() -> format( 'c' ).'">'.wc_format_datetime($order -> get_date_created()).'</time>)</h2>');
	}
?>

	<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
		<thead>
			<tr>
				<th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;">Producto</th>
				<th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;">Cantidad</th>
				<th class="td" scope="col" style="text-align:<?php echo $text_align; ?>;">Precio</th>
			</tr>
		</thead>
		<tbody>
			<?php
				echo wc_get_email_order_items($order, array(
					'show_sku' => $sent_to_admin,
					'show_image' => false,
					'image_size' => array(32, 32),
					'plain_text' => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				));
			?>
		</tbody>
		<tfoot>
			<?php
				if($totals = $order -> get_order_item_totals()){ $i = 0;
					foreach($totals as $total){ $i++;					
						?>
							<tr>
								<th class="td" scope="row" colspan="2" style="text-align:<?php echo($text_align); ?>; <?php echo((1 === $i) ? 'border-top-width: 4px;' : ''); ?>"><?php echo($total['label']); ?></th>
								<td class="td" style="text-align:<?php echo($text_align); ?>; <?php echo((1 === $i) ? 'border-top-width: 4px;' : ''); ?>"><?php echo($total['value']); ?></td>
							</tr>
						<?php
					}
				}
			?>
		</tfoot>
	</table>

<?php do_action('woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email); ?>
