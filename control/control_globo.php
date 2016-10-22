<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/globo.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_globo=$_POST["cod_globo"];
	$cod_envio=$_POST["cod_envio"];
	$status=$_POST["status"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$globo = new vista_globo;
		
		$globo->set_cod_globo($cod_globo);
		$globo->set_cod_envio($cod_envio);
		$globo->set_status($status);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$globo->registrar_bitacora("Consulta detallada","Globos");
			$html_todo=$globo->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$globo->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$globo->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($globo->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$globo->registrar_bitacora("Registro","Globos con Nro. Unico: ".$globo->ultimo_id());
			}
			
			$html_todo=$globo->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($globo->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$globo->registrar_bitacora("Modifico","Globos Nro. ".$cod_globo);
			}
			$html_todo=$globo->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($globo->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$globo->registrar_bitacora("Desactivo","Globos Nro. ".$cod_globo);
			}
			$html_todo=$globo->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($globo->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$globo->registrar_bitacora("Activo","Globos Nro. ".$cod_globo);
			}
			$html_todo=$globo->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($globo->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$globo->registrar_bitacora("Elimino","Globos Nro. ".$cod_globo);
			}
			$html_todo=$globo->reporte_html_general($vista);
		}
		break;
		default:{
			$globo->registrar_bitacora("Listo","Globos");
			$html_todo=$globo->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		