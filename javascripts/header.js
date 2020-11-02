jQuery(document).ready(function(){
	jQuery(".fancybox").fancybox();
	
	jQuery.fn.sidenavOpen = function(){		
		jQuery('.encabezado').prepend('<div class="ui-overlay"></div>').find('.ui-overlay').hide().show();
			
		jQuery('.encabezado-menu').css('left', -300).show().animate({
			left: 0
		}, 300);
		
		jQuery('body').find('.ui-overlay').click(function(){
			jQuery(document).sidenavClose();
		});
	};	
	
	jQuery.fn.sidenavClose = function(){		
		var posicion = parseInt(jQuery('.encabezado-menu').css('left'));
		
		if(posicion >= 0){
			jQuery('.encabezado').find('.ui-overlay').fadeOut(400, function(){
				jQuery(this).remove();
			});
			
			jQuery('.encabezado-menu').animate({
				left: -300
			}, 300, function(){
				jQuery(this).hide();
			});
		}
	};
	
	jQuery(document).delegate('[id=boton-menu]', 'click', function(event){
		var menu = jQuery('body').find('.encabezado-menu');

		if(menu.is(":visible")){
			jQuery(document).sidenavClose();
		}
		else{			
			jQuery(document).sidenavOpen();
		}
	});
	
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 100) {
			jQuery('.scrollup').fadeIn();
		} else {
			jQuery('.scrollup').fadeOut();
		}
	});
	
	jQuery('.scrollup').click(function(){
		jQuery('html, body').animate({scrollTop : 0}, 500);
		return false;
	});
});