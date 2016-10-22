<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class compilacion extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_compilacion;
		public $cod_juzgar;
		public $cod_caso_de_prueba;
		public $compilacion_resultado;
		public $compilacion_tiempo;
		public $salida_compilacion;
		public $salida_diferente;
		public $salida_error;
		public $salida_sistema;		
// CREAMOS LOS METODOS SET		
			public function set_cod_compilacion($cod_compilacion){
					$this->cod_compilacion= $cod_compilacion;
			}
		
			public function set_cod_juzgar($cod_juzgar){
					$this->cod_juzgar= $cod_juzgar;
			}
		
			public function set_cod_caso_de_prueba($cod_caso_de_prueba){
					$this->cod_caso_de_prueba= $cod_caso_de_prueba;
			}
		
			public function set_compilacion_resultado($compilacion_resultado){
					$this->compilacion_resultado= $compilacion_resultado;
			}
		
			public function set_compilacion_tiempo($compilacion_tiempo){
					$this->compilacion_tiempo= $compilacion_tiempo;
			}
		
			public function set_salida_compilacion($salida_compilacion){
					$this->salida_compilacion= $salida_compilacion;
			}
		
			public function set_salida_diferente($salida_diferente){
					$this->salida_diferente= $salida_diferente;
			}
		
			public function set_salida_error($salida_error){
					$this->salida_error= $salida_error;
			}
		
			public function set_salida_sistema($salida_sistema){
					$this->salida_sistema= $salida_sistema;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO compilacion (cod_compilacion,cod_juzgar,cod_caso_de_prueba,compilacion_resultado,compilacion_tiempo,salida_compilacion,salida_diferente,salida_error,salida_sistema) VALUES ('$this->cod_compilacion','$this->cod_juzgar','$this->cod_caso_de_prueba','$this->compilacion_resultado','$this->compilacion_tiempo','$this->salida_compilacion','$this->salida_diferente','$this->salida_error','$this->salida_sistema')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM compilacion WHERE cod_compilacion='$this->cod_compilacion'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM compilacion ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM compilacion WHERE cod_compilacion='$this->cod_compilacion'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE compilacion SET cod_compilacion='$this->cod_compilacion',cod_juzgar='$this->cod_juzgar',cod_caso_de_prueba='$this->cod_caso_de_prueba',compilacion_resultado='$this->compilacion_resultado',compilacion_tiempo='$this->compilacion_tiempo',salida_compilacion='$this->salida_compilacion',salida_diferente='$this->salida_diferente',salida_error='$this->salida_error',salida_sistema='$this->salida_sistema' WHERE cod_compilacion='$this->cod_compilacion'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_compilacion) AS cod_compilacion FROM compilacion");
		$arreglo=$this->row();
		return $arreglo["cod_compilacion"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM compilacion");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE compilacion SET estatus=0 WHERE cod_compilacion='$this->cod_compilacion'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE compilacion SET estatus=1 WHERE cod_compilacion='$this->cod_compilacion'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM compilacion WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM compilacion WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM compilacion WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_compilacion=$row['cod_compilacion'];
		$this->cod_juzgar=$row['cod_juzgar'];
		$this->cod_caso_de_prueba=$row['cod_caso_de_prueba'];
		$this->compilacion_resultado=$row['compilacion_resultado'];
		$this->compilacion_tiempo=$row['compilacion_tiempo'];
		$this->salida_compilacion=$row['salida_compilacion'];
		$this->salida_diferente=$row['salida_diferente'];
		$this->salida_error=$row['salida_error'];
		$this->salida_sistema=$row['salida_sistema'];
		
	}
}
?>