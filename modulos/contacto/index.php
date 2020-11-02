<?php 
	
	function meta_contacto_registrar_scripts($area){	 	
		$pantalla = get_current_screen();
		
		if($pantalla -> id == 'page'){		
			wp_enqueue_script('meta-contacto', get_template_directory_uri().'/modulos/contacto/javascript/contacto.js', array('jquery'));     
		}		
	}
	
	add_action('admin_enqueue_scripts', 'meta_contacto_registrar_scripts');
	
	function meta_contacto_agregar(){
		add_meta_box('meta-contacto-informacion', 'Información de contacto', 'meta_contacto_informacion', 'page', 'normal', 'high');
		add_meta_box('meta-opciones-mapa', 'Enlace Google Maps', 'meta_contacto_mapa', 'page', 'normal', 'high');
	}
	
	add_action('add_meta_boxes', 'meta_contacto_agregar');
	
	function meta_contacto_informacion($post){
		$metadata = get_post_custom($post -> ID);

		wp_nonce_field('meta-page-contacto', 'meta-page-contacto-nonce');
		
		echo('<p><label for="contacto-direccion"><strong>Dirección</strong></label></p>');			
		echo('<input type="text" id="contacto-direccion" name="meta-contacto-direccion" value="'.((!empty($metadata['_contacto_direccion'][0])) ? $metadata['_contacto_direccion'][0] : '').'" style="width:100%;">');
		
		echo('<p><label for="contacto-email"><strong>Correo electrónico</strong></label></p>');			
		echo('<input type="text" id="contacto-email" name="meta-contacto-email" value="'.((!empty($metadata['_contacto_email'][0])) ? $metadata['_contacto_email'][0] : '').'" style="width:100%;">');
		
		echo('<p><label for="contacto-telefono"><strong>Teléfono</strong></label></p>');			
		echo('<input type="text" id="contacto-telefono" name="meta-contacto-telefono" value="'.((!empty($metadata['_contacto_telefono'][0])) ? $metadata['_contacto_telefono'][0] : '').'" style="width:100%;">');
		
		echo('<p><label for="contacto-whatsapp"><strong>Whatsapp</strong></label></p>');			
		echo('<input type="text" id="contacto-whatsapp" name="meta-contacto-whatsapp" value="'.((!empty($metadata['_contacto_whatsapp'][0])) ? $metadata['_contacto_whatsapp'][0] : '').'" style="width:100%;">');
		
		echo('<p><label for="contacto-facebook"><strong>Facebook</strong></label></p>');			
		echo('<input type="text" id="contacto-facebook" name="meta-contacto-facebook" value="'.((!empty($metadata['_contacto_facebook'][0])) ? $metadata['_contacto_facebook'][0] : '').'" style="width:100%;">');
		
		echo('<p><label for="contacto-instagram"><strong>Instagram</strong></label></p>');			
		echo('<input type="text" id="contacto-instagram" name="meta-contacto-instagram" value="'.((!empty($metadata['_contacto_instagram'][0])) ? $metadata['_contacto_instagram'][0] : '').'" style="width:100%;">');
	}
	
	function meta_contacto_mapa($post){
		$metadata = get_post_custom($post -> ID);
		
		echo('<input type="text"  name="meta-contacto-mapa" style="width:100%;" value="'.((empty($metadata['_contacto_mapa'][0])) ? '' : $metadata['_contacto_mapa'][0]).'">');
	}
		
	function meta_contacto_guardar($post){
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		
		if(!isset($_POST['meta-page-contacto-nonce']) || !wp_verify_nonce($_POST['meta-page-contacto-nonce'], 'meta-page-contacto')) return;
		
		if(!current_user_can('edit_post')) return;
		
		update_post_meta($post, '_contacto_direccion', $_POST['meta-contacto-direccion']);
		update_post_meta($post, '_contacto_email', $_POST['meta-contacto-email']);		
		update_post_meta($post, '_contacto_telefono', $_POST['meta-contacto-telefono']);
		update_post_meta($post, '_contacto_whatsapp', $_POST['meta-contacto-whatsapp']);
		update_post_meta($post, '_contacto_facebook', $_POST['meta-contacto-facebook']);
		update_post_meta($post, '_contacto_instagram', $_POST['meta-contacto-instagram']);
		update_post_meta($post, '_contacto_mapa', $_POST['meta-contacto-mapa']);		
	}

	add_action('save_post', 'meta_contacto_guardar');
	
?>