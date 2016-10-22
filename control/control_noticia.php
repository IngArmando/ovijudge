<?php
		global $lib_data_table;
	$lib_data_table=true;
	//INCLUIMOS LAS CLASES
	
	require_once("modelo/class_noticia.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_noticia=$_POST["cod_noticia"];
	$titulo=$_POST["titulo"];
	$descripcion=$_POST["descripcion"];
	
	$fecha_creacion=date("Y-m-d h:i:s",strtotime($_POST["fecha_creacion"]));
	$fecha_expiracion=$_POST["fecha_expiracion"];
	$cod_usuario=$_POST["cod_usuario"];
	$imagen=$_FILES["imagen"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$noticia= new noticia;
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case "registrar": {
		
				
		$noticia = new noticia;
		
		$noticia->set_cod_noticia($cod_noticia);
		$noticia->set_titulo($titulo);
		$noticia->set_descripcion($descripcion);
		$noticia->set_fecha_creacion($fecha_creacion);
		$noticia->set_fecha_expiracion($fecha_expiracion);
		$noticia->set_cod_usuario($cod_usuario);
		$noticia->set_imagen($imagen);
			$noticia->registrar();
			
		$noticia->registrar_bitacora("Registro","noticia");
		$ultimo_id=$noticia->ultimo_id()+1;
		
		
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";
				
		$resultado_listar=$noticia->listar_todo();
		}
		break;
		case "registrar_sincronizado": {
				
		$noticia = new noticia;
		
		$noticia->set_cod_noticia($cod_noticia);
		$noticia->set_titulo($titulo);
		$noticia->set_descripcion($descripcion);
		$noticia->set_fecha_creacion($fecha_creacion);
		$noticia->set_fecha_expiracion($fecha_expiracion);
		$noticia->set_cod_usuario($cod_usuario);
		$noticia->set_imagen($imagen);
			$noticia->registrar();
			
		
		$ultimo_id=$noticia->ultimo_id()+1;
		
		
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente";	
			
			lemez_combo("cod_noticia",$cod_noticia,$titulo);
		}
		break;
		case "consultar": {
			
		$noticia = new noticia;
		$noticia->set_cod_noticia($cod_noticia);
		$noticia->consulta_por('cod_noticia');
		
		$row_noticia=$noticia->row();
		$noticia->registrar_bitacora("Consulto","noticia");	
			$mostrar_formulario=true;
			$mostrar_btn="editar";
			}
		break;
		case "editar":		{
			
		$noticia = new noticia;
		
			
		$noticia->set_cod_noticia($cod_noticia);
		$noticia->set_titulo($titulo);
		$noticia->set_descripcion($descripcion);
		$noticia->set_fecha_creacion($fecha_creacion);
		$noticia->set_fecha_expiracion($fecha_expiracion);
		$noticia->set_cod_usuario($cod_usuario);
		$noticia->set_imagen($imagen);
		$noticia->editar();
			
	
		$noticia->consulta_por('cod_noticia');
		$row_noticia=$noticia->row();
		$noticia->registrar_bitacora("Edito","noticia");
				$_SESSION["msj_tipo"]="success";
				$_SESSION["msj"]="Editado correctamente.";
				$resultado_listar=$noticia->listar_todo();
			}
		break;
		case "eliminar":	{
					
		$noticia = new noticia;
		$noticia->set_cod_noticia($cod_noticia);
		$noticia->desactivar();
		
		$noticia->registrar_bitacora("Elimino","noticia");
					$_SESSION["msj_tipo"]="success";
					$_SESSION["msj"]="Los cambios se realizaron correctamente.";
					$resultado_listar=$noticia->listar_todo();
			}
			
		break;
		case "nuevo":{
		$mostrar_btn="registrar";
		$mostrar_formulario=true;
		
			$ultimo_id=$noticia->ultimo_id()+1;
			
		}
		break;
		default:{
			$resultado_listar=$noticia->listar_todo();
		}
}
		?>
		
