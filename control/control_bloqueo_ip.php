<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/bloqueo_ip.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_bloqueo_ip=$_POST["cod_bloqueo_ip"];
	$ip=$_POST["ip"];
	$agente=$_POST["agente"];
	$fecha_hora=$_POST["fecha_hora"];
	$estatus=$_POST["estatus"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$bloqueo_ip = new vista_bloqueo_ip;
		
		$bloqueo_ip->set_cod_bloqueo_ip($cod_bloqueo_ip);
		$bloqueo_ip->set_ip($ip);
		$bloqueo_ip->set_agente($agente);
		$bloqueo_ip->set_fecha_hora($fecha_hora);
		$bloqueo_ip->set_estatus($estatus);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$bloqueo_ip->registrar_bitacora("Consulta detallada","Ip bloqueadas");
			$html_todo=$bloqueo_ip->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$bloqueo_ip->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$bloqueo_ip->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($bloqueo_ip->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$bloqueo_ip->registrar_bitacora("Registro","Ip bloqueadas con Nro. Unico: ".$bloqueo_ip->ultimo_id());
			}
			
			$html_todo=$bloqueo_ip->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($bloqueo_ip->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$bloqueo_ip->registrar_bitacora("Modifico","Ip bloqueadas Nro. ".$cod_bloqueo_ip);
			}
			$html_todo=$bloqueo_ip->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($bloqueo_ip->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$bloqueo_ip->registrar_bitacora("Desactivo","Ip bloqueadas Nro. ".$cod_bloqueo_ip);
			}
			$html_todo=$bloqueo_ip->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($bloqueo_ip->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$bloqueo_ip->registrar_bitacora("Activo","Ip bloqueadas Nro. ".$cod_bloqueo_ip);
			}
			$html_todo=$bloqueo_ip->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($bloqueo_ip->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$bloqueo_ip->registrar_bitacora("Elimino","Ip bloqueadas Nro. ".$cod_bloqueo_ip);
			}
			$html_todo=$bloqueo_ip->reporte_html_general($vista);
		}
		break;
		default:{
			$bloqueo_ip->registrar_bitacora("Listo","Ip bloqueadas");
			$html_todo=$bloqueo_ip->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		