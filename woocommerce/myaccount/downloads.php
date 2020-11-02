<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 3.0.0
	
	if(!defined('ABSPATH')){ exit; }

	$downloads = WC() -> customer -> get_downloadable_products();
	$has_downloads = (bool) $downloads;

	do_action('woocommerce_before_account_downloads', $has_downloads);

	if($has_downloads){
		do_action( 'woocommerce_before_available_downloads' ); 
	
		?>

		<table class="woocommerce-MyAccount-downloads shop_table shop_table_responsive">
			<thead>
				<tr>
					<?php 
						foreach(wc_get_account_downloads_columns() as $column_id => $column_name){
							echo('<th class="'.esc_attr($column_id).'"><span class="nobr">'.esc_html($column_name).'</span></th>');
						}
					?>
				</tr>
			</thead>
			
			<?php
				foreach($downloads as $download){
					echo('<tr>');
					
					foreach(wc_get_account_downloads_columns() as $column_id => $column_name){ 
						echo('<td class="'.esc_attr($column_id).'" data-title="'.esc_attr($column_name).'">');						
						
						if(has_action('woocommerce_account_downloads_column_'.$column_id)){
							do_action('woocommerce_account_downloads_column_'.$column_id, $download);
						}
						else{
							switch($column_id){
								case 'download-product' : 
									?>
										<a href="<?php echo esc_url( get_permalink( $download['product_id'] ) ); ?>">
											<?php echo esc_html( $download['product_name'] ); ?>
										</a>
									<?php
								
									break;
								case 'download-file' :
									?>
										<a href="<?php echo esc_url( $download['download_url'] ); ?>" class="woocommerce-MyAccount-downloads-file">
											<?php echo esc_html( $download['file']['name'] ); ?>
										</a>
									<?php
										
									break;
								case 'download-remaining' :
									echo((is_numeric($download['downloads_remaining'])) ? esc_html($download['downloads_remaining']) : '&infin;');
									
									break;
								case 'download-expires' :
									if(!empty($download['access_expires'])){
										?> 
											<time datetime="<?php echo(date('Y-m-d', strtotime($download['access_expires']))); ?>" title="<?php echo(esc_attr(strtotime($download['access_expires']))); ?>">
												<?php echo(date_i18n(get_option('date_format'), strtotime($download['access_expires']))); ?>
											</time>
										<?php
									}
									else{
										echo('Nunca');
									}
											
									break;
								case 'download-actions' :
									$actions = array(
										'download'  => array(
											'url'  => $download['download_url'],
											'name' => 'Descargar',
										),
									);
											
									if($actions = apply_filters('woocommerce_account_download_actions', $actions, $download)){
										foreach($actions as $key => $action){
											echo('<a href="'.esc_url($action['url']).'" class="button woocommerce-Button '.sanitize_html_class($key).'">'.esc_html($action['name']).'</a>');
										}
									}
											
									break;
							}
						}
						
						echo('</td>');
							
					}
					
					echo('</tr>');
				
				}
			?>
		</table>
		
		<?php
		
		do_action( 'woocommerce_after_available_downloads' );
			
	}
	else{
		?>
			<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
				<a class="woocommerce-Button button" href="<?php echo(esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop')))); ?>">
					Ir a la tienda
				</a>
				
				Todavía no hay descargas disponibles
			</div>
		<?php 
	}

	do_action('woocommerce_after_account_downloads', $has_downloads);
?>
