<?php
	query_posts(array('post_type' => 'post', 'posts_per_page' => 4));
									
	if(have_posts()){ 
?>
							
	<div class="widget-relacionados articulos">
		<div class="articulos-listado">
			<div class="contenedor">					
				<h5>Artículos relacionados</h5>
					
				<div class="articulos-contenedor">					
					<?php 
						while (have_posts()){ the_post(); 
							get_template_part('archive', 'post');								
						} 
					?>						
				</div>					
			</div>
		</div>
	</div>
							
<?php } wp_reset_query(); ?>