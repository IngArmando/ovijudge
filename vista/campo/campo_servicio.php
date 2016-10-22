<?php
require_once("modelo/class_servicio.php");
class campo_servicio extends servicio{
	
	public function combo_cod_modulo(){
		$this->listar_modulo();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  id="cod_modulo" class="form-control" name="cod_modulo" >'; 
		$salida.= '<option value="">Seleccione</option>';
		while($row_modulo = $this->row()){
			
			$salida.= '<option value="'.$row_modulo["cod_modulo"].'"';	
			if($row_modulo["cod_modulo"]== $this->cod_modulo) $salida.= " selected ";									
			$salida.= '>'.$row_modulo["nombre"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=modulo&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}
	public function nombre(){
		$html.='<div class="col-md-6">
			<label>
				Nombre <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
		</div>';
		return $html;
	}
	public function cod_modulo(){
		$html.='
			<div class="col-md-6">
			<label>
				Modulo <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				'.$this->combo_cod_modulo().'
		</div>';
		return $html;
		
	}
}
?>
