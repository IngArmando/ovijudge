<?php
function tabla_posicion(){
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
							<th width="40px">Puesto</th><th>Equipo</th><th>Puntos</th>
						</tr>
					</thead>
					<tbody>
						'.posiciones().'
						<tr><td colspan="3" style="font-size:12px">El calculo de puntos se realiza sumando los resultados de cada concurso.</td></tr>
						<tr><td style="font-size:12px">1er lugar</td><td style="font-size:12px">3 puntos</td></tr>
						<tr><td style="font-size:12px">2do lugar</td><td style="font-size:12px">2 puntos</td></tr>
						<tr><td style="font-size:12px">3er lugar</td><td style="font-size:12px">1 punto</td></tr>
					</tbody>

				</table>
			</div>
</div>
					
	';
					return $html;
}
function posiciones(){
	require_once("modelo/class_tabla_posicion.php");
	$tabla_posicion = new tabla_posicion;
	$tabla_posicion->listar_posiciones();
	$i=0;
	while($row=$tabla_posicion->row()){
		$i++;
		$html.='<tr>
					<td style="text-align:center">'.$i.'</td>
					<td><a href="index.php?vista=equipo&cod_equipo='.$row['cod_equipo'].'&evento=reporte_html_individual&ref=tabla_posicion">'.$row['nombre'].'</a></td>
					<td>'.$row['puntaje'].'</td>
				</tr>';
		
	}

	return $html;
}

echo tabla_posicion();
?>
