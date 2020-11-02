		<div class="pie">
			<div class="pie-superior">
				<div class="contenedor">
					<ul>
						<li><i class="fa fa-info"></i> <p><strong>Efectivo</strong> <span>En la entrega</span></p></li>
						<li><i class="fa fa-info"></i> <p><strong>Tarjeta de debito</strong> <span>Mercado Pago</span></p></li>
						<li><i class="fa fa-info"></i> <p><strong>Tarjeta de credito</strong> <span>Mercado Pago</span></p></li>
						<li><i class="fa fa-info"></i> <p><strong>Tarjeta de credito</strong> <span>Mercado Pago</span></p></li>
					</ul>
				</div>
			</div>
			
			<div class="pie-inferior">
				<div class="contenedor">
					<div class="pie-informacion">
						<h6>Servicio al cliente</h6>
						
						<?php wp_nav_menu(array('theme_location' => 'menu-servicio', 'menu_class' => '', 'container' => false)); ?>
					</div>
					
					<div class="pie-informacion">
						<h6>Institucional</h6>
						
						<?php wp_nav_menu(array('theme_location' => 'menu-institucional', 'menu_class' => '', 'container' => false)); ?>
					</div>
					
					<div class="pie-informacion">
						<h6>Mi cuenta</h6>
						
						<?php wp_nav_menu(array('theme_location' => 'menu-cuenta', 'menu_class' => '', 'container' => false)); ?>
					</div>
					
					<div class="pie-otros">
						<div class="pie-newsletter">
							<h6>Suscribite a nuestro boletín</h6>
							<p>Si te gustaria obtener más información sobre nuestras propuestas y oportunidades, suscribite a nuesto boletín informativo.</p>
						
							<form action="" id="newsletter-formulario">
								<input type="text" class="campo" id="newsletter-formulario-email" placeholder="Ingresá tu correo">
								<a class="boton" id="newsletter-formulario-suscribir"><i class="fa fa-search"></i></a>
							</form>
						</div>
						
						<div class="pie-legales">
							<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/imagenes/datafiscal.png" width="80px"></a>
						</div>
						
						<div class="pie-detelles">
							<?php
								$facebook = get_template_custom('plantilla-contacto.php', '_contacto_facebook');
								$instagram = get_template_custom('plantilla-contacto.php', '_contacto_instagram');
								$email = get_template_custom('plantilla-contacto.php', '_contacto_email');
								$whatsapp = get_template_custom('plantilla-contacto.php', '_contacto_whatsapp');
								
								if($facebook or $instagram or $email or $whatsapp){
									?>
										<div class="pie-redes">
											<ul>
												<?php 
													if($facebook){
														echo('<li><a href="https://facebook.com/'.$facebook.'" target="_blank"><i class="fab fa-facebook"></i></a></li>');
													}
													if($instagram){
														echo('<li><a href="https://instagram.com/'.$instagram.'" target="_blank"><i class="fab fa-instagram"></i></a></li>');
													}
													if($email){
														echo('<li><a href="mailto:'.$email.'" target="_blank"><i class="fa fa-envelope"></i></a></li>');
													}
													if($whatsapp){
														echo('<li><a href="'.get_whatsapp_api($whatsapp).'" target="_blank"><i class="fab fa-whatsapp"></i></a></li>');
													}
												?>
											</ul>
										</div>
									<?php
								} 
							?>
							
							<div class="pie-autor">
								<a href="http://www.clousis.com?ref=<?php echo($_SERVER['HTTP_HOST']); ?>"><img src="<?php bloginfo('template_directory'); ?>/imagenes/logo-clousis.png"></a>
							</div>
						</div>

						
					</div>
				</div>
			</div>
		</div>
		
		<?php
			if($whatsapp = get_template_custom('plantilla-contacto.php', '_contacto_whatsapp')){
				echo('<a href="'.get_whatsapp_api($whatsapp).'" class="botonera-whatsapp" id="boton-whatsapp"><i class="fab fa-whatsapp"></i></a>');
			}
		?>
		
		<!--<a href="#" class="scrollup"><span class="fa fa-angle-up"></span></a>-->
		
		<?php wp_footer(); ?>
	</body>
</html>