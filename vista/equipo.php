<?php
require_once("vista/campo/campo_equipo.php");
class vista_equipo extends campo_equipo{
	
		public function reporte_html_general($vista){
				global $lib_data_table;
	$lib_data_table=true;
			$this->listar_admin();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Equipos";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Equipos</span>					
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
			<th>Nombre</th><th>Institución</th></tr>
			</thead>
			<tbody>
			';
			$i=0;
	while($row=$this->row()){
		$i++;
		$parametro['tipo']			='botonera';
		$parametro['estatus']		=$row['estatus'];
		$parametro['cod_usuario_reg']=$row['cod_usuario_reg'];
		$botonera=mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro);
		$ancho=strlen($botonera)/5.3;
		$html.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
		
			</span>
				'.$botonera.'

							<input type="hidden" name="cod_equipo" value="'.$row['cod_equipo'].'">
		</form>
	</td>
	<td>'.$row['nombre'].'</td><td>'.$row['nombre_institucion'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada del equipo</span></div>
					<div class="col-md-3">'.btn_regresar('equipo').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Codigo Unico:
					</label>
					 '.$this->cod_equipo.'
				</div>
				<div class="col-md-3">
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
						Institución: 
					</label>
					'.$this->nombre_institucion.'
				</div>
			</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						'.$this->consultar_det_usuario_equipo_detallado('html').'
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
					$titulo='Modificar Equipo';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Equipo';
				}break;
			}
		$html= '
			<form method="post" action="?vista=equipo">
			<script type="text/javascript" src="js/js_equipo.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('equipo').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios<br></span>
			<input   id="cod_equipo" class="form-control" type="hidden" name="cod_equipo" value="'.$this->cod_equipo.'" />

		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre().'
		</div>
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_institucion().'
		</div>
			'.$this->detalle_usuarios().'
			<div class="row"><br>
				<div class="col-md-3"></div>
				'.$boton.'<br>
			</div>	
		</div>
		';
		return $html;
	
		}


	private function detalle_usuarios(){
		require_once("modelo/class_usuario.php");
		$usuario = new usuario;
		$res=$usuario->listar_para_autocomplete();
		if($res>0){
			$rows = array();
			while($row=$usuario->row()){
				 $rows[] = $row;		
				}
				$listado=json_encode($rows);
		}
		$html.='
			<br>
			<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">

			  <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#usuarios" aria-controls="usuarios" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-arrow-down"></span> Busque y seleccione los usuarios que conformarán el equipo. <span style="color:red"> Solo visualizará usuarios sin equipos.</span></a> 
					</li>
				</ul>

			  <!-- Tab panes -->
			  <div class="tab-content"> 
				<div role="tabpanel" class="tab-pane active" id="problemas">
					<div style="text-align:center" title="haga clic aqui para seleccionar los usuarios">

							<input required  value="" id="campo_buscar" type="text" class="form-control" placeholder="Buscar usuarios..." autocomplete="off" />
						
					</div>
					'.$this->tabla('').'
				</div>

			  </div>

	</div>
	</div>
	<script type="text/javascript">
	$(function() {
		$("#campo_buscar").tokenInput("control/control_ajax.php?evento=listar_usuarios", {
			overwriteClasses: {
				tokenList: "token-input-list token-input-list-wide"
			},
			hintText: "Escriba el nombre o cedula del usuario",
			noResultsText: "No hay usuarios encontrados",
			preventDuplicates: true,
			searchingText:"Buscando...",
			excludeCurrent: true,
			onAdd: function(item) {
				addRow(item.id,item.nombre,item.apellido,item.cedula);
			},
			onDelete: function(item) {
				deleteRow(item.id);
			},
			 prePopulate:'.$this->consultar_det_usuario_equipo_detallado('json').'
		});
		
		function addRow(cod_usuario,nombre,apellido,cedula) {
		
			var tabla=document.getElementById("tabla_detalle");
			
			var row = tabla.insertRow(1);
			row.id=\'fila_\'+cod_usuario;
			
			var celda1 = row.insertCell(0);
			var celda2 = row.insertCell(1);
			var celda3 = row.insertCell(2);
			var celda4 = row.insertCell(3);
			
			celda1.innerHTML="<input type=\'hidden\' name=\'cod_usuario[]\' value=\'"+cod_usuario+"\'>";
			celda2.innerHTML=cedula;
			celda3.innerHTML=nombre;
			celda4.innerHTML=apellido;

		}

		function deleteRow(cod_usuario) {
			nro_fila=document.getElementById("fila_"+cod_usuario).rowIndex;
			document.getElementById("tabla_detalle").deleteRow(nro_fila);
		}
		'.$this->consultar_det_usuario_equipo_detallado('js').'
		
		
	});
		</script>
		';
		
		return $html;
	}
	private function consultar_det_usuario_equipo_detallado($tipo){
		require_once("modelo/class_det_usuario_equipo.php");
		$det_usuario_equipo = new det_usuario_equipo;
		$det_usuario_equipo->set_cod_equipo($this->cod_equipo);
		$det_usuario_equipo->consulta_por('cod_equipo');

		while($row=$det_usuario_equipo->row()){
			$html.='<tr><td></td><td>'.$row['cedula'].'</td><td>'.$row['nombre'].'</td><td>'.$row['apellido'].'</td></tr>';
			$js.='addRow("'.$row['cod_usuario'].'","'.$row['nombre'].'","'.$row['apellido'].'","'.$row['cedula'].'");';
			$rows[]=$row;
		}
		switch($tipo){
			case 'js': return $js;
			break;
			case 'html': return $this->tabla($html);
			break;
			case 'json': return json_encode($rows);
			break;	
		}
	}
	private function tabla($codigo){
		$html.='<table class="table table-striped" id="tabla_detalle">
					<thead>
					<tr>
						<th></th>
						<th>Cedula</th>
						<th>Nombre</th>
						<th>Apellido</th>
					</tr>
					</thead>
					<tbody>
						'.$codigo.'
					</tbody>
				</table>	';
				return $html;
	}
}
?>
