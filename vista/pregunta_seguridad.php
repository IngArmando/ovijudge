<?php
require_once("vista/campo/campo_pregunta_seguridad.php");

class vista_pregunta_seguridad extends campo_pregunta_seguridad{
	
	
	public function formulario($tipo){
		switch($tipo){
			case 'modificar': {
				$this->consultar();
				$boton=botones('modificar');
				$titulo='Modificar Preguntas de Seguridad';
			}break;
			case 'registrar':{
				$boton=botones('registrar');
				$titulo='Registrar Preguntas de Seguridad';
			}break;
		}
		$html.='
		<form method="post">
			<div class="panel panel-default">
			
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
					<div class="col-md-3">'.btn_regresar('').'</div>
				</div>
			</div>
				<br>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3"></div>
							'.$this->preguntas_secretas().'
						</div>
					</div>
						<div class="row"><br>
							<div class="col-md-3"></div>
							'.$boton.'
						</div>		
					<br>
				</div>
		</div>
	</form>
			';
		return $html;
		
		
	}
	
}
?>
