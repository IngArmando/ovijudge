<?php
session_start();

$evento=$_REQUEST['evento'];
$nacionalidad=$_POST["nacionalidad"];
$cedula_pura=$_POST["cedula"];	
if($nacionalidad){
	$cedula=$nacionalidad."-".$cedula_pura;
}else{
	$cedula=$cedula_pura;
}
$quedan=verificar_intentos_fallidos($cedula);

switch($evento){
	case "acceder":{
	include_once("modelo/class_usuario.php");
	$usuario = new usuario;
	$usuario->set_cedula($cedula);
	$usuario->set_clave($_REQUEST["clave"]);
	if($usuario->verificar_estatus()==0){
		header("location:index.php");
		$_SESSION['msj_tipo']="danger";
		$_SESSION['msj']="Usuario Inactivo ó Bloqueado, por favor contacte al administrador.";
		$_SESSION['intentos']=0;
		exit();		
		}
	if($usuario->consulta_doble('cedula','clave')==0){
		$_SESSION['intentos']++;
		$quedan=verificar_intentos_fallidos($cedula);
		header("location:index.php");
		$_SESSION['msj_tipo']="danger";
		$_SESSION['msj']="Usuario y/o clave incorrecta, intente de nuevo, le quedan ".($quedan)." intentos";
		exit();
	}else{
		
		$row_usuario=$usuario->row();
		$usuario->set_cod_usuario($row_usuario['cod_usuario']);
		$_SESSION['login']			=true;
		$_SESSION['cod_usuario']	=$row_usuario['cod_usuario'];
		$_SESSION['cedula']			=$row_usuario['cedula'];
		$_SESSION['cod_tipo_usuario']=$row_usuario['cod_tipo_usuario'];
		$_SESSION['nombre_usuario']	=$row_usuario['nombre'];
		$_SESSION['apellido_usuario']=$row_usuario['apellido'];
		$_SESSION['nombre_tipo_usuario']=$row_usuario['nombre_tipo_usuario'];
		$_SESSION['ultima_visita']	=date("d-m-Y",strtotime($row_usuario['ultima_actividad']));
		$usuario->actualizar_entrada();
		generar_privilegios($_SESSION['cod_tipo_usuario']);
		$usuario->set_cod_tipo_usuario($_SESSION['cod_tipo_usuario']);
		$_SESSION['intentos']=0;
		$usuario->registrar_bitacora("Entrada","El usuario a entrado al sistema correctamente. con la ip: ".getUserIP());
		}
		$_SESSION['texto_btn_session']="Cerrar Sesión";
	}
	break;
	case "salir":{
		$usuario = new usuario;
		$usuario->registrar_bitacora("Salida","El usuario a salido del sistema correctamente. con la ip: ".getUserIP());
		salir_sistema();
	}
	break;
}
	
function salir_sistema(){
	
			$_SESSION['login']=false;
			session_destroy();
			$_SESSION['msj_tipo']="success";
			$_SESSION['msj']="Hasta pronto.";
			$_SESSION['login']=false;
			header("location:index.php");
			exit();	
	}


?>
