<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/scorecache_publico.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_concurso=$_POST["cod_concurso"];
	$cod_equipo=$_POST["cod_equipo"];
	$cod_problema=$_POST["cod_problema"];
	$cant_envios=$_POST["cant_envios"];
	$pendiente=$_POST["pendiente"];
	$tiempo_total=$_POST["tiempo_total"];
	$status=$_POST["status"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$scorecache_publico = new vista_scorecache_publico;
		
		$scorecache_publico->set_cod_concurso($cod_concurso);
		$scorecache_publico->set_cod_equipo($cod_equipo);
		$scorecache_publico->set_cod_problema($cod_problema);
		$scorecache_publico->set_cant_envios($cant_envios);
		$scorecache_publico->set_pendiente($pendiente);
		$scorecache_publico->set_tiempo_total($tiempo_total);
		$scorecache_publico->set_status($status);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$scorecache_publico->registrar_bitacora("Consulta detallada","Score cache del publico");
			$html_todo=$scorecache_publico->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$scorecache_publico->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$scorecache_publico->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($scorecache_publico->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$scorecache_publico->registrar_bitacora("Registro","Score cache del publico con Nro. Unico: ".$scorecache_publico->ultimo_id());
			}
			
			$html_todo=$scorecache_publico->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($scorecache_publico->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$scorecache_publico->registrar_bitacora("Modifico","Score cache del publico Nro. ".$cod_concurso);
			}
			$html_todo=$scorecache_publico->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($scorecache_publico->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$scorecache_publico->registrar_bitacora("Desactivo","Score cache del publico Nro. ".$cod_concurso);
			}
			$html_todo=$scorecache_publico->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($scorecache_publico->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$scorecache_publico->registrar_bitacora("Activo","Score cache del publico Nro. ".$cod_concurso);
			}
			$html_todo=$scorecache_publico->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($scorecache_publico->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$scorecache_publico->registrar_bitacora("Elimino","Score cache del publico Nro. ".$cod_concurso);
			}
			$html_todo=$scorecache_publico->reporte_html_general($vista);
		}
		break;
		default:{
			$scorecache_publico->registrar_bitacora("Listo","Score cache del publico");
			$html_todo=$scorecache_publico->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		