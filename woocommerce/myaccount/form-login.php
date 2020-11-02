<?php 
	// @version 2.6.0
	
	if(!defined('ABSPATH')){ exit; }
?>
	
<div class="contenedor">
	<div class="wc-login <?php echo((get_option('woocommerce_enable_myaccount_registration' ) === 'yes') ? 'wc-login-full' : '') ?>">
		<?php 
			wc_print_notices();
				
			do_action('woocommerce_before_customer_login_form');
		?>
			
		<div class="wc-login-login">
			<h5>Ingresar a mi cuenta</h5>
			
			<form method="post">				
				<?php do_action('woocommerce_login_form_start'); ?>
				
				<input type="text" class="campo" name="username" id="username" value="<?php echo((!empty($_POST['username'])) ? esc_attr($_POST['username']) : ''); ?>" placeholder="Usuario o E-Mail"/>
				<input type="password" class="campo" name="password" id="password" placeholder="Contraseña"/>
				
				<p>
					<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>Recordarme</span></label> - 
					<a href="<?php echo(esc_url(wp_lostpassword_url())); ?>">Olvide mi contrase&ntilde;a</a>
				</p>
					
				<?php do_action('woocommerce_login_form'); ?>
					
				<p class="form-row">
					<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
					<input type="submit" class="boton" name="login" value="Ingresar" />
				</p>
				
				<?php do_action('woocommerce_login_form_end'); ?>
			</form>
		</div>
			
		<?php if(get_option('woocommerce_enable_myaccount_registration' ) === 'yes'){ ?>
							
				<div class="wc-login-register">
					<h5>Creá tu cuenta</h5>

					<form method="post">
						<?php do_action('woocommerce_register_form_start'); ?>
									
						<input type="email" class="campo" name="email" id="reg_email" value="<?php echo((!empty($_POST['email'])) ? esc_attr($_POST['email']) : ''); ?>" placeholder="E-Mail"/>
									
						<?php 
							if('no' === get_option('woocommerce_registration_generate_username')){
								echo('<input type="text" class="campo" name="username" id="reg_username" value="'.((!empty($_POST['username'])) ? esc_attr($_POST['username']) : '').'" placeholder="Usuario"/>');
							} 

							if('no' === get_option( 'woocommerce_registration_generate_password')){
								echo('<input type="password" class="campo" name="password" id="reg_password" placeholder="Contraseña"/>');
							}
						?>

						<div style="<?php echo(( is_rtl() ) ? 'right' : 'left'); ?>: -999em; position: absolute;"><label for="trap">Anti-SPAM</label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

						<?php do_action( 'woocommerce_register_form' ); ?>

						<p class="woocomerce-FormRow form-row">
							<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>										
							<input type="submit" class="boton" name="register" value="Registrarme" />
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>
					</form>
				</div>
						
		<?php } do_action('woocommerce_after_customer_login_form'); ?>
	</div>
</div>