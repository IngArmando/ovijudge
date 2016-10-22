<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class privilegio extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_privilegio;
		public $cod_vista_sistema;
		public $cod_tipo_usuario;
		public $consultar;
		public $eliminar;
		public $actualizar;
		public $desactivar;
		public $registrar;		
// CREAMOS LOS METODOS SET		
			public function set_cod_privilegio($cod_privilegio){
					$this->cod_privilegio= $cod_privilegio;
			}
		
			public function set_cod_vista_sistema($cod_vista_sistema){
					$this->cod_vista_sistema= $cod_vista_sistema;
			}
		
			public function set_cod_tipo_usuario($cod_tipo_usuario){
					$this->cod_tipo_usuario= $cod_tipo_usuario;
			}
		
			public function set_consultar($consultar){
					$this->consultar= $consultar;
			}
		
			public function set_eliminar($eliminar){
					$this->eliminar= $eliminar;
			}
		
			public function set_actualizar($actualizar){
					$this->actualizar= $actualizar;
			}
		
			public function set_desactivar($desactivar){
					$this->desactivar= $desactivar;
			}
		
			public function set_registrar($registrar){
					$this->registrar= $registrar;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO privilegio (cod_privilegio,cod_vista_sistema,cod_tipo_usuario,consultar,eliminar,actualizar,desactivar,registrar) VALUES ('$this->cod_privilegio','$this->cod_vista_sistema','$this->cod_tipo_usuario','$this->consultar','$this->eliminar','$this->actualizar','$this->desactivar','$this->registrar')");
	}
	public function consultar(){		
		return parent::ejecutar("SELECT * FROM privilegio WHERE cod_privilegio='$this->cod_privilegio'");
	}
	public function consultar_por_cod_tipo_usuario(){		
		return parent::ejecutar("SELECT modulo.cod_modulo, servicio.cod_servicio, privilegio.*, vista_sistema.*, tipo_usuario.nombre as nombre_tipo_usuario, servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM privilegio INNER JOIN tipo_usuario ON tipo_usuario.cod_tipo_usuario=privilegio.cod_tipo_usuario INNER JOIN vista_sistema ON vista_sistema.cod_vista_sistema=privilegio.cod_vista_sistema INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo WHERE tipo_usuario.cod_tipo_usuario='$this->cod_tipo_usuario' AND vista_sistema.estatus=1 AND visible=1 ORDER BY modulo.cod_modulo ASC, vista_sistema.posicion ASC");
	}
	public function consultar_por_cod_tipo_usuario_privilegio(){		
		return parent::ejecutar("SELECT modulo.cod_modulo, servicio.cod_servicio, privilegio.*, vista_sistema.cod_vista_sistema, vista_sistema.descripcion, tipo_usuario.nombre as nombre_tipo_usuario, servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM privilegio INNER JOIN tipo_usuario ON tipo_usuario.cod_tipo_usuario=privilegio.cod_tipo_usuario INNER JOIN vista_sistema ON vista_sistema.cod_vista_sistema=privilegio.cod_vista_sistema INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo WHERE tipo_usuario.cod_tipo_usuario='$this->cod_tipo_usuario' ORDER BY modulo.cod_modulo ASC, vista_sistema.posicion ASC");
	}
	public function consultar_por_cod_tipo_usuario_agrupado_por($grupo){		
		return parent::ejecutar("SELECT modulo.cod_modulo, servicio.cod_servicio, privilegio.*, vista_sistema.*, tipo_usuario.nombre as nombre_tipo_usuario, servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM privilegio INNER JOIN tipo_usuario ON tipo_usuario.cod_tipo_usuario=privilegio.cod_tipo_usuario INNER JOIN vista_sistema ON vista_sistema.cod_vista_sistema=privilegio.cod_vista_sistema INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo WHERE tipo_usuario.cod_tipo_usuario='$this->cod_tipo_usuario' GROUP BY ".$grupo);
	}
	public function consultar_por_cod_tipo_usuario_agrupado_condicionado($grupo,$cod_modulo){		
		return parent::ejecutar("SELECT modulo.cod_modulo, servicio.cod_servicio, privilegio.*, vista_sistema.*, tipo_usuario.nombre as nombre_tipo_usuario, servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM privilegio INNER JOIN tipo_usuario ON tipo_usuario.cod_tipo_usuario=privilegio.cod_tipo_usuario INNER JOIN vista_sistema ON vista_sistema.cod_vista_sistema=privilegio.cod_vista_sistema INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo WHERE tipo_usuario.cod_tipo_usuario='$this->cod_tipo_usuario' AND modulo.cod_modulo=".$cod_modulo." GROUP BY ".$grupo);
	}
	public function consulta_para_header($cod_servicio){		
		return parent::ejecutar("SELECT privilegio.*, vista_sistema.*, tipo_usuario.nombre as nombre_tipo_usuario, servicio.nombre as nombre_servicio, modulo.nombre as nombre_modulo FROM privilegio INNER JOIN tipo_usuario ON tipo_usuario.cod_tipo_usuario=privilegio.cod_tipo_usuario INNER JOIN vista_sistema ON vista_sistema.cod_vista_sistema=privilegio.cod_vista_sistema INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo WHERE tipo_usuario.cod_tipo_usuario='$this->cod_tipo_usuario' AND servicio.cod_servicio=".$cod_servicio);
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM privilegio ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM privilegio WHERE cod_privilegio='$this->cod_privilegio'");
	}
	public function editar(){		
		return parent::ejecutar("UPDATE privilegio SET cod_privilegio='$this->cod_privilegio',cod_vista_sistema='$this->cod_vista_sistema',cod_tipo_usuario='$this->cod_tipo_usuario',consultar='$this->consultar',eliminar='$this->eliminar',actualizar='$this->actualizar',desactivar='$this->desactivar',registrar='$this->registrar' WHERE cod_privilegio='$this->cod_privilegio'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_privilegio) AS cod_privilegio FROM privilegio");
		$arreglo=$this->row();
		return $arreglo["cod_privilegio"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM privilegio");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM privilegio WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM privilegio WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM privilegio WHERE $campo='".$this->$campo."'");
	}
}
?>
