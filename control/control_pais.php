<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/pais.php");
	//METODOS DE ENTRADA
	$evento 		=$_REQUEST["evento"];
	$cod_pais		=$_POST["cod_pais"];
	$nombre			=$_POST["nombre"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$pais			= new vista_pais;
	$pais->set_cod_pais($cod_pais);
	$pais->set_nombre($nombre);	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$html_todo=$pais->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$pais->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$pais->formulario('registrar');
			
		}
		break;
		case 'registrar':{
			$pais->registrar();
			$_SESSION['msj']='Registrado correctamente';
			$_SESSION['msj_tipo']='success';
			$pais			= new vista_pais;
			$html_todo=$pais->formulario('registrar');
		}
		break;
		case 'modificar':{
			$pais->modificar();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$pais->formulario('modificar');
		}
		break;
		case 'desactivar':{
			$pais->desactivar();
			$_SESSION['msj']='Registro desactivado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$pais->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$pais->activar();
			$_SESSION['msj']='Registro activado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$pais->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$pais->eliminar();
			$_SESSION['msj']='Eliminado correctamente.';
			$_SESSION['msj_tipo']='success';
			$html_todo=$pais->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$pais->reporte_html_general($vista);
		}
		break;
}
		?>
		
