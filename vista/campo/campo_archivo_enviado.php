
<?php 
require_once("modelo/class_archivo_enviado.php");
	class campo_archivo_enviado extends archivo_enviado{
		
		public function cod_archivo_enviado(){
			$html='<input id="cod_archivo_enviado" class="form-control" type="hidden" name="cod_archivo_enviado" value="'.$this->cod_archivo_enviado.$ultimo_id.'" />';
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
		public function codigo_fuente(){
			$html='
				
					<div class="col-md-3">
						<label>
							Codigo fuente
						</label>
							<input id="codigo_fuente" class="form-control"  type="text" name="codigo_fuente" value="'.$this->codigo_fuente.'" />
					</div>

			';
			return $html;
		}
		public function archivo_nombre(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre del archivo
						</label>
							<input id="archivo_nombre" class="form-control"  type="text" name="archivo_nombre" value="'.$this->archivo_nombre.'" />
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
			$salida.= '>'.$row_envio["orig_envio"].' '.$row_envio["cod_concurso"]."</option>";
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
	return $arreglo['orig_envio'].' '.$arreglo['cod_concurso'];
}

	}
	
?>
