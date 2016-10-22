<?php
	require_once("vista/pregunta_seguridad.php");
	$vista_pregunta_seguridad = new vista_pregunta_seguridad;
	
	$cedula=$_SESSION['cedula'];
	$pregunta	=$_POST['pregunta'];
	$respuesta	=$_POST['respuesta'];
	$evento		=$_POST['evento'];
	
	$vista_pregunta_seguridad->set_cedula($cedula);
	$vista_pregunta_seguridad->set_pregunta($pregunta);
	$vista_pregunta_seguridad->set_respuesta($respuesta);
	
	switch($evento){
		case 'registrar': {
			$vista_pregunta_seguridad->registrar();
			$_SESSION['msj']='Registrado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$vista_pregunta_seguridad->formulario('modificar');
		}break;
		case 'modificar':{
			$vista_pregunta_seguridad->modificar();
			$_SESSION['msj']='Modificado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$vista_pregunta_seguridad->formulario('modificar');
		}break;
		default:{
			if($vista_pregunta_seguridad->consultar()==0){
				$html_todo=$vista_pregunta_seguridad->formulario('registrar');
			}else{
				$html_todo=$vista_pregunta_seguridad->formulario('modificar');
			}
		}
		
		
	}

?>
