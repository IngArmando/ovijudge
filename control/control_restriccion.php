<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/restriccion.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_restriccion=$_POST["cod_restriccion"];
	$nombre=$_POST["nombre"];
	$restricciones=$_POST["restricciones"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$restriccion = new vista_restriccion;
		
		$restriccion->set_cod_restriccion($cod_restriccion);
		$restriccion->set_nombre($nombre);
		$restriccion->set_restricciones($restricciones);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$restriccion->registrar_bitacora("Consulta detallada","Restricciones del Servidor");
			$html_todo=$restriccion->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$restriccion->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$restriccion->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($restriccion->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$restriccion->registrar_bitacora("Registro","Restricciones del Servidor con Nro. Unico: ".$restriccion->ultimo_id());
			}
			
			$html_todo=$restriccion->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($restriccion->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$restriccion->registrar_bitacora("Modifico","Restricciones del Servidor Nro. ".$cod_restriccion);
			}
			$html_todo=$restriccion->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($restriccion->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$restriccion->registrar_bitacora("Desactivo","Restricciones del Servidor Nro. ".$cod_restriccion);
			}
			$html_todo=$restriccion->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($restriccion->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$restriccion->registrar_bitacora("Activo","Restricciones del Servidor Nro. ".$cod_restriccion);
			}
			$html_todo=$restriccion->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($restriccion->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$restriccion->registrar_bitacora("Elimino","Restricciones del Servidor Nro. ".$cod_restriccion);
			}
			$html_todo=$restriccion->reporte_html_general($vista);
		}
		break;
		default:{
			$restriccion->registrar_bitacora("Listo","Restricciones del Servidor");
			$html_todo=$restriccion->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		