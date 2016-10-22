<?php
$con_clave		=$_POST['con_clave'];
$clave_actual	=$_POST['clave_actual'];
$clave			=$_POST['clave'];
$cod_usuario	=$_SESSION['cod_usuario'];
$evento			=$_POST['evento'];
require_once("vista/cambiar_pass.php");
$cambiar_pass = new cambiar_pass;
$cambiar_pass->set_clave($clave_actual);
$cambiar_pass->set_cod_usuario($cod_usuario);
switch($evento){
	case "cambiar":{
		if($cambiar_pass->verificar()>0){
			$cambiar_pass->set_clave($clave);
			if($cambiar_pass->consultar_historial()>0){
				$_SESSION['msj_tipo']="danger";
				$_SESSION['msj']="Disculpe su contraseña debe ser diferente a las anteriormente utilizadas, intente de nuevo.";					
				$cambiar_pass = new cambiar_pass;
				$html_todo=$cambiar_pass->formulario_cambiar_clave();
			}else{
				$cambiar_pass->cambiar_clave();
				$_SESSION['msj_tipo']="success";
				$_SESSION['msj']="Su contraseña ha sido cambiada exitosamente.";
				$_SESSION['redireccion']="index.php";
			}
		}else{
			$_SESSION['msj_tipo']="danger";
			$_SESSION['msj']="Su contraseña actual no es valida, intente de nuevo.";	
			$cambiar_pass = new cambiar_pass;
			$html_todo=$cambiar_pass->formulario_cambiar_clave();
		}
	}
	break;
	default:  {
		$html_todo=$cambiar_pass->formulario_cambiar_clave();
	}
}
?>
