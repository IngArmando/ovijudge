<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_municipio.php");
   $municipio = new municipio;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Municipios",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_municipio="Codigo"; 
		$nombre_nombre="Nombre"; 
		$nombre_cod_estado="Estado";
	
		$suma_mayor_cod_municipio=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_municipio));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_cod_estado=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_estado));$suma_mayor=0;    
   $municipio->listar();
      while ($row=$municipio->row()){
				$suma_cod_municipio=$lobjPdf->GetStringWidth($row["cod_municipio"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
	include_once("modelo/class_estado.php");
	$estado = new estado;
	$estado->set_cod_estado($row["cod_estado"]);
	$estado->consultar();
	$row_estado=$estado->row();
	$suma_cod_estado=$lobjPdf->GetStringWidth($row_estado["nombre"]);
		if($suma_cod_municipio>$suma_mayor_cod_municipio){
			$suma_mayor_cod_municipio=$suma_cod_municipio;
		}
		$suma_cod_municipio=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_cod_estado>$suma_mayor_cod_estado){
			$suma_mayor_cod_estado=$suma_cod_estado;
		}
		$suma_cod_estado=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_municipio+2),6,utf8_decode($nombre_cod_municipio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_estado+2),6,utf8_decode($nombre_cod_estado),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $municipio->listar();
   while ($row=$municipio->row()){
				$lobjPdf->Cell(($suma_mayor_cod_municipio+2),6,utf8_decode($row["cod_municipio"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
	include_once("modelo/class_estado.php");
	$estado = new estado;
	$estado->set_cod_estado($row["cod_estado"]);
	$estado->consultar();
	$row_estado=$estado->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_estado+2),6,utf8_decode($row_estado["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
