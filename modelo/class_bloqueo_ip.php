<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class bloqueo_ip extends db{
	private $ip;
	private $agente;
	
	public function set_ip($ip){
		$this->ip=$ip;
	}
	public function set_agente($agente){
			$this->agente=$agente;
	}
	
	public function registrar(){
		
		return parent::ejecutar("INSERT INTO bloqueo_ip (ip,agente) VALUES ('$this->ip','$this->agente')");
		
	}
	
	public function consultar(){
		return parent::ejecutar("SELECT * FROM bloqueo_ip WHERE ip='$this->ip'");
	}
	
}
