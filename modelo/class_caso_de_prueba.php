<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
@include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class caso_de_prueba extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_caso_de_prueba;
		public $md5sum_input;
		public $md5sum_output;
		public $input;
		public $output;
		public $cod_problema;
		public $rank;
		public $descripcion;
		public $imagen;
		public $imagen_peque;
		public $imagen_tipo;
		public $ejemplo;		
// CREAMOS LOS METODOS SET		
			public function set_cod_caso_de_prueba($cod_caso_de_prueba){
					$this->cod_caso_de_prueba= $cod_caso_de_prueba;
			}
		
			public function set_md5sum_input($md5sum_input){
					$this->md5sum_input= $md5sum_input;
			}
		
			public function set_md5sum_output($md5sum_output){
					$this->md5sum_output= $md5sum_output;
			}
		
			public function set_input($input){
					$this->input=$this->mysqli->real_escape_string($input);
					$this->md5sum_input=md5($this->input);
			}
		
			public function set_output($output){
					$this->output=$this->mysqli->real_escape_string($output);
					$this->md5sum_output=md5($this->output);
			}
		
			public function set_cod_problema($cod_problema){
					$this->cod_problema= $cod_problema;
			}
		
			public function set_rank($rank){
					$this->rank= $rank;
			}
		
			public function set_descripcion($descripcion){
					$this->descripcion= $descripcion;
			}
		
			public function set_imagen($imagen){
					$this->imagen= $imagen;
			}
		
			public function set_imagen_peque($imagen_peque){
					$this->imagen_peque= $imagen_peque;
			}
		
			public function set_imagen_tipo($imagen_tipo){
					$this->imagen_tipo= $imagen_tipo;
			}
		
			public function set_ejemplo($ejemplo){
					$this->ejemplo= $ejemplo;
			}
		

	public function registrar_minimo(){		
		return parent::ejecutar("INSERT INTO caso_de_prueba (input,output,cod_problema,ejemplo,descripcion) VALUES ('$this->input','$this->output','$this->cod_problema','$this->ejemplo','$this->descripcion')");
	}
	public function registrar(){		
		return parent::ejecutar("INSERT INTO caso_de_prueba (cod_caso_de_prueba,md5sum_input,md5sum_output,input,output,cod_problema,rank,descripcion,imagen,imagen_peque,imagen_tipo,ejemplo) VALUES ('$this->cod_caso_de_prueba','$this->md5sum_input','$this->md5sum_output','$this->input','$this->output','$this->cod_problema','$this->rank','$this->descripcion','$this->imagen','$this->imagen_peque','$this->imagen_tipo','$this->ejemplo')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM caso_de_prueba WHERE cod_caso_de_prueba='$this->cod_caso_de_prueba'");
		$this->cargar_variables();
		return $res;
	}
	public function consulta_para_reporte_pdf(){		
		return parent::ejecutar("SELECT * FROM caso_de_prueba WHERE cod_problema='$this->cod_problema' AND ejemplo=1");
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM caso_de_prueba ");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM caso_de_prueba WHERE cod_caso_de_prueba='$this->cod_caso_de_prueba'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE caso_de_prueba SET cod_caso_de_prueba='$this->cod_caso_de_prueba',md5sum_input='$this->md5sum_input',md5sum_output='$this->md5sum_output',input='$this->input',output='$this->output',cod_problema='$this->cod_problema',rank='$this->rank',descripcion='$this->descripcion',imagen='$this->imagen',imagen_peque='$this->imagen_peque',imagen_tipo='$this->imagen_tipo',ejemplo='$this->ejemplo' WHERE cod_caso_de_prueba='$this->cod_caso_de_prueba'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_caso_de_prueba) AS cod_caso_de_prueba FROM caso_de_prueba");
		$arreglo=$this->row();
		return $arreglo["cod_caso_de_prueba"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM caso_de_prueba");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE caso_de_prueba SET estatus=0 WHERE cod_caso_de_prueba='$this->cod_caso_de_prueba'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE caso_de_prueba SET estatus=1 WHERE cod_caso_de_prueba='$this->cod_caso_de_prueba'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM caso_de_prueba WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM caso_de_prueba WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM caso_de_prueba WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_caso_de_prueba=$row['cod_caso_de_prueba'];
		$this->md5sum_input=$row['md5sum_input'];
		$this->md5sum_output=$row['md5sum_output'];
		$this->input=$row['input'];
		$this->output=$row['output'];
		$this->cod_problema=$row['cod_problema'];
		$this->rank=$row['rank'];
		$this->descripcion=$row['descripcion'];
		$this->imagen=$row['imagen'];
		$this->imagen_peque=$row['imagen_peque'];
		$this->imagen_tipo=$row['imagen_tipo'];
		$this->ejemplo=$row['ejemplo'];
		
	}
}
?>
