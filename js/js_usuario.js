
	$(function() {
						$("#cedula").lemez_aceptar("numero","");
						$("#nombre").lemez_aceptar("texto","");
						//$("#cod_tipo_usuario").lemez_aceptar("todo","registrar,modificar");
						$("#apellido").lemez_aceptar("texto","");
						//$("#correo").lemez_aceptar("correo","");
						$("#telefono_movil").lemez_aceptar("numero","");
						$("#telefono_fijo").lemez_aceptar("numero","");
						//$("#fecha_nacimiento").lemez_aceptar("fecha","registrar,modificar");
						//$("#clave").lemez_aceptar("contrasena","registrar,modificar");
						//$("#con_clave").lemez_aceptar("contrasena","registrar,modificar");
						//$("#cod_cargo").lemez_aceptar("todo","registrar,modificar");
						
						$("#fecha_nacimiento").datepicker({
													maxDate: "-14Y",
						 changeMonth: true,
						changeYear: true
							});
				$( "#correo" ).blur(function() {
					verificar_correo(correo);
				});
		//$('registrar').disabled();

	});
		function verificar_cedula(cedula) { 
			$.get( "control/control_ajax.php?evento=verificar_usuario&cedula="+nacionalidad_cedula.value+"-"+cedula.value, function( data ) {
			if(data>0){
				alert("Disculpe la cedula ya se encuentra en uso, intente nuevamente, si olvido su contraseña haga clic en ayuda.");
				cedula.value="";
				cedula.focus();
				}
			});	
		} 
		
		function verificar_correo(correo){
			
			$.get( "control/control_ajax.php?evento=verificar_correo&correo="+correo.value, function( data ) {
				if(data>0){
					alert("Disculpe este correo ya esta en uso, si tiene algun inconveniente por favor contacte al administrador.");
					correo.value="";
					correo.focus();
				}
			});
		}
		function verificar_cedula_funcionario(cedula) { 
			nombre = document.getElementById("nombre");
			apellido=document.getElementById("apellido");
			fecha_nacimiento=document.getElementById("fecha_nacimiento");
			correo=document.getElementById("correo");
			sexo=document.getElementById("sexo_masculino");
			var arreglo;
			$.get( "control/control_ajax.php?evento=verificar_funcionario&cedula="+cedula.value, function( data ) {
			if(data!=""){
				arreglo=JSON.parse(data);
				nombre.value=arreglo['nombres'];
				apellido.value=arreglo['apellidos'];
				fecha_nacimiento.value=arreglo['fecha_nac'];
				correo.value=arreglo['correo'];
				telefono_movil.value=arreglo['tlf'];
				sexo.checked=true;
				
				}else{
					alert("Disculpe usted no es funcionario.")
					cedula.value="";
				nombre.value='';
				apellido.value='';
				fecha_nacimiento.value='';
				correo.value='';
				telefono_movil.value='';
					}
			});	
		} 
function msj_eliminar(){
	return confirm("Esta seguro de eliminar este registro?");
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

