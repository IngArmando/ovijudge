<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/compilacion.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_compilacion=$_POST["cod_compilacion"];
	$cod_juzgar=$_POST["cod_juzgar"];
	$cod_caso_de_prueba=$_POST["cod_caso_de_prueba"];
	$compilacion_resultado=$_POST["compilacion_resultado"];
	$compilacion_tiempo=$_POST["compilacion_tiempo"];
	$salida_compilacion=$_POST["salida_compilacion"];
	$salida_diferente=$_POST["salida_diferente"];
	$salida_error=$_POST["salida_error"];
	$salida_sistema=$_POST["salida_sistema"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$compilacion = new vista_compilacion;
		
		$compilacion->set_cod_compilacion($cod_compilacion);
		$compilacion->set_cod_juzgar($cod_juzgar);
		$compilacion->set_cod_caso_de_prueba($cod_caso_de_prueba);
		$compilacion->set_compilacion_resultado($compilacion_resultado);
		$compilacion->set_compilacion_tiempo($compilacion_tiempo);
		$compilacion->set_salida_compilacion($salida_compilacion);
		$compilacion->set_salida_diferente($salida_diferente);
		$compilacion->set_salida_error($salida_error);
		$compilacion->set_salida_sistema($salida_sistema);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$compilacion->registrar_bitacora("Consulta detallada","Compilaciones");
			$html_todo=$compilacion->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$compilacion->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$compilacion->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($compilacion->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$compilacion->registrar_bitacora("Registro","Compilaciones con Nro. Unico: ".$compilacion->ultimo_id());
			}
			
			$html_todo=$compilacion->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($compilacion->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$compilacion->registrar_bitacora("Modifico","Compilaciones Nro. ".$cod_compilacion);
			}
			$html_todo=$compilacion->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($compilacion->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$compilacion->registrar_bitacora("Desactivo","Compilaciones Nro. ".$cod_compilacion);
			}
			$html_todo=$compilacion->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($compilacion->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$compilacion->registrar_bitacora("Activo","Compilaciones Nro. ".$cod_compilacion);
			}
			$html_todo=$compilacion->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($compilacion->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$compilacion->registrar_bitacora("Elimino","Compilaciones Nro. ".$cod_compilacion);
			}
			$html_todo=$compilacion->reporte_html_general($vista);
		}
		break;
		default:{
			$compilacion->registrar_bitacora("Listo","Compilaciones");
			$html_todo=$compilacion->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		