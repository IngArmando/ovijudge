<?php 
require_once("modelo/class_problema.php");
	class campo_problema extends problema{
		
		public function cod_problema(){
			$html='<input id="cod_problema" class="form-control" type="hidden" name="cod_problema" value="'.$this->cod_problema.$ultimo_id.'" />';
			return $html;
		}
		public function nombre(){
			$html='
				
					<div class="col-md-3">
						<label>
							Titulo <span style="float:right; color:red" title="campo obligatorio"> (*) </span>
						</label>
							<input required id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
					</div>

			';
			return $html;
		}
		public function limite_tiempo(){
			$html='
				
					<div class="col-md-2">
						
							<label>
								Limite de tiempo<span style="float:right; color:red" title="campo obligatorio"> (*) </span>
							</label>
							<div class="input-group">
								<input required  min="1" id="limite_tiempo" class="form-control"  type="number" name="limite_tiempo" value="'.$this->limite_tiempo.'" />
								<div required title="Segundos" class="input-group-addon">Seg.</div>
							</div>

					</div>

			';
			return $html;
		}
		public function limite_memoria(){
			$html='
				
					<div class="col-md-2">
						<label>
							Limite de memoria <span style="float:right; color:red" title="campo obligatorio"> (*) </span>
						</label>
							<div class="input-group">
							<input required min="1024" id="limite_memoria" class="form-control"  type="number" name="limite_memoria" value="'.$this->limite_memoria.'" />
								<div title="Kilobyte" class="input-group-addon">kB</div>
							</div>
					</div>

			';
			return $html;
		}


		public function texto_problema(){
			$html='
				
					<div class="col-md-4">
						<label>
							Adjuntar Imagen <span style="font-size:12px">Formatos aceptados: JPEG, PNG, GIF</span>
						</label>
						'.($this->texto_problema ? '<input id="url_imagen" value="'.$this->texto_problema.'" type="hidden" name="texto_problema_viejo">  <img id="foto_imagen" width="80px" src="'.$this->texto_problema.'"> <a id="btn_eliminar" href="#" onclick="eliminar_imagen()">Eliminar imagen</a> <input style="display:none" id="input_agregar_img" type="file" name="texto_problema">' : '<input  type="file" name="texto_problema">').'
							
							
							
					</div>
					<script>
					function eliminar_imagen(){
						document.getElementById("url_imagen").value="";
						document.getElementById("foto_imagen").style.display="none";
						document.getElementById("btn_eliminar").style.display="none";
						document.getElementById("input_agregar_img").style.display="inline";
					return false;
					}
					</script>

			';
			return $html;
		}
		public function enunciado(){
			$html='
				
					<div class="col-md-12">
						<label>
							Enunciado del problema 
						</label><span style=" color:red" title="campo obligatorio"> (*) </span> <span style="font-size:12px">Verifique la integridad del PDF generado luego de agregar o modificar el enunciado.</span>
							<textarea id="enunciado" name="enunciado" class="form-control" >'.$this->enunciado.'</textarea>
							
					</div>

			';
			return $html;
		}
		public function tipo_texto_problema(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tipo de texto del problema
						</label>
							<input  id="tipo_texto_problema" class="form-control"  type="text" name="tipo_texto_problema" value="'.$this->tipo_texto_problema.'" />
					</div>

			';
			return $html;
		}
		public function cod_caso_de_prueba(){
			$html='<input id="cod_caso_de_prueba" class="form-control" type="hidden" name="cod_caso_de_prueba" value="'.$this->cod_caso_de_prueba.$ultimo_id.'" />';
			return $html;
		}
		public function md5sum_entrada(){
			$html='
				
					<div class="col-md-3">
						<label>
							md5sum de entrada
						</label>
							<input id="md5sum_entrada" class="form-control"  type="text" name="md5sum_entrada" value="'.$this->md5sum_entrada.'" />
					</div>

			';
			return $html;
		}
		public function md5sum_salida(){
			$html='
				
					<div class="col-md-3">
						<label>
							md5sum de salida
						</label>
							<input id="md5sum_salida" class="form-control"  type="text" name="md5sum_salida" value="'.$this->md5sum_salida.'" />
					</div>

			';
			return $html;
		}
		public function entrada(){
			$html='
				
					<div class="col-md-3">
						<label>
							Entrada
						</label>
							<input id="entrada" class="form-control"  type="text" name="entrada" value="'.$this->entrada.'" />
					</div>

			';
			return $html;
		}
		public function salida(){
			$html='
				
					<div class="col-md-3">
						<label>
							Salida
						</label>
							<input id="salida" class="form-control"  type="text" name="salida" value="'.$this->salida.'" />
					</div>

			';
			return $html;
		}
		public function rank(){
			$html='
				
					<div class="col-md-3">
						<label>
							Rank
						</label>
							<input id="rank" class="form-control"  type="text" name="rank" value="'.$this->rank.'" />
					</div>

			';
			return $html;
		}
		public function descripcion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Descripción
						</label>
							<input id="descripcion" class="form-control"  type="text" name="descripcion" value="'.$this->descripcion.'" />
					</div>

			';
			return $html;
		}
		public function imagen(){
			$html='
				
					<div class="col-md-3">
						<label>
							Imagen
						</label>
							<input id="imagen" class="form-control"  type="text" name="imagen" value="'.$this->imagen.'" />
					</div>

			';
			return $html;
		}
		public function imagen_peque(){
			$html='
				
					<div class="col-md-3">
						<label>
							Imagen pequeña
						</label>
							<input id="imagen_peque" class="form-control"  type="text" name="imagen_peque" value="'.$this->imagen_peque.'" />
					</div>

			';
			return $html;
		}
		public function imagen_tipo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tipo de imagen
						</label>
							<input id="imagen_tipo" class="form-control"  type="text" name="imagen_tipo" value="'.$this->imagen_tipo.'" />
					</div>

			';
			return $html;
		}
		public function ejemplo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Ejemplo
						</label>
							<input id="ejemplo" class="form-control"  type="text" name="ejemplo" value="'.$this->ejemplo.'" />
					</div>

			';
			return $html;
		}
	}
	
?>
