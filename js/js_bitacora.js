			$(function(){
				$( "#fecha_inicio" ).datepicker({
					maxDate: new Date()
					});
				$( "#fecha_fin" ).datepicker({
					maxDate: new Date()
					});
				})
				
		 function comparar_fechas(){
				fecha_inicio=document.getElementById("fecha_inicio").value;
				fecha_fin=document.getElementById("fecha_fin").value;
				fecha_fin=fecha_fin.split("-");
				fecha_fin= new Date(fecha_fin[2],fecha_fin[1]-1,fecha_fin[0]);
				if(fecha_inicio){
				fecha_inicio=fecha_inicio.split("-");
				fecha_inicio= new Date(fecha_inicio[2],fecha_inicio[1]-1,fecha_inicio[0]);
				if(fecha_inicio>fecha_fin){
					alert("Disculpe, la fecha de inicio no puede ser mayor a la fecha final.");
					return false;
					}
				}
			 }
		function cambiar_cedula_combo_cedula(valor){
			nacionalidad=document.getElementById("nacionalidad_cedula");
			boton=document.getElementById("button_cedula");
			nacionalidad.value=valor;
			boton.innerHTML=valor;
		}
