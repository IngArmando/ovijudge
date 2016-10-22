function verificar_envio_entrenamiento(cod_envio,cod_usuario) { 
	$.get( "control/control_ajax.php?evento=verificar_envio_entrenamiento&cod_envio_entrenamiento="+cod_envio+"&cod_usuario="+cod_usuario, function( data ) {
		if(data!=""){
		row=JSON.parse(data);
		div_result=document.getElementById("div_result");
		switch(row['cod_msj_salida']){
				case '1': {resultado=row['msj']; color="green"}
				break;
				default: {resultado=row['msj']; color="red"}
				break;			
		}
		div_result.innerHTML="<span style=\"color:"+color+"; \" >"+resultado.toUpperCase()+"</span>";
		}
	});	
} 
function verificar_envio(cod_envio,cod_equipo) { 
	$.get( "control/control_ajax.php?evento=verificar_envio&cod_envio="+cod_envio+"&cod_equipo="+cod_equipo, function( data ) {
		if(data!=""){
		row=JSON.parse(data);
		div_result=document.getElementById("div_result");
		switch(row['cod_msj_salida']){
				case '1': {resultado=row['msj']; color="green"}
				break;
				case '999': {resultado=row['msj']; color="blue"}
				break;
				default: {resultado=row['msj']; color="red"}
				break;			
		}
		div_result.innerHTML="<span style=\"color:"+color+"; \" >"+resultado.toUpperCase()+"</span>";
		}
	});	
} 
