<?php
require_once("modelo/class_pais.php");
class vista_pais extends pais{
	
		public function reporte_html_general($vista){
			global $lib_data_table;
			$lib_data_table=true;
			$this->listar_todo();
			$parametro['tipo']='consulta_nuevo';			
			$html='
			<script> var sub_titulo_pdf="Reporte de Paises";</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
					'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
					<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Paises</span>					
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
			<th>País</th></tr>
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

							<input type="hidden" name="cod_pais" value="'.$row['cod_pais'].'">
					</form>
				</td>
				<td>'.$row['nombre'].' '.$row['observacion'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta Detallada del País</span></div>
					<div class="col-md-3">'.btn_regresar('pais').'</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 center">
						<label>
							Nombre del País:
						</label>
							'.$this->nombre.'
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
					$titulo='Modificar Países';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo País';
				}break;
			}
		$html= '
			<form method="post" action="?vista=pais">
			<script type="text/javascript" src="js/js_pais.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('pais').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_pais" class="form-control" type="hidden" name="cod_pais" value="'.$this->cod_pais.'" />

				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<label>
							País <span style="color:red" title="Campo obligatorio">(*)</span>
						</label>
							<input id="nombre" class="form-control"  type="text" name="nombre" value="'.$this->nombre.'" />
					</div>
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
