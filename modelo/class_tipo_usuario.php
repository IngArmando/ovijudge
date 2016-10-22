<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class tipo_usuario extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_tipo_usuario;
		public $nombre;		
// CREAMOS LOS METODOS SET		
			public function set_cod_tipo_usuario($cod_tipo_usuario){
					$this->cod_tipo_usuario= $cod_tipo_usuario;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO tipo_usuario (cod_tipo_usuario,nombre) VALUES ('$this->cod_tipo_usuario','$this->nombre')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM tipo_usuario WHERE cod_tipo_usuario='$this->cod_tipo_usuario'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM tipo_usuario ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM tipo_usuario WHERE cod_tipo_usuario='$this->cod_tipo_usuario'");
	}
	public function editar(){		
		return parent::ejecutar("UPDATE tipo_usuario SET cod_tipo_usuario='$this->cod_tipo_usuario',nombre='$this->nombre' WHERE cod_tipo_usuario='$this->cod_tipo_usuario'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_tipo_usuario) AS cod_tipo_usuario FROM tipo_usuario");
		$arreglo=$this->row();
		return $arreglo["cod_tipo_usuario"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM tipo_usuario");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM tipo_usuario WHERE $campo='".$this->$campo."'");
	}
	public function activar(){		
		return parent::ejecutar("UPDATE tipo_usuario SET estatus=1 WHERE cod_tipo_usuario='$this->cod_tipo_usuario'");
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE tipo_usuario SET estatus=0 WHERE cod_tipo_usuario='$this->cod_tipo_usuario'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM tipo_usuario WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM tipo_usuario WHERE $campo='".$this->$campo."'");
	}
	public function cargar_variables(){
		$row=$this->row();
		$this->nombre=$row['nombre'];
	}
}
?>
