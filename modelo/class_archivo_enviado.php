<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class archivo_enviado extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_archivo_enviado;
		public $cod_envio;
		public $codigo_fuente;
		public $archivo_nombre;
		public $rank;		
// CREAMOS LOS METODOS SET		
			public function set_cod_archivo_enviado($cod_archivo_enviado){
					$this->cod_archivo_enviado= $cod_archivo_enviado;
			}
		
			public function set_cod_envio($cod_envio){
					$this->cod_envio= $cod_envio;
			}
		
			public function set_codigo_fuente($codigo_fuente){
					$this->codigo_fuente= $codigo_fuente;
			}
		
			public function set_archivo_nombre($archivo_nombre){
					$this->archivo_nombre= $archivo_nombre;
			}
		
			public function set_rank($rank){
					$this->rank= $rank;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO archivo_enviado (cod_archivo_enviado,cod_envio,codigo_fuente,archivo_nombre,rank) VALUES ('$this->cod_archivo_enviado','$this->cod_envio','$this->codigo_fuente','$this->archivo_nombre','$this->rank')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM archivo_enviado WHERE cod_archivo_enviado='$this->cod_archivo_enviado'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM archivo_enviado ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM archivo_enviado WHERE cod_archivo_enviado='$this->cod_archivo_enviado'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE archivo_enviado SET cod_archivo_enviado='$this->cod_archivo_enviado',cod_envio='$this->cod_envio',codigo_fuente='$this->codigo_fuente',archivo_nombre='$this->archivo_nombre',rank='$this->rank' WHERE cod_archivo_enviado='$this->cod_archivo_enviado'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_archivo_enviado) AS cod_archivo_enviado FROM archivo_enviado");
		$arreglo=$this->row();
		return $arreglo["cod_archivo_enviado"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM archivo_enviado");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE archivo_enviado SET estatus=0 WHERE cod_archivo_enviado='$this->cod_archivo_enviado'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE archivo_enviado SET estatus=1 WHERE cod_archivo_enviado='$this->cod_archivo_enviado'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM archivo_enviado WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM archivo_enviado WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM archivo_enviado WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_archivo_enviado=$row['cod_archivo_enviado'];
		$this->cod_envio=$row['cod_envio'];
		$this->codigo_fuente=$row['codigo_fuente'];
		$this->archivo_nombre=$row['archivo_nombre'];
		$this->rank=$row['rank'];
		
	}
}
?>