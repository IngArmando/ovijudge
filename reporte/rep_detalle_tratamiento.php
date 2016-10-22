<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_detalle_tratamiento.php");
   $detalle_tratamiento = new detalle_tratamiento;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Detalles del tratamiento",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_accension="Accesión"; 
		$nombre_cod_tipo_tratamiento="Tipo de tratamiento"; 
		$nombre_resultado="Resultado";
	
		$suma_mayor_cod_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_accension));
		$suma_mayor_cod_tipo_tratamiento=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_tratamiento));
		$suma_mayor_resultado=$lobjPdf->GetStringWidth(utf8_decode($nombre_resultado));$suma_mayor=0;    
   $detalle_tratamiento->listar();
      while ($row=$detalle_tratamiento->row()){
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	$suma_cod_accension=$lobjPdf->GetStringWidth($row_accension["cod_accension"]);
	include_once("modelo/class_tipo_tratamiento.php");
	$tipo_tratamiento = new tipo_tratamiento;
	$tipo_tratamiento->set_cod_tipo_tratamiento($row["cod_tipo_tratamiento"]);
	$tipo_tratamiento->consultar();
	$row_tipo_tratamiento=$tipo_tratamiento->row();
	$suma_cod_tipo_tratamiento=$lobjPdf->GetStringWidth($row_tipo_tratamiento["nombre"]);
				$suma_resultado=$lobjPdf->GetStringWidth($row["resultado"]);
		if($suma_cod_accension>$suma_mayor_cod_accension){
			$suma_mayor_cod_accension=$suma_cod_accension;
		}
		$suma_cod_accension=0;
		if($suma_cod_tipo_tratamiento>$suma_mayor_cod_tipo_tratamiento){
			$suma_mayor_cod_tipo_tratamiento=$suma_cod_tipo_tratamiento;
		}
		$suma_cod_tipo_tratamiento=0;
		if($suma_resultado>$suma_mayor_resultado){
			$suma_mayor_resultado=$suma_resultado;
		}
		$suma_resultado=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($nombre_cod_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_tratamiento+2),6,utf8_decode($nombre_cod_tipo_tratamiento),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_resultado+2),6,utf8_decode($nombre_resultado),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $detalle_tratamiento->listar();
   while ($row=$detalle_tratamiento->row()){
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($row_accension["cod_accension"]),1,0,"R");
	include_once("modelo/class_tipo_tratamiento.php");
	$tipo_tratamiento = new tipo_tratamiento;
	$tipo_tratamiento->set_cod_tipo_tratamiento($row["cod_tipo_tratamiento"]);
	$tipo_tratamiento->consultar();
	$row_tipo_tratamiento=$tipo_tratamiento->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_tipo_tratamiento+2),6,utf8_decode($row_tipo_tratamiento["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_resultado+2),6,utf8_decode($row["resultado"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>