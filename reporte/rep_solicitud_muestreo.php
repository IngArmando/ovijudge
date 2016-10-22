<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_solicitud_muestreo.php");
   $solicitud_muestreo = new solicitud_muestreo;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Solicitud de Muestreo",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_solicitud_muestreo="Codigo"; 
		$nombre_rif_productora="RIF Empresa"; 
		$nombre_cod_finca="Finca o Hacienda"; 
		$nombre_cod_sub_especie="Variedad"; 
		$nombre_nro_lote="Nro de Lote"; 
		$nombre_nro_saco="Nro de Sacos"; 
		$nombre_cod_presentacion_saco="Presentacion de Sacos"; 
		$nombre_ubicacion="Ubicación"; 
		$nombre_kg="Kilogramos"; 
		$nombre_procedencia="Procedencia"; 
		$nombre_fecha_siembra="Fecha de Siembra"; 
		$nombre_cod_clase_solicitud="Clase"; 
		$nombre_precio="precio"; 
		$nombre_total="total"; 
		$nombre_fecha_solicitud="fecha_solicitud"; 
		$nombre_tipo_servicio="tipo_servicio"; 
		$nombre_pagado="pagado";
	
		$suma_mayor_cod_solicitud_muestreo=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_solicitud_muestreo));
		$suma_mayor_rif_productora=$lobjPdf->GetStringWidth(utf8_decode($nombre_rif_productora));
		$suma_mayor_cod_finca=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_finca));
		$suma_mayor_cod_sub_especie=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_sub_especie));
		$suma_mayor_nro_lote=$lobjPdf->GetStringWidth(utf8_decode($nombre_nro_lote));
		$suma_mayor_nro_saco=$lobjPdf->GetStringWidth(utf8_decode($nombre_nro_saco));
		$suma_mayor_cod_presentacion_saco=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_presentacion_saco));
		$suma_mayor_ubicacion=$lobjPdf->GetStringWidth(utf8_decode($nombre_ubicacion));
		$suma_mayor_kg=$lobjPdf->GetStringWidth(utf8_decode($nombre_kg));
		$suma_mayor_procedencia=$lobjPdf->GetStringWidth(utf8_decode($nombre_procedencia));
		$suma_mayor_fecha_siembra=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_siembra));
		$suma_mayor_cod_clase_solicitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_clase_solicitud));
		$suma_mayor_precio=$lobjPdf->GetStringWidth(utf8_decode($nombre_precio));
		$suma_mayor_total=$lobjPdf->GetStringWidth(utf8_decode($nombre_total));
		$suma_mayor_fecha_solicitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_solicitud));
		$suma_mayor_tipo_servicio=$lobjPdf->GetStringWidth(utf8_decode($nombre_tipo_servicio));
		$suma_mayor_pagado=$lobjPdf->GetStringWidth(utf8_decode($nombre_pagado));$suma_mayor=0;    
   $solicitud_muestreo->listar();
      while ($row=$solicitud_muestreo->row()){
				$suma_cod_solicitud_muestreo=$lobjPdf->GetStringWidth($row["cod_solicitud_muestreo"]);
				$suma_rif_productora=$lobjPdf->GetStringWidth($row["rif_productora"]);
	include_once("modelo/class_finca.php");
	$finca = new finca;
	$finca->set_cod_finca($row["cod_finca"]);
	$finca->consultar();
	$row_finca=$finca->row();
	$suma_cod_finca=$lobjPdf->GetStringWidth($row_finca["nombre"]);
	include_once("modelo/class_sub_especie.php");
	$sub_especie = new sub_especie;
	$sub_especie->set_cod_sub_especie($row["cod_sub_especie"]);
	$sub_especie->consultar();
	$row_sub_especie=$sub_especie->row();
	$suma_cod_sub_especie=$lobjPdf->GetStringWidth($row_sub_especie["nombre"]);
				$suma_nro_lote=$lobjPdf->GetStringWidth($row["nro_lote"]);
				$suma_nro_saco=$lobjPdf->GetStringWidth($row["nro_saco"]);
	include_once("modelo/class_presentacion_saco.php");
	$presentacion_saco = new presentacion_saco;
	$presentacion_saco->set_cod_presentacion_saco($row["cod_presentacion_saco"]);
	$presentacion_saco->consultar();
	$row_presentacion_saco=$presentacion_saco->row();
	$suma_cod_presentacion_saco=$lobjPdf->GetStringWidth($row_presentacion_saco["nombre"]);
				$suma_ubicacion=$lobjPdf->GetStringWidth($row["ubicacion"]);
				$suma_kg=$lobjPdf->GetStringWidth($row["kg"]);
				$suma_procedencia=$lobjPdf->GetStringWidth($row["procedencia"]);
				$suma_fecha_siembra=$lobjPdf->GetStringWidth($row["fecha_siembra"]);
	include_once("modelo/class_clase_solicitud.php");
	$clase_solicitud = new clase_solicitud;
	$clase_solicitud->set_cod_clase_solicitud($row["cod_clase_solicitud"]);
	$clase_solicitud->consultar();
	$row_clase_solicitud=$clase_solicitud->row();
	$suma_cod_clase_solicitud=$lobjPdf->GetStringWidth($row_clase_solicitud["nombre"]);
				$suma_precio=$lobjPdf->GetStringWidth($row["precio"]);
				$suma_total=$lobjPdf->GetStringWidth($row["total"]);
				$suma_fecha_solicitud=$lobjPdf->GetStringWidth($row["fecha_solicitud"]);
				$suma_tipo_servicio=$lobjPdf->GetStringWidth($row["tipo_servicio"]);
				$suma_pagado=$lobjPdf->GetStringWidth($row["pagado"]);
		if($suma_cod_solicitud_muestreo>$suma_mayor_cod_solicitud_muestreo){
			$suma_mayor_cod_solicitud_muestreo=$suma_cod_solicitud_muestreo;
		}
		$suma_cod_solicitud_muestreo=0;
		if($suma_rif_productora>$suma_mayor_rif_productora){
			$suma_mayor_rif_productora=$suma_rif_productora;
		}
		$suma_rif_productora=0;
		if($suma_cod_finca>$suma_mayor_cod_finca){
			$suma_mayor_cod_finca=$suma_cod_finca;
		}
		$suma_cod_finca=0;
		if($suma_cod_sub_especie>$suma_mayor_cod_sub_especie){
			$suma_mayor_cod_sub_especie=$suma_cod_sub_especie;
		}
		$suma_cod_sub_especie=0;
		if($suma_nro_lote>$suma_mayor_nro_lote){
			$suma_mayor_nro_lote=$suma_nro_lote;
		}
		$suma_nro_lote=0;
		if($suma_nro_saco>$suma_mayor_nro_saco){
			$suma_mayor_nro_saco=$suma_nro_saco;
		}
		$suma_nro_saco=0;
		if($suma_cod_presentacion_saco>$suma_mayor_cod_presentacion_saco){
			$suma_mayor_cod_presentacion_saco=$suma_cod_presentacion_saco;
		}
		$suma_cod_presentacion_saco=0;
		if($suma_ubicacion>$suma_mayor_ubicacion){
			$suma_mayor_ubicacion=$suma_ubicacion;
		}
		$suma_ubicacion=0;
		if($suma_kg>$suma_mayor_kg){
			$suma_mayor_kg=$suma_kg;
		}
		$suma_kg=0;
		if($suma_procedencia>$suma_mayor_procedencia){
			$suma_mayor_procedencia=$suma_procedencia;
		}
		$suma_procedencia=0;
		if($suma_fecha_siembra>$suma_mayor_fecha_siembra){
			$suma_mayor_fecha_siembra=$suma_fecha_siembra;
		}
		$suma_fecha_siembra=0;
		if($suma_cod_clase_solicitud>$suma_mayor_cod_clase_solicitud){
			$suma_mayor_cod_clase_solicitud=$suma_cod_clase_solicitud;
		}
		$suma_cod_clase_solicitud=0;
		if($suma_precio>$suma_mayor_precio){
			$suma_mayor_precio=$suma_precio;
		}
		$suma_precio=0;
		if($suma_total>$suma_mayor_total){
			$suma_mayor_total=$suma_total;
		}
		$suma_total=0;
		if($suma_fecha_solicitud>$suma_mayor_fecha_solicitud){
			$suma_mayor_fecha_solicitud=$suma_fecha_solicitud;
		}
		$suma_fecha_solicitud=0;
		if($suma_tipo_servicio>$suma_mayor_tipo_servicio){
			$suma_mayor_tipo_servicio=$suma_tipo_servicio;
		}
		$suma_tipo_servicio=0;
		if($suma_pagado>$suma_mayor_pagado){
			$suma_mayor_pagado=$suma_pagado;
		}
		$suma_pagado=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_solicitud_muestreo+2),6,utf8_decode($nombre_cod_solicitud_muestreo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_rif_productora+2),6,utf8_decode($nombre_rif_productora),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_finca+2),6,utf8_decode($nombre_cod_finca),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_sub_especie+2),6,utf8_decode($nombre_cod_sub_especie),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nro_lote+2),6,utf8_decode($nombre_nro_lote),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nro_saco+2),6,utf8_decode($nombre_nro_saco),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_presentacion_saco+2),6,utf8_decode($nombre_cod_presentacion_saco),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_ubicacion+2),6,utf8_decode($nombre_ubicacion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_kg+2),6,utf8_decode($nombre_kg),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_procedencia+2),6,utf8_decode($nombre_procedencia),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_siembra+2),6,utf8_decode($nombre_fecha_siembra),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_clase_solicitud+2),6,utf8_decode($nombre_cod_clase_solicitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_precio+2),6,utf8_decode($nombre_precio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_total+2),6,utf8_decode($nombre_total),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_solicitud+2),6,utf8_decode($nombre_fecha_solicitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_tipo_servicio+2),6,utf8_decode($nombre_tipo_servicio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_pagado+2),6,utf8_decode($nombre_pagado),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $solicitud_muestreo->listar();
   while ($row=$solicitud_muestreo->row()){
				$lobjPdf->Cell(($suma_mayor_cod_solicitud_muestreo+2),6,utf8_decode($row["cod_solicitud_muestreo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_rif_productora+2),6,utf8_decode($row["rif_productora"]),1,0,"R");
	include_once("modelo/class_finca.php");
	$finca = new finca;
	$finca->set_cod_finca($row["cod_finca"]);
	$finca->consultar();
	$row_finca=$finca->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_finca+2),6,utf8_decode($row_finca["nombre"]),1,0,"R");
	include_once("modelo/class_sub_especie.php");
	$sub_especie = new sub_especie;
	$sub_especie->set_cod_sub_especie($row["cod_sub_especie"]);
	$sub_especie->consultar();
	$row_sub_especie=$sub_especie->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_sub_especie+2),6,utf8_decode($row_sub_especie["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nro_lote+2),6,utf8_decode($row["nro_lote"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nro_saco+2),6,utf8_decode($row["nro_saco"]),1,0,"R");
	include_once("modelo/class_presentacion_saco.php");
	$presentacion_saco = new presentacion_saco;
	$presentacion_saco->set_cod_presentacion_saco($row["cod_presentacion_saco"]);
	$presentacion_saco->consultar();
	$row_presentacion_saco=$presentacion_saco->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_presentacion_saco+2),6,utf8_decode($row_presentacion_saco["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_ubicacion+2),6,utf8_decode($row["ubicacion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_kg+2),6,utf8_decode($row["kg"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_procedencia+2),6,utf8_decode($row["procedencia"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_siembra+2),6,utf8_decode($row["fecha_siembra"]),1,0,"R");
	include_once("modelo/class_clase_solicitud.php");
	$clase_solicitud = new clase_solicitud;
	$clase_solicitud->set_cod_clase_solicitud($row["cod_clase_solicitud"]);
	$clase_solicitud->consultar();
	$row_clase_solicitud=$clase_solicitud->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_clase_solicitud+2),6,utf8_decode($row_clase_solicitud["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_precio+2),6,utf8_decode($row["precio"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_total+2),6,utf8_decode($row["total"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_solicitud+2),6,utf8_decode($row["fecha_solicitud"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_tipo_servicio+2),6,utf8_decode($row["tipo_servicio"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_pagado+2),6,utf8_decode($row["pagado"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>