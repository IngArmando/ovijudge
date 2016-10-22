
<?php 
require_once("modelo/class_pais.php");
	class campo_pais extends pais{
		
		public function cod_pais(){
			$html='
				
					<div class="col-md-3">
						<label>
							cod_pais
						</label>
							<input id="cod_pais" class="form-control"  type="text" name="cod_pais" value="'.$this->cod_pais.'" />
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
