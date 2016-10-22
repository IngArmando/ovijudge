<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/municipio.php");
	//METODOS DE ENTRADA
	$evento 		=$_REQUEST["evento"];
	
	$cod_municipio	=$_POST["cod_municipio"];
	$cod_estado		=$_POST["cod_estado"];
	$nombre			=$_POST["nombre"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$municipio= new vista_municipio;
	
	$municipio->set_cod_municipio($cod_municipio);
	$municipio->set_nombre($nombre);
	$municipio->set_cod_estado($cod_estado);
	
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$html_todo=$municipio->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$municipio->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$municipio->formulario('registrar');
		}
		break;
		case 'registrar':{
			$municipio->registrar();
			$_SESSION['msj']='Registrado correctamente';
			$_SESSION['msj_tipo']='success';
			$municipio= new vista_municipio;
			$html_todo=$municipio->formulario('registrar');
		}
		break;
		case 'modificar':{
			$municipio->modificar();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$municipio->formulario('modificar');
		}
		break;
		case 'desactivar':{
			$municipio->desactivar();
			$_SESSION['msj']='Registro desactivado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$municipio->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$municipio->activar();
			$_SESSION['msj']='Registro activado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$municipio->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$municipio->eliminar();
			$_SESSION['msj']='Eliminado correctamente.';
			$_SESSION['msj_tipo']='success';
			$html_todo=$municipio->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$municipio->reporte_html_general($vista);
		}
		break;
}
		?>
		
