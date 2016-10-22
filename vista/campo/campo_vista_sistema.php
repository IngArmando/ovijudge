<?php
require_once("modelo/class_vista_sistema.php");
class campo_vista_sistema extends vista_sistema{
		
		public function cod_vista_sistema(){
			return '<input type="hidden" name="cod_vista_sistema" value="$this->cod_vista_sistema">';
		}
		public function nombre(){
			return '
			<div class="col-md-3">
			<label>
				Nombre del archivo<span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input id="nombre" class="form-control"  type="text"  name="nombre" value="'.$this->nombre.'" />
			</div>';
		}
		public function descripcion(){
			return '
					<div class="col-md-6">
			<label>
				Descripción <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input id="descripcion" class="form-control"  type="text" name="descripcion" value="'.$this->descripcion.'" />
		</div>
			
			';
		}
		public function tipo_apertura(){
			return'
					<div class="col-md-3 ">
			<label>
				Ventana<span style="color:red" title="Campo obligatorio">(*)</span>
			</label><br>
				<input required type="radio" name="tipo_apertura" value="0" '.($this->tipo_apertura ? '' : 'checked').' > Misma (_SELF)
				<input required type="radio" name="tipo_apertura" value="1" '.($this->tipo_apertura ? 'checked' : '').'> Aparte (_BLANK)
		</div>';
		
		}
		public function visible(){
			return'
					<div class="col-md-3 ">
			<label>
				Visible<span style="color:red" title="Campo obligatorio">(*)</span>
			</label><br>
				<input required type="radio" name="visible" value="0" '.($this->visible ? '' : 'checked').' > NO
				<input required type="radio" name="visible" value="1" '.($this->visible ? 'checked' : '').'> SI
		</div>';
		
		}
		public function cod_servicio(){
			return '
					<div class="col-md-6">
			<label>
				Servicio <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				'.$this->combo_cod_servicio().'
		</div>
			';
		}
		public function eventos_vista(){
			return '<div class="col-md-6">
			<label>
				Eventos de la vista
			</label><br>
				<input type="checkbox" name="consultar" value="1" '.($this->consultar=='1' ? 'checked' : '').' > Consultar
				<input type="checkbox" name="registrar" value="1" '.($this->registrar=='1' ? 'checked' : '').' > Registrar
				<input type="checkbox" name="actualizar" value="1" '.($this->actualizar=='1' ? 'checked' : '').' > Modificar
				<input type="checkbox" name="eliminar" value="1" '.($this->eliminar=='1' ? 'checked' : '').' > Eliminar
				<input type="checkbox" name="desactivar" value="1" '.($this->desactivar=='1' ? 'checked' : '').' > Desactivar
				
		</div>';
			
		}
		private function combo_cod_servicio(){
				include_once("modelo/class_servicio.php");
				$servicio = new servicio;
				$servicio->listar();
				$salida.= '<div class="input-group">

				';
				$salida.= '<select  id="cod_servicio" class="form-control" name="cod_servicio" >'; 
				$salida.= '<option value="">Seleccione</option>';
				while($row_servicio = $servicio->row()){
					$salida.= '<option value="'.$row_servicio["cod_servicio"].'"';	
					if($row_servicio["cod_servicio"]== $this->cod_servicio) $salida.= " selected ";									
					$salida.= '>'.$row_servicio["nombre"].' ('.$row_servicio["nombre_modulo"].')</option>';
				}
				$salida.= '</select>';
				$salida.= '<span class="input-group-btn">
				<a href="?vista=servicio&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
				

				</span>
				
				</div>';
				return $salida;
			}
		
}
?>
