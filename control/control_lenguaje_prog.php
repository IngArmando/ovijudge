<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/lenguaje_prog.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_lenguaje_prog=$_POST["cod_lenguaje_prog"];
	$comando=$_POST["comando"];
	$nombre=$_POST["nombre"];
	$extensiones=$_POST["extensiones"];
	$permitir_envio=1;
	$permitir_juez=1;
	$factor_tiempo=$_POST["factor_tiempo"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$lenguaje_prog = new vista_lenguaje_prog;
		$lenguaje_prog->set_cod_lenguaje_prog($cod_lenguaje_prog);
		$lenguaje_prog->set_comando($comando);
		$lenguaje_prog->set_nombre($nombre);
		$lenguaje_prog->set_extensiones($extensiones);
		$lenguaje_prog->set_factor_tiempo($factor_tiempo);		
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$lenguaje_prog->registrar_bitacora("Consulta detallada","lenguajes de programación");
			$html_todo=$lenguaje_prog->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$lenguaje_prog->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$lenguaje_prog->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($lenguaje_prog->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$lenguaje_prog->registrar_bitacora("Registro","lenguajes de programación con Nro. Unico: ".$lenguaje_prog->ultimo_id());
				$lenguaje_prog = new vista_lenguaje_prog;
			}
			
			$html_todo=$lenguaje_prog->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($lenguaje_prog->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$lenguaje_prog->registrar_bitacora("Modifico","lenguajes de programación Nro. ".$cod_lenguaje_prog);
			}
			$html_todo=$lenguaje_prog->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($lenguaje_prog->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$lenguaje_prog->registrar_bitacora("Desactivo","lenguajes de programación Nro. ".$cod_lenguaje_prog);
			}
			$html_todo=$lenguaje_prog->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($lenguaje_prog->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$lenguaje_prog->registrar_bitacora("Activo","lenguajes de programación Nro. ".$cod_lenguaje_prog);
			}
			$html_todo=$lenguaje_prog->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($lenguaje_prog->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$lenguaje_prog->registrar_bitacora("Elimino","lenguajes de programación Nro. ".$cod_lenguaje_prog);
			}
			$html_todo=$lenguaje_prog->reporte_html_general($vista);
		}
		break;
		default:{
			$lenguaje_prog->registrar_bitacora("Listo","lenguajes de programación");
			$html_todo=$lenguaje_prog->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		
