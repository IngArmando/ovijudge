<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_municipio.php");
// INSTANCIAMOS LA CLASE
class parroquia extends municipio{
// CREAMOS LOS ATRIBUTOS
		public $cod_parroquia;
		public $cod_municipio;
		public $nombre;
		public $cod_vista_sistema;	
		public $nombre_municipio;	
// CREAMOS LOS METODOS SET		
			public function set_cod_parroquia($cod_parroquia){
				
					$this->cod_parroquia= $cod_parroquia;
			}
		
			public function set_cod_municipio($cod_municipio){
					$this->cod_municipio= $cod_municipio;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_cod_vista_sistema($cod_vista_sistema){
					$this->cod_vista_sistema= $cod_vista_sistema;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO parroquia (cod_parroquia,cod_municipio,nombre,estatus) VALUES ('$this->cod_parroquia','$this->cod_municipio','$this->nombre','1')");
	}
	public function consultar(){		
		
		$res=parent::ejecutar("SELECT pais.nombre as nombre_pais, pais.cod_pais,estado.cod_estado, parroquia.*, municipio.nombre as nombre_municipio FROM parroquia 
		INNER JOIN municipio ON municipio.cod_municipio=parroquia.cod_municipio 
		INNER JOIN estado ON estado.cod_estado=municipio.cod_estado
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais
		WHERE cod_parroquia='$this->cod_parroquia'");
		
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT pais.nombre as nombre_pais, pais.cod_pais,estado.cod_estado, parroquia.*, municipio.nombre as nombre_municipio FROM parroquia 
		INNER JOIN municipio ON municipio.cod_municipio=parroquia.cod_municipio
		INNER JOIN estado ON estado.cod_estado=municipio.cod_estado
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais
		WHERE parroquia.estatus=1");
	}
	public function listar_todo(){		
		return parent::ejecutar("SELECT pais.nombre as nombre_pais, pais.cod_pais,estado.cod_estado, estado.nombre as nombre_estado, parroquia.*, municipio.nombre as nombre_municipio FROM parroquia 
		INNER JOIN municipio ON municipio.cod_municipio=parroquia.cod_municipio
		INNER JOIN estado ON estado.cod_estado=municipio.cod_estado
		INNER JOIN pais ON pais.cod_pais=estado.cod_pais");
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE parroquia SET estatus=0 WHERE cod_parroquia='$this->cod_parroquia'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE parroquia SET estatus=1 WHERE cod_parroquia='$this->cod_parroquia'");
	}	
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM parroquia WHERE cod_parroquia='$this->cod_parroquia'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE parroquia SET cod_municipio='$this->cod_municipio',nombre='$this->nombre' WHERE cod_parroquia='$this->cod_parroquia'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_parroquia) AS cod_parroquia FROM parroquia");
		$arreglo=$this->row();
		return $arreglo["cod_parroquia"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM parroquia");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		$res=parent::ejecutar("SELECT * FROM parroquia WHERE $campo='".$this->$campo."'");
		$this->cargar_variables();
		return $res;
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM parroquia WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM parroquia WHERE $campo='".$this->$campo."'");
	}
	public function cargar_variables(){
		$row=$this->row();
		$this->cod_parroquia=$row['cod_parroquia'];
		$this->cod_pais=$row['cod_pais'];
		$this->nombre=$row['nombre'];
		$this->nombre_municipio=$row['nombre_municipio'];
		$this->cod_municipio=$row['cod_municipio'];
		$this->cod_estado=$row['cod_estado'];
		$this->estatus=$row['estatus'];
		
	}
}
?>
