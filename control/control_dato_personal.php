<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/dato_personal.php");
	$dato_personal = new dato_personal;
	
	//METODOS DE ENTRADA
	$evento = 	$_REQUEST["evento"];
	$cedula=$_SESSION['cedula'];
	$cod=$_GET['cod'];
	$nombre		=$_POST["nombre"];
	$cod_tipo_usuario=$_SESSION["cod_tipo_usuario"];
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
	$foto_perfil=$_FILES['foto_perfil'];
	
	$cod_usuario= $cod ? $cod : $_SESSION['cod_usuario'];
	
	$dato_personal->set_cedula($cedula);
	$dato_personal->set_nombre($nombre);
	$dato_personal->set_apellido($apellido);
	$dato_personal->set_sexo($sexo);
	$dato_personal->set_fecha_nacimiento($fecha_nacimiento);
	$dato_personal->set_correo($correo);
	$dato_personal->set_telefono_movil($telefono_movil);
	$dato_personal->set_telefono_fijo($telefono_fijo);
	$dato_personal->set_cod_parroquia($cod_parroquia);
	$dato_personal->set_direccion($direccion);
	$dato_personal->set_cod_usuario($cod_usuario);
	$dato_personal->set_foto_perfil($foto_perfil);
	
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'modificar':{
			
			$dato_personal->INICIAR_TRANSACCION();
			$dato_personal->modificar_dato_personal();
			$dato_personal->COMMIT();
			$_SESSION['msj']='Los cambios se han realizado correctamente';
			$_SESSION['msj_tipo']='success';
			$html_todo=$dato_personal->formulario_dato_personal();
		}
		break;
		case 'dato_personal_html':{
			
			$html_todo=$dato_personal->dato_personal_html();
		}
		break;
		default:{
			$html_todo=$dato_personal->formulario_dato_personal();
			}
	}
?>
		
