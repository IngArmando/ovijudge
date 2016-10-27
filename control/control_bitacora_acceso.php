<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/bitacora.php");
	$vista_bitacora= new vista_bitacora;
	$vista_bitacora->tipo_bitacora="acceso";
	$vista_bitacora->titulo="Bitacora de acceso";
	$vista_bitacora->vista_regresar="bitacora_acceso";
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"];
	if($_POST["nacionalidad_cedula"]){
		$cedula=$_POST["nacionalidad_cedula"]."-".$_POST["cedula"];
	}else{
		$cedula=$_POST["cedula"];
	}
	$cod_usuario = $_POST['cod_usuario'];
	$fecha_inicio	=$_POST["fecha_inicio"];
	$fecha_fin		=$_POST["fecha_fin"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$vista_bitacora->set_cedula($cedula);
	$vista_bitacora->set_cod_usuario($cod_usuario);
	//MANEJADOR DE EVENTOS
	switch($evento){
		case "listar":{
			$html_todo=$vista_bitacora->reporte_html_general($fecha_inicio,$fecha_fin);
			}
		break;
		default:{
			$html_todo=$vista_bitacora->buscar();
		}
}
		?>
		
