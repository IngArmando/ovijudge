<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class categoria extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_categoria;
		public $nombre;
		public $ordenado;
		public $color;
		public $status;		
// CREAMOS LOS METODOS SET		
			public function set_cod_categoria($cod_categoria){
					$this->cod_categoria= $cod_categoria;
			}
		
			public function set_nombre($nombre){
					$this->nombre= $nombre;
			}
		
			public function set_ordenado($ordenado){
					$this->ordenado= $ordenado;
			}
		
			public function set_color($color){
					$this->color= $color;
			}
		
			public function set_status($status){
					$this->status= $status;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO categoria (cod_categoria,nombre,ordenado,color,status) VALUES ('$this->cod_categoria','$this->nombre','$this->ordenado','$this->color','$this->status')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM categoria WHERE cod_categoria='$this->cod_categoria'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM categoria ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM categoria WHERE cod_categoria='$this->cod_categoria'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE categoria SET cod_categoria='$this->cod_categoria',nombre='$this->nombre',ordenado='$this->ordenado',color='$this->color',status='$this->status' WHERE cod_categoria='$this->cod_categoria'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_categoria) AS cod_categoria FROM categoria");
		$arreglo=$this->row();
		return $arreglo["cod_categoria"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM categoria");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE categoria SET estatus=0 WHERE cod_categoria='$this->cod_categoria'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE categoria SET estatus=1 WHERE cod_categoria='$this->cod_categoria'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM categoria WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM categoria WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM categoria WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_categoria=$row['cod_categoria'];
		$this->nombre=$row['nombre'];
		$this->ordenado=$row['ordenado'];
		$this->color=$row['color'];
		$this->status=$row['status'];
		
	}
}
?>