<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/categoria.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_categoria=$_POST["cod_categoria"];
	$nombre=$_POST["nombre"];
	$ordenado=$_POST["ordenado"];
	$color=$_POST["color"];
	$status=$_POST["status"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$categoria = new vista_categoria;
		
		$categoria->set_cod_categoria($cod_categoria);
		$categoria->set_nombre($nombre);
		$categoria->set_ordenado($ordenado);
		$categoria->set_color($color);
		$categoria->set_status($status);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$categoria->registrar_bitacora("Consulta detallada","Categorias de Equipos");
			$html_todo=$categoria->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$categoria->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$categoria->formulario('registrar');
		}
		break;
		case 'registrar':{
			if($categoria->registrar()==1){	
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$categoria->registrar_bitacora("Registro","Categorias de Equipos con Nro. Unico: ".$categoria->ultimo_id());
			}
			
			$html_todo=$categoria->formulario('registrar');
		}
		break;
		case 'modificar':{
			if($categoria->modificar()==1){
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$categoria->registrar_bitacora("Modifico","Categorias de Equipos Nro. ".$cod_categoria);
			}
			$html_todo=$categoria->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($categoria->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$categoria->registrar_bitacora("Desactivo","Categorias de Equipos Nro. ".$cod_categoria);
			}
			$html_todo=$categoria->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($categoria->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$categoria->registrar_bitacora("Activo","Categorias de Equipos Nro. ".$cod_categoria);
			}
			$html_todo=$categoria->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($categoria->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$categoria->registrar_bitacora("Elimino","Categorias de Equipos Nro. ".$cod_categoria);
			}
			$html_todo=$categoria->reporte_html_general($vista);
		}
		break;
		default:{
			$categoria->registrar_bitacora("Listo","Categorias de Equipos");
			$html_todo=$categoria->reporte_html_general($vista);
			
		}
		break;
	};
		?>
		