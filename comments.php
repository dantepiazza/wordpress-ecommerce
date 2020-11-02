<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Por favor no cargue este archivo directamente. Gracias!'); ?>

<?php if (have_comments() or $post -> comment_status == 'open' or post_password_required()){ ?>

	<div class="comentarios" id="comments">	
		<div class="contenedor">
			<div class="comentarios-contenedor">
				<?php		
					if (post_password_required()){ 
						?> <div class="comentarios-titulo"><h3>Esta noticia esta protegida por contrase&ntilde;a. Ingrese la contrase&ntilde;a para poder ver los comentarios.</h3></div> <?php
					}
					else{
						if ($post -> comment_status == 'open'){ 
							?>
								<div class="comentarios-titulo">
									<h5>
										<?php 
											$cantidad_comentarios = ((get_comments_number() == 1) ? 'Hay un comentario en esta noticia, ' : 'Hay '.get_comments_number().' comentarios en esta noticia, '); 
											
											comment_form_title($cantidad_comentarios.' nos gustar&iacute;a recibir el tuyo.', 'Responder comentario', $cantidad_comentarios.' nos gustar&iacute;a recibir el tuyo.'); 
										?>
									</h5>
								</div>
								
								<?php if(get_option('comment_registration') && !$user_ID){} else{ ?>
									<div class="comentarios-formulario">
										<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
											
											<div class="comentarios-formulario-contenedor">
												<?php if(!$user_ID){ ?>	
												
													<div class="comentarios-formulario-campos">
														<input class="campo comentarios-campo-nombre" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" placeholder="Nombre" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />

														<input class="campo comentarios-campo-email" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" placeholder="Direcci&oacute;n de correo" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
													</div>
												
												<?php } ?>
												
												<div class="comentarios-formulario-area<?php if($user_ID){ echo('-full'); } ?>">
													<textarea class="campo comentarios-campo-mensaje" name="comment" id="comment" placeholder="Comentario"></textarea>
												</div>
											</div>
											
											<div class="comentarios-formulario-pie">
												<div class="comentarios-leyenda">	
													<span class="leyenda">
														Tu comentario será revisado por un administrador antes de ser publicado.
													
														<?php
															if(get_option('comment_registration') and !$user_ID){
																?> Puedes <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">iniciar sesi&oacute;n</a> para publicar un comentario. <?php
															}
															else{
																if($user_ID){
																	?> Comentar como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> - <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Cerrar Sesi&oacute;n">Cerrar sesi&oacute;n &raquo;</a> <?php
																}
															}
														?>
													</span>

													<?php cancel_comment_reply_link('<span id="respond">Cancelar la respuesta</span>');?>
												</div>
												<div class="comentarios-acciones">
													<?php comment_id_fields(); ?> 
													<?php do_action('comment_form', $post -> ID); ?>
													
													<input name="submit" class="boton comentarios-boton-publicar" type="submit" id="submit" tabindex="5" value="Comentar" />
												</div>
											</div>
											
										</form>
									</div> 
								<?php } 
						}

						if (have_comments()){ 
							?>
								<div class="comentarios-listado">
									<?php					
											
										function listado_comentarios($comment, $args, $depth){
											$GLOBALS['comment'] = $comment;
												
											if($comment->comment_type == 'pingback' or $comment->comment_type == 'trackback'){
												?>
												<div class="comentario ui-shadow grilla-contenedor" id="comentario-<?php comment_ID(); ?>">
													<p>Pingback: <?php comment_author_link(); edit_comment_link('Editar', ' '); ?></p>
												</div>
												<?php						
											}
											else{						
												?>
												<div class="comentario ui-shadow" id="comentario-<?php comment_ID(); ?>">
													<div class="comentario-imagen">
														<?php echo(get_avatar($comment -> comment_author_email, 80)); ?>								
													</div>
													<div class="comentario-cuerpo">
														<strong><?php comment_author_link() ?>:</strong>							
														<?php 
															if ($comment -> comment_approved == '0'){ 
																?> <small>(El comentario ser&aacute; p&uacute;blico cuando un administrador lo apruebe) </small><?php
															}
														?>
															
														<?php comment_text(); ?>
														
														<div class="comentario-pie">	
															<?php	
																edit_comment_link('Editar comentario'); 
																	
																comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Responder'));
															?>
														</div>
													</div>
												</div>							
												<?php
											}
										}
											
										wp_list_comments(array('callback' => 'listado_comentarios'));					
									?>
								</div> 
					
								<?php 
									if (get_comment_pages_count() > 1 && get_option( 'page_comments' )){ 
										?>
											
											<div class="comentarios-navegacion">
												<div class="comentarios-navegacion-izquierda"><div class="alignleft"><?php previous_comments_link('&laquo; Comentarios anteriores') ?></div></div>
												<div class="comentarios-navegacion-derecha"><div class="alignright"><?php next_comments_link('Comentarios recientes &raquo;') ?></div></div>
											</div>
											
										<?php 
									} 
								?>
							<?php	
						}
					}
				?>
			</div>
		</div>
	</div>

<?php } ?>