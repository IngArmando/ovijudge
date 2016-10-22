<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class equipo extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_equipo;
		public $nombre;
		public $cod_institucion;
		public $estatus;
		public $nombre_institucion;
	
// CREAMOS LOS METODOS SET		
			public function set_cod_equipo($cod_equipo){
					$this->cod_equipo= filter_var($cod_equipo,FILTER_SANITIZE_NUMBER_INT);
			}

			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}

			public function set_cod_institucion($cod_institucion){
					$this->cod_institucion= $cod_institucion;
			}
		
			public function set_estatus($estatus){
					$this->estatus= $estatus;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO equipo (nombre,cod_institucion,estatus,cod_usuario_reg) VALUES ('$this->nombre','$this->cod_institucion',1,".$_SESSION['cod_usuario'].")");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT e.*, i.nombre as nombre_institucion FROM equipo e
		INNER JOIN institucion i USING (cod_institucion)
		WHERE cod_equipo='$this->cod_equipo'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT *, i.nombre as nombre_institucion FROM equipo
		INNER JOIN institucion i USING (cod_institucion) WHERE estatus=1");
	}
	public function listar_admin(){		
		return parent::ejecutar("SELECT e.*, i.nombre as nombre_institucion FROM equipo e
		INNER JOIN institucion i USING (cod_institucion)
		");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM equipo WHERE cod_equipo='$this->cod_equipo'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE equipo SET nombre='$this->nombre',cod_institucion='$this->cod_institucion' WHERE cod_equipo='$this->cod_equipo'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_equipo) AS cod_equipo FROM equipo");
		$arreglo=$this->row();
		return $arreglo["cod_equipo"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM equipo");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE equipo SET estatus=0 WHERE cod_equipo='$this->cod_equipo'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE equipo SET estatus=1 WHERE cod_equipo='$this->cod_equipo'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM equipo WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM equipo WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM equipo WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_equipo=$row['cod_equipo'];
		$this->nombre=$row['nombre'];
		$this->cod_institucion=$row['cod_institucion'];
		$this->estatus=$row['estatus'];
		$this->nombre_institucion=$row['nombre_institucion'];
		
	}
}
?>
