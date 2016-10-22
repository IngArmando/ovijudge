
<?php 
require_once("modelo/class_rankcache_jurado.php");
	class campo_rankcache_jurado extends rankcache_jurado{
		
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
		public function total_tiempo(){
			$html='
				
					<div class="col-md-3">
						<label>
							total_tiempo
						</label>
							<input id="total_tiempo" class="form-control"  type="text" name="total_tiempo" value="'.$this->total_tiempo.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
