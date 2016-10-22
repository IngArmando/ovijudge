<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class historial_clave extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_historial_clave;
		public $clave;
		public $cod_usuario;		
// CREAMOS LOS METODOS SET		
			public function set_cod_historial_clave($cod_historial_clave){
					$this->cod_historial_clave= $cod_historial_clave;
			}
		
			public function set_clave($clave){
					$this->clave= $clave;
			}
		
			public function set_cod_usuario($cod_usuario){
					$this->cod_usuario= $cod_usuario;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO historial_clave (cod_historial_clave,clave,cod_usuario) VALUES ('$this->cod_historial_clave','$this->clave','$this->cod_usuario')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM historial_clave WHERE cod_historial_clave='$this->cod_historial_clave'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM historial_clave ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM historial_clave WHERE cod_historial_clave='$this->cod_historial_clave'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE historial_clave SET cod_historial_clave='$this->cod_historial_clave',clave='$this->clave',cod_usuario='$this->cod_usuario' WHERE cod_historial_clave='$this->cod_historial_clave'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_historial_clave) AS cod_historial_clave FROM historial_clave");
		$arreglo=$this->row();
		return $arreglo["cod_historial_clave"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM historial_clave");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE historial_clave SET estatus=0 WHERE cod_historial_clave='$this->cod_historial_clave'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE historial_clave SET estatus=1 WHERE cod_historial_clave='$this->cod_historial_clave'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM historial_clave WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM historial_clave WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM historial_clave WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_historial_clave=$row['cod_historial_clave'];
		$this->clave=$row['clave'];
		$this->cod_usuario=$row['cod_usuario'];
		
	}
}
?>