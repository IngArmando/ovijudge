<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/equipo.php");
	require_once("modelo/class_det_usuario_equipo.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_equipo= $_POST["cod_equipo"] ? $_POST["cod_equipo"] : $_GET["cod_equipo"];
	$nombre=$_POST["nombre"];
	$cod_institucion=$_POST["cod_institucion"];
	$estatus=$_POST["estatus"];
	
	//DETALLLES
	$cod_usuario=$_POST['cod_usuario'];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$equipo = new vista_equipo;
		
		$equipo->set_cod_equipo($cod_equipo);
		$equipo->set_nombre($nombre);
		$equipo->set_cod_institucion($cod_institucion);
		$equipo->set_estatus($estatus);
		
		//DETALLLES
				
		
		
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$equipo->registrar_bitacora("Consulta detallada","Equipos");
			
			$html_todo=$equipo->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$equipo->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$equipo->formulario('registrar');
		}
		break;
		case 'registrar':{
			$det_usuario_equipo= new det_usuario_equipo;
			$equipo->iniciar_transaccion();
			if($equipo->registrar()==1){	
				$ultimo_id=$equipo->ultimo_id();
				$det_usuario_equipo->set_cod_equipo($ultimo_id);
				for($i=0 ; $i<count($cod_usuario); $i++){
					$det_usuario_equipo->set_cod_usuario($cod_usuario[$i]);
					$det_usuario_equipo->registrar();
				}
				$equipo->commit();
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$equipo->registrar_bitacora("Registro","Equipos con Nro. Unico: ".$equipo->ultimo_id());
				$equipo = new vista_equipo;
			}else{
				$equipo->rollback();
			}
			
			$html_todo=$equipo->formulario('registrar');
		}
		break;
		case 'modificar':{
			$det_usuario_equipo= new det_usuario_equipo;
			$equipo->iniciar_transaccion();
			if($equipo->modificar()==1 || $equipo->modificar()==0){	
				$det_usuario_equipo->set_cod_equipo($cod_equipo);
				$det_usuario_equipo->elimina_por('cod_equipo');
				for($i=0 ; $i<count($cod_usuario); $i++){
					$det_usuario_equipo->set_cod_usuario($cod_usuario[$i]);
					$det_usuario_equipo->registrar();
				}
				$equipo->commit();
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$equipo->registrar_bitacora("Registro","Equipos con Nro. Unico: ".$equipo->ultimo_id());
			}else{
				$equipo->rollback();
			}
			$html_todo=$equipo->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($equipo->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$equipo->registrar_bitacora("Desactivo","Equipos Nro. ".$cod_equipo);
			}
			$html_todo=$equipo->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($equipo->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$equipo->registrar_bitacora("Activo","Equipos Nro. ".$cod_equipo);
			}
			$html_todo=$equipo->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($equipo->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$equipo->registrar_bitacora("Elimino","Equipos Nro. ".$cod_equipo);
			}
			$html_todo=$equipo->reporte_html_general($vista);
		}
		break;
		default:{
			$equipo->registrar_bitacora("Listo","Equipos");
			
			$html_todo=$equipo->reporte_html_general($vista);
			
			
		}
		break;
	};
		?>
		
