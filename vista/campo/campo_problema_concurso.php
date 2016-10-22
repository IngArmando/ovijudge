<?php 
require_once("modelo/class_problema_concurso.php");
	class campo_problema_concurso extends problema_concurso{
		
		public function cod_concurso(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_concurso
						</label>
							<input id="cod_concurso" class="form-control"  type="text" name="cod_concurso" value="'.$this->cod_concurso.'" />
					</div>

			';
			return $html;
		}
		public function cod_problema(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_problema
						</label>
							<input id="cod_problema" class="form-control"  type="text" name="cod_problema" value="'.$this->cod_problema.'" />
					</div>

			';
			return $html;
		}
		public function nombre_corto(){
			$html='
				
					<div class="col-md-3">
						<label>
							nombre_corto
						</label>
							<input id="nombre_corto" class="form-control"  type="text" name="nombre_corto" value="'.$this->nombre_corto.'" />
					</div>

			';
			return $html;
		}
		public function puntos(){
			$html='
				
					<div class="col-md-3">
						<label>
							puntos
						</label>
							<input id="puntos" class="form-control"  type="text" name="puntos" value="'.$this->puntos.'" />
					</div>

			';
			return $html;
		}
		public function permitir_envio(){
			$html='
				
					<div class="col-md-3">
						<label>
							permitir_envio
						</label>
							<input id="permitir_envio" class="form-control"  type="text" name="permitir_envio" value="'.$this->permitir_envio.'" />
					</div>

			';
			return $html;
		}
		public function permitir_juez(){
			$html='
				
					<div class="col-md-3">
						<label>
							permitir_juez
						</label>
							<input id="permitir_juez" class="form-control"  type="text" name="permitir_juez" value="'.$this->permitir_juez.'" />
					</div>

			';
			return $html;
		}
		public function color(){
			$html='
				
					<div class="col-md-3">
						<label>
							color
						</label>
							<input id="color" class="form-control"  type="text" name="color" value="'.$this->color.'" />
					</div>

			';
			return $html;
		}
		public function lenta_eval_resultado(){
			$html='
				
					<div class="col-md-3">
						<label>
							lenta_eval_resultado
						</label>
							<input id="lenta_eval_resultado" class="form-control"  type="text" name="lenta_eval_resultado" value="'.$this->lenta_eval_resultado.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
