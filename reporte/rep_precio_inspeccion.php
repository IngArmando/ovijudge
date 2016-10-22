<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_precio_inspeccion.php");
   $precio_inspeccion = new precio_inspeccion;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de precio_inspeccion",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_precio="precio";
	
		$suma_mayor_precio=$lobjPdf->GetStringWidth(utf8_decode($nombre_precio));$suma_mayor=0;    
   $precio_inspeccion->listar();
      while ($row=$precio_inspeccion->row()){
				$suma_precio=$lobjPdf->GetStringWidth($row["precio"]);
		if($suma_precio>$suma_mayor_precio){
			$suma_mayor_precio=$suma_precio;
		}
		$suma_precio=0;
   } 
		$lobjPdf->Cell(($suma_mayor_precio+2),6,utf8_decode($nombre_precio),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $precio_inspeccion->listar();
   while ($row=$precio_inspeccion->row()){
				$lobjPdf->Cell(($suma_mayor_precio+2),6,utf8_decode($row["precio"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>