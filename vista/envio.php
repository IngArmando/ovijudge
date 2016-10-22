<?php
require_once("vista/campo/campo_envio.php");
class vista_envio extends campo_envio{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Envios";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Envios</span>					
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
			<th>Codigo</th><th>Origen</th><th>Concurso</th><th>Equipo</th><th>Problema</th><th>Lenguages de programación</th><th>Tiempo envio</th><th>Nombre servidor</th><th>Valido</th><th>Rejuzgar</th><th>Expectativa</th></tr>
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
		$html.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
		
			</span>
				'.$botonera.'

							<input type="hidden" name="cod_envio" value="'.$row['cod_envio'].'">
		</form>
	</td>
	<td>'.$row['cod_envio'].'</td><td>'.$row['orig_envio'].'</td><td>'.nombre_foraneo_cod_concurso($row['cod_concurso']).'</td><td>'.nombre_foraneo_cod_equipo($row['cod_equipo']).'</td><td>'.nombre_foraneo_cod_problema($row['cod_problema']).'</td><td>'.nombre_foraneo_cod_lenguaje_prog($row['cod_lenguaje_prog']).'</td><td>'.$row['tiempo_envio'].'</td><td>'.$row['nombre_servidor'].'</td><td>'.$row['valido'].'</td><td>'.nombre_foraneo_cod_rejuzgar($row['cod_rejuzgar']).'</td><td>'.$row['expectativa_resultados'].'</td>
	</tr>';
	}
	
			$html.='
			</tbody>
				</table>
				';
				
	

			return $html;
		}
		
		public function reporte_html_individual(){
			$this->consultar();
		$html= '
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Envios</span></div>
					<div class="col-md-3">'.btn_regresar('envio').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Codigo: '.$this->cod_envio.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Origen: '.$this->orig_envio.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Concurso: '.$this->cod_concurso.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Equipo: '.$this->cod_equipo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Problema: '.$this->cod_problema.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Lenguages de programación: '.$this->cod_lenguaje_prog.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Tiempo envio: '.$this->tiempo_envio.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Nombre servidor: '.$this->nombre_servidor.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Valido: '.$this->valido.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Rejuzgar: '.$this->cod_rejuzgar.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Expectativa: '.$this->expectativa_resultados.'
					</label>
				</div>
			</div>
		
				</div>
			</div>
		';
		return $html;
	
		}
		public function formulario($tipo){
			switch($tipo){
				case 'modificar': {
					parent::consultar();
					$boton=botones('modificar');
					$titulo='Modificar Envios';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Envios';
				}break;
			}
		$html= '
			<form method="post" action="?vista=envio">
			<script type="text/javascript" src="js/js_envio.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('envio').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->orig_envio().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_concurso().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_equipo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_problema().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_lenguaje_prog().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->tiempo_envio().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre_servidor().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->valido().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_rejuzgar().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->expectativa_resultados().'
		</div>

	
			<div class="row"><br>
				<div class="col-md-3"></div>
				'.$boton.'<br>
			</div>	
		</div>
		';
		return $html;
	
		}
}
?>
