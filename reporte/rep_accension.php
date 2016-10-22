<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_accension.php");
   $accension = new accension;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Accesiones",0,1,"C");
   $lobjPdf->SetFont("arial","B",7);
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cod_accension="Codigo"; 
		$nombre_pedigree="Pedigrí"; 
		$nombre_fecha_hora_creacion="Fecha y hora de Creación"; 
		$nombre_rif_donante="Donante"; 
		$nombre_fecha_adquisicion="Fecha de adquisición"; 
		$nombre_cod_bandeja_accension="Bandeja de accensión"; 
		$nombre_cedula="Cedula"; 
		$nombre_cantidad_gramos="Cantidad de gramos"; 
		$nombre_viabilidad="Viabilidad"; 
		$nombre_humedad="Humedad"; 
		$nombre_cod_color="Color"; 
		$nombre_cod_estatus="Estatus"; 
		$nombre_cod_rubro="Rubro"; 
		$nombre_nombre="Nombre";
		$suma_mayor_cod_rubro=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_rubro));
		$suma_mayor_cod_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_accension));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_pedigree=$lobjPdf->GetStringWidth(utf8_decode($nombre_pedigree));
		$suma_mayor_fecha_hora_creacion=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_hora_creacion));
		$suma_mayor_rif_donante=$lobjPdf->GetStringWidth(utf8_decode($nombre_rif_donante));
		$suma_mayor_fecha_adquisicion=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_adquisicion));
		$suma_mayor_cod_bandeja_accension=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_bandeja_accension));
		$suma_mayor_cedula=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula));
		$suma_mayor_cantidad_gramos=$lobjPdf->GetStringWidth(utf8_decode($nombre_cantidad_gramos));
		$suma_mayor_viabilidad=$lobjPdf->GetStringWidth(utf8_decode($nombre_viabilidad));
		$suma_mayor_humedad=$lobjPdf->GetStringWidth(utf8_decode($nombre_humedad));
		$suma_mayor_cod_color=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_color));
		$suma_mayor_cod_estatus=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_estatus));
		
		
		
		$suma_mayor=0;    
   $accension->listar();
      while ($row=$accension->row()){
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->set_cod_rubro($row["cod_rubro"]);
	$rubro->consultar();
	$row_rubro=$rubro->row();
	$suma_cod_rubro=$lobjPdf->GetStringWidth($row_rubro["nombre"]);
	$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
				$suma_cod_accension=$lobjPdf->GetStringWidth($row["cod_accension"]);
				$suma_pedigree=$lobjPdf->GetStringWidth($row["pedigree"]);
				$suma_fecha_hora_creacion=$lobjPdf->GetStringWidth($row["fecha_hora_creacion"]);
	include_once("modelo/class_donante.php");
	$donante = new donante;
	$donante->set_rif_donante($row["rif_donante"]);
	$donante->consultar();
	$row_donante=$donante->row();
	$suma_rif_donante=$lobjPdf->GetStringWidth($row_donante["nombre"]);
				$suma_fecha_adquisicion=$lobjPdf->GetStringWidth($row["fecha_adquisicion"]);
	include_once("modelo/class_bandeja_accension.php");
	$bandeja_accension = new bandeja_accension;
	$bandeja_accension->set_cod_bandeja_accension($row["cod_bandeja_accension"]);
	$bandeja_accension->consultar();
	$row_bandeja_accension=$bandeja_accension->row();
	$suma_cod_bandeja_accension=$lobjPdf->GetStringWidth($row_bandeja_accension["descripcion"]);
				$suma_cedula=$lobjPdf->GetStringWidth($row["cedula"]);
				$suma_cantidad_gramos=$lobjPdf->GetStringWidth($row["cantidad_gramos"]);
				$suma_viabilidad=$lobjPdf->GetStringWidth($row["viabilidad"]);
				$suma_humedad=$lobjPdf->GetStringWidth($row["humedad"]);
	include_once("modelo/class_colores_ascencion.php");
	$colores_ascencion = new colores_ascencion;
	$colores_ascencion->set_cod_color($row["cod_color"]);
	$colores_ascencion->consultar();
	$row_colores_ascencion=$colores_ascencion->row();
	$suma_cod_color=$lobjPdf->GetStringWidth($row_colores_ascencion["nombre"]);
	include_once("modelo/class_estatus.php");
	$estatus = new estatus;
	$estatus->set_cod_estatus($row["cod_estatus"]);
	$estatus->consultar();
	$row_estatus=$estatus->row();
	$suma_cod_estatus=$lobjPdf->GetStringWidth($row_estatus["nombre"]);

				
		if($suma_cod_accension>$suma_mayor_cod_accension){
			$suma_mayor_cod_accension=$suma_cod_accension;
		}
		$suma_cod_accension=0;
		if($suma_pedigree>$suma_mayor_pedigree){
			$suma_mayor_pedigree=$suma_pedigree;
		}
		$suma_pedigree=0;
		if($suma_fecha_hora_creacion>$suma_mayor_fecha_hora_creacion){
			$suma_mayor_fecha_hora_creacion=$suma_fecha_hora_creacion;
		}
		$suma_fecha_hora_creacion=0;
		if($suma_rif_donante>$suma_mayor_rif_donante){
			$suma_mayor_rif_donante=$suma_rif_donante;
		}
		$suma_rif_donante=0;
		if($suma_fecha_adquisicion>$suma_mayor_fecha_adquisicion){
			$suma_mayor_fecha_adquisicion=$suma_fecha_adquisicion;
		}
		$suma_fecha_adquisicion=0;
		if($suma_cod_bandeja_accension>$suma_mayor_cod_bandeja_accension){
			$suma_mayor_cod_bandeja_accension=$suma_cod_bandeja_accension;
		}
		$suma_cod_bandeja_accension=0;
		if($suma_cedula>$suma_mayor_cedula){
			$suma_mayor_cedula=$suma_cedula;
		}
		$suma_cedula=0;
		if($suma_cantidad_gramos>$suma_mayor_cantidad_gramos){
			$suma_mayor_cantidad_gramos=$suma_cantidad_gramos;
		}
		$suma_cantidad_gramos=0;
		if($suma_viabilidad>$suma_mayor_viabilidad){
			$suma_mayor_viabilidad=$suma_viabilidad;
		}
		$suma_viabilidad=0;
		if($suma_humedad>$suma_mayor_humedad){
			$suma_mayor_humedad=$suma_humedad;
		}
		$suma_humedad=0;
		if($suma_cod_color>$suma_mayor_cod_color){
			$suma_mayor_cod_color=$suma_cod_color;
		}
		$suma_cod_color=0;
		if($suma_cod_estatus>$suma_mayor_cod_estatus){
			$suma_mayor_cod_estatus=$suma_cod_estatus;
		}
		$suma_cod_estatus=1;
		if($suma_cod_rubro>$suma_mayor_cod_rubro){
			$suma_mayor_cod_rubro=$suma_cod_rubro;
		}
		$suma_cod_rubro=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($nombre_cod_rubro),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($nombre_cod_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C");
		$lobjPdf->Cell(($suma_mayor_pedigree+2),6,utf8_decode($nombre_pedigree),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_hora_creacion+2),6,utf8_decode($nombre_fecha_hora_creacion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_rif_donante+2),6,utf8_decode($nombre_rif_donante),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_adquisicion+2),6,utf8_decode($nombre_fecha_adquisicion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_bandeja_accension+2),6,utf8_decode($nombre_cod_bandeja_accension),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($nombre_cedula),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cantidad_gramos+2),6,utf8_decode($nombre_cantidad_gramos),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_viabilidad+2),6,utf8_decode($nombre_viabilidad),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_humedad+2),6,utf8_decode($nombre_humedad),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_color+2),6,utf8_decode($nombre_cod_color),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_estatus+2),6,utf8_decode($nombre_cod_estatus),1,0,"C"); 
		
		
   $lobjPdf->SetFont("arial","",7);
   $lobjPdf->Ln();
      $accension->listar();
   while ($row=$accension->row()){
	include_once("modelo/class_rubro.php");
	$rubro = new rubro;
	$rubro->set_cod_rubro($row["cod_rubro"]);
	$rubro->consultar();
	$row_rubro=$rubro->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_rubro+2),6,utf8_decode($row_rubro["nombre"]),1,0,"R");
	$lobjPdf->Cell(($suma_mayor_cod_accension+2),6,utf8_decode($row["cod_accension"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
				
				$lobjPdf->Cell(($suma_mayor_pedigree+2),6,utf8_decode($row["pedigree"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_hora_creacion+2),6,utf8_decode($row["fecha_hora_creacion"]),1,0,"R");
	include_once("modelo/class_donante.php");
	$donante = new donante;
	$donante->set_rif_donante($row["rif_donante"]);
	$donante->consultar();
	$row_donante=$donante->row();
	
	$lobjPdf->Cell(($suma_mayor_rif_donante+2),6,utf8_decode($row_donante["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_adquisicion+2),6,utf8_decode($row["fecha_adquisicion"]),1,0,"R");
	include_once("modelo/class_bandeja_accension.php");
	$bandeja_accension = new bandeja_accension;
	$bandeja_accension->set_cod_bandeja_accension($row["cod_bandeja_accension"]);
	$bandeja_accension->consultar();
	$row_bandeja_accension=$bandeja_accension->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_bandeja_accension+2),6,utf8_decode($row_bandeja_accension["descripcion"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($row["cedula"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_cantidad_gramos+2),6,utf8_decode($row["cantidad_gramos"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_viabilidad+2),6,utf8_decode($row["viabilidad"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_humedad+2),6,utf8_decode($row["humedad"]),1,0,"R");
	include_once("modelo/class_colores_ascencion.php");
	$colores_ascencion = new colores_ascencion;
	$colores_ascencion->set_cod_color($row["cod_color"]);
	$colores_ascencion->consultar();
	$row_colores_ascencion=$colores_ascencion->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_color+2),6,utf8_decode($row_colores_ascencion["nombre"]),1,0,"R");
	include_once("modelo/class_estatus.php");
	$estatus = new estatus;
	$estatus->set_cod_estatus($row["cod_estatus"]);
	$estatus->consultar();
	$row_estatus=$estatus->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_estatus+2),6,utf8_decode($row_estatus["nombre"]),1,1,"R");

   }
   $lobjPdf->Output(); ?>
