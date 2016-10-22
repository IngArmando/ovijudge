<?php
	require_once("modelo/class_persona.php");
	class campo_persona extends persona{
		public $mostrar_datos;
	
		public function cedula($bloquear){
			$cedula=$this->cedula;
			return '<div class="col-md-3">
					<label>
						Cedula <span style="color:red" title="Campo obligatorio">(*)</span>
					</label>
							<input  type="hidden" id="nacionalidad_cedula" name="nacionalidad_cedula" value="'.(explode("-",$cedula)[0] ? explode("-",$cedula)[0] : "V").'">
					<div class="input-group">
			  <div class="input-group-btn">
					 <button  '.(explode("-",$cedula)[0] ? "disabled" : "").'  type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span id="button_cedula">V</span> <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="#" onclick="return cambiar_cedula_combo_cedula(\'V\')">V </a></li>
					<li><a href="#"  onclick="return cambiar_cedula_combo_cedula(\'E\')">E </a></li>
				</ul>
				</div>
			
				<input  '.(explode("-",$cedula)[1] ? "readonly" : "onblur='verificar_cedula(this)'").' maxlength="9" required id="cedula" class="form-control" type="text" onkeyup="this.value=this.value.toUpperCase()"  title="Solo numeros y una longitud min. de 5 numeros"  pattern=".{5,}" name="cedula" value="'.(explode("-",$cedula)[1]).'" />
				</div>
				
				</div>'.$this->seleccionar_nacionalidad();
		}
		public function nombre($bloquear){
			return '<div class="col-md-3">
					<label>
						Nombre <span style="color:red" title="Campo obligatorio">(*)</span>
					</label>
						<input title="Solo letras" maxlength="27" required id="nombre" class="form-control"  type="text" onkeyup="this.value=this.value.toUpperCase()" name="nombre" value="'.$this->nombre.'" />
				</div>';
			
		}
		public function apellido($bloquear){
				return '<div class="col-md-3">
					<label>
						Apellido <span style="color:red" title="Campo obligatorio">(*)</span>
					</label>
						<input maxlength="27"  title="Solo letras" pattern="^[a-zA-Z \u00C0-\u00ff\s]+$" required id="apellido" class="form-control"  type="text" onkeyup="this.value=this.value.toUpperCase()" name="apellido" value="'.$this->apellido.'" />
				</div>';	
		}
		public function foto_perfil(){
				return '<div class="col-md-3">
					<label>
						Foto de perfil
					</label>
						<input id="foto_perfil" class="form-control"  type="file" name="foto_perfil" />
				</div>';	
		}
		public function sexo($bloquear){
				return '<div class="col-md-3">
					<label>
						Sexo <span style="color:red" title="Campo obligatorio">(*)</span>
					</label>
						<br><input required id="sexo_masculino" '.($this->sexo=="m" ? "checked" : "").' type="radio" value="m" name="sexo"> Masculino <input required  '.($this->sexo=="f" ? "checked" : "").' type="radio" value="f" '.($bloquear ? 'disabled' : '').' name="sexo"> Femenino<br>
				</div>';
			
		}
		public function fecha_nacimiento($bloquear){
			return '<div class="col-md-3">
				
						<label>
						Fecha de nacimiento <span style="color:red" title="Campo obligatorio">(*)</span>
					</label>
					<input onkeypress="return false" required pattern="^(?:(?:0?[1-9]|1\d|2[0-8])(\/|-)(?:0?[1-9]|1[0-2]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:31(\/|-)(?:0?[13578]|1[02]))|(?:(?:29|30)(\/|-)(?:0?[1,3-9]|1[0-2])))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(29(\/|-)0?2)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$" id="fecha_nacimiento" title="Ingrese una fecha valida con formato (dd-mm-yyyy)" class="form-control"  type="text" onkeyup="this.value=this.value.toUpperCase()" name="fecha_nacimiento" value="'.($this->fecha_nacimiento ? date("d-m-Y",strtotime($this->fecha_nacimiento)) : "").'" />
				
				</div>';
		}
		public function correo($bloquear){
			return '<div class="col-md-3">
			
						<label>
						Correo <span style="color:red" title="Campo obligatorio">(*)</span>
					</label>
						<input   placeholder="correo@servicio.com" required title="Debe cololar un formato de correo valido."  maxlength="50" id="correo" class="form-control"   type="email" name="correo" value="'.$this->correo.'" />
				
				</div>';
			
		}
		public function telefono_movil($bloquear){
				return '<div class="col-md-3">
					<label>
						Teléfono Movil <span style="color:red" title="Campo obligatorio">(*)</span>
					</label>
						<input placeholder="4140000000" required maxlength="10" id="telefono_movil" title="Indique un numero de telefono valido. Ej: 4245138790 (Solo debe contener numeros)" pattern="^[0-9]{10}$" class="form-control"  type="text" onkeyup="this.value=this.value.toUpperCase()" name="telefono_movil" value="'.$this->telefono_movil.'" />
				</div>';
			
		}
		public function telefono_fijo($bloquear){
				return '
				<div class="col-md-3">
					<label>
						Teléfono Fijo
					</label>
						<input placeholder="2550000000" maxlength="10" title="Indique un numero de telefono valido. Ej: 4245138790 (Solo debe contener numeros)" pattern="^[0-9]{10}$" id="telefono_fijo" class="form-control"  type="text" onkeyup="this.value=this.value.toUpperCase()" name="telefono_fijo" value="'.$this->telefono_fijo.'" />
				</div>';
		}
		public function direccion($bloquear){
				return '
				<div class="col-md-6">
					<label>
						Dirección <span style="color:red" title="Campo obligatorio">(*)</span>
					</label>
						<textarea pattern="^[0-9 A-Za-z]" required placeholder="Ejemplo: Urb. la virginia calle 2 con avenida 3 casa Nro. 11-A" maxlength="100" title="Indique su dirección" id="direccion" class="form-control" onkeyup="this.value=this.value.toUpperCase()" name="direccion">'.$this->direccion.'</textarea>
				</div>';
		}
		public function estados($bloquear){
			return 	'<div class="col-md-2">
						<label>Estado: <span style="color:red" title="Campo obligatorio">(*)</span></label>
							'.$this->combo_estados($bloquear).'
				</div>';
		}
		public function municipios($bloquear){
				return '<div class="col-md-2">
								<label>Municipio: <span style="color:red" title="Campo obligatorio">(*)</span></label>
							'.$this->combo_municipios($bloquear).'
				</div>';
		}
		public function parroquia($bloquear){
				return '		<div class="col-md-2">
								<label>Parroquia: <span style="color:red" title="Campo obligatorio">(*)</span></label>
							'.$this->combo_parroquia($bloquear).'
				</div>	';
			
		}
		public function estatus($bloquear){
			return '
			<div class="col-md-3">
				<label>
					Estatus
				</label>
					<br><input  '.($this->estatus=="0" ? "checked" : "").' type="radio" value="0" name="estatus" required> INACTIVO<input required '.($this->estatus=="1" ? "checked" : "").'  type="radio" value="1" name="estatus"> ACTIVO<br>
			</div>
		';
			
		}
		private function combo_municipios($bloquear){
										  
			include_once("modelo/class_municipio.php");
			$municipio = new municipio;
			$municipio->listar();
			include_once("modelo/class_parroquia.php");
			$parroquia = new parroquia;
			$parroquia->set_cod_parroquia($this->cod_parroquia);
			$parroquia->consultar();
			$html='<select '.($bloquear ? 'disabled' : '').' required  onchange="cambiar_parroquias(this)" class="form-control"  name="cod_municipio" id="cam_cod_municipio">'; 
			$html.='<option value="">Seleccione</option>';
			while($row_municipio = $municipio->row()){
				$html.='<option class="municipios estado_'.$row_municipio['cod_estado'].'" value='.$row_municipio['cod_municipio'];	
				if($row_municipio['cod_municipio']== $parroquia->cod_municipio) $html.=" selected ";									
				$html.='>'.$row_municipio['nombre'].'</option>';
			}
			$html.='</select>';
			return $html;
		}
		private function combo_parroquia($bloquear){
				include_once("modelo/class_parroquia.php");
				$parroquia = new parroquia;
				$parroquia->listar();
				$html='<select '.($bloquear ? 'disabled' : '').' required class="form-control"  name="cod_parroquia" id="cam_cod_parroquia" required>'; 
				$html.='<option value="">Seleccione</option>';
				while($row_parroquia = $parroquia->row()){
					$html.='<option class="parroquias municipios_'.$row_parroquia['cod_municipio'].'" value='.$row_parroquia['cod_parroquia'];	
					if($row_parroquia['cod_parroquia']== $this->cod_parroquia) $html.=" selected ";									
					$html.='>'.$row_parroquia['nombre'].'</option>';
				}
				$html.='</select>';
				return $html;
		}
		private function combo_estados($bloquear){
			include_once("modelo/class_estado.php");
			$estado = new estado;
			$estado->listar();
			include_once("modelo/class_parroquia.php");
			$parroquia = new parroquia;
			$parroquia->set_cod_parroquia($this->cod_parroquia);
			$parroquia->consultar();
			$html='<select '.($bloquear ? 'disabled' : '').' required onchange="cambiar_municipio(this)" class="form-control" name="cod_estado"  id="cam_cod_estado">'; 
			$html.='<option value="">Seleccione</option>';
				while($row_estado = $estado->row()){
					$html.='<option class="estados" value='.$row_estado['cod_estado'];	
					if($row_estado['cod_estado']== $parroquia->cod_estado) $html.=" selected ";									
						$html.='>'.$row_estado['nombre'].'</option>';
				}
			$html.='</select>';
			return $html;
		}
		private function seleccionar_nacionalidad(){
			$nacionalidad_cedula=explode("-",$cedula)[0];
			if($nacionalidad_cedula){
				echo "
				<script> 
				window.onload=function(){
				cambiar_cedula_combo_cedula('$nacionalidad_cedula');
				};

				
				</script>";
			}		
			
		}
}
?>
