<?php
	/* Template Name: Contacto */
	
	wp_enqueue_script('plantilla-contacto', get_bloginfo('template_url').'/javascripts/plantilla-contacto.js', array('jquery'), '1.0', true);
	wp_enqueue_style('plantilla-contacto', get_bloginfo('template_url').'/estilos/plantilla-contacto.css', array('estructura'), '1.0', 'all'); 	
	
	get_header();
	
	if (have_posts()){
		while(have_posts()){ the_post();
			?>
				<div class="contacto">
					<section class="contacto-encabezado estructura-encabezado">
						<div class="contenedor">
							<h1><?php the_title(); ?></h1>
						</div>
					</section>
					
					<section class="contacto-contenido">
						<div class="contenedor">
							<div class="contacto-informacion">									
								<div class="contacto-medios">
									<?php									
										if($meta = get_post_meta(get_the_ID(), '_contacto_email', true)){
											?>
											<a class="contacto-medio" href="mailto:<?php echo($meta); ?>">
												<i class="fa fa-at"></i>
												<p><strong>Correo electrónico</strong><br><?php echo($meta); ?></p>
											</a>
											<?php
										}
										
										if($meta = get_post_meta(get_the_ID(), '_contacto_whatsapp', true)){
											?>
											<a class="contacto-medio" href="<?php echo(get_whatsapp_api($meta)); ?>" target="_blank">
												<i class="fab fa-whatsapp"></i>
												<p><strong>Whatsapp</strong><br><?php echo($meta); ?></p>
											</a>
											<?php
										}
										
										if($meta = get_post_meta(get_the_ID(), '_contacto_instagram', true)){
											?>
											<a class="contacto-medio" href="https://instagram.com/<?php echo($meta); ?>" target="_blank">
												<i class="fab fa-facebook-square"></i>
												<p><strong>Facebook</strong><br><?php echo($meta); ?></p>
											</a>
											<?php
										}
										
										if($meta = get_post_meta(get_the_ID(), '_contacto_facebook', true)){
											?>
											<a class="contacto-medio" href="https://facebook.com/<?php echo($meta); ?>" target="_blank">
												<i class="fab fa-instagram"></i>
												<p><strong>Instagram</strong><br><?php echo($meta); ?></p>
											</a>
											<?php
										}
									?>
								</div>
							</div>
							
							<div class="contacto-formulario">
								<?php
									if(isset($_GET['accion']) and $_GET['accion'] == 'envio'){
										if(!empty($_POST['contacto-nombre']) and !empty($_POST['contacto-telefono']) and !empty($_POST['contacto-email']) and !empty($_POST['contacto-mensaje'])){
											$cuerpo = '<p>
															<strong>Nombre y Apellido:</strong> '.$_POST['contacto-nombre'].'<br>
															<strong>T&eacute;lefono:</strong> '.$_POST['contacto-telefono'].'<br>
															<strong>Correo electr&oacute;nico:</strong> '.$_POST['contacto-email'].'						
														</p>
														<p><strong>Mensaje:</strong><br>'.$_POST['contacto-mensaje'].'</p>';

											if(wp_mail(MAIL_DIR, 'Contacto desde la web', $cuerpo)){
												unset($_POST);
												
												?><script>jQuery(document).ready(function(){ jQuery.modalBox('contacto', 'exito', 'Recibimos tu consulta, nos contactaremos a la brevedad para brindarte más información.', 'Contacto', 400); });</script><?php
											}
											else{
												?><script>jQuery(document).ready(function(){ jQuery.modalBox('contacto', 'error', 'Ha ocurrido un inconveniente al intentar procesar tu consulta, de todas formas podemos brindarte toda la información que necesites si nos contactas por medio de la siguiente dirección de correo <?php echo(MAIL_DIR); ?>', 'Contacto', 400); });</script><?php
											}
										}
										else{
											?><script>jQuery(document).ready(function(){ jQuery.modalBox('contacto', 'alerta', 'Algunos datos se encuentran incompletos.', 'Contacto', 400); });</script><?php
										}
									}
								?>
								
								<form method="post" action="?accion=envio">
									<div class="contacto-formulario-izquiedo">
										<input type="text" placeholder="Nombre y Apellido" name="contacto-nombre" class="campo campo-nombre" value="<?php echo((isset($_POST['contacto-nombre']) and !empty($_POST['contacto-nombre'])) ? $_POST['contacto-nombre'] : ''); ?>">
										<input type="text" placeholder="Teléfono" name="contacto-telefono" class="campo campo-telefono" value="<?php echo((isset($_POST['contacto-telefono']) and !empty($_POST['contacto-telefono'])) ? $_POST['contacto-telefono'] : ''); ?>">
										<input type="text" placeholder="Correo electrónico" name="contacto-email" class="campo campo-email" value="<?php echo((isset($_POST['contacto-email']) and !empty($_POST['contacto-email'])) ? $_POST['contacto-email'] : ''); ?>">
									</div>
									
									<div class="contacto-formulario-derecho">
										<textarea placeholder="Mensaje" name="contacto-mensaje" class="campo campo-mensaje"><?php echo((isset($_POST['contacto-mensaje']) and !empty($_POST['contacto-mensaje'])) ? $_POST['contacto-mensaje'] : ''); ?></textarea>
										<input type="submit" class="boton boton-contactar" value="Contactar">
									</div>
								</form>
							</div>
						</div>
					</section>
					
					<?php 					
						$mapa = get_post_meta(get_the_ID(), '_contacto_mapa', true);
						
						if(!empty($mapa)){ 
							?>
								<section class="contacto-mapa">
									<iframe id="mapa-frame" class="contacto-mapa-desactivo" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen src="<?php echo($mapa); ?>"></iframe>
									
									<a id="mapa-estado" class="boton">Activar mapa</a>
								</section>
							<?php 
						} 
					?>
				</div>
			<?php
		};
	}
	else{	
		require_once('404.php');
	}; 
	
	get_footer(); 
?>