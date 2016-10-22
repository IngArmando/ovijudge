<?php 
$cod_rubro=$_GET['cod_rubro'];
if(!$cod_rubro){
	echo '
	
	<link type="text/css" href="libreria/bootstrap-3.1.1/css/bootstrap.min.css"  rel="stylesheet" />
	<meta charset="utf-8">
	<div class="panel panel-default">
		<div class="panel-heading">
		SELECCIONE EL RUBRO
		</div>
		<div class="panel-body">
	'.combo_cod_rubro($valor).'
	</div>
	</div>';
	
	}else{
		
require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_accension.php");
   $accension = new accension;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",20);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Accesiones",0,1,"C");
   $lobjPdf->SetFont("arial","B",16);
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_accension="Codigo"; 
		$nombre_pedigree="Pedigrí"; 
		$cruce="Cruce";  
		
    
		$lobjPdf->Cell((20),10,utf8_decode($nombre_cod_accension),1,0,"C"); 
		$lobjPdf->Cell((70),10,utf8_decode($nombre_pedigree),1,0,"C");
		$lobjPdf->Cell((0),10,utf8_decode($cruce),1,0,"C"); 
		
		
		
   $lobjPdf->SetFont("arial","",16);
   $lobjPdf->Ln();
   $accension->set_cod_rubro($cod_rubro);		
   $accension->consulta_por('cod_rubro');
   while ($row=$accension->row()){
		$lobjPdf->Cell((20),10,utf8_decode($row["cod_accension"]),1,0,"R");
		$lobjPdf->Cell((70),10,utf8_decode($row["pedigree"]),1,0,"R");
		$lobjPdf->Cell((0),10,utf8_decode($row["cruze"]),1,0,"R");
		$lobjPdf->ln();				
   }
   $lobjPdf->Output(); 
  } 
  function combo_cod_rubro($valor){
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->listar();
	$salida.= '<select onchange="window.open(\'rep.php?&rep=accension_limitado&cod_rubro=\'+this.value+\'\',\'_self\')"  id="cod_rubro" class="form-control" name="cod_rubro" >'; 
	$salida.= '<option value="">Seleccione</option>';
	while($row_rubro = $rubro->row()){
		$salida.= '<option value="'.$row_rubro["cod_rubro"].'"';	
		if($row_rubro["cod_rubro"]== $valor) $salida.= " selected ";									
		$salida.= '>'.$row_rubro["nombre"]."</option>";
	}
	$salida.= '</select>';

	return $salida;
} 
 
  ?>
