<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/estado.php");
	//METODOS DE ENTRADA
	$evento 		=$_REQUEST["evento"];
	
	$cod_estado	=$_POST["cod_estado"];
	$cod_pais		=$_POST["cod_pais"];
	$nombre			=$_POST["nombre"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$estado= new vista_estado;
	
	$estado->set_cod_estado($cod_estado);
	$estado->set_nombre($nombre);
	$estado->set_cod_pais($cod_pais);
	
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$html_todo=$estado->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$estado->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$estado->formulario('registrar');
		}
		break;
		case 'registrar':{
			$estado->registrar();
			$_SESSION['msj']='Registrado correctamente';
			$_SESSION['msj_tipo']='success';
			$estado= new vista_estado;
			$html_todo=$estado->formulario('registrar');
		}
		break;
		case 'modificar':{
			$estado->modificar();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$estado->formulario('modificar');
		}
		break;
		case 'desactivar':{
			$estado->desactivar();
			$_SESSION['msj']='Registro desactivado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$estado->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$estado->activar();
			$_SESSION['msj']='Registro activado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$estado->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$estado->eliminar();
			$_SESSION['msj']='Eliminado correctamente.';
			$_SESSION['msj_tipo']='success';
			$html_todo=$estado->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$estado->reporte_html_general($vista);
		}
		break;
}
		?>
		
