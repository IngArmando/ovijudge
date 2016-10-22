<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
@include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class juzgar_entrenamiento extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_juzgar_entrenamiento,
		$cod_envio_entrenamiento,
		$resultado,
		$cod_msj_salida,
		$resultado_compilacion;
		
		public function set_cod_juzgar_entrenamiento($cod_juzgar_entrenamiento){
				$this->cod_juzgar_entrenamiento= $cod_juzgar_entrenamiento;
		}
		public function set_cod_envio_entrenamiento($cod_envio_entrenamiento){
				$this->cod_envio_entrenamiento= $cod_envio_entrenamiento;
		}
		public function set_cod_msj_salida($cod_msj_salida){
				$this->cod_msj_salida= $cod_msj_salida;
		}
		public function set_resultado($resultado){
				$this->resultado= $resultado;
		}
		public function set_resultado_compilacion($resultado_compilacion){
			if(trim($resultado_compilacion)==1)
				$resultado_compilacion="";
				$this->resultado_compilacion= $this->mysqli->real_escape_string($resultado_compilacion);
		}
		public function registrar(){
			return $this->ejecutar("INSERT INTO juzgar_entrenamiento (cod_envio_entrenamiento, resultado, resultado_compilacion,cod_msj_salida) VALUES ($this->cod_envio_entrenamiento,'$this->resultado','$this->resultado_compilacion','$this->cod_msj_salida')");	
		}
		
}
?>
