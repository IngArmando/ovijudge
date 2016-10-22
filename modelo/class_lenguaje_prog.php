<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class lenguaje_prog extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_lenguaje_prog;
		public $nombre;
		public $extensiones;
		public $permitir_envio;
		public $permitir_juez;
		public $factor_tiempo;
		public $comando;		
// CREAMOS LOS METODOS SET		
			public function set_cod_lenguaje_prog($cod_lenguaje_prog){
					$this->cod_lenguaje_prog= $cod_lenguaje_prog;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_extensiones($extensiones){
					$this->extensiones= $extensiones;
			}

		
			public function set_factor_tiempo($factor_tiempo){
					$this->factor_tiempo= $factor_tiempo;
			}
		
			public function set_comando($comando){
					$this->comando= $comando;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO lenguaje_prog (nombre,extensiones,factor_tiempo,comando) VALUES ('$this->nombre','$this->extensiones','$this->factor_tiempo','$this->comando')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM lenguaje_prog WHERE cod_lenguaje_prog='$this->cod_lenguaje_prog'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM lenguaje_prog WHERE estatus='1'");
	}
	public function listar_admin(){		
		return parent::ejecutar("SELECT * FROM lenguaje_prog ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM lenguaje_prog WHERE cod_lenguaje_prog='$this->cod_lenguaje_prog'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE lenguaje_prog SET nombre='$this->nombre',extensiones='$this->extensiones',factor_tiempo='$this->factor_tiempo',comando='$this->comando' WHERE cod_lenguaje_prog='$this->cod_lenguaje_prog'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_lenguaje_prog) AS cod_lenguaje_prog FROM lenguaje_prog");
		$arreglo=$this->row();
		return $arreglo["cod_lenguaje_prog"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM lenguaje_prog");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE lenguaje_prog SET estatus=0 WHERE cod_lenguaje_prog='$this->cod_lenguaje_prog'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE lenguaje_prog SET estatus=1 WHERE cod_lenguaje_prog='$this->cod_lenguaje_prog'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM lenguaje_prog WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM lenguaje_prog WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM lenguaje_prog WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_lenguaje_prog=$row['cod_lenguaje_prog'];
		$this->nombre=$row['nombre'];
		$this->extensiones=$row['extensiones'];
		$this->factor_tiempo=$row['factor_tiempo'];
		$this->comando=$row['comando'];

	}
}
?>
