<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class notificacion extends db{
// CREAMOS LOS ATRIBUTOS
		private $cod_notificacion;
		private $mensaje;
		private $url;
		private $estatus;
		private $cod_usuario;
		private $observacion;		
// CREAMOS LOS METODOS SET		
			public function set_cod_notificacion($cod_notificacion){
					$this->cod_notificacion= $cod_notificacion;
			}
		
			public function set_mensaje($mensaje){
					$this->mensaje= $mensaje;
			}
		
			public function set_url($url){
					$this->url= $url;
			}
		
			public function set_estatus($estatus){
					$this->estatus= $estatus;
			}
		
			public function set_cod_usuario($cod_usuario){
					$this->cod_usuario= $cod_usuario;
			}
			public function set_fecha($fecha){
				$this->fecha=date('Y-m-d h:i:s',strtotime($fecha));
				}
			public function set_fecha_comparar($fecha_comparar){
				$this->fecha_comparar=date('Y-m-d',strtotime($fecha_comparar));
				}
			
			
		
			public function set_observacion($observacion){
					$this->observacion= $observacion;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO notificacion (cod_notificacion,mensaje,url,estatus,cod_usuario,observacion,fecha_comparar) VALUES ('$this->cod_notificacion','$this->mensaje','$this->url','$this->estatus','$this->cod_usuario','$this->observacion',NOW())");
	}
	public function consultar(){		
		return parent::ejecutar("SELECT * FROM notificacion WHERE cod_notificacion='$this->cod_notificacion'");
	}
	public function no_repetir(){		
		return parent::ejecutar("SELECT * FROM notificacion WHERE cod_usuario='$this->cod_usuario' AND mensaje='$this->mensaje' AND observacion='no_repetir'");
	}
	public function consulta_repetido(){		
		return parent::ejecutar("SELECT * FROM notificacion WHERE cod_usuario='$this->cod_usuario' AND mensaje='$this->mensaje' AND fecha_comparar='$this->fecha_comparar'");
	}
	public function verificar(){		
		return parent::ejecutar("SELECT * FROM notificacion WHERE cod_usuario='$this->cod_usuario' AND estatus=1");
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM notificacion WHERE estatus=1");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM notificacion WHERE cod_notificacion='$this->cod_notificacion'");
	}
	public function editar(){		
		return parent::ejecutar("UPDATE notificacion SET cod_notificacion='$this->cod_notificacion',mensaje='$this->mensaje',url='$this->url',estatus='$this->estatus',cod_usuario='$this->cod_usuario',observacion='$this->observacion' WHERE cod_notificacion='$this->cod_notificacion'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_notificacion) AS cod_notificacion FROM notificacion");
		$arreglo=$this->row();
		return $arreglo["cod_notificacion"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM notificacion");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function listar_todo(){		
		return parent::ejecutar("SELECT * FROM notificacion");
	}
	public function desactivar(){
		$this->consultar();
		$a=$this->row();
		return parent::ejecutar("UPDATE notificacion SET estatus=".($a['estatus']==1 ? "0" : "1")." WHERE cod_notificacion='$this->cod_notificacion' AND cod_usuario='$this->cod_usuario'");
		}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT notificacion.*, date_format(fecha,'%d-%m-%Y %h:%i:%s %p') as fecha FROM notificacion WHERE $campo='".$this->$campo."' AND estatus=1 ORDER BY fecha DESC");
	}
	public function visto(){
		return parent::ejecutar("UPDATE notificacion SET estatus=1 WHERE cod_usuario='$this->cod_usuario'");
		}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM notificacion WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM notificacion WHERE $campo='".$this->$campo."'");
	}
}
?>
