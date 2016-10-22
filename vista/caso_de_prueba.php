<?php
require_once("vista/campo/campo_caso_de_prueba.php");
class vista_caso_de_prueba extends campo_caso_de_prueba{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Casos de Prueba";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Casos de Prueba</span>					
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
			<th>Codigo</th><th>md5sum de entrada</th><th>md5sum de salida</th><th>Entrada</th><th>Salida</th><th>Problema</th><th>Rank</th><th>Descripción</th><th>Imagen</th><th>Imagen pequeña</th><th>Tipo de imagen</th><th>Ejemplo</th></tr>
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

							<input type="hidden" name="cod_caso_de_prueba" value="'.$row['cod_caso_de_prueba'].'">
		</form>
	</td>
	<td>'.$row['cod_caso_de_prueba'].'</td><td>'.$row['md5sum_entrada'].'</td><td>'.$row['md5sum_salida'].'</td><td>'.$row['entrada'].'</td><td>'.$row['salida'].'</td><td>'.nombre_foraneo_cod_problema($row['cod_problema']).'</td><td>'.$row['rank'].'</td><td>'.$row['descripcion'].'</td><td>'.$row['imagen'].'</td><td>'.$row['imagen_peque'].'</td><td>'.$row['imagen_tipo'].'</td><td>'.$row['ejemplo'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Casos de Prueba</span></div>
					<div class="col-md-3">'.btn_regresar('caso_de_prueba').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Codigo: '.$this->cod_caso_de_prueba.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						md5sum de entrada: '.$this->md5sum_entrada.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						md5sum de salida: '.$this->md5sum_salida.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Entrada: '.$this->entrada.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Salida: '.$this->salida.'
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
						Rank: '.$this->rank.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Descripción: '.$this->descripcion.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Imagen: '.$this->imagen.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Imagen pequeña: '.$this->imagen_peque.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tipo de imagen: '.$this->imagen_tipo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Ejemplo: '.$this->ejemplo.'
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
					$titulo='Modificar Casos de Prueba';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Casos de Prueba';
				}break;
			}
		$html= '
			<form method="post" action="?vista=caso_de_prueba">
			<script type="text/javascript" src="js/js_caso_de_prueba.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('caso_de_prueba').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->md5sum_entrada().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->md5sum_salida().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->entrada().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->salida().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_problema().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->rank().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->descripcion().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->imagen().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->imagen_peque().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->imagen_tipo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->ejemplo().'
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
