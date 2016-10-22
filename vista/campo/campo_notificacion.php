
<?php 
require_once("modelo/class_notificacion.php");
	class campo_notificacion extends notificacion{
		
		public function cod_notificacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_notificacion
						</label>
							<input id="cod_notificacion" class="form-control"  type="text" name="cod_notificacion" value="'.$this->cod_notificacion.'" />
					</div>

			';
			return $html;
		}
		public function mensaje(){
			$html='
				
					<div class="col-md-3">
						<label>
							mensaje
						</label>
							<input id="mensaje" class="form-control"  type="text" name="mensaje" value="'.$this->mensaje.'" />
					</div>

			';
			return $html;
		}
		public function url(){
			$html='
				
					<div class="col-md-3">
						<label>
							url
						</label>
							<input id="url" class="form-control"  type="text" name="url" value="'.$this->url.'" />
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
		public function fecha(){
			$html='
				
					<div class="col-md-3">
						<label>
							fecha
						</label>
							<input id="fecha" class="form-control"  type="text" name="fecha" value="'.$this->fecha.'" />
					</div>

			';
			return $html;
		}
		public function fecha_comparar(){
			$html='
				
					<div class="col-md-3">
						<label>
							fecha_comparar
						</label>
							<input id="fecha_comparar" class="form-control"  type="text" name="fecha_comparar" value="'.$this->fecha_comparar.'" />
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
