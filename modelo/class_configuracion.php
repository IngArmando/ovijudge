<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class configuracion extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_configuracion;
		public $nombre;
		public $valor;
		public $tipo;
		public $descripcion;		
// CREAMOS LOS METODOS SET		
			public function set_cod_configuracion($cod_configuracion){
					$this->cod_configuracion= $cod_configuracion;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_valor($valor){
					$this->valor= $valor;
			}
		
			public function set_tipo($tipo){
					$this->tipo= $tipo;
			}
		
			public function set_descripcion($descripcion){
					$this->descripcion= $descripcion;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO configuracion (cod_configuracion,nombre,valor,tipo,descripcion) VALUES ('$this->cod_configuracion','$this->nombre','$this->valor','$this->tipo','$this->descripcion')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM configuracion WHERE cod_configuracion='$this->cod_configuracion'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM configuracion ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM configuracion WHERE cod_configuracion='$this->cod_configuracion'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE configuracion SET cod_configuracion='$this->cod_configuracion',nombre='$this->nombre',valor='$this->valor',tipo='$this->tipo',descripcion='$this->descripcion' WHERE cod_configuracion='$this->cod_configuracion'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_configuracion) AS cod_configuracion FROM configuracion");
		$arreglo=$this->row();
		return $arreglo["cod_configuracion"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM configuracion");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE configuracion SET estatus=0 WHERE cod_configuracion='$this->cod_configuracion'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE configuracion SET estatus=1 WHERE cod_configuracion='$this->cod_configuracion'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM configuracion WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM configuracion WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM configuracion WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_configuracion=$row['cod_configuracion'];
		$this->nombre=$row['nombre'];
		$this->valor=$row['valor'];
		$this->tipo=$row['tipo'];
		$this->descripcion=$row['descripcion'];
		
	}
}
?>