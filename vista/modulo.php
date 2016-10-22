<?php
require_once("modelo/class_modulo.php");
class vista_modulo extends modulo{
	
		public function reporte_html_general($vista){
			global $lib_data_table;
			$lib_data_table=true;
			$this->listar_todo();
			$parametro['tipo']='consulta_nuevo';			
			$html='
			<script> var sub_titulo_pdf="Reporte de Modulos";</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
					'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
					<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Modulos del sistema</span>					
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
			<th>Nombre</th></tr>
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

							<input type="hidden" name="cod_modulo" value="'.$row['cod_modulo'].'">
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada del Modulo</span></div>
					<div class="col-md-3">'.btn_regresar('modulo').'</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 center">
						<label>
							Nombre:
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
					$titulo='Modificar Modulos del sistema';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Modulo';
				}break;
			}
		$html= '
			<form method="post" action="?vista=modulo">
			<script type="text/javascript" src="js/js_modulo.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('modulo').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<label>
							Nombre <span style="color:red" title="Campo obligatorio">(*)</span>
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
