<?php
$clave=$_POST['clave_administrador'];
$nacionalidad=$_POST['nacionalidad'];
$cedula=$_POST['cedula'];
$evento=$_POST['evento'];
$clave_nueva=$cedula;
require_once("modelo/class_usuario.php");
$usuario = new usuario;
$usuario->set_clave($clave);
$usuario->set_cod_usuario($_SESSION['cod_usuario']);
switch($evento){
	case "cambiar":{
		
		if($usuario->verificar()>0){
			
			$usuario->set_cedula($nacionalidad.'-'.$cedula);
			$usuario->set_clave($clave_nueva);
			if($usuario->cambiar_clave_por_cedula()>0){
				$_SESSION['msj_tipo']="success";
				$_SESSION['msj']="La contraseña ha sido reseteada por el numero de cedula exitosamente.";
				$_SESSION['redireccion']="index.php";
			}else{
				$_SESSION['msj_tipo']="danger";
				$_SESSION['msj']="Su contraseña no ha sido reseteada, es posible que el usuario no exista.";
				$_SESSION['redireccion']="index.php";				
				
				}
			
		}else{
			$_SESSION['msj_tipo']="danger";
			$_SESSION['msj']="Contraseña de administrador no valida, intente de nuevo.";	
		}
	}
break;
}
?>
