<?php
   /*
   *      clsFpdf.php
   *      
   *      Copyright 2011 José Baldomero Silva Hernández <jobasiher@cantv.net>
   *      
   *      Este programa es software libre, puede redistribuirlo y / o modificar
   *      Bajo los términos de la GNU Licensia Pública General(GPL) publicada por
   *      La Fundación de Software Libre(FSF), bien de la versión 2 o cualquier versión posterior.
   *      
   *      Este programa se distribuye con la esperanza de que sea útil,
   *      Pero SIN NINGUNA GARANTÍA, incluso sin la garantía implícita de
   *      COMERCIALIZACIÓN o IDONEIDAD PARA UN PROPÓSITO PARTICULAR.
   */
	require_once("libreria/fpdf/fpdf.php");
	class clsFpdf extends FPDF
	{
		//Cabecera de página
		public function Header()
		{
			//Logo
			$this->Image('images/logo_reporte.jpg',10,5,240,15);
			//Arial bold 15
			$this->SetFont("Arial","B",15);
			//Título
			
			//Arial bold 8
			$this->SetFont("Arial","B",8);
			//Fecha
			$lcFecha=date("d/m/Y  h:m a");
			$this->Cell(0,50,$lcFecha,0,0,"R");
			//Salto de línea
			$this->Ln(20);
		}

		//Pie de página
		public function Footer()
		{
			//Posición: a 2 cm del final
			$this->SetY(-20);
			//Arial italic 8
			$this->SetFont("Arial","I",8);
			//Dirección
			$this->Cell(0,4,"____________________________",0,1,"C");
			$this->Cell(0,3,"FIRMA Y SELLO",0,1,"C");
			$this->Cell(0,5,"Acarigua Estado Portuguesa",0,1,"C");
			//Número de página
			$this->Cell(0,7,utf8_decode("Página ").$this->PageNo()."/{nb}",0,0,"C");
		}
	}
?>
