
<?php 
require_once("modelo/class_bloqueo_ip.php");
	class campo_bloqueo_ip extends bloqueo_ip{
		
		public function cod_bloqueo_ip(){
			$html='<input id="cod_bloqueo_ip" class="form-control" type="hidden" name="cod_bloqueo_ip" value="'.$this->cod_bloqueo_ip.$ultimo_id.'" />';
			return $html;
		}
		public function ip(){
			$html='
				
					<div class="col-md-3">
						<label>
							Ip
						</label>
							<input id="ip" class="form-control"  type="text" name="ip" value="'.$this->ip.'" />
					</div>

			';
			return $html;
		}
		public function agente(){
			$html='
				
					<div class="col-md-3">
						<label>
							Agente
						</label>
							<input id="agente" class="form-control"  type="text" name="agente" value="'.$this->agente.'" />
					</div>

			';
			return $html;
		}
		public function fecha_hora(){
			$html='
				
					<div class="col-md-3">
						<label>
							Fecha y hora
						</label>
							<input id="fecha_hora" class="form-control"  type="text" name="fecha_hora" value="'.$this->fecha_hora.'" />
					</div>

			';
			return $html;
		}
		public function estatus(){
			$html='
				
					<div class="col-md-3">
						<label>
							Estatus
						</label>
							<input id="estatus" class="form-control"  type="text" name="estatus" value="'.$this->estatus.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
