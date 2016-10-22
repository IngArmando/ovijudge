<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
@include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class problema extends db{
// CREAMOS LOS ATRIBUTOS
		public $cod_problema;
		public $nombre;
		public $limite_tiempo;
		public $limite_memoria;
		public $texto_problema;
		public $tipo_texto_problema;
		public $codigo_fuente;	
		public $enunciado;	
// CREAMOS LOS METODOS SET		
			public function set_cod_problema($cod_problema){
			
					$this->cod_problema= filter_var($cod_problema,FILTER_SANITIZE_NUMBER_INT);
			}
		
			public function set_nombre($nombre){
					$this->nombre= $this->mysqli->real_escape_string($nombre);
			}
		
			public function set_limite_tiempo($limite_tiempo){
					$this->limite_tiempo= $limite_tiempo;
			}
			public function set_enunciado($enunciado){
					$this->enunciado=$this->mysqli->real_escape_string($enunciado);
				
				}
			public function set_limite_memoria($limite_memoria){
					if($limite_memoria){
						//exit("a");
						$this->limite_memoria= $limite_memoria;
					}else{
						//exit("b");
						$this->limite_memoria= 'NULL';
					}
			}
		
		
			public function set_texto_problema($texto_problema,$texto_problema_viejo){
				$texto_problema_viejo=filter_var($texto_problema_viejo,FILTER_SANITIZE_STRING);
				
				if($texto_problema['name']){
					$rand=rand(10000,99999);

					if($texto_problema['type']=='image/jpeg' || $texto_problema['type']=='image/png' || $texto_problema['type']=='image/gif'){
						$extension=explode("/",$texto_problema['type']);
					$nombre_archivo=strtolower('archivos/problemas/'.$this->cod_problema.'.'.$extension[1]);
					move_uploaded_file($texto_problema['tmp_name'],$nombre_archivo);
					$this->texto_problema= $nombre_archivo;
					}else{
						$_SESSION['msj_tipo']='danger';
						$_SESSION['msj']='Disculpe la imagen esta dañada o no es compatible, debe adjuntar una imagen PNG, JPEG o GIF';
						$_SESSION['redireccion']=$_SERVER['HTTP_REFERER'];
						exit(header('location:index.php'));	
					}
					
				
				}else{
					$this->texto_problema= $texto_problema_viejo;
					}
				
			}
		
			public function set_tipo_texto_problema($tipo_texto_problema){
					$this->tipo_texto_problema= $tipo_texto_problema;
			}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO problema (nombre,limite_tiempo,limite_memoria,texto_problema,enunciado,estatus) VALUES ('$this->nombre','$this->limite_tiempo',$this->limite_memoria,'$this->texto_problema','$this->enunciado','1')");
	}
	public function consultar(){		
		if($this->cod_problema){
			$res=parent::ejecutar("SELECT * FROM problema WHERE cod_problema='$this->cod_problema' and estatus=1");
			$this->cargar_variables();
			return $res;
		}else{
			$_SESSION['msj']='La petición no se puede realizar, por favor intente nuevamente, o contacte al administrador.';
			$_SESSION['msj_tipo']='danger';
			header("location:index.php");
			exit();
		}
	}
	public function consultar_problema(){		
		if($this->cod_problema){
			$res=parent::ejecutar("SELECT * FROM problema WHERE cod_problema='$this->cod_problema'");
			$this->cargar_variables();
			return $res;
		}
	}
	public function listar_para_autocomplete(){		
		return parent::ejecutar("SELECT cod_problema as id,nombre as name FROM problema ");
	}
	public function listar_admin(){		
		return parent::ejecutar("SELECT * FROM problema ");
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM problema WHERE estatus=1");
	}
	public function listar_problemas(){		
		return parent::ejecutar("SELECT * FROM problema WHERE estatus=1");
	}
		
	public function eliminar(){		
		if($this->cod_problema){
			return parent::ejecutar("DELETE FROM problema WHERE cod_problema='$this->cod_problema'");
		}
	}
	public function modificar(){	
		if($this->cod_problema){	
			return parent::ejecutar("UPDATE problema SET nombre='$this->nombre',limite_tiempo='$this->limite_tiempo',limite_memoria=$this->limite_memoria,texto_problema='$this->texto_problema',enunciado='$this->enunciado' WHERE cod_problema='$this->cod_problema'");
		}
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_problema) AS cod_problema FROM problema");
		$arreglo=$this->row();
		return $arreglo["cod_problema"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM problema");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		if($this->cod_problema){
			return parent::ejecutar("UPDATE problema SET estatus=0 WHERE cod_problema='$this->cod_problema'");
		}
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE problema SET estatus=1 WHERE cod_problema='$this->cod_problema'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM problema WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM problema WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		if($this->$campo){
			return parent::ejecutar("DELETE FROM problema WHERE $campo='".$this->$campo."'");
		}else{
			$_SESSION['msj']='La petición no se puede realizar, por favor intente nuevamente.';
			$_SESSION['msj_tipo']='danger';
			header("location:index.php");
			exit();
		}
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_problema=$row['cod_problema'];
		$this->nombre=$row['nombre'];
		$this->limite_tiempo=$row['limite_tiempo'];
		$this->limite_memoria=$row['limite_memoria'];
		$this->texto_problema=$row['texto_problema'];
		$this->tipo_texto_problema=$row['tipo_texto_problema'];
		$this->enunciado=$row['enunciado'];
		
	}
}
?>
