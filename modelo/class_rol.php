<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class rol extends db{
// CREAMOS LOS ATRIBUTOS
		private $idrol;
		private $nombre;		
// CREAMOS LOS METODOS SET		
			public function set_idrol($idrol){
					$this->idrol= $idrol;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO rol (idrol,nombre) VALUES ('$this->idrol','$this->nombre')");
	}
	public function consultar(){		
		return parent::ejecutar("SELECT * FROM rol WHERE idrol='$this->idrol'");
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM rol ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM rol WHERE idrol='$this->idrol'");
	}
	public function editar(){		
		return parent::ejecutar("UPDATE rol SET idrol='$this->idrol',nombre='$this->nombre' WHERE idrol='$this->idrol'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(idrol) AS idrol FROM rol");
		$arreglo=$this->row();
		return $arreglo["idrol"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM rol");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM rol WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM rol WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM rol WHERE $campo='".$this->$campo."'");
	}
}
?>