
<?php 
require_once("modelo/class_servidor.php");
	class campo_servidor extends servidor{
		
		public function nombre_servidor(){
			$html='
				
					<div class="col-md-3">
						<label>
							Nombre del servidor
						</label>
							<input id="nombre_servidor" class="form-control"  type="text" name="nombre_servidor" value="'.$this->nombre_servidor.'" />
					</div>

			';
			return $html;
		}
		public function active(){
			$html='
				
					<div class="col-md-3">
						<label>
							Activo
						</label>
							<input id="active" class="form-control"  type="text" name="active" value="'.$this->active.'" />
					</div>

			';
			return $html;
		}
		public function polltime(){
			$html='
				
					<div class="col-md-3">
						<label>
							Poll Tiempo
						</label>
							<input id="polltime" class="form-control"  type="text" name="polltime" value="'.$this->polltime.'" />
					</div>

			';
			return $html;
		}
		public function cod_restriccion(){
			$html='
				
					<div class="col-md-3">
						<label>
							Restricción
						</label>
							'.$this->combo_cod_restriccion().'
					</div>

			';
			return $html;
		}
	public function combo_cod_restriccion(){
		include_once("modelo/class_restriccion.php");
		$restriccion = new restriccion;
		$restriccion->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select  style="z-index:1"  id="cod_restriccion" class="form-control" name="cod_restriccion" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_restriccion = $restriccion->row()){
			$salida.= '<option value="'.$row_restriccion["cod_restriccion"].'"';	
			if($row_restriccion["cod_restriccion"]== $this->cod_restriccion) $salida.= " selected ";									
			$salida.= '>'.$row_restriccion["nombre"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=restriccion&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

public function nombre_foraneo_cod_restriccion($valor){
	include_once("modelo/class_restriccion.php");
	$restriccion = new restriccion;
	$restriccion->set_cod_restriccion($valor);
	$restriccion->consultar();
	$arreglo=$restriccion->row();
	return $arreglo['nombre'];
}

	}
	
?>
