<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_pais.php");
// INSTANCIAMOS LA CLASE
class estado extends pais{
// CREAMOS LOS ATRIBUTOS
		public $cod_estado;
		public $cod_pais;
		public $nombre;
		public $cod_vista_sistema;	
		public $nombre_pais;	
// CREAMOS LOS METODOS SET		
			public function set_cod_estado($cod_estado){
				
					$this->cod_estado= $cod_estado;
			}
		
			public function set_cod_pais($cod_pais){
					$this->cod_pais= $cod_pais;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_cod_vista_sistema($cod_vista_sistema){
					$this->cod_vista_sistema= $cod_vista_sistema;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO estado (cod_estado,cod_pais,nombre,estatus) VALUES ('$this->cod_estado','$this->cod_pais','$this->nombre','1')");
	}
	public function consultar(){		
		
		$res=parent::ejecutar("SELECT estado.*, pais.nombre as nombre_pais FROM estado 
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais 
		WHERE cod_estado='$this->cod_estado'");
		
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT estado.*, pais.nombre as nombre_pais FROM estado 
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais WHERE estado.estatus=1");
	}
	public function listar_estados(){		
		return parent::ejecutar("SELECT estado.*, pais.nombre as nombre_pais FROM estado 
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais WHERE estado.estatus=1");
	}
	public function listar_todo(){		
		return parent::ejecutar("SELECT estado.*, pais.nombre as nombre_pais FROM estado 
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais");
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE estado SET estatus=0 WHERE cod_estado='$this->cod_estado'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE estado SET estatus=1 WHERE cod_estado='$this->cod_estado'");
	}	
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM estado WHERE cod_estado='$this->cod_estado'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE estado SET cod_pais='$this->cod_pais',nombre='$this->nombre' WHERE cod_estado='$this->cod_estado'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_estado) AS cod_estado FROM estado");
		$arreglo=$this->row();
		return $arreglo["cod_estado"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM estado");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		$res=parent::ejecutar("SELECT * FROM estado WHERE $campo='".$this->$campo."'");
		$this->cargar_variables();
		return $res;
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM estado WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM estado WHERE $campo='".$this->$campo."'");
	}
	public function cargar_variables(){
		$row=$this->row();
		$this->cod_estado=$row['cod_estado'];
		
		$this->nombre=$row['nombre'];
		$this->nombre_pais=$row['nombre_pais'];
		$this->cod_pais=$row['cod_pais'];
		$this->estatus=$row['estatus'];
		
	}
}
?>
