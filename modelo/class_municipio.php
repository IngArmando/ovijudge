<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("vista/campo/campo_estado.php");
// INSTANCIAMOS LA CLASE
class municipio extends campo_estado{
// CREAMOS LOS ATRIBUTOS
		public $cod_municipio;
		public $cod_estado;
		public $nombre;
		public $cod_vista_sistema;	
		public $nombre_estado;	
// CREAMOS LOS METODOS SET		
			public function set_cod_municipio($cod_municipio){
				
					$this->cod_municipio= $cod_municipio;
			}
		
			public function set_cod_estado($cod_estado){
					$this->cod_estado= $cod_estado;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_cod_vista_sistema($cod_vista_sistema){
					$this->cod_vista_sistema= $cod_vista_sistema;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO municipio (cod_municipio,cod_estado,nombre,estatus) VALUES ('$this->cod_municipio','$this->cod_estado','$this->nombre','1')");
	}
	public function consultar(){		
		
		$res=parent::ejecutar("SELECT pais.nombre as nombre_pais, pais.cod_pais, municipio.*, estado.nombre as nombre_estado FROM municipio 
		INNER JOIN estado ON estado.cod_estado=municipio.cod_estado
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais 
		WHERE cod_municipio='$this->cod_municipio'");
		
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT pais.nombre as nombre_pais, pais.cod_pais,municipio.*, estado.cod_estado, estado.nombre as nombre_estado FROM municipio 
		INNER JOIN estado ON estado.cod_estado=municipio.cod_estado
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais
		WHERE municipio.estatus=1");
	}
	public function listar_todo(){		
		return parent::ejecutar("SELECT pais.nombre as nombre_pais, pais.cod_pais,municipio.*, estado.nombre as nombre_estado FROM municipio 
		INNER JOIN estado ON estado.cod_estado=municipio.cod_estado
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais
		");
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE municipio SET estatus=0 WHERE cod_municipio='$this->cod_municipio'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE municipio SET estatus=1 WHERE cod_municipio='$this->cod_municipio'");
	}	
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM municipio WHERE cod_municipio='$this->cod_municipio'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE municipio SET cod_estado='$this->cod_estado',nombre='$this->nombre' WHERE cod_municipio='$this->cod_municipio'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_municipio) AS cod_municipio FROM municipio");
		$arreglo=$this->row();
		return $arreglo["cod_municipio"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM municipio");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		$res=parent::ejecutar("SELECT * FROM municipio WHERE $campo='".$this->$campo."'");
		$this->cargar_variables();
		return $res;
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM municipio WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM municipio WHERE $campo='".$this->$campo."'");
	}
	public function cargar_variables(){
		$row=$this->row();
		$this->cod_municipio=$row['cod_municipio'];
		$this->cod_pais=$row['cod_pais'];
		$this->nombre=$row['nombre'];
		$this->nombre_estado=$row['nombre_estado'];
		$this->cod_estado=$row['cod_estado'];
		$this->estatus=$row['estatus'];
		
	}
}
?>
