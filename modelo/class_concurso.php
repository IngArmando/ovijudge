<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
@include_once("modelo/class_problema.php");
// INSTANCIAMOS LA CLASE
class concurso extends problema{
// CREAMOS LOS ATRIBUTOS
		public $cod_concurso;
		public $nombre;
		public $nombre_corto;
		public $tiempo_activo;
		public $tiempo_inicio;
		public $tiempo_conjelacion;
		public $tiempo_final;
		public $tiempo_desconjelar;
		public $tiempo_inactivo;
		public $tiempo_activo_string;
		public $tiempo_inicio_string;
		public $tiempo_conjelacion_string;
		public $tiempo_final_string;
		public $tiempo_desconjelar_string;
		public $tiempo_inactivo_string;
		public $estatus;
		public $globo_procesado;
		public $publico;		
// CREAMOS LOS METODOS SET		
			public function set_cod_concurso($cod_concurso){
					$this->cod_concurso= filter_var($cod_concurso,FILTER_SANITIZE_NUMBER_INT);
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_nombre_corto($nombre_corto){
					$this->nombre_corto= $nombre_corto;
			}
		
			public function set_tiempo_activo($tiempo_activo){
					$this->tiempo_activo= date('Y-m-d H:i:s', strtotime($tiempo_activo));
			}
		
			public function set_tiempo_inicio($tiempo_inicio){
					$this->tiempo_inicio= date('Y-m-d H:i:s', strtotime($tiempo_inicio));
			}
		
			public function set_tiempo_conjelacion($tiempo_conjelacion){
					$this->tiempo_conjelacion= date('Y-m-d H:i:s', strtotime($tiempo_conjelacion));
			}
		
			public function set_tiempo_final($tiempo_final){
					$this->tiempo_final= date('Y-m-d H:i:s', strtotime($tiempo_final));
			}
		
			public function set_tiempo_desconjelar($tiempo_desconjelar){
					$this->tiempo_desconjelar=date('Y-m-d H:i:s', strtotime($tiempo_desconjelar));
			}
		
			public function set_tiempo_inactivo($tiempo_inactivo){
					$this->tiempo_inactivo= date('Y-m-d H:i:s', strtotime($tiempo_inactivo));
			}
		
			public function set_tiempo_activo_string($tiempo_activo_string){
					$this->tiempo_activo_string= $tiempo_activo_string;
			}
		
			public function set_tiempo_inicio_string($tiempo_inicio_string){
					$this->tiempo_inicio_string= $tiempo_inicio_string;
			}
		
			public function set_tiempo_conjelacion_string($tiempo_conjelacion_string){
					$this->tiempo_conjelacion_string= $tiempo_conjelacion_string;
			}
		
			public function set_tiempo_final_string($tiempo_final_string){
					$this->tiempo_final_string= $tiempo_final_string;
			}
		
			public function set_tiempo_desconjelar_string($tiempo_desconjelar_string){
					$this->tiempo_desconjelar_string= $tiempo_desconjelar_string;
			}
		
			public function set_tiempo_inactivo_string($tiempo_inactivo_string){
					$this->tiempo_inactivo_string= $tiempo_inactivo_string;
			}
		
			public function set_estatus($estatus){
					$this->estatus= $estatus;
			}
		
			public function set_globo_procesado($globo_procesado){
					$this->globo_procesado= $globo_procesado;
			}
		
			public function set_publico($publico){
					$this->publico= $publico;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO concurso (cod_concurso,nombre,nombre_corto,tiempo_activo,tiempo_inicio,tiempo_conjelacion,tiempo_final,tiempo_desconjelar,tiempo_inactivo,tiempo_activo_string,tiempo_inicio_string,tiempo_conjelacion_string,tiempo_final_string,tiempo_desconjelar_string,tiempo_inactivo_string,globo_procesado,publico,cod_usuario_reg) VALUES ('$this->cod_concurso','$this->nombre','$this->nombre_corto','$this->tiempo_activo','$this->tiempo_inicio','$this->tiempo_conjelacion','$this->tiempo_final','$this->tiempo_desconjelar','$this->tiempo_inactivo','$this->tiempo_activo_string','$this->tiempo_inicio_string','$this->tiempo_conjelacion_string','$this->tiempo_final_string','$this->tiempo_desconjelar_string','$this->tiempo_inactivo_string','$this->globo_procesado','$this->publico','".$_SESSION['cod_usuario']."')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT *, DATE_FORMAT(tiempo_activo,'%d-%m-%Y %h:%i %p') as tiempo_activo, DATE_FORMAT(tiempo_inicio,'%d-%m-%Y %h:%i %p') as tiempo_inicio, DATE_FORMAT(tiempo_conjelacion,'%d-%m-%Y %h:%i %p') as tiempo_conjelacion, DATE_FORMAT(tiempo_final,'%d-%m-%Y %h:%i %p') as tiempo_final, DATE_FORMAT(tiempo_desconjelar,'%d-%m-%Y %h:%i %p') as tiempo_desconjelar, DATE_FORMAT(tiempo_inactivo,'%d-%m-%Y %h:%i %p') as tiempo_inactivo FROM concurso WHERE cod_concurso='$this->cod_concurso'");
		$this->cargar_variables();
		return $res;
	}
	public function consultar_concurso(){		
		parent::ejecutar("SELECT *, DATE_FORMAT(tiempo_activo,'%d-%m-%Y %h:%i %p') as tiempo_activo, DATE_FORMAT(tiempo_inicio,'%d-%m-%Y %h:%i %p') as tiempo_inicio, DATE_FORMAT(tiempo_conjelacion,'%d-%m-%Y %h:%i %p') as tiempo_conjelacion, DATE_FORMAT(tiempo_final,'%d-%m-%Y %h:%i %p') as tiempo_final, DATE_FORMAT(tiempo_desconjelar,'%d-%m-%Y %h:%i %p') as tiempo_desconjelar, DATE_FORMAT(tiempo_inactivo,'%d-%m-%Y %h:%i %p') as tiempo_inactivo FROM concurso WHERE cod_concurso='$this->cod_concurso'");
		$this->cargar_variables();
		return $res;
	}
	public function consulta_tiempo_inicio_final_concurso(){
		parent::ejecutar("SELECT *, DATE_FORMAT(tiempo_activo,'%d-%m-%Y %h:%i %p') as tiempo_activo, DATE_FORMAT(tiempo_inicio,'%d-%m-%Y %h:%i %p') as tiempo_inicio, DATE_FORMAT(tiempo_conjelacion,'%d-%m-%Y %h:%i %p') as tiempo_conjelacion, DATE_FORMAT(tiempo_final,'%d-%m-%Y %h:%i %p') as tiempo_final, DATE_FORMAT(tiempo_desconjelar,'%d-%m-%Y %h:%i %p') as tiempo_desconjelar, DATE_FORMAT(tiempo_inactivo,'%d-%m-%Y %h:%i %p') as tiempo_inactivo FROM concurso WHERE cod_concurso='$this->cod_concurso'");
		$row=$this->row();
		return $row;
	}
	public function concurso_activo(){
		parent::ejecutar("SELECT tiempo_final FROM concurso WHERE cod_concurso='$this->cod_concurso'");
		$row=$this->row();
		if(strtotime($row['tiempo_final'])>time()){
				return true;
		}else{
				return false;
		}
	}
	public function listar(){		
		return parent::ejecutar("SELECT *, DATE_FORMAT(tiempo_activo,'%d-%m-%Y %h:%i %p') as tiempo_activo, DATE_FORMAT(tiempo_inicio,'%d-%m-%Y %h:%i %p') as tiempo_inicio, DATE_FORMAT(tiempo_conjelacion,'%d-%m-%Y %h:%i %p') as tiempo_conjelacion, DATE_FORMAT(tiempo_final,'%d-%m-%Y %h:%i %p') as tiempo_final, DATE_FORMAT(tiempo_desconjelar,'%d-%m-%Y %h:%i %p') as tiempo_desconjelar, DATE_FORMAT(tiempo_inactivo,'%d-%m-%Y %h:%i %p') as tiempo_inactivo FROM concurso ORDER BY cod_concurso DESC");
	}
	public function ultimos_concursos(){		
		return parent::ejecutar("SELECT *, DATE_FORMAT(tiempo_activo,'%d-%m-%Y %h:%i %p') as tiempo_activo, DATE_FORMAT(tiempo_inicio,'%d-%m-%Y %h:%i %p') as tiempo_inicio, DATE_FORMAT(tiempo_conjelacion,'%d-%m-%Y %h:%i %p') as tiempo_conjelacion, DATE_FORMAT(tiempo_final,'%d-%m-%Y %h:%i %p') as tiempo_final, DATE_FORMAT(tiempo_desconjelar,'%d-%m-%Y %h:%i %p') as tiempo_desconjelar, DATE_FORMAT(tiempo_inactivo,'%d-%m-%Y %h:%i %p') as tiempo_inactivo FROM concurso ORDER BY cod_concurso DESC");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM concurso WHERE cod_concurso='$this->cod_concurso'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE concurso SET nombre='$this->nombre',nombre_corto='$this->nombre_corto',tiempo_activo='$this->tiempo_activo',tiempo_inicio='$this->tiempo_inicio',tiempo_conjelacion='$this->tiempo_conjelacion',tiempo_final='$this->tiempo_final',tiempo_desconjelar='$this->tiempo_desconjelar',tiempo_inactivo='$this->tiempo_inactivo',globo_procesado='$this->globo_procesado',publico='$this->publico' WHERE cod_concurso='$this->cod_concurso'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_concurso) AS cod_concurso FROM concurso");
		$arreglo=$this->row();
		return $arreglo["cod_concurso"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM concurso");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE concurso SET estatus=0 WHERE cod_concurso='$this->cod_concurso'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE concurso SET estatus=1 WHERE cod_concurso='$this->cod_concurso'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM concurso WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM concurso WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM concurso WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_concurso=$row['cod_concurso'];
		$this->nombre=$row['nombre'];
		$this->nombre_corto=$row['nombre_corto'];
			
		$this->tiempo_activo=$row['tiempo_activo'];
		$this->tiempo_inicio=$row['tiempo_inicio'];
		$this->tiempo_conjelacion=$row['tiempo_conjelacion'];
		$this->tiempo_final=$row['tiempo_final'];
		$this->tiempo_desconjelar=$row['tiempo_desconjelar'];
		$this->tiempo_inactivo=$row['tiempo_inactivo'];
		$this->tiempo_activo_string=$row['tiempo_activo_string'];
		$this->tiempo_inicio_string=$row['tiempo_inicio_string'];
		$this->tiempo_conjelacion_string=$row['tiempo_conjelacion_string'];
		$this->tiempo_final_string=$row['tiempo_final_string'];
		$this->tiempo_desconjelar_string=$row['tiempo_desconjelar_string'];
		$this->tiempo_inactivo_string=$row['tiempo_inactivo_string'];
		$this->estatus=$row['estatus'];
		$this->globo_procesado=$row['globo_procesado'];
		$this->publico=$row['publico'];
		
	}
}
?>
