jQuery(document).ready(function($){			
	$(document).delegate('[id=newsletter-eliminar]', 'click', function(){
		var id = $(this).data('id')
		
		$.post(ajaxurl, {
			action: 'newsletter_eliminar',
			id: id
		}, function(data){
			
			if(data.estado == 'exito'){
				$('#listado #' + id).hide('slow', function(){
					$(this.remove());
				});
			}
			else{
				alert(data.mensaje);
			}
			
		}, 'json');
	});
});	