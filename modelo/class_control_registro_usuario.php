<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class control_registro_usuario extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_usuario;
		public $cod_vista_sistema;	
		public $cod_registro;	
// CREAMOS LOS METODOS SET		
			public function set_cod_usuario($cod_usuario){
				
					$this->cod_usuario= $cod_usuario;
			}
		
		
			public function set_cod_registro($cod_registro){
					$this->cod_registro= $cod_registro;
			}
		
			public function set_cod_vista_sistema($cod_vista_sistema){
					$this->cod_vista_sistema= $cod_vista_sistema;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO control_registro_usuario (cod_usuario,cod_vista_sistema,cod_registro) VALUES ('$this->cod_usuario','$this->cod_vista_sistema','$this->cod_registro')");
	}
	public function consultar(){
		return parent::ejecutar("SELECT * FROM control_registro_usuario WHERE cod_usuario='$this->cod_usuario' AND cod_vista_sistema='$this->cod_vista_sistema' AND cod_registro='$this->cod_registro'");
	}
}
?>
