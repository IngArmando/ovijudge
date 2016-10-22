<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/rankcache_publico.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_concurso=$_POST["cod_concurso"];
	$cod_equipo=$_POST["cod_equipo"];
	$puntos=$_POST["puntos"];
	$tiempo_total=$_POST["tiempo_total"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$rankcache_publico = new vista_rankcache_publico;
		
		$rankcache_publico->set_cod_concurso($cod_concurso);
		$rankcache_publico->set_cod_equipo($cod_equipo);
		$rankcache_publico->set_puntos($puntos);
		$rankcache_publico->set_tiempo_total($tiempo_total);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$rankcache_publico->registrar_bitacora("Consulta detallada","Ranking cache de Publicos");
			$html_todo=$rankcache_publico->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$rankcache_publico->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$rankcache_publico->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($rankcache_publico->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$rankcache_publico->registrar_bitacora("Registro","Ranking cache de Publicos con Nro. Unico: ".$rankcache_publico->ultimo_id());
			}
			
			$html_todo=$rankcache_publico->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($rankcache_publico->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$rankcache_publico->registrar_bitacora("Modifico","Ranking cache de Publicos Nro. ".$cod_concurso);
			}
			$html_todo=$rankcache_publico->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($rankcache_publico->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$rankcache_publico->registrar_bitacora("Desactivo","Ranking cache de Publicos Nro. ".$cod_concurso);
			}
			$html_todo=$rankcache_publico->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($rankcache_publico->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$rankcache_publico->registrar_bitacora("Activo","Ranking cache de Publicos Nro. ".$cod_concurso);
			}
			$html_todo=$rankcache_publico->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($rankcache_publico->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$rankcache_publico->registrar_bitacora("Elimino","Ranking cache de Publicos Nro. ".$cod_concurso);
			}
			$html_todo=$rankcache_publico->reporte_html_general($vista);
		}
		break;
		default:{
			$rankcache_publico->registrar_bitacora("Listo","Ranking cache de Publicos");
			$html_todo=$rankcache_publico->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		