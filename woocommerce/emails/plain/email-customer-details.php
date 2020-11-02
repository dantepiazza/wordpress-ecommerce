<?php
	// @version 2.5.0

	if(!defined('ABSPATH')){ exit; }

	echo("Detalles del cliente\n\n");

	foreach($fields as $field){
		echo(wp_kses_post($field['label']).': '.wp_kses_post($field['value'])."\n");
	}
