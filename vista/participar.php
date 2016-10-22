<?php
	require_once("modelo/class_problema_concurso.php");
	require_once("modelo/class_det_concurso_equipo.php");
	require_once("libreria/funciones_generales_concurso.php");
	class participar extends problema_concurso{
	public $tipo, $nombre_equipo, $nombre_corto;
		public function reporte_html_general($vista){
			
				$cod_concurso=$_GET['cod_concurso'];
				$this->set_cod_concurso($cod_concurso);
				$concurso_activo=$this->concurso_activo();
				$this->consultar_problemas_del_concurso_detallado();
				
				$titulo='Concurso '.$this->nombre_corto;
				$par= new envio;
				$btn_regresar=btn_regresar('participar');

			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de "'.$titulo.';
			</script>

			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-xs-3 col-md-4" style="text-align:left">
						'.$this->nombre_equipo.'						
						</div>		
						<div class="col-md-4" style="text-align:center">
							<span style="font-size:18px"><span class="glyphicon glyphicon-education"></span> '.$titulo.'</span>					
						</div>
						<div class="col-md-4" style="text-align:right">
							'.$btn_regresar.'
						</div>
					</div>		
				</div>
				<div class="panel-body">
					'.titulo_menu($this->cod_concurso,$_GET['evento']).'	
				
				
						<table id="data_table" class="table table-striped table-bordered" width="100%" cellspacing="0">
							<thead>
							<tr>
							<th width="80px">
							Nro
							</th>
							<th style="text-align:center">Codigo</th>
							<th style="text-align:center">Resuelto en</th>
							<th style="text-align:center">Nombre</th>
							<th style="text-align:center">Enunciado</th>
							<th style="text-align:center">Resolver</th></tr>
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
				
				$par->set_cod_problema($row['cod_problema']);
				$td_resultado="";
				$td_enviar_solucion="";
					$par->set_cod_concurso($cod_concurso);
					$par->set_cod_equipo($_SESSION['cod_equipo']);
					if($par->correcto()>0){
						$row_resultado=$par->row();
						$td_resultado=$row_resultado['nombre'];
						$td_enviar_solucion='<span style="color:green" title="Problema resuelto" class="glyphicon glyphicon-ok"> </span>';
					}elseif($concurso_activo){
						
						$td_enviar_solucion='<a class="btn btn-success btn-sm" href="?vista=participar&evento=formulario_envio&cod_concurso='.$cod_concurso.'&cod_problema='.$row['cod_problema'].'"><span class="glyphicon glyphicon-send"></span> Enviar Solución</button></a>';
					}else{
						
						$td_enviar_solucion='<span style="color:red" title="Problema NO resuelto" class="glyphicon glyphicon-remove"> </span>';
						}

				$html.='
		
				<tr>
				<td class="td_botones">
				
					<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
					
						</span>
				

							<input type="hidden" name="cod_problema" value="'.$row['cod_problema'].'">
		
				</td>
				<td style="text-align:center">'.$row['cod_problema'].'</td>
				<td style="text-align:center">'.$td_resultado.'</td>
				<td style="text-align:center" >'.$row['nombre'].'</td>
				<td style="text-align:center"><a href="index.php?vista=problema&evento=enunciado&cod_problema='.$row['cod_problema'].'" target="blank" >Enunciado (PDF)</a></td>
				<td style="text-align:center">'.$td_enviar_solucion.'</td>
				</tr>
				</form>
	';
	
	}
	
	
			$html.='
			</tbody>
				</table>
				</form>
		</li>
		</div>
	</div>
				';
				
	

			return $html;
		}	
	public function resultado_concurso(){
		$cod_concurso=$_GET['cod_concurso'];
		$concurso = new concurso;
		$concurso->set_cod_concurso($cod_concurso);
		$concurso->consultar();
		$html='<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
										 '.$this->nombre_equipo.'
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-education"></span> Resultados del concurso '.$concurso->nombre_corto.'</span>					
					</div>
					<div class="col-md-4" style="text-align:right">
						'.btn_regresar('participar').'
					</div>
				</div>		
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						'.titulo_menu($concurso->cod_concurso,$_GET['evento']).'
					</div>
					
						

				</div>
				<div class="row">
					<div class="col-md-12" id="resultado_div">
						
					</div>
					<div class="row">
						<div class="col-md-12" style="text-align:right; font-size:12px">1) Cada envio incorrecto sera penalizado con 20 minutos de tiempo. 2) El tiempo es importante en caso de empates.</div>
					</div>
<div class="row">
				<div class="col-md-3">
					<table class="table table-striped" style="font-size:12px">
						<tr>
							<td style="text-align:center;  border: 1px solid #CCC" >Leyenda:</td>
						</tr>
						<tr>
							<td style="background:#71FF85; text-align:center; border: 1px solid #CCC" >Problema solucionado</td>
						</tr>
						<tr>
							<td style="background:#FE8494; text-align:center; border: 1px solid #CCC" >Problema no solucionado</td>
						</tr>
						<tr>
							<td style=" text-align:center; border: 1px solid #CCC" >Sin envios</td>
						</tr>
					</table>
				</div>
					
						<div class="col-md-3" style="text-align:center">
							<table style="text-align:center">
								<tr><td><h5>Congelación de resultados</h5></td></tr>
								<tr><td>'.tiempo_restante($concurso->cod_concurso,$concurso->tiempo_inicio,$concurso->tiempo_conjelacion,'congelacion').'</td></tr>
							</table>
						</div>
						<div class="col-md-3" style="text-align:center">
							<table style="text-align:center">
								<tr><td><h5>Finalizar el concurso</h5></td></tr>
								<tr><td>'.tiempo_restante($concurso->cod_concurso,$concurso->tiempo_inicio,$concurso->tiempo_final,'descongelar').'</td></tr>
							</table>
						</div>
						<div class="col-md-3" style="text-align:center" >
							<table style="text-align:center">
								<tr><td><h5>Descongelar resultados</h5></td></tr>
								<tr><td>'.tiempo_restante($concurso->cod_concurso,$concurso->tiempo_inicio,$concurso->tiempo_desconjelar,'final').'</td></tr>
							</table>
						</div>
				
			</div>
		
				</div>
			</div>
		</div>
<script>
$(document).ready(function(){
cargar_resultado();
setInterval(cargar_resultado,5000);
});

function cargar_resultado(){
$("#resultado_div").load("tabla_resultado.php?cod_concurso='.$concurso->cod_concurso.'");
}
</script>

			';
			
			return $html;
		
	}

		public function formulario_envio($ultimo_id){
			$this->consultar_concurso();
			$tiempo_restante=tiempo_restante_c($this->cod_concurso,$this->tiempo_final);
			$this->consultar_problema();
			$this->set_codigo_fuente($_POST['codigo_fuente']);
			$this->set_cod_lenguaje_prog($_GET['cod_lenguaje_prog']);
			$this->tipo='concurso';
			if(isset($ultimo_id)){
				$this->set_cod_envio($ultimo_id);
				$this->consultar_envio();
				
			}	
			return formulario_envio($this,$ultimo_id,$tiempo_restante);
		}



	public function listado_publico_concurso(){
			$concurso = new concurso;
			$concurso->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Concursos";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.$this->nombre_equipo.'
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-education"></span> Concursos</span>					
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
			<th>Inicio</th>
			<th>Congelar</th>
			<th>Finalización</th>
			<th>Descongelar</th>
			<th style="text-align:center">Estado</th></tr>
			</thead>
			<tbody>
			';
			$i=0;
	while($row=$concurso->row()){
		$i++;
		$parametro['tipo']='botonera';
		$parametro['estatus']=$row['estatus'];
		$botonera=mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro);
		$ancho=strlen($botonera)/5.4;
		$html.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
		
			</span>
				'.$botonera.'

						
		</form>
	</td>
	<td>'.$row['nombre'].'</td>
	<td>'.$row['tiempo_inicio'].' VEN</td>
	<td>'.$row['tiempo_conjelacion'].' VEN</td>
	<td>'.$row['tiempo_final'].' VEN</td>
	<td>'.$row['tiempo_desconjelar'].' VEN</td>
	<td style="text-align:center">'.$this->btn_entrar_concurso($row['tiempo_inicio'],$row['tiempo_final'],$row['cod_concurso']).'</td>
	</tr>';
	}
	
			$html.='
			</tbody>
				</table>
				'.$this->aviso_equipo();
				
	

			return $html;
		}
	private function btn_entrar_concurso($tiempo_inicio,$tiempo_final,$cod_concurso){
		$fecha_final= strtotime($tiempo_final);
		$fecha_inicio= strtotime($tiempo_inicio);
		$fecha_actual=time();
		//exit(date('d-m-Y h:i:s', $fecha_inicio)." s ".date('d-m-Y h:i:s',$fecha_actual));
		if($fecha_final>$fecha_actual and $fecha_actual>$fecha_inicio){
			$html=btn_entrar_concurso($cod_concurso);
			
		}elseif($fecha_inicio>$fecha_actual){
			$html='Inicia en: '.tiempo_restante_b($cod_concurso,$tiempo_inicio,$tiempo_final);
		}else{
			$html='<a class="btn btn-info" href="?vista=participar&evento=resultado&cod_concurso='.$cod_concurso.'"><span class="glyphicon glyphicon-education"></span> Resultados</a>';
		}
		return $html;
		
	}
	private function aviso_equipo(){
		require_once("modelo/class_det_usuario_equipo.php");
		$usuario_equipo=new det_usuario_equipo;
		$usuario_equipo->set_cod_usuario($_SESSION['cod_usuario']);
		
		$html.='
		<div id="modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Importante!</h4>
			  </div>
			  <div class="modal-body">
			  Estimado usuario, para participar en los concursos usted debe integrar un equipo. <a href="?vista=equipo&evento=formulario_registrar">Presione aqui para crear un equipo.</a> Si solo desea ser espectador omita el presente mensaje.
			  </div>
			</div>
		  </div>
		</div>
		<script> 
		$(function () {
			$("#modal").modal("show"); 
		})
		</script>
		';
		if($usuario_equipo->consulta_por('cod_usuario')==0)
		return $html;
		
	}	
		
}

?>
