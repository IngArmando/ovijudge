<?php
require_once("vista/campo/campo_usuario.php");

	class cambiar_pass extends campo_usuario{
		public function formulario_cambiar_clave(){
			$html.='
			<form method="post" onsubmit="return validar()" autocomplete="off">
		<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span>CAMBIAR CLAVE DE USUARIO</span></div>
					<div class="col-md-3">'.btn_regresar('').'</div>
				</div>
			</div>
			<div class="panel-body">	
				<br>
				<div class="row">
					<div class="col-md-3"></div>
					'.$this->clave_actual().'
				</div>
				<div class="row">
					<div class="col-md-3"></div>
					'.$this->clave().'
					'.$this->confirmar_clave().'
				</div>
				'.$this->mostrar_clave().'
				<div class="row">
					<div class="col-md-6 col-md-offset-3" style="text-align:center">
			<br><br>
						<button class="btn btn-default btn-lg" type="submit" name="evento" value="cambiar">Cambiar</button>
					</div>
				</div>
				<br>
			</div>
			<script> document.getElementById("clave_actual").value=""; </script>
			';
		return $html;
			
		}
		
	}
?>
