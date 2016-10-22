<?php
require_once("vista/campo/campo_ejecutable.php");
class vista_ejecutable extends campo_ejecutable{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Ejecutable";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Paquetes Ejecutables</span>					
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
			<th>Codigo</th><th>md5sum</th><th>zipfile</th><th>descripcion</th><th>tipo</th></tr>
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

							<input type="hidden" name="cod_ejecutable" value="'.$row['cod_ejecutable'].'">
		</form>
	</td>
	<td>'.$row['cod_ejecutable'].'</td><td>'.$row['md5sum'].'</td><td class="center"> <a href="index.php?vista=ejecutable&evento=exportar&cod_ejecutable='.$row['cod_ejecutable'].'"><span class="glyphicon glyphicon-download-alt"> </span></a> </td><td>'.$row['descripcion'].'</td><td>'.$row['tipo'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Ejecutable</span></div>
					<div class="col-md-3">'.btn_regresar('ejecutable').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Codigo: 
					</label>'.$this->cod_ejecutable.'
				</div>
				<div class="col-md-3">
					<label>
						Tipo: 
					</label> '.$this->tipo.'
				</div>
			</div>
		
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-6">
					<label>
						Md5sum: 
					</label>'.$this->md5sum.'
				</div>
			</div>
		
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Archivo Zip: 
					</label> <a href="index.php?vista=ejecutable&evento=exportar&cod_ejecutable='.$this->cod_ejecutable.'"><span class="glyphicon glyphicon-download-alt"> </span></a>
				</div>
				<div class="col-md-3">
					<label>
						Descripcion: 
					</label> '.$this->descripcion.'
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
					$titulo='Modificar Ejecutable';
					$readonly='readonly';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Ejecutable';
					$required='required';
					
				}break;
			}
		$html= '
			<form method="post" action="?vista=ejecutable" enctype="multipart/form-data">
			<script type="text/javascript" src="js/js_ejecutable.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('ejecutable').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_ejecutable($readonly).'
					'.$this->zipfile($required).'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->descripcion().'
					'.$this->tipo().'
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
