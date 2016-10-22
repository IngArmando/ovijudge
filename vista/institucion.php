<?php
require_once("vista/campo/campo_institucion.php");
class vista_institucion extends campo_institucion{
	
		public function reporte_html_general($vista){
							global $lib_data_table;
				$lib_data_table=true;
			$this->listar_admin();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Afiliación";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Afiliación</span>					
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
			<th>Codigo</th><th>Nombre corto</th><th>Nombre</th><th>País</th><th>Descripción</th></tr>
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

							<input type="hidden" name="cod_institucion" value="'.$row['cod_institucion'].'">
		</form>
	</td>
	<td>'.$row['cod_institucion'].'</td><td>'.$row['nombre_corto'].'</td><td>'.$row['nombre'].'</td><td>'.$row['nombre_pais'].'</td><td>'.$row['descripcion'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Afiliación</span></div>
					<div class="col-md-3">'.btn_regresar('institucion').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Codigo: 
					</label>
					'.$this->cod_institucion.'
				</div>
				<div class="col-md-3">
					<label>
						Nombre corto:
					</label>
					'.$this->nombre_corto.'
				</div>
			</div>

		
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-6">
					<label>
						Nombre:
					</label>
					 '.$this->nombre.'
				</div>
			</div>
		
			<div class="row">
					<div class="col-md-3"></div>
				<div class="col-md-6">
					<label>
						País: 
					</label>
					'.$this->nombre_pais.'
				</div>
			</div>
		
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-6">
					<label>
						Descripción:
					</label>
					 '.$this->descripcion.'
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
					$titulo='Modificar Institución';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nueva Institución';
				}break;
			}
		$html= '
			<form method="post" action="?vista=institucion">
			<script type="text/javascript" src="js/js_institucion.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('institucion').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input id="cod_institucion" class="form-control" type="hidden" name="cod_institucion" value="'.$this->cod_institucion.'" />

		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre().'
		</div>
						
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre_corto().'
					'.$this->cod_pais().'
		</div>



	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->descripcion().'
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
