<?php
require_once("vista/campo/campo_scorecache_jurado.php");
class vista_scorecache_jurado extends campo_scorecache_jurado{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Score cache del Jurado";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Score cache del Jurado</span>					
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
			<th>cod_concurso</th><th>cod_equipo</th><th>cod_problema</th><th>cant_envios</th><th>pendiente</th><th>tiempo_total</th><th>status</th></tr>
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

							<input type="hidden" name="cod_concurso" value="'.$row['cod_concurso'].'">
		</form>
	</td>
	<td>'.$row['cod_concurso'].'</td><td>'.$row['cod_equipo'].'</td><td>'.$row['cod_problema'].'</td><td>'.$row['cant_envios'].'</td><td>'.$row['pendiente'].'</td><td>'.$row['tiempo_total'].'</td><td>'.$row['status'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Score cache del Jurado</span></div>
					<div class="col-md-3">'.btn_regresar('scorecache_jurado').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						cod_concurso: '.$this->cod_concurso.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						cod_equipo: '.$this->cod_equipo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						cod_problema: '.$this->cod_problema.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						cant_envios: '.$this->cant_envios.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						pendiente: '.$this->pendiente.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						tiempo_total: '.$this->tiempo_total.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						status: '.$this->status.'
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
					$titulo='Modificar Score cache del Jurado';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Score cache del Jurado';
				}break;
			}
		$html= '
			<form method="post" action="?vista=scorecache_jurado">
			<script type="text/javascript" src="js/js_scorecache_jurado.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('scorecache_jurado').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_concurso().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_equipo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_problema().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cant_envios().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->pendiente().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->tiempo_total().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->status().'
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
