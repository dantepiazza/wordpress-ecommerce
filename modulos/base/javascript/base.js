jQuery(document).ready(function(){
	jQuery.extend({
		getUrlVar: function(name){
			var url = window.location.search.substring(1);
			var arguments = url.split('&');
			
			for(var i = 0; i < arguments.length; i++){
				var argument = arguments[i].split('=');
				
				if(argument[0] == name){
					return argument[1];
				}
			}
		},
		modalBox: function(identificador, estado, content, title, width){
			if(typeof(identificador) === 'undefined') title = '';
			if(typeof(estado) === 'undefined') title = '';
			if(typeof(title) === 'undefined') title = '';
			if(typeof(content) === 'undefined') content = '';	
			if(typeof(width) === 'undefined') width = 350;	
			
			if(estado != ''){
				icon = '';
				
				if(estado == 'info'){
					icon = '<div class="ui-notify-icon ui-notify-info"></div>';
				}
				else if(estado == 'alerta'){
					icon = '<div class="ui-notify-icon ui-notify-warning"></div>';
				}
				else if(estado == 'exito'){
					icon = '<div class="ui-notify-icon ui-notify-success animate">\
						<span class="ui-notify-line ui-notify-tip animateSuccessTip"></span>\
						<span class="ui-notify-line ui-notify-long animateSuccessLong"></span>\
						<div class="ui-notify-placeholder"></div>\
						<div class="ui-notify-fix"></div>\
					</div>';
				}
				else if(estado == 'error'){
					icon = '<div class="ui-notify-icon ui-notify-error">\
						<span class="ui-notify-error-cross">\
							<span class="ui-notify-line ui-notify-left"></span>\
							<span class="ui-notify-line ui-notify-right"></span>\
						</span>\
					</div>';
				}				
				
				content = '<div class="modalbox-contenedor-icono">' + icon + '</div><div class="modalbox-contenedor-contenido"><center>' + content + '</center></div>'
			}
			
			jQuery.fancybox({
				title: title,
				content: '<div class="modalbox-contenedor ' + ((identificador != '') ? 'modalbox-' + identificador : '') + '">' + content + '</div>', 
				maxWidth: width,
				height: 'auto',
				autoSize: true,
				autoHeight: true,
				autoCenter: true,
				helpers: {
					overlay: {
						locked: false
					}
				}
			});
		},
		loader: function(accion, tipo){		
			if(typeof(accion) === 'undefined') accion = 'show';
			if(typeof(tipo) === 'undefined') tipo = 'inline';	
			
			elemento = jQuery(document);
			
			if(tipo == 'top'){			
				if(accion == 'hide'){
					jQuery('body').find('#top-loader').fadeOut(100, function(){
						jQuery(this).remove();
					})
				}
				else{
					jQuery('body').find('#top-loader').remove();
					
					jQuery('body').append('\
						<div id="top-loader" class="ui-loader-overlay">\
							<svg class="ui-loader" width="35px" height="35px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">\
								<circle class="ui-loader-spinner" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>\
							</svg>\
						</div>\
					')
					.find('#top-loader')
					.css({
						'height': 'auto',
						'left': ((jQuery(document).width() / 2) - 38)+'px',
						'padding': '20px',
						'position': 'fixed',
						'top': '50%',
						'width': 'auto'
					}).hide().fadeIn(200);	
				}
			}
			else{
				if(accion == 'hide'){
					elemento.find('.loader').remove();
				}
				else{
					elemento.html('\
						<div class="loader">\
							<svg class="ui-loader" width="35px" height="35px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">\
								<circle class="ui-loader-spinner" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>\
							</svg>\
						</div>\
					').show();
				}
			}
		}
	});
});