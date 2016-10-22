
<?php 
require_once("modelo/class_modulo.php");
	class campo_modulo extends modulo{
		
		public function cod_modulo(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_modulo
						</label>
							<input id="cod_modulo" class="form-control"  type="text" name="cod_modulo" value="'.$this->cod_modulo.'" />
					</div>

			';
			return $html;
		}
		public function nombre(){
			$html='
				
					<div class="col-md-3">
						<label>
							nombre
						</label>
							<input id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
					</div>

			';
			return $html;
		}
		public function observacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							observacion
						</label>
							<input id="observacion" class="form-control"  type="text" name="observacion" value="'.$this->observacion.'" />
					</div>

			';
			return $html;
		}
		public function estatus(){
			$html='
				
					<div class="col-md-3">
						<label>
							estatus
						</label>
							<input id="estatus" class="form-control"  type="text" name="estatus" value="'.$this->estatus.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
