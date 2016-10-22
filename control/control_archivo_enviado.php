<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/archivo_enviado.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_archivo_enviado=$_POST["cod_archivo_enviado"];
	$cod_envio=$_POST["cod_envio"];
	$codigo_fuente=$_POST["codigo_fuente"];
	$archivo_nombre=$_POST["archivo_nombre"];
	$rank=$_POST["rank"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$archivo_enviado = new vista_archivo_enviado;
		
		$archivo_enviado->set_cod_archivo_enviado($cod_archivo_enviado);
		$archivo_enviado->set_cod_envio($cod_envio);
		$archivo_enviado->set_codigo_fuente($codigo_fuente);
		$archivo_enviado->set_archivo_nombre($archivo_nombre);
		$archivo_enviado->set_rank($rank);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$archivo_enviado->registrar_bitacora("Consulta detallada","Archivos Enviados");
			$html_todo=$archivo_enviado->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$archivo_enviado->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$archivo_enviado->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($archivo_enviado->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$archivo_enviado->registrar_bitacora("Registro","Archivos Enviados con Nro. Unico: ".$archivo_enviado->ultimo_id());
			}
			
			$html_todo=$archivo_enviado->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($archivo_enviado->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$archivo_enviado->registrar_bitacora("Modifico","Archivos Enviados Nro. ".$cod_archivo_enviado);
			}
			$html_todo=$archivo_enviado->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($archivo_enviado->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$archivo_enviado->registrar_bitacora("Desactivo","Archivos Enviados Nro. ".$cod_archivo_enviado);
			}
			$html_todo=$archivo_enviado->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($archivo_enviado->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$archivo_enviado->registrar_bitacora("Activo","Archivos Enviados Nro. ".$cod_archivo_enviado);
			}
			$html_todo=$archivo_enviado->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($archivo_enviado->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$archivo_enviado->registrar_bitacora("Elimino","Archivos Enviados Nro. ".$cod_archivo_enviado);
			}
			$html_todo=$archivo_enviado->reporte_html_general($vista);
		}
		break;
		default:{
			$archivo_enviado->registrar_bitacora("Listo","Archivos Enviados");
			$html_todo=$archivo_enviado->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		