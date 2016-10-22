<?php
	//INCLUIMOS LAS CLASES
	
	require_once("modelo/class_tipo_usuario.php");
	require_once("modelo/class_privilegio.php");
	require_once("vista/tipo_usuario.php");
	$vista_tipo_usuario = new vista_tipo_usuario;
	//METODOS DE ENTRADA
	
	$evento 			=$_POST["evento"].$_GET["evento"];
	$cod_tipo_usuario	=$_POST["cod_tipo_usuario"];
	$nombre				=$_POST["nombre"];
	$privilegio_cod_vista_sistema=$_POST["privilegio_cod_vista_sistema"];
	$privilegio_cod_tipo_usuario=$_POST["privilegio_cod_tipo_usuario"];
	$permiso_c=$_POST['permiso_c'];
	$permiso_a=$_POST['permiso_a'];
	$permiso_e=$_POST['permiso_e'];
	$permiso_r=$_POST['permiso_r'];
	$permiso_d=$_POST['permiso_d'];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	$vista_tipo_usuario->set_cod_tipo_usuario($cod_tipo_usuario);
	$vista_tipo_usuario->set_nombre($nombre);
	

	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'consultar': {
			$html_todo=$usuario_admin->reporte_html_individual();
		}
		break;		
		case 'registrar': {
			$vista_tipo_usuario->iniciar_transaccion();
			$vista_tipo_usuario->registrar();
			$vista_tipo_usuario->set_cod_tipo_usuario($vista_tipo_usuario->ultimo_id());
			$vista_tipo_usuario->registrar_bitacora("Registro","Un Rol de Usuario");
			$privilegio = new privilegio;
			for($i=0 ; $i<count($privilegio_cod_vista_sistema); $i++){
				$privilegio->set_cod_vista_sistema($privilegio_cod_vista_sistema[$i]);
				$privilegio->set_cod_tipo_usuario($vista_tipo_usuario->cod_tipo_usuario);
				$privilegio->set_consultar($permiso_c[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->set_registrar($permiso_r[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->set_eliminar($permiso_e[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->set_actualizar($permiso_a[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->set_desactivar($permiso_d[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->registrar();
			}
			$vista_tipo_usuario->commit();
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Registrado correctamente, Debe iniciar sessión nuevamente para que los cambios surtan efecto.";
		}
			$vista_tipo_usuario= new $vista_tipo_usuario;
			$html_todo=$vista_tipo_usuario->formulario('registrar');
		
		break;
		case 'reporte_html_individual':{
			$html_todo=$vista_tipo_usuario->reporte_html_individual();
			}
		break;
		case 'formulario_modificar':{
			
			$html_todo=$vista_tipo_usuario->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$vista_tipo_usuario->formulario('registrar');
		}
		break;
		case 'modificar':		{
			$vista_tipo_usuario->editar();
			$vista_tipo_usuario->registrar_bitacora("Modifico","Un Rol de Usuario");
			$privilegio = new privilegio;
			$privilegio->set_cod_tipo_usuario($cod_tipo_usuario);
			$privilegio->elimina_por('cod_tipo_usuario');
			//proceso para que registre de forma correcta
			for($i=0 ; $i<count($privilegio_cod_vista_sistema); $i++){
				$privilegio->set_cod_vista_sistema($privilegio_cod_vista_sistema[$i]);
				$privilegio->set_cod_tipo_usuario($cod_tipo_usuario);
				$privilegio->set_consultar($permiso_c[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->set_registrar($permiso_r[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->set_eliminar($permiso_e[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->set_actualizar($permiso_a[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->set_desactivar($permiso_d[$privilegio_cod_vista_sistema[$i]]);
				$privilegio->registrar();
			}
			$privilegio->consulta_por('cod_tipo_usuario');
			while($get_privilegio=$privilegio->row()){
				$row_privilegio[]=$get_privilegio;
			}
			
			$_SESSION["msj_tipo"]="success";
			$_SESSION["msj"]="Editado correctamente.";
			$html_todo=$vista_tipo_usuario->formulario('modificar');
		}
		break;
		case 'desactivar':{
			$vista_tipo_usuario->desactivar();
			$html_todo=$vista_tipo_usuario->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			$vista_tipo_usuario->activar();
			$html_todo=$vista_tipo_usuario->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			$vista_tipo_usuario->eliminar();
			$html_todo=$vista_tipo_usuario->reporte_html_general($vista);
		}
		break;
		default:{
			$html_todo=$vista_tipo_usuario->reporte_html_general($vista);
		}
}
		?>
		
