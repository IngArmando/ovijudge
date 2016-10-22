<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class rejuzgar extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_rejuzgar;
		public $tiempo_inicio;
		public $tiempo_final;
		public $motivo;
		public $valido;
		public $cod_usuario_inicio;
		public $cod_usuario_fin;		
// CREAMOS LOS METODOS SET		
			public function set_cod_rejuzgar($cod_rejuzgar){
					$this->cod_rejuzgar= $cod_rejuzgar;
			}
		
			public function set_tiempo_inicio($tiempo_inicio){
					$this->tiempo_inicio= $tiempo_inicio;
			}
		
			public function set_tiempo_final($tiempo_final){
					$this->tiempo_final= $tiempo_final;
			}
		
			public function set_motivo($motivo){
					$this->motivo= $motivo;
			}
		
			public function set_valido($valido){
					$this->valido= $valido;
			}
		
			public function set_cod_usuario_inicio($cod_usuario_inicio){
					$this->cod_usuario_inicio= $cod_usuario_inicio;
			}
		
			public function set_cod_usuario_fin($cod_usuario_fin){
					$this->cod_usuario_fin= $cod_usuario_fin;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO rejuzgar (cod_rejuzgar,tiempo_inicio,tiempo_final,motivo,valido,cod_usuario_inicio,cod_usuario_fin) VALUES ('$this->cod_rejuzgar','$this->tiempo_inicio','$this->tiempo_final','$this->motivo','$this->valido','$this->cod_usuario_inicio','$this->cod_usuario_fin')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM rejuzgar WHERE cod_rejuzgar='$this->cod_rejuzgar'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM rejuzgar ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM rejuzgar WHERE cod_rejuzgar='$this->cod_rejuzgar'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE rejuzgar SET cod_rejuzgar='$this->cod_rejuzgar',tiempo_inicio='$this->tiempo_inicio',tiempo_final='$this->tiempo_final',motivo='$this->motivo',valido='$this->valido',cod_usuario_inicio='$this->cod_usuario_inicio',cod_usuario_fin='$this->cod_usuario_fin' WHERE cod_rejuzgar='$this->cod_rejuzgar'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_rejuzgar) AS cod_rejuzgar FROM rejuzgar");
		$arreglo=$this->row();
		return $arreglo["cod_rejuzgar"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM rejuzgar");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE rejuzgar SET estatus=0 WHERE cod_rejuzgar='$this->cod_rejuzgar'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE rejuzgar SET estatus=1 WHERE cod_rejuzgar='$this->cod_rejuzgar'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM rejuzgar WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM rejuzgar WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM rejuzgar WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_rejuzgar=$row['cod_rejuzgar'];
		$this->tiempo_inicio=$row['tiempo_inicio'];
		$this->tiempo_final=$row['tiempo_final'];
		$this->motivo=$row['motivo'];
		$this->valido=$row['valido'];
		$this->cod_usuario_inicio=$row['cod_usuario_inicio'];
		$this->cod_usuario_fin=$row['cod_usuario_fin'];
		
	}
}
?>