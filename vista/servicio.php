<?php
require_once("campo/campo_servicio.php");
class vista_servicio extends campo_servicio{

	public function reporte_html_individual(){
		$this->consultar();
			$html.='			
				<div class="panel panel-default">
					<div class="panel-heading" style="text-align:center">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta Detallada del Servicio</span></div>
							<div class="col-md-2 col-md-offset-1">'.btn_regresar('servicio').'</div>
						</div>
					</div>
				<div class="panel panel-body">		
					<div class="row">
						<div class="col-md-4"></div>
							<label>Codigo Unico:</label>
							'.$this->cod_servicio.'
					</div>
					<div class="row">
						<div class="col-md-4"></div>
							<label>Nombre del Servicio:</label>
							'.$this->nombre.'
					</div>
					<div class="row">
						<div class="col-md-4"></div>
						<label>Pertenece al Modulo:</label>
							'.$this->nombre_modulo.'
					</div>
					<div class="row">
						<div class="col-md-4"></div>
							<label>Estatus del servicio:</label>
							'.($this->estatus ? 'Activo' : 'Inactivo').'
					</div>

				</div>
				';
				return $html;		
		
	}

	public function reporte_html_general($vista){
		global $lib_data_table;
			$lib_data_table=true;
				$this->listar_todo();
				$parametro['tipo']='consulta_nuevo';	
		$salida.='
			<script> var sub_titulo_pdf="Reporte de los Servicios del Sistema";</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
		<script type="text/javascript" src="js/js_servicio.js" ></script>
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
						</div>		
						<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Servicio del sistema</span>					
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
				<th>Modulo</th><th>Servicio</th></tr>
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
		$salida.='
		<tr>
		<td class="td_botones">
		
			<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' </span>
					'.$botonera.'
					<input type="hidden" name="cod_servicio" value="'.$row['cod_servicio'].'">
			</form>
		</td>
		<td>'.$row['nombre_modulo'].' '.$row['observacion'].'</td><td>'.$row['nombre'].'</td>
		</tr>';
		}
		
		$salida.='
		</tbody>
			</table>
			';
			return $salida;
		}

	public function formulario($tipo){
		
			switch($tipo){
				case 'modificar': {
					parent::consultar();
					$boton=botones('modificar');
					$titulo='Modificar Servicios del Sistema';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Servicio';
				}break;
			}
			$html.='
				<form method="post" action="?vista=servicio">
				<script type="text/javascript" src="js/js_servicio.js" ></script>
			
				<div class="panel panel-default">
					<div class="panel-heading" style="text-align:center">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
							<div class="col-md-2 col-md-offset-1">'.btn_regresar('servicio').'</div>
						</div>
					</div>
				<div class="panel panel-body">		
			
					<span style="float:right; color:red">(*) Campos obligatorios</span>
					<input readonly id="cod_servicio" class="form-control" type="hidden" name="cod_servicio" value="'.$this->cod_servicio.'" />

					<div class="row">
						<div class="col-md-3"></div>
							'.$this->cod_modulo().'
					</div>


					<div class="row">
						<div class="col-md-3"></div>
							'.$this->nombre().'
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
