<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/participar_entrenamiento.php");
	require_once("modelo/class_envio_entrenamiento.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"] ? $_POST["evento"] : $_GET["evento"];
	$cod_problema= $_POST["cod_problema"] ? $_POST["cod_problema"] : $_GET["cod_problema"];
	$nombre=$_POST["nombre"];
	$limite_tiempo=$_POST["limite_tiempo"];
	$limite_memoria=$_POST["limite_memoria"];
	$texto_problema=$_FILES["texto_problema"];
	$texto_problema_viejo=$_POST["texto_problema_viejo"];
	$tipo_texto_problema=$_POST["tipo_texto_problema"];
	$cod_usuario=$_SESSION['cod_usuario'];
	$codigo_fuente=$_POST['codigo_fuente'];
	$cod_lenguaje_prog=$_POST["cod_lenguaje_prog"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$problema = new participar_entrenamiento;
		$envio_entrenamiento = new envio_entrenamiento;
		
		$problema->set_cod_problema($cod_problema);
		$problema->set_nombre($nombre);
		$problema->set_limite_tiempo($limite_tiempo);
		$problema->set_limite_memoria($limite_memoria);
		$problema->set_texto_problema($texto_problema,$texto_problema_viejo);			
		$envio_entrenamiento->set_cod_problema($cod_problema);
		$envio_entrenamiento->set_cod_usuario($cod_usuario);
		$envio_entrenamiento->set_codigo_fuente($codigo_fuente);
		$envio_entrenamiento->set_cod_lenguaje_prog($cod_lenguaje_prog);
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$problema->registrar_bitacora("Consulta detallada","Problemas publico");
			$html_todo=$problema->reporte_html_individual();
			
			}
		break;
		case 'formulario_envio':{
			$problema->registrar_bitacora("Formulario de envio","Participar entrenamiento");
			$html_todo=$problema->formulario_envio($ultimo_id);
			
			}
		break;
		case 'registrar':{
			if($envio_entrenamiento->registrar()==1){
				$ultimo_id=$envio_entrenamiento->ultimo_id();
				$envio_entrenamiento->registrar_bitacora("Envio","Problema en el formulario de entrenamiento.");
				$_SESSION['msj']='Enviado correctamente';
				$_SESSION['msj_tipo']='success';
				$envio_entrenamiento->set_cod_envio_entrenamiento($ultimo_id);
				$entrenamiento=true;
				require_once("servidor");
			}
			$html_todo=$problema->formulario_envio($ultimo_id);
		}
		break;
		case 'cambiar_lenguaje':{
			
			$html_todo=$problema->formulario_envio($ultimo_id);
		}
		break;
		default:{
			
			$problema->registrar_bitacora("Listo","Problemas publico");
			$problema->listar();
			
			$html_todo=$problema->reporte_html_general($vista);
			
			
		}
		break;
	};
		?>
		
