<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/historial_clave.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_historial_clave=$_POST["cod_historial_clave"];
	$clave=$_POST["clave"];
	$cod_usuario=$_POST["cod_usuario"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$historial_clave = new vista_historial_clave;
		
		$historial_clave->set_cod_historial_clave($cod_historial_clave);
		$historial_clave->set_clave($clave);
		$historial_clave->set_cod_usuario($cod_usuario);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$historial_clave->registrar_bitacora("Consulta detallada","Historial de claves");
			$html_todo=$historial_clave->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$historial_clave->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$historial_clave->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($historial_clave->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$historial_clave->registrar_bitacora("Registro","Historial de claves con Nro. Unico: ".$historial_clave->ultimo_id());
			}
			
			$html_todo=$historial_clave->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($historial_clave->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$historial_clave->registrar_bitacora("Modifico","Historial de claves Nro. ".$cod_historial_clave);
			}
			$html_todo=$historial_clave->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($historial_clave->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$historial_clave->registrar_bitacora("Desactivo","Historial de claves Nro. ".$cod_historial_clave);
			}
			$html_todo=$historial_clave->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($historial_clave->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$historial_clave->registrar_bitacora("Activo","Historial de claves Nro. ".$cod_historial_clave);
			}
			$html_todo=$historial_clave->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($historial_clave->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$historial_clave->registrar_bitacora("Elimino","Historial de claves Nro. ".$cod_historial_clave);
			}
			$html_todo=$historial_clave->reporte_html_general($vista);
		}
		break;
		default:{
			$historial_clave->registrar_bitacora("Listo","Historial de claves");
			$html_todo=$historial_clave->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		