
<?php 
require_once("modelo/class_det_concurso_equipo.php");
	class campo_det_concurso_equipo extends det_concurso_equipo{
		
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
	}
	
?>
