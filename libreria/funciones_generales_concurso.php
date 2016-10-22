<?php
//Funciones generales para el modulo Concursos
function titulo_menu($cod_concurso,$evento){
$html.='
	<ul class="nav nav-tabs">
		<li role="presentation" '.($evento=='reporte_html_general' ? 'class="active"' : '').'><a href="?vista=participar&evento=reporte_html_general&cod_concurso='.$cod_concurso.'">Problemas</a></li>
		<li role="presentation" '.($evento=='resultado' ? 'class="active"' : '').' ><a href="?vista=participar&evento=resultado&cod_concurso='.$cod_concurso.'">Resultados</a></li>
	</ul>
	';
	return $html;
}
function tiempo_restante($cod_concurso,$tiempo_inicio,$tiempo_final,$tipo){
$html.='
<script type="text/javascript" src="libreria/TimeCircles/TimeCircles.js"></script>
<link href="libreria/TimeCircles/TimeCircles.css" rel="stylesheet">   

<script>
	
$(function() {
	$(".tiempo_restante").TimeCircles({
	time:{
	Days: { text: "Dias", show: false },
	Hours: { text: "Horas" },
	Minutes: { text: "Minutos" },
	Seconds: { text: "Segundos" }
	},
	count_past_zero: false
	
	})
	.addListener(
    function(unit,value,total) { 
		'.($tipo=='final' ? 'if (total==0) setTimeout(cargar_resultado,2000)' : '').'
    } 
  ); 
});

</script>
	
	<div style=" float:right; height:80px; " class="tiempo_restante" data-timer="'.(strtotime($tiempo_final)-time()).'"></div>

';	
return $html;
	
}
function btn_entrar_concurso($cod_concurso){

		return '<a class="btn btn-primary" href="?vista=participar&evento=reporte_html_general&cod_concurso='.$cod_concurso.'"><span class="glyphicon glyphicon-education"></span> Entrar</a>';
	
}
function tiempo_restante_b($cod_concurso,$tiempo_inicio,$tiempo_final){
$html.='
<script type="text/javascript" src="libreria/contador/jquery.countdown.min.js"></script>
 
	<script>
	var tiempo_evento			= '.strtotime($tiempo_inicio).';
	var tiempo_actual_servidor	='.time().';
	var tiempo_actual_cliente	=Math.floor(new Date().getTime() / 1000);
	var diferencia	=tiempo_actual_servidor-tiempo_actual_cliente;
	if(Math.abs(diferencia)>1){
		tiempo_evento=tiempo_evento-diferencia;
	}
	var tiempo_real_restante	= new Date(tiempo_evento*1000);	
	
	$(function() {
		$("#tiempo_restante").countdown(tiempo_real_restante)
			.on("update.countdown", function(event) {
			 var format = "%H:%M:%S";
			 if(event.offset.days > 0) {
			 format = "%-d dia%!d " + format;
			 }
			 if(event.offset.weeks > 0) {
			  format = "%-w semana%!w " + format;
			 }
			 $(this).html(event.strftime(format));
			})
			.on("finish.countdown", function(event) {
			$(this).html(\''.btn_entrar_concurso($cod_concurso).'\')
			.parent().addClass("disabled");
		});	
	});	
	</script>
<div id="tiempo_restante" ></div>
';	
return $html;
	
}
function tiempo_restante_c($cod_concurso,$tiempo_final){
$html.='
<script type="text/javascript" src="libreria/contador/jquery.countdown.min.js"></script>
 
	<script>
	var tiempo_evento			= '.strtotime($tiempo_final).';
	var tiempo_actual_servidor	='.time().';
	var tiempo_actual_cliente	=Math.floor(new Date().getTime() / 1000);
	var diferencia	=tiempo_actual_servidor-tiempo_actual_cliente;
	if(Math.abs(diferencia)>1){
		tiempo_evento=tiempo_evento-diferencia;
	}
	var tiempo_real_restante	= new Date(tiempo_evento*1000);	
	
	$(function() {
		$("#tiempo_restante").countdown(tiempo_real_restante)
			.on("update.countdown", function(event) {
			 var format = "Tiempo restante: %H:%M:%S";
			 if(event.offset.days > 0) {
			 format = "%-d dia%!d " + format;
			 }
			 if(event.offset.weeks > 0) {
			  format = "%-w semana%!w " + format;
			 }
			 $(this).html(event.strftime(format));
			})
			.on("finish.countdown", function(event) {
			$(this).html(\'CONCURSO FINALIZADO!\');
			location.href="index.php?vista=participar&evento=resultado&cod_concurso='.$cod_concurso.'";
			
			.parent().addClass("disabled");
		});	
	});	
	</script>
<div id="tiempo_restante" ></div>
';	
return $html;
	
}

		function formulario_envio($thisa,$cod_envio,$tiempo_restante){
			//El cod_envio no se llama directo de la clase porque actualmente tenemos dos clases diferentes de concurso y entrenamiento
		$html= '
		<script>
			function cargando(){
			 document.getElementById("ventana_codigo").style.display = "none";
			 document.getElementById("loader").style.display = "inline";
			
			}
		</script>
		<form method="post" id="formulario_envio" onsubmit="cargando()">
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3">'.$tiempo_restante.'</div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user">
						</span> Enviar Solución</span>
					</div>
					<div class="col-md-3">'.($thisa->tipo=='concurso' ? btn_regresar('participar&evento=reporte_html_general&cod_concurso='.$thisa->cod_concurso) : btn_regresar('participar_entrenamiento')).'</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2">
						<label>Lenguaje de Prog.</label>
							'.lenguajes($thisa).'
					</div>
					<div class="col-md-7" style="text-align:center">
						<label>Problema:</label><br>
						<input id="cod_problema" type="hidden" value="'.$thisa->cod_problema.'" name="cod_problema" >
							'.$thisa->nombre.', <a href="?vista=problema&evento=enunciado&cod_problema='.$thisa->cod_problema.'" target="blank" >Ver enunciado (PDF)</a>
					</div>

					<div class="col-md-3" style="text-align:center">
					<label>Resultado:</label><br>
					'.resultados($thisa,$cod_envio).'
					</div>
					';
			$html.='
				</div>
				<div class="row">
					<div class="col-md-12" id="loader" style="text-align:center; display:none;"><img src="images/preloader.gif"><br>Analizando codigo...</div>
					<div class="col-md-12" id="ventana_codigo">
						<label>Escriba o pegue aqui su codigo:</label>';
												
						$html.='<div id="editor">'.htmlspecialchars($thisa->codigo_fuente).'</div>
						
					</div>
				</div>
			<div class="row">
				<div class="col-md-3"><textarea id="codigo_fuente" name="codigo_fuente" style="display: none;">'.($thisa->codigo_fuente).'</textarea></div>
				<div class="col-md-6 center"><br>
					<button name="evento" value="registrar" class="btn btn-default btn-lg">ENVIAR</button>
				</div>
			</div>
			</div>
			</div>
		</form>
		<script src="libreria/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
		<script>
			var editor = ace.edit("editor");
			var textarea = $("#codigo_fuente");
			editor.setTheme("ace/theme/chrome");
			editor.session.setMode("ace/mode/'.lenguaje_prog($thisa->cod_lenguaje_prog).'");
			editor.getSession().on("change", function () {
				textarea.val(editor.getSession().getValue());
			});



	
		</script>

			';
			
				
				return $html;
		}
	function resultados($thisa,$cod){
			
			if($cod){
				$resultado=$thisa->resultado();
				if($resultado=='ACEPTADO'){
						$color='green';
						$icono='glyphicon glyphicon-ok';
				}elseif($resultado=='RESULTADO CONGELADO'){
						$color='blue';
						$icono='glyphicon glyphicon-eye-close';
				}else{
					
					$color='red';
						$icono='glyphicon glyphicon-thumbs-down';
					}
				$html='<div style="color:'.$color.'"><span class="'.$icono.'"> </span> '.$resultado.'</div>';
			}else{
				$html="Sin resultados";
			}
			return $html;
		}
		function lenguaje_prog($cod){
			switch($cod){
					case 5: 	$html.='c_cpp';
					break;
					case 10: 	$html.='php';
					break;
					case 6: 	$html.='java';
					break;
					case 8:		$html.='python';
					break;
					default:{
						$html.='c_cpp';
					}
				}		
			return $html;
		}
	function lenguajes($thisa){
			require_once("modelo/class_lenguaje_prog.php");	
			$lenguaje_prog= new lenguaje_prog;
			$lenguaje_prog->listar();
			$thisa->cod_lenguaje_prog=($_GET['cod_lenguaje_prog'] ? $_GET['cod_lenguaje_prog'] : $_POST["cod_lenguaje_prog"]);
			while($row=$lenguaje_prog->row()){
				$option.='<option value="'.$row['cod_lenguaje_prog'].'" '.($thisa->cod_lenguaje_prog==$row['cod_lenguaje_prog'] ? 'selected' : '').' >'.$row['nombre'].'</option>';
			}
			$html.='
			<script>
				function cambiar_lenguaje(a){
					switch(a.value){
					
						case "5": 	{html="c_cpp";}
						break;
						case "10": 	{html="php";}
						break;
						case "6": 	html="java";
						break;
						case "8":		html="python";
						break;
						default:{
							html="c_cpp";
						}
					}
					editor.getSession().setMode({
					path: "ace/mode/"+html,
					  v: Date.now() 
			
					});
					
					
						
				}	
			</script>
			<select name="cod_lenguaje_prog" onchange="cambiar_lenguaje(this)" class="form-control">'.$option.'</select>
			';
			return $html;
		}


function construir_arreglo_resultados($row_problemas,$envio,$p,$tiempo_inicio){

			foreach($row_problemas as $p){
				$envio->set_cod_problema($p['cod_problema']);
				$intentos_fallidos=$envio->intentos_fallidos();
				$sancion=$intentos_fallidos*$tiempo_adicional_por_fallo;
				$resultado[$p['cod_problema']]['intento']=0;
				$resultado[$p['cod_problema']]['tiempo']=0;
				$resultado[$p['cod_problema']]['correcto']=false;
				$resultado[$p['cod_problema']]['incorrecto']=false;
				

				if($intentos_fallidos>0){
					$resultado[$p['cod_problema']]['tiempo']=20*$intentos_fallidos;
					$resultado[$p['cod_problema']]['intento']=$intentos_fallidos;
					$resultado[$p['cod_problema']]['incorrecto']=true;
				}
				if($envio->correcto()>0){
					$cant_resueltos+=1;
					$row_envio=$envio->row();
					$tiempo_respuesta=strtotime($row_envio['fecha_hora'])-strtotime($tiempo_inicio);
					$tiempo_respuesta=$tiempo_respuesta+$sancion;
					$tiempo=round($tiempo_respuesta/60);
					$resultado[$p['cod_problema']]['tiempo']+=$tiempo;
					$resultado[$p['cod_problema']]['intento']+=1;
					$resultado[$p['cod_problema']]['correcto']=true;
					$resultado[$p['cod_problema']]['incorrecto']=false;
				}
				$tiempo_total+=$tiempo;
				$intentos_fallidos='';
				$tiempo=0;
				$tiempo_respuesta='';
			}
			return $resultado;	
	
}
function resumen_resultados($resultados){
	foreach($resultados as $cod_equipo=>$problema){
		foreach($problema as $res){
			if($res['correcto']){
				$resumen[$cod_equipo]+=10000;
			}
				$resumen[$cod_equipo]-=$res['tiempo'];
		}	
	}
	//ordenamiento real
	arsort($resumen);
	return $resumen;
}
						
?>
