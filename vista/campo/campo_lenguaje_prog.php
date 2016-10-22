
<?php 
require_once("modelo/class_lenguaje_prog.php");
	class campo_lenguaje_prog extends lenguaje_prog{
		
		public function cod_lenguaje_prog(){
			$html='<input id="cod_lenguaje_prog" class="form-control" type="hidden" name="cod_lenguaje_prog" value="'.$this->cod_lenguaje_prog.$ultimo_id.'" />';
			return $html;
		}
		public function nombre(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre <span style="float:right; color:red">(*)</span>
						</label>
							<input required id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
					</div>

			';
			return $html;
		}
		public function extensiones(){
			
			$html='
				
					<div class="col-md-3">
						<label>
							Extensión (en formato JSON) <span style="float:right; color:red">(*)</span>
						</label>																																	
							<input placeholder=\'ejemplo: ["cpp","cc","c++"]\' required id="extensiones" class="form-control"  type="text" name="extensiones" value=\''.$this->extensiones.'\' />
					</div>

			';
			return $html;
		}
		public function permitir_envio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Permitir envio <span style="float:right; color:red">(*)</span>
						</label><br>
							<input type="radio" value="1" name="permitir_envio" '.($this->permitir_envio ? 'checked' : '').' />Si
							<input type="radio" value="0" name="permitir_envio" '.($this->permitir_envio ? '' : 'checked').' />No
							
					</div>

			';
			return $html;
		}
		public function permitir_juez(){
			$html='
				
					<div class="col-md-3">
						<label>
							Permitir juez <span style="float:right; color:red">(*)</span>
						</label><br>
							<input type="radio" value="1" name="permitir_juez" '.($this->permitir_juez ? 'checked' : '').' />Si
							<input type="radio" value="0" name="permitir_juez" '.($this->permitir_juez ? '' : 'checked').' />No
							
					</div>

			';
			return $html;
		}
		public function factor_tiempo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Factor tiempo, por defecto 1 <span style="float:right; color:red">(*)</span>
						</label>
							<input required id="factor_tiempo" class="form-control"  type="number" min="1" name="factor_tiempo" value="'.($this->factor_tiempo ? $this->factor_tiempo : '1').'" />
					</div>

			';
			return $html;
		}
		public function comando(){
			$html='
				
					<div class="col-md-3">
						<label>
							Comando de ejecución (UNIX) <span style="float:right; color:red">(*)</span>
						</label> 
							<input required id="cod_lenguaje_prog" class="form-control"  type="text" name="comando" value="'.$this->comando.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
