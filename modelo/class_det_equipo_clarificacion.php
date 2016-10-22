<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class det_equipo_clarificacion extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_equipo;
		public $cod_clarificacion;		
// CREAMOS LOS METODOS SET		
			public function set_cod_equipo($cod_equipo){
					$this->cod_equipo= $cod_equipo;
			}
		
			public function set_cod_clarificacion($cod_clarificacion){
					$this->cod_clarificacion= $cod_clarificacion;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO det_equipo_clarificacion (cod_equipo,cod_clarificacion) VALUES ('$this->cod_equipo','$this->cod_clarificacion')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM det_equipo_clarificacion WHERE cod_equipo='$this->cod_equipo'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM det_equipo_clarificacion ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM det_equipo_clarificacion WHERE cod_equipo='$this->cod_equipo'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE det_equipo_clarificacion SET cod_equipo='$this->cod_equipo',cod_clarificacion='$this->cod_clarificacion' WHERE cod_equipo='$this->cod_equipo'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_equipo) AS cod_equipo FROM det_equipo_clarificacion");
		$arreglo=$this->row();
		return $arreglo["cod_equipo"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM det_equipo_clarificacion");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE det_equipo_clarificacion SET estatus=0 WHERE cod_equipo='$this->cod_equipo'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE det_equipo_clarificacion SET estatus=1 WHERE cod_equipo='$this->cod_equipo'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM det_equipo_clarificacion WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM det_equipo_clarificacion WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM det_equipo_clarificacion WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_equipo=$row['cod_equipo'];
		$this->cod_clarificacion=$row['cod_clarificacion'];
		
	}
}
?>