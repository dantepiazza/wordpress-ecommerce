<div class="articulo ui-shadow">				
	<a href="<?php the_permalink(); ?>" class="articulo-imagen" style="background-image:url(<?php echo((has_post_thumbnail()) ? get_the_post_thumbnail_url(null, 'proporcional') : get_bloginfo('template_url').'/imagenes/articulos-thumbnail-500x500.jpg'); ?>);"></a>
	<div class="articulo-contenedor">
		<div class="articulo-info">
			<?php the_first_category() ?>
		</div>
											
		<a href="<?php the_permalink(); ?>" class="articulo-contenido">
			<h1><?php the_title(); ?></h1>
			<p><?php the_excerpt(); ?></p>
		</a>
	</div>
</div>