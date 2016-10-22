<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class rankcache_publico extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_concurso;
		public $cod_equipo;
		public $puntos;
		public $tiempo_total;		
// CREAMOS LOS METODOS SET		
			public function set_cod_concurso($cod_concurso){
					$this->cod_concurso= $cod_concurso;
			}
		
			public function set_cod_equipo($cod_equipo){
					$this->cod_equipo= $cod_equipo;
			}
		
			public function set_puntos($puntos){
					$this->puntos= $puntos;
			}
		
			public function set_tiempo_total($tiempo_total){
					$this->tiempo_total= $tiempo_total;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO rankcache_publico (cod_concurso,cod_equipo,puntos,tiempo_total) VALUES ('$this->cod_concurso','$this->cod_equipo','$this->puntos','$this->tiempo_total')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM rankcache_publico WHERE cod_concurso='$this->cod_concurso'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM rankcache_publico ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM rankcache_publico WHERE cod_concurso='$this->cod_concurso'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE rankcache_publico SET cod_concurso='$this->cod_concurso',cod_equipo='$this->cod_equipo',puntos='$this->puntos',tiempo_total='$this->tiempo_total' WHERE cod_concurso='$this->cod_concurso'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_concurso) AS cod_concurso FROM rankcache_publico");
		$arreglo=$this->row();
		return $arreglo["cod_concurso"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM rankcache_publico");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE rankcache_publico SET estatus=0 WHERE cod_concurso='$this->cod_concurso'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE rankcache_publico SET estatus=1 WHERE cod_concurso='$this->cod_concurso'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM rankcache_publico WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM rankcache_publico WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM rankcache_publico WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_concurso=$row['cod_concurso'];
		$this->cod_equipo=$row['cod_equipo'];
		$this->puntos=$row['puntos'];
		$this->tiempo_total=$row['tiempo_total'];
		
	}
}
?>