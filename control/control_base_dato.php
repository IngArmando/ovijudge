<?php
	require_once("vista/base_dato.php");
	require_once("modelo/class_db.php");
	$db = new db;
	$base_dato= new base_dato;
	$evento = 	$_REQUEST["evento"];
	$directorio="archivos/respaldo/";
	$archivo=$_POST['archivo'];

	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'respaldo':{
			//$output=shell_exec("C:\AppServ\MySQL\bin\mysqldump.exe -u webmasterscity -p18671986 ovi")
			$ficheros  = scandir($directorio,SCANDIR_SORT_DESCENDING);
			$nro=count($ficheros);
			$nombre_archivo=$directorio.$nro."_db_".date("d-m-Y_h:i:s_A_").rand(10000,99999).".sql.gz";
			$output=shell_exec("/usr/bin/mysqldump -u ".$db->usuario." -p".$db->password." ".$db->db." | gzip > ".$nombre_archivo);
			if(file_exists($nombre_archivo)){
				$_SESSION['msj_tipo']='success';
				$_SESSION['msj']='Respaldo creado correctamente';				
			 }else{
				$_SESSION['msj_tipo']='danger';
				$_SESSION['msj']='Error al crear el respaldo';			  
			}
			$html_todo=$base_dato->formulario_respaldo();
		}
		break;
		case 'restaurar':{
			$nombre_archivo=$directorio.$archivo;
			passthru("gunzip -c ".$nombre_archivo." | mysql -u ".$db->usuario." -p".$db->password." ".$db->db,$error);
			
			if($error){
				$_SESSION['msj_tipo']='danger';
				$_SESSION['msj']='Error al restaurar: '.$output;				
			}else{	
				$_SESSION['msj_tipo']='success';
				$_SESSION['msj']='Respaldo restaurado correctamente';			
			}
		$html_todo=$base_dato->formulario_respaldo();
					
		}
		break;
		default:{
			$html_todo=$base_dato->formulario_respaldo();
			}
	}
?>
		
