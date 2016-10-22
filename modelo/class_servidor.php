<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class servidor extends db{
// CREAMOS LOS ATRIBUTOS
		public $nombre_servidor;
		public $active;
		public $polltime;
		public $cod_restriccion;		
// CREAMOS LOS METODOS SET		
			public function set_nombre_servidor($nombre_servidor){
					$this->nombre_servidor= $nombre_servidor;
			}
		
			public function set_active($active){
					$this->active= $active;
			}
		
			public function set_polltime($polltime){
					$this->polltime= $polltime;
			}
		
			public function set_cod_restriccion($cod_restriccion){
					$this->cod_restriccion= $cod_restriccion;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO servidor (nombre_servidor,active,polltime,cod_restriccion) VALUES ('$this->nombre_servidor','$this->active','$this->polltime','$this->cod_restriccion')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM servidor WHERE nombre_servidor='$this->nombre_servidor'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM servidor ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM servidor WHERE nombre_servidor='$this->nombre_servidor'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE servidor SET nombre_servidor='$this->nombre_servidor',active='$this->active',polltime='$this->polltime',cod_restriccion='$this->cod_restriccion' WHERE nombre_servidor='$this->nombre_servidor'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(nombre_servidor) AS nombre_servidor FROM servidor");
		$arreglo=$this->row();
		return $arreglo["nombre_servidor"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM servidor");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE servidor SET estatus=0 WHERE nombre_servidor='$this->nombre_servidor'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE servidor SET estatus=1 WHERE nombre_servidor='$this->nombre_servidor'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM servidor WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM servidor WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM servidor WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->nombre_servidor=$row['nombre_servidor'];
		$this->active=$row['active'];
		$this->polltime=$row['polltime'];
		$this->cod_restriccion=$row['cod_restriccion'];
		
	}
}
?>