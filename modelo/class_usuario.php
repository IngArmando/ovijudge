<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("vista/campo/campo_persona.php");
// INSTANCIAMOS LA CLASE
class usuario extends campo_persona{
// CREAMOS LOS ATRIBUTOS
		public $cod_usuario;
		public $estatus;
		public $ultima_actividad;
		public $fecha_clave;
		public $clave;
		public	$ultima_ip;
		public $ip_actual;
		public $cod_tipo_usuario;
		public $cod_institucion;
// CREAMOS LOS METODOS SET		

			public function set_cod_usuario($cod_usuario){
					$this->cod_usuario= $this->mysqli->real_escape_string($cod_usuario);
			}
			public function set_clave($clave){
				$clave=hash_hmac('whirlpool', $clave, '@tORp3d0');
				$this->clave=$clave;
			}
			public function get_clave(){
					return $this->clave;
			}
		
			public function set_estatus($estatus){
					$this->estatus= $estatus;
			}
		
			public function set_ultima_actividad($ultima_actividad){
					$this->ultima_actividad= $ultima_actividad;
			}
		
			public function set_fecha_clave(){
					$this->fecha_clave=date('y-m-d h:i:s');
			}
		

			public function set_ultima_ip(){

					$this->ultima_ip= '';
			}
		
			public function set_ip_actual(){
					$this->ip_actual= getUserIP();
			}
		
			public function set_cod_tipo_usuario($cod_tipo_usuario){
					$this->cod_tipo_usuario= $cod_tipo_usuario;
			}
			public function set_cod_institucion($cod_institucion){
					$this->cod_institucion=$cod_institucion;
				}
		

	public function registrar(){		
		return parent::ejecutar("INSERT INTO usuario (ultima_actividad,fecha_clave,clave,ultima_ip,ip_actual,cod_tipo_usuario,cedula) VALUES (NOW(),NOW(),'$this->clave','$this->ultima_ip','$this->ip_actual','$this->cod_tipo_usuario','$this->cedula')");
	}
	public function registrar_por_administrador(){
		parent::registrar();	
		return parent::ejecutar("INSERT INTO usuario (ultima_actividad,fecha_clave,clave,cod_tipo_usuario,cedula,cod_institucion) VALUES (NOW(),NOW(),'$this->clave','$this->cod_tipo_usuario','$this->cedula','$this->cod_institucion')");
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT usuario.*, tipo_usuario.nombre as nombre_tipo_usuario, persona.*, date_format(persona.fecha_nacimiento,'%d-%m-%Y') as fecha_nacimiento, date_format(usuario.ultima_actividad,'%d-%m-%Y %h:%i:%s %p') as ultima_actividad, municipio.nombre as nombre_municipio, parroquia.nombre as nombre_parroquia, estado.nombre as nombre_estado FROM usuario INNER JOIN persona ON persona.cedula=usuario.cedula INNER JOIN parroquia ON persona.cod_parroquia=parroquia.cod_parroquia INNER JOIN municipio ON municipio.cod_municipio=parroquia.cod_municipio INNER JOIN estado ON estado.cod_estado=municipio.cod_estado INNER JOIN tipo_usuario ON tipo_usuario.cod_tipo_usuario=usuario.cod_tipo_usuario WHERE cod_usuario='$this->cod_usuario'");
		$this->cargar_variables();
		return $res;
	}
	public function listar(){		
		return parent::ejecutar("SELECT *, persona.nombre as nombre_persona, usuario.estatus as estatus, tipo_usuario.nombre as nombre_tipo_usuario FROM usuario INNER JOIN persona ON persona.cedula=usuario.cedula INNER JOIN tipo_usuario ON tipo_usuario.cod_tipo_usuario=usuario.cod_tipo_usuario");
	}
	public function listar_para_autocomplete(){		
		return parent::ejecutar("SELECT cod_usuario as id,nombre as name, apellido, cedula FROM usuario INNER JOIN persona USING (cedula)");
	}
	public function listar_solo_si_registro(){		
		return parent::ejecutar("SELECT * FROM usuario WHERE cod_usuario='".$_SESSION['cod_usuario']."'");
	}
	public function eliminar(){
		return parent::eliminar();		
		//return parent::ejecutar("DELETE FROM usuario WHERE cedula='$this->cedula'");
	}
	public function activar(){		
		return parent::ejecutar("UPDATE usuario SET estatus=1 WHERE cod_usuario='$this->cod_usuario'");
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE usuario SET estatus=0 WHERE cod_usuario='$this->cod_usuario'");
	}
	public function bloquear_usuario(){		
		return parent::ejecutar("UPDATE usuario SET estatus=0 WHERE cedula='$this->cedula'");
	}
	public function editar(){		
		return parent::ejecutar("UPDATE usuario SET cedula='$this->cedula',nombre='$this->nombre',cod_tipo_usuario='$this->cod_tipo_usuario',apellido='$this->apellido',sexo='$this->sexo',correo='$this->correo',telefono_movil='$this->telefono_movil',telefono_fijo='$this->telefono_fijo',fecha_nacimiento='$this->fecha_nacimiento',clave='$this->clave',estatus='$this->estatus' WHERE cedula='$this->cedula'");
	}
	public function modificar(){	
		parent::modificar();
		return parent::ejecutar("UPDATE usuario SET cod_tipo_usuario='$this->cod_tipo_usuario',estatus='$this->estatus',cod_institucion='$this->cod_institucion' WHERE cedula='$this->cedula'");
	}

	public function editar_limitado(){		
		return parent::ejecutar("UPDATE usuario SET nombre='$this->nombre',apellido='$this->apellido',sexo='$this->sexo',correo='$this->correo',telefono_movil='$this->telefono_movil',telefono_fijo='$this->telefono_fijo',fecha_nacimiento='$this->fecha_nacimiento' WHERE cedula='$this->cedula'");
	}
	public function cambiar_pass(){		
		return parent::ejecutar("UPDATE usuario SET clave='$this->clave', fecha_clave=NOW() WHERE cedula='$this->cedula'");
	}
	public function actualizar_entrada(){		
		return parent::ejecutar("UPDATE usuario SET ultima_actividad=NOW() WHERE cod_usuario='$this->cod_usuario'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cedula) AS cedula FROM usuario");
		$arreglo=$this->row();
		return $arreglo["cedula"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM usuario");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function consulta_por($campo){
		$res=parent::ejecutar("SELECT * FROM usuario WHERE $campo='".$this->$campo."'");
		$this->cargar_variables();
		return $res;
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT tipo_usuario.nombre as nombre_tipo_usuario, usuario.*, persona.* FROM usuario INNER JOIN persona ON persona.cedula=usuario.cedula INNER JOIN tipo_usuario ON usuario.cod_tipo_usuario=tipo_usuario.cod_tipo_usuario WHERE usuario.$campo1='".$this->$campo1."' AND usuario.$campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM usuario WHERE $campo='".$this->$campo."'");
	}
	public function privilegios(){
		return parent::ejecutar("SELECT vista_sistema.cod_vista_sistema,vista_sistema.nombre FROM `vista_sistema` INNER JOIN servicio ON servicio.cod_servicio=vista_sistema.cod_servicio INNER JOIN modulo ON modulo.cod_modulo=servicio.cod_modulo INNER JOIN privilegio ON privilegio.cod_vista_sistema=vista_sistema.cod_vista_sistema WHERE privilegio.cod_tipo_usuario='$this->cod_tipo_usuario'");
	}
	public function listar_nuevos(){
		return parent::ejecutar("SELECT * FROM usuario WHERE cod_tipo_usuario=4");
	}
	public function listar_para_codigo(){
		return parent::ejecutar("SELECT * FROM usuario WHERE cod_tipo_usuario=1");
	}
	public function verificar(){
		return parent::ejecutar("SELECT clave from usuario WHERE clave='$this->clave' AND cod_usuario='$this->cod_usuario'");
	}
	public function verificar_por_cedula(){
		return parent::ejecutar("SELECT * from usuario WHERE clave='$this->clave' AND cod_usuario='$this->cod_usuario'");
	}
	public function verificar_estatus(){
		return parent::ejecutar("SELECT * from usuario WHERE estatus='1' AND cedula='$this->cedula'");
	}
	public function cambiar_clave(){
		parent::ejecutar("UPDATE usuario SET clave='$this->clave', fecha_clave=NOW() WHERE cod_usuario='$this->cod_usuario'");
		return parent::ejecutar("INSERT INTO historial_clave (clave,cod_usuario) VALUES ('$this->clave','$this->cod_usuario')");
		
	}
	public function cambiar_clave_por_cedula(){
		return parent::ejecutar("UPDATE usuario SET clave='$this->clave' WHERE cedula='$this->cedula'");
	}
	public function consultar_historial(){
		return parent::ejecutar("SELECT * FROM historial_clave WHERE cod_usuario='$this->cod_usuario' AND clave='$this->clave'");
	}
	public function puntaje(){
		return parent::ejecutar("SELECT nombre,apellido,cod_usuario FROM usuario
		INNER JOIN persona USING(cedula)
		INNER JOIN envio_entrenamiento USING(cod_usuario)
		WHERE cod_msj_salida=1 and cod_usuario=$this->cod_usuario group by cod_problema,cod_lenguaje_prog
		");
	}
	public function puntaje_individual(){
		return parent::ejecutar("SELECT nombre,apellido,cod_usuario FROM usuario
		INNER JOIN persona USING(cedula)
		INNER JOIN envio_entrenamiento USING(cod_usuario)
		WHERE cod_msj_salida=1 and cod_usuario=$this->cod_usuario group by cod_problema,cod_lenguaje_prog
		");
	}
	public function problemas_resueltos(){
		return parent::ejecutar("SELECT nombre,apellido,cod_usuario FROM usuario
		INNER JOIN persona USING(cedula)
		INNER JOIN envio_entrenamiento USING(cod_usuario)
		WHERE cod_msj_salida=1 and cod_usuario=$this->cod_usuario group by cod_problema
		");
	}
	public function lenguajes_resueltos($cod_problema){
		return parent::ejecutar("SELECT l.nombre FROM usuario
		INNER JOIN persona USING(cedula)
		INNER JOIN envio_entrenamiento USING(cod_usuario)
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		WHERE cod_msj_salida=1 and cod_usuario=$this->cod_usuario and cod_problema=".$cod_problema." group by cod_problema,cod_lenguaje_prog
		");
	}
	private function cargar_variables(){
		$row=$this->row();
		$this->cedula=$row['cedula'];
		$this->cod_usuario=$row['cod_usuario'];
		$this->cod_tipo_usuario=$row['cod_tipo_usuario'];
		$this->fecha_clave=$row['fecha_clave'];
		$this->clave=$row['clave'];
		//exit($row['nombre']);
		$this->nombre=$row['nombre'];
		$this->apellido=$row['apellido'];
		$this->fecha_nacimiento=$row['fecha_nacimiento'];
		$this->sexo=$row['sexo'];
		$this->correo=$row['correo'];
		$this->telefono_fijo=$row['telefono_fijo'];
		$this->telefono_movil=$row['telefono_movil'];
		$this->cod_parroquia=$row['cod_parroquia'];
		$this->direccion=$row['direccion'];
		$this->estatus=$row['estatus'];
		$this->nombre_estado=$row['nombre_estado'];
		$this->nombre_municipio=$row['nombre_municipio'];
		$this->nombre_parroquia=$row['nombre_parroquia'];
		$this->ultima_actividad=$row['ultima_actividad'];
		$this->nombre_tipo_usuario=$row['nombre_tipo_usuario'];
		$this->foto_perfil=$row['foto_perfil'];
	
		
	}

}
?>
