<?php 
	// @author WooThemes
	// @package WooCommerce/Templates/Auth
	// @version 2.6.0
	
	if(!defined('ABSPATH')){ exit; }

	do_action( 'woocommerce_before_edit_account_form' );
?>

<div class="wc-account-edit">
	<form class="woocommerce-EditAccountForm edit-account" action="" method="post">
		<div class="wc-account-edit-content">
			<?php do_action( 'woocommerce_edit_account_form_start' ); ?>					
			
			<div class="ui-form ui-shadow">
				<div class="ui-form-header"><h3>Modificar mis datos</h3></div>
				
				<div class="ui-form-content">
					<div class="ui-form-row-multiple">
						<div class="ui-form-row">
							<label for="account_first_name">Nombre <span class="required">*</span></label>
							<input type="text" class="ui-input" name="account_first_name" id="account_first_name" value="<?php echo(esc_attr($user -> first_name)); ?>" />
						</div>
						
						<div class="ui-form-row">
							<label for="account_last_name">Apellido <span class="required">*</span></label>
							<input type="text" class="ui-input" name="account_last_name" id="account_last_name" value="<?php echo(esc_attr($user -> last_name)); ?>" />
						</div>
					</div>

					<div class="ui-form-row">
						<label for="account_email">E-Mail <span class="required">*</span></label>
						<input type="email" class="ui-input" name="account_email" id="account_email" value="<?php echo(esc_attr($user -> user_email)); ?>" />
					</div>
				</div>
			</div>
			
			<div class="ui-form ui-shadow">
				<div class="ui-form-header"><h3>Cambiar contrase&ntilde;a</h3></div>

				<div class="ui-form-content">
					<div class="ui-form-row-multiple">	
						<div class="ui-form-row">
							<label for="password_1">Nueva contrase&ntilde;a</label>
							<input type="password" class="ui-input" name="password_1" id="password_1" />
						</div>
						
						<div class="ui-form-row">
							<label for="password_2">Confirmar contrase&ntilde;a</label>
							<input type="password" class="ui-input" name="password_2" id="password_2" />
						</div>
					</div>
					
					<div class="ui-form-row">
						<label for="password_current">Contrase&ntilde;a actual (dejar en blanco para no modificar)</label>
						<input type="password" class="ui-input" name="password_current" id="password_current" />
					</div>
				</div>
			</div>
		
			<?php do_action('woocommerce_edit_account_form'); ?>

			<div class="ui-actions">
				<?php wp_nonce_field('save_account_details'); ?>
				
				<input type="hidden" name="action" value="save_account_details" />
				<input type="submit" class="ui-button" name="save_account_details" value="Guardar cambios" />
			</div>
		
			<?php do_action('woocommerce_edit_account_form_end'); ?>
		</div>
	</form>
</div>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
