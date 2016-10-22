<?php
require_once("vista/campo/campo_persona.php");
class vista_persona extends campo_persona{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Persona";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Persona</span>					
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
			<th>cedula</th><th>nombre</th><th>apellido</th><th>sexo</th><th>correo</th><th>telefono_movil</th><th>telefono_fijo</th><th>fecha_nacimiento</th><th>estatus</th><th>cod_parroquia</th><th>direccion</th></tr>
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

							<input type="hidden" name="cedula" value="'.$row['cedula'].'">
		</form>
	</td>
	<td>'.$row['cedula'].'</td><td>'.$row['nombre'].'</td><td>'.$row['apellido'].'</td><td>'.$row['sexo'].'</td><td>'.$row['correo'].'</td><td>'.$row['telefono_movil'].'</td><td>'.$row['telefono_fijo'].'</td><td>'.$row['fecha_nacimiento'].'</td><td>'.$row['estatus'].'</td><td>'.$row['cod_parroquia'].'</td><td>'.$row['direccion'].'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Persona</span></div>
					<div class="col-md-3">'.btn_regresar('persona').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						cedula: '.$this->cedula.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						nombre: '.$this->nombre.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						apellido: '.$this->apellido.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						sexo: '.$this->sexo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						correo: '.$this->correo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						telefono_movil: '.$this->telefono_movil.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						telefono_fijo: '.$this->telefono_fijo.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						fecha_nacimiento: '.$this->fecha_nacimiento.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						estatus: '.$this->estatus.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						cod_parroquia: '.$this->cod_parroquia.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						direccion: '.$this->direccion.'
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
					$titulo='Modificar Persona';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Persona';
				}break;
			}
		$html= '
			<form method="post" action="?vista=persona">
			<script type="text/javascript" src="js/js_persona.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('persona').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cedula().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->apellido().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->sexo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->correo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->telefono_movil().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->telefono_fijo().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->fecha_nacimiento().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->estatus().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_parroquia().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->direccion().'
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
