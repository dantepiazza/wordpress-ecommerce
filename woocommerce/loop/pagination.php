<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 2.2.2

	if(!defined('ABSPATH')){ exit; }
	
	global $wp_query;

	if($wp_query -> max_num_pages >= 1){
		?>
			<div class="wc-pagination">
				<?php
					echo paginate_links(array(
						'base' => esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false)))),
						'format' => '',
						'add_args' => false,
						'current' => max(1, get_query_var('paged')),
						'total' => $wp_query -> max_num_pages,
						'end_size' => 3,
						'mid_size' => 3,
					));
				?>
			</div>
		<?php
	}