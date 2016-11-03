<?php
include_once("modelo/class_envio_entrenamiento.php");
class participar_entrenamiento extends envio_entrenamiento{
		public function reporte_html_general($vista){
			
			if($this->tipo=='concurso'){
				$cod_concurso=$_GET['cod_concurso'];
				require_once('modelo/class_concurso.php');
				$concurso = new concurso;
				$concurso->set_cod_concurso($cod_concurso);
				$concurso->consultar();
				$titulo='Problemas del Concurso '.$concurso->nombre_corto;
				$par= new participar;
				$btn_regresar=btn_regresar('participar');
				
				
			}else{
				
				$par= new participar_entrenamiento;
				$titulo='Problemas';
				$btn_regresar=btn_regresar('');
				
			}

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
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span>					
					</div>
					<div class="col-md-4" style="text-align:right">
						'.$btn_regresar.'
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
			<th style="text-align:center">Código</th>
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
		
		if($this->tipo=='concurso'){
			
			$par->set_cod_concurso($cod_concurso);
			$par->set_cod_equipo($_SESSION['cod_equipo']);
			
			if($par->correcto()>0){
				$row_resultado=$par->row();
				$td_resultado=$row_resultado['nombre'];
				$td_enviar_solucion='<span style="color:green" title="Problema resuelto" class="glyphicon glyphicon-ok"> </span>';
			}else{
				
				$td_enviar_solucion='<button class="btn btn-success btn-sm" type="submit" name="evento" value="formulario_envio"><span class="glyphicon glyphicon-send"></span> Enviar Solución</button></a>';
			}
		}else{
			
			$par->set_cod_usuario($_SESSION['cod_usuario']);
			
			$td_resultado=$par->correcto($_SESSION['cod_usuario'])>0 ? $this->lenguajes_resueltos($row['cod_problema']) : '';
			
			$td_enviar_solucion='<a class="btn btn-success btn-sm" href="?vista=participar_entrenamiento&evento=formulario_envio&cod_problema='.$row['cod_problema'].'"><span class="glyphicon glyphicon-send"></span> Enviar Solución</button></a>';
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
	<td style="text-align:center">
		<a target="_blank" href="?vista=problema&evento=enunciado&cod_problema='.$row['cod_problema'].'" target="blank" >Enunciado (PDF)</a>
	</td>
	<td style="text-align:center">'.$td_enviar_solucion.'</td>
	</tr>
	</form>
	';
	
	}
	
	
			$html.='
			</tbody>
				</table>
				</form>
				';
				
	

			return $html;
		}
		public function formulario_envio($ultimo_id){
			$this->consultar_problema();
			$this->set_codigo_fuente($_POST['codigo_fuente']);
			$this->set_cod_lenguaje_prog($_GET['cod_lenguaje_prog']);
			if(isset($ultimo_id)){
				$this->set_cod_envio_entrenamiento($ultimo_id);
				$this->consultar_envio_entrenamiento();
			}	
			return formulario_envio($this,$ultimo_id,null);
		}

		public function reporte_html_individual(){
			$this->consultar();
		$html= '
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Problemas</span></div>
					<div class="col-md-3">'.btn_regresar('problema').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Código: '.$this->cod_problema.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Nombre: '.$this->nombre.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Límite de tiempo: '.$this->limite_tiempo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Límite de memoria: '.$this->limite_memoria.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Límite de salida: '.$this->limite_salida.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Compilación especial: '.$this->especial_compilacion.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Comparación especial: '.$this->especial_comparacion.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Comparación especial con argumentos: '.$this->especial_comparacion_args.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Texto del problema: '.$this->texto_problema.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tipo de texto del problema: '.$this->tipo_texto_problema.'
					</label>
				</div>
			</div>

		
				</div>
			</div>
		';
		return $html;
	
		}


		public function lenguajes_resueltos($cod_problema){
			
			require_once("modelo/class_usuario.php");
			$usuario = new usuario;
			$usuario->set_cod_usuario($_SESSION['cod_usuario']);
			$usuario->lenguajes_resueltos($cod_problema);
			
			while($row=$usuario->row()){
				$html.='<span class="label label-primary" title="Problema resuelto en '.$row["nombre"].'"><span  class="glyphicon glyphicon-ok-sign" title="Problema resuelto en '.$row["nombre"].'"></span> '.$row['nombre'].'</span> ';
			}
			return $html;
		}
}

?>
