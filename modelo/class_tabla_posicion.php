<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class tabla_posicion extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_tabla_posicion;
		public $cod_equipo;
		public $cod_concurso;
		public $puntaje;
		public $tiempo;	
// CREAMOS LOS METODOS SET		
			public function set_cod_tabla_posicion($cod_tabla_posicion){
				
					$this->cod_tabla_posicion= $cod_tabla_posicion;
			}
		
			public function set_cod_equipo($cod_equipo){
					$this->cod_equipo= $cod_equipo;
			}
		
			public function set_cod_concurso($cod_concurso){
					$this->cod_concurso= $cod_concurso;
			}
		
			public function set_puntaje($puntaje){
					$this->puntaje= $puntaje;
			}
			public function set_tiempo($tiempo){
					$this->tiempo= $tiempo;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO tabla_posicion (cod_equipo,cod_concurso,puntaje) VALUES ('$this->cod_equipo','$this->cod_concurso','$this->puntaje')");
	}

	public function listar_posiciones(){		
		return parent::ejecutar("SELECT equipo.cod_equipo, equipo.nombre, SUM(puntaje) as puntaje  FROM tabla_posicion 
		INNER JOIN equipo USING (cod_equipo)
		GROUP BY cod_equipo ORDER BY puntaje desc");
	}
	public function puntaje_individual_equipo(){		
		return parent::ejecutar("SELECT equipo.cod_equipo, equipo.nombre, SUM(puntaje) as puntaje  FROM tabla_posicion 
		INNER JOIN equipo USING (cod_equipo)
		WHERE cod_equipo='$this->cod_equipo'
		GROUP BY cod_equipo ORDER BY puntaje desc");
	}
	public function ultimo_id_concurso(){
		parent::ejecutar("SELECT MAX(cod_concurso) AS cod_concurso FROM tabla_posicion");
		$arreglo=$this->row();
		return $arreglo["cod_concurso"];
	}
	public function nuevo(){
		parent::ejecutar("SELECT MAX(cod_concurso) AS cod_concurso FROM tabla_posicion");
		$a=$this->row();
		parent::ejecutar("SELECT MAX(cod_concurso) AS cod_concurso FROM concurso");
		$b=$this->row();
		if($a['cod_concurso']!=$b['cod_concurso'])
			return $b['cod_concurso'];
	}
}
?>
