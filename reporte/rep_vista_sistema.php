<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_vista_sistema.php");
   $vista_sistema = new vista_sistema;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Vistas del sistema",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_vista_sistema="Codigo"; 
		$nombre_nombre="Nombre"; 
		$nombre_descripcion="Descripción"; 
		$nombre_cod_servicio="Servicio";
	
		$suma_mayor_cod_vista_sistema=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_vista_sistema));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_descripcion=$lobjPdf->GetStringWidth(utf8_decode($nombre_descripcion));
		$suma_mayor_cod_servicio=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_servicio));$suma_mayor=0;    
   $vista_sistema->listar();
      while ($row=$vista_sistema->row()){
				$suma_cod_vista_sistema=$lobjPdf->GetStringWidth($row["cod_vista_sistema"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
				$suma_descripcion=$lobjPdf->GetStringWidth($row["descripcion"]);
	include_once("modelo/class_servicio.php");
	$servicio = new servicio;
	$servicio->set_cod_servicio($row["cod_servicio"]);
	$servicio->consultar();
	$row_servicio=$servicio->row();
	$suma_cod_servicio=$lobjPdf->GetStringWidth($row_servicio["nombre"]);
		if($suma_cod_vista_sistema>$suma_mayor_cod_vista_sistema){
			$suma_mayor_cod_vista_sistema=$suma_cod_vista_sistema;
		}
		$suma_cod_vista_sistema=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_descripcion>$suma_mayor_descripcion){
			$suma_mayor_descripcion=$suma_descripcion;
		}
		$suma_descripcion=0;
		if($suma_cod_servicio>$suma_mayor_cod_servicio){
			$suma_mayor_cod_servicio=$suma_cod_servicio;
		}
		$suma_cod_servicio=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_vista_sistema+2),6,utf8_decode($nombre_cod_vista_sistema),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($nombre_descripcion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_servicio+2),6,utf8_decode($nombre_cod_servicio),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $vista_sistema->listar();
   while ($row=$vista_sistema->row()){
				$lobjPdf->Cell(($suma_mayor_cod_vista_sistema+2),6,utf8_decode($row["cod_vista_sistema"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_descripcion+2),6,utf8_decode($row["descripcion"]),1,0,"R");
	include_once("modelo/class_servicio.php");
	$servicio = new servicio;
	$servicio->set_cod_servicio($row["cod_servicio"]);
	$servicio->consultar();
	$row_servicio=$servicio->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_servicio+2),6,utf8_decode($row_servicio["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>