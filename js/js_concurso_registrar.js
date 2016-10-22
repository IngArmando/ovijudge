$(function () {
	var intervalo=5;
	fecha=new Date();
	$("#tiempo_inicio").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A',
		minDate:fecha.setMinutes(fecha.getMinutes()+intervalo)
		});
	$("#tiempo_conjelacion").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A',
		minDate:fecha.setMinutes(fecha.getMinutes()+intervalo)		
	});

	$("#tiempo_final").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A',
		minDate:fecha.setMinutes(fecha.getMinutes()+intervalo)
	});
	$("#tiempo_desconjelar").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A',
		minDate:fecha.setMinutes(fecha.getMinutes()+intervalo)
		
	});
	$("#tiempo_inactivo").datetimepicker({
		locale:'es',
		format: 'DD-MM-YYYY hh:mm A',
		minDate:fecha.setMinutes(fecha.getMinutes()+intervalo)		
		
	});

    

     $("#tiempo_inicio").on("dp.change", function (e) {
		fecha=new Date(e.date);
		fecha.setMinutes(fecha.getMinutes()+intervalo);
         $('#tiempo_conjelacion').data("DateTimePicker").minDate(fecha);
      
        
    });
     $("#tiempo_conjelacion").on("dp.change", function (e) {
		fecha=new Date(e.date);
		fecha.setMinutes(fecha.getMinutes()+intervalo);
         $('#tiempo_final').data("DateTimePicker").minDate(fecha);

        
    });
     $("#tiempo_final").on("dp.change", function (e) {
		fecha=new Date(e.date);
		fecha.setMinutes(fecha.getMinutes()+intervalo);
        $('#tiempo_desconjelar').data("DateTimePicker").minDate(fecha);
        
    });
     $("#tiempo_desconjelar").on("dp.change", function (e) {
		fecha=new Date(e.date);
		fecha.setMinutes(fecha.getMinutes()+intervalo);
         $('#tiempo_inactivo').data("DateTimePicker").minDate(fecha);
    });
		
		


});

   function validar(){
	   tiempo_inicio=new Date($('#tiempo_inicio').data("DateTimePicker").date());
	   tiempo_conjelacion=new Date($('#tiempo_conjelacion').data("DateTimePicker").date());
	   tiempo_final=new Date($('#tiempo_final').data("DateTimePicker").date());
	   tiempo_desconjelar=new Date($('#tiempo_desconjelar').data("DateTimePicker").date());
	   tiempo_inactivo=new Date($('#tiempo_inactivo').data("DateTimePicker").date());

		if(tiempo_inicio>=tiempo_conjelacion || tiempo_conjelacion>=tiempo_final || tiempo_final>=tiempo_desconjelar || tiempo_desconjelar>=tiempo_inactivo){
			alert('Error en las fechas y horas, por favor verifiquelas e intente de nuevo.');
			return false;
			}
	   
	}
