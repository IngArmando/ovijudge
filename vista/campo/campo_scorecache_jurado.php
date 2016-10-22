
<?php 
require_once("modelo/class_scorecache_jurado.php");
	class campo_scorecache_jurado extends scorecache_jurado{
		
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
		public function cod_equipo(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_equipo
						</label>
							<input id="cod_equipo" class="form-control"  type="text" name="cod_equipo" value="'.$this->cod_equipo.'" />
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
		public function cant_envios(){
			$html='
				
					<div class="col-md-3">
						<label>
							cant_envios
						</label>
							<input id="cant_envios" class="form-control"  type="text" name="cant_envios" value="'.$this->cant_envios.'" />
					</div>

			';
			return $html;
		}
		public function pendiente(){
			$html='
				
					<div class="col-md-3">
						<label>
							pendiente
						</label>
							<input id="pendiente" class="form-control"  type="text" name="pendiente" value="'.$this->pendiente.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_total(){
			$html='
				
					<div class="col-md-3">
						<label>
							tiempo_total
						</label>
							<input id="tiempo_total" class="form-control"  type="text" name="tiempo_total" value="'.$this->tiempo_total.'" />
					</div>

			';
			return $html;
		}
		public function status(){
			$html='
				
					<div class="col-md-3">
						<label>
							status
						</label>
							<input id="status" class="form-control"  type="text" name="status" value="'.$this->status.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
