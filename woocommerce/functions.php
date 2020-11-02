<?php

	function woocommerce_template_loop_sku(){
		global $product;
		
		echo(($product -> product_typee == 'simple') ? $product -> get_sku() : '');
	}
	
	add_filter('woocommerce_email_subject_new_order', 'woocommerce_email_subject_01', 1, 2);

	function woocommerce_email_subject_01($subject, $order) {
		global $woocommerce;
		
		return 'Nuevo pedido #'.$order -> get_id().' a nombre de '.$order -> get_billing_first_name().' '.$order -> get_billing_last_name();
	}
	
	add_filter('woocommerce_email_subject_customer_processing_order', 'woocommerce_email_subject_02', 1, 2);

	function woocommerce_email_subject_02($subject, $order) {
		global $woocommerce;
		
		return $order -> get_billing_first_name().', estamos procesando tu pedido #'.$order -> get_id();
	}
	
	add_filter('woocommerce_email_subject_customer_completed_order', 'woocommerce_email_subject_03', 1, 2);

	function woocommerce_email_subject_03($subject, $order) {
		global $woocommerce;
		
		return $order -> get_billing_first_name().', tu pedido #'.$order -> get_id().' fue completado';
	}
	
	add_filter('woocommerce_email_subject_customer_invoice', 'woocommerce_email_subject_04', 1, 2);

	function woocommerce_email_subject_04($subject, $order) {
		global $woocommerce;
		
		return 'Factura del pedido  #'.$order -> get_id();
	}
	
	add_filter('woocommerce_email_subject_customer_note', 'woocommerce_email_subject_05', 1, 2);

	function woocommerce_email_subject_05($subject, $order) {
		global $woocommerce;
		
		return 'Se ha agregado una nota a tu pedido #'.$order -> get_id();
	}
	
	add_filter('woocommerce_email_subject_low_stock', 'woocommerce_email_subject_06', 1, 2);

	function woocommerce_email_subject_06($subject, $order) {
		return 'Alerta de stock mínimo';
	}
	
	add_filter('woocommerce_email_subject_no_stock', 'woocommerce_email_subject_07', 1, 2);

	function woocommerce_email_subject_07($subject, $order) {
		return 'Alerta, producto sin stock';
	}
	
	add_filter('woocommerce_email_subject_backorder', 'woocommerce_email_subject_08', 1, 2);

	function woocommerce_email_subject_08($subject, $order) {
		return 'Solicitud de producto a pedido';
	}
	
	add_filter('woocommerce_email_subject_customer_new_account', 'woocommerce_email_subject_09', 1, 2);

	function woocommerce_email_subject_09($subject, $order) {
		return 'Se ha creado una nueva cuenta';
	}
	
	
	
	
	
	
	
	
	
	add_action('after_setup_theme', 'woocommerce_support');
	
	function woocommerce_support() {
		add_theme_support('woocommerce');
		
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');
	}
	
	add_filter('woocommerce_product_tabs', 'woocommerce_product_tabs', 98);
 
	function woocommerce_product_tabs($tabs){
		global $product;		
		
		if($product -> is_type('variable')){
			$tabs['opciones'] = array(
				'title' => 'Opciones',
				'priority' => 1,
				'callback' => 'woocommerce_add_product_tabs_variations'
			);
		}
		
		$tabs['description']['title'] = 'Descripci&oacute;n';
		$tabs['reviews']['title'] = 'Calificaciones';
		$tabs['additional_information']['title'] = 'Informaci&oacute;n adicional';
		
		
		
		if($product -> has_attributes() == false and $product -> has_dimensions() == false and  $product -> has_weight() == false){
			unset($tabs['additional_information']);   
		}
		
		if($product -> get_review_count() <= 0 or !comments_open()){
			unset($tabs['reviews']);   
		}
		
		return $tabs;
	}
	
	/*function woocommerce_add_product_tabs_variations(){
		global $is_tabs;
		$is_tabs = true;
		
		//woocommerce_template_single_add_to_cart();
		
		?>		
			<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
				<?php 
					do_action('woocommerce_before_variations_form');
					
					if(empty($available_variations) && false !== $available_variations){
						echo('<p class="stock out-of-stock">Este producto está actualmente agotado y no está disponible.</p>');
					}
					else{
						foreach($attributes as $attribute_name => $options){
							
							?>
								<tr>
									<td class="label"><label for="<?php echo(sanitize_title($attribute_name)); ?>"><?php echo(wc_attribute_label($attribute_name)); ?></label></td>
									<td class="value">
										<?php
											$selected = ((isset($_REQUEST['attribute_'.sanitize_title($attribute_name)])) ? wc_clean(stripslashes(urldecode($_REQUEST['attribute_'.sanitize_title($attribute_name)]))) : $product -> get_variation_default_attribute($attribute_name));
															
											wc_dropdown_variation_attribute_options(array('options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected));
															
											echo((end($attribute_keys) === $attribute_name) ? apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">Restablecer</a>') : '');
										?>
									</td>
								</tr>
							<?php 
						}
					}

					do_action( 'woocommerce_after_variations_form' );
				?>
			</form>			
		<?php
		
	}*/
	
	add_action('wp_enqueue_scripts', 'woocommerce_styles', 99);

	function woocommerce_styles() {
		remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));

		if(function_exists('is_woocommerce')){	
			wp_enqueue_style('woocommerce-notices', get_bloginfo('template_url').'/woocommerce/estilos/notices.css', array('estructura'), '1.0', 'all'); 	
			
			if(is_shop() or is_product_category() or is_product_taxonomy() or is_product_tag()){
				if(is_product_taxonomy()){
					//echo('is_product_taxonomy');
				}
				else if(is_product_category()){
					//echo('is_product_category');
				}
				else if(is_product_tag()){
					//echo('is_product_tag');
				}
				
				
				//echo('is_shop');
				
				wp_enqueue_style('woocommerce-archive', get_bloginfo('template_url').'/woocommerce/estilos/archive-product.css', array('estructura'), '1.0', 'all'); 	
				wp_enqueue_style('woocommerce-producto', get_bloginfo('template_url').'/woocommerce/estilos/content-product.css', array('estructura'), '1.0', 'all'); 	
				wp_enqueue_style('woocommerce-no-products-found', get_bloginfo('template_url').'/woocommerce/estilos/no-products-found.css', array('estructura'), '1.0', 'all'); 
				wp_enqueue_style('sidebar', get_bloginfo('template_url').'/estilos/sidebar.css', array('estructura'), '1.0', 'all'); 	
			}
			else if(is_product()){
				//echo('is_product');
				
				wp_enqueue_style('woocommerce-single', get_bloginfo('template_url').'/woocommerce/estilos/single-product.css', array('estructura'), '1.0', 'all'); 	
				wp_enqueue_style('woocommerce-reviews', get_bloginfo('template_url').'/woocommerce/estilos/single-product-reviews.css', array('estructura'), '1.0', 'all'); 	
				wp_enqueue_style('woocommerce-producto', get_bloginfo('template_url').'/woocommerce/estilos/content-product.css', array('estructura'), '1.0', 'all'); 	
			}
			else if(is_cart()){
				//echo('is_cart');
				
				wp_enqueue_style('woocommerce-cart', get_bloginfo('template_url').'/woocommerce/estilos/cart.css', array('estructura'), '1.0', 'all'); 
				wp_enqueue_style('woocommerce-producto', get_bloginfo('template_url').'/woocommerce/estilos/content-product.css', array('estructura'), '1.0', 'all'); 	
			}
			else if(is_checkout()){
				//echo('is_checkout');
				
				wp_enqueue_style('woocommerce-checkout', get_bloginfo('template_url').'/woocommerce/estilos/checkout.css', array('estructura'), '1.0', 'all'); 
			}
			else if(is_checkout_pay_page()){
				//echo('is_checkout_pay_page');
			}
			else if(is_account_page()){
				wp_enqueue_style('woocommerce-myaccount', get_bloginfo('template_url').'/woocommerce/estilos/myaccount/myaccount.css', array('estructura'), '1.0', 'all'); 
			
				if(is_view_order_page()){
					//echo('is_view_order_page');
				}
				else if(is_edit_account_page()){
					//echo('is_edit_account_page');
				}
				else if(is_add_payment_method_page()){
					//echo('is_add_payment_method_page');
				}
				else if(is_lost_password_page()){
					wp_enqueue_style('woocommerce-lost-password', get_bloginfo('template_url').'/woocommerce/estilos/myaccount/form-lost-password.css', array('estructura'), '1.0', 'all'); 
				}
			}
			
			else if(is_wc_endpoint_url()){
				//echo('is_wc_endpoint_url');
			}
		}
	}
	
	add_filter( 'woocommerce_account_menu_items' , 'jc_menu_panel_nav' );

	function jc_menu_panel_nav(){
		$items = array(
			'dashboard' => 'Escritorio',
			'orders' => 'Pedidos',
			'downloads' => 'Descargas',
			'edit-address' => 'Direcciones',
			'payment-methods' => 'Metodos de pago',
			'edit-account' => 'Detalles de la cuenta',
			'customer-logout' => 'Salir'
		);

		return $items;
	}
	
	add_filter( 'woocommerce_localisation_address_formats', 'uc_child_modify_vn_address_format' );
	
	function uc_child_modify_vn_address_format( $formats ) {
		$formats['AR'] = "<strong>{last_name} {first_name}</strong> {company}\n{address_1}, {city} ({postcode}), {state}, {country}\n{address_2}";
		
		return $formats;
	}
?>