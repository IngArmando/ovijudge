<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/envio.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_envio=$_POST["cod_envio"];
	$orig_envio=$_POST["orig_envio"];
	$cod_concurso=$_POST["cod_concurso"];
	$cod_equipo=$_POST["cod_equipo"];
	$cod_problema=$_POST["cod_problema"];
	$cod_lenguaje_prog=$_POST["cod_lenguaje_prog"];
	$tiempo_envio=$_POST["tiempo_envio"];
	$nombre_servidor=$_POST["nombre_servidor"];
	$valido=$_POST["valido"];
	$cod_rejuzgar=$_POST["cod_rejuzgar"];
	$expectativa_resultados=$_POST["expectativa_resultados"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$envio = new vista_envio;
		
		$envio->set_cod_envio($cod_envio);
		$envio->set_orig_envio($orig_envio);
		$envio->set_cod_concurso($cod_concurso);
		$envio->set_cod_equipo($cod_equipo);
		$envio->set_cod_problema($cod_problema);
		$envio->set_cod_lenguaje_prog($cod_lenguaje_prog);
		$envio->set_tiempo_envio($tiempo_envio);
		$envio->set_nombre_servidor($nombre_servidor);
		$envio->set_valido($valido);
		$envio->set_cod_rejuzgar($cod_rejuzgar);
		$envio->set_expectativa_resultados($expectativa_resultados);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$envio->registrar_bitacora("Consulta detallada","Envios");
			$html_todo=$envio->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$envio->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$envio->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($envio->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$envio->registrar_bitacora("Registro","Envios con Nro. Unico: ".$envio->ultimo_id());
			}
			
			$html_todo=$envio->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($envio->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$envio->registrar_bitacora("Modifico","Envios Nro. ".$cod_envio);
			}
			$html_todo=$envio->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($envio->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$envio->registrar_bitacora("Desactivo","Envios Nro. ".$cod_envio);
			}
			$html_todo=$envio->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($envio->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$envio->registrar_bitacora("Activo","Envios Nro. ".$cod_envio);
			}
			$html_todo=$envio->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($envio->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$envio->registrar_bitacora("Elimino","Envios Nro. ".$cod_envio);
			}
			$html_todo=$envio->reporte_html_general($vista);
		}
		break;
		default:{
			$envio->registrar_bitacora("Listo","Envios");
			$html_todo=$envio->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		