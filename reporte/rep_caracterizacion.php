<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_caracterizacion.php");
   $caracterizacion = new caracterizacion;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Caracterización",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_caracteristica="Característica"; 
		$nombre_cod_accension="Accesión"; 
		$nombre_resultado="Resultado";
	
		$suma_mayor_cod_caracteristica=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_caracteristica));
		$suma_mayor_cod_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_accension));
		$suma_mayor_resultado=$lobjPdf->GetStringWidth(utf8_decode($nombre_resultado));$suma_mayor=0;    
   $caracterizacion->listar();
      while ($row=$caracterizacion->row()){
	include_once("modelo/class_caracteristica.php");
	$caracteristica = new caracteristica;
	$caracteristica->set_cod_caracteristica($row["cod_caracteristica"]);
	$caracteristica->consultar();
	$row_caracteristica=$caracteristica->row();
	$suma_cod_caracteristica=$lobjPdf->GetStringWidth($row_caracteristica["descripcion"]);
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	$suma_cod_accension=$lobjPdf->GetStringWidth($row_accension["cod_accension"]);
				$suma_resultado=$lobjPdf->GetStringWidth($row["resultado"]);
		if($suma_cod_caracteristica>$suma_mayor_cod_caracteristica){
			$suma_mayor_cod_caracteristica=$suma_cod_caracteristica;
		}
		$suma_cod_caracteristica=0;
		if($suma_cod_accension>$suma_mayor_cod_accension){
			$suma_mayor_cod_accension=$suma_cod_accension;
		}
		$suma_cod_accension=0;
		if($suma_resultado>$suma_mayor_resultado){
			$suma_mayor_resultado=$suma_resultado;
		}
		$suma_resultado=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_caracteristica+2),6,utf8_decode($nombre_cod_caracteristica),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($nombre_cod_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_resultado+2),6,utf8_decode($nombre_resultado),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $caracterizacion->listar();
   while ($row=$caracterizacion->row()){
	include_once("modelo/class_caracteristica.php");
	$caracteristica = new caracteristica;
	$caracteristica->set_cod_caracteristica($row["cod_caracteristica"]);
	$caracteristica->consultar();
	$row_caracteristica=$caracteristica->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_caracteristica+2),6,utf8_decode($row_caracteristica["descripcion"]),1,0,"R");
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($row_accension["cod_accension"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_resultado+2),6,utf8_decode($row["resultado"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>