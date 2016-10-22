<?php
ini_set("display_errors","OFF");
error_reporting(E_ALL ^E_NOTICE ^E_DEPRECATED);
session_start();
require_once("../libreria/funciones_generales.php");
require_once("../modelo/class_db.php");
$evento			=filter_var($_GET['evento'], FILTER_SANITIZE_STRING);
$correo			=filter_var($_GET['correo'], FILTER_SANITIZE_STRING);
$cedula			=filter_var($_GET['cedula'], FILTER_SANITIZE_STRING);
$numero			=filter_var($_GET['numero'], FILTER_SANITIZE_NUMBER_INT);
$cod_usuario	=filter_var($_GET['cod_usuario'], FILTER_SANITIZE_NUMBER_INT);
$cod_envio_entrenamiento=filter_var($_GET['cod_envio_entrenamiento'], FILTER_SANITIZE_NUMBER_INT);
$cod_envio		=filter_var($_GET['cod_envio'], FILTER_SANITIZE_NUMBER_INT);
$cod_equipo		=filter_var($_GET['cod_equipo'], FILTER_SANITIZE_NUMBER_INT);
$tipo			=filter_var($_GET['tipo']);
$like			=filter_var($_GET['q'], FILTER_SANITIZE_STRING);
$cod_problema	=filter_var($_GET['cod_problema'], FILTER_SANITIZE_NUMBER_INT);
$db = new db;
switch($evento){
		case "verificar_correo":{
			$res=$db->ejecutar("SELECT correo FROM persona WHERE correo='$correo'");
			if($res>0){
				echo 1;
				}
			}
			break;
		case "verificar_correo_excluyendo_usuario":{
			$res=$db->ejecutar("SELECT correo FROM persona WHERE correo='$correo' and cedula<>'$cedula'");
			if($res>0){
				echo 1;
				}
			}
			break;
		case "verificar_correo_con_datos":{
			$res=$db->ejecutar("SELECT * FROM persona WHERE correo='$correo' and cedula<>'$cedula'");
			if($res>0){
				$row=$db->row();
				echo json_encode($row);
				}
			}
			break;
		case "verificar_envio_entrenamiento":{
			$res=$db->ejecutar("SELECT *  FROM  envio_entrenamiento e
			INNER JOIN msj_salida m USING(cod_msj_salida)
			WHERE e.cod_usuario='$cod_usuario' and e.cod_envio_entrenamiento='$cod_envio_entrenamiento'");
			if($res>0){
				$row=$db->row();
				echo json_encode($row);
				}
			}
			break;
		case "verificar_envio":{
			$res=$db->ejecutar("SELECT e.*, m.msj  FROM envio e
			INNER JOIN msj_salida m USING(cod_msj_salida)
			WHERE e.cod_equipo='$cod_equipo' and e.cod_envio='$cod_envio'");
			if($res>0){
				$row=$db->row();
					$res=$db->ejecutar("SELECT e.*, m.msj  FROM envio e
					INNER JOIN msj_salida m USING(cod_msj_salida)
					INNER JOIN concurso c USING(cod_concurso)
					WHERE e.cod_equipo='$cod_equipo' and e.cod_envio='$cod_envio' AND ((e.fecha_hora>c.tiempo_conjelacion AND NOW()>c.tiempo_desconjelar) OR e.fecha_hora<c.tiempo_conjelacion)");
					if($res==0){
						$row['cod_msj_salida']='999';
						$row['msj']='RESULTADO CONGELADO';
					}
					echo json_encode($row);
				}
			}
			break;
		case "verificar_cedula":{
			$res=$db->ejecutar("SELECT correo FROM persona WHERE cedula='$cedula'");
			if($res>0){
				echo 1;
				}
			}
			break;
		case "verificar_usuario":{
			$res=$db->ejecutar("SELECT * FROM usuario WHERE cedula='$cedula'");
			if($res>0){
				echo 1;
				}
			}
			break;
		case "listar_problemas":{
			$res=$db->ejecutar("SELECT cod_problema as id,nombre as name FROM problema WHERE nombre LIKE '%".$like."%' OR cod_problema='".$like."'");
			if($res>0){
				$rows = array();
				while($row=$db->row()){
					 $rows[] = $row;		
					}
					$listado=json_encode($rows);
					print($listado);
				}
			}
			break;
		case "listar_usuarios":{
			$res=$db->ejecutar("SELECT cod_usuario as id,CONCAT(nombre,' ',apellido) as name, apellido, nombre, cedula FROM usuario INNER JOIN persona USING (cedula) WHERE cod_usuario NOT IN (SELECT cod_usuario from det_usuario_equipo) AND (nombre LIKE '%".$like."%' OR apellido LIKE '%".$like."%' OR cedula LIKE '%".$like."%')");
			if($res>0){
				$rows = array();
				while($row=$db->row()){
					 $rows[] = $row;		
					}
					$listado=json_encode($rows);
					print($listado);
				}
			}
			break;
		case "extender_tiempo":{
			if(consultar_inactividad_control_ajax()==1){
				echo 1;
			}else{
				$db->ejecutar("UPDATE usuario SET ultima_actividad=NOW() WHERE cod_usuario='".$_SESSION['cod_usuario']."'");
			}
		}
			break;
	}
	
?>
