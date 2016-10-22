<?php
require_once("modelo/class_usuario.php");
class campo_usuario extends usuario{
		
		public function cod_usuario(){
			return '<input type="hidden" name="cod_usuario" value="'.$this->cod_usuario.'" />';	
		}
		public function cod_tipo_usuario($bloquear){
				return '		<div class="col-md-3">
								<label>Rol de usuario: <span style="color:red" title="Campo obligatorio">(*)</span></label>
							'.$this->combo_tipo_usuario().'
				</div>	';
			
		}

		public function clave(){
			return '
			<div class="col-md-3">
				<label>
					Clave nueva <span style="color:red" title="Campo obligatorio">(*)</span>
				</label>
					<input required id="clave"  class="form-control"  type="password" name="clave" value="" />

			</div>';
			
		}
		public function confirmar_clave(){
			return '<div class="col-md-3">
			<label>
				Confirmar clave nueva <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input required id="con_clave"  class="form-control"  type="password" name="con_clave" value="" />
		</div>';
		}
		public function mostrar_clave(){
				$html.= '
			<script src="libreria/clave/script.js"></script>
			<link rel="stylesheet" type="text/css" href="libreria/clave/style.css" />
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-6">
					<div id="pswd_info">
						<h4>La contraseña debe cumplir con los siguientes requerimientos:</h4>
						<ul>
							<li id="letter" class="invalid">Al menos <strong>1 letra</strong></li>
							<li id="capital" class="invalid">Al menos <strong>1 letra en mayuscula</strong></li>
							<li id="number" class="invalid">Al menos <strong>1 numero</strong></li>
							<li id="especial" class="invalid">Al menos <strong>1 caracter especial</strong></li>
							<li id="length" class="invalid">Longitud min. de <strong>8 caracteres</strong></li>
							
						</ul>
					</div>
				</div>
			</div>
				';	
				return $html;
		}
		public function captcha_facil(){
			$html='<div style="text-align:center"> Por favor escribe las letras y/o numeros que aparecen en la imagen: <br>

			<img src="libreria/captchafacil/captcha.php" / style="margin-bottom:4px"><br>
			<input onkeyup="desactivar_registrar()" type="text" size="16" id="captcha" name="captcha" maxlength="5"/>
			</div>
			<script>
				function desactivar_registrar(){
				texto=0;
				texto=document.getElementById("captcha").value;
				if(texto.length==5)
				 document.getElementById("registrar").disabled=false;
				 else
				 document.getElementById("registrar").disabled=true;
				}
			</script>
			';
			return $html;
		}
		public function clave_actual(){
			$html.='<div class="col-md-6">
				<label>
					Clave actual <span style="color:red" title="Campo obligatorio">(*)</span>
				</label>
				<input id="clave_actual" required type="password" value="" name="clave_actual" class="form-control">
				
			</div>
			';
			return $html;
			
		}
		public function captcha_google(){
			$salida.='
			<br>
			<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
			<script type="text/javascript">
			 var verifyCallback = function(response) {
				document.getElementById("registrar").disabled=false;
				document.getElementById("captcha").value=response;
			  };
		 var onloadCallback = function() {
				grecaptcha.render("html_element", {
				  "sitekey" : "6LfJMf8SAAAAADc1LO_0skgQD5lyL1haYQ27d1_-",
				  "callback" : verifyCallback,
				});
			  };

		</script>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
				
					<div style="margin:0 auto; width:310px" id="html_element"></div>
			</div>
			</div>
			<input type="hidden" name="captcha" value="" id="captcha">

			';
			return $salida;
		}	
		public function combo_tipo_usuario(){
			include_once("modelo/class_tipo_usuario.php");
			$tipo_usuario = new tipo_usuario;
			$tipo_usuario->listar();
			$salida.= '<div class="input-group">

			';
			$salida.= '<select style="z-index:1"  id="cod_tipo_usuario" class="form-control" name="cod_tipo_usuario" >'; 
			$salida.= '';
			while($row_tipo_usuario = $tipo_usuario->row()){
				$salida.= '<option value="'.$row_tipo_usuario["cod_tipo_usuario"].'"';	
				if($row_tipo_usuario["cod_tipo_usuario"]== $this->cod_tipo_usuario) $salida.= " selected ";									
				$salida.= '>'.$row_tipo_usuario["nombre"]."</option>";
			}
			$salida.= '</select>';
			$salida.= '<span class="input-group-btn">
			<a href="?vista=tipo_usuario&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
			

			</span>
			
			</div>';
			return $salida;
	}
		public function btn_registrar_publico(){
			$html.='
			<div class="col-md-6">
				<div style="text-align:center">
					<button disabled onclick="return validar()" id="registrar" class="btn btn-default btn-lg"  type="submit" name="evento" value="registrar_publico">
						<span class="glyphicon glyphicon-floppy-disk" > </span>
						Registrar
					</button>
				</div>
			</div>
			';
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
