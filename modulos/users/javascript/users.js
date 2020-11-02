jQuery(document).ready(function($){
	$("#users-roles").change(function(){
		$("#users-roles-capas").find('input[type=checkbox]').prop("checked", false).parent().parent().removeClass('activo');
		$("#users-roles-nuevo").find('input[name=nombre]').val('');
		
		if($(this).val() == "nuevo"){
			$("#users-roles-nuevo").show();
		}
		else{
			var capas = $("option:selected", this).data('capas');
			
			$("#users-roles-nuevo").find('input[name=nombre]').val($("option:selected", this).text());
			
			$.each(capas, function(capa, valor) {
				if(valor == true){
					$("#users-roles-capas").find('#' + capa).prop("checked", true).parent().parent().addClass('activo');
				}
			});
			
			$("#users-roles-nuevo").hide();
		}
	});
	
	$("#users-roles").trigger('change');
	
	$("#users-roles-capas").find('input[type=checkbox]').click(function(){
		$(this).parent().parent().toggleClass('activo');
	});
});