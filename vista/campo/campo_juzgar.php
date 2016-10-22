
<?php 
require_once("modelo/class_juzgar.php");
	class campo_juzgar extends juzgar{
		
		public function cod_juzgar(){
			$html='
				
					<div class="col-md-3">
						<label>
							Codigo
						</label>
							<input id="cod_juzgar" class="form-control"  type="text" name="cod_juzgar" value="'.$this->cod_juzgar.'" />
					</div>

			';
			return $html;
		}
		public function cod_concurso(){
			$html='
				
					<div class="col-md-3">
						<label>
							Concurso
						</label>
							'.$this->combo_cod_concurso().'
					</div>

			';
			return $html;
		}
		public function cod_envio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Envio
						</label>
							'.$this->combo_cod_envio().'
					</div>

			';
			return $html;
		}
		public function tiempo_inicio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo de Inicio
						</label>
							<input id="tiempo_inicio" class="form-control"  type="text" name="tiempo_inicio" value="'.$this->tiempo_inicio.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_fin(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo Final
						</label>
							<input id="tiempo_fin" class="form-control"  type="text" name="tiempo_fin" value="'.$this->tiempo_fin.'" />
					</div>

			';
			return $html;
		}
		public function nombre_servidor(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre del Servidor
						</label>
							<input id="nombre_servidor" class="form-control"  type="text" name="nombre_servidor" value="'.$this->nombre_servidor.'" />
					</div>

			';
			return $html;
		}
		public function resultado(){
			$html='
				
					<div class="col-md-3">
						<label>
							Resultado
						</label>
							<input id="resultado" class="form-control"  type="text" name="resultado" value="'.$this->resultado.'" />
					</div>

			';
			return $html;
		}
		public function verificado(){
			$html='
				
					<div class="col-md-3">
						<label>
							Verificado
						</label>
							<input id="verificado" class="form-control"  type="text" name="verificado" value="'.$this->verificado.'" />
					</div>

			';
			return $html;
		}
		public function nombre_jurado(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre del jurado
						</label>
							<input id="nombre_jurado" class="form-control"  type="text" name="nombre_jurado" value="'.$this->nombre_jurado.'" />
					</div>

			';
			return $html;
		}
		public function comentario(){
			$html='
				
					<div class="col-md-3">
						<label>
							Comentario
						</label>
							<input id="comentario" class="form-control"  type="text" name="comentario" value="'.$this->comentario.'" />
					</div>

			';
			return $html;
		}
		public function valido(){
			$html='
				
					<div class="col-md-3">
						<label>
							Valido
						</label>
							<input id="valido" class="form-control"  type="text" name="valido" value="'.$this->valido.'" />
					</div>

			';
			return $html;
		}
		public function salida_compilacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Salida compilación
						</label>
							<input id="salida_compilacion" class="form-control"  type="text" name="salida_compilacion" value="'.$this->salida_compilacion.'" />
					</div>

			';
			return $html;
		}
		public function visto_equipo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Visto por equipo
						</label>
							<input id="visto_equipo" class="form-control"  type="text" name="visto_equipo" value="'.$this->visto_equipo.'" />
					</div>

			';
			return $html;
		}
		public function cod_rejuzgar(){
			$html='
				
					<div class="col-md-3">
						<label>
							Rejuzgar
						</label>
							'.$this->combo_cod_rejuzgar().'
					</div>

			';
			return $html;
		}
		public function pre_cod_juzgar(){
			$html='
				
					<div class="col-md-3">
						<label>
							Pre juzgar
						</label>
							'.$this->combo_pre_cod_juzgar().'
					</div>

			';
			return $html;
		}
	public function combo_cod_concurso(){
		include_once("modelo/class_concurso.php");
		$concurso = new concurso;
		$concurso->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_concurso" class="form-control" name="cod_concurso" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_concurso = $concurso->row()){
			$salida.= '<option value="'.$row_concurso["cod_concurso"].'"';	
			if($row_concurso["cod_concurso"]== $this->cod_concurso) $salida.= " selected ";									
			$salida.= '>'.$row_concurso["nombre"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=concurso&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_concurso($valor){
	include_once("modelo/class_concurso.php");
	$concurso = new concurso;
	$concurso->set_cod_concurso($valor);
	$concurso->consultar();
	$arreglo=$concurso->row();
	return $arreglo['nombre'];
}

	public function combo_cod_envio(){
		include_once("modelo/class_envio.php");
		$envio = new envio;
		$envio->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_envio" class="form-control" name="cod_envio" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_envio = $envio->row()){
			$salida.= '<option value="'.$row_envio["cod_envio"].'"';	
			if($row_envio["cod_envio"]== $this->cod_envio) $salida.= " selected ";									
			$salida.= '>'.$row_envio["orig_envio"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=envio&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_envio($valor){
	include_once("modelo/class_envio.php");
	$envio = new envio;
	$envio->set_cod_envio($valor);
	$envio->consultar();
	$arreglo=$envio->row();
	return $arreglo['orig_envio'];
}

	public function combo_cod_rejuzgar(){
		include_once("modelo/class_rejuzgar.php");
		$rejuzgar = new rejuzgar;
		$rejuzgar->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_rejuzgar" class="form-control" name="cod_rejuzgar" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_rejuzgar = $rejuzgar->row()){
			$salida.= '<option value="'.$row_rejuzgar["cod_rejuzgar"].'"';	
			if($row_rejuzgar["cod_rejuzgar"]== $this->cod_rejuzgar) $salida.= " selected ";									
			$salida.= '>'.$row_rejuzgar["motivo"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=rejuzgar&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_rejuzgar($valor){
	include_once("modelo/class_rejuzgar.php");
	$rejuzgar = new rejuzgar;
	$rejuzgar->set_cod_rejuzgar($valor);
	$rejuzgar->consultar();
	$arreglo=$rejuzgar->row();
	return $arreglo['motivo'];
}

	public function combo_pre_cod_juzgar(){
		include_once("modelo/class_juzgar.php");
		$juzgar = new juzgar;
		$juzgar->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="pre_cod_juzgar" class="form-control" name="pre_cod_juzgar" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_juzgar = $juzgar->row()){
			$salida.= '<option value="'.$row_juzgar["cod_juzgar"].'"';	
			if($row_juzgar["cod_juzgar"]== $this->pre_cod_juzgar) $salida.= " selected ";									
			$salida.= '>'.$row_juzgar["resultado"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=juzgar&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_pre_cod_juzgar($valor){
	include_once("modelo/class_juzgar.php");
	$juzgar = new juzgar;
	$juzgar->set_cod_juzgar($valor);
	$juzgar->consultar();
	$arreglo=$juzgar->row();
	return $arreglo['resultado'];
}

	}
	
?>
