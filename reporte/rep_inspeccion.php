<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_inspeccion.php");
   $inspeccion = new inspeccion;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Inspección",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_inspeccion="Codigo"; 
		$nombre_codigo_campo="Campo"; 
		$nombre_cod_estatus_inspeccion="Estatus"; 
		$nombre_cedula_tecnico="Tecnico"; 
		$nombre_fecha_inspeccion="fecha_inspeccion"; 
		$nombre_precio="precio"; 
		$nombre_tipo_servicio="tipo_servicio"; 
		$nombre_pagado="pagado";
	
		$suma_mayor_cod_inspeccion=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_inspeccion));
		$suma_mayor_codigo_campo=$lobjPdf->GetStringWidth(utf8_decode($nombre_codigo_campo));
		$suma_mayor_cod_estatus_inspeccion=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_estatus_inspeccion));
		$suma_mayor_cedula_tecnico=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula_tecnico));
		$suma_mayor_fecha_inspeccion=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_inspeccion));
		$suma_mayor_precio=$lobjPdf->GetStringWidth(utf8_decode($nombre_precio));
		$suma_mayor_tipo_servicio=$lobjPdf->GetStringWidth(utf8_decode($nombre_tipo_servicio));
		$suma_mayor_pagado=$lobjPdf->GetStringWidth(utf8_decode($nombre_pagado));$suma_mayor=0;    
   $inspeccion->listar();
      while ($row=$inspeccion->row()){
				$suma_cod_inspeccion=$lobjPdf->GetStringWidth($row["cod_inspeccion"]);
	include_once("modelo/class_campo.php");
	$campo = new campo;
	$campo->set_codigo_campo($row["codigo_campo"]);
	$campo->consultar();
	$row_campo=$campo->row();
	$suma_codigo_campo=$lobjPdf->GetStringWidth($row_campo["ubicacion"]);
	include_once("modelo/class_estatus_inspeccion.php");
	$estatus_inspeccion = new estatus_inspeccion;
	$estatus_inspeccion->set_cod_estatus_inspeccion($row["cod_estatus_inspeccion"]);
	$estatus_inspeccion->consultar();
	$row_estatus_inspeccion=$estatus_inspeccion->row();
	$suma_cod_estatus_inspeccion=$lobjPdf->GetStringWidth($row_estatus_inspeccion["nombre"]);
	include_once("modelo/class_tecnico_senasem.php");
	$tecnico_senasem = new tecnico_senasem;
	$tecnico_senasem->set_cedula_tecnico($row["cedula_tecnico"]);
	$tecnico_senasem->consultar();
	$row_tecnico_senasem=$tecnico_senasem->row();
	$suma_cedula_tecnico=$lobjPdf->GetStringWidth($row_tecnico_senasem["nombre"]);
				$suma_fecha_inspeccion=$lobjPdf->GetStringWidth($row["fecha_inspeccion"]);
				$suma_precio=$lobjPdf->GetStringWidth($row["precio"]);
				$suma_tipo_servicio=$lobjPdf->GetStringWidth($row["tipo_servicio"]);
				$suma_pagado=$lobjPdf->GetStringWidth($row["pagado"]);
		if($suma_cod_inspeccion>$suma_mayor_cod_inspeccion){
			$suma_mayor_cod_inspeccion=$suma_cod_inspeccion;
		}
		$suma_cod_inspeccion=0;
		if($suma_codigo_campo>$suma_mayor_codigo_campo){
			$suma_mayor_codigo_campo=$suma_codigo_campo;
		}
		$suma_codigo_campo=0;
		if($suma_cod_estatus_inspeccion>$suma_mayor_cod_estatus_inspeccion){
			$suma_mayor_cod_estatus_inspeccion=$suma_cod_estatus_inspeccion;
		}
		$suma_cod_estatus_inspeccion=0;
		if($suma_cedula_tecnico>$suma_mayor_cedula_tecnico){
			$suma_mayor_cedula_tecnico=$suma_cedula_tecnico;
		}
		$suma_cedula_tecnico=0;
		if($suma_fecha_inspeccion>$suma_mayor_fecha_inspeccion){
			$suma_mayor_fecha_inspeccion=$suma_fecha_inspeccion;
		}
		$suma_fecha_inspeccion=0;
		if($suma_precio>$suma_mayor_precio){
			$suma_mayor_precio=$suma_precio;
		}
		$suma_precio=0;
		if($suma_tipo_servicio>$suma_mayor_tipo_servicio){
			$suma_mayor_tipo_servicio=$suma_tipo_servicio;
		}
		$suma_tipo_servicio=0;
		if($suma_pagado>$suma_mayor_pagado){
			$suma_mayor_pagado=$suma_pagado;
		}
		$suma_pagado=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_inspeccion+2),6,utf8_decode($nombre_cod_inspeccion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_codigo_campo+2),6,utf8_decode($nombre_codigo_campo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_estatus_inspeccion+2),6,utf8_decode($nombre_cod_estatus_inspeccion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cedula_tecnico+2),6,utf8_decode($nombre_cedula_tecnico),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_inspeccion+2),6,utf8_decode($nombre_fecha_inspeccion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_precio+2),6,utf8_decode($nombre_precio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_tipo_servicio+2),6,utf8_decode($nombre_tipo_servicio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_pagado+2),6,utf8_decode($nombre_pagado),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $inspeccion->listar();
   while ($row=$inspeccion->row()){
				$lobjPdf->Cell(($suma_mayor_cod_inspeccion+2),6,utf8_decode($row["cod_inspeccion"]),1,0,"R");
	include_once("modelo/class_campo.php");
	$campo = new campo;
	$campo->set_codigo_campo($row["codigo_campo"]);
	$campo->consultar();
	$row_campo=$campo->row();
	
	$lobjPdf->Cell(($suma_mayor_codigo_campo+2),6,utf8_decode($row_campo["ubicacion"]),1,0,"R");
	include_once("modelo/class_estatus_inspeccion.php");
	$estatus_inspeccion = new estatus_inspeccion;
	$estatus_inspeccion->set_cod_estatus_inspeccion($row["cod_estatus_inspeccion"]);
	$estatus_inspeccion->consultar();
	$row_estatus_inspeccion=$estatus_inspeccion->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_estatus_inspeccion+2),6,utf8_decode($row_estatus_inspeccion["nombre"]),1,0,"R");
	include_once("modelo/class_tecnico_senasem.php");
	$tecnico_senasem = new tecnico_senasem;
	$tecnico_senasem->set_cedula_tecnico($row["cedula_tecnico"]);
	$tecnico_senasem->consultar();
	$row_tecnico_senasem=$tecnico_senasem->row();
	
	$lobjPdf->Cell(($suma_mayor_cedula_tecnico+2),6,utf8_decode($row_tecnico_senasem["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_inspeccion+2),6,utf8_decode($row["fecha_inspeccion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_precio+2),6,utf8_decode($row["precio"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_tipo_servicio+2),6,utf8_decode($row["tipo_servicio"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_pagado+2),6,utf8_decode($row["pagado"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>