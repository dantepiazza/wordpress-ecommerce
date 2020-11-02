<?php
	$categorias = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => false));

	if(!empty($categorias)){	
		?>
		<div class="widget-categorias">
			<div class="contenedor">
				<div class="widget-categorias-contenedor ui-shadow">
					<?php
						for($i = 0; $i < 14; $i++){
							if(isset($categorias[$i])){
								$imagen = wp_get_attachment_image_src(get_term_meta($categorias[$i] -> term_id, 'thumbnail', true), 'thumbnail');
								$imagen = $imagen[0];
								
								?>
									<a class="categoria" href="<?php echo(get_term_link($categorias[$i] -> term_id, 'product_cat')); ?>">
										<i><?php echo(($imagen) ? '<img src="'.$imagen.'">' : ''); ?></i>
										<?php echo($categorias[$i] -> name); ?>
									</a>
								<?php
							}
						}
					?>
				</div>
			</div>
		</div>
		<?php
	}
?>