<?php
require_once("vista/campo/campo_juzgar.php");
class vista_juzgar extends campo_juzgar{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Resultados de los envios";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Resultados de los envios</span>					
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
			<th>Codigo</th><th>Concurso</th><th>Envio</th><th>Tiempo de Inicio</th><th>Tiempo Final</th><th>Nombre del Servidor</th><th>Resultado</th><th>Verificado</th><th>Nombre del jurado</th><th>Comentario</th><th>Valido</th><th>Salida compilación</th><th>Visto por equipo</th><th>Rejuzgar</th><th>Pre juzgar</th></tr>
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

							<input type="hidden" name="cod_juzgar" value="'.$row['cod_juzgar'].'">
		</form>
	</td>
	<td>'.$row['cod_juzgar'].'</td><td>'.nombre_foraneo_cod_concurso($row['cod_concurso']).'</td><td>'.nombre_foraneo_cod_envio($row['cod_envio']).'</td><td>'.$row['tiempo_inicio'].'</td><td>'.$row['tiempo_fin'].'</td><td>'.$row['nombre_servidor'].'</td><td>'.$row['resultado'].'</td><td>'.$row['verificado'].'</td><td>'.$row['nombre_jurado'].'</td><td>'.$row['comentario'].'</td><td>'.$row['valido'].'</td><td>'.$row['salida_compilacion'].'</td><td>'.$row['visto_equipo'].'</td><td>'.nombre_foraneo_cod_rejuzgar($row['cod_rejuzgar']).'</td><td>'.nombre_foraneo_pre_cod_juzgar($row['pre_cod_juzgar']).'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Resultados de los envios</span></div>
					<div class="col-md-3">'.btn_regresar('juzgar').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Codigo: '.$this->cod_juzgar.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Concurso: '.$this->cod_concurso.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Envio: '.$this->cod_envio.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tiempo de Inicio: '.$this->tiempo_inicio.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tiempo Final: '.$this->tiempo_fin.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Nombre del Servidor: '.$this->nombre_servidor.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Resultado: '.$this->resultado.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Verificado: '.$this->verificado.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Nombre del jurado: '.$this->nombre_jurado.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Comentario: '.$this->comentario.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Valido: '.$this->valido.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Salida compilación: '.$this->salida_compilacion.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Visto por equipo: '.$this->visto_equipo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Rejuzgar: '.$this->cod_rejuzgar.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Pre juzgar: '.$this->pre_cod_juzgar.'
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
					$titulo='Modificar Resultados de los envios';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Resultados de los envios';
				}break;
			}
		$html= '
			<form method="post" action="?vista=juzgar">
			<script type="text/javascript" src="js/js_juzgar.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('juzgar').'</div>
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
					'.$this->cod_concurso().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_envio().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->tiempo_inicio().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->tiempo_fin().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre_servidor().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->resultado().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->verificado().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre_jurado().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->comentario().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->valido().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->salida_compilacion().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->visto_equipo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_rejuzgar().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->pre_cod_juzgar().'
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
