
<?php 
require_once("modelo/class_clarificacion.php");
	class campo_clarificacion extends clarificacion{
		
		public function cod_clarificacion(){
			$html='<input id="cod_clarificacion" class="form-control" type="hidden" name="cod_clarificacion" value="'.$this->cod_clarificacion.$ultimo_id.'" />';
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
		public function resp_cod_clarificacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Respuesta Clarificación
						</label>
							'.$this->combo_resp_cod_clarificacion().'
					</div>

			';
			return $html;
		}
		public function tiempo_envio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo de envio
						</label>
							<input id="tiempo_envio" class="form-control"  type="text" name="tiempo_envio" value="'.$this->tiempo_envio.'" />
					</div>

			';
			return $html;
		}
		public function remitiente(){
			$html='
				
					<div class="col-md-3">
						<label>
							Remitiente
						</label>
							<input id="remitiente" class="form-control"  type="text" name="remitiente" value="'.$this->remitiente.'" />
					</div>

			';
			return $html;
		}
		public function receptor(){
			$html='
				
					<div class="col-md-3">
						<label>
							Receptor
						</label>
							<input id="receptor" class="form-control"  type="text" name="receptor" value="'.$this->receptor.'" />
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
		public function cod_problema(){
			$html='
				
					<div class="col-md-3">
						<label>
							Problema
						</label>
							'.$this->combo_cod_problema().'
					</div>

			';
			return $html;
		}
		public function categoria(){
			$html='
				
					<div class="col-md-3">
						<label>
							Categoria
						</label>
							<input id="categoria" class="form-control"  type="text" name="categoria" value="'.$this->categoria.'" />
					</div>

			';
			return $html;
		}
		public function cuerpo_msj(){
			$html='
				
					<div class="col-md-3">
						<label>
							Cuerpo del msj
						</label>
							<input id="cuerpo_msj" class="form-control"  type="text" name="cuerpo_msj" value="'.$this->cuerpo_msj.'" />
					</div>

			';
			return $html;
		}
		public function respuesta(){
			$html='
				
					<div class="col-md-3">
						<label>
							Respuesta
						</label>
							<input id="respuesta" class="form-control"  type="text" name="respuesta" value="'.$this->respuesta.'" />
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

	public function combo_resp_cod_clarificacion(){
		include_once("modelo/class_clarificacion.php");
		$clarificacion = new clarificacion;
		$clarificacion->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="resp_cod_clarificacion" class="form-control" name="resp_cod_clarificacion" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_clarificacion = $clarificacion->row()){
			$salida.= '<option value="'.$row_clarificacion["cod_clarificacion"].'"';	
			if($row_clarificacion["cod_clarificacion"]== $this->resp_cod_clarificacion) $salida.= " selected ";									
			$salida.= '>'.$row_clarificacion["remitiente"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=clarificacion&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_resp_cod_clarificacion($valor){
	include_once("modelo/class_clarificacion.php");
	$clarificacion = new clarificacion;
	$clarificacion->set_cod_clarificacion($valor);
	$clarificacion->consultar();
	$arreglo=$clarificacion->row();
	return $arreglo['remitiente'];
}

	public function combo_cod_problema(){
		include_once("modelo/class_problema.php");
		$problema = new problema;
		$problema->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_problema" class="form-control" name="cod_problema" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_problema = $problema->row()){
			$salida.= '<option value="'.$row_problema["cod_problema"].'"';	
			if($row_problema["cod_problema"]== $this->cod_problema) $salida.= " selected ";									
			$salida.= '>'.$row_problema["nombre"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=problema&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_problema($valor){
	include_once("modelo/class_problema.php");
	$problema = new problema;
	$problema->set_cod_problema($valor);
	$problema->consultar();
	$arreglo=$problema->row();
	return $arreglo['nombre'];
}

	}
	
?>
