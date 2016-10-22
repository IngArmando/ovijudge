
<?php 
require_once("modelo/class_det_equipo_clarificacion.php");
	class campo_det_equipo_clarificacion extends det_equipo_clarificacion{
		
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
		public function cod_clarificacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_clarificacion
						</label>
							<input id="cod_clarificacion" class="form-control"  type="text" name="cod_clarificacion" value="'.$this->cod_clarificacion.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
