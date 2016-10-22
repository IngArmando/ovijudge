<?php
require_once("modelo/class_db.php");
class pregunta_seguridad extends db{
		private $cod_pregunta_seguridad;
		private $cedula;
		protected $pregunta;
		protected $respuesta;
		
	public function set_cod_pregunta_seguridad($cod_pregunta_seguridad){
			$this->cod_pregunta_seguridad=$cod_pregunta_seguridad;
		
	}
	public function set_cedula($cedula){
			$this->cedula=$cedula;
		
	}
	public function set_pregunta($pregunta){
			$this->pregunta=$pregunta;
		
	}
	public function set_respuesta($respuesta){
		$this->respuesta=$respuesta;
	}
	
	public function modificar(){
			$total=count($this->pregunta);
			foreach($this->pregunta as $cod=>$pregunta){
				$confirmar+=parent::ejecutar("UPDATE pregunta_seguridad SET pregunta='$this->pregunta', respuesta='$this->respuesta' WHERE cod_pregunta_seguridad='$this->cod_pregunta_seguridad'");
			}
			if($total==$confirmar)
			return true;
	}
	public function registrar(){
		$total=count($this->pregunta);
		foreach($this->pregunta as $cod=>$pregunta){
			$confirmar+=parent::ejecutar("INSERT INTO pregunta_seguridad (pregunta,respuesta,cedula) VALUES('".$this->pregunta[$cod]."','".$this->respuesta[$cod]."','$this->cedula')");
		}
		if($total==$confirmar)
		return true;
	}
	public function consultar(){
			$res=parent::ejecutar("SELECT * FROM pregunta_seguridad WHERE cedula='$this->cedula'");
			$this->cargar_variables();
			return $res;
		}
	public function consultar_lista(){
			return parent::ejecutar("SELECT * FROM pregunta_seguridad WHERE cedula='$this->cedula'");
		}
	public function verificar_respuesta(){
		return parent::ejecutar("SELECT * FROM pregunta_seguridad WHERE cedula='$this->cedula' AND cod_pregunta_seguridad='$this->cod_pregunta_seguridad' AND respuesta='$this->respuesta'");
	}
	public function eliminar(){
		return parent::ejecutar("DELETE FROM pregunta_seguridad WHERE cedula='$this->cedula'");
	}
	private function cargar_variables(){
		
		while($row=$this->row()){
			
			$this->pregunta[]=$row['pregunta'];
			$this->respuesta[]=$row['respuesta'];
		}
		
	}
	
}
