
	$(function() {
						$("#titulo").lemez_aceptar("texto_numero","registrar,modificar");
						
						$("#fecha_expiracion").lemez_aceptar("fecha","registrar,modificar");
						$("#fecha_expiracion").datepicker({
							minDate: new Date
							});

	});
