<?php

function formulario_registro_publico($campo_usuario,$campo_persona,$campo_pregunta_seguridad){
	$html.='
<script type="text/javascript" src="js/js_usuario.js" ></script>
<link rel="stylesheet" type="text/css" href="css/usuario.css" />

<form method="POST" autocomplete="off">
	<div class="panel panel-default">
		<div class="panel-heading" style="text-align:center">
			<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Registro de usuarios </span>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_usuario->cedula(0).'
				<div class="col-md-3"><span style="float:right; color:red">(*) Campos obligatorios</span></div>
			</div>


			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_persona->nombre(0).'
				'.$campo_persona->apellido(0).'
			</div>


			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_persona->sexo(0).'
				'.$campo_persona->fecha_nacimiento(0).'
			</div>


			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_persona->correo(0).'
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_persona->telefono_movil(0).'
				'.$campo_persona->telefono_fijo(0).'
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_persona->estados(0).'
				'.$campo_persona->municipios(0).'
				'.$campo_persona->parroquia(0).'
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_persona->direccion(0).'
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_pregunta_seguridad->preguntas_secretas().'
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				'.$campo_usuario->clave(0).'
				'.$campo_usuario->confirmar_clave(0).'
				
			</div>
			'.$campo_usuario->mostrar_clave().'
			<div class="row">
				'.$campo_usuario->captcha_facil().'
			</div>			
			<div class="row"><br>
				<div class="col-md-3"></div>
				'.$campo_usuario->btn_registrar_publico().'
				
			</div>			
		</div>
	</div>
	
</form>
		';
	return $html;
}

		

	

?>

