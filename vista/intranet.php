   <style>
   
   </style>
 
         <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Bienvenidos
				</div>
			<div class="panel-body" id="panel" >
 
<?php

echo '
<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-heading">
			Ultimos 15 envios
		</div>
		<div class="panel-body">
			'.ultimos_envios().'
		</div>
	</div>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			Ultimos 15 concursos
		</div>
		<div class="panel-body">
			'.ultimos_concursos().'
		</div>
	</div>
</div>

';
function ultimos_concursos(){
		require_once("modelo/class_concurso.php");
		$concurso = new concurso;
		$concurso->ultimos_concursos();

		while($row=$concurso->row()){
			$fecha_final= strtotime($row['tiempo_final']);
			$fecha_inicio= strtotime($row['tiempo_inicio']);
			$fecha_actual=time();
			$color='';
			$estatus='';
			if($fecha_inicio>$fecha_actual and $fecha_final>$fecha_actual){
				$estatus='<a href="?vista=participar">Próximo</a>';
				$color='info';
				
			}
			if($fecha_inicio<$fecha_actual and $fecha_final>$fecha_actual){
				$estatus='<a href="?vista=participar&evento=reporte_html_general&cod_concurso='.$row['cod_concurso'].'" >Activo</a>';
				$color='success';
			}
			if($fecha_inicio<$fecha_actual and $fecha_final<$fecha_actual){
				$estatus='<a href="?vista=participar&evento=resultado&cod_concurso='.$row['cod_concurso'].'" >Finalizado</a>';
			}

			$td.='<tr class="'.$color.'">';
			$td.='<td>'.$row['cod_concurso'].'</td>';
			$td.='<td>'.$row['tiempo_inicio'].' VEN</td>';
			$td.='<td>'.$row['nombre_corto'].'</td>';
			$td.='<td>'.$estatus.'</td>';
			$td.='</tr>';
		}
		$html='<table class="table table-striped" style="font-size:13px"><tr>
			<th>Cod.</th>
			<th>Inicio</th>
			<th>Nombre</th>
			<th>Estatus</th>
		</tr>'.$td.'</table>';		
		return $html;
	
}
function ultimos_envios(){
		require_once("modelo/class_envio_entrenamiento.php");
		$envio = new envio_entrenamiento;
		$envio->ultimos_envios();

		while($row=$envio->row()){
			
			$td.='<tr class="'.($row['cod_msj_salida']==1 ? 'success': '').'">';
			$td.='<td>'.$row['cod_envio_entrenamiento'].'</td>';
			$td.='<td>'.$row['fecha_hora'].' VEN</td>';
			$td.='<td>'.$row['nombre_usuario'].'</td>';
			$td.='<td><a href="?vista=participar_entrenamiento&evento=formulario_envio&cod_problema='.$row['cod_problema'].'" >'.str_pad($row['cod_problema'], 4, "0", STR_PAD_LEFT).'</a></td>';
			$td.='<td>'.$row['nombre_lenguaje'].'</td>';
			switch($row['cod_msj_salida']){
					case '1': {
						$color='green';
						$icono='glyphicon glyphicon-ok';
					}
					break;
					default: {
						$color='red';
						$icono='glyphicon glyphicon-thumbs-down';
						}
					break;
			}
			$td.='<td style="color:'.$color.'"><span class="'.$icono.'"> </span> '.$row['resultado'].'</td>';
			$td.='</tr>';
		}
		$html='<table class="table table-striped" style="font-size:13px"><tr>
			<th>Cod.</th>
			<th>Fecha</th>
			<th>Usuario</th>
			<th title="Codigo del problema">Prob.</th>
			<th>Lenguaje</th>
			<th>Resultado</th>
		</tr>'.$td.'</table>';		
		return $html;
	
}

?>
</div></div></div></div></div>
