
<?php 
require_once("modelo/class_equipo.php");
	class campo_equipo extends equipo{
		
		public function cod_equipo(){
			$html='<input id="cod_equipo" class="form-control" type="hidden" name="cod_equipo" value="'.$this->cod_equipo.$ultimo_id.'" />';
			return $html;
		}
		public function nombre(){
			$html='
				
					<div class="col-md-6">
						<label>
							Nombre 
						</label> <span style="color:red">(*)</span>
							<input autofocus required id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
					</div>

			';
			return $html;
		}
		public function cod_institucion(){
			$html='
				
					<div class="col-md-6">
						<label>
							Institución
						</label> <span style="color:red"> (*) Si usted no pertenece a ninguna institución elija (Independientes).</span> 
							'.$this->combo_cod_institucion().'
					</div>

			';
			return $html;
		}
		public function estatus(){
			$html='
				
					<div class="col-md-3">
						<label>
							Estatus
						</label>
							<input id="status" class="form-control"  type="text" name="status" value="'.$this->estatus.'" />
					</div>

			';
			return $html;
		}
		



	public function combo_cod_institucion(){
		include_once("modelo/class_institucion.php");
		$institucion = new institucion;
		$institucion->listar();
		$salida.= '<div class="input-group">

		';
		$salida.= '<select required  style="z-index:1"  id="cod_institucion" class="form-control" name="cod_institucion" >'; 
		$salida.= '<option value="">Elige</option>';
		while($row_institucion = $institucion->row()){
			$salida.= '<option value="'.$row_institucion["cod_institucion"].'"';	
			if($row_institucion["cod_institucion"]== $this->cod_institucion) $salida.= " selected ";									
			$salida.= '>'.$row_institucion["nombre"]."</option>";
		}
		$salida.= '</select>';
		$salida.= '<span class="input-group-btn">
		<a href="?vista=institucion&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
		

		</span>
		
		</div>';
		return $salida;
	}

}
	
?>
