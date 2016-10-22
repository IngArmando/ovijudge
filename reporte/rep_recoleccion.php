<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_recoleccion.php");
   $recoleccion = new recoleccion;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,utf8_decode("Reporte de Recolección"),0,1,"C");
   $lobjPdf->SetFont("arial","B",10);
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_recoleccion="Codigo"; 
		$nombre_cod_accension="Accesión"; 
		$nombre_nombre_sitio="Lugar"; 
		$nombre_fecha="Fecha"; 
		$nombre_latitud="Latitud"; 
		$nombre_longitud="Longitud"; 
		$nombre_cod_tipo_suelo="Tipo de suelo"; 
		$nombre_ph_suelo="Ph del suelo"; 
		$nombre_precipitacion_pluvial="Precipitación pluvial"; 
		$nombre_ecosistema="Ecosistema"; 
		$nombre_practicas_culturales="Practicas culturales";
	
		$suma_mayor_cod_recoleccion=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_recoleccion));
		$suma_mayor_cod_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_accension));
		$suma_mayor_nombre_sitio=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre_sitio));
		$suma_mayor_fecha=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha));
		$suma_mayor_latitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_latitud));
		$suma_mayor_longitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_longitud));
		$suma_mayor_cod_tipo_suelo=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_suelo));
		$suma_mayor_ph_suelo=$lobjPdf->GetStringWidth(utf8_decode($nombre_ph_suelo));
		$suma_mayor_precipitacion_pluvial=$lobjPdf->GetStringWidth(utf8_decode($nombre_precipitacion_pluvial));
		$suma_mayor_ecosistema=$lobjPdf->GetStringWidth(utf8_decode($nombre_ecosistema));
		$suma_mayor_practicas_culturales=$lobjPdf->GetStringWidth(utf8_decode($nombre_practicas_culturales));$suma_mayor=0;    
   $recoleccion->listar();
      while ($row=$recoleccion->row()){
				$suma_cod_recoleccion=$lobjPdf->GetStringWidth($row["cod_recoleccion"]);
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	$suma_cod_accension=$lobjPdf->GetStringWidth($row_accension["cod_accension"]);
				$suma_nombre_sitio=$lobjPdf->GetStringWidth($row["nombre_sitio"]);
				$suma_fecha=$lobjPdf->GetStringWidth($row["fecha"]);
				$suma_latitud=$lobjPdf->GetStringWidth($row["latitud"]);
				$suma_longitud=$lobjPdf->GetStringWidth($row["longitud"]);
	include_once("modelo/class_tipo_suelo.php");
	$tipo_suelo = new tipo_suelo;
	$tipo_suelo->set_cod_tipo_suelo($row["cod_tipo_suelo"]);
	$tipo_suelo->consultar();
	$row_tipo_suelo=$tipo_suelo->row();
	$suma_cod_tipo_suelo=$lobjPdf->GetStringWidth($row_tipo_suelo["nombre"]);
				$suma_ph_suelo=$lobjPdf->GetStringWidth($row["ph_suelo"]);
				$suma_precipitacion_pluvial=$lobjPdf->GetStringWidth($row["precipitacion_pluvial"]);
				$suma_ecosistema=$lobjPdf->GetStringWidth($row["ecosistema"]);
				$suma_practicas_culturales=$lobjPdf->GetStringWidth($row["practicas_culturales"]);
		if($suma_cod_recoleccion>$suma_mayor_cod_recoleccion){
			$suma_mayor_cod_recoleccion=$suma_cod_recoleccion;
		}
		$suma_cod_recoleccion=0;
		if($suma_cod_accension>$suma_mayor_cod_accension){
			$suma_mayor_cod_accension=$suma_cod_accension;
		}
		$suma_cod_accension=0;
		if($suma_nombre_sitio>$suma_mayor_nombre_sitio){
			$suma_mayor_nombre_sitio=$suma_nombre_sitio;
		}
		$suma_nombre_sitio=0;
		if($suma_fecha>$suma_mayor_fecha){
			$suma_mayor_fecha=$suma_fecha;
		}
		$suma_fecha=0;
		if($suma_latitud>$suma_mayor_latitud){
			$suma_mayor_latitud=$suma_latitud;
		}
		$suma_latitud=0;
		if($suma_longitud>$suma_mayor_longitud){
			$suma_mayor_longitud=$suma_longitud;
		}
		$suma_longitud=0;
		if($suma_cod_tipo_suelo>$suma_mayor_cod_tipo_suelo){
			$suma_mayor_cod_tipo_suelo=$suma_cod_tipo_suelo;
		}
		$suma_cod_tipo_suelo=0;
		if($suma_ph_suelo>$suma_mayor_ph_suelo){
			$suma_mayor_ph_suelo=$suma_ph_suelo;
		}
		$suma_ph_suelo=0;
		if($suma_precipitacion_pluvial>$suma_mayor_precipitacion_pluvial){
			$suma_mayor_precipitacion_pluvial=$suma_precipitacion_pluvial;
		}
		$suma_precipitacion_pluvial=0;
		if($suma_ecosistema>$suma_mayor_ecosistema){
			$suma_mayor_ecosistema=$suma_ecosistema;
		}
		$suma_ecosistema=0;
		if($suma_practicas_culturales>$suma_mayor_practicas_culturales){
			$suma_mayor_practicas_culturales=$suma_practicas_culturales;
		}
		$suma_practicas_culturales=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_recoleccion+2),6,utf8_decode($nombre_cod_recoleccion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($nombre_cod_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre_sitio+2),6,utf8_decode($nombre_nombre_sitio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha+2),6,utf8_decode($nombre_fecha),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_latitud+2),6,utf8_decode($nombre_latitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_longitud+2),6,utf8_decode($nombre_longitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_suelo+2),6,utf8_decode($nombre_cod_tipo_suelo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_ph_suelo+2),6,utf8_decode($nombre_ph_suelo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_precipitacion_pluvial+2),6,utf8_decode($nombre_precipitacion_pluvial),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_ecosistema+2),6,utf8_decode($nombre_ecosistema),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_practicas_culturales+2),6,utf8_decode($nombre_practicas_culturales),1,0,"C");
   $lobjPdf->SetFont("arial","",10);
   $lobjPdf->Ln();
      $recoleccion->listar();
   while ($row=$recoleccion->row()){
				$lobjPdf->Cell(($suma_mayor_cod_recoleccion+2),6,utf8_decode($row["cod_recoleccion"]),1,0,"R");
	include_once("modelo/class_accension.php");
	$accension = new accension;
	$accension->set_cod_accension($row["cod_accension"]);
	$accension->consultar();
	$row_accension=$accension->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($row_accension["cod_accension"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre_sitio+2),6,utf8_decode($row["nombre_sitio"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha+2),6,utf8_decode($row["fecha"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_latitud+2),6,utf8_decode($row["latitud"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_longitud+2),6,utf8_decode($row["longitud"]),1,0,"R");
	include_once("modelo/class_tipo_suelo.php");
	$tipo_suelo = new tipo_suelo;
	$tipo_suelo->set_cod_tipo_suelo($row["cod_tipo_suelo"]);
	$tipo_suelo->consultar();
	$row_tipo_suelo=$tipo_suelo->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_tipo_suelo+2),6,utf8_decode($row_tipo_suelo["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_ph_suelo+2),6,utf8_decode($row["ph_suelo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_precipitacion_pluvial+2),6,utf8_decode($row["precipitacion_pluvial"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_ecosistema+2),6,utf8_decode($row["ecosistema"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_practicas_culturales+2),6,utf8_decode($row["practicas_culturales"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
