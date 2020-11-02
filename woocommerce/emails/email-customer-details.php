<?php
	// @version 2.5.0

	if(!defined('ABSPATH')){ exit; }
	
	if(!empty($fields)){
		?>
			<h2>Detalles del cliente</h2>
			<ul>
				<?php 
					foreach($fields as $field){
						echo('<li><strong>'.wp_kses_post($field['label']).':</strong> <span class="text">'.wp_kses_post($field['value']).'</span></li>');
					}
				?>
			</ul>
		<?php 
	}
?>
