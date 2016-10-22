<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/institucion.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_institucion=$_POST["cod_institucion"];
	$nombre_corto=$_POST["nombre_corto"];
	$nombre=$_POST["nombre"];
	$cod_pais=$_POST["cod_pais"];
	$descripcion=$_POST["descripcion"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$institucion = new vista_institucion;
		
		$institucion->set_cod_institucion($cod_institucion);
		$institucion->set_nombre_corto($nombre_corto);
		$institucion->set_nombre($nombre);
		$institucion->set_cod_pais($cod_pais);
		$institucion->set_descripcion($descripcion);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$institucion->registrar_bitacora("Consulta detallada","Afiliación");
			$html_todo=$institucion->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$institucion->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$institucion->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($institucion->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$institucion->registrar_bitacora("Registro","Afiliación con Nro. Unico: ".$institucion->ultimo_id());
				$institucion = new vista_institucion;
			}
			
			$html_todo=$institucion->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($institucion->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$institucion->registrar_bitacora("Modifico","Afiliación Nro. ".$cod_institucion);
			}
			$html_todo=$institucion->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($institucion->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$institucion->registrar_bitacora("Desactivo","Afiliación Nro. ".$cod_institucion);
			}
			$html_todo=$institucion->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($institucion->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$institucion->registrar_bitacora("Activo","Afiliación Nro. ".$cod_institucion);
			}
			$html_todo=$institucion->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($institucion->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$institucion->registrar_bitacora("Elimino","Afiliación Nro. ".$cod_institucion);
			}
			$html_todo=$institucion->reporte_html_general($vista);
		}
		break;
		default:{
			$institucion->registrar_bitacora("Listo","Afiliación");
			$html_todo=$institucion->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		
