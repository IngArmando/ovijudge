<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_stan_ascencion.php");
   $stan_ascencion = new stan_ascencion;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Stan de accensiones",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_stan_accension="Codigo"; 
		$nombre_cod_cava="Cava"; 
		$nombre_descripcion="Descripción"; 
		$nombre_capacidad="Capacidad";
	
		$suma_mayor_cod_stan_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_stan_accension));
		$suma_mayor_cod_cava=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_cava));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));
		$suma_mayor_capacidad=$lobjPdf->GetStringWidth(utf8_decode($nombre_capacidad));$suma_mayor=0;    
   $stan_ascencion->listar();
      while ($row=$stan_ascencion->row()){
				$suma_cod_stan_accension=$lobjPdf->GetStringWidth($row["cod_stan_accension"]);
	include_once("modelo/class_cava.php");
	$cava = new cava;
	$cava->set_cod_cava($row["cod_cava"]);
	$cava->consultar();
	$row_cava=$cava->row();
	$suma_cod_cava=$lobjPdf->GetStringWidth($row_cava["descripcion"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
				$suma_capacidad=$lobjPdf->GetStringWidth($row["capacidad"]);
		if($suma_cod_stan_accension>$suma_mayor_cod_stan_accension){
			$suma_mayor_cod_stan_accension=$suma_cod_stan_accension;
		}
		$suma_cod_stan_accension=0;
		if($suma_cod_cava>$suma_mayor_cod_cava){
			$suma_mayor_cod_cava=$suma_cod_cava;
		}
		$suma_cod_cava=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
		if($suma_capacidad>$suma_mayor_capacidad){
			$suma_mayor_capacidad=$suma_capacidad;
		}
		$suma_capacidad=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_stan_accension+2),6,utf8_decode($nombre_cod_stan_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_cava+2),6,utf8_decode($nombre_cod_cava),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($nombre_descripcion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_capacidad+2),6,utf8_decode($nombre_capacidad),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $stan_ascencion->listar();
   while ($row=$stan_ascencion->row()){
				$lobjPdf->Cell(($suma_mayor_cod_stan_accension+2),6,utf8_decode($row["cod_stan_accension"]),1,0,"R");
	include_once("modelo/class_cava.php");
	$cava = new cava;
	$cava->set_cod_cava($row["cod_cava"]);
	$cava->consultar();
	$row_cava=$cava->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_cava+2),6,utf8_decode($row_cava["descripcion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($row["descripcion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_capacidad+2),6,utf8_decode($row["capacidad"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>