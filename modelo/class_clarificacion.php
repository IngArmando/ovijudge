<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class clarificacion extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_clarificacion;
		public $cod_concurso;
		public $resp_cod_clarificacion;
		public $tiempo_envio;
		public $remitiente;
		public $receptor;
		public $nombre_jurado;
		public $cod_problema;
		public $categoria;
		public $cuerpo_msj;
		public $respuesta;		
// CREAMOS LOS METODOS SET		
			public function set_cod_clarificacion($cod_clarificacion){
					$this->cod_clarificacion= $cod_clarificacion;
			}
		
			public function set_cod_concurso($cod_concurso){
					$this->cod_concurso= $cod_concurso;
			}
		
			public function set_resp_cod_clarificacion($resp_cod_clarificacion){
					$this->resp_cod_clarificacion= $resp_cod_clarificacion;
			}
		
			public function set_tiempo_envio($tiempo_envio){
					$this->tiempo_envio= $tiempo_envio;
			}
		
			public function set_remitiente($remitiente){
					$this->remitiente= $remitiente;
			}
		
			public function set_receptor($receptor){
					$this->receptor= $receptor;
			}
		
			public function set_nombre_jurado($nombre_jurado){
					$this->nombre_jurado= $nombre_jurado;
			}
		
			public function set_cod_problema($cod_problema){
					$this->cod_problema= $cod_problema;
			}
		
			public function set_categoria($categoria){
					$this->categoria= $categoria;
			}
		
			public function set_cuerpo_msj($cuerpo_msj){
					$this->cuerpo_msj= $cuerpo_msj;
			}
		
			public function set_respuesta($respuesta){
					$this->respuesta= $respuesta;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO clarificacion (cod_clarificacion,cod_concurso,resp_cod_clarificacion,tiempo_envio,remitiente,receptor,nombre_jurado,cod_problema,categoria,cuerpo_msj,respuesta) VALUES ('$this->cod_clarificacion','$this->cod_concurso','$this->resp_cod_clarificacion','$this->tiempo_envio','$this->remitiente','$this->receptor','$this->nombre_jurado','$this->cod_problema','$this->categoria','$this->cuerpo_msj','$this->respuesta')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM clarificacion WHERE cod_clarificacion='$this->cod_clarificacion'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM clarificacion ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM clarificacion WHERE cod_clarificacion='$this->cod_clarificacion'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE clarificacion SET cod_clarificacion='$this->cod_clarificacion',cod_concurso='$this->cod_concurso',resp_cod_clarificacion='$this->resp_cod_clarificacion',tiempo_envio='$this->tiempo_envio',remitiente='$this->remitiente',receptor='$this->receptor',nombre_jurado='$this->nombre_jurado',cod_problema='$this->cod_problema',categoria='$this->categoria',cuerpo_msj='$this->cuerpo_msj',respuesta='$this->respuesta' WHERE cod_clarificacion='$this->cod_clarificacion'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_clarificacion) AS cod_clarificacion FROM clarificacion");
		$arreglo=$this->row();
		return $arreglo["cod_clarificacion"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM clarificacion");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE clarificacion SET estatus=0 WHERE cod_clarificacion='$this->cod_clarificacion'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE clarificacion SET estatus=1 WHERE cod_clarificacion='$this->cod_clarificacion'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM clarificacion WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM clarificacion WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM clarificacion WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_clarificacion=$row['cod_clarificacion'];
		$this->cod_concurso=$row['cod_concurso'];
		$this->resp_cod_clarificacion=$row['resp_cod_clarificacion'];
		$this->tiempo_envio=$row['tiempo_envio'];
		$this->remitiente=$row['remitiente'];
		$this->receptor=$row['receptor'];
		$this->nombre_jurado=$row['nombre_jurado'];
		$this->cod_problema=$row['cod_problema'];
		$this->categoria=$row['categoria'];
		$this->cuerpo_msj=$row['cuerpo_msj'];
		$this->respuesta=$row['respuesta'];
		
	}
}
?>