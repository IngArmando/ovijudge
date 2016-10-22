
<?php 
require_once("modelo/class_caso_de_prueba.php");
	class campo_caso_de_prueba extends caso_de_prueba{
		
		public function cod_caso_de_prueba(){
			$html='<input id="cod_caso_de_prueba" class="form-control" type="hidden" name="cod_caso_de_prueba" value="'.$this->cod_caso_de_prueba.$ultimo_id.'" />';
			return $html;
		}
		public function md5sum_entrada(){
			$html='
				
					<div class="col-md-3">
						<label>
							md5sum de entrada
						</label>
							<input id="md5sum_entrada" class="form-control"  type="text" name="md5sum_entrada" value="'.$this->md5sum_entrada.'" />
					</div>

			';
			return $html;
		}
		public function md5sum_salida(){
			$html='
				
					<div class="col-md-3">
						<label>
							md5sum de salida
						</label>
							<input id="md5sum_salida" class="form-control"  type="text" name="md5sum_salida" value="'.$this->md5sum_salida.'" />
					</div>

			';
			return $html;
		}
		public function entrada(){
			$html='
				
					<div class="col-md-3">
						<label>
							Entrada
						</label>
							<input id="entrada" class="form-control"  type="text" name="entrada" value="'.$this->entrada.'" />
					</div>

			';
			return $html;
		}
		public function salida(){
			$html='
				
					<div class="col-md-3">
						<label>
							Salida
						</label>
							<input id="salida" class="form-control"  type="text" name="salida" value="'.$this->salida.'" />
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
		public function rank(){
			$html='
				
					<div class="col-md-3">
						<label>
							Rank
						</label>
							<input id="rank" class="form-control"  type="text" name="rank" value="'.$this->rank.'" />
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
		public function imagen(){
			$html='
				
					<div class="col-md-3">
						<label>
							Imagen
						</label>
							<input id="imagen" class="form-control"  type="text" name="imagen" value="'.$this->imagen.'" />
					</div>

			';
			return $html;
		}
		public function imagen_peque(){
			$html='
				
					<div class="col-md-3">
						<label>
							Imagen pequeña
						</label>
							<input id="imagen_peque" class="form-control"  type="text" name="imagen_peque" value="'.$this->imagen_peque.'" />
					</div>

			';
			return $html;
		}
		public function imagen_tipo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tipo de imagen
						</label>
							<input id="imagen_tipo" class="form-control"  type="text" name="imagen_tipo" value="'.$this->imagen_tipo.'" />
					</div>

			';
			return $html;
		}
		public function ejemplo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Ejemplo
						</label>
							<input id="ejemplo" class="form-control"  type="text" name="ejemplo" value="'.$this->ejemplo.'" />
					</div>

			';
			return $html;
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
