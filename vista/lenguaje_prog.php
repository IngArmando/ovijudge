<?php
require_once("vista/campo/campo_lenguaje_prog.php");
class vista_lenguaje_prog extends campo_lenguaje_prog{
	
		public function reporte_html_general($vista){
				global $lib_data_table;
	$lib_data_table=true;
			$this->listar_admin();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Lenguajes de Programación";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Lenguajes de Programación</span>					
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
			<th>Comando de compilación</th><th>Nombre</th><th>Estatus</th></tr>
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

							<input type="hidden" name="cod_lenguaje_prog" value="'.$row['cod_lenguaje_prog'].'">
		</form>
	</td>
	<td>'.$row['comando'].'</td><td>'.$row['nombre'].'</td><td>'.($row['estatus']==1 ? 'Activo' : 'Inactivo').'</td>
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
					<div class="col-md-6">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada del Lenguaje de Programación</span></div>
					<div class="col-md-3">'.btn_regresar('lenguaje_prog').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Codigo unico: 
					</label> '.$this->cod_lenguaje_prog.'
				</div>
				
				<div class="col-md-3">
					<label>
						Nombre: 
					</label> '.$this->nombre.'
				</div>
			</div>

			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Comando: 
					</label> '.$this->comando.'
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
					$titulo='Modificar Lenguaje de Programación';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Lenguaje de Programación';
				}break;
			}
		$html= '
			<form method="post" action="?vista=lenguaje_prog">
			<script type="text/javascript" src="js/js_lenguaje_prog.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('lenguaje_prog').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_lenguaje_prog" class="form-control" type="hidden" name="cod_lenguaje_prog" value="'.$this->cod_lenguaje_prog.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre().'
					'.$this->comando().'
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
