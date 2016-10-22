<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_estatus.php");
   $estatus = new estatus;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,utf8_decode("Reporte de Estatus de la accesión"),0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_estatus="Codigo"; 
		$nombre_nombre="Nombre"; 
		$nombre_cod_sub_especie="Sub especie";
	
		$suma_mayor_cod_estatus=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_estatus));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_cod_sub_especie=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_sub_especie));$suma_mayor=0;    
   $estatus->listar();
      while ($row=$estatus->row()){
				$suma_cod_estatus=$lobjPdf->GetStringWidth($row["cod_estatus"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
	include_once("modelo/class_sub_especie.php");
	$sub_especie = new sub_especie;
	$sub_especie->set_cod_sub_especie($row["cod_sub_especie"]);
	$sub_especie->consultar();
	$row_sub_especie=$sub_especie->row();
	$suma_cod_sub_especie=$lobjPdf->GetStringWidth($row_sub_especie["nombre"]);
		if($suma_cod_estatus>$suma_mayor_cod_estatus){
			$suma_mayor_cod_estatus=$suma_cod_estatus;
		}
		$suma_cod_estatus=1;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_cod_sub_especie>$suma_mayor_cod_sub_especie){
			$suma_mayor_cod_sub_especie=$suma_cod_sub_especie;
		}
		$suma_cod_sub_especie=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_estatus+2),6,utf8_decode($nombre_cod_estatus),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		//$lobjPdf->Cell(($suma_mayor_cod_sub_especie+2),6,utf8_decode($nombre_cod_sub_especie),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $estatus->listar();
   while ($row=$estatus->row()){
				$lobjPdf->Cell(($suma_mayor_cod_estatus+2),6,utf8_decode($row["cod_estatus"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,1,"R");
	include_once("modelo/class_sub_especie.php");
	$sub_especie = new sub_especie;
	$sub_especie->set_cod_sub_especie($row["cod_sub_especie"]);
	$sub_especie->consultar();
	$row_sub_especie=$sub_especie->row();
	
	//$lobjPdf->Cell(($suma_mayor_cod_sub_especie+2),6,utf8_decode($row_sub_especie["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
