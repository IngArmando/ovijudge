<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_tipo_tratamiento.php");
   $tipo_tratamiento = new tipo_tratamiento;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Tipo de tratamientos",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_tipo_tratamiento="Codigo"; 
		$nombre_nombre="Nombre"; 
		$nombre_cod_tratamiento="Tratamiento";
	
		$suma_mayor_cod_tipo_tratamiento=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_tratamiento));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_cod_tratamiento=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tratamiento));$suma_mayor=0;    
   $tipo_tratamiento->listar();
      while ($row=$tipo_tratamiento->row()){
				$suma_cod_tipo_tratamiento=$lobjPdf->GetStringWidth($row["cod_tipo_tratamiento"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
	include_once("modelo/class_tratamiento.php");
	$tratamiento = new tratamiento;
	$tratamiento->set_cod_tratamiento($row["cod_tratamiento"]);
	$tratamiento->consultar();
	$row_tratamiento=$tratamiento->row();
	$suma_cod_tratamiento=$lobjPdf->GetStringWidth($row_tratamiento["nombre"]);
		if($suma_cod_tipo_tratamiento>$suma_mayor_cod_tipo_tratamiento){
			$suma_mayor_cod_tipo_tratamiento=$suma_cod_tipo_tratamiento;
		}
		$suma_cod_tipo_tratamiento=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_cod_tratamiento>$suma_mayor_cod_tratamiento){
			$suma_mayor_cod_tratamiento=$suma_cod_tratamiento;
		}
		$suma_cod_tratamiento=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_tratamiento+2),6,utf8_decode($nombre_cod_tipo_tratamiento),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_tratamiento+2),6,utf8_decode($nombre_cod_tratamiento),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $tipo_tratamiento->listar();
   while ($row=$tipo_tratamiento->row()){
				$lobjPdf->Cell(($suma_mayor_cod_tipo_tratamiento+2),6,utf8_decode($row["cod_tipo_tratamiento"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
	include_once("modelo/class_tratamiento.php");
	$tratamiento = new tratamiento;
	$tratamiento->set_cod_tratamiento($row["cod_tratamiento"]);
	$tratamiento->consultar();
	$row_tratamiento=$tratamiento->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_tratamiento+2),6,utf8_decode($row_tratamiento["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
