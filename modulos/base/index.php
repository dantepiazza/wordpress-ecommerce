<?php 
	
	require_once('funciones/base.php');
	require_once('funciones/iframe.php');
	
	add_action('wp_enqueue_scripts', 'base_registrar_scripts');
	add_action('admin_enqueue_scripts', 'base_registrar_scripts');
	
	function base_registrar_scripts(){
		if(!is_admin()){
			wp_enqueue_script('base', get_bloginfo('template_url').'/modulos/base/javascript/base.js', array('jquery'), '1.0');
			wp_enqueue_script('fancybox', get_bloginfo('template_url').'/modulos/base/javascript/fancybox.js', array('jquery'), '1.0');
			
			wp_enqueue_style('base', get_bloginfo('template_url').'/modulos/base/estilos/base.css', array(), '1.0', 'all'); 
			wp_enqueue_style('ui-loader', get_bloginfo('template_url').'/modulos/base/estilos/ui-loader.css', array(), '1.0', 'all'); 
			wp_enqueue_style('ui-notify-icon', get_bloginfo('template_url').'/modulos/base/estilos/ui-notify-icon.css', array(), '1.0', 'all'); 
			
			wp_enqueue_style('fancybox', get_bloginfo('template_url').'/modulos/base/estilos/fancybox.css', array(), '1.0', 'all'); 
		}
		
		wp_enqueue_style('fontawesome', get_bloginfo('template_url').'/modulos/base/estilos/fontawesome.css', array(), '1.0', 'all'); 
	
		wp_localize_script('jquery', 'WPURLS', array('siteurl' => get_option('siteurl'), 'ajaxurl' => admin_url('admin-ajax.php')));
	}
	
	function wpse_190346_internal_pingbacks(&$links){ // Disable internal pingbacks
		foreach($links as $l => $link){
			if(strpos($link, get_option('home')) === 0){
				unset($links[$l]);
			}
		}
	}

	add_action('pre_ping', 'wpse_190346_internal_pingbacks');

	function wpse_190346_x_pingback($headers){ // Disable x-pingback
		unset($headers['X-Pingback']);
	   
		return $headers;
	}

	add_filter('wp_headers', 'wpse_190346_x_pingback');

	function wpse_190346_pingback_url($output, $show = null){ // Remove pingback URLs
		if($show == 'pingback_url'){
			$output = '';
		}
		
		return $output;
	}

	add_filter('bloginfo_url', 'wpse_190346_pingback_url');
	add_filter('bloginfo', 'wpse_190346_pingback_url');
	add_filter('xmlrpc_enabled', '__return_false' );

	function wpse_190346_xmlrpc_methods($methods){ // Disable XML-RPC methods
		unset($methods['pingback.ping']);
		
		return $methods;
	}

	add_filter('xmlrpc_methods', 'wpse_190346_xmlrpc_methods');
		
	function myprefix_unregister_tags(){
		unregister_taxonomy_for_object_type('post_tag', 'post');
	}

	add_action('init', 'myprefix_unregister_tags');
	
?>