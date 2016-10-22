
<?php 
require_once("modelo/class_rankcache_publico.php");
	class campo_rankcache_publico extends rankcache_publico{
		
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
	}
	
?>
