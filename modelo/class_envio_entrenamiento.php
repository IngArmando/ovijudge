<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
include_once("modelo/class_problema.php");
// INSTANCIAMOS LA CLASE
class envio_entrenamiento extends problema{
// CREAMOS LOS ATRIBUTOS
		public	$cod_envio_entrenamiento,
				$cod_usuario,
				$cod_servidor,
				$fecha_hora,
				$codigo_fuente,
				$comando,
				$cod_lenguaje_prog,
				$cod_msj_salida,
				$resultado_compilacion;
// CREAMOS LOS METODOS SET		
			public function set_cod_envio_entrenamiento($cod_envio_entrenamiento){
				$this->cod_envio_entrenamiento=$cod_envio_entrenamiento;
			}
			public function set_cod_problema($cod_problema){
				$this->cod_problema=$cod_problema;
			}
			public function set_cod_usuario($cod_usuario){
				$this->cod_usuario=$cod_usuario;
			}
			public function set_cod_servidor($cod_servidor){
				$this->cod_servidor=$cod_servidor;
			}
			public function set_fecha_hora($fecha_hora){
				$this->fecha_hora=$fecha_hora;
			}
			public function set_codigo_fuente($codigo_fuente){
				$this->codigo_fuente=$this->mysqli->real_escape_string($codigo_fuente);
			}

			public function set_cod_lenguaje_prog($cod_lenguaje_prog){
					$this->cod_lenguaje_prog=$cod_lenguaje_prog;
			}
			public function set_cod_msj_salida($cod_msj_salida){
					$this->cod_msj_salida= $cod_msj_salida;
			}
		
			public function set_resultado_compilacion($resultado_compilacion){
					$this->resultado_compilacion= $this->mysqli->real_escape_string($resultado_compilacion);
			}

	public function registrar(){		
		return parent::ejecutar("INSERT INTO envio_entrenamiento (cod_problema,cod_usuario,codigo_fuente,cod_lenguaje_prog) VALUES ('$this->cod_problema','$this->cod_usuario','$this->codigo_fuente','$this->cod_lenguaje_prog')");
	}
	public function registrarb(){		
		return parent::ejecutar_seguro("INSERT INTO envio_entrenamiento (cod_problema,cod_usuario,cod_servidor,codigo_fuente,cod_lenguaje_prog) VALUES ('$this->cod_problema','$this->cod_usuario','$this->cod_servidor',%s,'$this->cod_lenguaje_prog')",$this->codigo_fuente);
	}
	public function resultado(){		
		parent::ejecutar("SELECT m.msj FROM envio_entrenamiento e
		INNER JOIN msj_salida m USING(cod_msj_salida)
		WHERE e.cod_envio_entrenamiento='$this->cod_envio_entrenamiento'");
		$row=$this->row();
		return $row['msj'];
	}
	public function consultar_envio_entrenamiento(){		
		$res=parent::ejecutar("SELECT e.*,l.comando FROM envio_entrenamiento e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		WHERE e.cod_envio_entrenamiento='$this->cod_envio_entrenamiento'");
		$this->cargar_variables();
		return $res;
	}
	public function listar_primero_en_cola(){		
		return parent::ejecutar("SELECT e.*,l.comando FROM envio_entrenamiento e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		INNER JOIN problema p USING(cod_problema)
		WHERE e.cod_msj_salida=NULL
		ORDER BY e.cod_envio_entrenamiento ASC
		");
	}
	public function consulta_para_juez(){		
		return parent::ejecutar("SELECT e.*,l.comando,p.limite_tiempo, p.limite_memoria FROM envio_entrenamiento e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		INNER JOIN problema p USING(cod_problema)
		WHERE e.cod_envio_entrenamiento='$this->cod_envio_entrenamiento'
		");
	}
	public function ultimos_envios(){		
		return parent::ejecutar("SELECT persona.nombre as nombre_usuario, m.msj as resultado, m.cod_msj_salida, e.*,date_format(e.fecha_hora,'%d-%m-%Y %h:%i:%s %p') as fecha_hora, l.nombre as nombre_lenguaje FROM envio_entrenamiento e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		INNER JOIN problema p USING(cod_problema)
		INNER JOIN msj_salida m USING(cod_msj_salida)
		INNER JOIN usuario u USING(cod_usuario)
		INNER JOIN persona USING(cedula)
		ORDER BY e.cod_envio_entrenamiento DESC LIMIT 0 , 15
		");
	}
	public function correcto(){
		
		return parent::ejecutar("SELECT cod_envio_entrenamiento FROM envio_entrenamiento
		WHERE cod_problema=$this->cod_problema AND cod_msj_salida=1 AND cod_usuario=$this->cod_usuario");
		
		
	}



	public function modificar(){		
		return parent::ejecutar("UPDATE envio_entrenamiento SET cod_msj_salida='$this->cod_msj_salida',resultado_compilacion='$this->resultado_compilacion' WHERE cod_envio_entrenamiento='$this->cod_envio_entrenamiento'");
	}
	
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id(){
		parent::ejecutar("SELECT MAX(cod_envio_entrenamiento) AS cod_envio_entrenamiento FROM envio_entrenamiento");
		$arreglo=$this->row();
		return $arreglo["cod_envio_entrenamiento"];
		}

	private function cargar_variables(){
		$row=$this->row();	
		$this->cod_envio_entrenamiento=$row['cod_envio_entrenamiento'];
		$this->cod_problema		=$row['cod_problema'];
		$this->cod_usuario		=$row['cod_usuario'];
		$this->cod_servidor		=$row['cod_servidor'];
		$this->fecha_hora		=$row['fecha_hora'];
		$this->codigo_fuente	=$row['codigo_fuente'];
		$this->cod_lenguaje_prog=$row['cod_lenguaje_prog'];
		$this->comando			=$row['comando'];
	}
}
?>
