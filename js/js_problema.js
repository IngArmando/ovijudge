	var cod_caso_de_prueba=0;
	function agregar_fila(input,output,descripcion,ejemplo) {
		
		var tabla=document.getElementById("tabla_detalle");
		var row = tabla.insertRow(1);
		row.id='fila_'+cod_caso_de_prueba;
		
		var celda1 = row.insertCell(0);
		var celda2 = row.insertCell(1);
		var celda3 = row.insertCell(2);
		var celda4 = row.insertCell(3);
		var celda5 = row.insertCell(4);
		celda4.style.textAlign = "center";
		
		celda1.innerHTML="<textarea style='min-height:100px' required class='form-control' name='input["+cod_caso_de_prueba+"]' >"+input+"</textarea>";
		celda2.innerHTML="<textarea style='min-height:100px' required class='form-control' name='output["+cod_caso_de_prueba+"]' >"+output+"</textarea>";
		celda3.innerHTML="<textarea style='min-height:100px' class='form-control' name='descripcion["+cod_caso_de_prueba+"]' >"+descripcion+"</textarea>";
		celda4.innerHTML="<input value='1' title='Caso de ejemplo' type='checkbox' name='ejemplo["+cod_caso_de_prueba+"]' "+(ejemplo==1 ? 'checked' : '')+" >";
		celda5.innerHTML="<button class='btn btn-danger btn-sm' onclick='return eliminar_fila(\""+cod_caso_de_prueba+"\")'> <span class='glyphicon glyphicon-minus'> </span> </button>";
		cod_caso_de_prueba++;
		return false;
	}

	function eliminar_fila(cod_caso_de_prueba) {
		nro_fila=document.getElementById("fila_"+cod_caso_de_prueba).rowIndex;
		document.getElementById("tabla_detalle").deleteRow(nro_fila);
		return false;
	}
