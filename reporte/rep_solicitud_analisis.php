<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_solicitud_analisis.php");
   $solicitud_analisis = new solicitud_analisis;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Solicitud de Análisis",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_solicitud_analisis="Codigo"; 
		$nombre_fecha_solicitud="Fecha de Solicitud"; 
		$nombre_rif_productora="RIF Empresa"; 
		$nombre_cod_sub_especie="Variedad"; 
		$nombre_almacenaje="Almacenaje"; 
		$nombre_cultivar="Cultivar"; 
		$nombre_lote="Lote"; 
		$nombre_saco="Sacos"; 
		$nombre_kg="Kilogramos"; 
		$nombre_cod_clase_solicitud="Clase"; 
		$nombre_cod_tipo_analisis="cod_tipo_analisis"; 
		$nombre_cod_rubro="cod_rubro"; 
		$nombre_cantidad="cantidad"; 
		$nombre_precio_uni="precio_uni"; 
		$nombre_tipo_servicio="tipo_servicio"; 
		$nombre_pagado="pagado";
	
		$suma_mayor_cod_solicitud_analisis=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_solicitud_analisis));
		$suma_mayor_fecha_solicitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_solicitud));
		$suma_mayor_rif_productora=$lobjPdf->GetStringWidth(utf8_decode($nombre_rif_productora));
		$suma_mayor_cod_sub_especie=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_sub_especie));
		$suma_mayor_almacenaje=$lobjPdf->GetStringWidth(utf8_decode($nombre_almacenaje));
		$suma_mayor_cultivar=$lobjPdf->GetStringWidth(utf8_decode($nombre_cultivar));
		$suma_mayor_lote=$lobjPdf->GetStringWidth(utf8_decode($nombre_lote));
		$suma_mayor_saco=$lobjPdf->GetStringWidth(utf8_decode($nombre_saco));
		$suma_mayor_kg=$lobjPdf->GetStringWidth(utf8_decode($nombre_kg));
		$suma_mayor_cod_clase_solicitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_clase_solicitud));
		$suma_mayor_cod_tipo_analisis=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_analisis));
		$suma_mayor_cod_rubro=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_rubro));
		$suma_mayor_cantidad=$lobjPdf->GetStringWidth(utf8_decode($nombre_cantidad));
		$suma_mayor_precio_uni=$lobjPdf->GetStringWidth(utf8_decode($nombre_precio_uni));
		$suma_mayor_tipo_servicio=$lobjPdf->GetStringWidth(utf8_decode($nombre_tipo_servicio));
		$suma_mayor_pagado=$lobjPdf->GetStringWidth(utf8_decode($nombre_pagado));$suma_mayor=0;    
   $solicitud_analisis->listar();
      while ($row=$solicitud_analisis->row()){
				$suma_cod_solicitud_analisis=$lobjPdf->GetStringWidth($row["cod_solicitud_analisis"]);
				$suma_fecha_solicitud=$lobjPdf->GetStringWidth($row["fecha_solicitud"]);
				$suma_rif_productora=$lobjPdf->GetStringWidth($row["rif_productora"]);
	include_once("modelo/class_sub_especie.php");
	$sub_especie = new sub_especie;
	$sub_especie->set_cod_sub_especie($row["cod_sub_especie"]);
	$sub_especie->consultar();
	$row_sub_especie=$sub_especie->row();
	$suma_cod_sub_especie=$lobjPdf->GetStringWidth($row_sub_especie["nombre"]);
				$suma_almacenaje=$lobjPdf->GetStringWidth($row["almacenaje"]);
				$suma_cultivar=$lobjPdf->GetStringWidth($row["cultivar"]);
				$suma_lote=$lobjPdf->GetStringWidth($row["lote"]);
				$suma_saco=$lobjPdf->GetStringWidth($row["saco"]);
				$suma_kg=$lobjPdf->GetStringWidth($row["kg"]);
	include_once("modelo/class_clase_solicitud.php");
	$clase_solicitud = new clase_solicitud;
	$clase_solicitud->set_cod_clase_solicitud($row["cod_clase_solicitud"]);
	$clase_solicitud->consultar();
	$row_clase_solicitud=$clase_solicitud->row();
	$suma_cod_clase_solicitud=$lobjPdf->GetStringWidth($row_clase_solicitud["nombre"]);
				$suma_cod_tipo_analisis=$lobjPdf->GetStringWidth($row["cod_tipo_analisis"]);
				$suma_cod_rubro=$lobjPdf->GetStringWidth($row["cod_rubro"]);
				$suma_cantidad=$lobjPdf->GetStringWidth($row["cantidad"]);
				$suma_precio_uni=$lobjPdf->GetStringWidth($row["precio_uni"]);
				$suma_tipo_servicio=$lobjPdf->GetStringWidth($row["tipo_servicio"]);
				$suma_pagado=$lobjPdf->GetStringWidth($row["pagado"]);
		if($suma_cod_solicitud_analisis>$suma_mayor_cod_solicitud_analisis){
			$suma_mayor_cod_solicitud_analisis=$suma_cod_solicitud_analisis;
		}
		$suma_cod_solicitud_analisis=0;
		if($suma_fecha_solicitud>$suma_mayor_fecha_solicitud){
			$suma_mayor_fecha_solicitud=$suma_fecha_solicitud;
		}
		$suma_fecha_solicitud=0;
		if($suma_rif_productora>$suma_mayor_rif_productora){
			$suma_mayor_rif_productora=$suma_rif_productora;
		}
		$suma_rif_productora=0;
		if($suma_cod_sub_especie>$suma_mayor_cod_sub_especie){
			$suma_mayor_cod_sub_especie=$suma_cod_sub_especie;
		}
		$suma_cod_sub_especie=0;
		if($suma_almacenaje>$suma_mayor_almacenaje){
			$suma_mayor_almacenaje=$suma_almacenaje;
		}
		$suma_almacenaje=0;
		if($suma_cultivar>$suma_mayor_cultivar){
			$suma_mayor_cultivar=$suma_cultivar;
		}
		$suma_cultivar=0;
		if($suma_lote>$suma_mayor_lote){
			$suma_mayor_lote=$suma_lote;
		}
		$suma_lote=0;
		if($suma_saco>$suma_mayor_saco){
			$suma_mayor_saco=$suma_saco;
		}
		$suma_saco=0;
		if($suma_kg>$suma_mayor_kg){
			$suma_mayor_kg=$suma_kg;
		}
		$suma_kg=0;
		if($suma_cod_clase_solicitud>$suma_mayor_cod_clase_solicitud){
			$suma_mayor_cod_clase_solicitud=$suma_cod_clase_solicitud;
		}
		$suma_cod_clase_solicitud=0;
		if($suma_cod_tipo_analisis>$suma_mayor_cod_tipo_analisis){
			$suma_mayor_cod_tipo_analisis=$suma_cod_tipo_analisis;
		}
		$suma_cod_tipo_analisis=0;
		if($suma_cod_rubro>$suma_mayor_cod_rubro){
			$suma_mayor_cod_rubro=$suma_cod_rubro;
		}
		$suma_cod_rubro=0;
		if($suma_cantidad>$suma_mayor_cantidad){
			$suma_mayor_cantidad=$suma_cantidad;
		}
		$suma_cantidad=0;
		if($suma_precio_uni>$suma_mayor_precio_uni){
			$suma_mayor_precio_uni=$suma_precio_uni;
		}
		$suma_precio_uni=0;
		if($suma_tipo_servicio>$suma_mayor_tipo_servicio){
			$suma_mayor_tipo_servicio=$suma_tipo_servicio;
		}
		$suma_tipo_servicio=0;
		if($suma_pagado>$suma_mayor_pagado){
			$suma_mayor_pagado=$suma_pagado;
		}
		$suma_pagado=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_solicitud_analisis+2),6,utf8_decode($nombre_cod_solicitud_analisis),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_solicitud+2),6,utf8_decode($nombre_fecha_solicitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_rif_productora+2),6,utf8_decode($nombre_rif_productora),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_sub_especie+2),6,utf8_decode($nombre_cod_sub_especie),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_almacenaje+2),6,utf8_decode($nombre_almacenaje),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cultivar+2),6,utf8_decode($nombre_cultivar),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_lote+2),6,utf8_decode($nombre_lote),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_saco+2),6,utf8_decode($nombre_saco),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_kg+2),6,utf8_decode($nombre_kg),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_clase_solicitud+2),6,utf8_decode($nombre_cod_clase_solicitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_analisis+2),6,utf8_decode($nombre_cod_tipo_analisis),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($nombre_cod_rubro),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cantidad+2),6,utf8_decode($nombre_cantidad),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_precio_uni+2),6,utf8_decode($nombre_precio_uni),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_tipo_servicio+2),6,utf8_decode($nombre_tipo_servicio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_pagado+2),6,utf8_decode($nombre_pagado),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $solicitud_analisis->listar();
   while ($row=$solicitud_analisis->row()){
				$lobjPdf->Cell(($suma_mayor_cod_solicitud_analisis+2),6,utf8_decode($row["cod_solicitud_analisis"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_solicitud+2),6,utf8_decode($row["fecha_solicitud"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_rif_productora+2),6,utf8_decode($row["rif_productora"]),1,0,"R");
	include_once("modelo/class_sub_especie.php");
	$sub_especie = new sub_especie;
	$sub_especie->set_cod_sub_especie($row["cod_sub_especie"]);
	$sub_especie->consultar();
	$row_sub_especie=$sub_especie->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_sub_especie+2),6,utf8_decode($row_sub_especie["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_almacenaje+2),6,utf8_decode($row["almacenaje"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cultivar+2),6,utf8_decode($row["cultivar"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_lote+2),6,utf8_decode($row["lote"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_saco+2),6,utf8_decode($row["saco"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_kg+2),6,utf8_decode($row["kg"]),1,0,"R");
	include_once("modelo/class_clase_solicitud.php");
	$clase_solicitud = new clase_solicitud;
	$clase_solicitud->set_cod_clase_solicitud($row["cod_clase_solicitud"]);
	$clase_solicitud->consultar();
	$row_clase_solicitud=$clase_solicitud->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_clase_solicitud+2),6,utf8_decode($row_clase_solicitud["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cod_tipo_analisis+2),6,utf8_decode($row["cod_tipo_analisis"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($row["cod_rubro"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cantidad+2),6,utf8_decode($row["cantidad"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_precio_uni+2),6,utf8_decode($row["precio_uni"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_tipo_servicio+2),6,utf8_decode($row["tipo_servicio"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_pagado+2),6,utf8_decode($row["pagado"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>