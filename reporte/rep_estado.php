<?php   require_once("libreria/fpdf/clsFpdf_vertical.php");
   require_once("modelo/class_estado.php");
   $estado = new estado;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("P","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Estados",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_estado="Codigo"; 
		$nombre_nombre="Nombre"; 
		$nombre_cod_pais="Pais";
	
		$suma_mayor_cod_estado=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_estado));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_cod_pais=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_pais));$suma_mayor=0;    
   $estado->listar();
      while ($row=$estado->row()){
				$suma_cod_estado=$lobjPdf->GetStringWidth($row["cod_estado"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
	include_once("modelo/class_pais.php");
	$pais = new pais;
	$pais->set_cod_pais($row["cod_pais"]);
	$pais->consultar();
	$row_pais=$pais->row();
	$suma_cod_pais=$lobjPdf->GetStringWidth($row_pais["nombre"]);
		if($suma_cod_estado>$suma_mayor_cod_estado){
			$suma_mayor_cod_estado=$suma_cod_estado;
		}
		$suma_cod_estado=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_cod_pais>$suma_mayor_cod_pais){
			$suma_mayor_cod_pais=$suma_cod_pais;
		}
		$suma_cod_pais=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_estado+2),6,utf8_decode($nombre_cod_estado),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_pais+2),6,utf8_decode($nombre_cod_pais),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $estado->listar();
   while ($row=$estado->row()){
				$lobjPdf->Cell(($suma_mayor_cod_estado+2),6,utf8_decode($row["cod_estado"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
	include_once("modelo/class_pais.php");
	$pais = new pais;
	$pais->set_cod_pais($row["cod_pais"]);
	$pais->consultar();
	$row_pais=$pais->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_pais+2),6,utf8_decode($row_pais["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
