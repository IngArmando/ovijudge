
<?php 
require_once("modelo/class_rejuzgar.php");
	class campo_rejuzgar extends rejuzgar{
		
		public function cod_rejuzgar(){
			$html='<input id="cod_rejuzgar" class="form-control" type="hidden" name="cod_rejuzgar" value="'.$this->cod_rejuzgar.$ultimo_id.'" />';
			return $html;
		}
		public function tiempo_inicio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo de inicio
						</label>
							<input id="tiempo_inicio" class="form-control"  type="text" name="tiempo_inicio" value="'.$this->tiempo_inicio.'" />
					</div>

			';
			return $html;
		}
		public function tiempo_final(){
			$html='
				
					<div class="col-md-3">
						<label>
							Tiempo final
						</label>
							<input id="tiempo_final" class="form-control"  type="text" name="tiempo_final" value="'.$this->tiempo_final.'" />
					</div>

			';
			return $html;
		}
		public function motivo(){
			$html='
				
					<div class="col-md-3">
						<label>
							Motivo
						</label>
							<input id="motivo" class="form-control"  type="text" name="motivo" value="'.$this->motivo.'" />
					</div>

			';
			return $html;
		}
		public function valido(){
			$html='
				
					<div class="col-md-3">
						<label>
							Valido
						</label>
							<input id="valido" class="form-control"  type="text" name="valido" value="'.$this->valido.'" />
					</div>

			';
			return $html;
		}
		public function cod_usuario_inicio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Usuario inicio
						</label>
							'.$this->combo_cod_usuario_inicio().'
					</div>

			';
			return $html;
		}
		public function cod_usuario_fin(){
			$html='
				
					<div class="col-md-3">
						<label>
							Usuario final
						</label>
							'.$this->combo_cod_usuario_fin().'
					</div>

			';
			return $html;
		}
	public function combo_cod_usuario_inicio(){
		include_once("modelo/class_usuario.php");
		$usuario = new usuario;
		$usuario->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_usuario_inicio" class="form-control" name="cod_usuario_inicio" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_usuario = $usuario->row()){
			$salida.= '<option value="'.$row_usuario["cod_usuario"].'"';	
			if($row_usuario["cod_usuario"]== $this->cod_usuario_inicio) $salida.= " selected ";									
			$salida.= '>'.$row_usuario["cedula"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=usuario&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_usuario_inicio($valor){
	include_once("modelo/class_usuario.php");
	$usuario = new usuario;
	$usuario->set_cod_usuario($valor);
	$usuario->consultar();
	$arreglo=$usuario->row();
	return $arreglo['cedula'];
}

	public function combo_cod_usuario_fin(){
		include_once("modelo/class_usuario.php");
		$usuario = new usuario;
		$usuario->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_usuario_fin" class="form-control" name="cod_usuario_fin" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_usuario = $usuario->row()){
			$salida.= '<option value="'.$row_usuario["cod_usuario"].'"';	
			if($row_usuario["cod_usuario"]== $this->cod_usuario_fin) $salida.= " selected ";									
			$salida.= '>'.$row_usuario["cedula"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=usuario&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_usuario_fin($valor){
	include_once("modelo/class_usuario.php");
	$usuario = new usuario;
	$usuario->set_cod_usuario($valor);
	$usuario->consultar();
	$arreglo=$usuario->row();
	return $arreglo['cedula'];
}

	}
	
?>
