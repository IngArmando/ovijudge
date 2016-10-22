
<?php 
require_once("modelo/class_bitacora.php");
	class campo_bitacora extends bitacora{
		
		public function cod_bitacora(){
			$html='<input id="cod_bitacora" class="form-control" type="hidden" name="cod_bitacora" value="'.$this->cod_bitacora.$ultimo_id.'" />';
			return $html;
		}
		public function evento(){
			$html='
				
					<div class="col-md-3">
						<label>
							Evento
						</label>
							<input id="evento" class="form-control"  type="text" name="evento" value="'.$this->evento.'" />
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
		public function fecha_hora_timestamp(){
			$html='
				
					<div class="col-md-3">
						<label>
							Fecha y hora
						</label>
							<input id="fecha_hora_timestamp" class="form-control"  type="text" name="fecha_hora_timestamp" value="'.$this->fecha_hora_timestamp.'" />
					</div>

			';
			return $html;
		}
		public function cod_usuario(){
			$html='
				
					<div class="col-md-3">
						<label>
							Usuario
						</label>
							'.$this->combo_cod_usuario().'
					</div>

			';
			return $html;
		}
	public function combo_cod_usuario(){
		include_once("modelo/class_usuario.php");
		$usuario = new usuario;
		$usuario->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_usuario" class="form-control" name="cod_usuario" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_usuario = $usuario->row()){
			$salida.= '<option value="'.$row_usuario["cod_usuario"].'"';	
			if($row_usuario["cod_usuario"]== $this->cod_usuario) $salida.= " selected ";									
			$salida.= '>'.$row_usuario["cedula"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=usuario&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_usuario($valor){
	include_once("modelo/class_usuario.php");
	$usuario = new usuario;
	$usuario->set_cod_usuario($valor);
	$usuario->consultar();
	$arreglo=$usuario->row();
	return $arreglo['cedula'];
}

	}
	
?>
