<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/servicio.php");
	//METODOS DE ENTRADA
	$evento 		=$_REQUEST["evento"];
	
	$cod_servicio	=$_POST["cod_servicio"];
	$cod_modulo		=$_POST["cod_modulo"];
	$nombre			=$_POST["nombre"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$servicio= new vista_servicio;
	
	$servicio->set_cod_servicio($cod_servicio);
	$servicio->set_nombre($nombre);
	$servicio->set_cod_modulo($cod_modulo);
	
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$html_todo=$servicio->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$servicio->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$servicio->formulario('registrar');
		}
		break;
		case 'registrar':{
			$servicio->registrar();
			$_SESSION['msj']='Registrado correctamente';
			$_SESSION['msj_tipo']='success';
			$servicio= new vista_servicio;
			$html_todo=$servicio->formulario('registrar');
		}
		break;
		case 'modificar':{
			$servicio->modificar();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$servicio->formulario('modificar');
		}
		break;
		case 'desactivar':{
			$servicio->desactivar();
			$_SESSION['msj']='Registro desactivado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$servicio->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$servicio->activar();
			$_SESSION['msj']='Registro activado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$servicio->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$servicio->eliminar();
			$_SESSION['msj']='Eliminado correctamente.';
			$_SESSION['msj_tipo']='success';
			$html_todo=$servicio->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$servicio->reporte_html_general($vista);
		}
		break;
}
		?>
		
