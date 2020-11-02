<?php 

	function newsletter_registrar_db(){
		global $wpdb, $dbtables;

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		if($wpdb -> get_var('show tables like "'.$dbtables -> newsletter.'"') == '') {
			if(!dbDelta("
				CREATE TABLE `".$dbtables -> newsletter."` (
				  `id` int(6) NOT NULL AUTO_INCREMENT,
				  `email` varchar(200) NOT NULL,
				  `nombre` varchar(200) NOT NULL,
				  `lista` varchar(200) NOT NULL,
				  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `estado` enum('activo','pendiente','desuscripto') NOT NULL DEFAULT 'pendiente',
				  PRIMARY KEY (`id`)
				);
			")){return false;}
		}
		
		return true;
	}
	
	function newsletter_suscribir($email, $nombre, $lista = 'defecto'){
		if(newsletter_registrar($email, $nombre, $lista)){
			$notificar = false;			
			
			if(newsletter_comprobar($email, $lista)){
				$notificar = true;
			}
			else{
				global $wpdb, $dbtables;	
				
				$suscripcion = $wpdb -> get_row('SELECT * FROM '.$dbtables -> newsletter.' WHERE `email` = "'.trim(strtolower($email)).'" AND `lista` = "'.$lista.'"');
				
				if(!empty($suscripcion)){
					if($suscripcion -> estado == 'pendiente'){
						$notificar = true;
					}
					else if($suscripcion -> estado == 'desuscripto'){
						if($wpdb -> query('UPDATE '.$dbtables -> newsletter.' SET `estado` = "pendiente" WHERE `id` = "'.$suscripcion -> id.'";')){
							$notificar = true;
						}
					}
				}
			}
			
			if($notificar){
				return newsletter_notificar($email, $nombre);
			}
		}
		
		return false;
	}
	
	function newsletter_notificar($email, $nombre){
		$asunto = 'Confirma tu suscripción';
		$link = get_bloginfo('url').'?suscripcion='.base64_encode($email).'#!newsletter-confirmar';
		$cuerpo = '<p>'.$nombre.' muchas gracias por suscribirte al bolet&iacute;n, solo resta un &uacute;ltimo paso. Te pedimos que confirmes tu solicitud haciendo click en el siguiente enlace:</p><p><a href="'.$link.'">'.$link.'</a></p>';
				
		if(wp_mail($email, $asunto, $cuerpo, MAIL_ENCABEZADO)){
			return true;
		}
			
		return false;
	}
	
	function newsletter_registrar($email, $nombre, $lista){
		global $wpdb, $dbtables;		
		
		if($wpdb -> query('INSERT INTO `'.$dbtables -> newsletter.'` (`email`, `nombre`, `lista`) VALUES ("'.trim(strtolower($email)).'", "'.ucfirst(strtolower($nombre)).'", "'.$lista.'")')){
			return true;
		}

		return false;	
	}
	
	function newsletter_comprobar($email, $lista){
		global $wpdb, $dbtables;
		
		$comprobar = $wpdb -> get_results('SELECT * FROM '.$dbtables -> newsletter.' WHERE `email` = "'.trim(strtolower($email)).'" AND `lista` = "'.$lista.'" AND `estado` != "activo"');
		
		if(empty($comprobar)){
			return true;
		}
		
		return false;
	}
	
	function newsletter_confirmar($email){
		global $wpdb, $dbtables;			
		
		if($wpdb -> query('UPDATE '.$dbtables -> newsletter.' SET `estado` = "activo" WHERE `email` = "'.trim(strtolower($email)).'";')){
			return true;
		}
		
		return false;
	}
	
	function newsletter_desuscribir($email){
		global $wpdb, $dbtables;		
		
		if($wpdb -> query('UPDATE '.$dbtables -> newsletter.' SET `estado` = "desuscripto" WHERE `email` = "'.trim(strtolower($email)).'";')){
			return true;
		}
		
		return false;
	}
	
	function newsletter_eliminar($id){
		global $wpdb, $dbtables;		
		
		if($wpdb -> query('DELETE FROM `'.$dbtables -> newsletter.'` WHERE `id` = '.$id)){			
			return true;
		}
		
		return false;
	}
	
	function newsletter_listar($paginar = 10, $pagina = null){
		global $wpdb, $dbtables;	

		if(is_null($pagina) or empty($pagina)){
			$pagina = 1;
		}

		$registros = $wpdb -> get_results('SELECT * FROM '.$dbtables -> newsletter.' LIMIT '.($paginar * ($pagina - 1)).' , '.$paginar);
		$cantidad_registros = $wpdb -> get_var('SELECT COUNT(*) FROM '.$dbtables -> newsletter);
		
		if($registros){
			return (object) array('registros' => $registros, 'cantidad_registros' => $cantidad_registros);
		}
		
		return false;
	}
	
	# PETICIONES AJAX

	add_action('wp_ajax_newsletter_eliminar', 'ajax_newsletter_eliminar');

	function ajax_newsletter_eliminar(){
		if(newsletter_eliminar($_REQUEST['id'])){
			$retorno = array('estado' => 'exito', 'mensaje' => 'El registro se elimino correctamente.');
		}
		else{
			$retorno = array('estado' => 'error', 'mensaje' => 'No fue posible eliminar el registro. Por favor, Intente nuevamente y si el problema persiste comunique este error a un administrador del sistema.');
		}
			
		die(json_encode($retorno));
	}
	
	add_action('wp_ajax_nopriv_newsletter_suscribir', 'ajax_newsletter_suscribir');
	add_action('wp_ajax_newsletter_suscribir', 'ajax_newsletter_suscribir');

	function ajax_newsletter_suscribir(){
		if(!empty($_REQUEST['email'])){
			if(is_email($_REQUEST['email'])){
				if(newsletter_comprobar($_REQUEST['email'], 'defecto')){
					if(newsletter_suscribir($_REQUEST['email'], $_REQUEST['nombre'])){
						$retorno = array('estado' => 'exito', 'mensaje' => 'Gracias por suscribirte a nuestro bolet&iacute;n. Te hemos enviado un correo para que confirmes tu suscripci&oacute;n.');
					}
					else{
						$retorno = array('estado' => 'error', 'mensaje' => 'No fue posible procesar tu suscripci&oacute;n, intenta nuevamente mas tarde. Te pedimos despulpas por las molestias, estamos trabajando para solucionar le inconveniente.');
					}
				}
				else{
					if(newsletter_notificar($_REQUEST['email'], $_REQUEST['nombre'])){
						$retorno = array('estado' => 'exito', 'mensaje' => 'Te enviamos nuevamente el correo para que confirmes tu suscripción.');
					}
					else{
						$retorno = array('estado' => 'error', 'mensaje' => 'No pudimos enviarte el correo para que confirmes tu suscripción, intenta nuevamente más tarde. Te pedimos despulpas por las molestias, estamos trabajando para solucionar le inconveniente.');
					}
				}
			}
			else{
				$retorno = array('estado' => 'alerta', 'mensaje' => 'La direcci&oacute;n de correo que ingresaste es inv&aacute;lida.');
			}
		}
		else{
			$retorno = array('estado' => 'alerta', 'mensaje' => 'Es necesario ingresar una direcci&oacute;n de correo para suscribirte al bolet&iacute;n.');
		}
			
		die(json_encode($retorno));
	}
	
	add_action('wp_ajax_nopriv_newsletter_confirmar', 'ajax_newsletter_confirmar');
	add_action('wp_ajax_newsletter_confirmar', 'ajax_newsletter_confirmar');
	
	function ajax_newsletter_confirmar(){
		$email = base64_decode($_REQUEST['suscripcion']);
		
		if(newsletter_confirmar($email)){
			$retorno = array('estado' => 'exito', 'mensaje' => 'Tu suscripci&oacute;n fue confirmada con &eacute;xito. Gracias por suscribirte a nuestro bolet&iacute;n de noticias.');
		}
		else{
			$retorno = array('estado' => 'error', 'mensaje' => 'No fue posible confirmar tu suscripci&oacute;n, intenta nuevamente mas tarde. Te pedimos despulpas por las molestias, estamos trabajando para solucionar le inconveniente.');
		}
		
		die(json_encode($retorno));
	}
	
	add_action('wp_ajax_nopriv_newsletter_desuscribir', 'ajax_newsletter_desuscribir');
	add_action('wp_ajax_newsletter_desuscribir', 'ajax_newsletter_desuscribir');
	
	function ajax_newsletter_desuscribir(){
		$email = base64_decode($_REQUEST['suscripcion']);
		
		if(newsletter_desuscribir($email)){
			$retorno = array('estado' => 'exito', 'mensaje' => 'Tu suscripci&oacute;n fue eliminada con &eacute;xito.');
		}
		else{
			$retorno = array('estado' => 'error', 'mensaje' => 'No fue posible eliminar tu suscripci&oacute;n, intenta nuevamente mas tarde. Te pedimos despulpas por las molestias, estamos trabajando para solucionar le inconveniente.');
		}
			
		die(json_encode($retorno));
	}
?>