<?php 
	wp_enqueue_style('archive', get_bloginfo('template_url').'/estilos/archive.css', array('estructura'), '1.0', 'all'); 	
	wp_enqueue_style('archive-post', get_bloginfo('template_url').'/estilos/archive-post.css', array('archive'), '1.0', 'all'); 	
	wp_enqueue_style('sidebar', get_bloginfo('template_url').'/estilos/sidebar.css', array('estructura'), '1.0', 'all'); 	
	
	get_header(); 
	
	if(have_posts()){		
		?>
			<div class="articulos">
				<div class="estructura-encabezado">
					<div class="contenedor">
						<?php					
							if (is_category()){
								?> <h1>&Uacute;ltimas novedades de la categoria <span><?php single_cat_title(); ?></span></h1> <?php
							} 
							else if(is_tag()){
								?> <h1>&Uacute;ltimas novedades con la etiqueta <span><?php single_tag_title(); ?></span></h1> <?php
							} 
							else if (is_day()){
								?> <h1>&Uacute;ltimas novedades del d&iacute;a <?php the_time('F jS, Y'); ?></h1> <?php
							} 
							else if (is_month()){
								?> <h1>&Uacute;ltimas novedades del mes <?php the_time('F, Y'); ?></h1> <?php
							} 
							else if (is_year()){
								?> <h1>&Uacute;ltimas novedades del a&ntilde;o <?php the_time('Y'); ?></h1> <?php
							} 
							else if (is_author()){
								$userdata = get_userdatabylogin(get_query_var('author_name'));
								
								?> <h1>&Uacute;ltimas novedades publicadas por <span><?php $userdata -> display_name ?></span></h1> <?php
							} 
							else if (is_search()){
								?> <h1>&Uacute;ltimas novedades con tu b&uacute;squeda <?php echo($_GET['s']); ?></h1> <?php
							}
							else{
								?> <h1>&Uacute;ltimas <span>novedades</sspan></h1> <?php
							}
						?>
					</div>
				</div>	
				
				<div class="articulos-listado">
					<div class="contenedor">					
						<div class="articulos-contenedor">							
							<?php 
								while (have_posts()){ the_post(); 
									get_template_part('archive', 'post');								
								} 
							?>
						</div>							
							
						<div class="articulos-navegacion">
							<?php
								echo(paginate_links(array(
									'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
									'format' => '?paged=%#%',
									'current' => max(1, get_query_var('paged'))
								)));
							?>
						</div>
					</div>
				</div>
			</div>
		<?php 
	} else { require_once('404.php'); } 

	get_footer(); 
?>