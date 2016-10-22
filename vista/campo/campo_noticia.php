
<?php 
require_once("modelo/class_noticia.php");
	class campo_noticia extends noticia{
		
		public function cod_noticia(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_noticia
						</label>
							<input id="cod_noticia" class="form-control"  type="text" name="cod_noticia" value="'.$this->cod_noticia.'" />
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
		public function fecha_creacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							fecha_creacion
						</label>
							<input id="fecha_creacion" class="form-control"  type="text" name="fecha_creacion" value="'.$this->fecha_creacion.'" />
					</div>

			';
			return $html;
		}
		public function fecha_expiracion(){
			$html='
				
					<div class="col-md-3">
						<label>
							fecha_expiracion
						</label>
							<input id="fecha_expiracion" class="form-control"  type="text" name="fecha_expiracion" value="'.$this->fecha_expiracion.'" />
					</div>

			';
			return $html;
		}
		public function imagen(){
			$html='
				
					<div class="col-md-3">
						<label>
							imagen
						</label>
							<input id="imagen" class="form-control"  type="text" name="imagen" value="'.$this->imagen.'" />
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
