
	$(function() {
						//$("#cod_municipio").lemez_aceptar("todo","registrar,modificar");
					$("#nombre").lemez_aceptar("texto_numero","");
						

	});
	function msj_eliminar(){
	return confirm("Esta seguro de eliminar este registro?");
}
	$(function(){
		$(".municipio").hide();
		
	});
	function cambiar_municipio(a){
		$(".municipio").hide();
		document.getElementById("cod_municipio").selectedIndex=0;
		$(".municipio_"+a.value).show();
}

