<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_tipo_suelo.php");
   $tipo_suelo = new tipo_suelo;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Tipos de suelos",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_tipo_suelo="Codigo"; 
		$nombre_nombre="Nombre";
	
		$suma_mayor_cod_tipo_suelo=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_suelo));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));$suma_mayor=0;    
   $tipo_suelo->listar();
      while ($row=$tipo_suelo->row()){
				$suma_cod_tipo_suelo=$lobjPdf->GetStringWidth($row["cod_tipo_suelo"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
		if($suma_cod_tipo_suelo>$suma_mayor_cod_tipo_suelo){
			$suma_mayor_cod_tipo_suelo=$suma_cod_tipo_suelo;
		}
		$suma_cod_tipo_suelo=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_suelo+2),6,utf8_decode($nombre_cod_tipo_suelo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $tipo_suelo->listar();
   while ($row=$tipo_suelo->row()){
				$lobjPdf->Cell(($suma_mayor_cod_tipo_suelo+2),6,utf8_decode($row["cod_tipo_suelo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
