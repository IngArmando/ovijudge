
<?php 
require_once("modelo/class_globo.php");
	class campo_globo extends globo{
		
		public function cod_globo(){
			$html='<input id="cod_globo" class="form-control" type="hidden" name="cod_globo" value="'.$this->cod_globo.$ultimo_id.'" />';
			return $html;
		}
		public function cod_envio(){
			$html='
				
					<div class="col-md-3">
						<label>
							Envio
						</label>
							'.$this->combo_cod_envio().'
					</div>

			';
			return $html;
		}
		public function status(){
			$html='
				
					<div class="col-md-3">
						<label>
							Estatus
						</label>
							<input id="status" class="form-control"  type="text" name="status" value="'.$this->status.'" />
					</div>

			';
			return $html;
		}
	public function combo_cod_envio(){
		include_once("modelo/class_envio.php");
		$envio = new envio;
		$envio->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_envio" class="form-control" name="cod_envio" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_envio = $envio->row()){
			$salida.= '<option value="'.$row_envio["cod_envio"].'"';	
			if($row_envio["cod_envio"]== $this->cod_envio) $salida.= " selected ";									
			$salida.= '>'.$row_envio["orig_envio"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=envio&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_envio($valor){
	include_once("modelo/class_envio.php");
	$envio = new envio;
	$envio->set_cod_envio($valor);
	$envio->consultar();
	$arreglo=$envio->row();
	return $arreglo['orig_envio'];
}

	}
	
?>
