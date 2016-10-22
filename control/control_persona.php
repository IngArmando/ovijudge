<?php
	//INCLUIMOS LAS CLASES
	
	require_once("modelo/class_persona.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cedula=$_POST["cedula"];
	$nombre=$_POST["nombre"];
	$apellido=$_POST["apellido"];
	$sexo=$_POST["sexo"];
	$correo=$_POST["correo"];
	$telefono_movil=$_POST["telefono_movil"];
	$telefono_fijo=$_POST["telefono_fijo"];
	$fecha_nacimiento=$_POST["fecha_nacimiento"];
	$estatus=$_POST["estatus"];
	$cod_parroquia=$_POST["cod_parroquia"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$persona= new persona;
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case "registrar": {
		
				
		$persona = new persona;
		
		$persona->set_cedula($cedula);
		$persona->set_nombre($nombre);
		$persona->set_apellido($apellido);
		$persona->set_sexo($sexo);
		$persona->set_correo($correo);
		$persona->set_telefono_movil($telefono_movil);
		$persona->set_telefono_fijo($telefono_fijo);
		$persona->set_fecha_nacimiento($fecha_nacimiento);
		$persona->set_estatus($estatus);
		$persona->set_cod_parroquia($cod_parroquia);
			$persona->registrar();
			
		$persona->registrar_bitacora("Registro","persona");
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";
				
		$resultado_listar=$persona->listar();
		}
		break;
		case "registrar_sincronizado": {
				
		$persona = new persona;
		
		$persona->set_cedula($cedula);
		$persona->set_nombre($nombre);
		$persona->set_apellido($apellido);
		$persona->set_sexo($sexo);
		$persona->set_correo($correo);
		$persona->set_telefono_movil($telefono_movil);
		$persona->set_telefono_fijo($telefono_fijo);
		$persona->set_fecha_nacimiento($fecha_nacimiento);
		$persona->set_estatus($estatus);
		$persona->set_cod_parroquia($cod_parroquia);
			$persona->registrar();
			
		
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";	
			
			lemez_combo("cedula",$cedula,$nombre);
		}
		break;
		case "consultar": {
			
		$persona = new persona;
		$persona->set_cedula($cedula);
		$persona->consulta_por('cedula');
		
		$row_persona=$persona->row();
		$persona->registrar_bitacora("Consulto","persona");	
			$mostrar_formulario=true;
			$mostrar_btn="editar";
			}
		break;
		case "editar":		{
			
		$persona = new persona;
		
			
		$persona->set_cedula($cedula);
		$persona->set_nombre($nombre);
		$persona->set_apellido($apellido);
		$persona->set_sexo($sexo);
		$persona->set_correo($correo);
		$persona->set_telefono_movil($telefono_movil);
		$persona->set_telefono_fijo($telefono_fijo);
		$persona->set_fecha_nacimiento($fecha_nacimiento);
		$persona->set_estatus($estatus);
		$persona->set_cod_parroquia($cod_parroquia);
			$persona->editar();
			
	
		$persona->consulta_por('cedula');
		$row_persona=$persona->row();
		$persona->registrar_bitacora("Edito","persona");
				$_SESSION["msj_tipo"]="success";
				$_SESSION["msj"]="Editado correctamente.";
				$resultado_listar=$persona->listar();
			}
		break;
		case "eliminar":	{
					
		$persona = new persona;
		$persona->set_cedula($cedula);
		$persona->elimina_por('cedula');
		
		$persona->registrar_bitacora("Elimino","persona");
					$_SESSION["msj_tipo"]="success";
					$_SESSION["msj"]="Eliminado correctamente";
					$resultado_listar=$persona->listar();
			}
			
		break;
		case "nuevo":{
		$mostrar_btn="registrar";
		$mostrar_formulario=true;
		
		}
		break;
		default:{
			$resultado_listar=$persona->listar();
		}
}
		?>
		