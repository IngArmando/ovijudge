<?php
require_once("vista/campo/campo_bloqueo_ip.php");
class vista_bloqueo_ip extends campo_bloqueo_ip{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Ip bloqueadas";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Ip bloqueadas</span>					
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
			<th>Codigo</th><th>Ip</th><th>Agente</th><th>Fecha y hora</th><th>Estatus</th></tr>
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

							<input type="hidden" name="cod_bloqueo_ip" value="'.$row['cod_bloqueo_ip'].'">
		</form>
	</td>
	<td>'.$row['cod_bloqueo_ip'].'</td><td>'.$row['ip'].'</td><td>'.$row['agente'].'</td><td>'.$row['fecha_hora'].'</td><td>'.$row['estatus'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Ip bloqueadas</span></div>
					<div class="col-md-3">'.btn_regresar('bloqueo_ip').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Codigo: '.$this->cod_bloqueo_ip.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Ip: '.$this->ip.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Agente: '.$this->agente.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Fecha y hora: '.$this->fecha_hora.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Estatus: '.$this->estatus.'
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
					$titulo='Modificar Ip bloqueadas';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Ip bloqueadas';
				}break;
			}
		$html= '
			<form method="post" action="?vista=bloqueo_ip">
			<script type="text/javascript" src="js/js_bloqueo_ip.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('bloqueo_ip').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->ip().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->agente().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->fecha_hora().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->estatus().'
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
