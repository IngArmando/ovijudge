<?php
function tabla_posicion_entrenamiento(){
	
	$html='
<script>

			var sub_titulo_pdf="Tabla de posiciones";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
				<div class="col-md-2"></div>
					<div class="col-md-8" style="text-align:center">
					<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> TABLA DE POSICIONES</span>
				
					</div>
					<div class="col-md-2" style="text-align:right">
						'.btn_regresar('').'
					</div>
				</div>
			</div>
			<div class="body"><br>
				<table id="data_table" class="table table-striped table-bordered"  width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="40px" >Puesto</th><th>Usuario</th><th>Puntos</th>
						</tr>
					</thead>
					<tbody>
						'.posiciones().'
					
					</tbody>
						<tr><td colspan="3" style="font-size:12px">El calculo de puntos se realiza sumando los problemas resueltos en cada lenguaje de programación.</td></tr>
				</table>
			</div>
</div>
					
	';
	
					return $html;
}
function posiciones(){
	require_once("modelo/class_usuario.php");
	$usuario = new usuario;
	$usuariob = new usuario;
	$usuario->listar();
	$i=0;
	while($row=$usuario->row()){
		$usuariob->set_cod_usuario($row['cod_usuario']);
		$pts=$usuariob->puntaje();		
		if($pts>0){
			
			$resultado[$row['cod_usuario']]=$pts;
		}
	}
	arsort($resultado);
	foreach($resultado as $cod_usuario=>$puntaje){
			$usuario->set_cod_usuario($cod_usuario);
			$usuario->consultar();
			$i++;
			$html.='<tr><td style="text-align:center">'.$i.'</td><td>'.$usuario->nombre.' '.$usuario->apellido.'</td><td>'.$puntaje.'</td></tr>';
	}

	return $html;
}
echo tabla_posicion_entrenamiento();

?>
