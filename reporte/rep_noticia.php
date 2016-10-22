<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_noticia.php");
   $noticia = new noticia;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Noticias",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_noticia="Codigo"; 
		$nombre_titulo="Titulo"; 
		$nombre_descripcion="Descripción"; 
		$nombre_fecha_creacion="Fecha de creación"; 
		$nombre_fecha_expiracion="Fecha de Expiración"; 
		$nombre_cedula="Usuario"; 
		$nombre_imagen="imagen";
	
		$suma_mayor_cod_noticia=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_noticia));
		$suma_mayor_titulo=$lobjPdf->GetStringWidth(utf8_decode($nombre_titulo));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));
		$suma_mayor_fecha_creacion=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_creacion));
		$suma_mayor_fecha_expiracion=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_expiracion));
		$suma_mayor_cedula=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula));
		$suma_mayor_imagen=$lobjPdf->GetStringWidth(utf8_decode($nombre_imagen));$suma_mayor=0;    
   $noticia->listar();
      while ($row=$noticia->row()){
				$suma_cod_noticia=$lobjPdf->GetStringWidth($row["cod_noticia"]);
				$suma_titulo=$lobjPdf->GetStringWidth($row["titulo"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
				$suma_fecha_creacion=$lobjPdf->GetStringWidth($row["fecha_creacion"]);
				$suma_fecha_expiracion=$lobjPdf->GetStringWidth($row["fecha_expiracion"]);
				$suma_cedula=$lobjPdf->GetStringWidth($row["cedula"]);
				$suma_imagen=$lobjPdf->GetStringWidth($row["imagen"]);
		if($suma_cod_noticia>$suma_mayor_cod_noticia){
			$suma_mayor_cod_noticia=$suma_cod_noticia;
		}
		$suma_cod_noticia=0;
		if($suma_titulo>$suma_mayor_titulo){
			$suma_mayor_titulo=$suma_titulo;
		}
		$suma_titulo=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
		if($suma_fecha_creacion>$suma_mayor_fecha_creacion){
			$suma_mayor_fecha_creacion=$suma_fecha_creacion;
		}
		$suma_fecha_creacion=0;
		if($suma_fecha_expiracion>$suma_mayor_fecha_expiracion){
			$suma_mayor_fecha_expiracion=$suma_fecha_expiracion;
		}
		$suma_fecha_expiracion=0;
		if($suma_cedula>$suma_mayor_cedula){
			$suma_mayor_cedula=$suma_cedula;
		}
		$suma_cedula=0;
		if($suma_imagen>$suma_mayor_imagen){
			$suma_mayor_imagen=$suma_imagen;
		}
		$suma_imagen=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_noticia+2),6,utf8_decode($nombre_cod_noticia),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_titulo+2),6,utf8_decode($nombre_titulo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($nombre_descripcion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_creacion+2),6,utf8_decode($nombre_fecha_creacion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_expiracion+2),6,utf8_decode($nombre_fecha_expiracion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($nombre_cedula),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_imagen+2),6,utf8_decode($nombre_imagen),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $noticia->listar();
   while ($row=$noticia->row()){
				$lobjPdf->Cell(($suma_mayor_cod_noticia+2),6,utf8_decode($row["cod_noticia"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_titulo+2),6,utf8_decode($row["titulo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($row["descripcion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_creacion+2),6,utf8_decode($row["fecha_creacion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_expiracion+2),6,utf8_decode($row["fecha_expiracion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($row["cedula"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_imagen+2),6,utf8_decode($row["imagen"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>