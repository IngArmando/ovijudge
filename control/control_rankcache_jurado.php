<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/rankcache_jurado.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_concurso=$_POST["cod_concurso"];
	$cod_equipo=$_POST["cod_equipo"];
	$puntos=$_POST["puntos"];
	$total_tiempo=$_POST["total_tiempo"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$rankcache_jurado = new vista_rankcache_jurado;
		
		$rankcache_jurado->set_cod_concurso($cod_concurso);
		$rankcache_jurado->set_cod_equipo($cod_equipo);
		$rankcache_jurado->set_puntos($puntos);
		$rankcache_jurado->set_total_tiempo($total_tiempo);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$rankcache_jurado->registrar_bitacora("Consulta detallada","Ranking cache de jurados");
			$html_todo=$rankcache_jurado->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$rankcache_jurado->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$rankcache_jurado->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($rankcache_jurado->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$rankcache_jurado->registrar_bitacora("Registro","Ranking cache de jurados con Nro. Unico: ".$rankcache_jurado->ultimo_id());
			}
			
			$html_todo=$rankcache_jurado->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($rankcache_jurado->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$rankcache_jurado->registrar_bitacora("Modifico","Ranking cache de jurados Nro. ".$cod_concurso);
			}
			$html_todo=$rankcache_jurado->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($rankcache_jurado->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$rankcache_jurado->registrar_bitacora("Desactivo","Ranking cache de jurados Nro. ".$cod_concurso);
			}
			$html_todo=$rankcache_jurado->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($rankcache_jurado->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$rankcache_jurado->registrar_bitacora("Activo","Ranking cache de jurados Nro. ".$cod_concurso);
			}
			$html_todo=$rankcache_jurado->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($rankcache_jurado->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$rankcache_jurado->registrar_bitacora("Elimino","Ranking cache de jurados Nro. ".$cod_concurso);
			}
			$html_todo=$rankcache_jurado->reporte_html_general($vista);
		}
		break;
		default:{
			$rankcache_jurado->registrar_bitacora("Listo","Ranking cache de jurados");
			$html_todo=$rankcache_jurado->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		