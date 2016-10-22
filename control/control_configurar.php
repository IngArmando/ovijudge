<?php
require_once("modelo/class_configurar.php");
$evento=$_POST['evento'];
$configurar = new configurar;
$configurar->set_caducidad($_POST['caducidad']);
$configurar->set_intentos_fallidos($_POST['intentos_fallidos']);
$configurar->set_pregunta_crear($_POST['pregunta_crear']);
$configurar->set_pregunta_mostrar($_POST['pregunta_mostrar']);
$configurar->set_inactividad($_POST['inactividad']);
switch($evento){
	case 'editar' :{
		$configurar->editar();
		$_SESSION['msj_tipo']='success';
		$_SESSION['msj']='Actualizado correctamente.';
	}
	
}
			$configurar->consultar();
			$row_configurar=$configurar->row();
?>
