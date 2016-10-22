<?php 
require_once("modelo/class_ejecutable.php");
	class campo_ejecutable extends ejecutable{
		
		public function cod_ejecutable($readonly){
			$html='
				
					<div class="col-md-3">
						<label>
							Codigo <span style="float:right; color:red">(*)</span>
						</label>
							<input '.$readonly.' required id="cod_ejecutable" class="form-control"  type="text" name="cod_ejecutable" value="'.$this->cod_ejecutable.'" />
					</div>

			';
			return $html;
		}
		public function zipfile($required){
			$html='
				
					<div class="col-md-3">
						<label>
							Archivo Zip <span style="float:right; color:red">(*)</span>
						</label>
							<input '.$required.' id="zipfile"  type="file" name="zipfile" />
					</div>

			';
			return $html;
		}
		public function descripcion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Descripcion <span style="float:right; color:red">(*)</span>
						</label>
							<input required id="descripcion" class="form-control"  type="text" name="descripcion" value="'.$this->descripcion.'" />
					</div>

			';
			return $html;
		}
		public function tipo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tipo <span style="float:right; color:red">(*)</span>
						</label>
						<select required name="tipo" class="form-control" id="tipo">
							<option value="compare" '.($this->tipo=="compare" ? 'selected' : '').' >compare</option>
							<option value="compile" '.($this->tipo=="compile" ? 'selected' : '').'>compile</option>
							<option value="run" '.($this->tipo=="run" ? 'selected' : '').'>run</option>
						</select>
					</div>

			';
			return $html;
		}
	}
	
?>
