<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/usuario_admin.php");
	$usuario_admin = new usuario_admin;
	
	//METODOS DE ENTRADA
	$evento = 	$_REQUEST["evento"];
	$nacionalidad=$_POST["nacionalidad_cedula"];
	$cedula_pura=$_POST["cedula"];	
	if($nacionalidad){
		$cedula=$nacionalidad."-".$cedula_pura;
	}else{
		$cedula=$cedula_pura;
	}
	
	$nombre		=$_POST["nombre"];
	$cod_tipo_usuario=$_POST["cod_tipo_usuario"];
	$apellido	=$_POST["apellido"];
	$sexo		=$_POST["sexo"];
	$correo		=$_POST["correo"];
	$telefono_movil=$_POST["telefono_movil"];
	$telefono_fijo=$_POST["telefono_fijo"];
	$fecha_nacimiento=$_POST["fecha_nacimiento"];
	$direccion	=$_POST['direccion'];
	$clave		=$_POST["clave"];
	$estatus	=$_POST["estatus"];
	$volver		=$_POST["volver"];
	$captcha	=$_POST['captcha'];
	$pregunta	=$_POST['pregunta'];
	$respuesta	=$_POST['respuesta'];
	$cod_parroquia=$_POST['cod_parroquia'];
	
	$cod_usuario=$_POST['cod_usuario'];
	$cod_institucion=$_POST['cod_institucion'];
	
	$usuario_admin->set_cedula($cedula);
	$usuario_admin->set_nombre($nombre);
	$usuario_admin->set_apellido($apellido);
	$usuario_admin->set_sexo($sexo);
	$usuario_admin->set_fecha_nacimiento($fecha_nacimiento);
	$usuario_admin->set_correo($correo);
	$usuario_admin->set_telefono_movil($telefono_movil);
	$usuario_admin->set_telefono_fijo($telefono_fijo);
	$usuario_admin->set_cod_parroquia($cod_parroquia);
	$usuario_admin->set_direccion($direccion);
	
	$usuario_admin->set_estatus($estatus);
	$usuario_admin->set_cod_usuario($cod_usuario);
	$usuario_admin->set_ultima_actividad($ultima_actividad);
	$usuario_admin->set_fecha_clave();
	$usuario_admin->set_clave($clave);
	
	$usuario_admin->set_ultima_ip();
	
	$usuario_admin->set_ip_actual();
	
	$usuario_admin->set_cod_tipo_usuario($cod_tipo_usuario);		 
	$usuario_admin->set_cod_institucion($cod_institucion);
	
	
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$html_todo=$usuario_admin->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$usuario_admin->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$usuario_admin->formulario('registrar');
			}
		break;
		case 'modificar':{
			
			$usuario_admin->INICIAR_TRANSACCION();
			$usuario_admin->modificar();
			$usuario_admin->COMMIT();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$usuario_admin->formulario('modificar');
		}
		break;
		case 'registrar':{
			$usuario_admin->set_clave($cedula_pura);
			if($usuario_admin->registrar_por_administrador()==1){
				$_SESSION['msj']='Registrado correctamente, le recordamos que la clave por defecto es el Nro. de Cedula.';
				$_SESSION['msj_tipo']='success';
				$usuario_admin = new usuario_admin;
				$html_todo=$usuario_admin->reporte_html_general($vista);
			}else{
				$html_todo=$usuario_admin->formulario('registrar');
			}
		}
		break;
		case 'desactivar':{
			$usuario_admin->desactivar();
			$html_todo=$usuario_admin->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$usuario_admin->activar();
			$html_todo=$usuario_admin->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$usuario_admin->eliminar();
			$html_todo=$usuario_admin->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$usuario_admin->reporte_html_general($vista);
		}
		break;
	}
?>
		
