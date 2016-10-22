<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_cava.php");
   $cava = new cava;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Cavas",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_cava="Codigo"; 
		$nombre_descripcion="Descripción"; 
		$nombre_temperatura="Temperatura"; 
		$nombre_fecha_ingreso="Fecha de ingreso";
	
		$suma_mayor_cod_cava=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_cava));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));
		$suma_mayor_temperatura=$lobjPdf->GetStringWidth(utf8_decode($nombre_temperatura));
		$suma_mayor_fecha_ingreso=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_ingreso));$suma_mayor=0;    
   $cava->listar();
      while ($row=$cava->row()){
				$suma_cod_cava=$lobjPdf->GetStringWidth($row["cod_cava"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
				$suma_temperatura=$lobjPdf->GetStringWidth($row["temperatura"]);
				$suma_fecha_ingreso=$lobjPdf->GetStringWidth($row["fecha_ingreso"]);
		if($suma_cod_cava>$suma_mayor_cod_cava){
			$suma_mayor_cod_cava=$suma_cod_cava;
		}
		$suma_cod_cava=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
		if($suma_temperatura>$suma_mayor_temperatura){
			$suma_mayor_temperatura=$suma_temperatura;
		}
		$suma_temperatura=0;
		if($suma_fecha_ingreso>$suma_mayor_fecha_ingreso){
			$suma_mayor_fecha_ingreso=$suma_fecha_ingreso;
		}
		$suma_fecha_ingreso=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_cava+2),6,utf8_decode($nombre_cod_cava),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($nombre_descripcion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_temperatura+2),6,utf8_decode($nombre_temperatura),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_ingreso+2),6,utf8_decode($nombre_fecha_ingreso),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $cava->listar();
   while ($row=$cava->row()){
				$lobjPdf->Cell(($suma_mayor_cod_cava+2),6,utf8_decode($row["cod_cava"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($row["descripcion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_temperatura+2),6,utf8_decode($row["temperatura"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_ingreso+2),6,utf8_decode($row["fecha_ingreso"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
