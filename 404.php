<?php 
	wp_enqueue_style('404', get_bloginfo('template_url').'/estilos/404.css', array('estructura'), '1.0', 'all'); 	
	
	get_header();
?>
	
	<div class="error">
		<div class="error-contenido">
			<div class="contenedor">
				<span class="fa fa-unlink"></span>
				<h1>No encontramos lo que buscabas</h1>
				<h5>Lo que estas buscando ya no existe o puede que no est&eacute; disponible en este momento.</h5>
			</div>
		</div>
		
		<div class="error-formulario">
			<div class="contenedor">
				<div class="formulario">
					<form action="<?php bloginfo('home'); ?>" method="get">
						<input type="text" class="campo" placeholder="Buscar en todo el sitio web" name="s">
						<input type="submit" class="boton" value="Buscar">
					</form>
				</div>
			</div>
		</div>	
	</div>

<?php get_footer(); ?>

