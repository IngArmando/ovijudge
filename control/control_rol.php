<?php
	//INCLUIMOS LAS CLASES
	
	require_once("modelo/class_rol.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$idrol=$_POST["idrol"];
	$nombre=$_POST["nombre"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$rol= new rol;
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case "registrar": {
		
				
		$rol = new rol;
		
		$rol->set_idrol($idrol);
		$rol->set_nombre($nombre);
			$rol->registrar();
			
		
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";
				
		$resultado_listar=$rol->listar();
		}
		break;
		case "registrar_sincronizado": {
				
		$rol = new rol;
		
		$rol->set_idrol($idrol);
		$rol->set_nombre($nombre);
			$rol->registrar();
			
		
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";	
			
			lemez_combo("idrol",$idrol,$nombre);
		}
		break;
		case "consultar": {
			
		$rol = new rol;
		$rol->set_idrol($idrol);
		$rol->consulta_por('idrol');
		
		$row_rol=$rol->row();
			
			$mostrar_formulario=true;
			$mostrar_btn="editar";
			}
		break;
		case "editar":		{
			
		$rol = new rol;
		
			
		$rol->set_idrol($idrol);
		$rol->set_nombre($nombre);
			$rol->editar();
			
	
		$rol->consulta_por('idrol');
		$row_rol=$rol->row();
		
				$_SESSION["msj_tipo"]="success";
				$_SESSION["msj"]="Editado correctamente.";
				$resultado_listar=$rol->listar();
			}
		break;
		case "eliminar":	{
					
		$rol = new rol;
		$rol->set_idrol($idrol);
		$rol->elimina_por('idrol');
		
		
					$_SESSION["msj_tipo"]="success";
					$_SESSION["msj"]="Eliminado correctamente";
					$resultado_listar=$rol->listar();
			}
			
		break;
		case "nuevo":{
		$mostrar_btn="registrar";
		$mostrar_formulario=true;
		
		}
		break;
		default:{
			$resultado_listar=$rol->listar();
		}
}
		?>
		