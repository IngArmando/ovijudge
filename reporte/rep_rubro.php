<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_rubro.php");
   $rubro = new rubro;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Rubros",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_rubro="Codigo"; 
		$nombre_nombre="Nombre"; 
		$nombre_nombre_cientifico="Nombre científico";
	
		$suma_mayor_cod_rubro=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_rubro));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_nombre_cientifico=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre_cientifico));$suma_mayor=0;    
   $rubro->listar();
      while ($row=$rubro->row()){
				$suma_cod_rubro=$lobjPdf->GetStringWidth($row["cod_rubro"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
				$suma_nombre_cientifico=$lobjPdf->GetStringWidth($row["nombre_cientifico"]);
		if($suma_cod_rubro>$suma_mayor_cod_rubro){
			$suma_mayor_cod_rubro=$suma_cod_rubro;
		}
		$suma_cod_rubro=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_nombre_cientifico>$suma_mayor_nombre_cientifico){
			$suma_mayor_nombre_cientifico=$suma_nombre_cientifico;
		}
		$suma_nombre_cientifico=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($nombre_cod_rubro),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre_cientifico+2),6,utf8_decode($nombre_nombre_cientifico),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $rubro->listar();
   while ($row=$rubro->row()){
				$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($row["cod_rubro"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre_cientifico+2),6,utf8_decode($row["nombre_cientifico"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
