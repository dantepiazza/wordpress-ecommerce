jQuery(document).ready(function(){	
	jQuery('#newsletter-formulario-suscribir').click(function(){
		jQuery.ajax({  
			url: WPURLS.ajaxurl,
			type: "post", 															
			dataType: "json",
			data: {
				action: 'newsletter_suscribir',
				nombre: jQuery('#newsletter-formulario').find('#newsletter-formulario-nombre').val(), 
				email: jQuery('#newsletter-formulario').find('#newsletter-formulario-email').val()		
			},
			beforeSend: function(){
				jQuery.loader('show', 'top');
			},
			complete: function(){
				jQuery.loader('hide', 'top');
			},
			success: function(data){			
				jQuery.modalBox('newsletter', data.estado, data.mensaje, 'Suscripción', 350);
			
				if(data.estado == 'exito'){
					jQuery('#newsletter-formulario').find('#newsletter-formulario-nombre').val('');
					jQuery('#newsletter-formulario').find('#newsletter-formulario-email').val('');
				}
			},
			error: function(){
				jQuery.modalBox('newsletter', 'alerta', 'En este momento no es posible suscribirse al boletín. Por favor intente nuevamente mas tarde.', 'Suscripción', 350);
			}
		});
	});
	
	if (document.location.hash == "#!newsletter-confirmar"){    
		jQuery.ajax({  
			url: WPURLS.ajaxurl,
			type: "post", 															
			dataType: "json",
			data: {
				action: 'newsletter_confirmar',
				suscripcion: jQuery.getUrlVar('suscripcion')
			},
			beforeSend: function(){
				jQuery.loader('show', 'top');
			},
			complete: function(){
				jQuery.loader('hide', 'top');
			},
			success: function(data){								
				jQuery.modalBox('newsletter', data.estado, data.mensaje, 'Confirmación de la suscripción', 350);
			},
			error: function(){
				jQuery.modalBox('newsletter', 'alerta', 'En este momento no es posible confirmar tu suscripción. Por favor intente nuevamente mas tarde.', 'Confirmación de la suscripción', 350);
			}
		});
	};
	
	if (document.location.hash == "#!newsletter-desuscribir"){    
		jQuery.ajax({  
			url: WPURLS.ajaxurl,
			type: "post", 															
			dataType: "json",
			data: {
				action: 'newsletter_desuscribir',
				suscripcion: jQuery.getUrlVar('suscripcion')
			},
			beforeSend: function(){
				jQuery.loader('show', 'top');
			},
			complete: function(){
				jQuery.loader('hide', 'top');
			},
			success: function(data){								
				jQuery.modalBox('newsletter', data.estado, data.mensaje, 'Baja de la suscripción', 350);
			},
			error: function(){
				jQuery.modalBox('newsletter', 'alerta', 'En este momento no es posible procesar tu desuscripción. Por favor intente nuevamente mas tarde.', 'Baja de la suscripción', 350);
			}
		});
	};
});