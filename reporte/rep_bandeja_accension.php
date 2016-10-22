<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_bandeja_accension.php");
   $bandeja_accension = new bandeja_accension;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Bandeja de accesión",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_bandeja_accension="Codigo"; 
		$nombre_descripcion="Descripción"; 
		$nombre_capacidad="Capacidad"; 
		$nombre_cod_stan_accension="Stan de la accesión";
	
		$suma_mayor_cod_bandeja_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_bandeja_accension));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));
		$suma_mayor_capacidad=$lobjPdf->GetStringWidth(utf8_decode($nombre_capacidad));
		$suma_mayor_cod_stan_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_stan_accension));$suma_mayor=0;    
   $bandeja_accension->listar();
      while ($row=$bandeja_accension->row()){
				$suma_cod_bandeja_accension=$lobjPdf->GetStringWidth($row["cod_bandeja_accension"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
				$suma_capacidad=$lobjPdf->GetStringWidth($row["capacidad"]);
	include_once("modelo/class_stan_ascencion.php");
	$stan_ascencion = new stan_ascencion;
	$stan_ascencion->set_cod_stan_accension($row["cod_stan_accension"]);
	$stan_ascencion->consultar();
	$row_stan_ascencion=$stan_ascencion->row();
	$suma_cod_stan_accension=$lobjPdf->GetStringWidth($row_stan_ascencion["descripcion"]);
		if($suma_cod_bandeja_accension>$suma_mayor_cod_bandeja_accension){
			$suma_mayor_cod_bandeja_accension=$suma_cod_bandeja_accension;
		}
		$suma_cod_bandeja_accension=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
		if($suma_capacidad>$suma_mayor_capacidad){
			$suma_mayor_capacidad=$suma_capacidad;
		}
		$suma_capacidad=0;
		if($suma_cod_stan_accension>$suma_mayor_cod_stan_accension){
			$suma_mayor_cod_stan_accension=$suma_cod_stan_accension;
		}
		$suma_cod_stan_accension=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_bandeja_accension+2),6,utf8_decode($nombre_cod_bandeja_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($nombre_descripcion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_capacidad+2),6,utf8_decode($nombre_capacidad),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_stan_accension+2),6,utf8_decode($nombre_cod_stan_accension),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $bandeja_accension->listar();
   while ($row=$bandeja_accension->row()){
				$lobjPdf->Cell(($suma_mayor_cod_bandeja_accension+2),6,utf8_decode($row["cod_bandeja_accension"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($row["descripcion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_capacidad+2),6,utf8_decode($row["capacidad"]),1,0,"R");
	include_once("modelo/class_stan_ascencion.php");
	$stan_ascencion = new stan_ascencion;
	$stan_ascencion->set_cod_stan_accension($row["cod_stan_accension"]);
	$stan_ascencion->consultar();
	$row_stan_ascencion=$stan_ascencion->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_stan_accension+2),6,utf8_decode($row_stan_ascencion["descripcion"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>