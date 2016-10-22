<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_finca.php");
   $finca = new finca;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Finca o Hacienda",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_finca="Codigo"; 
		$nombre_nombre="Nombre"; 
		$nombre_cod_municipio="Municipio"; 
		$nombre_cedula="Representante legal"; 
		$nombre_direccion="Dirección"; 
		$nombre_longitud="Longitud"; 
		$nombre_latitud="Latitud";
	
		$suma_mayor_cod_finca=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_finca));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_cod_municipio=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_municipio));
		$suma_mayor_cedula=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula));
		$suma_mayor_direccion=$lobjPdf->GetStringWidth(utf8_decode($nombre_direccion));
		$suma_mayor_longitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_longitud));
		$suma_mayor_latitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_latitud));$suma_mayor=0;    
   $finca->listar();
      while ($row=$finca->row()){
				$suma_cod_finca=$lobjPdf->GetStringWidth($row["cod_finca"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
	include_once("modelo/class_municipio.php");
	$municipio = new municipio;
	$municipio->set_cod_municipio($row["cod_municipio"]);
	$municipio->consultar();
	$row_municipio=$municipio->row();
	$suma_cod_municipio=$lobjPdf->GetStringWidth($row_municipio["nombre"]);
	include_once("modelo/class_representante_legal.php");
	$representante_legal = new representante_legal;
	$representante_legal->set_cedula($row["cedula"]);
	$representante_legal->consultar();
	$row_representante_legal=$representante_legal->row();
	$suma_cedula=$lobjPdf->GetStringWidth($row_representante_legal["nombre"]);
				$suma_direccion=$lobjPdf->GetStringWidth($row["direccion"]);
				$suma_longitud=$lobjPdf->GetStringWidth($row["longitud"]);
				$suma_latitud=$lobjPdf->GetStringWidth($row["latitud"]);
		if($suma_cod_finca>$suma_mayor_cod_finca){
			$suma_mayor_cod_finca=$suma_cod_finca;
		}
		$suma_cod_finca=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_cod_municipio>$suma_mayor_cod_municipio){
			$suma_mayor_cod_municipio=$suma_cod_municipio;
		}
		$suma_cod_municipio=0;
		if($suma_cedula>$suma_mayor_cedula){
			$suma_mayor_cedula=$suma_cedula;
		}
		$suma_cedula=0;
		if($suma_direccion>$suma_mayor_direccion){
			$suma_mayor_direccion=$suma_direccion;
		}
		$suma_direccion=0;
		if($suma_longitud>$suma_mayor_longitud){
			$suma_mayor_longitud=$suma_longitud;
		}
		$suma_longitud=0;
		if($suma_latitud>$suma_mayor_latitud){
			$suma_mayor_latitud=$suma_latitud;
		}
		$suma_latitud=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_finca+2),6,utf8_decode($nombre_cod_finca),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_municipio+2),6,utf8_decode($nombre_cod_municipio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($nombre_cedula),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_direccion+2),6,utf8_decode($nombre_direccion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_longitud+2),6,utf8_decode($nombre_longitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_latitud+2),6,utf8_decode($nombre_latitud),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $finca->listar();
   while ($row=$finca->row()){
				$lobjPdf->Cell(($suma_mayor_cod_finca+2),6,utf8_decode($row["cod_finca"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
	include_once("modelo/class_municipio.php");
	$municipio = new municipio;
	$municipio->set_cod_municipio($row["cod_municipio"]);
	$municipio->consultar();
	$row_municipio=$municipio->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_municipio+2),6,utf8_decode($row_municipio["nombre"]),1,0,"R");
	include_once("modelo/class_representante_legal.php");
	$representante_legal = new representante_legal;
	$representante_legal->set_cedula($row["cedula"]);
	$representante_legal->consultar();
	$row_representante_legal=$representante_legal->row();
	
	$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($row_representante_legal["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_direccion+2),6,utf8_decode($row["direccion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_longitud+2),6,utf8_decode($row["longitud"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_latitud+2),6,utf8_decode($row["latitud"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>