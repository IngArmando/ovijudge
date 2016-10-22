
<?php 
require_once("modelo/class_institucion.php");
	class campo_institucion extends institucion{
		
		public function cod_institucion(){
			$html='<input id="cod_institucion" class="form-control" type="hidden" name="cod_institucion" value="'.$this->cod_institucion.$ultimo_id.'" />';
			return $html;
		}
		public function nombre_corto(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre corto <span style="float:right; color:red">(*)</span>
						</label>
							<input required id="nombre_corto" class="form-control"  type="text" name="nombre_corto" value="'.$this->nombre_corto.'" />
					</div>

			';
			return $html;
		}
		public function nombre(){
			$html='
				
					<div class="col-md-6">
						<label>
							Nombre <span style="float:right; color:red">(*)</span>
						</label>
							<input autofocus required id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
					</div>

			';
			return $html;
		}

		public function descripcion(){
			$html='
				
					<div class="col-md-6">
						<label>
							Descripción
						</label>
							<textarea class="form-control" name="descripcion">'.$this->descripcion.'</textarea>
							
					</div>

			';
			return $html;
		}
	}
	
?>
