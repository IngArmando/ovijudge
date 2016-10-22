<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_servicio.php");
   $servicio = new servicio;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Servicios",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_servicio="Codigo"; 
		$nombre_cod_modulo="Modulo"; 
		$nombre_nombre="Nombre"; 
		$nombre_cod_vista_sistema="Vista";
	
		$suma_mayor_cod_servicio=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_servicio));
		$suma_mayor_cod_modulo=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_modulo));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_cod_vista_sistema=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_vista_sistema));$suma_mayor=0;    
   $servicio->listar();
      while ($row=$servicio->row()){
				$suma_cod_servicio=$lobjPdf->GetStringWidth($row["cod_servicio"]);
	include_once("modelo/class_modulo.php");
	$modulo = new modulo;
	$modulo->set_cod_modulo($row["cod_modulo"]);
	$modulo->consultar();
	$row_modulo=$modulo->row();
	$suma_cod_modulo=$lobjPdf->GetStringWidth($row_modulo["nombre"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
	include_once("modelo/class_vista_sistema.php");
	$vista_sistema = new vista_sistema;
	$vista_sistema->set_cod_vista_sistema($row["cod_vista_sistema"]);
	$vista_sistema->consultar();
	$row_vista_sistema=$vista_sistema->row();
	$suma_cod_vista_sistema=$lobjPdf->GetStringWidth($row_vista_sistema["nombre"]);
		if($suma_cod_servicio>$suma_mayor_cod_servicio){
			$suma_mayor_cod_servicio=$suma_cod_servicio;
		}
		$suma_cod_servicio=0;
		if($suma_cod_modulo>$suma_mayor_cod_modulo){
			$suma_mayor_cod_modulo=$suma_cod_modulo;
		}
		$suma_cod_modulo=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_cod_vista_sistema>$suma_mayor_cod_vista_sistema){
			$suma_mayor_cod_vista_sistema=$suma_cod_vista_sistema;
		}
		$suma_cod_vista_sistema=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_servicio+2),6,utf8_decode($nombre_cod_servicio),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_modulo+2),6,utf8_decode($nombre_cod_modulo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_vista_sistema+2),6,utf8_decode($nombre_cod_vista_sistema),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $servicio->listar();
   while ($row=$servicio->row()){
				$lobjPdf->Cell(($suma_mayor_cod_servicio+2),6,utf8_decode($row["cod_servicio"]),1,0,"R");
	include_once("modelo/class_modulo.php");
	$modulo = new modulo;
	$modulo->set_cod_modulo($row["cod_modulo"]);
	$modulo->consultar();
	$row_modulo=$modulo->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_modulo+2),6,utf8_decode($row_modulo["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
	include_once("modelo/class_vista_sistema.php");
	$vista_sistema = new vista_sistema;
	$vista_sistema->set_cod_vista_sistema($row["cod_vista_sistema"]);
	$vista_sistema->consultar();
	$row_vista_sistema=$vista_sistema->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_vista_sistema+2),6,utf8_decode($row_vista_sistema["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
