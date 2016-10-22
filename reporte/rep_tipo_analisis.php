<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_tipo_analisis.php");
   $tipo_analisis = new tipo_analisis;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Tipos de Analisis y precios",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_tipo_analisis="Codigo"; 
		$nombre_nombre="Descripcion"; 
		$nombre_precio="Precio";
	
		$suma_mayor_cod_tipo_analisis=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_analisis));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_precio=$lobjPdf->GetStringWidth(utf8_decode($nombre_precio));$suma_mayor=0;    
   $tipo_analisis->listar();
      while ($row=$tipo_analisis->row()){
				$suma_cod_tipo_analisis=$lobjPdf->GetStringWidth($row["cod_tipo_analisis"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
				$suma_precio=$lobjPdf->GetStringWidth($row["precio"]);
		if($suma_cod_tipo_analisis>$suma_mayor_cod_tipo_analisis){
			$suma_mayor_cod_tipo_analisis=$suma_cod_tipo_analisis;
		}
		$suma_cod_tipo_analisis=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_precio>$suma_mayor_precio){
			$suma_mayor_precio=$suma_precio;
		}
		$suma_precio=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_analisis+2),6,utf8_decode($nombre_cod_tipo_analisis),1,0,"C"); 
		$lobjPdf->Cell(160,6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_precio+2),6,utf8_decode($nombre_precio),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $tipo_analisis->listar();
   while ($row=$tipo_analisis->row()){
				$lobjPdf->Cell(($suma_mayor_cod_tipo_analisis+2),6,utf8_decode($row["cod_tipo_analisis"]),1,0,"L");
				$lobjPdf->Cell(160,6,utf8_decode($row["nombre"]),1,0,"L");
				$lobjPdf->Cell(($suma_mayor_precio+2),6,utf8_decode(bs($row["precio"])),1,1,"R");
   }
   $lobjPdf->Output(); 
  function bs($number){
	return number_format($number, 2, ',', '.');
	
	} 
  ?>
