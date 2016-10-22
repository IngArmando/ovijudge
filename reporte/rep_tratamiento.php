<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_tratamiento.php");
   $tratamiento = new tratamiento;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Tratamiento",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_tratamiento="Codigo"; 
		$nombre_nombre="Nombre"; 
		$nombre_cod_rubro="Rubro";
	
		$suma_mayor_cod_tratamiento=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tratamiento));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_cod_rubro=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_rubro));$suma_mayor=0;    
   $tratamiento->listar();
      while ($row=$tratamiento->row()){
				$suma_cod_tratamiento=$lobjPdf->GetStringWidth($row["cod_tratamiento"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->set_cod_rubro($row["cod_rubro"]);
	$rubro->consultar();
	$row_rubro=$rubro->row();
	$suma_cod_rubro=$lobjPdf->GetStringWidth($row_rubro["nombre"]);
		if($suma_cod_tratamiento>$suma_mayor_cod_tratamiento){
			$suma_mayor_cod_tratamiento=$suma_cod_tratamiento;
		}
		$suma_cod_tratamiento=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_cod_rubro>$suma_mayor_cod_rubro){
			$suma_mayor_cod_rubro=$suma_cod_rubro;
		}
		$suma_cod_rubro=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_tratamiento+2),6,utf8_decode($nombre_cod_tratamiento),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($nombre_cod_rubro),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $tratamiento->listar();
   while ($row=$tratamiento->row()){
				$lobjPdf->Cell(($suma_mayor_cod_tratamiento+2),6,utf8_decode($row["cod_tratamiento"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->set_cod_rubro($row["cod_rubro"]);
	$rubro->consultar();
	$row_rubro=$rubro->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($row_rubro["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>