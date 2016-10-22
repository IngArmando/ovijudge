<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class restriccion extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_restriccion;
		public $nombre;
		public $restricciones;		
// CREAMOS LOS METODOS SET		
			public function set_cod_restriccion($cod_restriccion){
					$this->cod_restriccion= $cod_restriccion;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_restricciones($restricciones){
					$this->restricciones= $restricciones;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO restriccion (cod_restriccion,nombre,restricciones) VALUES ('$this->cod_restriccion','$this->nombre','$this->restricciones')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM restriccion WHERE cod_restriccion='$this->cod_restriccion'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM restriccion ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM restriccion WHERE cod_restriccion='$this->cod_restriccion'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE restriccion SET cod_restriccion='$this->cod_restriccion',nombre='$this->nombre',restricciones='$this->restricciones' WHERE cod_restriccion='$this->cod_restriccion'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_restriccion) AS cod_restriccion FROM restriccion");
		$arreglo=$this->row();
		return $arreglo["cod_restriccion"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM restriccion");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE restriccion SET estatus=0 WHERE cod_restriccion='$this->cod_restriccion'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE restriccion SET estatus=1 WHERE cod_restriccion='$this->cod_restriccion'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM restriccion WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM restriccion WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM restriccion WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_restriccion=$row['cod_restriccion'];
		$this->nombre=$row['nombre'];
		$this->restricciones=$row['restricciones'];
		
	}
}
?>