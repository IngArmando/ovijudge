<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("vista/campo/campo_estado.php");
// INSTANCIAMOS LA CLASE
class institucion extends campo_estado{
// CREAMOS LOS ATRIBUTOS
		public $cod_institucion;
		public $nombre_corto;
		public $nombre;
		public $cod_pais;
		public $descripcion;		
// CREAMOS LOS METODOS SET		
			public function set_cod_institucion($cod_institucion){
					$this->cod_institucion= filter_var($cod_institucion,FILTER_SANITIZE_NUMBER_INT);
			}
		
			public function set_nombre_corto($nombre_corto){
					$this->nombre_corto= $this->mysqli->real_escape_string($nombre_corto);
			}
		
			public function set_nombre($nombre){
					$this->nombre= $this->mysqli->real_escape_string($nombre);
			}
		
			public function set_cod_pais($cod_pais){
					$this->cod_pais= $this->mysqli->real_escape_string($cod_pais);
			}
		
			public function set_descripcion($descripcion){
					$this->descripcion= $this->mysqli->real_escape_string($descripcion);
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO institucion (nombre_corto,nombre,cod_pais,descripcion,estatus) VALUES ('$this->nombre_corto','$this->nombre','$this->cod_pais','$this->descripcion','1')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT pais.nombre as nombre_pais, institucion.* FROM institucion
		INNER JOIN pais ON pais.cod_pais=institucion.cod_pais
		WHERE institucion.cod_institucion='$this->cod_institucion'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT pais.nombre as nombre_pais, institucion.* FROM institucion
		INNER JOIN pais ON pais.cod_pais=institucion.cod_pais
		WHERE institucion.estatus=1
		ORDER BY institucion.nombre");
	}
	public function listar_admin(){		
		return parent::ejecutar("SELECT pais.nombre as nombre_pais, institucion.* FROM institucion
		INNER JOIN pais ON pais.cod_pais=institucion.cod_pais ORDER BY institucion.nombre");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM institucion WHERE cod_institucion='$this->cod_institucion'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE institucion SET cod_institucion='$this->cod_institucion',nombre_corto='$this->nombre_corto',nombre='$this->nombre',cod_pais='$this->cod_pais',descripcion='$this->descripcion' WHERE cod_institucion='$this->cod_institucion'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_institucion) AS cod_institucion FROM institucion");
		$arreglo=$this->row();
		return $arreglo["cod_institucion"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM institucion");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE institucion SET estatus=0 WHERE cod_institucion='$this->cod_institucion'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE institucion SET estatus=1 WHERE cod_institucion='$this->cod_institucion'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM institucion WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM institucion WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM institucion WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_institucion	=$row['cod_institucion'];
		$this->nombre_corto		=htmlentities($row['nombre_corto']);
		$this->nombre			=htmlentities($row['nombre']);
		$this->cod_pais			=$row['cod_pais'];
		$this->descripcion		=htmlentities($row['descripcion']);
		$this->nombre_pais		=htmlentities($row['nombre_pais']);
		
	}
}
?>
