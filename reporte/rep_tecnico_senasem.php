<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_tecnico_senasem.php");
   $tecnico_senasem = new tecnico_senasem;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,utf8_decode("Reporte de Técnico Senasem"),0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cedula_tecnico="Cedula"; 
		$nombre_nombre="Nombre"; 
		$nombre_apellido="Apellido"; 
		$nombre_telefono="Teléfono";
	
		$suma_mayor_cedula_tecnico=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula_tecnico));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_apellido=$lobjPdf->GetStringWidth(utf8_decode($nombre_apellido));
		$suma_mayor_telefono=$lobjPdf->GetStringWidth(utf8_decode($nombre_telefono));$suma_mayor=0;    
   $tecnico_senasem->listar();
      while ($row=$tecnico_senasem->row()){
				$suma_cedula_tecnico=$lobjPdf->GetStringWidth($row["cedula_tecnico"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
				$suma_apellido=$lobjPdf->GetStringWidth($row["apellido"]);
				$suma_telefono=$lobjPdf->GetStringWidth($row["telefono"]);
		if($suma_cedula_tecnico>$suma_mayor_cedula_tecnico){
			$suma_mayor_cedula_tecnico=$suma_cedula_tecnico;
		}
		$suma_cedula_tecnico=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_apellido>$suma_mayor_apellido){
			$suma_mayor_apellido=$suma_apellido;
		}
		$suma_apellido=0;
		if($suma_telefono>$suma_mayor_telefono){
			$suma_mayor_telefono=$suma_telefono;
		}
		$suma_telefono=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cedula_tecnico+2),6,utf8_decode($nombre_cedula_tecnico),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_apellido+2),6,utf8_decode($nombre_apellido),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_telefono+2),6,utf8_decode($nombre_telefono),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $tecnico_senasem->listar();
   while ($row=$tecnico_senasem->row()){
				$lobjPdf->Cell(($suma_mayor_cedula_tecnico+2),6,utf8_decode($row["cedula_tecnico"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_apellido+2),6,utf8_decode($row["apellido"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_telefono+2),6,utf8_decode($row["telefono"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
