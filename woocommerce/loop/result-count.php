<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.0.0

	if(!defined('ABSPATH')){ exit; }

	global $wp_query;

	if(woocommerce_products_will_display()){
		echo('<div class="wc-products-results">');
											
		$paged = max(1, $wp_query -> get('paged'));
		$per_page = $wp_query -> get('posts_per_page');
		$total = $wp_query -> found_posts;
		$first = ($per_page * $paged) - $per_page + 1;
		$last = min($total, $wp_query -> get('posts_per_page') * $paged);

		if($total <= $per_page || -1 === $per_page){
			printf(_n('Mostrando el &uacute;nico resultado', 'Mostrando los %d resultados', $total), $total);
		}
		else{
			printf(_nx('Mostrando el &uacute;nico resultado', 'Mostrando %1$d&ndash;%2$d de %3$d resultados', $total, 'desde el primer al &uacute;ltimo resultado'), $first, $last, $total);
		}
											
		echo('</div>');
	}
?>