<?php
	//INCLUIMOS LAS CLASES
	
	require_once("vista/problema.php");
	require_once("modelo/class_caso_de_prueba.php");
	//METODOS DE input
	$evento 		= 	$_POST["evento"].$_GET["evento"];
	$cod_problema	=$_POST["cod_problema"] ? $_POST["cod_problema"] : $_GET["cod_problema"];
	$nombre			=$_POST["nombre"];
	$limite_tiempo	=$_POST["limite_tiempo"];
	$limite_memoria	=$_POST["limite_memoria"];
	$texto_problema	=$_FILES["texto_problema"];
	$texto_problema_viejo=$_POST["texto_problema_viejo"];
	$tipo_texto_problema=$_POST["tipo_texto_problema"];
	$enunciado = $_POST['enunciado'];
	//detalle
	$input=$_POST['input'];
	$output=$_POST['output'];
	$descripcion=$_POST['descripcion'];
	$ejemplo=$_POST['ejemplo'];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$problema = new vista_problema;
		
		$problema->set_cod_problema($cod_problema);
		$problema->set_nombre($nombre);
		$problema->set_limite_tiempo($limite_tiempo);
		$problema->set_limite_memoria($limite_memoria);
		$problema->set_texto_problema($texto_problema,$texto_problema_viejo);
		$problema->set_tipo_texto_problema($tipo_texto_problema);			
		$problema->set_enunciado($enunciado);			
		
	//MANEJADOR DE EVENTOS
	switch($evento){
		case 'reporte_html_individual':{
			$problema->registrar_bitacora("Consulta detallada","Problemas");
			$html_todo=$problema->reporte_html_individual();
			
			}
		break;
		case 'formulario_modificar':{
			$html_todo=$problema->formulario('modificar');
			}
		break;
		case 'formulario_registrar':{
			$html_todo=$problema->formulario('registrar');
		}
		break;
		case 'registrar':{
			$caso_de_prueba = new caso_de_prueba;
			$problema->iniciar_transaccion();
			if($problema->registrar()==1){	
			$ultimo_id=$problema->ultimo_id();
			$caso_de_prueba->set_cod_problema($ultimo_id);
				for($i=0 ; $i<count($input); $i++){
					$caso_de_prueba->set_input($input[$i]);
					$caso_de_prueba->set_output($output[$i]);
					$caso_de_prueba->set_descripcion($descripcion[$i]);
					$caso_de_prueba->set_ejemplo($ejemplo[$i]);
					$caso_de_prueba->registrar_minimo();
				}
			}
			$problema->commit();
			$_SESSION['msj']='Registrado correctamente';
			$_SESSION['msj_tipo']='success';
			$problema->registrar_bitacora("Registro","Problemas con Nro. Unico: ".$problema->ultimo_id());			
			$html_todo=$problema->formulario('registrar');
		}
		break;
		case 'modificar':{
			$caso_de_prueba = new caso_de_prueba;
			$problema->iniciar_transaccion();
			$result=$problema->modificar();
			if($result==1 || $result==0){
				$caso_de_prueba->set_cod_problema($cod_problema);

				$caso_de_prueba->elimina_por('cod_problema');
				$input=array_reverse($input,true);
				foreach($input as $i=>$valor){
					$caso_de_prueba->set_input($input[$i]);
					$caso_de_prueba->set_output($output[$i]);
					$caso_de_prueba->set_descripcion($descripcion[$i]);
					$caso_de_prueba->set_ejemplo($ejemplo[$i]);
					$caso_de_prueba->registrar();
				}
				$problema->commit();
				$_SESSION['msj']='Los cambios se han realizado correctamente';
				$_SESSION['msj_tipo']='success';
				$problema->registrar_bitacora("Modifico","Problemas Nro. ".$cod_problema);
			}else{
		
				$problema->rollback();	
				
			}
			$html_todo=$problema->formulario('modificar');
		}
		break;
		case 'desactivar':{
			if($problema->desactivar()==1){
				$_SESSION['msj']='Registro desactivado';
				$_SESSION['msj_tipo']='warning';
				$problema->registrar_bitacora("Desactivo","Problemas Nro. ".$cod_problema);
			}
			$html_todo=$problema->reporte_html_general($vista);
		}
		break;
		case 'activar':{
			if($problema->activar()==1){
				$_SESSION['msj']='Registro activado';
				$_SESSION['msj_tipo']='warning';
				$problema->registrar_bitacora("Activo","Problemas Nro. ".$cod_problema);
			}
			$html_todo=$problema->reporte_html_general($vista);
		}
		break;
		case 'enunciado':{
			generar_enunciado_publico_pdf($cod_problema);
			
		}
		break;
		case 'eliminar':{
			if($problema->eliminar()==1){
				$_SESSION['msj']='Eliminado correctamente.';
				$_SESSION['msj_tipo']='success';
				$problema->registrar_bitacora("Elimino","Problemas Nro. ".$cod_problema);
			}
			$html_todo=$problema->reporte_html_general($vista);
		}
		break;
		default:{
			$problema->registrar_bitacora("Listo","Problemas");
			$html_todo=$problema->reporte_html_general($vista);
			
		}
		break;
	};
	
	function generar_enunciado_publico_pdf($cod_problema){
		$problema = new problema;
		$problema->set_cod_problema($cod_problema);
		if($problema->consultar()==1){
			require_once("libreria/fpdf181/class_html_pdf.php");
			$caso_de_prueba = new caso_de_prueba;
			$caso_de_prueba->set_cod_problema($cod_problema);
			
				
			$lobjPdf=new PDF_HTML();
			$lobjPdf->AliasNbPages();
			$lobjPdf->AddPage("P","Letter");
			$lobjPdf->SetAutoPageBreak(true,10);  
			$lobjPdf->Ln(0);
			$lobjPdf->SetFont("Arial","B",15);
			$lobjPdf->Cell(0,6,utf8_decode("PROBLEMA Nro.").$problema->cod_problema,0,1,"C");
			$c=7;
			$lobjPdf->Ln(2);  
			$lobjPdf->SetFont("Arial","B",13);
			$lobjPdf->Cell(0,6,strtoupper("{ ".utf8_decode($problema->nombre)." }"),0,1,"C");
			$lobjPdf->Ln(2);
			$lobjPdf->SetFont("Arial","B",10);
			$lobjPdf->Cell(0,$c,'ENUNCIADO DEL PROBLEMA:',0,0,'C',false);
			$lobjPdf->Ln();
			$lobjPdf->SetFont("Arial","",10);

			$lobjPdf->WriteHTML(utf8_decode($problema->enunciado));
			$lobjPdf->Ln(1);
			if($problema->texto_problema){
				$formato=formato($problema->texto_problema);
				
				$lobjPdf->Cell( 40, 40, $lobjPdf->Image($problema->texto_problema, $lobjPdf->GetX(), $lobjPdf->GetY(), 90,0,$formato), 0, 0, 'C', false );
				$lobjPdf->Ln(70);
			}
			
			$lobjPdf->SetFont("Arial","B",10);
			$lobjPdf->Cell(0,$c,'CASOS DE EJEMPLO:',0,0,'C',false);
			$lobjPdf->Ln();
			$i=0;
			if($caso_de_prueba->consulta_para_reporte_pdf()>0){
				while($row=$caso_de_prueba->row()){
					$i++;
					$lobjPdf->SetFont("Arial","B",10);
					$lobjPdf->Cell(0,$c,'EJEMPLO '.$i,0,0,'C',false);
					$lobjPdf->Ln();
					$lobjPdf->Cell(100,$c,'DATOS DE ENTRADA',1,0,'C',false);
					$lobjPdf->Cell(0,$c,'DATOS DE SALIDA',1,0,'C',false);
					$lobjPdf->Ln();
					$lobjPdf->SetFont("Arial","",10);
					$lobjPdf->SetWidths(array(100,96));
					$lobjPdf->Row(array(utf8_decode($row['input']),utf8_decode($row['output'])));
					$lobjPdf->Ln();
					$lobjPdf->Ln();
				}
				
			}
		$lobjPdf->Output();
		}else{
			$_SESSION['msj']='Enunciado del problema no encontrado o esta desactivado, intente nuevamente o contacte al administrador.';
			$_SESSION['msj_tipo']='danger';	
			$_SESSION['redireccion']='index.php';	
		
		}
	}

function formato($url){
	$formato=explode(".",$url);
	$a=count($formato);
	return strtoupper($formato[$a-1]);
}

		?>
		
