<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.0.0
	// @depreacated 2.6.0
	
	if(!defined('ABSPATH')){ exit; }

	if($downloads = WC() -> customer -> get_downloadable_products()){
		do_action('woocommerce_before_available_downloads');
	
		?>

		<h2><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', 'Descargas disponibles'); ?></h2>

		<ul class="woocommerce-Downloads digital-downloads">
			<?php 
				foreach($downloads as $download){
					?>
						<li>
							<?php
								do_action( 'woocommerce_available_download_start', $download);

								if(is_numeric($download['downloads_remaining'])){
									echo(apply_filters( 'woocommerce_available_download_count', '<span class="woocommerce-Count count">'.sprintf(_n('%s descarga restante', '%s descargas restantes', $download['downloads_remaining']), $download['downloads_remaining']).'</span> ', $download));
								}
									
								echo apply_filters('woocommerce_available_download_link', '<a href="'.esc_url($download['download_url']).'">'.$download['download_name'].'</a>', $download);

								do_action('woocommerce_available_download_end', $download);
							?>
						</li>
					<?php 
				} 
			?>
		</ul>

		<?php
		
		do_action( 'woocommerce_after_available_downloads' );
	}
?>