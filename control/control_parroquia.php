<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/parroquia.php");
	//METODOS DE ENTRADA
	$evento 		=$_REQUEST["evento"];
	
	$cod_parroquia	=$_POST["cod_parroquia"];
	$cod_municipio		=$_POST["cod_municipio"];
	$nombre			=$_POST["nombre"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$parroquia= new vista_parroquia;
	
	$parroquia->set_cod_parroquia($cod_parroquia);
	$parroquia->set_nombre($nombre);
	$parroquia->set_cod_municipio($cod_municipio);
	
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$html_todo=$parroquia->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$parroquia->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$parroquia->formulario('registrar');
		}
		break;
		case 'registrar':{
			$parroquia->registrar();
			$_SESSION['msj']='Registrado correctamente';
			$_SESSION['msj_tipo']='success';
			$parroquia= new vista_parroquia;
			$html_todo=$parroquia->formulario('registrar');
		}
		break;
		case 'modificar':{
			$parroquia->modificar();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$parroquia->formulario('modificar');
		}
		break;
		case 'desactivar':{
			$parroquia->desactivar();
			$_SESSION['msj']='Registro desactivado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$parroquia->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$parroquia->activar();
			$_SESSION['msj']='Registro activado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$parroquia->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$parroquia->eliminar();
			$_SESSION['msj']='Eliminado correctamente.';
			$_SESSION['msj_tipo']='success';
			$html_todo=$parroquia->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$parroquia->reporte_html_general($vista);
		}
		break;
}
		?>
		
