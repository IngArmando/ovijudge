<?php
	require_once("modelo/class_bitacora.php");
	class vista_bitacora extends bitacora{
		
		public function buscar(){
	 $salida.='
			<script type="text/javascript" src="js/js_bitacora.js" ></script>
			<form method="POST">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-4 col-md-4" style="text-align:left">	
						</div>
						<div class="col-xs-3 col-md-4" style="text-align:center">		
							<span style="font-size:18px">Bitacora</span>	
						</div>
						<div class="col-xs-5 col-md-4"  style="text-align:right">			
						</div>
					</div>
				</div>
				<div class="panel panel-body">
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<label>Filtrar por Usuario:</label>
								'.$this->combo_usuarios().'
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-md-offset-3">
								<label>Fecha Inicial:</label>
								<input id="fecha_inicio" class="form-control" type="text" onkeyup="this.value=this.value.toUpperCase()" name="fecha_inicio" onkeypress="return false" >
							</div>
							<div class="col-md-3">
								<label>Fecha Final:</label>
								<input id="fecha_fin" value="'.date("d-m-Y").'" class="form-control" type="text" onkeyup="this.value=this.value.toUpperCase()" name="fecha_fin" onkeypress="return false" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-3" style="text-align:center"><br>
							<button onclick="return comparar_fechas()" type="submit" name="evento" value="listar" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-list-alt"></span> MOSTRAR BITACORAS</button>
							</div>
						</div>
				</div>
			</form>
			 ';
			 return $salida;

		
	}
	public function reporte_html_general($fecha_inicio,$fecha_fin){
		global $lib_data_table;
			$lib_data_table=true;
	$this->listar_avanzado($fecha_inicio,$fecha_fin);
	$salida.='
			<script> var sub_titulo_pdf="Reporte de Bitacoras";</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class="col-xs-2 col-md-2" style="text-align:left">

		</div>
		<div class="col-xs-3 col-md-8" style="text-align:center">		
			<span style="font-size:18px">Bitacoras</span>	
		</div>
		<div class="col-xs-5 col-md-2"  style="text-align:right">			
			'.btn_regresar('bitacora').'	
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
			<th>Evento</th><th>Descripción</th><th>fecha y hora</th><th>Usuario</th></tr>
			</thead>
			<tbody>
			';
			$i=0;
	while($row=$this->row()){
	$i++;
	$salida.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:105px"> <span style=" float:left; margin-right:1px;">'.$i.' </span>
				
				
				<input type="hidden" name="cod_bitacora" value="'.$row['cod_bitacora'].'">
		</form>
	</td>
	<td>'.$row['evento'].'</td><td>'.$row['descripcion'].'</td><td>'.$row['fecha_hora_timestamp'].'</td><td>'.$row['cedula'].' '.$row['usuario_nombre'].' '.$row['usuario_apellido'].'</td>
	</tr>';
	}
	
	$salida.='
	</tbody>
		</table>
		</div>
		';
		return $salida;
	}
	
	 private function combo_usuarios(){
		 require_once("modelo/class_usuario.php");
		 $usuario = new usuario;
		 $usuario->listar();
		 while($row_usuario = $usuario->row()){
			$cedula=$row_usuario['cedula'];
			$nombre=$row_usuario['nombre_persona'];
			$apellido=$row_usuario['apellido'];
			$cod_usuario=$row_usuario['cod_usuario'];
			$options.='<option value="'.$cod_usuario.'">'.$cedula.' '.$nombre.' '.$apellido.'</option>'; 
		}
		return '<select class="form-control" name="cod_usuario"><option>Todos</option>'.$options.'</select>';
	}
}
		
?>
