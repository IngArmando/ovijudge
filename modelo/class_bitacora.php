<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class bitacora extends db{
// CREAMOS LOS ATRIBUTOS
		private $cod_bitacora;
		private $evento;
		private $fecha_hora_timestamp;
		private $cedula;
		private $cod_usuario;		
// CREAMOS LOS METODOS SET		
			public function set_cod_bitacora($cod_bitacora){
					$this->cod_bitacora= $cod_bitacora;
			}
		
			public function set_evento($evento){
					$this->evento= $evento;
			}
		
			public function set_fecha_hora_timestamp($fecha_hora_timestamp){
					$this->fecha_hora_timestamp= $fecha_hora_timestamp;
			}
		
			public function set_cedula($cedula){
					$this->cedula= $cedula;
			}
			public function set_cod_usuario($cod_usuario){
					$this->cod_usuario= $cod_usuario;
			}
		
			public function set_descripcion($descripcion){
					$this->descripcion= $descripcion;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO bitacora (cod_bitacora,evento,fecha_hora_timestamp,cedula,descripcion) VALUES ('$this->cod_bitacora','$this->evento','$this->fecha_hora_timestamp','$this->cedula','$this->descripcion')");
	}
	public function consultar(){		
		return parent::ejecutar("SELECT *,date_format(fecha_hora_timestamp,'%d-%m-%Y  %h:%i:%s') as fecha_hora_timestamp FROM bitacora WHERE cod_bitacora='$this->cod_bitacora'");
	}
	public function listar(){		
		return parent::ejecutar("SELECT bitacora.*,date_format(bitacora.fecha_hora_timestamp,'%d-%m-%Y  %h:%i:%s') as fecha_hora_timestamp, persona.nombre as usuario_nombre, persona.apellido as usuario_apellido FROM bitacora INNER JOIN usuario ON bitacora.cod_usuario=usuario.cod_usuario INNER JOIN persona ON persona.cedula=usuario.cedula");
	}
	public function listar_avanzado($fecha_inicio,$fecha_fin){	
		$fecha_inicio=date("Y-m-d",strtotime($fecha_inicio));
		$fecha_fin=date("Y-m-d",strtotime($fecha_fin));
		if($this->cod_usuario!="Todos"){
			$estatus="AND bitacora.cod_usuario='$this->cod_usuario'";
			$where="WHERE";
		
			}
		if($fecha_inicio and $fecha_fin){
			$fecha="(bitacora.fecha_hora_timestamp BETWEEN  '".$fecha_inicio." 00:00:01' AND '".$fecha_fin." 23:59:59') ";
			$where="WHERE";
			}	
		return parent::ejecutar("SELECT bitacora.*,date_format(bitacora.fecha_hora_timestamp,'%d-%m-%Y  %h:%i:%s %p') as fecha_hora_timestamp, persona.nombre as usuario_nombre, persona.apellido as usuario_apellido FROM bitacora INNER JOIN usuario ON bitacora.cod_usuario=usuario.cod_usuario INNER JOIN persona ON persona.cedula=usuario.cedula ".$where." ".$fecha.$estatus);
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM bitacora WHERE cod_bitacora='$this->cod_bitacora'");
	}
	public function editar(){		
		return parent::ejecutar("UPDATE bitacora SET cod_bitacora='$this->cod_bitacora',evento='$this->evento',fecha_hora_timestamp='$this->fecha_hora_timestamp',cedula='$this->cedula',descripcion='$this->descripcion' WHERE cod_bitacora='$this->cod_bitacora'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_bitacora) AS cod_bitacora FROM bitacora");
		$arreglo=$this->row();
		return $arreglo["cod_bitacora"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM bitacora");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT *,date_format(fecha_hora_timestamp,'%d-%m-%Y %h:%i:%s') as fecha_hora_timestamp FROM bitacora WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT *,date_format(fecha_hora_timestamp,'%d-%m-%Y %h:%i:%s') as fecha_hora_timestamp FROM bitacora WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM bitacora WHERE $campo='".$this->$campo."'");
	}
}
?>
