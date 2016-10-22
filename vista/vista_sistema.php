<?php
require_once("vista/campo/campo_vista_sistema.php");

class vista_sistema_b extends campo_vista_sistema{
		
	public function reporte_html_general($vista){
		global $lib_data_table;
			$lib_data_table=true;
			$this->listar_todo();
			$parametro['tipo']='consulta_nuevo';
			$salida.='
			<script> var sub_titulo_pdf="Reporte de Vistas del Sistema";</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
					'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
					<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Vistas del sistema</span>					
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
					<th>Nombre del archivo</th><th>Descripción</th><th>Servicio</th><th>Modulo</th></tr>
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
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
		
		</span>
				'.$botonera.'
				<input type="hidden" name="cod_vista_sistema" value="'.$row['cod_vista_sistema'].'">
		</form>
	</td>
	<td>'.$row['nombre'].'</td><td>'.$row['descripcion'].'</td><td>'.$row['nombre_servicio'].'</td><td>'.$row['nombre_modulo'].'</td>
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
				$titulo='Modificar vistas del sistema';
			}break;
			case 'registrar':{
				$boton=botones('registrar');
				$titulo='Agregar nueva vista para el  sistema';
			}break;
		}
	$html= '
	<script type="text/javascript" src="js/js_vista_sistema.js" ></script>
	
	<script type="text/javascript" src="js/js_usuario_admin.js" ></script>
		<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span>'.$titulo.'</span></div>
					<div class="col-md-3">'.botones('regresar').'</div>
				</div>
			</div>
			<div class="panel-body">	
	
	
	<form method="POST" autocomplete="off" action="?vista=vista_sistema">
<span style="float:right; color:red">(*) Campos obligatorios</span>
	<input readonly id="cod_vista_sistema" class="form-control" type="hidden" name="cod_vista_sistema" value="'.$this->cod_vista_sistema.'" />

		<div class="row">
			<div class="col-md-3"></div>
			'.$this->nombre().'
		</div>


		<div class="row">
			<div class="col-md-3"></div>
			'.$this->descripcion().'
		</div>


		<div class="row">
			<div class="col-md-3"></div>
			'.$this->tipo_apertura().'
			'.$this->visible().'
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			'.$this->cod_servicio().'
		</div>

		<div class="row">
			<div class="col-md-3"></div>
			'.$this->eventos_vista().'
		</div>
		<div class="row"><br>
			<div class="col-md-3"></div>
			'.$boton.'
		</div>		
</form>
</div>
</div>
		';
		return $html;
	}
	public function reporte_html_individual(){
		parent::consultar();
	$html.= '
			
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta de la vista del sistema</span></div>
					<div class="col-md-3">'.botones('regresar').'</div>
				</div>
			</div>
			<div class="panel-body">
		<div class="row">
			<div class="col-md-3 col-md-offset-3">
				<label>
					Nombre del archivo: 
				</label><br>
					'.$this->nombre.'
			</div>
			<div class="col-md-3 ">
				<label>
					Tipo de apertura: 
				</label><br>
				'.($this->tipo_apertura ? 'Misma Pagina (_SELF)' : 'Pagina Aparte (_BLANK)').'
			</div>
		</div>


		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<label>
					Descripción ó nombre en el menu:
				</label><br>
					'.$this->descripcion.'
			</div>
		</div>


		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<label>
					Servicio:
				</label><br>
					'.$this->nombre_servicio.'
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<label>
					Eventos de la vista
				</label><br>
					'.($this->consultar=='1' ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>').' Consultar
					'.($this->registrar=='1' ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>').' Registrar
					'.($this->actualizar=='1' ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>').' Actualizar
					'.($this->eliminar=='1' ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>').' Eliminar
					'.($this->desactivar=='1' ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>').' Desactivar
				
			</div>
		</div>
	</div>
	
		';
		return $html;
	}
}
?>
