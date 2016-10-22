<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/servidor.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$nombre_servidor=$_POST["nombre_servidor"];
	$active=$_POST["active"];
	$polltime=$_POST["polltime"];
	$cod_restriccion=$_POST["cod_restriccion"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$servidor = new vista_servidor;
		
		$servidor->set_nombre_servidor($nombre_servidor);
		$servidor->set_active($active);
		$servidor->set_polltime($polltime);
		$servidor->set_cod_restriccion($cod_restriccion);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$servidor->registrar_bitacora("Consulta detallada","Servidor");
			$html_todo=$servidor->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$servidor->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$servidor->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($servidor->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$servidor->registrar_bitacora("Registro","Servidor con Nro. Unico: ".$servidor->ultimo_id());
			}
			
			$html_todo=$servidor->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($servidor->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$servidor->registrar_bitacora("Modifico","Servidor Nro. ".$nombre_servidor);
			}
			$html_todo=$servidor->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($servidor->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$servidor->registrar_bitacora("Desactivo","Servidor Nro. ".$nombre_servidor);
			}
			$html_todo=$servidor->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($servidor->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$servidor->registrar_bitacora("Activo","Servidor Nro. ".$nombre_servidor);
			}
			$html_todo=$servidor->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($servidor->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$servidor->registrar_bitacora("Elimino","Servidor Nro. ".$nombre_servidor);
			}
			$html_todo=$servidor->reporte_html_general($vista);
		}
		break;
		default:{
			$servidor->registrar_bitacora("Listo","Servidor");
			$html_todo=$servidor->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		