<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/det_concurso_equipo.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_concurso=$_POST["cod_concurso"];
	$cod_equipo=$_POST["cod_equipo"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$det_concurso_equipo = new vista_det_concurso_equipo;
		
		$det_concurso_equipo->set_cod_concurso($cod_concurso);
		$det_concurso_equipo->set_cod_equipo($cod_equipo);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$det_concurso_equipo->registrar_bitacora("Consulta detallada","Detalle concurso equipo");
			$html_todo=$det_concurso_equipo->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$det_concurso_equipo->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$det_concurso_equipo->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($det_concurso_equipo->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$det_concurso_equipo->registrar_bitacora("Registro","Detalle concurso equipo con Nro. Unico: ".$det_concurso_equipo->ultimo_id());
			}
			
			$html_todo=$det_concurso_equipo->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($det_concurso_equipo->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$det_concurso_equipo->registrar_bitacora("Modifico","Detalle concurso equipo Nro. ".$cod_concurso);
			}
			$html_todo=$det_concurso_equipo->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($det_concurso_equipo->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$det_concurso_equipo->registrar_bitacora("Desactivo","Detalle concurso equipo Nro. ".$cod_concurso);
			}
			$html_todo=$det_concurso_equipo->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($det_concurso_equipo->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$det_concurso_equipo->registrar_bitacora("Activo","Detalle concurso equipo Nro. ".$cod_concurso);
			}
			$html_todo=$det_concurso_equipo->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($det_concurso_equipo->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$det_concurso_equipo->registrar_bitacora("Elimino","Detalle concurso equipo Nro. ".$cod_concurso);
			}
			$html_todo=$det_concurso_equipo->reporte_html_general($vista);
		}
		break;
		default:{
			$det_concurso_equipo->registrar_bitacora("Listo","Detalle concurso equipo");
			$html_todo=$det_concurso_equipo->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		