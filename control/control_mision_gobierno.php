<?php
	//INCLUIMOS LAS CLASES
	
	require_once("modelo/class_mision_gobierno.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_mision_gobierno=$_POST["cod_mision_gobierno"];
	$nombre=$_POST["nombre"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$mision_gobierno= new mision_gobierno;
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case "registrar": {
		
				
		$mision_gobierno = new mision_gobierno;
		
		$mision_gobierno->set_cod_mision_gobierno($cod_mision_gobierno);
		$mision_gobierno->set_nombre($nombre);
			$mision_gobierno->registrar();
			
		
		$ultimo_id=$mision_gobierno->ultimo_id()+1;
		
		
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";
				
		$resultado_listar=$mision_gobierno->listar();
		}
		break;
		case "registrar_sincronizado": {
				
		$mision_gobierno = new mision_gobierno;
		
		$mision_gobierno->set_cod_mision_gobierno($cod_mision_gobierno);
		$mision_gobierno->set_nombre($nombre);
			$mision_gobierno->registrar();
			
		
		$ultimo_id=$mision_gobierno->ultimo_id()+1;
		
		
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";	
			
			lemez_combo("cod_mision_gobierno",$cod_mision_gobierno,$nombre);
		}
		break;
		case "consultar": {
			
		$mision_gobierno = new mision_gobierno;
		$mision_gobierno->set_cod_mision_gobierno($cod_mision_gobierno);
		$mision_gobierno->consulta_por('cod_mision_gobierno');
		
		$row_mision_gobierno=$mision_gobierno->row();
			
			$mostrar_formulario=true;
			$mostrar_btn="editar";
			}
		break;
		case "editar":		{
			
		$mision_gobierno = new mision_gobierno;
		
			
		$mision_gobierno->set_cod_mision_gobierno($cod_mision_gobierno);
		$mision_gobierno->set_nombre($nombre);
			$mision_gobierno->editar();
			
	
		$mision_gobierno->consulta_por('cod_mision_gobierno');
		$row_mision_gobierno=$mision_gobierno->row();
		
				$_SESSION["msj_tipo"]="success";
				$_SESSION["msj"]="Editado correctamente.";
				$resultado_listar=$mision_gobierno->listar();
			}
		break;
		case "eliminar":	{
					
		$mision_gobierno = new mision_gobierno;
		$mision_gobierno->set_cod_mision_gobierno($cod_mision_gobierno);
		$mision_gobierno->elimina_por('cod_mision_gobierno');
		
		
					$_SESSION["msj_tipo"]="success";
					$_SESSION["msj"]="Eliminado correctamente";
					$resultado_listar=$mision_gobierno->listar();
			}
			
		break;
		case "nuevo":{
		$mostrar_btn="registrar";
		$mostrar_formulario=true;
		
			$ultimo_id=$mision_gobierno->ultimo_id()+1;
			
		}
		break;
		default:{
			$resultado_listar=$mision_gobierno->listar();
		}
}
		?>
		