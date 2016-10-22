<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_db.php");
// INSTANCIAMOS LA CLASE
class noticia extends db{
// CREAMOS LOS ATRIBUTOS
		private $cod_noticia;
		private $titulo;
		private $descripcion;
		private $fecha_creacion;
		private $fecha_expiracion;
		private $cod_usuario;
		private $imagen;		
// CREAMOS LOS METODOS SET		
			public function set_cod_noticia($cod_noticia){
					$this->cod_noticia= $cod_noticia;
			}
		
			public function set_titulo($titulo){
					$this->titulo= $titulo;
			}
		
			public function set_descripcion($descripcion){
					$this->descripcion= $descripcion;
			}
		
			public function set_imagen($imagen){
				
					if($imagen['size']==0){
						$this->imagen=false;
					}else{
						$url="images/noticia/";
						$nombre_real=$imagen['name'];
						$nombre=$imagen['size'];
						$archivo=$imagen['tmp_name'];
						$arreglo=explode('.',$nombre_real);
						$posicion=count($arreglo);
						$nombre=strtolower($nombre.'.'.$arreglo[$posicion-1]);
						move_uploaded_file($archivo,$url.$nombre);
						$this->imagen= $nombre;						
					}
			}
		
			public function set_fecha_creacion($fecha_creacion){
					$this->fecha_creacion= $fecha_creacion;
			}
		
			public function set_fecha_expiracion($fecha_expiracion){
					$this->fecha_expiracion= date("Y-m-d",strtotime($fecha_expiracion));
			}
		
			public function set_cod_usuario($cod_usuario){
					$this->cod_usuario= $cod_usuario;
			}
		

	public function registrar(){		
		if($this->imagen){
			return parent::ejecutar("INSERT INTO noticia (cod_noticia,titulo,descripcion,fecha_creacion,fecha_expiracion,cod_usuario,imagen) VALUES ('$this->cod_noticia','$this->titulo','$this->descripcion','$this->fecha_creacion','$this->fecha_expiracion','$this->cod_usuario','$this->imagen')");
		}else{
			return parent::ejecutar("INSERT INTO noticia (cod_noticia,titulo,descripcion,fecha_creacion,fecha_expiracion,cod_usuario) VALUES ('$this->cod_noticia','$this->titulo','$this->descripcion','$this->fecha_creacion','$this->fecha_expiracion','$this->cod_usuario')");
			}
	}
	public function consultar(){		
		return parent::ejecutar("SELECT *,date_format(fecha_creacion,'%d-%m-%Y') as fecha_creacion FROM noticia WHERE cod_noticia='$this->cod_noticia'");
	}
	public function listar(){		
		return parent::ejecutar("SELECT usuario.nombre as usuario_nombre, usuario.apellido as usuario_apellido, noticia.*,date_format(noticia.fecha_creacion,'%d-%m-%Y') as fecha_creacion FROM noticia 
		INNER JOIN usuario ON usuario.cod_usuario=noticia.cod_usuario WHERE noticia.estatus=1");
	}
	public function listar_nuevas(){		
		return parent::ejecutar("SELECT *,date_format(fecha_creacion,'%d-%m-%Y') as fecha_creacion FROM noticia WHERE fecha_expiracion >= CURDATE()  ");
	}
	public function listar_todo(){		
		
			return parent::ejecutar("SELECT persona.nombre as usuario_nombre, persona.apellido as usuario_apellido, noticia.*,date_format(noticia.fecha_creacion,'%d-%m-%Y') as fecha_creacion FROM noticia 
		INNER JOIN usuario ON usuario.cod_usuario=noticia.cod_usuario INNER JOIN persona ON persona.cedula=usuario.cedula");
	}
	public function desactivar(){
		$this->consultar();
		$a=$this->row();		
		return parent::ejecutar("UPDATE noticia SET estatus=".($a['estatus']==1 ? "0" : "1")." WHERE cod_noticia='$this->cod_noticia'");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM noticia WHERE cod_noticia='$this->cod_noticia'");
	}
	public function editar(){		
		if($this->imagen){
			return parent::ejecutar("UPDATE noticia SET cod_noticia='$this->cod_noticia',titulo='$this->titulo',descripcion='$this->descripcion',fecha_creacion='$this->fecha_creacion',fecha_expiracion='$this->fecha_expiracion',cod_usuario='$this->cod_usuario',imagen='$this->imagen' WHERE cod_noticia='$this->cod_noticia'");
		}else{
			return parent::ejecutar("UPDATE noticia SET cod_noticia='$this->cod_noticia',titulo='$this->titulo',descripcion='$this->descripcion',fecha_creacion='$this->fecha_creacion',fecha_expiracion='$this->fecha_expiracion',cod_usuario='$this->cod_usuario' WHERE cod_noticia='$this->cod_noticia'");
			}
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_noticia) AS cod_noticia FROM noticia");
		$arreglo=$this->row();
		return $arreglo["cod_noticia"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM noticia");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		return parent::ejecutar("SELECT *,date_format(fecha_creacion,'%d-%m-%Y') as fecha_creacion FROM noticia WHERE $campo='".$this->$campo."'");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT *,date_format(fecha_creacion,'%d-%m-%Y') as fecha_creacion FROM noticia WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM noticia WHERE $campo='".$this->$campo."'");
	}
}
?>
