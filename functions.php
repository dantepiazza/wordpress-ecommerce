<?php 
	ob_start();
	define('SISTEMA_DIR', get_template_directory());
	define('SISTEMA_URL', get_template_directory_uri());
	define('MAIL_DIR', 'dante.7h@gmail.com');
	define('IFRAME_MODE', false);
	define('IFRAME_MODE_HOST', 'clousis.net');
	define('IFRAME_MODE_SERVERHOST', '');
		
	require_once('modulos/base/index.php');
	require_once('modulos/contacto/index.php');
	require_once('modulos/newsletter/index.php');
	require_once('modulos/users/index.php');
	
	require_once('woocommerce/functions.php');
	
	add_image_size('productos', 450, 585, true);
	add_image_size('proporcional', 500, 500, true);
	add_image_size('horizontal', 1024, 600, true);	
	register_nav_menu('menu-principal', 'Menu principal');
	register_nav_menu('menu-servicio', 'Menu servicio al cliente');
	register_nav_menu('menu-institucional', 'Menu institucional');
	register_nav_menu('menu-cuenta', 'Menu cuenta');
	
	add_theme_support('post-thumbnails');
	add_filter('wp_mail_from', function($content_type){ return 'dante.7h@gmail.com'; });
	add_filter('wp_mail_from_name', function($content_type){ return get_bloginfo('name'); });
	add_filter('wp_mail', 'wp_mail_filter');
	add_filter('the_title', 'the_title_bbcode', 10, 2);
	add_filter('clean_url', 'wp_async_scripts', 11, 1);
	
?>