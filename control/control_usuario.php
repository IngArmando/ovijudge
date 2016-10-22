<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/usuario.php");
	require_once("vista/campo/campo_usuario.php");
	require_once("vista/campo/campo_persona.php");
	require_once("vista/campo/campo_pregunta_seguridad.php");
	$campo_usuario = new campo_usuario;
	$campo_persona = new campo_persona;
	$campo_pregunta_seguridad= new campo_pregunta_seguridad;
	
	//METODOS DE ENTRADA
	$evento = 	$_REQUEST["evento"];
	$nacionalidad=$_POST["nacionalidad_cedula"];
	$cedula_pura=$_POST["cedula"];	
	if($nacionalidad){
		$cedula=$nacionalidad."-".$cedula_pura;
	}else{
		$cedula=$cedula_pura;
	}
	
	if($_SESSION['cod_tipo_usuario']!=1){
		$cedula=$_SESSION['cedula'];
	}
	$limitado	=$_REQUEST['limitado'];
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
	
	
	$campo_pregunta_seguridad->set_cedula($cedula);
	$campo_pregunta_seguridad->set_pregunta($pregunta);
	$campo_pregunta_seguridad->set_respuesta($respuesta);
	
	$campo_persona->set_cedula($cedula);
	$campo_persona->set_nombre($nombre);
	$campo_persona->set_apellido($apellido);
	$campo_persona->set_sexo($sexo);
	$campo_persona->set_fecha_nacimiento($fecha_nacimiento);
	$campo_persona->set_correo($correo);
	$campo_persona->set_telefono_movil($telefono_movil);
	$campo_persona->set_telefono_fijo($telefono_fijo);
	$campo_persona->set_cod_parroquia($cod_parroquia);
	$campo_persona->set_direccion($direccion);
	
	$campo_usuario->set_cedula($cedula);
	$campo_usuario->set_cod_usuario($cod_usuario);
	$campo_usuario->set_estatus($estatus);
	$campo_usuario->set_ultima_actividad($ultima_actividad);
	$campo_usuario->set_fecha_clave();
	$campo_usuario->set_clave($clave);
	$campo_usuario->set_ultima_ip();
	$campo_usuario->set_ip_actual();
	$campo_usuario->set_cod_tipo_usuario($cod_tipo_usuario);		
	$campo_usuario->set_cedula($cedula);
	
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'registrar_publico':{
			if(strtoupper($_POST["captcha"]) == $_SESSION["captcha"]){
				$campo_usuario->INICIAR_TRANSACCION();
				$campo_usuario->set_cod_tipo_usuario(2);
				$campo_usuario->set_estatus(1);
				$campo_persona->registrar();
				$campo_usuario->registrar();
				$campo_pregunta_seguridad->registrar();
				$_SESSION['msj']='Felicidades! usted ha sido registrado correctamente, ya puede acceder al sistema.';
				$_SESSION['msj_tipo']='success';
				$campo_usuario->COMMIT();
				$_SESSION['redireccion']='?vista=usuario';
			}else{
				$_SESSION['msj_tipo']="danger";
				$_SESSION['msj']="Disculpe el captcha de verificación no se completo correctamente, intente de nuevo.";
				
				$html_todo=formulario_registro_publico($campo_usuario,$campo_persona,$campo_pregunta_seguridad);
			}
			
		}
		break;
		default:{
			$html_todo=formulario_registro_publico($campo_usuario,$campo_persona,$campo_pregunta_seguridad);
		}
		break;
	}
?>
		
