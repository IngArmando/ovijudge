<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/modulo.php");
	//METODOS DE ENTRADA
	$evento 		=$_REQUEST["evento"];
	$cod_modulo		=$_POST["cod_modulo"];
	$nombre			=$_POST["nombre"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$modulo			= new vista_modulo;
	$modulo->set_cod_modulo($cod_modulo);
	$modulo->set_nombre($nombre);	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$html_todo=$modulo->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$modulo->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$modulo->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($modulo->registrar()==1){
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$modulo			= new vista_modulo;
			}
			$html_todo=$modulo->formulario('registrar');
		}
		break;
		case 'modificar':{
			$modulo->modificar();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$modulo->formulario('modificar');
		}
		break;
		case 'desactivar':{
			$modulo->desactivar();
			$_SESSION['msj']='Registro desactivado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$modulo->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$modulo->activar();
			$_SESSION['msj']='Registro activado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$modulo->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$modulo->eliminar();
			$_SESSION['msj']='Eliminado correctamente.';
			$_SESSION['msj_tipo']='success';
			$html_todo=$modulo->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$modulo->reporte_html_general($vista);
		}
		break;
}
		?>
		
