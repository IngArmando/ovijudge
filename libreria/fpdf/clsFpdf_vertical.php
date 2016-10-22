<?php
	date_default_timezone_set("America/Manaus"); 
	require_once("libreria/fpdf/fpdf.php");
	class clsFpdf extends FPDF
	{
		//Cabecera de página
		public function Header()
		{
			//Logo
			$this->Image('images/logo_reporte.jpg',10,5,185,15);
			//Arial bold 15
			$this->SetFont("Arial","B",15);
			//Título
			
			//Arial bold 8
			$this->SetFont("Arial","B",8);
			//Fecha
			$lcFecha=date("d/m/Y  h:i a");
			$this->Cell(0,30,$lcFecha,0,0,"R");
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
			$this->Cell(0,3,"FIRMA y SELLO",0,1,"C");
			$this->Cell(0,5,utf8_decode("En señal de certificación del presente reporte"),0,1,"C");
			//Número de página
			$this->Cell(0,7,utf8_decode("Página ").$this->PageNo()."/{nb}",0,0,"C");
		}
	}
?>
