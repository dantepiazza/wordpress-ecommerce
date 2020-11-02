<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="resource-type" content="document">
        <meta name="revisit-after" content="7 days">
        <meta name="robots" content="ALL">
        <meta name="distribution" content="Global">
        <meta name="rating" content="General">
        <meta name="language" content="<?php language_attributes(); ?>">
		<meta name="copyright" content="&copy; <?php bloginfo('name'); ?>">
        <meta name="doc-type" content="Public">
        <meta name="doc-class" content="Completed">
		<meta name="doc-rights" content="<?php bloginfo('name'); ?>">
        <meta name="doc-publisher" content="<?php bloginfo('name'); ?>">
		<meta name="author" content="<?php bloginfo('name'); ?>" />
		
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
		
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/imagenes/favicon.ico" type="image/x-icon" />
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

		<?php 
			wp_enqueue_style('estructura', get_bloginfo('stylesheet_url'), array(), '1.0', 'all'); 
			wp_enqueue_style('ui-kit',  get_bloginfo('template_url').'/estilos/ui-kit/ui-kit.css', array('estructura'), '1.0', 'all'); 
			wp_enqueue_style('widget-procesos', get_bloginfo('template_url').'/estilos/widget-procesos.css', array('estructura'), '1.0', 'all'); 	
			wp_enqueue_style('widget-categorias', get_bloginfo('template_url').'/estilos/widget-categorias.css', array('estructura'), '1.0', 'all'); 	
			
			wp_enqueue_script('jquery');
			wp_enqueue_script('header', get_bloginfo('template_url').'/javascripts/header.js', array('jquery'), '1.0', true);
			
			if(is_singular()){
				wp_enqueue_script('comment-reply');
			}
			
			global $current_user;
		?>
		
		<title>
			<?php 		
				global $page, $paged;

				wp_title('&raquo;', true, 'right'); bloginfo('name');
		
				if(is_home() || is_front_page()){
					echo ' &raquo; '. get_bloginfo('description', 'display');
				}		
			?>
		</title>	
		
		<?php wp_head(); ?>
	</head>
	
	<body>
		<div class="encabezado">
			<div class="encabezado-superior">
				<div class="contenedor">
					<div class="encabezado-logo">
						<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?> <?php bloginfo('description'); ?>"><img src="<?php bloginfo('template_directory'); ?>/imagenes/logo.png" alt="Logo <?php bloginfo('name'); ?>"></a>
					</div>
					
					<div class="encabezado-buscador">
						<form role="search" method="get" action="<?php echo(esc_url(home_url('/'))); ?>" id="ui-search-form">
							<input type="hidden" name="post_type" value="product" />
							<input type="search" class="campo" name="s" placeholder="Buscar productos" value="<?php echo(get_search_query()); ?>" autocomplete="off" />
							<a class="boton" id="ui-search-button"><i class="fas fa-search"></i></a>
						</form>
					</div>
					
					<div class="encabezado-navegacion">
						<ul class="encabezado-redes">
							<?php
								if($facebook = get_template_custom('plantilla-contacto.php', '_contacto_facebook')){
									echo('<li><a id="boton-facebook" href="https://www.facebook.com/'.$facebook.'" target="_blank"><span class="fab fa-facebook"></span></a></li>');
								}
									
								if($instagram = get_template_custom('plantilla-contacto.php', '_contacto_instagram')){
									echo('<li><a id="boton-instagram" href="https://www.instagram.com/'.$instagram.'" target="_blank"><span class="fab fa-instagram"></span></a></li>');
								}
							?>
						</ul>
						
						<ul class="encabezado-acciones">
							<li class="accion-menu"><a id="boton-menu"><i class="fa fa-bars"></i></a></li>						
							<li class="accion-carrito"><a id="boton-carrito" href="<?php echo((function_exists('wc_get_cart_url')) ? wc_get_cart_url() : ''); ?>" target="_blank"><span class="fa fa-shopping-cart"></span> <span class="tag"><?php echo(WC() -> cart -> get_cart_contents_count()); ?></span></a></li>
							<li class="accion-cuenta"><a href="<?php echo(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><span><?php echo(get_avatar(@$current_user -> user_email, 23)); ?> </span> Mi cuenta</a></li>
						</ul>
					</div>
					
					<div class="encabezado-menu">
						<div class="encabezado-menu-encabezado">
							<div class="encabezado-menu-navegacion">
								<a id="boton-menu"><i class="fa fa-angle-left"></i></a>
							</div>
							
							<div class="encabezado-menu-cuenta">
								<div class="cuenta-avatar"><?php echo(get_avatar(@$current_user -> user_email, 60)); ?></div>
								<div class="cuenta-detalle">
									<strong>Dante Piazza Quiroga</strong>
									dante.7h@gmail.com
								</div>
							</div>
						</div>
							
						<div class="encabezado-menu-lista">
							<div class="encabezado-menu-cuenta">
								<?php wp_nav_menu(array('theme_location' => 'menu-cuenta', 'menu_class' => '', 'container' => false)); ?>
							</div>
							
							<div class="encabezado-menu-principal">
								<?php wp_nav_menu(array('theme_location' => 'menu-principal', 'menu_class' => '', 'container' => false)); ?>
							</div>
							
							<div class="encabezado-menu-servicio">
								<h6>Servicio al cliente</h6>
								<?php wp_nav_menu(array('theme_location' => 'menu-servicio', 'menu_class' => '', 'container' => false)); ?>
							</div>
								
							<div class="encabezado-menu-institucional">						
								<h6>Institucional</h6>
								<?php wp_nav_menu(array('theme_location' => 'menu-institucional', 'menu_class' => '', 'container' => false)); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="encabezado-inferior">
				<div class="contenedor">
					<?php wp_nav_menu(array('theme_location' => 'menu-principal', 'menu_class' => '', 'container' => false)); ?>
				</div>
			</div>
		</div>