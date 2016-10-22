<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_historial_accension.php");
   $historial_accension = new historial_accension;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Historial de accesión",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_historial="Codigo"; 
		$nombre_fecha="Fecha"; 
		$nombre_cod_accension="Accesión"; 
		$nombre_observacion="Observación";
	
		$suma_mayor_cod_historial=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_historial));
		$suma_mayor_fecha=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha));
		$suma_mayor_cod_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_accension));
		$suma_mayor_observacion=$lobjPdf->GetStringWidth(utf8_decode($nombre_observacion));$suma_mayor=0;    
   $historial_accension->listar();
      while ($row=$historial_accension->row()){
				$suma_cod_historial=$lobjPdf->GetStringWidth($row["cod_historial"]);
				$suma_fecha=$lobjPdf->GetStringWidth($row["fecha"]);
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	$suma_cod_accension=$lobjPdf->GetStringWidth($row_accension["cod_accension"]);
				$suma_observacion=$lobjPdf->GetStringWidth($row["observacion"]);
		if($suma_cod_historial>$suma_mayor_cod_historial){
			$suma_mayor_cod_historial=$suma_cod_historial;
		}
		$suma_cod_historial=0;
		if($suma_fecha>$suma_mayor_fecha){
			$suma_mayor_fecha=$suma_fecha;
		}
		$suma_fecha=0;
		if($suma_cod_accension>$suma_mayor_cod_accension){
			$suma_mayor_cod_accension=$suma_cod_accension;
		}
		$suma_cod_accension=0;
		if($suma_observacion>$suma_mayor_observacion){
			$suma_mayor_observacion=$suma_observacion;
		}
		$suma_observacion=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_historial+2),6,utf8_decode($nombre_cod_historial),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha+2),6,utf8_decode($nombre_fecha),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($nombre_cod_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_observacion+2),6,utf8_decode($nombre_observacion),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $historial_accension->listar();
   while ($row=$historial_accension->row()){
				$lobjPdf->Cell(($suma_mayor_cod_historial+2),6,utf8_decode($row["cod_historial"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha+2),6,utf8_decode($row["fecha"]),1,0,"R");
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($row_accension["cod_accension"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_observacion+2),6,utf8_decode($row["observacion"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>