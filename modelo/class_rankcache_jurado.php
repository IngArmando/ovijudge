<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class rankcache_jurado extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_concurso;
		public $cod_equipo;
		public $puntos;
		public $total_tiempo;		
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
		
			public function set_total_tiempo($total_tiempo){
					$this->total_tiempo= $total_tiempo;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO rankcache_jurado (cod_concurso,cod_equipo,puntos,total_tiempo) VALUES ('$this->cod_concurso','$this->cod_equipo','$this->puntos','$this->total_tiempo')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM rankcache_jurado WHERE cod_concurso='$this->cod_concurso'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM rankcache_jurado ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM rankcache_jurado WHERE cod_concurso='$this->cod_concurso'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE rankcache_jurado SET cod_concurso='$this->cod_concurso',cod_equipo='$this->cod_equipo',puntos='$this->puntos',total_tiempo='$this->total_tiempo' WHERE cod_concurso='$this->cod_concurso'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_concurso) AS cod_concurso FROM rankcache_jurado");
		$arreglo=$this->row();
		return $arreglo["cod_concurso"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM rankcache_jurado");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE rankcache_jurado SET estatus=0 WHERE cod_concurso='$this->cod_concurso'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE rankcache_jurado SET estatus=1 WHERE cod_concurso='$this->cod_concurso'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM rankcache_jurado WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM rankcache_jurado WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM rankcache_jurado WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_concurso=$row['cod_concurso'];
		$this->cod_equipo=$row['cod_equipo'];
		$this->puntos=$row['puntos'];
		$this->total_tiempo=$row['total_tiempo'];
		
	}
}
?>