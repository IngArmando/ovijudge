<?php
require_once("vista/campo/campo_clarificacion.php");
class vista_clarificacion extends campo_clarificacion{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Clarificaciones";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Clarificaciones</span>					
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
			<th>Codigo</th><th>Concurso</th><th>Respuesta Clarificación</th><th>Tiempo de envio</th><th>Remitiente</th><th>Receptor</th><th>Nombre del jurado</th><th>Problema</th><th>Categoria</th><th>Cuerpo del msj</th><th>Respuesta</th></tr>
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

							<input type="hidden" name="cod_clarificacion" value="'.$row['cod_clarificacion'].'">
		</form>
	</td>
	<td>'.$row['cod_clarificacion'].'</td><td>'.nombre_foraneo_cod_concurso($row['cod_concurso']).'</td><td>'.nombre_foraneo_resp_cod_clarificacion($row['resp_cod_clarificacion']).'</td><td>'.$row['tiempo_envio'].'</td><td>'.$row['remitiente'].'</td><td>'.$row['receptor'].'</td><td>'.$row['nombre_jurado'].'</td><td>'.nombre_foraneo_cod_problema($row['cod_problema']).'</td><td>'.$row['categoria'].'</td><td>'.$row['cuerpo_msj'].'</td><td>'.$row['respuesta'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Clarificaciones</span></div>
					<div class="col-md-3">'.btn_regresar('clarificacion').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Codigo: '.$this->cod_clarificacion.'
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
						Respuesta Clarificación: '.$this->resp_cod_clarificacion.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tiempo de envio: '.$this->tiempo_envio.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Remitiente: '.$this->remitiente.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Receptor: '.$this->receptor.'
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
						Problema: '.$this->cod_problema.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Categoria: '.$this->categoria.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Cuerpo del msj: '.$this->cuerpo_msj.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Respuesta: '.$this->respuesta.'
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
					$titulo='Modificar Clarificaciones';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Clarificaciones';
				}break;
			}
		$html= '
			<form method="post" action="?vista=clarificacion">
			<script type="text/javascript" src="js/js_clarificacion.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('clarificacion').'</div>
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
					'.$this->resp_cod_clarificacion().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->tiempo_envio().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->remitiente().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->receptor().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre_jurado().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_problema().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->categoria().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cuerpo_msj().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->respuesta().'
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
