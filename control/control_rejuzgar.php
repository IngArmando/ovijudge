<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/rejuzgar.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_rejuzgar=$_POST["cod_rejuzgar"];
	$tiempo_inicio=$_POST["tiempo_inicio"];
	$tiempo_final=$_POST["tiempo_final"];
	$motivo=$_POST["motivo"];
	$valido=$_POST["valido"];
	$cod_usuario_inicio=$_POST["cod_usuario_inicio"];
	$cod_usuario_fin=$_POST["cod_usuario_fin"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$rejuzgar = new vista_rejuzgar;
		
		$rejuzgar->set_cod_rejuzgar($cod_rejuzgar);
		$rejuzgar->set_tiempo_inicio($tiempo_inicio);
		$rejuzgar->set_tiempo_final($tiempo_final);
		$rejuzgar->set_motivo($motivo);
		$rejuzgar->set_valido($valido);
		$rejuzgar->set_cod_usuario_inicio($cod_usuario_inicio);
		$rejuzgar->set_cod_usuario_fin($cod_usuario_fin);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$rejuzgar->registrar_bitacora("Consulta detallada","Grupo de reenvios");
			$html_todo=$rejuzgar->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$rejuzgar->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$rejuzgar->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($rejuzgar->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$rejuzgar->registrar_bitacora("Registro","Grupo de reenvios con Nro. Unico: ".$rejuzgar->ultimo_id());
			}
			
			$html_todo=$rejuzgar->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($rejuzgar->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$rejuzgar->registrar_bitacora("Modifico","Grupo de reenvios Nro. ".$cod_rejuzgar);
			}
			$html_todo=$rejuzgar->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($rejuzgar->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$rejuzgar->registrar_bitacora("Desactivo","Grupo de reenvios Nro. ".$cod_rejuzgar);
			}
			$html_todo=$rejuzgar->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($rejuzgar->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$rejuzgar->registrar_bitacora("Activo","Grupo de reenvios Nro. ".$cod_rejuzgar);
			}
			$html_todo=$rejuzgar->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($rejuzgar->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$rejuzgar->registrar_bitacora("Elimino","Grupo de reenvios Nro. ".$cod_rejuzgar);
			}
			$html_todo=$rejuzgar->reporte_html_general($vista);
		}
		break;
		default:{
			$rejuzgar->registrar_bitacora("Listo","Grupo de reenvios");
			$html_todo=$rejuzgar->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		