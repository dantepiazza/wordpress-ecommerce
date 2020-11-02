<?php	

	function is_user_exist($user){
		global $wpdb;

		$count = $wpdb -> get_var($wpdb -> prepare("SELECT COUNT(*) FROM ".$wpdb -> users." WHERE ID = %d", $user));

		if($count === '1'){
			return true;
		}
		
		return false;
	}
	
	function is_user_logged(){
		return is_user_logged_in();
	}
	
	function is_user_suscribe(){
		if(is_user_logged()){
			$usuario = wp_get_current_user();
			
			$suscripcion = get_user_meta($usuario -> ID, '_suscripcion_fecha', true);
			
			if(!empty($suscripcion)){
				if(is_numeric(strtotime(str_replace('/', '-', $suscripcion)))){
					if(strtotime($suscripcion) >= strtotime(date("Y-m-d H:i:s"))){
						return true;
					}
				}
			}
		}
		
		return false;
	}	
	
	function is_post_access(){
		if(is_post_type_exclusive()){
			$user = wp_get_current_user();
			
			if(
				in_array('contributor', (array) $user -> roles) or 
				in_array('author', (array) $user -> roles) or 
				in_array('editor', (array) $user -> roles) or 
				in_array('administrator', (array) $user -> roles)
			){
				return true;
			}
			else{
				if(is_user_suscribe()){
					return true;
				}
			}
			
			return false;
		}
		
		return true;
	}

	function users_email_clave_recuperar($message, $key) {
		$user_data = '';
		
		if(!isset($_POST['user_login'])){
			return '';
		}
		
		if(strpos($_POST['user_login'], '@')){
			$user_data = get_user_by('email', trim($_POST['user_login']));
		}
		else{
			$login = trim($_POST['user_login']);
			$user_data = get_user_by('login', $login);
		}

		if(!$user_data){
			return '';
		}

		return '<p>Alguien ha solicitado un reinicio de contraseña para la siguiente cuenta:</p>
		
		<p><strong>Nombre de usuario:</strong> '.$user_data -> user_login.'</p>
		
		<p>Si ha sido un error, ignorá este correo y no pasará nada. Para restaurar la contraseña, visitá la siguiente dirección: </p>
		
		<p>'.get_site_url(null, 'wp-login.php?action=rp&key='.$key.'&login='.rawurlencode($user_data -> user_login)).'</p>';
	}
	
	add_filter('retrieve_password_message', 'users_email_clave_recuperar', 10, 2);
	
	function users_email_cambio_clave($email, $user, $userdata){
		$email['subject'] = 'Aviso de cambio de contraseña';
		$email['message'] = '
			<p>Hola '.$user['first_name'].', Esta notificación confirma que tu contraseña fue cambiada en ###SITENAME###.</p>

			<p>Si no cambiaste la contraseña, por favor contactá al administrador del sitio en ###ADMIN_EMAIL###</p>

			<p>Este correo ha sido enviado a ###EMAIL###</p>
		';
		
		return $email;
	}
	
	add_filter('password_change_email', 'users_email_cambio_clave', 10, 3);
	
	function users_email_registro($email, $user) {
		$email['subject'] = 'Tu nombre de usuario y contraseña';
		$email['message'] = '
			<p>Gracias por registrarte, a continaucion te brindamos tus datos de acceso:</p>
			<p>
				<strong>Nombre de usuario:</strong> '.$user -> user_login.'<br>
				<strong>Contraseña:</strong> (Ingresada en el registro)		
			</p>
		';
		
		return $email;
	}
	
	add_filter('wp_new_user_notification_email', 'users_email_registro', 10, 3);
	
	function users_disable_dashboard() {
		if(!is_admin()){
			if(current_user_can('subscriber')) {
				wp_redirect(home_url());
				
				exit;
			}
		}
	}
	
	add_action('admin_init', 'users_disable_dashboard');
	
	function user_redirect_after_logout(){	
		wp_redirect(home_url());
		
		exit();
	}
	
	add_action('wp_logout','user_redirect_after_logout');
	
	function users_adminbar_profile_url($url) {
		if(current_user_can('subscriber')){
			return site_url('/cuenta');
		} 		
		
		return $url;
	}
	
	add_filter('edit_profile_url', 'users_adminbar_profile_url', 10, 3);
	
	function users_adminbar_render() {
		global $wp_admin_bar;
		
		$wp_admin_bar->remove_menu('wp-logo');
		
		if(current_user_can('subscriber')){
			$wp_admin_bar->remove_menu('site-name');
		}
	}

	add_action('wp_before_admin_bar_render', 'users_adminbar_render');
	
	function users_layers($capa = null){
		$capas = array(
			'switch_themes' => 'Cambiar plantillas',
			'edit_themes' => 'Editar plantillas',
			'activate_plugins' => 'Activar plugins',
			'edit_plugins' => 'Editar plugins',
			'edit_users' => 'Editar usuario wordpress',
			'edit_files' => 'Editar archivos',
			'manage_options' => 'Administrar opciones',
			'moderate_comments' => 'Moderar comentarios',
			'manage_categories' => 'Administrar categorias',
			'manage_links' => 'Administrar enlaces',
			'upload_files' => 'Subir archivos',
			'import' => 'Importar informaci&oacute;n',
			'unfiltered_html' => 'Escritura HTML sin filtro',
			'edit_posts' => 'Editar art&iacute;culos',
			'edit_others_posts' => 'Editar otros art&iacute;culos',
			'edit_published_posts' => 'Editar art&iacute;culos publicados',
			'publish_posts' => 'Publicar art&iacute;culos',
			'edit_pages' => 'Editar p&aacute;ginas',
			'read' => 'Acceso al panel',
			'edit_others_pages' => 'Editar otras p&aacute;ginas',
			'edit_published_pages' => 'Editar p&aacute;ginas publicadas',
			'publish_pages' => 'Publicar p&aacute;ginas',
			'delete_pages' => 'Eliminar p&aacute;ginas',
			'delete_others_pages' => 'Eliminar otras p&aacute;ginas',
			'delete_published_pages' => 'Eliminar p&aacute;ginas publicadas',
			'delete_posts' => 'Eliminar art&iacute;culos',
			'delete_others_posts' => 'Eliminar otros art&iacute;culos',
			'delete_published_posts' => 'Eliminar art&iacute;culos publicados',
			'delete_private_posts' => 'Eliminar art&iacute;culos privados',
			'edit_private_posts' => 'Editar art&iacute;culos privados',
			'read_private_posts' => 'Leer art&iacute;culos privados',
			'delete_private_pages' => 'Eliminar p&aacute;ginas privadas',
			'edit_private_pages' => 'Editar p&aacute;ginas privadas',
			'read_private_pages' => 'Leer p&aacute;ginas privadas',
			'delete_users' => 'Eliminar usuario wordpress',
			'create_users' => 'Crear usuarios wordpress',
			'roles_users' => 'Modificar roles de usuarios wordpress',
			'unfiltered_upload' => 'Subida de archivos sin filtro',
			'edit_dashboard' => 'Editar escritorio',
			'update_plugins' => 'Actualizar plugins',
			'delete_plugins' => 'Eliminar plugins',
			'install_plugins' => 'Instalar plugins',
			'update_themes' => 'Actualizar plantillas',
			'install_themes' => 'Instalar plantillas',
			'update_core' => 'Actualizar wordpress',
			'list_users' => 'Listado de usuarios wordpress',
			'remove_users' => 'Eliminar multiples usuarios wordpress',
			'add_users' => 'Agregar usuario wordpress',
			'promote_users' => 'Privilegio de usuarios wordpress',
			'edit_theme_options' => 'Editar opciones de plantillas',
			'delete_themes' => 'Eliminar plantillas',
			'export' => 'Exportar informaci&oacute;n',
			'level_10' => 'Usuario nivel 10',
			'level_9' => 'Usuario nivel 9',
			'level_8' => 'Usuario nivel 8',
			'level_7' => 'Usuario nivel 7',
			'level_6' => 'Usuario nivel 6',
			'level_5' => 'Usuario nivel 5',
			'level_4' => 'Usuario nivel 4',
			'level_3' => 'Usuario nivel 3',
			'level_2' => 'Usuario nivel 2',
			'level_1' => 'Usuario nivel 1',
			'level_0' => 'Usuario nivel 0',		
		);
		
		$capas = apply_filters('users-layers', $capas);
		
		if($capa == null){
			return $capas;
		}
		else{
			if(array_key_exists($capa, $capas)){
				if($capas[$capa] != '' and $capas[$capa] != 1){
					return $capas[$capa];					
				}
				else{
					return $capa;
				}
			}
			else{
				return $capa;
			}
		}
	}
	
	function users_add_layers(){
		global $wp_roles;

		$roles = $wp_roles -> roles;		
		$roles = apply_filters('editable_roles', $roles);
		
		$roles = array_keys($roles['administrator']['capabilities']);
				
		$capas = array_merge(users_layers(), $roles);
		
		users_role('administrator', 'Administrator', array_keys($capas));
	}
	
	function users_role($rol, $nombre, $permisos){
		if(get_role($rol) !== null){
			remove_role($rol);
		}		
		
		$capas['level_0'] = true;
		$capas['read'] = true;	
		
		if(is_array($permisos)){
			foreach($permisos as $permiso){
				$capas[$permiso] = true;
			}
		}
		
		if(add_role(strtolower($nombre), $nombre, $capas)){
			return array('estado' => 'exito', 'mensaje' => 'El rol fue agregado/modificado correctamente.');
		}
		
		return array('estado' => 'error', 'mensaje' => 'Se produjo un error al intentar agregar/modificar el rol.');
	}
	
	function users_comprobar_usuario($usuario){
		$existente = username_exists($usuario);
		
		if($existente){
			return true;
		}
		
		return false;
	}
	
	function users_comprobar_email($email){
		if(email_exists($email) !== false){
			return true;
		}
		
		return false;
	}
	
	function users_comprobar_clave($clave){
		return true;
	}
	
	function users_ingreso($usuario, $clave){
		$user = wp_signon(array('user_login' => $usuario, 'user_password' => $clave));
		
		if(is_wp_error($user)){
			return $user -> get_error_message();
		}
		else{
			return true;
		}
	}
	
	function users_registro($nombre, $apellido, $usuario, $email, $telefono, $clave = null, $rol = null, $notificar = true){
		if(is_null($clave)){
			$clave = wp_generate_password(10, true);
		}
		
		if(is_null($rol)){
			$rol = get_option('default_role');
		}	
		
		if(!users_comprobar_usuario($usuario) and !users_comprobar_email($email) and users_comprobar_clave($clave)){
			$userdata = array(
				'user_pass' => $clave,
				'user_login' => esc_attr($usuario),
				'first_name' => esc_attr($nombre),
				'last_name' => esc_attr($apellido),
				'user_email' => esc_attr($email),
				'role' => $rol,
			);
			
			if($nuevo = wp_insert_user($userdata)){
				add_user_meta($nuevo, 'telefono', $telefono, true);				
				
				if($notificar === true){
					wp_new_user_notification($nuevo, $clave);
				}
							
				return true;
			}
		}
		
		return false;
	}
	
	
	add_action('wp_ajax_nopriv_usuarios_ingreso', 'ajax_users_ingreso');
	add_action('wp_ajax_usuarios_ingreso', 'ajax_users_ingreso');
	
	function ajax_users_ingreso(){		
		if(!empty($_REQUEST['usuario']) and !empty($_REQUEST['clave'])){
			$mensaje = users_ingreso($_REQUEST['usuario'], $_REQUEST['clave']);
			
			if($mensaje === true){
				$retorno = array('estado' => 'exito', 'mensaje' => '.');
			}
			else{
				$retorno = array('estado' => 'error', 'mensaje' => $mensaje);
			}
		}
		else{
			$retorno = array('estado' => 'alerta', 'mensaje' => 'Es necesario ingresar tu usuario y contraseña.');
		}
			
		die(json_encode($retorno));
	}
	
	add_action('wp_ajax_nopriv_usuarios_recuperar', 'ajax_users_recuperar');
	add_action('wp_ajax_usuarios_recuperar', 'ajax_users_recuperar');
	
	function ajax_users_recuperar(){		
		if(!empty($_REQUEST['email']) and is_email($_REQUEST['email'])){
			$mensaje = users_recuperar($_REQUEST['email']);
			
			if($mensaje === true){
				$retorno = array('estado' => 'exito', 'mensaje' => 'Te hemos enviado un correo con las instrucciones para recuperar tu contraseña');
			}
			else{
				$retorno = array('estado' => 'error', 'mensaje' => $mensaje);
			}
		}
		else{
			$retorno = array('estado' => 'alerta', 'mensaje' => 'Es necesario ingresar tu dirección de correo para recuperar tu contraseña.');
		}
			
		die(json_encode($retorno));
	}
	
	add_action('wp_ajax_nopriv_usuarios_registro', 'ajax_users_registro');
	add_action('wp_ajax_usuarios_registro', 'ajax_users_registro');
	
	function ajax_users_registro(){		
		if(!empty($_REQUEST['nombre']) and !empty($_REQUEST['apellido']) and !empty($_REQUEST['usuario']) and !empty($_REQUEST['email']) and !empty($_REQUEST['clave']) and !empty($_REQUEST['clave_repetir'])){
			if($_REQUEST['clave'] === $_REQUEST['clave_repetir']){
				if(!users_comprobar_usuario($_REQUEST['usuario'])){
					if(!users_comprobar_email($_REQUEST['email'])){
						if(users_comprobar_clave($_REQUEST['clave'])){
							if(users_registro($_REQUEST['nombre'], $_REQUEST['apellido'], $_REQUEST['usuario'], $_REQUEST['email'], $_REQUEST['telefono'], $_REQUEST['clave'])){
								$retorno = array('estado' => 'exito', 'mensaje' => 'Gracias por crear tu cuenta, te enviamos un correo con los datos de tu cuenta.');
							}
							else{
								$retorno = array('estado' => 'error', 'mensaje' => 'No es posible crear tu cuenta en este momento, intenta nuevamente mas tarde. Te pedimos despulpas por las molestias, estamos trabajando para solucionar le inconveniente.');
							}
						}
						else{
							$retorno = array('estado' => 'alerta', 'mensaje' => 'La contraseña que ingresaste es insegura. Asegurate que tenga más de 8 caracteres e intenta reforzar la seguridad combinando números, letras y símbolos.');
						}
					}
					else{
						$retorno = array('estado' => 'alerta', 'mensaje' => 'La dirección de correo que intentas utilizar ya se encuentra en uso.');
					}
				}
				else{
					$retorno = array('estado' => 'alerta', 'mensaje' => 'El usuario que intentas utilizar ya se encuentra en uso.');
				}
			}
			else{
				$retorno = array('estado' => 'alerta', 'mensaje' => 'Las contraseñas que ingresaste no coinciden.');
			}
		}
		else{
			$retorno = array('estado' => 'alerta', 'mensaje' => 'Es necesario que completes todos los datos.');
		}
			
		die(json_encode($retorno));
	}
	
?>