$(function () {
	$("#tiempo_inicio").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A'
		});
	$("#tiempo_conjelacion").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A'		
	});
	$("#tiempo_desconjelar").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A'
		
	});
	$("#tiempo_final").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A'
	});
	$("#tiempo_inactivo").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A'	
		
	});
   
});
   function validar(){
	   tiempo_inicio=$('#tiempo_inicio').data("DateTimePicker").date();
	   tiempo_conjelacion=$('#tiempo_conjelacion').data("DateTimePicker").date();
	   tiempo_final=$('#tiempo_final').data("DateTimePicker").date();
	   tiempo_desconjelar=$('#tiempo_desconjelar').data("DateTimePicker").date();
	   tiempo_inactivo=$('#tiempo_inactivo').data("DateTimePicker").date();

		if(tiempo_inicio>=tiempo_conjelacion || tiempo_conjelacion>=tiempo_final || tiempo_final>=tiempo_desconjelar || tiempo_desconjelar>=tiempo_inactivo){
			alert('Error en las fechas y horas, por favor verifiquelas e intente de nuevo.');
			return false;
			}
	   
	}
