<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/clarificacion.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_clarificacion=$_POST["cod_clarificacion"];
	$cod_concurso=$_POST["cod_concurso"];
	$resp_cod_clarificacion=$_POST["resp_cod_clarificacion"];
	$tiempo_envio=$_POST["tiempo_envio"];
	$remitiente=$_POST["remitiente"];
	$receptor=$_POST["receptor"];
	$nombre_jurado=$_POST["nombre_jurado"];
	$cod_problema=$_POST["cod_problema"];
	$categoria=$_POST["categoria"];
	$cuerpo_msj=$_POST["cuerpo_msj"];
	$respuesta=$_POST["respuesta"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$clarificacion = new vista_clarificacion;
		
		$clarificacion->set_cod_clarificacion($cod_clarificacion);
		$clarificacion->set_cod_concurso($cod_concurso);
		$clarificacion->set_resp_cod_clarificacion($resp_cod_clarificacion);
		$clarificacion->set_tiempo_envio($tiempo_envio);
		$clarificacion->set_remitiente($remitiente);
		$clarificacion->set_receptor($receptor);
		$clarificacion->set_nombre_jurado($nombre_jurado);
		$clarificacion->set_cod_problema($cod_problema);
		$clarificacion->set_categoria($categoria);
		$clarificacion->set_cuerpo_msj($cuerpo_msj);
		$clarificacion->set_respuesta($respuesta);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$clarificacion->registrar_bitacora("Consulta detallada","Clarificaciones");
			$html_todo=$clarificacion->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$clarificacion->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$clarificacion->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($clarificacion->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$clarificacion->registrar_bitacora("Registro","Clarificaciones con Nro. Unico: ".$clarificacion->ultimo_id());
			}
			
			$html_todo=$clarificacion->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($clarificacion->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$clarificacion->registrar_bitacora("Modifico","Clarificaciones Nro. ".$cod_clarificacion);
			}
			$html_todo=$clarificacion->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($clarificacion->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$clarificacion->registrar_bitacora("Desactivo","Clarificaciones Nro. ".$cod_clarificacion);
			}
			$html_todo=$clarificacion->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($clarificacion->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$clarificacion->registrar_bitacora("Activo","Clarificaciones Nro. ".$cod_clarificacion);
			}
			$html_todo=$clarificacion->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($clarificacion->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$clarificacion->registrar_bitacora("Elimino","Clarificaciones Nro. ".$cod_clarificacion);
			}
			$html_todo=$clarificacion->reporte_html_general($vista);
		}
		break;
		default:{
			$clarificacion->registrar_bitacora("Listo","Clarificaciones");
			$html_todo=$clarificacion->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		