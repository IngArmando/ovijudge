<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_envio.php");
// INSTANCIAMOS LA CLASE
class problema_concurso extends envio{
// CREAMOS LOS ATRIBUTOS
		public $nombre_corto;
		public $puntos;
		public $permitir_envio;
		public $permitir_juez;
		public $color;
		public $lenta_eval_resultado;		
// CREAMOS LOS METODOS SET		
			public function set_cod_concurso($cod_concurso){
					$this->cod_concurso= $cod_concurso;
			}
		
			public function set_cod_problema($cod_problema){
					$this->cod_problema= $cod_problema;
			}
		
			public function set_nombre_corto($nombre_corto){
					$this->nombre_corto= $nombre_corto;
			}
		
			public function set_puntos($puntos){
					$this->puntos= $puntos;
			}
		
			public function set_permitir_envio($permitir_envio){
					$this->permitir_envio= $permitir_envio;
			}
		
			public function set_permitir_juez($permitir_juez){
					$this->permitir_juez= $permitir_juez;
			}
		
			public function set_color($color){
					$this->color= $color;
			}
		
			public function set_lenta_eval_resultado($lenta_eval_resultado){
					$this->lenta_eval_resultado= $lenta_eval_resultado;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO problema_concurso (cod_concurso,cod_problema,nombre_corto,puntos,permitir_envio,permitir_juez,color,lenta_eval_resultado) VALUES ('$this->cod_concurso','$this->cod_problema','$this->nombre_corto','$this->puntos','$this->permitir_envio','$this->permitir_juez','$this->color','$this->lenta_eval_resultado')");
	}
	public function consultar(){		
		$res=parent::ejecutar("	SELECT pc.*, p.* FROM problema_concurso pc
								INNER JOIN problema p USING(cod_problema)
								WHERE pc.cod_concurso='$this->cod_concurso'");
		$this->cargar_variables();
		return $res;
	}
	public function consultar_problemas_del_concurso(){
		return parent::ejecutar("SELECT problema.cod_problema as id, problema.nombre as name FROM problema_concurso INNER JOIN problema ON problema.cod_problema=problema_concurso.cod_problema WHERE problema_concurso.cod_concurso='$this->cod_concurso'");	
	}
	public function verificar_problema_concurso(){
			return parent::ejecutar("SELECT * FROM problema_concurso WHERE cod_concurso='$this->cod_concurso' AND cod_problema='$this->cod_problema'");	
	}
	public function consultar_problemas_del_concurso_detallado(){
		return parent::ejecutar("SELECT * FROM problema_concurso INNER JOIN problema ON problema.cod_problema=problema_concurso.cod_problema WHERE problema_concurso.cod_concurso='$this->cod_concurso'");	
	}

	public function listar(){		
		return parent::ejecutar("SELECT * FROM problema_concurso ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM problema_concurso WHERE cod_concurso='$this->cod_concurso'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE problema_concurso SET cod_concurso='$this->cod_concurso',cod_problema='$this->cod_problema',nombre_corto='$this->nombre_corto',puntos='$this->puntos',permitir_envio='$this->permitir_envio',permitir_juez='$this->permitir_juez',color='$this->color',lenta_eval_resultado='$this->lenta_eval_resultado' WHERE cod_concurso='$this->cod_concurso'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_concurso) AS cod_concurso FROM problema_concurso");
		$arreglo=$this->row();
		return $arreglo["cod_concurso"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM problema_concurso");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE problema_concurso SET estatus=0 WHERE cod_concurso='$this->cod_concurso'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE problema_concurso SET estatus=1 WHERE cod_concurso='$this->cod_concurso'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("	SELECT pc.*, problema.* FROM problema_concurso pc
									INNER JOIN problema USING(cod_problema)
									WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM problema_concurso WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM problema_concurso WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_concurso=$row['cod_concurso'];
		$this->cod_problema=$row['cod_problema'];
		$this->nombre_corto=$row['nombre_corto'];
		$this->puntos=$row['puntos'];
		$this->permitir_envio=$row['permitir_envio'];
		$this->permitir_juez=$row['permitir_juez'];
		$this->color=$row['color'];
		$this->lenta_eval_resultado=$row['lenta_eval_resultado'];
		
	}
}
?>
