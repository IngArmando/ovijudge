<?php
//INCLUYE LA CLASE QUE CREA LA CONEXION
@include_once("modelo/class_concurso.php");
// INSTANCIAMOS LA CLASE
class envio extends concurso{
// CREAMOS LOS ATRIBUTOS
		public $cod_envio;
		public $cod_equipo;
		public $cod_problema;
		public $cod_lenguaje_prog;
		public $codigo_fuente;
		public $fecha_hora;
		public $cod_msj_salida;
		public $resultado_compilacion;
// CREAMOS LOS METODOS SET		
			public function set_cod_envio($cod_envio){
					$this->cod_envio= $cod_envio;
			}

			public function set_cod_concurso($cod_concurso){
					$this->cod_concurso= $cod_concurso;
			}
		
			public function set_cod_equipo($cod_equipo){
					$this->cod_equipo= $cod_equipo;
			}
		
			public function set_cod_problema($cod_problema){
					$this->cod_problema= $cod_problema;
			}
		
			public function set_cod_lenguaje_prog($cod_lenguaje_prog){
					$this->cod_lenguaje_prog= $cod_lenguaje_prog;
			}
		
			public function set_codigo_fuente($codigo_fuente){
			
					$this->codigo_fuente= $this->mysqli->real_escape_string($codigo_fuente);
			}
		
			public function set_fecha_hora($fecha_hora){
					$this->fecha_hora= $fecha_hora;
			}
		
			public function set_cod_msj_salida($cod_msj_salida){
					$this->cod_msj_salida= $cod_msj_salida;
			}
		
			public function set_resultado_compilacion($resultado_compilacion){
					$this->resultado_compilacion= $this->mysqli->real_escape_string($resultado_compilacion);
			}

	public function registrar_envio(){		
		$res=parent::ejecutar("INSERT INTO envio (cod_concurso,cod_equipo,cod_problema,cod_lenguaje_prog,codigo_fuente) VALUES ('$this->cod_concurso','$this->cod_equipo','$this->cod_problema','$this->cod_lenguaje_prog','$this->codigo_fuente')");
		$this->consultar();
		return $res;
	}
	public function consultar(){		
		$res=parent::ejecutar("SELECT * FROM envio WHERE cod_envio='$this->cod_envio'");
		$this->cargar_variables();
		return $res;
	}
	
	public function listar_primero_en_cola(){		
		return parent::ejecutar("SELECT e.*,l.comando FROM envio e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		INNER JOIN problema p USING(cod_problema)
		WHERE e.cod_msj_salida IS NULL
		ORDER BY e.cod_envio ASC
		");
	}
	public function consulta_para_juez(){		
		return parent::ejecutar("SELECT e.*,l.comando, p.limite_tiempo, p.limite_memoria FROM envio e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		INNER JOIN problema p USING(cod_problema)
		WHERE e.cod_msj_salida IS NULL
		AND cod_envio=$this->cod_envio
		");
	}
	public function listar_equipos_concurso(){
		return parent::ejecutar("SELECT en.*, e.nombre FROM envio en INNER JOIN equipo e USING(cod_equipo) WHERE en.cod_concurso='$this->cod_concurso' GROUP BY en.cod_equipo");	
		
	}
	public function listar(){		
		return parent::ejecutar("SELECT * FROM envio ");
	}
	public function listar_envios_para_posicion(){		
		return parent::ejecutar("SELECT * FROM envio INNER JOIN concurso c USING(cod_concurso) WHERE c.tiempo_final<NOW() AND cod_concurso NOT IN (SELECT cod_concurso FROM tabla_posicion)");
	}
	public function eliminar(){		
		return parent::ejecutar("DELETE FROM envio WHERE cod_envio='$this->cod_envio'");
	}
	public function modificar(){		
		return parent::ejecutar("UPDATE envio SET cod_msj_salida='$this->cod_msj_salida',resultado_compilacion='$this->resultado_compilacion' WHERE cod_envio='$this->cod_envio'");
	}
	//ESTA FUNCION EXTRAE EL ULTIMO REGISTRO DE LA TABLA
	public function ultimo_id_envio(){
		parent::ejecutar("SELECT MAX(cod_envio) AS cod_envio FROM envio");
		$arreglo=$this->row();
		return $arreglo["cod_envio"];
		}
	//Retornar la cantidad de registros que possee la tabla
	public function cantidad_registros(){
		parent::ejecutar("SELECT COUNT(*) FROM envio");
		$arreglo=$this->row();
		return $arreglo[0];
	}
	public function desactivar(){		
		return parent::ejecutar("UPDATE envio SET estatus=0 WHERE cod_envio='$this->cod_envio'");
	}	
	public function activar(){		
		return parent::ejecutar("UPDATE envio SET estatus=1 WHERE cod_envio='$this->cod_envio'");
	}	
	public function consulta_por($campo){
		return parent::ejecutar("SELECT * FROM envio WHERE $campo='".$this->$campo."'");
	}

	public function consultar_envio(){		
		$res=parent::ejecutar("SELECT e.*,l.comando FROM envio e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		WHERE e.cod_envio='$this->cod_envio'");
		$this->cargar_variables();
		return $res;
	}
	public function correcto(){
		return parent::ejecutar("SELECT e.cod_envio,l.nombre,e.fecha_hora FROM envio e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		INNER JOIN concurso c USING(cod_concurso)
		WHERE cod_problema=$this->cod_problema AND cod_msj_salida=1 AND cod_equipo=$this->cod_equipo AND cod_concurso=$this->cod_concurso AND ((e.fecha_hora>c.tiempo_conjelacion AND NOW()>=c.tiempo_desconjelar) OR e.fecha_hora<c.tiempo_conjelacion)");
	}
	public function resultado(){		
		parent::ejecutar("SELECT m.msj FROM envio e
		INNER JOIN msj_salida m USING(cod_msj_salida)
		WHERE e.cod_envio='$this->cod_envio'");
		$row=$this->row();
					$res=parent::ejecutar("SELECT e.*, m.msj  FROM envio e
					INNER JOIN msj_salida m USING(cod_msj_salida)
					INNER JOIN concurso c USING(cod_concurso)
					WHERE e.cod_equipo='$this->cod_equipo' and e.cod_envio='$this->cod_envio' AND ((e.fecha_hora>c.tiempo_conjelacion AND NOW()>c.tiempo_desconjelar) OR e.fecha_hora<c.tiempo_conjelacion)");
					if($res==0){
						$row['cod_msj_salida']='999';
						$row['msj']='RESULTADO CONGELADO';
					}
		return $row['msj'];
	}
	public function intentos_fallidos(){
		return parent::ejecutar("SELECT e.cod_envio,l.nombre,e.fecha_hora FROM envio e
		INNER JOIN lenguaje_prog l USING(cod_lenguaje_prog)
		INNER JOIN concurso c USING(cod_concurso)
		WHERE cod_problema=$this->cod_problema AND cod_msj_salida<>1 AND cod_equipo=$this->cod_equipo AND cod_concurso=$this->cod_concurso AND ((e.fecha_hora>c.tiempo_conjelacion AND NOW()>c.tiempo_desconjelar) OR e.fecha_hora<c.tiempo_conjelacion)");
	}
	public function consulta_doble($campo1,$campo2){
		return parent::ejecutar("SELECT * FROM envio WHERE $campo1='".$this->$campo1."' AND $campo2='".$this->$campo2."'");
	}
	public function elimina_por($campo){
		return parent::ejecutar("DELETE FROM envio WHERE $campo='".$this->$campo."'");
	}
	private function cargar_variables(){
		$row=$this->row();
		
		$this->cod_envio			=$row['cod_envio'];
		$this->cod_concurso			=$row['cod_concurso'];
		$this->cod_equipo			=$row['cod_equipo'];
		$this->cod_problema			=$row['cod_problema'];
		$this->cod_lenguaje_prog	=$row['cod_lenguaje_prog'];
		$this->fecha_hora			=$row['fecha_hora'];
		$this->cod_msj_salida		=$row['cod_msj_salida'];
		$this->resultado_compilacion=$row['resultado_compilacion'];
		$this->codigo_fuente		=$row['codigo_fuente'];
		
	}
}
?>
