
<?php 
require_once("modelo/class_historial_clave.php");
	class campo_historial_clave extends historial_clave{
		
		public function cod_historial_clave(){
			$html='<input id="cod_historial_clave" class="form-control" type="hidden" name="cod_historial_clave" value="'.$this->cod_historial_clave.$ultimo_id.'" />';
			return $html;
		}
		public function clave(){
			$html='
				
					<div class="col-md-3">
						<label>
							Clave
						</label>
							<input id="clave" class="form-control"  type="text" name="clave" value="'.$this->clave.'" />
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
