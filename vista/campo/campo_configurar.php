
<?php 
require_once("modelo/class_configurar.php");
	class campo_configurar extends configurar{
		
		public function caducidad(){
			$html='
				
					<div class="col-md-3">
						<label>
							caducidad
						</label>
							<input id="caducidad" class="form-control"  type="text" name="caducidad" value="'.$this->caducidad.'" />
					</div>

			';
			return $html;
		}
		public function pregunta_crear(){
			$html='
				
					<div class="col-md-3">
						<label>
							pregunta_crear
						</label>
							<input id="pregunta_crear" class="form-control"  type="text" name="pregunta_crear" value="'.$this->pregunta_crear.'" />
					</div>

			';
			return $html;
		}
		public function pregunta_mostrar(){
			$html='
				
					<div class="col-md-3">
						<label>
							pregunta_mostrar
						</label>
							<input id="pregunta_mostrar" class="form-control"  type="text" name="pregunta_mostrar" value="'.$this->pregunta_mostrar.'" />
					</div>

			';
			return $html;
		}
		public function intentos_fallidos(){
			$html='
				
					<div class="col-md-3">
						<label>
							intentos_fallidos
						</label>
							<input id="intentos_fallidos" class="form-control"  type="text" name="intentos_fallidos" value="'.$this->intentos_fallidos.'" />
					</div>

			';
			return $html;
		}
		public function inactividad(){
			$html='
				
					<div class="col-md-3">
						<label>
							inactividad
						</label>
							<input id="inactividad" class="form-control"  type="text" name="inactividad" value="'.$this->inactividad.'" />
					</div>

			';
			return $html;
		}
		public function fecha_hora(){
			$html='
				
					<div class="col-md-3">
						<label>
							fecha_hora
						</label>
							<input id="fecha_hora" class="form-control"  type="text" name="fecha_hora" value="'.$this->fecha_hora.'" />
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
