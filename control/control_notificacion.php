<?php
require_once("modelo/class_notificacion.php");
$notificacion = new notificacion;
$evento = $_REQUEST['evento'];
$cod_notificacion=$_REQUEST['cod_notificacion'];
$notificacion->set_cedula($_SESSION['cedula']);
switch($evento){
	case "eliminar":{
		$notificacion->set_cod_notificacion($cod_notificacion);
		$notificacion->desactivar();
		
		
	}
	default:{
		$notificacion->set_cedula($_SESSION['cedula']);
		
		if($notificacion->consulta_por('cedula')>0){
			while($row_notificacion=$notificacion->row()){
				$tr.='<tr '.($row_notificacion['estatus']==0 ? 'class="success"' : '').' ><td>'.$row_notificacion['fecha'].'</td><td><a href="?vista='.$row_notificacion['url'].'">'.$row_notificacion['mensaje'].'</a></td><td><a href="?vista=notificacion&cod_notificacion='.$row_notificacion['cod_notificacion'].'&evento=eliminar" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
				}
				
		}else{
			$tr.='<tr><td colspan="3" style="text-align:center">Actualmente no tiene notificaciones.</td></tr>';	
		}
			$html.='<table class="table table-striped"><tr><td>Fecha y hora</td><td>Mensaje</td><td></td></tr>'.$tr.'</table>';
		
		}
		$notificacion->visto();
	
	
	}
?>
