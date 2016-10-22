<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_campo.php");
   $campo = new campo;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Campos",0,1,"C");
   $lobjPdf->SetFont("arial","B",9);
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_codigo_campo="Codigo"; 
		$nombre_rif_productora="Empresa"; 
		$nombre_cod_cooperador="Cooperador"; 
		$nombre_cod_finca="Finca o Hacienda"; 
		$nombre_ubicacion="Ubicación"; 
		$nombre_cod_rubro="Rubro"; 
		$nombre_hectareas="Nro. de Hectareas"; 
		$nombre_fecha_inscripcion="Fecha de inscripción"; 
		$nombre_fecha_siembra="Fecha de Siembra"; 
		$nombre_cod_clase_solicitud="Clase";
	
		$suma_mayor_codigo_campo=$lobjPdf->GetStringWidth(utf8_decode($nombre_codigo_campo));
		$suma_mayor_rif_productora=$lobjPdf->GetStringWidth(utf8_decode($nombre_rif_productora));
		$suma_mayor_cod_cooperador=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_cooperador));
		$suma_mayor_cod_finca=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_finca));
		$suma_mayor_ubicacion=$lobjPdf->GetStringWidth(utf8_decode($nombre_ubicacion));
		$suma_mayor_cod_rubro=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_rubro));
		$suma_mayor_hectareas=$lobjPdf->GetStringWidth(utf8_decode($nombre_hectareas));
		$suma_mayor_fecha_inscripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_inscripcion));
		$suma_mayor_fecha_siembra=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_siembra));
		$suma_mayor_cod_clase_solicitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_clase_solicitud));$suma_mayor=0;    
   $campo->listar();
      while ($row=$campo->row()){
				$suma_codigo_campo=$lobjPdf->GetStringWidth($row["codigo_campo"]);
	include_once("modelo/class_empresa_productora.php");
	$empresa_productora = new empresa_productora;
	$empresa_productora->set_rif_productora($row["rif_productora"]);
	$empresa_productora->consultar();
	$row_empresa_productora=$empresa_productora->row();
	$suma_rif_productora=$lobjPdf->GetStringWidth($row_empresa_productora["nombre"]);
	include_once("modelo/class_cooperador.php");
	$cooperador = new cooperador;
	$cooperador->set_cod_cooperador($row["cod_cooperador"]);
	$cooperador->consultar();
	$row_cooperador=$cooperador->row();
	$suma_cod_cooperador=$lobjPdf->GetStringWidth($row_cooperador["nombre"]);
	include_once("modelo/class_finca.php");
	$finca = new finca;
	$finca->set_cod_finca($row["cod_finca"]);
	$finca->consultar();
	$row_finca=$finca->row();
	$suma_cod_finca=$lobjPdf->GetStringWidth($row_finca["nombre"]);
				$suma_ubicacion=$lobjPdf->GetStringWidth($row["ubicacion"]);
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->set_cod_rubro($row["cod_rubro"]);
	$rubro->consultar();
	$row_rubro=$rubro->row();
	$suma_cod_rubro=$lobjPdf->GetStringWidth($row_rubro["nombre"]);
				$suma_hectareas=$lobjPdf->GetStringWidth($row["hectareas"]);
				$suma_fecha_inscripcion=$lobjPdf->GetStringWidth($row["fecha_inscripcion"]);
				$suma_fecha_siembra=$lobjPdf->GetStringWidth($row["fecha_siembra"]);
	include_once("modelo/class_clase_solicitud.php");
	$clase_solicitud = new clase_solicitud;
	$clase_solicitud->set_cod_clase_solicitud($row["cod_clase_solicitud"]);
	$clase_solicitud->consultar();
	$row_clase_solicitud=$clase_solicitud->row();
	$suma_cod_clase_solicitud=$lobjPdf->GetStringWidth($row_clase_solicitud["nombre"]);
		if($suma_codigo_campo>$suma_mayor_codigo_campo){
			$suma_mayor_codigo_campo=$suma_codigo_campo;
		}
		$suma_codigo_campo=0;
		if($suma_rif_productora>$suma_mayor_rif_productora){
			$suma_mayor_rif_productora=$suma_rif_productora;
		}
		$suma_rif_productora=0;
		if($suma_cod_cooperador>$suma_mayor_cod_cooperador){
			$suma_mayor_cod_cooperador=$suma_cod_cooperador;
		}
		$suma_cod_cooperador=0;
		if($suma_cod_finca>$suma_mayor_cod_finca){
			$suma_mayor_cod_finca=$suma_cod_finca;
		}
		$suma_cod_finca=0;
		if($suma_ubicacion>$suma_mayor_ubicacion){
			$suma_mayor_ubicacion=$suma_ubicacion;
		}
		$suma_ubicacion=0;
		if($suma_cod_rubro>$suma_mayor_cod_rubro){
			$suma_mayor_cod_rubro=$suma_cod_rubro;
		}
		$suma_cod_rubro=0;
		if($suma_hectareas>$suma_mayor_hectareas){
			$suma_mayor_hectareas=$suma_hectareas;
		}
		$suma_hectareas=0;
		if($suma_fecha_inscripcion>$suma_mayor_fecha_inscripcion){
			$suma_mayor_fecha_inscripcion=$suma_fecha_inscripcion;
		}
		$suma_fecha_inscripcion=0;
		if($suma_fecha_siembra>$suma_mayor_fecha_siembra){
			$suma_mayor_fecha_siembra=$suma_fecha_siembra;
		}
		$suma_fecha_siembra=0;
		if($suma_cod_clase_solicitud>$suma_mayor_cod_clase_solicitud){
			$suma_mayor_cod_clase_solicitud=$suma_cod_clase_solicitud;
		}
		$suma_cod_clase_solicitud=0;
   } 
		$lobjPdf->Cell(($suma_mayor_codigo_campo+2),6,utf8_decode($nombre_codigo_campo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_rif_productora+2),6,utf8_decode($nombre_rif_productora),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_cooperador+2),6,utf8_decode($nombre_cod_cooperador),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_finca+2),6,utf8_decode($nombre_cod_finca),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_ubicacion+2),6,utf8_decode($nombre_ubicacion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($nombre_cod_rubro),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_hectareas+2),6,utf8_decode($nombre_hectareas),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_inscripcion+2),6,utf8_decode($nombre_fecha_inscripcion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_siembra+2),6,utf8_decode($nombre_fecha_siembra),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_clase_solicitud+2),6,utf8_decode($nombre_cod_clase_solicitud),1,0,"C");
   $lobjPdf->SetFont("arial","",9);
   $lobjPdf->Ln();
      $campo->listar();
   while ($row=$campo->row()){
				$lobjPdf->Cell(($suma_mayor_codigo_campo+2),6,utf8_decode($row["codigo_campo"]),1,0,"R");
	include_once("modelo/class_empresa_productora.php");
	$empresa_productora = new empresa_productora;
	$empresa_productora->set_rif_productora($row["rif_productora"]);
	$empresa_productora->consultar();
	$row_empresa_productora=$empresa_productora->row();
	
	$lobjPdf->Cell(($suma_mayor_rif_productora+2),6,utf8_decode($row_empresa_productora["nombre"]),1,0,"R");
	include_once("modelo/class_cooperador.php");
	$cooperador = new cooperador;
	$cooperador->set_cod_cooperador($row["cod_cooperador"]);
	$cooperador->consultar();
	$row_cooperador=$cooperador->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_cooperador+2),6,utf8_decode($row_cooperador["nombre"]),1,0,"R");
	include_once("modelo/class_finca.php");
	$finca = new finca;
	$finca->set_cod_finca($row["cod_finca"]);
	$finca->consultar();
	$row_finca=$finca->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_finca+2),6,utf8_decode($row_finca["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_ubicacion+2),6,utf8_decode($row["ubicacion"]),1,0,"R");
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->set_cod_rubro($row["cod_rubro"]);
	$rubro->consultar();
	$row_rubro=$rubro->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($row_rubro["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_hectareas+2),6,utf8_decode($row["hectareas"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_inscripcion+2),6,utf8_decode($row["fecha_inscripcion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_siembra+2),6,utf8_decode($row["fecha_siembra"]),1,0,"R");
	include_once("modelo/class_clase_solicitud.php");
	$clase_solicitud = new clase_solicitud;
	$clase_solicitud->set_cod_clase_solicitud($row["cod_clase_solicitud"]);
	$clase_solicitud->consultar();
	$row_clase_solicitud=$clase_solicitud->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_clase_solicitud+2),6,utf8_decode($row_clase_solicitud["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
