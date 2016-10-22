<?php
ini_set('display_errors','OFF');
//error_reporting(E_ALL ^E_NOTICE ^E_DEPRECATED);
session_start();
date_default_timezone_set("America/Manaus"); 
	//INCLUIMOS LAS CLASES
	require_once("vista/participar.php");
	include_once("modelo/class_concurso.php");
	//METODOS DE ENTRADA
	$evento 			= $_POST["evento"] ? $_POST["evento"] : $_GET["evento"];
	$cod_problema		= $_GET["cod_problema"];
	$nombre				=$_POST["nombre"];
	$limite_tiempo		=$_POST["limite_tiempo"];
	$limite_memoria		=$_POST["limite_memoria"];
	$texto_problema		=$_FILES["texto_problema"];
	$texto_problema_viejo=$_POST["texto_problema_viejo"];
	$tipo_texto_problema=$_POST["tipo_texto_problema"];
	$cod_usuario		=$_SESSION['cod_usuario'];
	$codigo_fuente		=$_POST['codigo_fuente'];
	
	$cod_lenguaje_prog=$_POST["cod_lenguaje_prog"];
	$cod_concurso=$_GET['cod_concurso'];
	//INSTANCIAMOS EL OBJETO Y APLICAMOS LOS METODOS SET
	
		$participar = new participar;
		
		$participar->set_cod_problema($cod_problema);
		$participar->set_nombre($nombre);
		$participar->set_limite_tiempo($limite_tiempo);
		$participar->set_limite_memoria($limite_memoria);
		$participar->set_texto_problema($texto_problema,$texto_problema_viejo);			
		$participar->set_cod_problema($cod_problema);
		$participar->set_codigo_fuente($codigo_fuente);
		$participar->set_cod_lenguaje_prog($cod_lenguaje_prog);
		$participar->set_cod_concurso($cod_concurso);
		$participar->set_cod_equipo($_SESSION['cod_equipo']);
		$participar->tipo='concurso';
		$participar->nombre_equipo="<span style='font-size:15px'>Mi equipo: <b>".$_SESSION['nombre_equipo']."</b></span>";
			
		$tiempo_adicional_por_fallo=1200; //segundos
		$tiempoa=$participar->consulta_tiempo_inicio_final_concurso();
		$tiempo_inicio=$tiempoa['tiempo_inicio'];
		$tiempo_desconjelar=$tiempoa['tiempo_desconjelar'];
		$participar->consultar_problemas_del_concurso_detallado();
		while($row=$participar->row()){
				$row_problemas[]=$row;
				$th_problema.='<th style="text-align:center">'.$row['nombre'].' <span style="color:'.$row['color'].'" class="glyphicon glyphicon-certificate"></span></th>';
		}
		
		$tr.='
		<thead>
		<tr>
			<th width="50">Puesto</th>
			<th style="text-align:center">Equipo</th>
			<th style="text-align:center">Puntaje</th>
			'.$th_problema.'
			<th style="text-align:center">Tiempo (min)</th>
			</tr>
		</thead>	
		<tbody>
		';
		$participar->listar_equipos_concurso();
		$i=0;
		$envio= new envio;
		$envio->set_cod_concurso($participar->cod_concurso);
		while($row=$participar->row()){
			$envio->set_cod_equipo($row['cod_equipo']);
			$resultados[$row['cod_equipo']]=construir_arreglo_resultados($row_problemas,$envio,$p,$tiempo_inicio);
			$nombre_equipo[$row['cod_equipo']]=$row['nombre'];
		}	
			//Resumen general para poder ordenar
		if(isset($resultados)){
			$resumen=resumen_resultados($resultados);
			actualizar_tabla_posiciones_concurso($resumen,$tiempo_desconjelar,$cod_concurso);
			$i=0;
			foreach($resumen as $cod_equipo=>$puntaje_general){
				$puntaje=0;
				$i++;
				$tiempo_total[$cod_equipo]=0;
				foreach($resultados[$cod_equipo] as $res){
					$color='';
					if($res['correcto']){
						$color='#71FF85';
						$puntaje+=1;
					}elseif($res['incorrecto']){
						$color='#FE8494';
					}
					$tiempo_total[$cod_equipo]+=$res['tiempo'];
					$td_resultado.='<td style="background:'.$color.'">'.$res['intento'].'/'.$res['tiempo'].'</td>';
				}
					$tr.='<tr style="text-align:right"><td>'.$i.'</td><td><a href="?vista=equipo&cod_equipo='.$cod_equipo.'&evento=reporte_html_individual&ref=participar"> '.$nombre_equipo[$cod_equipo].'</a></td><td>'.$puntaje.'</td>'.$td_resultado.'<td>'.$tiempo_total[$cod_equipo].'</td></tr>';
					$td_resultado='';
			}
		}
			
		$cod_concurso=$_GET['cod_concurso'];
		$concurso = new concurso;
		$concurso->set_cod_concurso($cod_concurso);
		$concurso->consultar();
		$html='
			<table style="font-size:12px" id="tabla_resultado" class="table table-striped table-bordered">'.$tr.'</tbody></table>

			<script>
			$(document).ready(function() {
				var table= $("#tabla_resultado").DataTable({
				"paging":   false,
				
				"filter": false,
				
				language:{
						"decimal":        "",
						"emptyTable":     "No hay datos disponibles en la tabla",
						"info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
						"infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
						"infoFiltered":   "(filtrado para _MAX_ total entradas)",
						"infoPostFix":    "",
						"thousands":      ",",
						"lengthMenu":     "Mostrar _MENU_ entradas",
						"loadingRecords": "Cargando...",
						"processing":     "Procesando...",
						"search":         "Buscar:",
						"zeroRecords":    "No hay registros que mostrar",
						"paginate": {
							"first":      "Primero",
							"last":       "Ultimo",
							"next":       "Siguiente",
							"previous":   "Anterior"
						},
						"aria": {
							"sortAscending":  ": Activar para ordenar la columna de manera ascendente",
							"sortDescending": ": Activar para ordenar la columna de manera descendente"
						}
				}
				});
	
				
				
			} );
			</script>
		';
		echo $html;		
function actualizar_tabla_posiciones_concurso($resumen,$tiempo_desconjelar,$cod_concurso){
	$tiempo_actual=time();
	$tiempo_desconjelar=strtotime($tiempo_desconjelar);
	$tiempo_desactivar=$tiempo_desconjelar+10;

	if($tiempo_actual<$tiempo_desactivar and $tiempo_actual>=$tiempo_desconjelar){
		require_once("modelo/class_tabla_posicion.php");
		$tabla_posicion= new tabla_posicion;
		$tabla_posicion->set_cod_concurso($cod_concurso);
		$cod_concursoa=$tabla_posicion->nuevo();
		if($cod_concursoa==$cod_concurso){
				$i=3;
					foreach($resumen as $cod_equipo=>$puntaje_general){
						$tabla_posicion->set_cod_equipo($cod_equipo);
						$tabla_posicion->set_puntaje($i);
						$tabla_posicion->registrar();
						$i--;
						if($i==0) break;
					}
		}
	}
}
?>
