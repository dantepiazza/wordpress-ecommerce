<?php
	// @author WooThemes
	// @package WooCommerce/Templates
	// @version 2.3.2
	
	if(!defined('ABSPATH')){ exit; }

	global $product;

	if(comments_open()){
		?>
		
		<div class="wc-calificaciones" id="comments">	
			<div class="wc-calificaciones-titulo">
				<h2 class="woocommerce-Reviews-title">
					<?php
						if(wc_review_ratings_enabled() && ($count = $product -> get_review_count())){
							$reviews_title = sprintf(esc_html(_n('%1$s calificaci&oacute;n para %2$s', '%1$s calificaciones para %2$s', $count)), esc_html($count), '<span>'.get_the_title().'</span>');
				
							echo(apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product)); // WPCS: XSS ok.
						} else {
							echo('Calificaciones');
						}
					?>
				</h2>
			</div>	
			
			<?php
				if(have_comments()){ 
					?>
						<div class="wc-calificaciones-listado">
							<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments')));	?>
						</div> 					
					<?php 
						if(get_comment_pages_count() > 1 && get_option('page_comments')){ 
							?>
								<div class="wc-calificaciones-navegacion">
									<div class="wc-calificaciones-navegacion-izquierda"><div class="alignleft"><?php previous_comments_link('&laquo; Comentarios anteriores') ?></div></div>
									<div class="wc-calificaciones-navegacion-derecha"><div class="alignright"><?php next_comments_link('Comentarios recientes &raquo;') ?></div></div>
								</div>	
							<?php 
						} 
				}
				else {
					?> <p class="woocommerce-noreviews">Aún no hay calificaciones.</p> <?php 
				}
			
				if(get_option('woocommerce_review_rating_verification_required') === 'no' or wc_customer_bought_product('', get_current_user_id(), $product -> get_id())){
					$commenter = wp_get_current_commenter();
						
						?>
							<div id="respond" class="wc-calificaciones-formulario">
								<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
												
									<div class="wc-calificaciones-formulario-contenedor">
										<?php if(!$user_ID){ ?>	
										
											<div class="wc-calificaciones-formulario-campos">
												<input class="campo wc-calificaciones-campo-nombre" type="text" name="author" id="author" value="<?php echo $commenter['comment_author']; ?>" placeholder="Nombre" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
												<input class="campo wc-calificaciones-campo-email" type="text" name="email" id="email" value="<?php echo $commenter['comment_author_email']; ?>" placeholder="Direcci&oacute;n de correo" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
											</div>
													
										<?php } ?>
													
										<div class="wc-calificaciones-formulario-area<?php if($user_ID){ echo('-full'); } ?>">
											<textarea class="campo wc-calificaciones-campo-mensaje" name="comment" id="comment" placeholder="Opini&oacute;n"></textarea>
										</div>
									</div>
									
									<div class="wc-calificaciones-formulario-pie">
										<div class="wc-calificaciones-leyenda">	
											<span class="leyenda">
												Tu comentario será revisado por un administrador antes de ser publicado.
													
												<?php
													if(get_option('comment_registration') and !$user_ID and $account_page_url = wc_get_page_permalink('myaccount')){
														?> Es necesario que <a href="<?php echo($account_page_url); ?>">ingreses a tu cuenta</a> para calificar el producto.Puedes <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">iniciar sesi&oacute;n</a> para publicar un comentario. <?php
													}
												?>
											</span>
										</div>
										<div class="wc-calificaciones-acciones">
											<?php if(get_option( 'woocommerce_enable_review_rating' ) === 'yes'){ ?>	
										
												<select name="rating" id="rating" aria-required="true" required>
													<option value="">Calificación</option>
													<option value="5">Perfect</option>
													<option value="4">Good</option>
													<option value="3">Average</option>
													<option value="2">Not that bad</option>
													<option value="1">Very poor</option>
												</select>
														
											<?php } ?>
											
											<?php comment_id_fields(); ?> 
											<?php do_action('comment_form', $post -> ID); ?>
											
											<input name="submit" class="boton wc-calificaciones-boton-publicar" type="submit" id="submit" tabindex="5" value="Calificar" />
										</div>
									</div>
									
								</form>
							</div>
						<?php
					}
					else{
						?>
							<div class="wc-calificaciones-formulario">
								<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
							</div>
						<?php
					}
				?>	
		</div>
		
		<?php
	}
?>