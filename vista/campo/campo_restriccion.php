
<?php 
require_once("modelo/class_restriccion.php");
	class campo_restriccion extends restriccion{
		
		public function cod_restriccion(){
			$html='<input id="cod_restriccion" class="form-control" type="hidden" name="cod_restriccion" value="'.$this->cod_restriccion.$ultimo_id.'" />';
			return $html;
		}
		public function nombre(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre
						</label>
							<input id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
					</div>

			';
			return $html;
		}
		public function restricciones(){
			$html='
				
					<div class="col-md-3">
						<label>
							Restricción
						</label>
							<input id="restricciones" class="form-control"  type="text" name="restricciones" value="'.$this->restricciones.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
