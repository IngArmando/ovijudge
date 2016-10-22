<?php
	 activar_session();
	//INCLUIMOS LAS CLASES
	require_once("vista/participar.php");
	include_once("modelo/class_concurso.php");
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"] ? $_POST["evento"] : $_GET["evento"];
	$cod_problema= $_GET["cod_problema"];
	$nombre=$_POST["nombre"];
	$limite_tiempo=$_POST["limite_tiempo"];
	$limite_memoria=$_POST["limite_memoria"];
	$texto_problema=$_FILES["texto_problema"];
	$texto_problema_viejo=$_POST["texto_problema_viejo"];
	$tipo_texto_problema=$_POST["tipo_texto_problema"];
	$cod_usuario=$_SESSION['cod_usuario'];
	$codigo_fuente=$_POST['codigo_fuente'];
	
	$cod_lenguaje_prog=$_POST["cod_lenguaje_prog"];
	$cod_concurso=$_GET['cod_concurso'];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$participar = new participar;
		
		$participar->set_cod_problema($cod_problema);
		$participar->set_nombre($nombre);
		$participar->set_limite_tiempo($limite_tiempo);
		$participar->set_limite_memoria($limite_memoria);
		$participar->set_texto_problema($texto_problema,$texto_problema_viejo);			
		$participar->set_cod_problema($cod_problema);
		$participar->set_codigo_fuente($codigo_fuente);
		$participar->set_cod_lenguaje_prog($cod_lenguaje_prog);
		$participar->set_cod_concurso($cod_concurso);
		$participar->set_cod_equipo($_SESSION['cod_equipo']);
		$participar->tipo='concurso';
		$participar->nombre_equipo="<span style='font-size:15px'>Mi equipo: <b>".$_SESSION['nombre_equipo']."</b></span>";
			
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$participar->registrar_bitacora("Consulta detallada","Problemas publico");

			$html_todo=$participar->reporte_html_individual();
			
			}
		break;
		case 'formulario_envio':{
			if($participar->verificar_problema_concurso()){
				if($participar->concurso_activo()){
					$participar->registrar_bitacora("Formulario de envio","Participar concurso");
					$html_todo=$participar->formulario_envio($ultimo_id);
				}else{
					$_SESSION['msj']='Estimado usuario, el concurso a finalizado.';
					$_SESSION['msj_tipo']='warning';	
					$html_todo=$participar->resultado_concurso();					
				}
			}else{
				$_SESSION['msj']='Estimado usuario, el problema solicitado no tiene relación al concurso.';
				$_SESSION['msj_tipo']='danger';			
				$participar->registrar_bitacora("Acceso indebido","concursos, el usuario trata de acceder a un problema que no pertenece al concurso.");
				$html_todo=$participar->listado_publico_concurso();
				
			}
			
		}
		break;
		case 'registrar':{
			if($participar->concurso_activo()){
				if($participar->registrar_envio()==1){
					$ultimo_id=$participar->ultimo_id_envio();
					$participar->registrar_bitacora("Envio","Problema del formulario concurso.");
					$_SESSION['msj']='Enviado correctamente';
					$_SESSION['msj_tipo']='success';
					$participar->set_cod_envio($ultimo_id);
					$participar->set_cod_problema($cod_problema);
					$concurso=true;
					require_once("servidor");
				}else{
						$_SESSION['msj']='Problema no recibido, por favor intente de nuevo.';
						$_SESSION['msj_tipo']='danger';			
						$participar->registrar_bitacora("Error","No se logro realizar el registro en la base de datos, Concurso nro. ".$cod_concurso.", Equipo: ".$cod_equipo." Problema: ".$cod_problema);				
					
				}
			}else{
						$_SESSION['msj']='Estimado usuario, los sentimos, el concurso a finalizado.';
						$_SESSION['msj_tipo']='danger';			
						$participar->registrar_bitacora("Acceso indebido","concursos, el usuario trata enviar una solución a un concurso finalizado.");		
						$_SESSION['redireccion']='?vista=participar&evento=resultado&cod_concurso='.$cod_concurso;				
					}
			
			$html_todo=$participar->formulario_envio($ultimo_id);
		}
		break;
		case 'cambiar_lenguaje':{
			$html_todo=$participar->formulario_envio($ultimo_id);
		}
		break;
		case 'resultado':{
			$html_todo=$participar->resultado_concurso();
		}
		break;

		case 'reporte_html_general':{
			require_once("modelo/class_det_usuario_equipo.php");
			$det_usuario_equipo = new det_usuario_equipo;
			$det_usuario_equipo->set_cod_usuario($_SESSION['cod_usuario']);
			if($det_usuario_equipo->consulta_por('cod_usuario')>0){
				$participar->set_cod_concurso($cod_concurso);
				$tiempoa=$participar->consulta_tiempo_inicio_final_concurso();
				$tiempo_inicio=$tiempoa['tiempo_inicio'];
				if(time()>strtotime($tiempo_inicio)){
					$participar->consulta_por('cod_concurso');
				
				$lib_data_table=true;
					$html_todo=$participar->reporte_html_general($vista);
				}
			}else{
				$_SESSION['redireccion']='index.php?vista=participar&evento=resultado&cod_concurso='.$cod_concurso;
			
			}
		}
		break;
		default:{
			$participar->registrar_bitacora("Listo","Problemas concurso");
						
				$lib_data_table=true;
			$html_todo=$participar->listado_publico_concurso();
			
		}
		break;
	};
	function activar_session(){
		if(!$_SESSION['cod_equipo']){
			require_once("modelo/class_det_usuario_equipo.php");
			$det_usuario_equipo = new det_usuario_equipo;
			$det_usuario_equipo->set_cod_usuario($_SESSION['cod_usuario']);
			if($det_usuario_equipo->consulta_por('cod_usuario')==1){
				$row=$det_usuario_equipo->row();	
				$_SESSION['cod_equipo']=$row['cod_equipo'];
				$_SESSION['nombre_equipo']=$row['nombre_equipo'];
				
			}
		}
		
	}
		?>
		
