<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/ejecutable.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_ejecutable=$_POST["cod_ejecutable"].$_GET["cod_ejecutable"];
	$md5sum=$_POST["md5sum"];
	$zipfile=$_FILES["zipfile"];
	$descripcion=$_POST["descripcion"];
	$tipo=$_POST["tipo"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$ejecutable = new vista_ejecutable;
		
		$ejecutable->set_cod_ejecutable($cod_ejecutable);
		$ejecutable->set_md5sum($md5sum);
		$ejecutable->set_zipfile($zipfile);
		$ejecutable->set_descripcion($descripcion);
		$ejecutable->set_tipo($tipo);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$ejecutable->registrar_bitacora("Consulta detallada","Ejecutable");
			$html_todo=$ejecutable->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$ejecutable->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$ejecutable->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($ejecutable->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$ejecutable->registrar_bitacora("Registro","Ejecutable con Nro. Unico: ".$ejecutable->ultimo_id());
			}
			
			$html_todo=$ejecutable->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($ejecutable->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$ejecutable->registrar_bitacora("Modifico","Ejecutable Nro. ".$cod_ejecutable);
			}
			$html_todo=$ejecutable->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($ejecutable->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$ejecutable->registrar_bitacora("Desactivo","Ejecutable Nro. ".$cod_ejecutable);
			}
			$html_todo=$ejecutable->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($ejecutable->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$ejecutable->registrar_bitacora("Activo","Ejecutable Nro. ".$cod_ejecutable);
			}
			$html_todo=$ejecutable->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($ejecutable->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$ejecutable->registrar_bitacora("Elimino","Ejecutable Nro. ".$cod_ejecutable);
			}
			$html_todo=$ejecutable->reporte_html_general($vista);
		}
		break;
		case 'exportar':{
			echo exportar_ejecutable($cod_ejecutable);
		}break;
		default:{
			$ejecutable->registrar_bitacora("Listo","Ejecutable");
			$html_todo=$ejecutable->reporte_html_general($vista);
			
		}
		break;
	};
	
	function exportar_ejecutable($cod_ejecutable){
		$db = new db;
		$filename = $cod_ejecutable . ".zip";

		$db->ejecutar("SELECT OCTET_LENGTH(zipfile) as size FROM ejecutable WHERE cod_ejecutable = '".$cod_ejecutable."'");
		$row=$db->row();
		$size =$row['size'];

		// sanity check before we start to output headers
		if ( $size===NULL || !is_numeric($size) ) {
			$_SESSION['msj_tipo']='danger';
			$_SESSION['msj']='Problema en el ciclo ejecutable';
		}
		header("Content-Type: application/zip; name=\"$filename\"");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Length: $size");
		$db->ejecutar("SELECT SQL_NO_CACHE zipfile FROM ejecutable WHERE cod_ejecutable='".$cod_ejecutable."'");
		$row=$db->row();
		return $row['zipfile'];
		exit();		
		
	}
		?>
