<?php 
require_once("modelo/class_concurso.php");
	class campo_concurso extends concurso{
		
		public function cod_concurso(){
			$html='<input id="cod_concurso" class="form-control" type="hidden" name="cod_concurso" value="'.$this->cod_concurso.$ultimo_id.'" />';
			return $html;
		}
		public function nombre(){
			$html='
				
					<div class="col-md-6">
						<label>
							Nombre completo
						</label>
							<input maxlength="180" title="Solo texto y numeros" pattern="^[a-zA-Z0-9 \u00C0-\u00ff\s]+$" required id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
					</div>

			';
			return $html;
		}
		public function nombre_corto(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre corto
						</label>
							<input maxlength="90" title="Solo texto y numeros" pattern="^[a-zA-Z0-9 \u00C0-\u00ff\s]+$" required id="nombre_corto" class="form-control"  type="text" name="nombre_corto" value="'.$this->nombre_corto.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_activo(){
		
			$html='
				
			<div class="col-md-3">
						<label>
							Fecha y hora de activación
						</label>
				<div class="form-group">
					<div class="input-group date" id="tiempo_activo">
						<input  required name="tiempo_activo" value="'.$this->tiempo_activo.'" type="text" class="form-control" />
						<span class="input-group-addon">
							 <span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
						
			</div>

			';
			return $html;
		}
		public function tiempo_inicio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Fecha y hora de inicio
						</label>
							
				<div class="form-group">
					<div class="input-group date" id="tiempo_inicio">
						<input required name="tiempo_inicio" value="'.$this->tiempo_inicio.'" type="text" class="form-control" />
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
							
							
					</div>

			';
			return $html;
		}
		public function tiempo_conjelacion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Congelar resultados
						</label>
						<div class="form-group">
							<div class="input-group date" id="tiempo_conjelacion">
								<input required name="tiempo_conjelacion" value="'.$this->tiempo_conjelacion.'" type="text" class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

			';
			return $html;
		}
		public function tiempo_final(){
			$html='
				
					<div class="col-md-3">
						<label>
							Finalizar concurso
						</label>
					<div class="form-group">
						<div class="input-group date" id="tiempo_final">
							<input required name="tiempo_final" value="'.$this->tiempo_final.'" type="text" class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
					</div>

			';
			return $html;
		}
		public function tiempo_desconjelar(){
			$html='
				
					<div class="col-md-3">
						<label>
							Mostrar resultados
						</label>
						<div class="form-group">
							<div class="input-group date" id="tiempo_desconjelar">
								<input required name="tiempo_desconjelar" value="'.$this->tiempo_desconjelar.'" type="text" class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

			';
			return $html;
		}
		public function tiempo_inactivo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Fecha y hora de desactivación
						</label>
						<div class="form-group">
							<div class="input-group date" id="tiempo_inactivo">
								<input required name="tiempo_inactivo" value="'.$this->tiempo_inactivo.'" type="text" class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

			';
			return $html;
		}
		public function tiempo_activo_string(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo activo String
						</label>
							<input id="tiempo_activo_string" class="form-control"  type="text" name="tiempo_activo_string" value="'.$this->tiempo_activo_string.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_inicio_string(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo inicio String
						</label>
							<input id="tiempo_inicio_string" class="form-control"  type="text" name="tiempo_inicio_string" value="'.$this->tiempo_inicio_string.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_conjelacion_string(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo de congelación String
						</label>
							<input id="tiempo_conjelacion_string" class="form-control"  type="text" name="tiempo_conjelacion_string" value="'.$this->tiempo_conjelacion_string.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_final_string(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo final String
						</label>
							<input id="tiempo_final_string" class="form-control"  type="text" name="tiempo_final_string" value="'.$this->tiempo_final_string.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_desconjelar_string(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo desconjelar String
						</label>
							<input id="tiempo_desconjelar_string" class="form-control"  type="text" name="tiempo_desconjelar_string" value="'.$this->tiempo_desconjelar_string.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_inactivo_string(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo inactivo String
						</label>
							<input id="tiempo_inactivo_string" class="form-control"  type="text" name="tiempo_inactivo_string" value="'.$this->tiempo_inactivo_string.'" />
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
		public function globo_procesado(){
			$html='
				
					<div class="col-md-3">
						<label>
							Usara globos? 
						</label><br>
							<input type="radio" value="1" name="globo_procesado" '.($this->globo_procesado ? 'checked' : '').' />Si
							<input type="radio" value="0" name="globo_procesado" '.($this->globo_procesado ? '' : 'checked').' />No
							
					</div>

			';
			return $html;
		}
		public function publico(){
			$html='
				
					<div class="col-md-3">
						<label>
							Concurso publico?
						</label>
							<br>
							<input value="1" required type="radio" name="publico" '.($this->publico ? 'checked' : '').' />Si
							<input value="0" required type="radio" name="publico" '.($this->publico ? '' : 'checked').' />No
							
					</div>

			';
			return $html;
		}
	}
	
?>
