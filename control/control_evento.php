<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/evento.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_evento=$_POST["cod_evento"];
	$tiempo=$_POST["tiempo"];
	$cod_concurso=$_POST["cod_concurso"];
	$cod_clarificacion=$_POST["cod_clarificacion"];
	$cod_lenguaje_prog=$_POST["cod_lenguaje_prog"];
	$cod_problema=$_POST["cod_problema"];
	$cod_envio=$_POST["cod_envio"];
	$cod_juzgar=$_POST["cod_juzgar"];
	$cod_equipo=$_POST["cod_equipo"];
	$descripcion=$_POST["descripcion"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$evento = new vista_evento;
		
		$evento->set_cod_evento($cod_evento);
		$evento->set_tiempo($tiempo);
		$evento->set_cod_concurso($cod_concurso);
		$evento->set_cod_clarificacion($cod_clarificacion);
		$evento->set_cod_lenguaje_prog($cod_lenguaje_prog);
		$evento->set_cod_problema($cod_problema);
		$evento->set_cod_envio($cod_envio);
		$evento->set_cod_juzgar($cod_juzgar);
		$evento->set_cod_equipo($cod_equipo);
		$evento->set_descripcion($descripcion);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$evento->registrar_bitacora("Consulta detallada","Eventos del Concurso");
			$html_todo=$evento->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$evento->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$evento->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($evento->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$evento->registrar_bitacora("Registro","Eventos del Concurso con Nro. Unico: ".$evento->ultimo_id());
			}
			
			$html_todo=$evento->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($evento->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$evento->registrar_bitacora("Modifico","Eventos del Concurso Nro. ".$cod_evento);
			}
			$html_todo=$evento->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($evento->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$evento->registrar_bitacora("Desactivo","Eventos del Concurso Nro. ".$cod_evento);
			}
			$html_todo=$evento->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($evento->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$evento->registrar_bitacora("Activo","Eventos del Concurso Nro. ".$cod_evento);
			}
			$html_todo=$evento->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($evento->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$evento->registrar_bitacora("Elimino","Eventos del Concurso Nro. ".$cod_evento);
			}
			$html_todo=$evento->reporte_html_general($vista);
		}
		break;
		default:{
			$evento->registrar_bitacora("Listo","Eventos del Concurso");
			$html_todo=$evento->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		