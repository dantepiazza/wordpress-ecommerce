<?php 
	
	include('funciones/users.php');
	include('interfase/users.php');
	
	//Utilize esta linea por primera vez para dar permiso a los administradores de editar roles
	//users_role('administrator', 'Administrator', array_keys(users_layers()));
	//users_add_layers();

	function users_registrar_menu(){ 	
		global $wpdb;
		
		add_users_page('Roles', 'Roles', 'level_10', 'roles', 'users_interfase');
	}
	
	function users_registrar_scripts($area){	 	
		if($area == 'users_page_roles'){	
			//wp_enqueue_style('thickbox');
			//wp_enqueue_script('thickbox');
			
			wp_enqueue_script('users', SISTEMA_URL.'/modulos/users/javascript/users.js', array('jquery'));
			wp_enqueue_style('users', SISTEMA_URL.'/modulos/users/estilos/users.css');			
		}
	}
	
	if(current_user_can('roles_users')){
		add_action('admin_menu', 'users_registrar_menu');
		add_action('admin_enqueue_scripts', 'users_registrar_scripts');		
	}
	
?>