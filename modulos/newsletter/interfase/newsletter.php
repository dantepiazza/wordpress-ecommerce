<?php
	
	function newsletter_interfase_listado(){		
		$registros = newsletter_listar(20, ((isset($_GET['pagina'])) ? $_GET['pagina'] : ''));
		
		?>
		<div class="wrap">
			<h2>Suscripciones a newsletter</h2>	
			
			<div class="tablenav top">
				<div class="tablenav-pages"><span class="pagination-links"><?php //echo paginado($registros -> cantidad_registros, 20); ?></span></div>
			</div>
			<table cellspacing="0" class="widefat fixed">
				<thead>
					<tr>
						<th>Correo electr&oacute;nico</th>
						<th>Nombre</th>
						<th>Lista</th>
						<th>Estado</th>						
						<th>Fecha de registro</th>	
					</tr>
				</thead>
					<tfoot>
					<tr>
						<th>Correo electr&oacute;nico</th>
						<th>Nombre</th>
						<th>Lista</th>
						<th>Estado</th>						
						<th>Fecha de registro</th>						
					</tr>
				</tfoot>
					<tbody id="listado">
					<?php				
					if(!empty($registros -> registros)){
						foreach($registros -> registros as $registro){				
							?>
							<tr id="<?php echo($registro -> id); ?>" class="<?php echo($registro -> estado); ?>">
								<td>
									<?php echo($registro -> email); ?>
									
									<div class="row-actions">
										<span><a href="#" id="newsletter-eliminar" data-id="<?php echo($registro -> id); ?>">Eliminar</a></span>
									</div>
								</td>
								<td><?php echo($registro -> nombre); ?></td>
								<td><?php echo($registro -> lista); ?></td>
								<td><?php echo(ucfirst($registro -> estado)); ?></td>
								<td><?php echo(date_i18n('d\/m\/Y \a \l\a\s H:i', strtotime($registro -> fecha_registro))); ?></td>
							</tr>
							<?php
						}
					}
					else{
						?><tr><td colspan="5"><center><p>Aun no existen suscripciones.</p></center></td></tr><?php
					}				
					?>			
				</tbody>
			</table>
			
			<div class="tablenav top">
				<div class="tablenav-pages"><span class="pagination-links"><?php //echo paginado($registros -> cantidad_registros, 20); ?></span></div>
			</div>
		</div>
		<?php
	}

?>