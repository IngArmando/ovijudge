
<?php 
require_once("modelo/class_evento.php");
	class campo_evento extends evento{
		
		public function cod_evento(){
			$html='
				
					<div class="col-md-3">
						<label>
							Codigo
						</label>
							<input id="cod_evento" class="form-control"  type="text" name="cod_evento" value="'.$this->cod_evento.'" />
					</div>

			';
			return $html;
		}
		public function tiempo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo
						</label>
							<input id="tiempo" class="form-control"  type="text" name="tiempo" value="'.$this->tiempo.'" />
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
		public function cod_clarificacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Clarificación
						</label>
							'.$this->combo_cod_clarificacion().'
					</div>

			';
			return $html;
		}
		public function cod_lenguaje_prog(){
			$html='
				
					<div class="col-md-3">
						<label>
							Lenguaje de programación
						</label>
							'.$this->combo_cod_lenguaje_prog().'
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
		public function cod_juzgar(){
			$html='
				
					<div class="col-md-3">
						<label>
							Sentencia
						</label>
							'.$this->combo_cod_juzgar().'
					</div>

			';
			return $html;
		}
		public function cod_equipo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Equipo
						</label>
							'.$this->combo_cod_equipo().'
					</div>

			';
			return $html;
		}
		public function descripcion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Descripción
						</label>
							<input id="descripcion" class="form-control"  type="text" name="descripcion" value="'.$this->descripcion.'" />
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

	public function combo_cod_clarificacion(){
		include_once("modelo/class_clarificacion.php");
		$clarificacion = new clarificacion;
		$clarificacion->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_clarificacion" class="form-control" name="cod_clarificacion" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_clarificacion = $clarificacion->row()){
			$salida.= '<option value="'.$row_clarificacion["cod_clarificacion"].'"';	
			if($row_clarificacion["cod_clarificacion"]== $this->cod_clarificacion) $salida.= " selected ";									
			$salida.= '>'.$row_clarificacion["remitiente"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=clarificacion&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_clarificacion($valor){
	include_once("modelo/class_clarificacion.php");
	$clarificacion = new clarificacion;
	$clarificacion->set_cod_clarificacion($valor);
	$clarificacion->consultar();
	$arreglo=$clarificacion->row();
	return $arreglo['remitiente'];
}

	public function combo_cod_lenguaje_prog(){
		include_once("modelo/class_lenguaje_prog.php");
		$lenguaje_prog = new lenguaje_prog;
		$lenguaje_prog->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_lenguaje_prog" class="form-control" name="cod_lenguaje_prog" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_lenguaje_prog = $lenguaje_prog->row()){
			$salida.= '<option value="'.$row_lenguaje_prog["cod_lenguaje_prog"].'"';	
			if($row_lenguaje_prog["cod_lenguaje_prog"]== $this->cod_lenguaje_prog) $salida.= " selected ";									
			$salida.= '>'.$row_lenguaje_prog["nombre"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=lenguaje_prog&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_lenguaje_prog($valor){
	include_once("modelo/class_lenguaje_prog.php");
	$lenguaje_prog = new lenguaje_prog;
	$lenguaje_prog->set_cod_lenguaje_prog($valor);
	$lenguaje_prog->consultar();
	$arreglo=$lenguaje_prog->row();
	return $arreglo['nombre'];
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

	public function combo_cod_juzgar(){
		include_once("modelo/class_juzgar.php");
		$juzgar = new juzgar;
		$juzgar->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_juzgar" class="form-control" name="cod_juzgar" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_juzgar = $juzgar->row()){
			$salida.= '<option value="'.$row_juzgar["cod_juzgar"].'"';	
			if($row_juzgar["cod_juzgar"]== $this->cod_juzgar) $salida.= " selected ";									
			$salida.= '>'.$row_juzgar["resultado"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=juzgar&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_juzgar($valor){
	include_once("modelo/class_juzgar.php");
	$juzgar = new juzgar;
	$juzgar->set_cod_juzgar($valor);
	$juzgar->consultar();
	$arreglo=$juzgar->row();
	return $arreglo['resultado'];
}

	public function combo_cod_equipo(){
		include_once("modelo/class_equipo.php");
		$equipo = new equipo;
		$equipo->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_equipo" class="form-control" name="cod_equipo" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_equipo = $equipo->row()){
			$salida.= '<option value="'.$row_equipo["cod_equipo"].'"';	
			if($row_equipo["cod_equipo"]== $this->cod_equipo) $salida.= " selected ";									
			$salida.= '>'.$row_equipo["nombre"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=equipo&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_equipo($valor){
	include_once("modelo/class_equipo.php");
	$equipo = new equipo;
	$equipo->set_cod_equipo($valor);
	$equipo->consultar();
	$arreglo=$equipo->row();
	return $arreglo['nombre'];
}

	}
	
?>
