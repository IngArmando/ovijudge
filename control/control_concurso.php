<?php
	//INCLUIMOS LAS CLASES
	require_once("vista/concurso.php");
	require_once("vista/problema_concurso.php");
	
	//METODOS DE ENTRADA
	$evento = 	$_POST["evento"].$_GET["evento"];
	$cod_concurso=$_POST["cod_concurso"];
	$nombre=$_POST["nombre"];
	$nombre_corto=$_POST["nombre_corto"];
	$tiempo_activo=$_POST["tiempo_activo"];
	$tiempo_inicio=$_POST["tiempo_inicio"];
	$tiempo_conjelacion=$_POST["tiempo_conjelacion"];
	$tiempo_final=$_POST["tiempo_final"];
	$tiempo_desconjelar=$_POST["tiempo_desconjelar"];
	$tiempo_inactivo=$_POST["tiempo_inactivo"];
	$tiempo_activo_string=$_POST["tiempo_activo_string"];
	$tiempo_inicio_string=$_POST["tiempo_inicio_string"];
	$tiempo_conjelacion_string=$_POST["tiempo_conjelacion_string"];
	$tiempo_final_string=$_POST["tiempo_final_string"];
	$tiempo_desconjelar_string=$_POST["tiempo_desconjelar_string"];
	$tiempo_inactivo_string=$_POST["tiempo_inactivo_string"];
	$estatus=$_POST["estatus"];
	$globo_procesado=$_POST["globo_procesado"];
	$publico=$_POST["publico"];
	
	//detalle problemas
	$cod_problema	=$_POST["cod_problema"];
	$nombre_corto	=$_POST["nombre_corto"];
	$puntos			=$_POST["puntos"];
	$permitir_envio	=$_POST["permitir_envio"];
	$permitir_juez	=$_POST["permitir_juez"];
	$color			=$_POST["color"];
	$lenta_eval_resultado=$_POST["lenta_eval_resultado"];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
		$concurso = new vista_concurso;
		$concurso->set_cod_concurso($cod_concurso);
		$concurso->set_nombre($nombre);
		$concurso->set_nombre_corto($nombre_corto);
		$concurso->set_tiempo_activo($tiempo_activo);
		$concurso->set_tiempo_inicio($tiempo_inicio);
		$concurso->set_tiempo_conjelacion($tiempo_conjelacion);
		$concurso->set_tiempo_final($tiempo_final);
		$concurso->set_tiempo_desconjelar($tiempo_desconjelar);
		$concurso->set_tiempo_inactivo($tiempo_inactivo);
		$concurso->set_tiempo_activo_string($tiempo_activo_string);
		$concurso->set_tiempo_inicio_string($tiempo_inicio_string);
		$concurso->set_tiempo_conjelacion_string($tiempo_conjelacion_string);
		$concurso->set_tiempo_final_string($tiempo_final_string);
		$concurso->set_tiempo_desconjelar_string($tiempo_desconjelar_string);
		$concurso->set_tiempo_inactivo_string($tiempo_inactivo_string);
		$concurso->set_estatus($estatus);
		$concurso->set_globo_procesado($globo_procesado);
		$concurso->set_publico($publico);	
		
	
	
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$concurso->registrar_bitacora("Consulta detallada","Concursos");
			$html_todo=$concurso->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$concurso->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{

			$_SESSION['msj']='Importante! Tome en cuenta que nuestros servidores trabajan en hora Venezolana.';
			$_SESSION['msj_tipo']='info';
			$html_todo=$concurso->formulario('registrar');
		}
		break;
		case 'certificar':{
	
			certificar_pdf($cod_concurso);
			
		}break;
		case 'registrar':{
			$problema_concurso = new vista_problema_concurso;	
			$concurso->iniciar_transaccion();
			if($concurso->registrar()==1){	
				$ultimo_id=$concurso->ultimo_id();
				$problema_concurso->set_cod_concurso($ultimo_id);
				for($i=0 ; $i<count($cod_problema); $i++){
					$problema_concurso->set_cod_problema($cod_problema[$i]);
					$problema_concurso->set_nombre_corto($nombre_corto[$i]);
					$problema_concurso->set_puntos($puntos[$i]);
					$problema_concurso->set_permitir_envio($permitir_envio[$i]);
					$problema_concurso->set_permitir_juez($permitir_juez[$i]);
					$problema_concurso->set_color($color[$i]);
					$problema_concurso->set_lenta_eval_resultado($lenta_eval_resultado[$i]);
					$problema_concurso->registrar();
				}
				$concurso->commit();
				$_SESSION['msj']='Registrado correctamente';
				$_SESSION['msj_tipo']='success';
				$concurso->registrar_bitacora("Registro","Concursos con Nro. Unico: ".$ultimo_id);
				$concurso = new vista_concurso;
				
			}else{
				$concurso->rollback();	
			}
			
			$html_todo=$concurso->formulario('registrar');
		}
		break;
		case 'modificar':{
			$problema_concurso = new vista_problema_concurso;	
			$concurso->iniciar_transaccion();
			if($concurso->modificar()==1 || $concurso->modificar()==0){	
				$problema_concurso->set_cod_concurso($cod_concurso);
				$problema_concurso->elimina_por('cod_concurso');
				
				for($i=0 ; $i<count($cod_problema); $i++){
					$problema_concurso->set_cod_problema($cod_problema[$i]);
					$problema_concurso->set_nombre_corto($nombre_corto[$i]);
					$problema_concurso->set_puntos($puntos[$i]);
					$problema_concurso->set_permitir_envio($permitir_envio[$i]);
					$problema_concurso->set_permitir_juez($permitir_juez[$i]);
					$problema_concurso->set_color($color[$i]);
					$problema_concurso->set_lenta_eval_resultado($lenta_eval_resultado[$i]);
					$problema_concurso->registrar();
				}
				$concurso->commit();
				$_SESSION['msj']='Modificar correctamente';
				$_SESSION['msj_tipo']='success';
				$concurso->registrar_bitacora("Registro","Concursos con Nro. Unico: ".$ultimo_id);
				
			}else{
				$concurso->rollback();	
			}
			
			$html_todo=$concurso->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($concurso->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$concurso->registrar_bitacora("Desactivo","Concursos Nro. ".$cod_concurso);
			}
			$html_todo=$concurso->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($concurso->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$concurso->registrar_bitacora("Activo","Concursos Nro. ".$cod_concurso);
			}
			$html_todo=$concurso->reporte_html_general($vista);
		}
		break;
		case 'eliminar':{
			if($concurso->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$concurso->registrar_bitacora("Elimino","Concursos Nro. ".$cod_concurso);
			}
			$html_todo=$concurso->reporte_html_general($vista);
		}
		break;
		default:{
			$concurso->registrar_bitacora("Listo","Concursos");
			$html_todo=$concurso->reporte_html_general($vista);
			
		}
		break;
	};
	
	function certificar_pdf($cod_concurso){
		require_once("modelo/class_persona.php");
			require_once("modelo/class_problema_concurso.php");
		$persona = new persona;
		$persona->set_cedula($_SESSION['cedula']);
		$persona->consultar();
			require_once("libreria/fpdf/clsFpdf_vertical.php");
			$concurso = new concurso;
			$concurso->set_cod_concurso($cod_concurso);
			$concurso->consultar();
			
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();
	$lobjPdf->AddPage("P","Letter");
	$lobjPdf->SetAutoPageBreak(true,10);  
	$lobjPdf->Ln(0);
	$lobjPdf->SetFont("Arial","B",15);
	$lobjPdf->Cell(0,6,utf8_decode("CERTIFICADO DEL CONCURSO").$nombre_nomina,0,1,"C");

	$c=7;
	$lobjPdf->Ln();  
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(0,6,utf8_decode("DATOS BASICOS"),0,1,"C");
	$lobjPdf->Ln(2);
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(40,$c,'Nombre del concurso:',1,0,'L',false);
	$lobjPdf->SetFont("Arial","",10);
	$lobjPdf->Cell(0,$c,utf8_decode($concurso->nombre),1,0,'C',false);
	$lobjPdf->Ln();
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(40,$c,'Nombre corto:',1,0,'L',false);
	$lobjPdf->SetFont("Arial","",10);
	$lobjPdf->Cell(55,$c,utf8_decode($concurso->nombre_corto),1,0,'C',false);
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(40,$c,'Creado por:',1,0,'L',false);
	$lobjPdf->SetFont("Arial","",10);
	$lobjPdf->Cell(0,$c,utf8_decode($persona->nombre." ".$persona->apellido),1,0,'C',false);
	$lobjPdf->Ln();  
	$lobjPdf->Ln();  
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(0,6,utf8_decode("TIEMPOS"),0,1,"C");
	$lobjPdf->Ln(2);
	$lobjPdf->Cell(40,$c,'Inicio:',1,0,'L',false);
	$lobjPdf->SetFont("Arial","",10);
	$lobjPdf->Cell(55,$c,$concurso->tiempo_inicio,1,0,'C',false);
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(40,$c,utf8_decode('Congelación:'),1,0,'L',false);
	$lobjPdf->SetFont("Arial","",10);
	$lobjPdf->Cell(0,$c,$concurso->tiempo_conjelacion,1,0,'C',false);

	$lobjPdf->Ln();
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(40,$c,utf8_decode('Finalización:'),1,0,'L',false);
	$lobjPdf->SetFont("Arial","",10);
	$lobjPdf->Cell(55,$c,$concurso->tiempo_final,1,0,'C',false);
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(40,$c,utf8_decode('Descongelar:'),1,0,'L',false);
	$lobjPdf->SetFont("Arial","",10);
	$lobjPdf->Cell(0,$c,$concurso->tiempo_desconjelar,1,0,'C',false);
	$lobjPdf->Ln();
	$lobjPdf->Ln();  
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(0,6,utf8_decode("PROBLEMAS"),0,1,"C");
	$lobjPdf->Ln(2);
	$lobjPdf->SetFont("Arial","B",10);
	$lobjPdf->Cell(40,$c,utf8_decode('Codigo'),1,0,'L',false);
	$lobjPdf->Cell(100,$c,utf8_decode('Nombre'),1,0,'L',false);
	$lobjPdf->Cell(0,$c,utf8_decode('Color'),1,0,'L',false);
	$lobjPdf->Ln();

	$problema_concurso = new problema_concurso;
	$problema_concurso->set_cod_concurso($cod_concurso);
		$lobjPdf->SetFont("Arial","",10);
	if($problema_concurso->consultar_problemas_del_concurso_detallado()>0){
		while($row=$problema_concurso->row()){
		list($r,$g,$b) = array_map('hexdec',str_split($row['color'],2));
		$lobjPdf->Cell(40,$c,$row['cod_problema'],1,0,'C',false);
		
		$lobjPdf->Cell(100,$c,$row['nombre'],1,0,'C',false);
		$lobjPdf->SetFillColor($r, $g, $b);
		$lobjPdf->Cell(0,$c,$row['color'],1,0,'C',true);
		$lobjPdf->Ln();
		//require_once("modelo/class_caso_de_prueba.php");
		}
	}
	$lobjPdf->Output();
}
		?>
