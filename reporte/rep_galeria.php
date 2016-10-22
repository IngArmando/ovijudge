<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_galeria.php");
   $galeria = new galeria;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Galería de la accesión",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_galeria="Codigo"; 
		$nombre_imagen="Imagen"; 
		$nombre_cod_accension="Accesión";
	
		$suma_mayor_cod_galeria=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_galeria));
		$suma_mayor_imagen=$lobjPdf->GetStringWidth(utf8_decode($nombre_imagen));
		$suma_mayor_cod_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_accension));$suma_mayor=0;    
   $galeria->listar();
      while ($row=$galeria->row()){
				$suma_cod_galeria=$lobjPdf->GetStringWidth($row["cod_galeria"]);
				$suma_imagen=$lobjPdf->GetStringWidth($row["imagen"]);
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	$suma_cod_accension=$lobjPdf->GetStringWidth($row_accension["cod_accension"]);
		if($suma_cod_galeria>$suma_mayor_cod_galeria){
			$suma_mayor_cod_galeria=$suma_cod_galeria;
		}
		$suma_cod_galeria=0;
		if($suma_imagen>$suma_mayor_imagen){
			$suma_mayor_imagen=$suma_imagen;
		}
		$suma_imagen=0;
		if($suma_cod_accension>$suma_mayor_cod_accension){
			$suma_mayor_cod_accension=$suma_cod_accension;
		}
		$suma_cod_accension=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_galeria+2),6,utf8_decode($nombre_cod_galeria),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_imagen+2),6,utf8_decode($nombre_imagen),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($nombre_cod_accension),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $galeria->listar();
   while ($row=$galeria->row()){
				$lobjPdf->Cell(($suma_mayor_cod_galeria+2),6,utf8_decode($row["cod_galeria"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_imagen+2),6,utf8_decode($row["imagen"]),1,0,"R");
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($row_accension["cod_accension"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>