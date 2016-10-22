<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class evento extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_evento;
		public $tiempo;
		public $cod_concurso;
		public $cod_clarificacion;
		public $cod_lenguaje_prog;
		public $cod_problema;
		public $cod_envio;
		public $cod_juzgar;
		public $cod_equipo;
		public $descripcion;		
// CREAMOS LOS METODOS SET		
			public function set_cod_evento($cod_evento){
					$this->cod_evento= $cod_evento;
			}
		
			public function set_tiempo($tiempo){
					$this->tiempo= $tiempo;
			}
		
			public function set_cod_concurso($cod_concurso){
					$this->cod_concurso= $cod_concurso;
			}
		
			public function set_cod_clarificacion($cod_clarificacion){
					$this->cod_clarificacion= $cod_clarificacion;
			}
		
			public function set_cod_lenguaje_prog($cod_lenguaje_prog){
					$this->cod_lenguaje_prog= $cod_lenguaje_prog;
			}
		
			public function set_cod_problema($cod_problema){
					$this->cod_problema= $cod_problema;
			}
		
			public function set_cod_envio($cod_envio){
					$this->cod_envio= $cod_envio;
			}
		
			public function set_cod_juzgar($cod_juzgar){
					$this->cod_juzgar= $cod_juzgar;
			}
		
			public function set_cod_equipo($cod_equipo){
					$this->cod_equipo= $cod_equipo;
			}
		
			public function set_descripcion($descripcion){
					$this->descripcion= $descripcion;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO evento (cod_evento,tiempo,cod_concurso,cod_clarificacion,cod_lenguaje_prog,cod_problema,cod_envio,cod_juzgar,cod_equipo,descripcion) VALUES ('$this->cod_evento','$this->tiempo','$this->cod_concurso','$this->cod_clarificacion','$this->cod_lenguaje_prog','$this->cod_problema','$this->cod_envio','$this->cod_juzgar','$this->cod_equipo','$this->descripcion')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM evento WHERE cod_evento='$this->cod_evento'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM evento ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM evento WHERE cod_evento='$this->cod_evento'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE evento SET cod_evento='$this->cod_evento',tiempo='$this->tiempo',cod_concurso='$this->cod_concurso',cod_clarificacion='$this->cod_clarificacion',cod_lenguaje_prog='$this->cod_lenguaje_prog',cod_problema='$this->cod_problema',cod_envio='$this->cod_envio',cod_juzgar='$this->cod_juzgar',cod_equipo='$this->cod_equipo',descripcion='$this->descripcion' WHERE cod_evento='$this->cod_evento'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_evento) AS cod_evento FROM evento");
		$arreglo=$this->row();
		return $arreglo["cod_evento"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM evento");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE evento SET estatus=0 WHERE cod_evento='$this->cod_evento'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE evento SET estatus=1 WHERE cod_evento='$this->cod_evento'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM evento WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM evento WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM evento WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_evento=$row['cod_evento'];
		$this->tiempo=$row['tiempo'];
		$this->cod_concurso=$row['cod_concurso'];
		$this->cod_clarificacion=$row['cod_clarificacion'];
		$this->cod_lenguaje_prog=$row['cod_lenguaje_prog'];
		$this->cod_problema=$row['cod_problema'];
		$this->cod_envio=$row['cod_envio'];
		$this->cod_juzgar=$row['cod_juzgar'];
		$this->cod_equipo=$row['cod_equipo'];
		$this->descripcion=$row['descripcion'];
		
	}
}
?>