<?php
	wp_enqueue_style('archive', get_bloginfo('template_url').'/estilos/archive.css', array('estructura'), '1.0', 'all'); 	
	wp_enqueue_style('archive-post', get_bloginfo('template_url').'/estilos/archive-post.css', array('archive'), '1.0', 'all'); 	
	wp_enqueue_style('single', get_bloginfo('template_url').'/estilos/single.css', array('estructura'), '1.0', 'all'); 	
	wp_enqueue_style('comments', get_bloginfo('template_url').'/estilos/comments.css', array('estructura'), '1.0', 'all'); 	
	
	get_header();
	
	if (have_posts()){
		while(have_posts()){ the_post();
			?>
				<div class="articulo">
					<div class="articulo-encabezado" <?php echo(get_post_header()); ?>>
						<div class="articulo-encabezado-defecto">
							<div class="contenedor">
								<div class="categorias"><?php the_category('') ?></div>
								<h1><?php the_title(); ?></h1>
								<small><strong><?php the_author(); ?></strong> | Publicado el <?php the_time('j \d\e F \d\e Y') ?></small>
							</div>
						</div>
					</div>
					
					<div class="articulo-cuerpo">
						<div class="contenedor">	
							<div class="articulo-contenido estructura-contenido">
								<?php the_content(); ?>
							</div>
										
							<div class="articulo-sidebar sidebar">
								<div class="articulo-compartir">								
									<ul>
										<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="fab facebook fa-facebook-f"></a></li>
										<li><a href="https://twitter.com/home?status=<?php the_title(); ?> (<?php echo(wp_get_shortlink()); ?>)" target="_blank" class="fab twitter fa-twitter"></a></li>
										<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="fab plus fa-google-plus-g"></a></li>
										<li><a href="whatsapp://send?text=Mirá este artículo: <?php echo(wp_get_shortlink()); ?>" data-action="share/whatsapp/share" target="_blank" class="fab whatsapp fa-whatsapp"></a></li>
										<li><a href="mailto:?subject=Mirá este artículo: <?php the_title(); ?>&body=<?php the_title(); ?> (<?php the_permalink(); ?>)" target="_blank" class="fa email fa-envelope"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			
			require_once('widget-relacionados.php');
		};
	}
	else{	
		require_once('404.php');
	}; 
	
	get_footer(); 
?>