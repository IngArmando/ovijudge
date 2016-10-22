<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/configuracion.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_configuracion=$_POST["cod_configuracion"];
	$nombre=$_POST["nombre"];
	$valor=$_POST["valor"];
	$tipo=$_POST["tipo"];
	$descripcion=$_POST["descripcion"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$configuracion = new vista_configuracion;
		
		$configuracion->set_cod_configuracion($cod_configuracion);
		$configuracion->set_nombre($nombre);
		$configuracion->set_valor($valor);
		$configuracion->set_tipo($tipo);
		$configuracion->set_descripcion($descripcion);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$configuracion->registrar_bitacora("Consulta detallada","Configuracion del Juez");
			$html_todo=$configuracion->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$configuracion->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$configuracion->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($configuracion->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$configuracion->registrar_bitacora("Registro","Configuracion del Juez con Nro. Unico: ".$configuracion->ultimo_id());
			}
			
			$html_todo=$configuracion->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($configuracion->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$configuracion->registrar_bitacora("Modifico","Configuracion del Juez Nro. ".$cod_configuracion);
			}
			$html_todo=$configuracion->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($configuracion->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$configuracion->registrar_bitacora("Desactivo","Configuracion del Juez Nro. ".$cod_configuracion);
			}
			$html_todo=$configuracion->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($configuracion->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$configuracion->registrar_bitacora("Activo","Configuracion del Juez Nro. ".$cod_configuracion);
			}
			$html_todo=$configuracion->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($configuracion->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$configuracion->registrar_bitacora("Elimino","Configuracion del Juez Nro. ".$cod_configuracion);
			}
			$html_todo=$configuracion->reporte_html_general($vista);
		}
		break;
		default:{
			$configuracion->registrar_bitacora("Listo","Configuracion del Juez");
			$html_todo=$configuracion->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		