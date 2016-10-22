
<?php 
require_once("modelo/class_privilegio.php");
	class campo_privilegio extends privilegio{
		
		public function cod_privilegio(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_privilegio
						</label>
							<input id="cod_privilegio" class="form-control"  type="text" name="cod_privilegio" value="'.$this->cod_privilegio.'" />
					</div>

			';
			return $html;
		}
		public function cod_vista_sistema(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_vista_sistema
						</label>
							<input id="cod_vista_sistema" class="form-control"  type="text" name="cod_vista_sistema" value="'.$this->cod_vista_sistema.'" />
					</div>

			';
			return $html;
		}
		public function cod_tipo_usuario(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_tipo_usuario
						</label>
							<input id="cod_tipo_usuario" class="form-control"  type="text" name="cod_tipo_usuario" value="'.$this->cod_tipo_usuario.'" />
					</div>

			';
			return $html;
		}
		public function registrar(){
			$html='
				
					<div class="col-md-3">
						<label>
							registrar
						</label>
							<input id="registrar" class="form-control"  type="text" name="registrar" value="'.$this->registrar.'" />
					</div>

			';
			return $html;
		}
		public function consultar(){
			$html='
				
					<div class="col-md-3">
						<label>
							consultar
						</label>
							<input id="consultar" class="form-control"  type="text" name="consultar" value="'.$this->consultar.'" />
					</div>

			';
			return $html;
		}
		public function eliminar(){
			$html='
				
					<div class="col-md-3">
						<label>
							eliminar
						</label>
							<input id="eliminar" class="form-control"  type="text" name="eliminar" value="'.$this->eliminar.'" />
					</div>

			';
			return $html;
		}
		public function actualizar(){
			$html='
				
					<div class="col-md-3">
						<label>
							actualizar
						</label>
							<input id="actualizar" class="form-control"  type="text" name="actualizar" value="'.$this->actualizar.'" />
					</div>

			';
			return $html;
		}
		public function desactivar(){
			$html='
				
					<div class="col-md-3">
						<label>
							desactivar
						</label>
							<input id="desactivar" class="form-control"  type="text" name="desactivar" value="'.$this->desactivar.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
