<?php

	function users_interfase(){
		$retorno = array('estado' => '', 'mensaje' => '');
		
		if(isset($_POST['procesar']) and $_POST['procesar']){
			$retorno = users_role($_POST['rol'], $_POST['nombre'], $_POST['capas']);
		}
		
		?>
		<div class="wrap">
			<h1>Roles</h1>

			<?php wp_admin_notice($retorno['mensaje'], $retorno['estado']); ?>
			
			<div id="poststuff">
				<form method="post">
					<div class="metabox-holder columns-2" id="post-body">
						<div class="" id="post-body-content">
							<div class="stuffbox" id="namediv">
								<h2 class="hndle"><span>Capas</span></h2>
								
								<div class="inside" id="users-roles-capas">
									<ul>
									<?php
										foreach(users_layers() as $clave => $capa){
											echo('<li><label><input type="checkbox" name="capas[]" value="'.$clave.'" id="'.$clave.'"> '.((!empty($capa)) ? $capa : $clave).'</label></li>');
										}
									?>
									</ul>
								</div>
							</div>
						</div>

						<div class="postbox-container" id="postbox-container-1">
							<div class="stuffbox" id="submitdiv">
								<h2 class="hndle"><span>Administración de roles</span></h2>
								
								<div class="inside">
									<div id="submitcomment" class="submitbox">
										<div id="minor-publishing">
											<div id="misc-publishing-actions">
												<fieldset id="comment-status-radio" class="misc-pub-section misc-pub-comment-status">
													<label>
														Selecciona un rol para editarlo<br>
													
														<select id="users-roles" name="rol" class="users-roles-input">
															<option value="nuevo">Nuevo rol</option>
															<?php
																foreach(get_editable_roles() as $rol => $detalles){
																	echo('<option value="'.$rol.'" data-capas=\''.json_encode($detalles['capabilities']).'\'>'.$detalles['name'].'</option>');
																}
															?>
														</select>
													</label>

													<label id="users-roles-nuevo">
														Nombre<br>
														
														<input type="text" name="nombre" class="users-roles-input">
													</label>
												</fieldset>
											</div>

											<div class="clear"></div>
										</div>

										<div id="major-publishing-actions">
											<div id="publishing-action">
												<input type="hidden" value="true" name="procesar">
												<input type="submit" value="Actualizar" class="button button-primary">
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php
	}
	
?>