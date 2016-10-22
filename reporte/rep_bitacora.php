<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_bitacora.php");
   $bitacora = new bitacora;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Bitacoras",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_bitacora="Codigo"; 
		$nombre_evento="Evento"; 
		$nombre_fecha_hora_timestamp="fecha y hora"; 
		$nombre_cedula="Usuario"; 
		$nombre_descripcion="Descripción";
	
		$suma_mayor_cod_bitacora=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_bitacora));
		$suma_mayor_evento=$lobjPdf->GetStringWidth(utf8_decode($nombre_evento));
		$suma_mayor_fecha_hora_timestamp=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_hora_timestamp));
		$suma_mayor_cedula=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));$suma_mayor=0;    
   $bitacora->listar();
      while ($row=$bitacora->row()){
				$suma_cod_bitacora=$lobjPdf->GetStringWidth($row["cod_bitacora"]);
				$suma_evento=$lobjPdf->GetStringWidth($row["evento"]);
				$suma_fecha_hora_timestamp=$lobjPdf->GetStringWidth($row["fecha_hora_timestamp"]);
				$suma_cedula=$lobjPdf->GetStringWidth($row["cedula"]." ".$row["usuario_nombre"]." ".$row["usuario_apellido"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
		if($suma_cod_bitacora>$suma_mayor_cod_bitacora){
			$suma_mayor_cod_bitacora=$suma_cod_bitacora;
		}
		$suma_cod_bitacora=0;
		if($suma_evento>$suma_mayor_evento){
			$suma_mayor_evento=$suma_evento;
		}
		$suma_evento=0;
		if($suma_fecha_hora_timestamp>$suma_mayor_fecha_hora_timestamp){
			$suma_mayor_fecha_hora_timestamp=$suma_fecha_hora_timestamp;
		}
		$suma_fecha_hora_timestamp=0;
		if($suma_cedula>$suma_mayor_cedula){
			$suma_mayor_cedula=$suma_cedula;
		}
		$suma_cedula=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_bitacora+2),6,utf8_decode($nombre_cod_bitacora),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_evento+2),6,utf8_decode($nombre_evento),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_hora_timestamp+2),6,utf8_decode($nombre_fecha_hora_timestamp),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($nombre_cedula),1,0,"C"); 
		$lobjPdf->Cell((100),6,utf8_decode($nombre_descripcion),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $bitacora->listar();
   while ($row=$bitacora->row()){
				$lobjPdf->Cell(($suma_mayor_cod_bitacora+2),6,utf8_decode($row["cod_bitacora"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_evento+2),6,utf8_decode($row["evento"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_hora_timestamp+2),6,utf8_decode($row["fecha_hora_timestamp"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($row["cedula"]." ".$row["usuario_nombre"]." ".$row["usuario_apellido"]),1,0,"R");
				$lobjPdf->MultiCell((100),6,utf8_decode($row["descripcion"]),1);
   }
   $lobjPdf->Output();
   
    ?>
