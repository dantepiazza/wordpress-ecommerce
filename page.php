<?php
	wp_enqueue_style('page', get_bloginfo('template_url').'/estilos/page.css', array('estructura'), '1.0', 'all'); 	
	
	get_header();
	
	if (have_posts()){
		while(have_posts()){ the_post();
			?>

			<div class="pagina">
				<div class="pagina-encabezado estructura-encabezado">
					<div class="contenedor">
						<h1><?php the_title(); ?></h1>
					</div>
				</div>
					
				<div class="pagina-cuerpo estructura-contenido">
					<div class="contenedor">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

			<?php
		};
	}
	else{	
		require_once('404.php');
	}; 
	
	get_footer(); 
?>
