<?php
	// @author  WooThemes
	// @package WooCommerce/Templates
	// @version 3.5.1

	if(!defined('ABSPATH')){ exit; }

	global $post, $product;
	
	$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
	$post_thumbnail_id = $product -> get_image_id();
	$full_size_image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
	$image_title = get_post_field('post_excerpt', $post_thumbnail_id);
	$placeholder = ($product -> get_image_id() ? 'with-images' : 'without-images');
	$wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . $placeholder,
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	));
?>

<div class="product-gallery <?php echo(esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes)))); ?>" data-columns="<?php echo(esc_attr($columns)); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="product-gallery-thumbnails woocommerce-product-gallery__wrapper">
		<?php
			if($product -> get_image_id()){
				$html = wc_get_gallery_image_html($post_thumbnail_id, true);
			} 
			else{
				$html = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), 'Esperando la imagen del producto');
				$html .= '</div>';
			}

			echo(apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id)); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

			do_action('woocommerce_product_thumbnails');
		?>
	</figure>
</div>