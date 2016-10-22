<?php
require_once("modelo/class_municipio.php");
class campo_municipio extends municipio{
	
	public function combo_cod_estado(){
		$this->listar_estados();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  id="cod_estado" class="form-control" name="cod_estado" >'; 
		$salida.= '<option value="">Seleccione</option>';
		while($row_estado = parent::row()){
			$salida.= '<option value="'.$row_estado["cod_estado"].'"';	
			if($row_estado["cod_estado"]== $this->cod_estado) $salida.= " selected ";									
			$salida.= '>'.$row_estado["nombre"]." ".$row_estado["observacion"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=estado&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}
	public function nombre(){
		$html.='<div class="col-md-6">
			<label>
				Nombre <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input required id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
		</div>';
		return $html;
	}
	public function cod_estado(){
		$html.='
			<div class="col-md-3">
			<label>
				Estado <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				'.$this->combo_cod_estado().'
		</div>';
		return $html;
		
	}
}
?>
