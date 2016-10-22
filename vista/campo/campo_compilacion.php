
<?php 
require_once("modelo/class_compilacion.php");
	class campo_compilacion extends compilacion{
		
		public function cod_compilacion(){
			$html='<input id="cod_compilacion" class="form-control" type="hidden" name="cod_compilacion" value="'.$this->cod_compilacion.$ultimo_id.'" />';
			return $html;
		}
		public function cod_juzgar(){
			$html='
				
					<div class="col-md-3">
						<label>
							Resultado
						</label>
							'.$this->combo_cod_juzgar().'
					</div>

			';
			return $html;
		}
		public function cod_caso_de_prueba(){
			$html='
				
					<div class="col-md-3">
						<label>
							Caso de prueba
						</label>
							'.$this->combo_cod_caso_de_prueba().'
					</div>

			';
			return $html;
		}
		public function compilacion_resultado(){
			$html='
				
					<div class="col-md-3">
						<label>
							compilacion_resultado
						</label>
							<input id="compilacion_resultado" class="form-control"  type="text" name="compilacion_resultado" value="'.$this->compilacion_resultado.'" />
					</div>

			';
			return $html;
		}
		public function compilacion_tiempo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo de compilación
						</label>
							<input id="compilacion_tiempo" class="form-control"  type="text" name="compilacion_tiempo" value="'.$this->compilacion_tiempo.'" />
					</div>

			';
			return $html;
		}
		public function salida_compilacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Salida de compilación
						</label>
							<input id="salida_compilacion" class="form-control"  type="text" name="salida_compilacion" value="'.$this->salida_compilacion.'" />
					</div>

			';
			return $html;
		}
		public function salida_diferente(){
			$html='
				
					<div class="col-md-3">
						<label>
							Otra salida
						</label>
							<input id="salida_diferente" class="form-control"  type="text" name="salida_diferente" value="'.$this->salida_diferente.'" />
					</div>

			';
			return $html;
		}
		public function salida_error(){
			$html='
				
					<div class="col-md-3">
						<label>
							Error de salida
						</label>
							<input id="salida_error" class="form-control"  type="text" name="salida_error" value="'.$this->salida_error.'" />
					</div>

			';
			return $html;
		}
		public function salida_sistema(){
			$html='
				
					<div class="col-md-3">
						<label>
							Salida sistema
						</label>
							<input id="salida_sistema" class="form-control"  type="text" name="salida_sistema" value="'.$this->salida_sistema.'" />
					</div>

			';
			return $html;
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

	public function combo_cod_caso_de_prueba(){
		include_once("modelo/class_caso_de_prueba.php");
		$caso_de_prueba = new caso_de_prueba;
		$caso_de_prueba->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_caso_de_prueba" class="form-control" name="cod_caso_de_prueba" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_caso_de_prueba = $caso_de_prueba->row()){
			$salida.= '<option value="'.$row_caso_de_prueba["cod_caso_de_prueba"].'"';	
			if($row_caso_de_prueba["cod_caso_de_prueba"]== $this->cod_caso_de_prueba) $salida.= " selected ";									
			$salida.= '>'.$row_caso_de_prueba["descripcion"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=caso_de_prueba&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_caso_de_prueba($valor){
	include_once("modelo/class_caso_de_prueba.php");
	$caso_de_prueba = new caso_de_prueba;
	$caso_de_prueba->set_cod_caso_de_prueba($valor);
	$caso_de_prueba->consultar();
	$arreglo=$caso_de_prueba->row();
	return $arreglo['descripcion'];
}

	}
	
?>
