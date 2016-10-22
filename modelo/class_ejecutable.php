<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class ejecutable extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_ejecutable;
		public $md5sum;
		public $zipfile;
		public $descripcion;
		public $tipo;		
// CREAMOS LOS METODOS SET		
			public function set_cod_ejecutable($cod_ejecutable){
					$this->cod_ejecutable= $cod_ejecutable;
			}
		
			public function set_md5sum($md5sum){
					$this->md5sum= $md5sum;
			}
		
			public function set_zipfile($zipfile){
					if(is_uploaded_file($zipfile['tmp_name'])){
						$this->zipfile=addslashes(file_get_contents($zipfile['tmp_name']));
						$this->md5sum= MD5($zipfile['size']);
					}
			}
		
			public function set_descripcion($descripcion){
					$this->descripcion= $descripcion;
			}
		
			public function set_tipo($tipo){
					$this->tipo= $tipo;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO ejecutable (cod_ejecutable,md5sum,zipfile,descripcion,tipo,estatus) VALUES ('$this->cod_ejecutable','$this->md5sum','$this->zipfile','$this->descripcion','$this->tipo','1')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM ejecutable WHERE cod_ejecutable='$this->cod_ejecutable'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM ejecutable ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM ejecutable WHERE cod_ejecutable='$this->cod_ejecutable'");
	}
	public function modificar(){		
		if($this->zipfile){
			$modificar=",md5sum='$this->md5sum',zipfile='$this->zipfile'";
		}
		return parent::ejecutar("UPDATE ejecutable SET cod_ejecutable='$this->cod_ejecutable'".$modificar.",descripcion='$this->descripcion',tipo='$this->tipo' WHERE cod_ejecutable='$this->cod_ejecutable'");
	
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_ejecutable) AS cod_ejecutable FROM ejecutable");
		$arreglo=$this->row();
		return $arreglo["cod_ejecutable"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM ejecutable");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE ejecutable SET estatus=0 WHERE cod_ejecutable='$this->cod_ejecutable'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE ejecutable SET estatus=1 WHERE cod_ejecutable='$this->cod_ejecutable'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM ejecutable WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM ejecutable WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM ejecutable WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_ejecutable=$row['cod_ejecutable'];
		$this->md5sum=$row['md5sum'];
		$this->zipfile=$row['zipfile'];
		$this->descripcion=$row['descripcion'];
		$this->tipo=$row['tipo'];
		
	}
}
?>
