<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_informacion.php");
   $informacion = new informacion;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de informacion",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_informacion="cod_informacion"; 
		$nombre_titulo="titulo"; 
		$nombre_descripcion="descripcion";
	
		$suma_mayor_cod_informacion=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_informacion));
		$suma_mayor_titulo=$lobjPdf->GetStringWidth(utf8_decode($nombre_titulo));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));$suma_mayor=0;    
   $informacion->listar();
      while ($row=$informacion->row()){
				$suma_cod_informacion=$lobjPdf->GetStringWidth($row["cod_informacion"]);
				$suma_titulo=$lobjPdf->GetStringWidth($row["titulo"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
		if($suma_cod_informacion>$suma_mayor_cod_informacion){
			$suma_mayor_cod_informacion=$suma_cod_informacion;
		}
		$suma_cod_informacion=0;
		if($suma_titulo>$suma_mayor_titulo){
			$suma_mayor_titulo=$suma_titulo;
		}
		$suma_titulo=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_informacion+2),6,utf8_decode($nombre_cod_informacion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_titulo+2),6,utf8_decode($nombre_titulo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($nombre_descripcion),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $informacion->listar();
   while ($row=$informacion->row()){
				$lobjPdf->Cell(($suma_mayor_cod_informacion+2),6,utf8_decode($row["cod_informacion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_titulo+2),6,utf8_decode($row["titulo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($row["descripcion"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>