<?php
	require_once("modelo/class_tipo_usuario.php");
	class vista_tipo_usuario extends tipo_usuario{
		
		public function reporte_html_individual(){
			parent::consultar();
		$titulo='Rol de Usuarios';
		$html.='
		<form method="post" action="?vista=tipo_usuario">
		<script type="text/javascript" src="js/js_tipo_usuario.js" ></script>
			<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-4 col-md-4" style="text-align:left">
								
					</div>
					<div class="col-xs-3 col-md-4" style="text-align:center">		
						<span style="font-size:18px">'.$titulo.'</span>	
					</div>
					<div class="col-xs-5 col-md-4"  style="text-align:right">			
						<div style="float:right; margin-top:-4px;" >
						</div>
						<a class="btn btn-default btn-sm" href="?vista=tipo_usuario"  style="float:right;">
							<span class="glyphicon glyphicon-arrow-left"></span>
							Regresar
						</a>
					</div>
				</div>
			</div>			
			<div class="panel-body">
				<input readonly id="cod_tipo_usuario" class="form-control" type="hidden" name="cod_tipo_usuario" value="'.$this->cod_tipo_usuario.'" />

					<div class="row">
						<div class="col-md-6 col-md-offset-3 center">
							
							<label>
								Nombre del Rol:
							</label>
								'.$this->nombre.'
						</div>
					</div>

					'.$this->detalle_transaccion_html().'</form>';
					return $html;
			
		}
		
		
	public function formulario($tipo){
			switch($tipo){
				case 'modificar': {
					parent::consultar();
					$boton=botones('modificar');
					$titulo='Modificar Rol de Usuarios';
					$bloqueo=true;
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Rol de Usuarios';
				}break;
			}
		
		$html.='
		<form method="post" action="?vista=tipo_usuario">
		<script type="text/javascript" src="js/js_tipo_usuario.js" ></script>
			<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-4 col-md-4" style="text-align:left">
								
					</div>
					<div class="col-xs-3 col-md-4" style="text-align:center">		
						<span style="font-size:18px">'.$titulo.'</span>	
					</div>
					<div class="col-xs-5 col-md-4"  style="text-align:right">			
						<div style="float:right; margin-top:-4px;" >
						</div>
						<a class="btn btn-default btn-sm" href="?vista=tipo_usuario"  style="float:right;">
							<span class="glyphicon glyphicon-arrow-left"></span>
							Regresar
						</a>
					</div>
				</div>
			</div>			
			<div class="panel-body">
				<span style="float:right; color:red">(*) Campos obligatorios</span>


				<input readonly id="cod_tipo_usuario" class="form-control" type="hidden" name="cod_tipo_usuario" value="'.$this->cod_tipo_usuario.'" />

					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<label>
								Nombre <span style="color:red" title="Campo obligatorio">(*)</span>
							</label>
								<input id="nombre" class="form-control"  type="text" onkeyup="this.value=this.value.toUpperCase()" name="nombre" value="'.$this->nombre.'" />
						</div>
					</div>

					'.$this->detalle_transaccion().$boton.'</form>';
					return $html;
			
		}
		public function reporte_html_general($vista){
			global $lib_data_table;
			$lib_data_table=true;
			$this->listar();
			$parametro['tipo']='consulta_nuevo';
			$salida.='
			<script> var sub_titulo_pdf="Reporte de Roles de Usuarios";</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-4 col-md-4" style="text-align:left">
										'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'
										
							</div>
							<div class="col-xs-3 col-md-4" style="text-align:center">		
								<span style="font-size:18px">Roles de Usuarios</span>	
							</div>
							<div class="col-xs-5 col-md-4"  style="text-align:right">			
								<div style="float:right; margin-top:-4px;" >
								</div>
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
				$ancho=strlen($botonera)/5.1;
			$salida.='
			<tr>
			<td class="td_botones">
			
				<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> 
				<span style=" float:left; margin-right:1px;">'.$i.' </span>
						'.$botonera.'
						<input type="hidden" name="cod_tipo_usuario" value="'.$row['cod_tipo_usuario'].'">
				</form>
			</td>
			<td>'.$row['nombre'].'</td>
			</tr>';
			}
			
			$salida.='
			</tbody>
				</table>
				</div>
				';
				return $salida;
	}



public function detalle_transaccion(){
	$salida.='
<ul class="nav nav-tabs" id="myTab">
	<li>
		<a href="#privilegio" data-toggle="tab">Privilegios</a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane active" id="privilegio">
	
		'.$this->mostrar_detalle_checked_privilegio().'
	</div>
</div>'; 
	return $salida;
}
public function detalle_transaccion_html(){
	$salida.='
<ul class="nav nav-tabs" id="myTab">
	<li class="active">
		<a href="#privilegio" data-toggle="tab">Privilegios</a>
	</li>
</ul>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="privilegio">
	
		'.$this->mostrar_detalle_checked_html_privilegio().'
	</div>
</div>'; 
	return $salida;
}
public function mostrar_detalle_checked_privilegio(){
		require_once("modelo/class_vista_sistema.php");
		$vista_sistema = new vista_sistema;
		$vista_sistema->listar();
		$salida.='<table class="table table-striped">
		<tr><th></th><th>Vista</th><th>Permisos</th><th>Servicio</th><th>Modulo</th></tr>
		';
			$privilegio = new privilegio;
			$privilegio->set_cod_tipo_usuario($this->cod_tipo_usuario);
			$privilegio->consulta_por('cod_tipo_usuario');
			while($get_privilegio=$privilegio->row()){
				$row_privilegio[]=$get_privilegio;
			}
		while($row_vista_sistema=$vista_sistema->row()){
			$cod_vista_sistema=$row_vista_sistema['cod_vista_sistema'];
			$nombre_servicio=$row_vista_sistema['nombre_servicio'];
			$nombre_modulo=$row_vista_sistema['nombre_modulo'];
			$registrar=$row_vista_sistema['registrar'];
			$consultar=$row_vista_sistema['consultar'];
			$eliminar=$row_vista_sistema['eliminar'];
			$desactivar=$row_vista_sistema['desactivar'];
			$actualizar=$row_vista_sistema['actualizar'];
			$privilegio=$this->buscar_detalle_checked_privilegio($row_privilegio,$cod_vista_sistema);
			$salida.='
			<tr>
				<td><input type="checkbox" '.($privilegio['cod_vista_sistema'] ? "checked" : "").' name="privilegio_cod_vista_sistema[]" value="'.$cod_vista_sistema.'"></td><td>'.$row_vista_sistema['descripcion'].'</td>
				<td>';
				if(!$registrar and !$consultar and !$actualizar and !$eliminar and !$desactivar)
					$salida.='No requiere permisos especiales';
				else{
					if($registrar)
						$salida.='<input value="1" '.($privilegio['registrar'] ? "checked" : "").' name="permiso_r['.$cod_vista_sistema.']" type="checkbox" title="Registrar">R ';
					if($consultar)
						$salida.='<input value="1" '.($privilegio['consultar'] ? "checked" : "").' name="permiso_c['.$cod_vista_sistema.']" type="checkbox" title="Consultar">C ';
					if($actualizar)
						$salida.='<input value="1" '.($privilegio['actualizar'] ? "checked" : "").' name="permiso_a['.$cod_vista_sistema.']" type="checkbox" title="Actualizar">A ';
					if($eliminar)
						$salida.='<input value="1" '.($privilegio['eliminar'] ? "checked" : "").' name="permiso_e['.$cod_vista_sistema.']" type="checkbox" title="Eliminar">E ';
					if($desactivar)
						$salida.='<input value="1" '.($privilegio['desactivar'] ? "checked" : "").' name="permiso_d['.$cod_vista_sistema.']" type="checkbox" title="Activar o Desactivar">D ';
				}
				
				
			$salida.='</td>
				<td>'.$nombre_servicio.'</td>
				<td>'.$nombre_modulo.'</td>
			</tr>';
		}
		$salida.="</table>";
		return $salida;
	}
public function mostrar_detalle_checked_html_privilegio(){
		require_once("modelo/class_vista_sistema.php");
		$vista_sistema = new vista_sistema;
		$vista_sistema->listar();
		$salida.='<table class="table table-striped">
		<tr><th>Vista</th><th>Permisos</th><th>Servicio</th><th>Modulo</th></tr>
		';
			$privilegio = new privilegio;
			$privilegio->set_cod_tipo_usuario($this->cod_tipo_usuario);
			$privilegio->consultar_por_cod_tipo_usuario_privilegio();
			while($row=$privilegio->row()){
			$cod_vista_sistema=$row['cod_vista_sistema'];
			$nombre_servicio=$row['nombre_servicio'];
			$nombre_modulo	=$row['nombre_modulo'];
			$registrar		=$row['registrar'];
			$consultar		=$row['consultar'];
			$eliminar		=$row['eliminar'];
			$desactivar		=$row['desactivar'];
			$actualizar		=$row['actualizar'];
				$salida.='
			<tr>
				<td>'.$row['descripcion'].'</td>
				<td>';
				
			if(!$registrar and !$consultar and !$actualizar and !$eliminar and !$desactivar){
					$salida.='No requiere permisos especiales.';
			}else{
				if($registrar==1)
					$permisos='Registrar, ';
				if($consultar==1)
					$permisos.='Consultar, ';
				if($actualizar==1)
					$permisos.='Actualizar, ';
				if($eliminar==1)
					$permisos.='Eliminar, ';
				if($desactivar==1)
					$permisos.='Activar y Desactivar';
				
				$salida.=rtrim($permisos,', ').'.';
				$permisos='';
			}
			
			
			$salida.='</td>
				<td>'.$nombre_servicio.'</td>
				<td>'.$nombre_modulo.'</td>
			</tr>';	
			}
		$salida.="</table>";
		return $salida;
	}
	
public function buscar_detalle_checked_privilegio($row,$valor){
		for($i=0 ; $i<count($row); $i++){
			if($row[$i]['cod_vista_sistema']==$valor){
			return $row[$i];
			}
		}
	}
	}





	
?>

