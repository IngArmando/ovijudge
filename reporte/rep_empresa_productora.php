<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_empresa_productora.php");
   $empresa_productora = new empresa_productora;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",12);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de Empresa Productora",0,1,"C");
   $lobjPdf->SetFont("arial","B",9);
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_rif_productora="RIF"; 
		$nombre_codigo_empresa="Codigo unico"; 
		$nombre_fecha_registro="Fecha de registro"; 
		$nombre_nombre="Razon Social"; 
		$nombre_correo="Correo"; 
		$nombre_direccion="Dirección"; 
		$nombre_estatus="Estatus"; 
		$nombre_telefono="Teléfono"; 
		$nombre_usuario_cedula="Usuario Actual"; 
		$nombre_fecha_codigo="fecha_codigo";
	
		$suma_mayor_rif_productora=$lobjPdf->GetStringWidth(utf8_decode($nombre_rif_productora));
		$suma_mayor_codigo_empresa=$lobjPdf->GetStringWidth(utf8_decode($nombre_codigo_empresa));
		$suma_mayor_fecha_registro=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_registro));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_correo=$lobjPdf->GetStringWidth(utf8_decode($nombre_correo));
		$suma_mayor_direccion=$lobjPdf->GetStringWidth(utf8_decode($nombre_direccion));
		$suma_mayor_estatus=$lobjPdf->GetStringWidth(utf8_decode($nombre_estatus));
		$suma_mayor_telefono=$lobjPdf->GetStringWidth(utf8_decode($nombre_telefono));
		$suma_mayor_usuario_cedula=$lobjPdf->GetStringWidth(utf8_decode($nombre_usuario_cedula));
		$suma_mayor_fecha_codigo=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_codigo));$suma_mayor=0;    
   $empresa_productora->listar();
      while ($row=$empresa_productora->row()){
				$suma_rif_productora=$lobjPdf->GetStringWidth($row["rif_productora"]);
				$suma_codigo_empresa=$lobjPdf->GetStringWidth($row["codigo_empresa"]);
				$suma_fecha_registro=$lobjPdf->GetStringWidth($row["fecha_registro"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
				$suma_correo=$lobjPdf->GetStringWidth($row["correo"]);
				$suma_direccion=$lobjPdf->GetStringWidth($row["direccion"]);
				if($row["estatus"]==1){
					$resultado="Activo";
				}else{
					$resultado="Inactivo";
				}
				$suma_estatus=$lobjPdf->GetStringWidth($resultado);
				$suma_telefono=$lobjPdf->GetStringWidth($row["telefono"]);
				$suma_usuario_cedula=$lobjPdf->GetStringWidth($row["usuario_cedula"]);
				$suma_fecha_codigo=$lobjPdf->GetStringWidth($row["fecha_codigo"]);
		if($suma_rif_productora>$suma_mayor_rif_productora){
			$suma_mayor_rif_productora=$suma_rif_productora;
		}
		$suma_rif_productora=0;
		if($suma_codigo_empresa>$suma_mayor_codigo_empresa){
			$suma_mayor_codigo_empresa=$suma_codigo_empresa;
		}
		$suma_codigo_empresa=0;
		if($suma_fecha_registro>$suma_mayor_fecha_registro){
			$suma_mayor_fecha_registro=$suma_fecha_registro;
		}
		$suma_fecha_registro=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_correo>$suma_mayor_correo){
			$suma_mayor_correo=$suma_correo;
		}
		$suma_correo=0;
		if($suma_direccion>$suma_mayor_direccion){
			$suma_mayor_direccion=$suma_direccion;
		}
		$suma_direccion=0;
		if($suma_estatus>$suma_mayor_estatus){
			$suma_mayor_estatus=$suma_estatus;
		}
		$suma_estatus=1;
		if($suma_telefono>$suma_mayor_telefono){
			$suma_mayor_telefono=$suma_telefono;
		}
		$suma_telefono=0;
		if($suma_usuario_cedula>$suma_mayor_usuario_cedula){
			$suma_mayor_usuario_cedula=$suma_usuario_cedula;
		}
		$suma_usuario_cedula=0;
		if($suma_fecha_codigo>$suma_mayor_fecha_codigo){
			$suma_mayor_fecha_codigo=$suma_fecha_codigo;
		}
		$suma_fecha_codigo=0;
   } 
		$lobjPdf->Cell(($suma_mayor_rif_productora+2),6,utf8_decode($nombre_rif_productora),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_codigo_empresa+2),6,utf8_decode($nombre_codigo_empresa),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_registro+2),6,utf8_decode($nombre_fecha_registro),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_correo+2),6,utf8_decode($nombre_correo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_direccion+2),6,utf8_decode($nombre_direccion),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_estatus+2),6,utf8_decode($nombre_estatus),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_telefono+2),6,utf8_decode($nombre_telefono),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_usuario_cedula+2),6,utf8_decode($nombre_usuario_cedula),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_codigo+2),6,utf8_decode($nombre_fecha_codigo),1,0,"C");
   $lobjPdf->SetFont("arial","",9);
   $lobjPdf->Ln();
      $empresa_productora->listar();
   while ($row=$empresa_productora->row()){
				$lobjPdf->Cell(($suma_mayor_rif_productora+2),6,utf8_decode($row["rif_productora"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_codigo_empresa+2),6,utf8_decode($row["codigo_empresa"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_registro+2),6,utf8_decode($row["fecha_registro"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_correo+2),6,utf8_decode($row["correo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_direccion+2),6,utf8_decode($row["direccion"]),1,0,"R");
				if($row["estatus"]==1){
					$resultado="Activo";
				}else{
					$resultado="Inactivo";
				}
				$lobjPdf->Cell(($suma_mayor_estatus+2),6,$resultado,1,0,"R");
				$lobjPdf->Cell(($suma_mayor_telefono+2),6,utf8_decode($row["telefono"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_usuario_cedula+2),6,utf8_decode($row["usuario_cedula"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_codigo+2),6,utf8_decode($row["fecha_codigo"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
