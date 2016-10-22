<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/vista_sistema.php");
	//METODOS DE ENTRADA
	$evento 		=$_POST["evento"].$_GET["evento"];
	$cod_vista_sistema	=$_POST["cod_vista_sistema"];
	$nombre			=$_POST["nombre"];
	$descripcion	=$_POST["descripcion"];
	$cod_servicio	=$_POST["cod_servicio"];
	$tipo_apertura	=$_POST['tipo_apertura'];
	$registrar	=$_POST['registrar'];
	$eliminar	=$_POST['eliminar'];
	$consultar	=$_POST['consultar'];
	$actualizar	=$_POST['actualizar'];
	$desactivar	=$_POST['desactivar'];
	$visible	=$_POST['visible'];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$vista_sistema = new vista_sistema_b;
	$vista_sistema->set_cod_vista_sistema($cod_vista_sistema);
	$vista_sistema->set_nombre($nombre);
	$vista_sistema->set_descripcion($descripcion);
	$vista_sistema->set_cod_servicio($cod_servicio);
	$vista_sistema->set_tipo_apertura($tipo_apertura);
	$vista_sistema->set_registrar($registrar);	
	$vista_sistema->set_consultar($consultar);
	$vista_sistema->set_eliminar($eliminar);
	$vista_sistema->set_actualizar($actualizar);
	$vista_sistema->set_desactivar($desactivar);
	$vista_sistema->set_visible($visible);
	
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$html_todo=$vista_sistema->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$vista_sistema->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$vista_sistema->formulario('registrar');
		}
		break;
		case 'registrar':{
			$vista_sistema->set_estatus(1);
			if($vista_sistema->registrar()==1){
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$vista_sistema = new vista_sistema_b;
			}
			$html_todo=$vista_sistema->formulario('registrar');
		}
		break;
		case 'modificar':{
			$vista_sistema->modificar();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$vista_sistema->formulario('modificar');
		}
		break;
		case 'desactivar':{
			$vista_sistema->desactivar();
			$_SESSION['msj']='Registro desactivado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$vista_sistema->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$vista_sistema->activar();
			$_SESSION['msj']='Registro activado';
			$_SESSION['msj_tipo']='warning';
			$html_todo=$vista_sistema->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$vista_sistema->eliminar();
			$_SESSION['msj']='Eliminado correctamente.';
			$_SESSION['msj_tipo']='success';
			$html_todo=$vista_sistema->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$vista_sistema->reporte_html_general($vista);
		}
		break;
	}
?>
		
