
<?php 
require_once("modelo/class_configuracion.php");
	class campo_configuracion extends configuracion{
		
		public function cod_configuracion(){
			$html='<input id="cod_configuracion" class="form-control" type="hidden" name="cod_configuracion" value="'.$this->cod_configuracion.$ultimo_id.'" />';
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
		public function valor(){
			$html='
				
					<div class="col-md-3">
						<label>
							Valor
						</label>
							<input id="valor" class="form-control"  type="text" name="valor" value="'.$this->valor.'" />
					</div>

			';
			return $html;
		}
		public function tipo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tipo
						</label>
							<input id="tipo" class="form-control"  type="text" name="tipo" value="'.$this->tipo.'" />
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
	}
	
?>
