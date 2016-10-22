<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_solicitud.php");
   $solicitud = new solicitud;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Solicitud",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_solicitud="Codigo"; 
		$nombre_cod_motivo="Motivo"; 
		$nombre_cedula="Solicitante"; 
		$nombre_descripcion="Descripcion detallada"; 
		$nombre_fecha="Fecha"; 
		$nombre_cod_estatus_solicitud="Estatus de la solicitud"; 
	
		$suma_mayor_cod_solicitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_solicitud));
		$suma_mayor_cod_motivo=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_motivo));
		$suma_mayor_cedula=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));
		$suma_mayor_fecha=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha));
		$suma_mayor_cod_estatus_solicitud=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_estatus_solicitud));
		$suma_mayor_cedula2=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula2));$suma_mayor=0;    
   $solicitud->listar();
      while ($row=$solicitud->row()){
				$suma_cod_solicitud=$lobjPdf->GetStringWidth($row["cod_solicitud"]);
	include_once("modelo/class_motivo.php");
	$motivo = new motivo;
	$motivo->set_cod_motivo($row["cod_motivo"]);
	$motivo->consultar();
	$row_motivo=$motivo->row();
	$suma_cod_motivo=$lobjPdf->GetStringWidth($row_motivo["nombre"]);
				$suma_cedula=$lobjPdf->GetStringWidth($row["cedula2"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
				$suma_fecha=$lobjPdf->GetStringWidth($row["fecha"]);
	include_once("modelo/class_estatus_solicitud.php");
	$estatus_solicitud = new estatus_solicitud;
	$estatus_solicitud->set_cod_estatus_solicitud($row["cod_estatus_solicitud"]);
	$estatus_solicitud->consultar();
	$row_estatus_solicitud=$estatus_solicitud->row();
	$suma_cod_estatus_solicitud=$lobjPdf->GetStringWidth($row_estatus_solicitud["nombre"]);
				
		if($suma_cod_solicitud>$suma_mayor_cod_solicitud){
			$suma_mayor_cod_solicitud=$suma_cod_solicitud;
		}
		$suma_cod_solicitud=0;
		if($suma_cod_motivo>$suma_mayor_cod_motivo){
			$suma_mayor_cod_motivo=$suma_cod_motivo;
		}
		$suma_cod_motivo=0;
		if($suma_cedula>$suma_mayor_cedula){
			$suma_mayor_cedula=$suma_cedula;
		}
		$suma_cedula=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
		if($suma_fecha>$suma_mayor_fecha){
			$suma_mayor_fecha=$suma_fecha;
		}
		$suma_fecha=0;
		if($suma_cod_estatus_solicitud>$suma_mayor_cod_estatus_solicitud){
			$suma_mayor_cod_estatus_solicitud=$suma_cod_estatus_solicitud;
		}
		$suma_cod_estatus_solicitud=0;
		if($suma_cedula2>$suma_mayor_cedula2){
			$suma_mayor_cedula2=$suma_cedula2;
		}
		$suma_cedula2=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_solicitud+2),6,utf8_decode($nombre_cod_solicitud),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_motivo+2),6,utf8_decode($nombre_cod_motivo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($nombre_cedula),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($nombre_descripcion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha+2),6,utf8_decode($nombre_fecha),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_estatus_solicitud+2),6,utf8_decode($nombre_cod_estatus_solicitud),1,0,"C"); 
	
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $solicitud->listar();
   while ($row=$solicitud->row()){
				$lobjPdf->Cell(($suma_mayor_cod_solicitud+2),6,utf8_decode($row["cod_solicitud"]),1,0,"R");
	include_once("modelo/class_motivo.php");
	$motivo = new motivo;
	$motivo->set_cod_motivo($row["cod_motivo"]);
	$motivo->consultar();
	$row_motivo=$motivo->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_motivo+2),6,utf8_decode($row_motivo["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($row["cedula2"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($row["descripcion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha+2),6,utf8_decode($row["fecha"]),1,0,"R");
	include_once("modelo/class_estatus_solicitud.php");
	$estatus_solicitud = new estatus_solicitud;
	$estatus_solicitud->set_cod_estatus_solicitud($row["cod_estatus_solicitud"]);
	$estatus_solicitud->consultar();
	$row_estatus_solicitud=$estatus_solicitud->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_estatus_solicitud+2),6,utf8_decode($row_estatus_solicitud["nombre"]),1,1,"R");
			
   }
   $lobjPdf->Output(); ?>
