<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_modulo.php");
// INSTANCIAMOS LA CLASE
class servicio extends modulo{
// CREAMOS LOS ATRIBUTOS
		public $cod_servicio;
		public $cod_modulo;
		public $nombre;
		public $cod_vista_sistema;	
		public $nombre_modulo;	
// CREAMOS LOS METODOS SET		
			public function set_cod_servicio($cod_servicio){
				
					$this->cod_servicio= $cod_servicio;
			}
		
			public function set_cod_modulo($cod_modulo){
					$this->cod_modulo= $cod_modulo;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_cod_vista_sistema($cod_vista_sistema){
					$this->cod_vista_sistema= $cod_vista_sistema;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO servicio (cod_servicio,cod_modulo,nombre,estatus) VALUES ('$this->cod_servicio','$this->cod_modulo','$this->nombre','1')");
	}
	public function consultar(){		
		
		$res=parent::ejecutar("SELECT servicio.*, modulo.nombre as nombre_modulo, modulo.observacion FROM servicio 
		INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo 
		WHERE cod_servicio='$this->cod_servicio'");
		
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT servicio.*, modulo.nombre as nombre_modulo, modulo.observacion FROM servicio 
		INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo WHERE servicio.estatus=1");
	}
	public function listar_todo(){		
		return parent::ejecutar("SELECT servicio.*, modulo.nombre as nombre_modulo, modulo.observacion FROM servicio 
		INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo");
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE servicio SET estatus=0 WHERE cod_servicio='$this->cod_servicio'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE servicio SET estatus=1 WHERE cod_servicio='$this->cod_servicio'");
	}	
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM servicio WHERE cod_servicio='$this->cod_servicio'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE servicio SET cod_modulo='$this->cod_modulo',nombre='$this->nombre' WHERE cod_servicio='$this->cod_servicio'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_servicio) AS cod_servicio FROM servicio");
		$arreglo=$this->row();
		return $arreglo["cod_servicio"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM servicio");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM servicio WHERE $campo='".$this->$campo."'");

	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM servicio WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM servicio WHERE $campo='".$this->$campo."'");
	}
	public function cargar_variables(){
		$row=$this->row();
		$this->cod_servicio=$row['cod_servicio'];
		
		$this->nombre=$row['nombre'];
		$this->nombre_modulo=$row['nombre_modulo'];
		$this->cod_modulo=$row['cod_modulo'];
		$this->estatus=$row['estatus'];
		
	}
}
?>
