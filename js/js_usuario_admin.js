
	$(function() {
						$("#cedula").lemez_aceptar("numero","");
						$("#nombre").lemez_aceptar("texto","");
						$("#apellido").lemez_aceptar("texto","");
						$("#telefono_movil").lemez_aceptar("numero","");
						$("#telefono_fijo").lemez_aceptar("numero","");
						$("#fecha_nacimiento").datepicker({
													maxDate: "-14Y",
						 changeMonth: true,
						changeYear: true
							});
				$( "#correo" ).blur(function() {
					verificar_correo_excluyendo_usuario(correo);
				});
				

	});
	
		function verificar_correo(correo){
			
			$.get( "control/control_ajax.php?evento=verificar_correo&correo="+correo.value, function( data ) {
				if(data>0){
					alert("Disculpe este correo ya esta en uso, si tiene algun inconveniente por favor contacte al administrador.");
					correo.value="";
					correo.focus();
				}
			});
		}
		
		function verificar_correo_excluyendo_usuario(correo){
			cedula=$("#cedula").val();
			nacionalidad=$("#nacionalidad_cedula").val();
			cedula=nacionalidad+'-'+cedula;
			$.get( "control/control_ajax.php?evento=verificar_correo_excluyendo_usuario&correo="+correo.value+"&cedula="+cedula, function( data ) {
				if(data>0){
					alert("Disculpe este correo ya esta en uso, si tiene algun inconveniente por favor contacte al administrador.");
					correo.value="";
					correo.focus();
				}
			});
		}

		
		function cambiar_cedula_combo_cedula(valor){
			nacionalidad=document.getElementById("nacionalidad_cedula");
			boton=document.getElementById("button_cedula");
			nacionalidad.value=valor;
			boton.innerHTML=valor;
		}
	
	$(function(){
		$(".municipios").hide();
		$(".parroquias").hide();
		
	});
	function cambiar_municipio(a){
		
		$(".municipios").hide();
		$(".parroquias").hide();
		document.getElementById("cam_cod_municipio").selectedIndex=0;
		document.getElementById("cam_cod_parroquia").selectedIndex=0;
		$(".estado_"+a.value).show();
		}
	function cambiar_parroquias(a){
		
		$(".parroquias").hide();
		document.getElementById("cam_cod_parroquia").selectedIndex=0;
		$(".municipios_"+a.value).show();
		
		}
		function verificar_cedula(cedula) { 
			$.get( "control/control_ajax.php?evento=verificar_usuario&cedula="+nacionalidad_cedula.value+"-"+cedula.value, function( data ) {
			if(data>0){
				alert("Disculpe la cedula ya se encuentra en uso, intente nuevamente, si olvido su contraseña haga clic en ayuda.");
				cedula.value="";
				cedula.focus();
				}
			});	
		} 
	$(function() {
	$("#data_table").dataTable({
	"scrollX": true
	});
	});

