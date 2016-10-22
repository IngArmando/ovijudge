<?php
	//INCLUIMOS LAS CLASES
	
	require_once("modelo/class_privilegio.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_vista_sistema=$_POST["cod_vista_sistema"];
	$cod_tipo_usuario=$_POST["cod_tipo_usuario"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$privilegio= new privilegio;
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case "registrar": {
		
				
		$privilegio = new privilegio;
		
		$privilegio->set_cod_vista_sistema($cod_vista_sistema);
		$privilegio->set_cod_tipo_usuario($cod_tipo_usuario);
		$privilegio->registrar();
			
		$privilegio->registrar_bitacora("Registro","privilegio");
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";
				
		$resultado_listar=$privilegio->listar();
		}
		break;
		case "registrar_sincronizado": {
				
		$privilegio = new privilegio;
		
		$privilegio->set_cod_vista_sistema($cod_vista_sistema);
		$privilegio->set_cod_tipo_usuario($cod_tipo_usuario);
			$privilegio->registrar();
			
		
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";	
			
			lemez_combo("cod_vista_sistema",$cod_vista_sistema,$cod_tipo_usuario);
		}
		break;
		case "consultar": {
			
		$privilegio = new privilegio;
		$privilegio->set_cod_vista_sistema($cod_vista_sistema);
		$privilegio->consulta_por('cod_vista_sistema');
		
		$row_privilegio=$privilegio->row();
		$privilegio->registrar_bitacora("Consulto","privilegio");	
			$mostrar_formulario=true;
			$mostrar_btn="editar";
			}
		break;
		case "editar":		{
			
		$privilegio = new privilegio;
		
			
		$privilegio->set_cod_vista_sistema($cod_vista_sistema);
		$privilegio->set_cod_tipo_usuario($cod_tipo_usuario);
			$privilegio->editar();
			
	
		$privilegio->consulta_por('cod_vista_sistema');
		$row_privilegio=$privilegio->row();
		$privilegio->registrar_bitacora("Edito","privilegio");
				$_SESSION["msj_tipo"]="success";
				$_SESSION["msj"]="Editado correctamente.";
				$resultado_listar=$privilegio->listar();
			}
		break;
		case "eliminar":	{
					
		$privilegio = new privilegio;
		$privilegio->set_cod_vista_sistema($cod_vista_sistema);
		$privilegio->elimina_por('cod_vista_sistema');
		
		$privilegio->registrar_bitacora("Elimino","privilegio");
					$_SESSION["msj_tipo"]="success";
					$_SESSION["msj"]="Los cambios se realizaron correctamente.";
					$resultado_listar=$privilegio->listar();
			}
			
		break;
		case "nuevo":{
		$mostrar_btn="registrar";
		$mostrar_formulario=true;
		
		}
		break;
		default:{
			$resultado_listar=$privilegio->listar();
		}
}
		?>
		
