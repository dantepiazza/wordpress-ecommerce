<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 3.5.1
	
	if(!defined('ABSPATH')){ exit; }
 
	global $post, $product;

	$attachment_ids = $product -> get_gallery_image_ids();

	if(function_exists('wc_get_gallery_image_html') and $attachment_ids and $product -> get_image_id()){		
		foreach ($attachment_ids as $attachment_id){
			$full_size_image = wp_get_attachment_image_src($attachment_id, 'full');
			$thumbnail = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
			$image_title = get_post_field('post_excerpt', $attachment_id);

			$attributes = array(
				'title' => $image_title,
				'data-src' => $full_size_image[0],
				'data-large_image' => $full_size_image[0],
				'data-large_image_width' => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);

			//echo(apply_filters('woocommerce_single_product_image_thumbnail_html', '<div data-thumb="'.esc_url($thumbnail[0]).'" class="product-gallery-image woocommerce-product-gallery__image"><a href="'.esc_url($full_size_image[0]).'">'.wp_get_attachment_image($attachment_id, 'shop_single', false, $attributes).'</a></div>', $attachment_id));
			echo(apply_filters('woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html($attachment_id), $attachment_id));
		}
	}
	