<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/det_equipo_clarificacion.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_equipo=$_POST["cod_equipo"];
	$cod_clarificacion=$_POST["cod_clarificacion"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$det_equipo_clarificacion = new vista_det_equipo_clarificacion;
		
		$det_equipo_clarificacion->set_cod_equipo($cod_equipo);
		$det_equipo_clarificacion->set_cod_clarificacion($cod_clarificacion);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$det_equipo_clarificacion->registrar_bitacora("Consulta detallada","Detalle equipo clarificación");
			$html_todo=$det_equipo_clarificacion->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$det_equipo_clarificacion->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$det_equipo_clarificacion->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($det_equipo_clarificacion->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$det_equipo_clarificacion->registrar_bitacora("Registro","Detalle equipo clarificación con Nro. Unico: ".$det_equipo_clarificacion->ultimo_id());
			}
			
			$html_todo=$det_equipo_clarificacion->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($det_equipo_clarificacion->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$det_equipo_clarificacion->registrar_bitacora("Modifico","Detalle equipo clarificación Nro. ".$cod_equipo);
			}
			$html_todo=$det_equipo_clarificacion->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($det_equipo_clarificacion->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$det_equipo_clarificacion->registrar_bitacora("Desactivo","Detalle equipo clarificación Nro. ".$cod_equipo);
			}
			$html_todo=$det_equipo_clarificacion->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($det_equipo_clarificacion->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$det_equipo_clarificacion->registrar_bitacora("Activo","Detalle equipo clarificación Nro. ".$cod_equipo);
			}
			$html_todo=$det_equipo_clarificacion->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($det_equipo_clarificacion->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$det_equipo_clarificacion->registrar_bitacora("Elimino","Detalle equipo clarificación Nro. ".$cod_equipo);
			}
			$html_todo=$det_equipo_clarificacion->reporte_html_general($vista);
		}
		break;
		default:{
			$det_equipo_clarificacion->registrar_bitacora("Listo","Detalle equipo clarificación");
			$html_todo=$det_equipo_clarificacion->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		