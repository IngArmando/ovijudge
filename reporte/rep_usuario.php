<?php   require_once("libreria/fpdf/clsFpdf.php");
   require_once("modelo/class_usuario.php");
   $usuario = new usuario;
   $lobjPdf=new clsFpdf();
   $lobjPdf->AliasNbPages();
   $lobjPdf->AddPage("R","Letter");
   $lobjPdf->SetFont("arial","B",15);
   $lobjPdf->Ln(10);
   $lobjPdf->Cell(0,6,"Reporte de usuarios",0,1,"C");
   $lobjPdf->SetFont("arial","B",6);
   $lobjPdf->Ln();
         //analizamos los nombres de las tablas con mas longitud para colocar de ese tamaño las celdas
         //Titulos de las Celdas
		 
		$nombre_cedula="Cedula"; 
		$nombre_nombre="Nombre"; 
		$nombre_cod_tipo_usuario="Tipo de usuario"; 
		$nombre_apellido="Apellido"; 
		$nombre_sexo="Sexo"; 
		$nombre_correo="Correo"; 
		$nombre_telefono_movil="Teléfono Movil"; 
		$nombre_telefono_fijo="Teléfono Fijo"; 
		$nombre_fecha_nacimiento="Fecha de nacimiento"; 
		$nombre_clave="Clave"; 
		$nombre_estatus="Estatus"; 
		$nombre_cod_cargo="Cargo"; 
		$nombre_ultima_actividad="ultima_actividad";
	
		$suma_mayor_cedula=$lobjPdf->GetStringWidth(utf8_decode($nombre_cedula));
		$suma_mayor_nombre=$lobjPdf->GetStringWidth(utf8_decode($nombre_nombre));
		$suma_mayor_cod_tipo_usuario=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_tipo_usuario));
		$suma_mayor_apellido=$lobjPdf->GetStringWidth(utf8_decode($nombre_apellido));
		$suma_mayor_sexo=$lobjPdf->GetStringWidth(utf8_decode($nombre_sexo));
		$suma_mayor_correo=$lobjPdf->GetStringWidth(utf8_decode($nombre_correo));
		$suma_mayor_telefono_movil=$lobjPdf->GetStringWidth(utf8_decode($nombre_telefono_movil));
		$suma_mayor_telefono_fijo=$lobjPdf->GetStringWidth(utf8_decode($nombre_telefono_fijo));
		$suma_mayor_fecha_nacimiento=$lobjPdf->GetStringWidth(utf8_decode($nombre_fecha_nacimiento));
		
		$suma_mayor_estatus=$lobjPdf->GetStringWidth(utf8_decode($nombre_estatus));
		$suma_mayor_cod_cargo=$lobjPdf->GetStringWidth(utf8_decode($nombre_cod_cargo));
		$suma_mayor_ultima_actividad=$lobjPdf->GetStringWidth(utf8_decode($nombre_ultima_actividad));$suma_mayor=0;    
   $usuario->listar();
      while ($row=$usuario->row()){
				$suma_cedula=$lobjPdf->GetStringWidth($row["cedula"]);
				$suma_nombre=$lobjPdf->GetStringWidth($row["nombre"]);
	include_once("modelo/class_tipo_usuario.php");
	$tipo_usuario = new tipo_usuario;
	$tipo_usuario->set_cod_tipo_usuario($row["cod_tipo_usuario"]);
	$tipo_usuario->consultar();
	$row_tipo_usuario=$tipo_usuario->row();
	$suma_cod_tipo_usuario=$lobjPdf->GetStringWidth($row_tipo_usuario["nombre"]);
				$suma_apellido=$lobjPdf->GetStringWidth($row["apellido"]);
				$suma_sexo=$lobjPdf->GetStringWidth($row["sexo"]);
				$suma_correo=$lobjPdf->GetStringWidth($row["correo"]);
				$suma_telefono_movil=$lobjPdf->GetStringWidth($row["telefono_movil"]);
				$suma_telefono_fijo=$lobjPdf->GetStringWidth($row["telefono_fijo"]);
				$suma_fecha_nacimiento=$lobjPdf->GetStringWidth($row["fecha_nacimiento"]);
				$suma_clave=$lobjPdf->GetStringWidth($row["clave"]);
				if($row["estatus"]==1){
					$resultado="Activo";
				}else{
					$resultado="Inactivo";
				}
				$suma_estatus=$lobjPdf->GetStringWidth($resultado);
	include_once("modelo/class_cargo.php");
	$cargo = new cargo;
	$cargo->set_cod_cargo($row["cod_cargo"]);
	$cargo->consultar();
	$row_cargo=$cargo->row();
	$suma_cod_cargo=$lobjPdf->GetStringWidth($row_cargo["nombre"]);
				$suma_ultima_actividad=$lobjPdf->GetStringWidth($row["ultima_actividad"]);
		if($suma_cedula>$suma_mayor_cedula){
			$suma_mayor_cedula=$suma_cedula;
		}
		$suma_cedula=0;
		if($suma_nombre>$suma_mayor_nombre){
			$suma_mayor_nombre=$suma_nombre;
		}
		$suma_nombre=0;
		if($suma_cod_tipo_usuario>$suma_mayor_cod_tipo_usuario){
			$suma_mayor_cod_tipo_usuario=$suma_cod_tipo_usuario;
		}
		$suma_cod_tipo_usuario=0;
		if($suma_apellido>$suma_mayor_apellido){
			$suma_mayor_apellido=$suma_apellido;
		}
		$suma_apellido=0;
		if($suma_sexo>$suma_mayor_sexo){
			$suma_mayor_sexo=$suma_sexo;
		}
		$suma_sexo=0;
		if($suma_correo>$suma_mayor_correo){
			$suma_mayor_correo=$suma_correo;
		}
		$suma_correo=0;
		if($suma_telefono_movil>$suma_mayor_telefono_movil){
			$suma_mayor_telefono_movil=$suma_telefono_movil;
		}
		$suma_telefono_movil=0;
		if($suma_telefono_fijo>$suma_mayor_telefono_fijo){
			$suma_mayor_telefono_fijo=$suma_telefono_fijo;
		}
		$suma_telefono_fijo=0;
		if($suma_fecha_nacimiento>$suma_mayor_fecha_nacimiento){
			$suma_mayor_fecha_nacimiento=$suma_fecha_nacimiento;
		}
		$suma_fecha_nacimiento=0;
		if($suma_clave>$suma_mayor_clave){
			$suma_mayor_clave=$suma_clave;
		}
		$suma_clave=0;
		if($suma_estatus>$suma_mayor_estatus){
			$suma_mayor_estatus=$suma_estatus;
		}
		$suma_estatus=1;
		if($suma_cod_cargo>$suma_mayor_cod_cargo){
			$suma_mayor_cod_cargo=$suma_cod_cargo;
		}
		$suma_cod_cargo=0;
		if($suma_ultima_actividad>$suma_mayor_ultima_actividad){
			$suma_mayor_ultima_actividad=$suma_ultima_actividad;
		}
		$suma_ultima_actividad=0;
   } 
		$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($nombre_cedula),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($nombre_nombre),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_tipo_usuario+2),6,utf8_decode($nombre_cod_tipo_usuario),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_apellido+2),6,utf8_decode($nombre_apellido),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_sexo+2),6,utf8_decode($nombre_sexo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_correo+2),6,utf8_decode($nombre_correo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_telefono_movil+2),6,utf8_decode($nombre_telefono_movil),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_telefono_fijo+2),6,utf8_decode($nombre_telefono_fijo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_fecha_nacimiento+2),6,utf8_decode($nombre_fecha_nacimiento),1,0,"C"); 
		
		$lobjPdf->Cell(($suma_mayor_estatus+2),6,utf8_decode($nombre_estatus),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_cod_cargo+2),6,utf8_decode($nombre_cod_cargo),1,0,"C"); 
		$lobjPdf->Cell(($suma_mayor_ultima_actividad+2),6,utf8_decode($nombre_ultima_actividad),1,0,"C");
   $lobjPdf->SetFont("arial","",6);
   $lobjPdf->Ln();
      $usuario->listar();
   while ($row=$usuario->row()){
				$lobjPdf->Cell(($suma_mayor_cedula+2),6,utf8_decode($row["cedula"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_nombre+2),6,utf8_decode($row["nombre"]),1,0,"R");
	include_once("modelo/class_tipo_usuario.php");
	$tipo_usuario = new tipo_usuario;
	$tipo_usuario->set_cod_tipo_usuario($row["cod_tipo_usuario"]);
	$tipo_usuario->consultar();
	$row_tipo_usuario=$tipo_usuario->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_tipo_usuario+2),6,utf8_decode($row_tipo_usuario["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_apellido+2),6,utf8_decode($row["apellido"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_sexo+2),6,utf8_decode($row["sexo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_correo+2),6,utf8_decode($row["correo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_telefono_movil+2),6,utf8_decode($row["telefono_movil"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_telefono_fijo+2),6,utf8_decode($row["telefono_fijo"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_fecha_nacimiento+2),6,utf8_decode($row["fecha_nacimiento"]),1,0,"R");
				
				if($row["estatus"]==1){
					$resultado="Activo";
				}else{
					$resultado="Inactivo";
				}
				$lobjPdf->Cell(($suma_mayor_estatus+2),6,$resultado,1,0,"R");
	include_once("modelo/class_cargo.php");
	$cargo = new cargo;
	$cargo->set_cod_cargo($row["cod_cargo"]);
	$cargo->consultar();
	$row_cargo=$cargo->row();
	
	$lobjPdf->Cell(($suma_mayor_cod_cargo+2),6,utf8_decode($row_cargo["nombre"]),1,0,"R");
				$lobjPdf->Cell(($suma_mayor_ultima_actividad+2),6,utf8_decode($row["ultima_actividad"]),1,1,"R");
   }
   $lobjPdf->Output(); ?>
