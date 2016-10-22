<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class persona extends db{
// CREAMOS LOS ATRIBUTOS
		public $cedula;
		public $nombre;
		public $apellido;
		protected $sexo;
		protected $correo;
		protected $telefono_movil;
		protected $telefono_fijo;
		protected $fecha_nacimiento;
		protected $estatus;
		protected $cod_parroquia;	
		public $direccion;	
		public $foto_perfil;
		public $foto_perfil_peque;
		
		protected $nombre_estado;
		protected $nombre_municipio;
		protected $nombre_parroquia;
// CREAMOS LOS METODOS SET		
			public function set_cedula($cedula){
					$this->cedula= $this->mysqli->real_escape_string($cedula);
			}
		
			public function set_nombre($nombre){
					$this->nombre= $this->mysqli->real_escape_string($nombre);
			}
		
			public function set_apellido($apellido){
					$this->apellido= $this->mysqli->real_escape_string($apellido);
			}
		
			public function set_sexo($sexo){
					$this->sexo= $this->mysqli->real_escape_string($sexo);
			}
			public function set_foto_perfil($foto_perfil){
			
			if($foto_perfil['size']>0){
				include_once("libreria/imagen/class_imagen.php");
				$foto=$foto_perfil['tmp_name'];
				$foto_perfil		= new Imagen();
				$foto_perfil_peque	= new Imagen();
				$ruta_perfil = "archivos/fotos_usuarios/perfil_".$_SESSION['cod_usuario'].".jpg";
				$ruta_perfil_peque = "archivos/fotos_usuarios/perfil_peque_".$_SESSION['cod_usuario'].".jpg";
				$tamano=getimagesize($foto);
				
				$foto_perfil_peque	->set("imagenOrigen"	, str_replace("\\","/",$foto));	
				$foto_perfil_peque	->set("imagenDestino"	, $ruta_perfil_peque);
				$foto_perfil_peque	->set("calidadImagen"	, '95');
				$foto_perfil_peque	->set("anchoDestino"	, '60');
				$foto_perfil_peque	->set("altoDestino"		, '60');
				$foto_perfil_peque	->set("generarArchivo"	, true); 	
				$foto_perfil_peque	->set("modo"			, '2');
				$foto_perfil_peque	->set('archivoTmp'		, true);	
				$foto_perfil_peque	->set('borrarOrigen'	, true); 
				
				$foto_perfil	->set("imagenOrigen"	, str_replace("\\","/",$foto));
				$foto_perfil	->set("imagenDestino"	, $ruta_perfil);
				$foto_perfil	->set("generarArchivo"	, true); 	
				$foto_perfil	->set('archivoTmp'		, true);	
				$foto_perfil	->set('borrarOrigen'	, true); 
				
			if ($tamano[1]>$tamano[0]){
				
				$foto_perfil	->set("anchoDestino"	, '200');
				$foto_perfil	->set("modo"			, '0');
			}else{
				
				$foto_perfil	->set("altoDestino"		, '200');
				$foto_perfil	->set("modo"			, '1');
			}
				$foto_perfil		->procesarImagen();
				$foto_perfil_peque	->procesarImagen();
				$this->foto_perfil=$ruta_perfil;
				$this->foto_perfil_peque=$ruta_perfil_peque;
		}
	}
		
			public function set_correo($correo){
					$this->correo= $this->mysqli->real_escape_string($correo);
			}
		
			public function set_telefono_movil($telefono_movil){
					$this->telefono_movil= $this->mysqli->real_escape_string($telefono_movil);
			}
		
			public function set_telefono_fijo($telefono_fijo){
					$this->telefono_fijo= $this->mysqli->real_escape_string($telefono_fijo);
			}
		
			public function set_fecha_nacimiento($fecha_nacimiento){
				if($fecha_nacimiento){
					$this->fecha_nacimiento= date('Y-m-d',strtotime($fecha_nacimiento));
				}
			}
		
			public function set_estatus($estatus){
					$this->estatus= $this->mysqli->real_escape_string($estatus);
			}
		
			public function set_cod_parroquia($cod_parroquia){
					$this->cod_parroquia= filter_var($cod_parroquia,FILTER_SANITIZE_NUMBER_INT);
			}
			public function set_direccion($direccion){
				
					$this->direccion= $this->mysqli->real_escape_string($direccion);
					
				}

	public function registrar(){		
		return parent::ejecutar("INSERT INTO persona (cedula,nombre,apellido,sexo,correo,telefono_movil,telefono_fijo,fecha_nacimiento,cod_parroquia,direccion) VALUES ('$this->cedula','$this->nombre','$this->apellido','$this->sexo','$this->correo','$this->telefono_movil','$this->telefono_fijo','$this->fecha_nacimiento','$this->cod_parroquia','$this->direccion')");
	}

	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM persona WHERE cedula='$this->cedula'");
		$this->cargar_variables();
		return $res;
	}
	public function consultar_persona(){		
		$res=parent::ejecutar("SELECT * FROM persona WHERE cedula='$this->cedula'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM persona ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM persona WHERE cedula='$this->cedula'");
	}
	public function editar(){		
		return parent::ejecutar("UPDATE persona SET cedula='$this->cedula',nombre='$this->nombre',apellido='$this->apellido',sexo='$this->sexo',correo='$this->correo',telefono_movil='$this->telefono_movil',telefono_fijo='$this->telefono_fijo',fecha_nacimiento='$this->fecha_nacimiento',cod_parroquia='$this->cod_parroquia' WHERE cedula='$this->cedula'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE persona SET nombre='$this->nombre',apellido='$this->apellido',sexo='$this->sexo',correo='$this->correo',telefono_movil='$this->telefono_movil',telefono_fijo='$this->telefono_fijo',fecha_nacimiento='$this->fecha_nacimiento',cod_parroquia='$this->cod_parroquia',direccion='$this->direccion' WHERE cedula='$this->cedula'");
	}
	public function modificar_dato_personal(){
		if($this->foto_perfil and $this->foto_perfil_peque){
			return parent::ejecutar("UPDATE persona SET nombre='$this->nombre',apellido='$this->apellido',sexo='$this->sexo',correo='$this->correo',telefono_movil='$this->telefono_movil',telefono_fijo='$this->telefono_fijo',fecha_nacimiento='$this->fecha_nacimiento',cod_parroquia='$this->cod_parroquia',direccion='$this->direccion',foto_perfil='$this->foto_perfil',foto_perfil_peque='$this->foto_perfil_peque' WHERE cedula='$this->cedula'");
		}else{
			return parent::ejecutar("UPDATE persona SET nombre='$this->nombre',apellido='$this->apellido',sexo='$this->sexo',correo='$this->correo',telefono_movil='$this->telefono_movil',telefono_fijo='$this->telefono_fijo',fecha_nacimiento='$this->fecha_nacimiento',cod_parroquia='$this->cod_parroquia',direccion='$this->direccion' WHERE cedula='$this->cedula'");
			}
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cedula) AS cedula FROM persona");
		$arreglo=$this->row();
		return $arreglo["cedula"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM persona");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM persona WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM persona WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM persona WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		$this->cedula=$row['cedula'];
		$this->nombre=$row['nombre'];
		$this->apellido=$row['apellido'];
		$this->fecha_nacimiento=$row['fecha_nacimiento'];
		$this->sexo=$row['sexo'];
		$this->correo=$row['correo'];
		$this->telefono_fijo=$row['telefono_fijo'];
		$this->telefono_movil=$row['telefono_movil'];
		$this->cod_parroquia=$row['cod_parroquia'];
		$this->direccion=$row['direccion'];
		$this->estatus=$row['estatus'];
		$this->nombre_estado=$row['nombre_estado'];
		$this->nombre_municipio=$row['nombre_municipio'];
		$this->nombre_parroquia=$row['nombre_parroquia'];
		$this->foto_perfil_peque=$row['foto_perfil_peque'];
		$this->foto_perfil=$row['foto_perfil'];
	}
}
?>
