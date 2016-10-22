<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_detalle_solicitud_accension.php");
   $detalle_solicitud_accension = new detalle_solicitud_accension;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Detalles",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_solicitud="Codigo"; 
		$nombre_cod_accension="Accesión"; 
		$nombre_gramos="Gramos";
	
		$suma_mayor_cod_solicitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_solicitud));
		$suma_mayor_cod_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_accension));
		$suma_mayor_gramos=$lobjPdf->GetStringWidth(utf8_decode($nombre_gramos));$suma_mayor=0;    
   $detalle_solicitud_accension->listar();
      while ($row=$detalle_solicitud_accension->row()){
	include_once("modelo/class_solicitud.php");
	$solicitud = new solicitud;
	$solicitud->set_cod_solicitud($row["cod_solicitud"]);
	$solicitud->consultar();
	$row_solicitud=$solicitud->row();
	$suma_cod_solicitud=$lobjPdf->GetStringWidth($row_solicitud["descripcion"]);
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	$suma_cod_accension=$lobjPdf->GetStringWidth($row_accension["pedigree"]);
				$suma_gramos=$lobjPdf->GetStringWidth($row["gramos"]);
		if($suma_cod_solicitud>$suma_mayor_cod_solicitud){
			$suma_mayor_cod_solicitud=$suma_cod_solicitud;
		}
		$suma_cod_solicitud=0;
		if($suma_cod_accension>$suma_mayor_cod_accension){
			$suma_mayor_cod_accension=$suma_cod_accension;
		}
		$suma_cod_accension=0;
		if($suma_gramos>$suma_mayor_gramos){
			$suma_mayor_gramos=$suma_gramos;
		}
		$suma_gramos=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_solicitud+2),6,utf8_decode($nombre_cod_solicitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($nombre_cod_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_gramos+2),6,utf8_decode($nombre_gramos),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $detalle_solicitud_accension->listar();
   while ($row=$detalle_solicitud_accension->row()){
	include_once("modelo/class_solicitud.php");
	$solicitud = new solicitud;
	$solicitud->set_cod_solicitud($row["cod_solicitud"]);
	$solicitud->consultar();
	$row_solicitud=$solicitud->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_solicitud+2),6,utf8_decode($row_solicitud["descripcion"]),1,0,"R");
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($row_accension["pedigree"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_gramos+2),6,utf8_decode($row["gramos"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>