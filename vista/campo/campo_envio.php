
<?php 
require_once("modelo/class_envio.php");
	class campo_envio extends envio{
		
		public function cod_envio(){
			$html='<input id="cod_envio" class="form-control" type="hidden" name="cod_envio" value="'.$this->cod_envio.$ultimo_id.'" />';
			return $html;
		}
		public function orig_envio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Origen
						</label>
							<input id="orig_envio" class="form-control"  type="text" name="orig_envio" value="'.$this->orig_envio.'" />
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
		public function cod_lenguaje_prog(){
			$html='
				
					<div class="col-md-3">
						<label>
							Lenguages de programación
						</label>
							'.$this->combo_cod_lenguaje_prog().'
					</div>

			';
			return $html;
		}
		public function tiempo_envio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo envio
						</label>
							<input id="tiempo_envio" class="form-control"  type="text" name="tiempo_envio" value="'.$this->tiempo_envio.'" />
					</div>

			';
			return $html;
		}
		public function nombre_servidor(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre servidor
						</label>
							<input id="nombre_servidor" class="form-control"  type="text" name="nombre_servidor" value="'.$this->nombre_servidor.'" />
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
		public function expectativa_resultados(){
			$html='
				
					<div class="col-md-3">
						<label>
							Expectativa
						</label>
							<input id="expectativa_resultados" class="form-control"  type="text" name="expectativa_resultados" value="'.$this->expectativa_resultados.'" />
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
			$salida.= '>'.$row_rejuzgar["valido"]."</option>";
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
	return $arreglo['valido'];
}

	}
	
?>
