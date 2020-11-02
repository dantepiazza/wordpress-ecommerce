<?php
	
	global $dbtables;
	
	function newsletter_capas($capas){
		$nuevas = array(
			'newsletter_administrar' => 'Administrar Newsletter'
		);
		
		if(is_array($capas) and is_array($nuevas)){
			$capas = array_merge($capas, $nuevas);
		}
		
		return $capas;
	}
	
	add_filter('users-layers', 'newsletter_capas', 10, 3);
	
	add_action('wp_enqueue_scripts', 'newsletter_agregar_scripts');
	
	function newsletter_agregar_scripts(){
		wp_enqueue_style('newsletter-frontend', get_bloginfo('template_url').'/modulos/newsletter/estilos/newsletter-frontend.css', array(), '1.0', 'all'); 
				
		wp_enqueue_script('newsletter-frontend', get_bloginfo('template_url').'/modulos/newsletter/javascript/newsletter-frontend.js', array('base'), '1.0');
	}
	
	include('funciones/newsletter.php');
	include('interfase/newsletter.php');
	
	@$dbtables -> {'newsletter'} = $wpdb -> base_prefix . 'newsletter';
	
	if(current_user_can('newsletter_administrar')){
			
		$user = wp_get_current_user();		
		
		function newsletter_registrar_menu(){ 	
			global $wpdb;
			
			if(newsletter_registrar_db()){
				add_menu_page('Newsletter', 'Newsletter', 'level_0', 'newsletter', 'newsletter_interfase_listado', 'dashicons-email-alt', 120);	
				add_submenu_page(basename(__FILE__), 'Newsletter', 'Newsletter', 'level_0', 'newsletter', 'newsletter_interfase_listado');					
			}
		}
		

		function newsletter_registrar_scripts($area){	 	
			if($area == 'toplevel_page_newsletter'){	
				wp_enqueue_style('thickbox');
				wp_enqueue_script('thickbox');
				
				wp_enqueue_script('newsletter', SISTEMA_URL.'/modulos/newsletter/javascript/newsletter.js', array('jquery'));
				wp_enqueue_style('newsletter', SISTEMA_URL.'/modulos/newsletter/estilos/newsletter.css');			
			}
		}
		
		add_action('admin_menu', 'newsletter_registrar_menu');
		add_action('admin_enqueue_scripts', 'newsletter_registrar_scripts');
	}
	
?>