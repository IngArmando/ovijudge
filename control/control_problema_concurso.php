<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/problema_concurso.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_concurso=$_POST["cod_concurso"];
	$cod_problema=$_POST["cod_problema"];
	$nombre_corto=$_POST["nombre_corto"];
	$puntos=$_POST["puntos"];
	$permitir_envio=$_POST["permitir_envio"];
	$permitir_juez=$_POST["permitir_juez"];
	$color=$_POST["color"];
	$lenta_eval_resultado=$_POST["lenta_eval_resultado"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$problema_concurso = new vista_problema_concurso;
		
		$problema_concurso->set_cod_concurso($cod_concurso);
		$problema_concurso->set_cod_problema($cod_problema);
		$problema_concurso->set_nombre_corto($nombre_corto);
		$problema_concurso->set_puntos($puntos);
		$problema_concurso->set_permitir_envio($permitir_envio);
		$problema_concurso->set_permitir_juez($permitir_juez);
		$problema_concurso->set_color($color);
		$problema_concurso->set_lenta_eval_resultado($lenta_eval_resultado);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$problema_concurso->registrar_bitacora("Consulta detallada","Problemas del concurso");
			$html_todo=$problema_concurso->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$problema_concurso->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$problema_concurso->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($problema_concurso->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$problema_concurso->registrar_bitacora("Registro","Problemas del concurso con Nro. Unico: ".$problema_concurso->ultimo_id());
			}
			
			$html_todo=$problema_concurso->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($problema_concurso->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$problema_concurso->registrar_bitacora("Modifico","Problemas del concurso Nro. ".$cod_concurso);
			}
			$html_todo=$problema_concurso->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($problema_concurso->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$problema_concurso->registrar_bitacora("Desactivo","Problemas del concurso Nro. ".$cod_concurso);
			}
			$html_todo=$problema_concurso->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($problema_concurso->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$problema_concurso->registrar_bitacora("Activo","Problemas del concurso Nro. ".$cod_concurso);
			}
			$html_todo=$problema_concurso->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($problema_concurso->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$problema_concurso->registrar_bitacora("Elimino","Problemas del concurso Nro. ".$cod_concurso);
			}
			$html_todo=$problema_concurso->reporte_html_general($vista);
		}
		break;
		default:{
			$problema_concurso->registrar_bitacora("Listo","Problemas del concurso");
			$html_todo=$problema_concurso->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		