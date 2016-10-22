<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_presentacion_saco.php");
   $presentacion_saco = new presentacion_saco;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,utf8_decode("Reporte de Presentación de sacos"),0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_presentacion_saco="Codigo"; 
		$nombre_nombre="Nombre";
	
		$suma_mayor_cod_presentacion_saco=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_presentacion_saco));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));$suma_mayor=0;    
   $presentacion_saco->listar();
      while ($row=$presentacion_saco->row()){
				$suma_cod_presentacion_saco=$lobjPdf->GetStringWidth($row["cod_presentacion_saco"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
		if($suma_cod_presentacion_saco>$suma_mayor_cod_presentacion_saco){
			$suma_mayor_cod_presentacion_saco=$suma_cod_presentacion_saco;
		}
		$suma_cod_presentacion_saco=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_presentacion_saco+2),6,utf8_decode($nombre_cod_presentacion_saco),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $presentacion_saco->listar();
   while ($row=$presentacion_saco->row()){
				$lobjPdf->Cell(($suma_mayor_cod_presentacion_saco+2),6,utf8_decode($row["cod_presentacion_saco"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
