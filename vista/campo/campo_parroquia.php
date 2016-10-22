<?php
require_once("modelo/class_parroquia.php");
class campo_parroquia extends parroquia{
	
	public function combo_cod_municipio(){
		parent::listar();

		$salida.= '<select  id="cod_municipio"  class="form-control" name="cod_municipio" >'; 
		$salida.= '<option value="">Seleccione</option>';
		while($row_municipio = parent::row()){
			$salida.= '<option class="municipio municipio_'.$row_municipio["cod_estado"].'" value="'.$row_municipio["cod_municipio"].'"';	
			if($row_municipio["cod_municipio"]== $this->cod_municipio) $salida.= " selected ";									
			$salida.= '>'.$row_municipio["nombre"]." ".$row_municipio["observacion"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '
';
		return $salida;
	}
	public function nombre(){
		$html.='<div class="col-md-3">
			<label>
				Nombre de la Parroquia<span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
		</div>';
		return $html;
	}
	public function cod_municipio(){
		$html.='
			<div class="col-md-3">
			<label>
				Municipio <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				'.$this->combo_cod_municipio().'
		</div>';
		return $html;
		
	}
		public function cod_estado(){
			return 	'<div class="col-md-3">
						<label>Estado: <span style="color:red" title="Campo obligatorio">(*)</span></label>
							'.$this->combo_estado().'
				</div>';
		}
		private function combo_estado(){
			include_once("modelo/class_estado.php");
			$estado = new estado;
			$estado->listar();
			$html='<select '.($bloquear ? 'disabled' : '').' required onchange="cambiar_municipio(this)" class="form-control" name="cod_estado"  id="cod_estado">'; 
			$html.='<option value="">Seleccione</option>';
				while($row_estado = $estado->row()){
					$html.='<option class="estados" value='.$row_estado['cod_estado'];	
					if($row_estado['cod_estado']== $this->cod_estado) $html.=" selected ";									
						$html.='>'.$row_estado['nombre'].'</option>';
				}
			$html.='</select>';
			return $html;
		}
}
?>
