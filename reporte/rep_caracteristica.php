<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_caracteristica.php");
   $caracteristica = new caracteristica;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Característica",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_caracteristica="Codigo"; 
		$nombre_cod_tipo_caracteristica="Tipo de característica"; 
		$nombre_descripcion="Descripción";
	
		$suma_mayor_cod_caracteristica=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_caracteristica));
		$suma_mayor_cod_tipo_caracteristica=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_caracteristica));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));$suma_mayor=0;    
   $caracteristica->listar();
      while ($row=$caracteristica->row()){
				$suma_cod_caracteristica=$lobjPdf->GetStringWidth($row["cod_caracteristica"]);
	include_once("modelo/class_tipo_caracteristica.php");
	$tipo_caracteristica = new tipo_caracteristica;
	$tipo_caracteristica->set_cod_tipo_caracteristica($row["cod_tipo_caracteristica"]);
	$tipo_caracteristica->consultar();
	$row_tipo_caracteristica=$tipo_caracteristica->row();
	$suma_cod_tipo_caracteristica=$lobjPdf->GetStringWidth($row_tipo_caracteristica["nombre"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
		if($suma_cod_caracteristica>$suma_mayor_cod_caracteristica){
			$suma_mayor_cod_caracteristica=$suma_cod_caracteristica;
		}
		$suma_cod_caracteristica=0;
		if($suma_cod_tipo_caracteristica>$suma_mayor_cod_tipo_caracteristica){
			$suma_mayor_cod_tipo_caracteristica=$suma_cod_tipo_caracteristica;
		}
		$suma_cod_tipo_caracteristica=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_caracteristica+2),6,utf8_decode($nombre_cod_caracteristica),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_caracteristica+2),6,utf8_decode($nombre_cod_tipo_caracteristica),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($nombre_descripcion),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $caracteristica->listar();
   while ($row=$caracteristica->row()){
				$lobjPdf->Cell(($suma_mayor_cod_caracteristica+2),6,utf8_decode($row["cod_caracteristica"]),1,0,"R");
	include_once("modelo/class_tipo_caracteristica.php");
	$tipo_caracteristica = new tipo_caracteristica;
	$tipo_caracteristica->set_cod_tipo_caracteristica($row["cod_tipo_caracteristica"]);
	$tipo_caracteristica->consultar();
	$row_tipo_caracteristica=$tipo_caracteristica->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_tipo_caracteristica+2),6,utf8_decode($row_tipo_caracteristica["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($row["descripcion"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>