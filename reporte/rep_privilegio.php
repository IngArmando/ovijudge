<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_privilegio.php");
   $privilegio = new privilegio;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Privilegios de usuarios",0,1,"C");
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_vista_sistema="Vista"; 
		$nombre_cod_tipo_usuario="Tipo de usuario";
	
		$suma_mayor_cod_vista_sistema=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_vista_sistema));
		$suma_mayor_cod_tipo_usuario=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_usuario));$suma_mayor=0;    
   $privilegio->listar();
      while ($row=$privilegio->row()){
	include_once("modelo/class_vista_sistema.php");
	$vista_sistema = new vista_sistema;
	$vista_sistema->set_cod_vista_sistema($row["cod_vista_sistema"]);
	$vista_sistema->consultar();
	$row_vista_sistema=$vista_sistema->row();
	$suma_cod_vista_sistema=$lobjPdf->GetStringWidth($row_vista_sistema["descripcion"]);
	include_once("modelo/class_tipo_usuario.php");
	$tipo_usuario = new tipo_usuario;
	$tipo_usuario->set_cod_tipo_usuario($row["cod_tipo_usuario"]);
	$tipo_usuario->consultar();
	$row_tipo_usuario=$tipo_usuario->row();
	$suma_cod_tipo_usuario=$lobjPdf->GetStringWidth($row_tipo_usuario["nombre"]);
		if($suma_cod_vista_sistema>$suma_mayor_cod_vista_sistema){
			$suma_mayor_cod_vista_sistema=$suma_cod_vista_sistema;
		}
		$suma_cod_vista_sistema=0;
		if($suma_cod_tipo_usuario>$suma_mayor_cod_tipo_usuario){
			$suma_mayor_cod_tipo_usuario=$suma_cod_tipo_usuario;
		}
		$suma_cod_tipo_usuario=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_vista_sistema+2),6,utf8_decode($nombre_cod_vista_sistema),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_usuario+2),6,utf8_decode($nombre_cod_tipo_usuario),1,0,"C");
   $lobjPdf->SetFont("arial","",12);
   $lobjPdf->Ln();
      $privilegio->listar();
   while ($row=$privilegio->row()){
	include_once("modelo/class_vista_sistema.php");
	$vista_sistema = new vista_sistema;
	$vista_sistema->set_cod_vista_sistema($row["cod_vista_sistema"]);
	$vista_sistema->consultar();
	$row_vista_sistema=$vista_sistema->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_vista_sistema+2),6,utf8_decode($row_vista_sistema["descripcion"]),1,0,"R");
	include_once("modelo/class_tipo_usuario.php");
	$tipo_usuario = new tipo_usuario;
	$tipo_usuario->set_cod_tipo_usuario($row["cod_tipo_usuario"]);
	$tipo_usuario->consultar();
	$row_tipo_usuario=$tipo_usuario->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_tipo_usuario+2),6,utf8_decode($row_tipo_usuario["nombre"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>