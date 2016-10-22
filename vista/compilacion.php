<?php
require_once("vista/campo/campo_compilacion.php");
class vista_compilacion extends campo_compilacion{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Compilaciones";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Compilaciones</span>					
					</div>
					<div class="col-md-4" style="text-align:right">
						'.btn_regresar('').'
					</div>
				</div>		
			</div>
			<div class="panel-body">
			
			
			
		<table id="data_table" class="table table-striped table-bordered" width="100%" cellspacing="0">
			<thead>
			<tr>
			<th width="80px">
			Nro
			</th>
			<th>Codigo</th><th>Resultado</th><th>Caso de prueba</th><th>compilacion_resultado</th><th>Tiempo de compilación</th><th>Salida de compilación</th><th>Otra salida</th><th>Error de salida</th><th>Salida sistema</th></tr>
			</thead>
			<tbody>
			';
			$i=0;
	while($row=$this->row()){
		$i++;
		$parametro['tipo']='botonera';
		$parametro['estatus']=$row['estatus'];
		$botonera=mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro);
		$ancho=strlen($botonera)/5.4;
		$html.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
		
			</span>
				'.$botonera.'

							<input type="hidden" name="cod_compilacion" value="'.$row['cod_compilacion'].'">
		</form>
	</td>
	<td>'.$row['cod_compilacion'].'</td><td>'.nombre_foraneo_cod_juzgar($row['cod_juzgar']).'</td><td>'.nombre_foraneo_cod_caso_de_prueba($row['cod_caso_de_prueba']).'</td><td>'.$row['compilacion_resultado'].'</td><td>'.$row['compilacion_tiempo'].'</td><td>'.$row['salida_compilacion'].'</td><td>'.$row['salida_diferente'].'</td><td>'.$row['salida_error'].'</td><td>'.$row['salida_sistema'].'</td>
	</tr>';
	}
	
			$html.='
			</tbody>
				</table>
				';
				
	

			return $html;
		}
		
		public function reporte_html_individual(){
			$this->consultar();
		$html= '
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Compilaciones</span></div>
					<div class="col-md-3">'.btn_regresar('compilacion').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Codigo: '.$this->cod_compilacion.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Resultado: '.$this->cod_juzgar.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Caso de prueba: '.$this->cod_caso_de_prueba.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						compilacion_resultado: '.$this->compilacion_resultado.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tiempo de compilación: '.$this->compilacion_tiempo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Salida de compilación: '.$this->salida_compilacion.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Otra salida: '.$this->salida_diferente.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Error de salida: '.$this->salida_error.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Salida sistema: '.$this->salida_sistema.'
					</label>
				</div>
			</div>
		
				</div>
			</div>
		';
		return $html;
	
		}
		public function formulario($tipo){
			switch($tipo){
				case 'modificar': {
					parent::consultar();
					$boton=botones('modificar');
					$titulo='Modificar Compilaciones';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Compilaciones';
				}break;
			}
		$html= '
			<form method="post" action="?vista=compilacion">
			<script type="text/javascript" src="js/js_compilacion.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('compilacion').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_juzgar().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_caso_de_prueba().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->compilacion_resultado().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->compilacion_tiempo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->salida_compilacion().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->salida_diferente().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->salida_error().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->salida_sistema().'
		</div>

	
			<div class="row"><br>
				<div class="col-md-3"></div>
				'.$boton.'<br>
			</div>	
		</div>
		';
		return $html;
	
		}
}
?>
