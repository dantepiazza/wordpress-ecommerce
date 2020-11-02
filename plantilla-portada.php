<?php
	/* Template Name: Portada */	
	
	wp_enqueue_style('woocommerce-archive', get_bloginfo('template_url').'/woocommerce/estilos/archive-product.css', array('estructura'), '1.0', 'all'); 	
	wp_enqueue_style('woocommerce-producto', get_bloginfo('template_url').'/woocommerce/estilos/content-product.css', array('estructura'), '1.0', 'all'); 	
	wp_enqueue_style('plantilla-portada', get_bloginfo('template_url').'/estilos/plantilla-portada.css', array('estructura'), '1.0', 'all'); 	
	
	get_header();		
	
	if (have_posts()){
		while(have_posts()){ the_post();	
			?>
				<div class="portada">
					<div class="portada-encabezado">
						<?php if(function_exists('putRevSlider')){ putRevSlider('portada'); } ?>	
					</div>
					
					<div class="portada-contenido">
						<div class="portada-procesos">
							<div class="contenedor">
								<?php @include('widget-procesos.php'); ?>
							</div>
						</div>
						
						<?php 
							query_posts(array('post_type' => 'product', 'stock' => 1, 'posts_per_page' => 8, 'tax_query' => array(array('taxonomy' => 'product_visibility', 'field' => 'name', 'terms' => 'featured'))));											
				
							if(have_posts()){ 
								?>	
									<div class="portada-productos">
										<div class="contenedor">										
											<h1 class="ui-title"><span>Recomendados</span>Productos destacados</h1>										
																					
											<div class="portada-productos-contenedor">
												<?php
													woocommerce_product_loop_start();
													
													while(have_posts()){ the_post(); global $product;
														do_action('woocommerce_shop_loop');
														
														wc_get_template_part('content', 'product');
													}
													
													woocommerce_product_loop_end();
												?>
											</div>
										</div>
									</div>
								<?php 
							}
							
							wp_reset_query();
						?>	
						
						<div class="portada-categorias">
							<div class="contenedor">
								<?php @include('widget-categorias.php'); ?>
							</div>
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