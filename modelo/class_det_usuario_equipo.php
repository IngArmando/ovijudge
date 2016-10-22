<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class det_usuario_equipo extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_det_usuario_equipo;
		public $cod_usuario;
		public $cod_equipo;
	
// CREAMOS LOS METODOS SET		
			public function set_det_usuario_equipo($cod_usuario_equipo){
					$this->cod_usuario_equipo= $cod_usuario_equipo;
			}
		
			public function set_cod_usuario($cod_usuario){
					$this->cod_usuario= $cod_usuario;
			}
		
			public function set_cod_equipo($cod_equipo){
					$this->cod_equipo= $cod_equipo;
			}
		
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO det_usuario_equipo (cod_usuario,cod_equipo) VALUES ('$this->cod_usuario','$this->cod_equipo')");
	}

	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM det_usuario_equipo WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function consulta_por($campo1){
		return parent::ejecutar("SELECT u.cod_usuario as id,CONCAT(p.nombre,' ',p.apellido) as name, p.apellido, p.nombre, p.cedula, u.cod_usuario, e.cod_equipo, e.nombre as nombre_equipo FROM det_usuario_equipo
		INNER JOIN usuario u USING(cod_usuario)
		INNER JOIN persona p USING (cedula)
		INNER JOIN equipo e USING(cod_equipo)
		WHERE $campo1='".$this->$campo1."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM det_usuario_equipo WHERE $campo='".$this->$campo."'");
	}

}
?>
