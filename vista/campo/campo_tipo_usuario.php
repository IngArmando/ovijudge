
<?php 
require_once("modelo/class_tipo_usuario.php");
	class campo_tipo_usuario extends tipo_usuario{
		
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
