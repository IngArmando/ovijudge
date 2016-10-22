<?php
require_once("vista/campo/campo_rejuzgar.php");
class vista_rejuzgar extends campo_rejuzgar{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Grupo de reenvios";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Grupo de reenvios</span>					
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
			<th>Codigo</th><th>Tiempo de inicio</th><th>Tiempo final</th><th>Motivo</th><th>Valido</th><th>Usuario inicio</th><th>Usuario final</th></tr>
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

							<input type="hidden" name="cod_rejuzgar" value="'.$row['cod_rejuzgar'].'">
		</form>
	</td>
	<td>'.$row['cod_rejuzgar'].'</td><td>'.$row['tiempo_inicio'].'</td><td>'.$row['tiempo_final'].'</td><td>'.$row['motivo'].'</td><td>'.$row['valido'].'</td><td>'.nombre_foraneo_cod_usuario_inicio($row['cod_usuario_inicio']).'</td><td>'.nombre_foraneo_cod_usuario_fin($row['cod_usuario_fin']).'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Grupo de reenvios</span></div>
					<div class="col-md-3">'.btn_regresar('rejuzgar').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Codigo: '.$this->cod_rejuzgar.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tiempo de inicio: '.$this->tiempo_inicio.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tiempo final: '.$this->tiempo_final.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Motivo: '.$this->motivo.'
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
						Usuario inicio: '.$this->cod_usuario_inicio.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Usuario final: '.$this->cod_usuario_fin.'
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
					$titulo='Modificar Grupo de reenvios';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Grupo de reenvios';
				}break;
			}
		$html= '
			<form method="post" action="?vista=rejuzgar">
			<script type="text/javascript" src="js/js_rejuzgar.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('rejuzgar').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->tiempo_inicio().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->tiempo_final().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->motivo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->valido().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_usuario_inicio().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_usuario_fin().'
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
