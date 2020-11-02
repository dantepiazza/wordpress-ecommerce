<?php
	/* Template Name: Woocommerce */
	
	wp_enqueue_style('plantilla-woocommerce', get_bloginfo('template_url').'/estilos/plantilla-woocommerce.css', array('estructura'), '1.0', 'all'); 	
	
	get_header();
	
	if (have_posts()){
		while(have_posts()){ the_post();
			?>
				<div class="woocommerce">
					<div class="woocommerce-contenido">
						<?php the_content(); ?>
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