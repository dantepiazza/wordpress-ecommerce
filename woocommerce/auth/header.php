<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.4.0
	
	if(!defined('ABSPATH')){ exit; }
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="noindex, nofollow" />
		<title>Solicitud de autenticación</title>
		
		<?php wp_admin_css('install', true); ?>
		
		<link rel="stylesheet" href="<?php echo esc_url(str_replace(array( 'http:', 'https:'), '', WC() -> plugin_url()).'/assets/css/auth.css' ); ?>" type="text/css" />
	</head>
	
	<body class="wc-auth wp-core-ui">
		<h1 id="wc-logo"><img src="<?php echo WC() -> plugin_url(); ?>/assets/images/woocommerce_logo.png" alt="WooCommerce" /></h1>
	
		<div class="wc-auth-content">