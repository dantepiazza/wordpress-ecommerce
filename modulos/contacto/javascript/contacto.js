jQuery(document).ready(function($){
	$(document).delegate("#inspector-select-control-0", "change", function(){
		if($(this).val() == "plantilla-contacto.php"){
			$("#meta-contacto-informacion").show();
		}
		else{
			$("#meta-contacto-informacion").hide();
		}
	});
	
	$(window).load(function(){
		$("#inspector-select-control-0").trigger('change');
	});
});