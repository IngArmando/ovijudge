<?php
require_once("modelo/class_estado.php");
class campo_estado extends estado{
	
	public function combo_cod_pais(){
		parent::listar_paises();

		$salida.= '<select required id="cod_pais" class="form-control" name="cod_pais" >'; 
		$salida.= '<option value="">Seleccione</option>';
		while($row_pais = parent::row()){
			$salida.= '<option value="'.$row_pais["cod_pais"].'"';	
			if($row_pais["cod_pais"]== $this->cod_pais) $salida.= " selected ";									
			$salida.= '>'.$row_pais["nombre"]."</option>";
		}
		$salida.= '</select>';

		return $salida;
	}
	public function nombre(){
		$html.='<div class="col-md-3">
			<label>
				Nombre <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input required id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
		</div>';
		return $html;
	}
	public function cod_pais(){
		$html.='
			<div class="col-md-3">
			<label>
				Pais <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				'.$this->combo_cod_pais().'
		</div>';
		return $html;
		
	}
}
?>
