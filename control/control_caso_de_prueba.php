<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/caso_de_prueba.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_caso_de_prueba=$_POST["cod_caso_de_prueba"];
	$md5sum_entrada=$_POST["md5sum_entrada"];
	$md5sum_salida=$_POST["md5sum_salida"];
	$entrada=$_POST["entrada"];
	$salida=$_POST["salida"];
	$cod_problema=$_POST["cod_problema"];
	$rank=$_POST["rank"];
	$descripcion=$_POST["descripcion"];
	$imagen=$_POST["imagen"];
	$imagen_peque=$_POST["imagen_peque"];
	$imagen_tipo=$_POST["imagen_tipo"];
	$ejemplo=$_POST["ejemplo"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$caso_de_prueba = new vista_caso_de_prueba;
		
		$caso_de_prueba->set_cod_caso_de_prueba($cod_caso_de_prueba);
		$caso_de_prueba->set_md5sum_entrada($md5sum_entrada);
		$caso_de_prueba->set_md5sum_salida($md5sum_salida);
		$caso_de_prueba->set_entrada($entrada);
		$caso_de_prueba->set_salida($salida);
		$caso_de_prueba->set_cod_problema($cod_problema);
		$caso_de_prueba->set_rank($rank);
		$caso_de_prueba->set_descripcion($descripcion);
		$caso_de_prueba->set_imagen($imagen);
		$caso_de_prueba->set_imagen_peque($imagen_peque);
		$caso_de_prueba->set_imagen_tipo($imagen_tipo);
		$caso_de_prueba->set_ejemplo($ejemplo);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$caso_de_prueba->registrar_bitacora("Consulta detallada","Casos de Prueba");
			$html_todo=$caso_de_prueba->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$caso_de_prueba->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$caso_de_prueba->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($caso_de_prueba->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$caso_de_prueba->registrar_bitacora("Registro","Casos de Prueba con Nro. Unico: ".$caso_de_prueba->ultimo_id());
			}
			
			$html_todo=$caso_de_prueba->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($caso_de_prueba->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$caso_de_prueba->registrar_bitacora("Modifico","Casos de Prueba Nro. ".$cod_caso_de_prueba);
			}
			$html_todo=$caso_de_prueba->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($caso_de_prueba->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$caso_de_prueba->registrar_bitacora("Desactivo","Casos de Prueba Nro. ".$cod_caso_de_prueba);
			}
			$html_todo=$caso_de_prueba->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($caso_de_prueba->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$caso_de_prueba->registrar_bitacora("Activo","Casos de Prueba Nro. ".$cod_caso_de_prueba);
			}
			$html_todo=$caso_de_prueba->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($caso_de_prueba->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$caso_de_prueba->registrar_bitacora("Elimino","Casos de Prueba Nro. ".$cod_caso_de_prueba);
			}
			$html_todo=$caso_de_prueba->reporte_html_general($vista);
		}
		break;
		default:{
			$caso_de_prueba->registrar_bitacora("Listo","Casos de Prueba");
			$html_todo=$caso_de_prueba->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		