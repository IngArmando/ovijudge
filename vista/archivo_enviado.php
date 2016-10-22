<?php
require_once("vista/campo/campo_archivo_enviado.php");
class vista_archivo_enviado extends campo_archivo_enviado{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Archivos Enviados";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Archivos Enviados</span>					
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
			<th>Codigo</th><th>Envio</th><th>Codigo fuente</th><th>Nombre del archivo</th><th>Rank</th></tr>
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

							<input type="hidden" name="cod_archivo_enviado" value="'.$row['cod_archivo_enviado'].'">
		</form>
	</td>
	<td>'.$row['cod_archivo_enviado'].'</td><td>'.nombre_foraneo_cod_envio($row['cod_envio']).'</td><td>'.$row['codigo_fuente'].'</td><td>'.$row['archivo_nombre'].'</td><td>'.$row['rank'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Archivos Enviados</span></div>
					<div class="col-md-3">'.btn_regresar('archivo_enviado').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Codigo: '.$this->cod_archivo_enviado.'
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
						Codigo fuente: '.$this->codigo_fuente.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Nombre del archivo: '.$this->archivo_nombre.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Rank: '.$this->rank.'
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
					$titulo='Modificar Archivos Enviados';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Archivos Enviados';
				}break;
			}
		$html= '
			<form method="post" action="?vista=archivo_enviado">
			<script type="text/javascript" src="js/js_archivo_enviado.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('archivo_enviado').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_envio().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->codigo_fuente().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->archivo_nombre().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->rank().'
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
