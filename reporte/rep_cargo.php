<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_cargo.php");
   $cargo = new cargo;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Cargo",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_cargo="Codigo"; 
		$nombre_nombre="Nombre";
	
		$suma_mayor_cod_cargo=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_cargo));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));$suma_mayor=0;    
   $cargo->listar();
      while ($row=$cargo->row()){
				$suma_cod_cargo=$lobjPdf->GetStringWidth($row["cod_cargo"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
		if($suma_cod_cargo>$suma_mayor_cod_cargo){
			$suma_mayor_cod_cargo=$suma_cod_cargo;
		}
		$suma_cod_cargo=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_cargo+2),6,utf8_decode($nombre_cod_cargo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $cargo->listar();
   while ($row=$cargo->row()){
				$lobjPdf->Cell(($suma_mayor_cod_cargo+2),6,utf8_decode($row["cod_cargo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
