<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class informacion extends db{
	private $cod_informacion;
	private $titulo;
	private $descripcion;
	
	public function set_cod_informacion($cod_informacion){
		
		$this->cod_informacion=$cod_informacion;
		
		}
	public function set_titulo($titulo){
		$this->titulo=$titulo;
		}
	public function set_descripcion($descripcion){
		$this->descripcion=$descripcion;
		}
		
	public function consultar(){
		
		return parent::ejecutar("SELECT * FROM informacion WHERE cod_informacion='$this->cod_informacion'");
		
		}
	public function actualizar(){
		
		return parent::ejecutar("UPDATE informacion SET titulo='$this->titulo', descripcion='$this->descripcion' WHERE cod_informacion='$this->cod_informacion'");
		
		}
}
?>
