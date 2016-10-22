
<?php 
require_once("modelo/class_categoria.php");
	class campo_categoria extends categoria{
		
		public function cod_categoria(){
			$html='<input id="cod_categoria" class="form-control" type="hidden" name="cod_categoria" value="'.$this->cod_categoria.$ultimo_id.'" />';
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
		public function ordenado(){
			$html='
				
					<div class="col-md-3">
						<label>
							Ordenado
						</label>
							<input id="ordenado" class="form-control"  type="text" name="ordenado" value="'.$this->ordenado.'" />
					</div>

			';
			return $html;
		}
		public function color(){
			$html='
				
					<div class="col-md-3">
						<label>
							Color
						</label>
							<input id="color" class="form-control"  type="text" name="color" value="'.$this->color.'" />
					</div>

			';
			return $html;
		}
		public function status(){
			$html='
				
					<div class="col-md-3">
						<label>
							Estatus
						</label>
							<input id="status" class="form-control"  type="text" name="status" value="'.$this->status.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
