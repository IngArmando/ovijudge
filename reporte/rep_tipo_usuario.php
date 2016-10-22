<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_tipo_usuario.php");
   $tipo_usuario = new tipo_usuario;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Tipo de usuarios",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_tipo_usuario="Codigo"; 
		$nombre_nombre="Nombre";
	
		$suma_mayor_cod_tipo_usuario=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_usuario));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));$suma_mayor=0;    
   $tipo_usuario->listar();
      while ($row=$tipo_usuario->row()){
				$suma_cod_tipo_usuario=$lobjPdf->GetStringWidth($row["cod_tipo_usuario"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
		if($suma_cod_tipo_usuario>$suma_mayor_cod_tipo_usuario){
			$suma_mayor_cod_tipo_usuario=$suma_cod_tipo_usuario;
		}
		$suma_cod_tipo_usuario=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
   } 
		$lobjPdf->Cell(70,6,'',0,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_usuario+2),6,utf8_decode($nombre_cod_tipo_usuario),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $tipo_usuario->listar();
   while ($row=$tipo_usuario->row()){
	   $lobjPdf->Cell(70,6,'',0,0,"C"); 
				$lobjPdf->Cell(($suma_mayor_cod_tipo_usuario+2),6,utf8_decode($row["cod_tipo_usuario"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
