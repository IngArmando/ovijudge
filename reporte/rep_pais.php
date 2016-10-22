<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_pais.php");
   $pais = new pais;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Paises",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_pais="Codigo"; 
		$nombre_nombre="nombre";
	
		$suma_mayor_cod_pais=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_pais));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));$suma_mayor=0;    
   $pais->listar();
      while ($row=$pais->row()){
				$suma_cod_pais=$lobjPdf->GetStringWidth($row["cod_pais"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
		if($suma_cod_pais>$suma_mayor_cod_pais){
			$suma_mayor_cod_pais=$suma_cod_pais;
		}
		$suma_cod_pais=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_pais+2),6,utf8_decode($nombre_cod_pais),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $pais->listar();
   while ($row=$pais->row()){
				$lobjPdf->Cell(($suma_mayor_cod_pais+2),6,utf8_decode($row["cod_pais"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
