<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class juzgar extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_juzgar;
		public $cod_concurso;
		public $cod_envio;
		public $tiempo_inicio;
		public $tiempo_fin;
		public $nombre_servidor;
		public $resultado;
		public $verificado;
		public $nombre_jurado;
		public $comentario;
		public $valido;
		public $salida_compilacion;
		public $visto_equipo;
		public $cod_rejuzgar;
		public $pre_cod_juzgar;		
// CREAMOS LOS METODOS SET		
			public function set_cod_juzgar($cod_juzgar){
					$this->cod_juzgar= $cod_juzgar;
			}
		
			public function set_cod_concurso($cod_concurso){
					$this->cod_concurso= $cod_concurso;
			}
		
			public function set_cod_envio($cod_envio){
					$this->cod_envio= $cod_envio;
			}
		
			public function set_tiempo_inicio($tiempo_inicio){
					$this->tiempo_inicio= $tiempo_inicio;
			}
		
			public function set_tiempo_fin($tiempo_fin){
					$this->tiempo_fin= $tiempo_fin;
			}
		
			public function set_nombre_servidor($nombre_servidor){
					$this->nombre_servidor= $nombre_servidor;
			}
		
			public function set_resultado($resultado){
					$this->resultado= $resultado;
			}
		
			public function set_verificado($verificado){
					$this->verificado= $verificado;
			}
		
			public function set_nombre_jurado($nombre_jurado){
					$this->nombre_jurado= $nombre_jurado;
			}
		
			public function set_comentario($comentario){
					$this->comentario= $comentario;
			}
		
			public function set_valido($valido){
					$this->valido= $valido;
			}
		
			public function set_salida_compilacion($salida_compilacion){
					$this->salida_compilacion= $salida_compilacion;
			}
		
			public function set_visto_equipo($visto_equipo){
					$this->visto_equipo= $visto_equipo;
			}
		
			public function set_cod_rejuzgar($cod_rejuzgar){
					$this->cod_rejuzgar= $cod_rejuzgar;
			}
		
			public function set_pre_cod_juzgar($pre_cod_juzgar){
					$this->pre_cod_juzgar= $pre_cod_juzgar;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO juzgar (cod_juzgar,cod_concurso,cod_envio,tiempo_inicio,tiempo_fin,nombre_servidor,resultado,verificado,nombre_jurado,comentario,valido,salida_compilacion,visto_equipo,cod_rejuzgar,pre_cod_juzgar) VALUES ('$this->cod_juzgar','$this->cod_concurso','$this->cod_envio','$this->tiempo_inicio','$this->tiempo_fin','$this->nombre_servidor','$this->resultado','$this->verificado','$this->nombre_jurado','$this->comentario','$this->valido','$this->salida_compilacion','$this->visto_equipo','$this->cod_rejuzgar','$this->pre_cod_juzgar')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM juzgar WHERE cod_juzgar='$this->cod_juzgar'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM juzgar ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM juzgar WHERE cod_juzgar='$this->cod_juzgar'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE juzgar SET cod_juzgar='$this->cod_juzgar',cod_concurso='$this->cod_concurso',cod_envio='$this->cod_envio',tiempo_inicio='$this->tiempo_inicio',tiempo_fin='$this->tiempo_fin',nombre_servidor='$this->nombre_servidor',resultado='$this->resultado',verificado='$this->verificado',nombre_jurado='$this->nombre_jurado',comentario='$this->comentario',valido='$this->valido',salida_compilacion='$this->salida_compilacion',visto_equipo='$this->visto_equipo',cod_rejuzgar='$this->cod_rejuzgar',pre_cod_juzgar='$this->pre_cod_juzgar' WHERE cod_juzgar='$this->cod_juzgar'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_juzgar) AS cod_juzgar FROM juzgar");
		$arreglo=$this->row();
		return $arreglo["cod_juzgar"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM juzgar");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE juzgar SET estatus=0 WHERE cod_juzgar='$this->cod_juzgar'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE juzgar SET estatus=1 WHERE cod_juzgar='$this->cod_juzgar'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM juzgar WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM juzgar WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM juzgar WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_juzgar=$row['cod_juzgar'];
		$this->cod_concurso=$row['cod_concurso'];
		$this->cod_envio=$row['cod_envio'];
		$this->tiempo_inicio=$row['tiempo_inicio'];
		$this->tiempo_fin=$row['tiempo_fin'];
		$this->nombre_servidor=$row['nombre_servidor'];
		$this->resultado=$row['resultado'];
		$this->verificado=$row['verificado'];
		$this->nombre_jurado=$row['nombre_jurado'];
		$this->comentario=$row['comentario'];
		$this->valido=$row['valido'];
		$this->salida_compilacion=$row['salida_compilacion'];
		$this->visto_equipo=$row['visto_equipo'];
		$this->cod_rejuzgar=$row['cod_rejuzgar'];
		$this->pre_cod_juzgar=$row['pre_cod_juzgar'];
		
	}
}
?>