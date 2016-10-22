<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_servicio.php");
// INSTANCIAMOS LA CLASE
class vista_sistema extends servicio{
// CREAMOS LOS ATRIBUTOS
		public $cod_vista_sistema;
		public $nombre;
		public $descripcion;
		public $cod_servicio;	
		public $posicion;	
		public $estatus;
		public $tipo_apertura;
		public $registrar;
		public $consultar;
		public $eliminar;
		public $actualizar;
		public $desactivar;
		public $nombre_servicio;
		public $visible;
// CREAMOS LOS METODOS SET		
			public function set_cod_vista_sistema($cod_vista_sistema){
					$this->cod_vista_sistema= $cod_vista_sistema;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_descripcion($descripcion){
					$this->descripcion= $descripcion;
			}
		
			public function set_cod_servicio($cod_servicio){
					$this->cod_servicio= $cod_servicio;
			}
			public function set_posicion($posicion){
					$this->posicion=$posicion;
			}
			public function set_tipo_apertura($tipo_apertura){
					$this->tipo_apertura=$tipo_apertura;
				}
			public function set_estatus($estatus){
				$this->estatus=$estatus;
			}
			public function set_registrar($registrar){
				$this->registrar=$registrar;
			}
			public function set_consultar($consultar){
				$this->consultar=$consultar;
			}
			public function set_actualizar($actualizar){
				$this->actualizar=$actualizar;
			}
			public function set_eliminar($eliminar){
				$this->eliminar=$eliminar;
			}
			public function set_desactivar($desactivar){
				$this->desactivar=$desactivar;
			}
			public function set_visible($visible){
				$this->visible=$visible;
				}
		

	public function registrar(){		
		parent::registrar_bitacora('Registro','vista del sistema');
		return parent::ejecutar("INSERT INTO vista_sistema (cod_vista_sistema,nombre,descripcion,cod_servicio,tipo_apertura,registrar,consultar,actualizar,eliminar,desactivar,visible,estatus) VALUES ('$this->cod_vista_sistema','$this->nombre','$this->descripcion','$this->cod_servicio','$this->tipo_apertura','$this->registrar','$this->consultar','$this->actualizar','$this->eliminar','$this->desactivar','$this->visible','$this->estatus')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT vista_sistema.*,servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM vista_sistema
		INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio
		INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo
		WHERE vista_sistema.cod_vista_sistema='$this->cod_vista_sistema'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT vista_sistema.*,servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM vista_sistema 
		INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio
		INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo
		WHERE vista_sistema.estatus=1
		");
	}
	public function listar_ordenado(){		
		return parent::ejecutar("SELECT vista_sistema.*,servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM vista_sistema 
		INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio
		INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo  WHERE vista_sistema.estatus=1 ORDER BY posicion
		");
	}

	public function eliminar(){		
		parent::registrar_bitacora('Elimino','vista del sistema');
		return parent::ejecutar("DELETE FROM vista_sistema WHERE cod_vista_sistema='$this->cod_vista_sistema'");
	}
	public function listar_todo(){		
		return parent::ejecutar("SELECT vista_sistema.*,servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM vista_sistema 
		INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio
		INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo");
	}
	public function desactivar(){
		$this->consultar();
		$a=$this->row();		
		return parent::ejecutar("UPDATE vista_sistema SET estatus=0 WHERE cod_vista_sistema='$this->cod_vista_sistema'");
	}	
	public function activar(){
		$this->consultar();
		$a=$this->row();		
		return parent::ejecutar("UPDATE vista_sistema SET estatus=1 WHERE cod_vista_sistema='$this->cod_vista_sistema'");
	}	
	public function modificar(){		
		return parent::ejecutar("UPDATE vista_sistema SET cod_vista_sistema='$this->cod_vista_sistema',nombre='$this->nombre',descripcion='$this->descripcion',cod_servicio='$this->cod_servicio',tipo_apertura='$this->tipo_apertura',registrar='$this->registrar',consultar='$this->consultar',eliminar='$this->eliminar',actualizar='$this->actualizar',desactivar='$this->desactivar',visible='$this->visible' WHERE cod_vista_sistema='$this->cod_vista_sistema'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_vista_sistema) AS cod_vista_sistema FROM vista_sistema");
		$arreglo=$this->row();
		return $arreglo["cod_vista_sistema"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM vista_sistema");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM vista_sistema WHERE $campo='".$this->$campo."' AND estatus=1  ORDER BY posicion");
	}
	public function consulta_vista_sistema(){
		return parent::ejecutar("SELECT vista_sistema.*, servicio.nombre as nombre_servicio FROM vista_sistema INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio WHERE vista_sistema.cod_vista_sistema='$this->cod_vista_sistema' AND vista_sistema.estatus=1  ORDER BY vista_sistema.posicion");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM vista_sistema WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM vista_sistema WHERE $campo='".$this->$campo."'");
	}
	public function actualizar_posicion(){		
		return parent::ejecutar("UPDATE vista_sistema SET posicion='$this->posicion' WHERE cod_vista_sistema='$this->cod_vista_sistema'");
	}
	
	private function cargar_variables(){
		$row=$this->row();
		$this->cod_vista_sistema=$row['cod_vista_sistema'];
		$this->nombre=$row['nombre'];
		$this->descripcion=$row['descripcion'];
		$this->cod_servicio=$row['cod_servicio'];
		$this->posicion=$row['posicion'];
		$this->estatus=$row['estatus'];
		$this->tipo_apertura=$row['tipo_apertura'];
		$this->registrar=$row['registrar'];
		$this->consultar=$row['consultar'];
		$this->eliminar=$row['eliminar'];
		$this->actualizar=$row['actualizar'];
		$this->desactivar=$row['desactivar'];
		$this->nombre_servicio=$row['nombre_servicio'];
		$this->visible=$row['visible'];
		
	}
	
}
?>
