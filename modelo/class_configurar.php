<?php
require_once("modelo/class_db.php");
class configurar extends db{
	private $caducidad;
	private $pregunta_crear;
	private $pregunta_mostrar;
	private $intentos_fallidos;
	private $inactividad;
	
	public function set_caducidad($caducidad){
		$this->caducidad=$caducidad;	
	}
	public function set_pregunta_crear($pregunta_crear){
		$this->pregunta_crear=$pregunta_crear;
	}
	public function set_pregunta_mostrar($pregunta_mostrar){
			$this->pregunta_mostrar=$pregunta_mostrar;
	}
	public function set_intentos_fallidos($intentos_fallidos){
			$this->intentos_fallidos=$intentos_fallidos;
	}
	public function set_inactividad($inactividad){
			$this->inactividad=$inactividad;
	}
	
	public function editar(){
			return parent::ejecutar("UPDATE configurar SET caducidad='$this->caducidad', pregunta_crear='$this->pregunta_crear', pregunta_mostrar='$this->pregunta_mostrar', intentos_fallidos='$this->intentos_fallidos', inactividad='$this->inactividad'");
	}
	public function consultar(){
		return parent::ejecutar("SELECT * FROM configurar");
	}
	
}
?>
