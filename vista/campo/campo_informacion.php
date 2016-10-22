
<?php 
require_once("modelo/class_informacion.php");
	class campo_informacion extends informacion{
		
		public function cod_informacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_informacion
						</label>
							<input id="cod_informacion" class="form-control"  type="text" name="cod_informacion" value="'.$this->cod_informacion.'" />
					</div>

			';
			return $html;
		}
		public function titulo(){
			$html='
				
					<div class="col-md-3">
						<label>
							titulo
						</label>
							<input id="titulo" class="form-control"  type="text" name="titulo" value="'.$this->titulo.'" />
					</div>

			';
			return $html;
		}
		public function descripcion(){
			$html='
				
					<div class="col-md-3">
						<label>
							descripcion
						</label>
							<input id="descripcion" class="form-control"  type="text" name="descripcion" value="'.$this->descripcion.'" />
					</div>

			';
			return $html;
		}
		public function cod_usuario(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_usuario
						</label>
							<input id="cod_usuario" class="form-control"  type="text" name="cod_usuario" value="'.$this->cod_usuario.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
