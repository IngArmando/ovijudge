<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class modulo extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_modulo;
		public $nombre;		
// CREAMOS LOS METODOS SET		
			public function set_cod_modulo($cod_modulo){
					$this->cod_modulo= $cod_modulo;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO modulo (cod_modulo,nombre,estatus) VALUES ('$this->cod_modulo','$this->nombre','1')");

	}

	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM modulo WHERE cod_modulo='$this->cod_modulo'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM modulo WHERE estatus=1");
	}
	public function listar_modulo(){		
		return parent::ejecutar("SELECT * FROM modulo WHERE estatus=1");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM modulo WHERE cod_modulo='$this->cod_modulo'");
	}
	public function listar_todo(){		
		return parent::ejecutar("SELECT * FROM modulo");
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE modulo SET estatus=0 WHERE cod_modulo='$this->cod_modulo'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE modulo SET estatus=1 WHERE cod_modulo='$this->cod_modulo'");
	}	
	public function modificar(){		
		return parent::ejecutar("UPDATE modulo SET cod_modulo='$this->cod_modulo',nombre='$this->nombre' WHERE cod_modulo='$this->cod_modulo'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_modulo) AS cod_modulo FROM modulo");
		$arreglo=$this->row();
		return $arreglo["cod_modulo"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM modulo");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM modulo WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM modulo WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM modulo WHERE $campo='".$this->$campo."'");
	}
	
	
	private function cargar_variables(){
		$row=$this->row();
		$this->cod_modulo=$row['cod_modulo'];
		$this->nombre=$row['nombre'];
		
	}
}
?>
