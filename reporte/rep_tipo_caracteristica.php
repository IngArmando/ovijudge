<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_tipo_caracteristica.php");
   $tipo_caracteristica = new tipo_caracteristica;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,utf8_decode("Reporte de Tipo de Característica"),0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_tipo_caracteristica="Codigo"; 
		$nombre_cod_rubro="Rubro"; 
		$nombre_nombre="Nombre";
	
		$suma_mayor_cod_tipo_caracteristica=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_caracteristica));
		$suma_mayor_cod_rubro=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_rubro));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));$suma_mayor=0;    
   $tipo_caracteristica->listar();
      while ($row=$tipo_caracteristica->row()){
				$suma_cod_tipo_caracteristica=$lobjPdf->GetStringWidth($row["cod_tipo_caracteristica"]);
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->set_cod_rubro($row["cod_rubro"]);
	$rubro->consultar();
	$row_rubro=$rubro->row();
	$suma_cod_rubro=$lobjPdf->GetStringWidth($row_rubro["nombre"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
		if($suma_cod_tipo_caracteristica>$suma_mayor_cod_tipo_caracteristica){
			$suma_mayor_cod_tipo_caracteristica=$suma_cod_tipo_caracteristica;
		}
		$suma_cod_tipo_caracteristica=0;
		if($suma_cod_rubro>$suma_mayor_cod_rubro){
			$suma_mayor_cod_rubro=$suma_cod_rubro;
		}
		$suma_cod_rubro=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_caracteristica+2),6,utf8_decode($nombre_cod_tipo_caracteristica),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($nombre_cod_rubro),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $tipo_caracteristica->listar();
   while ($row=$tipo_caracteristica->row()){
				$lobjPdf->Cell(($suma_mayor_cod_tipo_caracteristica+2),6,utf8_decode($row["cod_tipo_caracteristica"]),1,0,"R");
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->set_cod_rubro($row["cod_rubro"]);
	$rubro->consultar();
	$row_rubro=$rubro->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($row_rubro["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
