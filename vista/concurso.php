<?php
require_once("vista/campo/campo_concurso.php");
class vista_concurso extends campo_concurso{
	
	public function reporte_html_general($vista){
			global $lib_data_table;
	$lib_data_table=true;
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Concursos";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general_sin_orden.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Concursos</span>					
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
			<th>Nombre</th>
			<th>Nombre corto</th>
			<th>Inicio</th>
			<th>Congelar resultados</th>
			<th>Finalizar concurso</th>
			<th>Mostrar resultados</th>
			
			</tr>
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
	<td class="td_botones" style="text-align:center">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
		
			</span>
				'.$botonera.' '.($row['cod_usuario_reg']==$_SESSION['cod_usuario'] ? '<button type="submit" name="evento" value="certificar" class="btn btn-default btn-xs"> <span class="glyphicon glyphicon-print"></span> Certificado</button>' : '').'

							<input type="hidden" name="cod_concurso" value="'.$row['cod_concurso'].'">
		</form>
	</td>
	<td>'.$row['nombre'].'</td>
	<td>'.$row['nombre_corto'].'</td>
	<td>'.$row['tiempo_inicio'].' VEN</td>
	<td>'.$row['tiempo_conjelacion'].' VEN</td>
	<td>'.$row['tiempo_final'].' VEN</td>
	<td>'.$row['tiempo_desconjelar'].' VEN</td>
	
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada del concurso</span></div>
					<div class="col-md-3">'.btn_regresar('concurso').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Codigo unico:
					</label>
					 '.$this->cod_concurso.'
				</div>
			</div>
		
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Nombre: 
					</label>
					'.$this->nombre.'
				</div>
			</div>
		
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Nombre corto: 
					</label>
					'.$this->nombre_corto.'
				</div>
				<div class="col-md-3">
				</div>
			</div>
		

		
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Tiempo de inicio: 
					</label>
					'.$this->tiempo_inicio.'
				</div>
				<div class="col-md-3">
					<label>
						Tiempo de congelación: 
					</label>
					'.$this->tiempo_conjelacion.'
				</div>
			</div>
		

			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Tiempo finalización: 
					</label>
					'.$this->tiempo_final.'
				</div>
				<div class="col-md-3">
					<label>
						Tiempo de congelación: 
					</label>
					'.$this->tiempo_desconjelar.'
				</div>
			</div>
		

			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-3">
					<label>
						Estatus: 
					</label>
					'.($this->estatus ? 'Activo' : 'Inactivo').'
				</div>
			</div>
		
			<div class="row">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						'.$this->consultar_problemas_del_concurso_detallado_html().'
					</div>
		
				</div>
			</div>
		';
		return $html;
	
		}
	public function formulario($tipo){
		global $lib_calendario;
		$lib_calendario=true;
			switch($tipo){
				case 'modificar': {
					parent::consultar();
					$boton=botones('modificar');
					$titulo='Modificar Concurso';
					$js='<script type="text/javascript" src="js/js_concurso_modificar.js" ></script>';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Concurso';
					$js='<script type="text/javascript" src="js/js_concurso_registrar.js" ></script>';
				}break;
			}
		$html= '
			<form method="post" action="?vista=concurso">
			'.$js.'
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('concurso').'</div>
					</div>
				</div><br>
			<span style="float:right; color:red">Todos los son Campos obligatorios</span>
			<input readonly id="cod_concurso" class="form-control" type="hidden" name="cod_concurso" value="'.$this->cod_concurso.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre_corto().'
					'.$this->tiempo_inicio().'
		</div>



	
		<div class="row">
					<div class="col-md-3"></div>
					
					'.$this->tiempo_conjelacion().'
					'.$this->tiempo_final().'
		</div>


	
		<div class="row">
					<div class="col-md-3"></div>
					
					'.$this->tiempo_desconjelar().'
					
		</div>

	


			'.$this->detalle_problemas().'
			<div class="row"><br>
				<div class="col-md-3"></div>
				'.$boton.'<br>
			</div>	
		</div>
		';
		return $html;
	
		}	
	private function detalle_problemas(){
	require_once("modelo/class_problema.php");
	$problema = new problema;
	$res=$problema->listar_para_autocomplete();
	if($res>0){
		$rows = array();
		while($row=$problema->row()){
			 $rows[] = $row;		
			}
			$listado=json_encode($rows);
	}
	$html.='
		<br>
		<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">

		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#problemas" aria-controls="problemas" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-arrow-down"></span> Busque y seleccione los problemas para el concurso</a> </li>
			</ul>

		  <!-- Tab panes -->
		  <div class="tab-content"> 
			<div role="tabpanel" class="tab-pane active" id="problemas">
				<div style="text-align:center" title="haga clic aqui para seleccionar los problemas">

						<input  value="" id="campo_buscar" type="text" class="form-control" placeholder="Buscar problemas..." autocomplete="off" />
					
				</div>
				'.$this->tabla('').'
			</div>

		  </div>

</div>
</div>
<script type="text/javascript">
$(function() {
	$("#campo_buscar").tokenInput("control/control_ajax.php?evento=listar_problemas", {
		overwriteClasses: {
			tokenList: "token-input-list token-input-list-wide"
		},
		hintText: "Escriba el nombre o codigo del problema",
		noResultsText: "No hay problemas encontrados",
		preventDuplicates: true,
		searchingText:"Buscando...",
		excludeCurrent: true,
		onAdd: function(item) {
			addRow(item.id,item.name,1,"");
		},
		onDelete: function(item) {
			deleteRow(item.id);
		},
		 prePopulate:'.$this->consultar_problemas_del_concurso().'
	});
	
	function addRow(probId,nombre,puntos,color) {
	
		var tabla=document.getElementById("tabla_detalle");
		
		var row = tabla.insertRow(1);
		row.id=\'fila_\'+probId;
		
		var celda1 = row.insertCell(0);
		var celda2 = row.insertCell(1);
		var celda3 = row.insertCell(2);
		var celda4 = row.insertCell(3);
		
		celda1.innerHTML=probId+"<input type=\'hidden\' name=\'cod_problema[]\' value=\'"+probId+"\'>";
		celda2.innerHTML=nombre;
		celda3.innerHTML="<input readonly required value=\'"+puntos+"\' type=\'hidden\' min=\'1\' class=\'form-control\' name=\'puntos[]\' \>";
		celda4.innerHTML="<input type=\'color\' value=\'"+color+"\'  class=\'form-control\' name=\'color[]\' title=\'Color del problema y del globo\' \>";

	}

	function deleteRow(probId) {
		nro_fila=document.getElementById("fila_"+probId).rowIndex;
		document.getElementById("tabla_detalle").deleteRow(nro_fila);
	}
	'.$this->consultar_problemas_del_concurso_detallado().'
	
	
});
	</script>
	';
	
	return $html;
	}
	private function consultar_problemas_del_concurso(){
		require_once("modelo/class_problema_concurso.php");
		$problema_concurso = new problema_concurso;
		$problema_concurso->set_cod_concurso($this->cod_concurso);
		$problema_concurso->consultar_problemas_del_concurso();
		while($row=$problema_concurso->row()){
			$rows[]=$row;
		}
		return json_encode($rows);
	}
	private function consultar_problemas_del_concurso_detallado(){
		require_once("modelo/class_problema_concurso.php");
		$problema_concurso = new problema_concurso;
		$problema_concurso->set_cod_concurso($this->cod_concurso);
		$problema_concurso->consultar_problemas_del_concurso_detallado();
		while($row=$problema_concurso->row()){
			$js.='
			addRow("'.$row['cod_problema'].'","'.$row['nombre'].'","'.$row['puntos'].'","'.$row['color'].'");';
		}
		return $js;
		
	}
	private function consultar_problemas_del_concurso_detallado_html(){
		require_once("modelo/class_problema_concurso.php");
		$problema_concurso = new problema_concurso;
		$problema_concurso->set_cod_concurso($this->cod_concurso);
		$problema_concurso->consultar_problemas_del_concurso_detallado();
			$html='';
		while($row=$problema_concurso->row()){
			$html.='
			<tr><td>'.$row['cod_problema'].'</td><td>'.$row['nombre'].'</td><td></td><td style="background:'.$row['color'].'"></td></tr>';
		}
		$html=$this->tabla($html);
		
		return $html;
		
	}
	private function tabla($codigo){
		$html.='<table class="table table-striped" id="tabla_detalle">
					<thead>
					<tr>
						<th>Codigo</th>
						<th>Nombre</th>
						<th></th>
						<th>Color</th>
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
