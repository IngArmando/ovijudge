<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class pais extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_pais;
		public $nombre;		
// CREAMOS LOS METODOS SET		
			public function set_cod_pais($cod_pais){
					$this->cod_pais= $cod_pais;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO pais (cod_pais,nombre,estatus) VALUES ('$this->cod_pais','$this->nombre','1')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM pais WHERE cod_pais='$this->cod_pais'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM pais WHERE estatus=1");
	}
	public function listar_paises(){		
		return parent::ejecutar("SELECT * FROM pais WHERE estatus=1");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM pais WHERE cod_pais='$this->cod_pais'");
	}
	public function listar_todo(){		
		return parent::ejecutar("SELECT * FROM pais");
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE pais SET estatus=0 WHERE cod_pais='$this->cod_pais'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE pais SET estatus=1 WHERE cod_pais='$this->cod_pais'");
	}	
	public function modificar(){		
		return parent::ejecutar("UPDATE pais SET cod_pais='$this->cod_pais',nombre='$this->nombre' WHERE cod_pais='$this->cod_pais'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_pais) AS cod_pais FROM pais");
		$arreglo=$this->row();
		return $arreglo["cod_pais"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM pais");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM pais WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM pais WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM pais WHERE $campo='".$this->$campo."'");
	}
	
	
	private function cargar_variables(){
		$row=$this->row();
		$this->cod_pais=$row['cod_pais'];
		$this->nombre=$row['nombre'];
		
	}
}
?>
