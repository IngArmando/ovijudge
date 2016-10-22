<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/juzgar.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_juzgar=$_POST["cod_juzgar"];
	$cod_concurso=$_POST["cod_concurso"];
	$cod_envio=$_POST["cod_envio"];
	$tiempo_inicio=$_POST["tiempo_inicio"];
	$tiempo_fin=$_POST["tiempo_fin"];
	$nombre_servidor=$_POST["nombre_servidor"];
	$resultado=$_POST["resultado"];
	$verificado=$_POST["verificado"];
	$nombre_jurado=$_POST["nombre_jurado"];
	$comentario=$_POST["comentario"];
	$valido=$_POST["valido"];
	$salida_compilacion=$_POST["salida_compilacion"];
	$visto_equipo=$_POST["visto_equipo"];
	$cod_rejuzgar=$_POST["cod_rejuzgar"];
	$pre_cod_juzgar=$_POST["pre_cod_juzgar"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$juzgar = new vista_juzgar;
		
		$juzgar->set_cod_juzgar($cod_juzgar);
		$juzgar->set_cod_concurso($cod_concurso);
		$juzgar->set_cod_envio($cod_envio);
		$juzgar->set_tiempo_inicio($tiempo_inicio);
		$juzgar->set_tiempo_fin($tiempo_fin);
		$juzgar->set_nombre_servidor($nombre_servidor);
		$juzgar->set_resultado($resultado);
		$juzgar->set_verificado($verificado);
		$juzgar->set_nombre_jurado($nombre_jurado);
		$juzgar->set_comentario($comentario);
		$juzgar->set_valido($valido);
		$juzgar->set_salida_compilacion($salida_compilacion);
		$juzgar->set_visto_equipo($visto_equipo);
		$juzgar->set_cod_rejuzgar($cod_rejuzgar);
		$juzgar->set_pre_cod_juzgar($pre_cod_juzgar);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$juzgar->registrar_bitacora("Consulta detallada","Resultados de los envios");
			$html_todo=$juzgar->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$juzgar->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$juzgar->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($juzgar->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$juzgar->registrar_bitacora("Registro","Resultados de los envios con Nro. Unico: ".$juzgar->ultimo_id());
			}
			
			$html_todo=$juzgar->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($juzgar->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$juzgar->registrar_bitacora("Modifico","Resultados de los envios Nro. ".$cod_juzgar);
			}
			$html_todo=$juzgar->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($juzgar->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$juzgar->registrar_bitacora("Desactivo","Resultados de los envios Nro. ".$cod_juzgar);
			}
			$html_todo=$juzgar->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($juzgar->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$juzgar->registrar_bitacora("Activo","Resultados de los envios Nro. ".$cod_juzgar);
			}
			$html_todo=$juzgar->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($juzgar->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$juzgar->registrar_bitacora("Elimino","Resultados de los envios Nro. ".$cod_juzgar);
			}
			$html_todo=$juzgar->reporte_html_general($vista);
		}
		break;
		default:{
			$juzgar->registrar_bitacora("Listo","Resultados de los envios");
			$html_todo=$juzgar->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		