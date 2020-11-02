<?php

	add_filter('init', function($output) {
		if(function_exists('iframe_mode_frontend_targets')){
			ob_start('iframe_mode_frontend_targets');
		}
	});	
	
	add_action('init', function(){
		if(iframe_mode_detect()){
			if(session_status() == PHP_SESSION_NONE){
				session_start();
			}
			
			if(!isset($_SESSION['IFRAME_USER'])){
				$_SESSION['IFRAME_USER'] = '';	
			}			
			
			if(isset($_GET['iframe-session'])){
				$_SESSION['IFRAME_SESSION'] = unserialize(base64_decode(urldecode($_GET['iframe-session'])));
				$_SESSION['IFRAME_USER'] = $_SESSION['IFRAME_SESSION']['usuario'];
			}
			
			iframe_mode_logged($_SESSION['IFRAME_USER']);
		}
	});

	function iframe_mode_logged($usuario){ 		
		$login = true;
		
		if(is_user_logged_in()){ 
			if(isset($_COOKIE['IFRAME_LOGIN'])){
				if($_COOKIE['IFRAME_LOGIN'] === md5($_SESSION['IFRAME_USER'])){	
					$login = false;
					
					if($GLOBALS['pagenow'] === 'wp-login.php'){	
						wp_redirect(admin_url());
						
						exit();
					}
				}
				else{
					wp_logout();
				}				
			}
			else{
				wp_logout();
			}
		}
		
		if($login){
			if(iframe_mode_autologin($_SESSION['IFRAME_USER'])){
				wp_redirect(admin_url());
				
				exit();
			}
			else{
				die('
					<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
						
					<style>
						.error{
							font-family:"Roboto";
							padding: 15% 25%;
							position: relative;
							text-align: center;
						}
						.error .error-icono{
							color: #ebebeb;
							font-size: 150px;
							margin-bottom: 20px
						}
						.error h1{
							color: #ababab;
							font-size: 25px;
							font-weight: normal;
							margin-bottom: 10px;
						}
						.error h3{
							color: #ababab;
							font-size: 15px;
							font-weight: normal;
						}
						
						@media screen and (max-width: 768px) {
							.error{
								padding: 15% 0%;
							}
							.error .error-icono{
								font-size: 100px;
							}
						}
					</style>
					
					<div class="error">
						<h1>No es posible ingresar al panel</h1>
						<h3>Los datos de su sesión de usuario no son válidos para ingresar al panel. Notifique este error al área de soporte técnico.</h3>
					</div>
				');
			}
		}
	}
	
	function iframe_mode_autologin($usuario = null){ 		
		if(is_user_logged_in()){ 
			return true;
		}
		else{		
			$email = $nombre = $apellido = $registro = null;			
			
			if(isset($_SESSION['IFRAME_SESSION'])){				
				$usuario = $_SESSION['IFRAME_SESSION']['usuario'];
				$email = $_SESSION['IFRAME_SESSION']['email'];
				$nombre = $_SESSION['IFRAME_SESSION']['nombre'];
				$apellido = $_SESSION['IFRAME_SESSION']['apellido'];
				$registro = true;
				
				unset($_SESSION['IFRAME_SESSION']);
			}
			
			if($usuario_id = get_user_by('login', $usuario)){
				setcookie('IFRAME_LOGIN', md5($usuario));
				
				wp_set_auth_cookie($usuario_id -> ID, true);
				
				return true;
			}
			else{
				if($registro){
					if(users_registro($nombre, $apellido, $usuario, $email, '', null, 'editor', false)){
						return iframe_mode_autologin($usuario);
					}
				}
			}
		}
		
		return false;
	}
	
	function iframe_mode_detect($logica = true){
		if(IFRAME_MODE === true){
			if(session_status() == PHP_SESSION_NONE){
				session_start();
			}
			
			if(!isset($_SESSION['IFRAME_HOST'])){
				$host = parse_url($_SERVER['HTTP_HOST']);
				
				if(isset($_SERVER['HTTP_REFERER']) and !empty($_SERVER['HTTP_REFERER'])){
					$iframe = parse_url($_SERVER['HTTP_REFERER']);	
					
					$host_parts = explode('.', $iframe['host']);
					
					if(count($host_parts) >= 2){
						$iframe['host'] = $host_parts[count($host_parts) - 2].'.'.$host_parts[count($host_parts) - 1];
					}
					
					$host = $iframe['host'];
				}
				
				if($host === IFRAME_MODE_HOST){
					$_SESSION['IFRAME_HOST'] = $host;
				}
			}			
			
			if($logica === true){
				//Cuando se llama la funcion para validar sentencias
				
				//Si se esta cargando desde un iframe desde el server
				if(isset($_SESSION['IFRAME_HOST']) and $_SESSION['IFRAME_HOST'] === IFRAME_MODE_HOST){
					//LOGICA: Desde el iframe de Clousis
					
					return true;				
				}
				else{
					//LOGICA: Desde frontend
				}
			}
			else{
				//Cuando se llama la funcion para procesar datos
				
				//Si no se esta cargando desde un iframe desde el server
				if(!isset($_SESSION['IFRAME_HOST']) or empty($_SESSION['IFRAME_HOST']) or $_SESSION['IFRAME_HOST'] !== IFRAME_MODE_HOST){
					//LOGICA: Desde frontend
					
					return true;
				}
				else{				
					//LOGICA: Desde el iframe de Clousis					
				}				
			}
		}
		
		return false;
	}
	
	function iframe_mode_backend_redirect(){
		if(IFRAME_MODE === true){
			remove_action('admin_init', 'send_frame_options_header', 10, 0);
			remove_action('login_init', 'send_frame_options_header', 10, 0);
		}
		
		if(iframe_mode_detect(false)){
			if(is_wplogin() or is_admin()){
				die('SE REDIRECCIONA');
				wp_redirect(home_url());
			}
		}
	}
	
	add_filter('init', 'iframe_mode_backend_redirect');	
	
	function iframe_mode_frontend_targets($output){
		if(iframe_mode_detect()){ 
			$current = ((is_admin()) ? admin_url() : home_url() );
			$frontend = home_url();
			$backend = admin_url();

			$enlaces = explode('<a', $output);
					
			for($index = 1; $index < count($enlaces); $index++) {
				// Break apart on '>' to isolate anchor attributes
				$enlace = explode('>', $enlaces[$index]);
				
				if(is_admin()){
					//Add URL to relative links
					$enlace[0] = preg_replace("/((?:href|src) *= *[\"'](?!(http|ftp)))/i", "$1{$current}", $enlace[0]);
					// Remove all target="_blank"
					$enlace[0] = preg_replace("#\\s*target\\s*=\\s*[\"'].*?['\"]\\s*#", ' ', $enlace[0]);
					// Add target="_blank" to all
					$enlace[0] = preg_replace('#href\s*=\s*#', 'target="_blank" href=', $enlace[0]);
					// Remove target="_blank" from only this domain
					$enlace[0] = preg_replace("#target=\"_blank\" href=(['\"]){$backend}#", "href=\\1{$backend}", $enlace[0]);
					// End this part by reassembling on the '>'
				}
				else{
					preg_match_all('/href=([\'"])(?<href>.+?)\1[^>]*/i', $enlace[0], $url);
					
					if(!empty($url['href'][0])){
						if(strpos($url['href'][0], $backend) !== false){
							$panel = 'http://'.IFRAME_MODE_SERVERHOST.'.'.IFRAME_MODE_HOST.'/?modulo=sitios-panel&sitio='.urlencode($url['href'][0]);
							
							$enlace[0] = str_replace($url['href'][0], $panel, $enlace[0]);
						}
					}
				}
				
				$enlaces[$index] = implode('>', $enlace);
			}
				 
			// Finally reassembling it all on the '<a' leaving a space for good measure
			$output = implode('<a ', $enlaces);
		}
		
		return $output;		
	}
	
	add_filter('final_output', 'iframe_mode_frontend_targets');	
	
	function iframe_mode_bar_render(){
		if(IFRAME_MODE === true){
			global $wp_admin_bar;

			$wp_admin_bar -> remove_menu('my-account');
			$wp_admin_bar -> remove_menu('my-account-with-avatar');
			$wp_admin_bar -> remove_node('customize');
		}		
	}

	add_action('wp_before_admin_bar_render', 'iframe_mode_bar_render');
	
	function iframe_mode_access_profile() {
		if(defined('IS_PROFILE_PAGE') and IS_PROFILE_PAGE === true) {
			die('<script>window.top.location.replace("http://'.IFRAME_MODE_SERVERHOST.'.'.IFRAME_MODE_HOST.'/?modulo=usuarios-cuenta");</script>');
		}
	
		remove_menu_page('profile.php');
		remove_submenu_page('users.php', 'profile.php');
	}
	
	add_action('admin_init', 'iframe_mode_access_profile');	
	
	function iframe_mode_configuration($output){
		$partes = parse_url(home_url());
				
		return rest_ensure_response(array(
			'nombre' => get_bloginfo('name'),
			'url' => home_url(),
			'host' => $partes['host']
		));
	}
	
	function iframe_mode_endpoint() {
		register_rest_route('clousis/v1', '/sitios/', array(
			'methods'  => WP_REST_Server::READABLE,
			'callback' => 'iframe_mode_configuration',
			'permission_callback' => function () {
				return true;
			}
		));
	}
 
	add_action('rest_api_init', 'iframe_mode_endpoint');	
	
	function is_wplogin(){
		$ABSPATH_MY = str_replace(array('\\','/'), DIRECTORY_SEPARATOR, ABSPATH);
		
		return ((in_array($ABSPATH_MY.'wp-login.php', get_included_files()) || in_array($ABSPATH_MY.'wp-register.php', get_included_files()) ) || $GLOBALS['pagenow'] === 'wp-login.php' || $_SERVER['PHP_SELF']== '/wp-login.php');
	}
	
?>