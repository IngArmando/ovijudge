<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class globo extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_globo;
		public $cod_envio;
		public $status;		
// CREAMOS LOS METODOS SET		
			public function set_cod_globo($cod_globo){
					$this->cod_globo= $cod_globo;
			}
		
			public function set_cod_envio($cod_envio){
					$this->cod_envio= $cod_envio;
			}
		
			public function set_status($status){
					$this->status= $status;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO globo (cod_globo,cod_envio,status) VALUES ('$this->cod_globo','$this->cod_envio','$this->status')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM globo WHERE cod_globo='$this->cod_globo'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM globo ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM globo WHERE cod_globo='$this->cod_globo'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE globo SET cod_globo='$this->cod_globo',cod_envio='$this->cod_envio',status='$this->status' WHERE cod_globo='$this->cod_globo'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_globo) AS cod_globo FROM globo");
		$arreglo=$this->row();
		return $arreglo["cod_globo"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM globo");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE globo SET estatus=0 WHERE cod_globo='$this->cod_globo'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE globo SET estatus=1 WHERE cod_globo='$this->cod_globo'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM globo WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM globo WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM globo WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_globo=$row['cod_globo'];
		$this->cod_envio=$row['cod_envio'];
		$this->status=$row['status'];
		
	}
}
?>