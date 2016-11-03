<?php
require_once("vista/campo/campo_usuario.php");

require_once("vista/campo/campo_persona.php");
class usuario_admin extends campo_usuario{
		public function reporte_html_general($vista){
			global $lib_data_table;
			$lib_data_table=true;
			$this->listar();
			$parametro['tipo']='consulta_nuevo';
			$salida.='
			<script> var sub_titulo_pdf="Reporte Usuarios";</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
					'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
					<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Listado de Usuarios</span>					
					</div>
				</div>	
			</div>
			<div class="panel-body">
					<table id="data_table" class="table table-striped table-bordered" width="100%" cellspacing="0">
			<thead>
			<tr>
			<th width="80px">
					Nro.
					</th>
					<th>Cédula </th><th>Nombre</th><th>Apellido</th><th>Tipo de usuario</th>
					<th>Sexo</th><th>Correo</th><th>Teléfono Móvil</th><th>Teléfono Fijo</th><th>Fecha de nacimiento (dd-mm-yyyy)</th><th>Estatus</th></tr>
					</thead>
					<tbody>
					';
					$i=0;
			while($row=$this->row()){
			$i++;
				$parametro['tipo']='botonera';
				$parametro['estatus']=$row['estatus'];
				//exit($parametro['estatus']."s");
				$botonera=mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro);
				$ancho=strlen($botonera)/5.4;
			$salida.='
			<tr>
			<td class="td_botones">
			
				<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px">
				<span style=" float:left; margin-right:1px;">'.$i.' </span>
						
						'.$botonera.'
						<input type="hidden" name="cod_usuario" value="'.$row['cod_usuario'].'">
						<input type="hidden" name="cedula" value="'.$row['cedula'].'">
				</form>
			</td>
			<td>'.$row['cedula'].'</td>
			<td>'.$row['nombre_persona'].'</td>
			<td>'.$row['apellido'].'</td>
			<td>'.$row['nombre_tipo_usuario'].'</td>
			<td>'.($row['sexo']=="m" ? "Masculino" : "Femenino").'</td>
			<td>'.$row['correo'].'</td>
			<td>'.$row['telefono_movil'].'</td>
			<td>'.$row['telefono_fijo'].'</td>
			<td>'.date("d-m-Y",strtotime($row['fecha_nacimiento'])).'</td>
			<td>'.($row['estatus']==1 ? "Activo" : "Inactivo").'</td>
			</tr>';
			}
			$salida.='
			</tbody>
				</table>
		</div>
				';
				return $salida;
		}
	public function reporte_html_individual(){
			parent::consultar();
			$html.='
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta de Usuario</span></div>
					<div class="col-md-3">'.botones('regresar').'</div>
				</div>
			</div>
			<div class="panel-body">
			
			<div class="row">
						<div class="col-md-3 col-md-offset-3">
							<label>Cédula:</label>
							'.$this->cedula.'
						</div>
					</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-3">
						<label>Nombre:</label>
							'.$this->nombre.'
					</div>
					<div class="col-md-3">
						<label>Apellido:</label>
						'.$this->apellido.'
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-3">
						<label>Sexo:</label>
							'.($this->sexo=='m' ? 'Masculino' : 'Femenino').'
					</div>
					<div class="col-md-3">
						<label>Fecha de nacimiento:</label>
						'.$this->fecha_nacimiento.'
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<label>Correo:</label>
						'.$this->correo.'
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-3">
						<label>Teléfono Móvil:</label>
							'.$this->telefono_movil.'
					</div>
					<div class="col-md-3">
						<label>Teléfono Fijo:</label>
							'.$this->telefono_fijo.'
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
							<label>Dirección:</label>
								'.$this->direccion.'
					</div>
		
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-3">
							<label>Estado:</label>
								'.$this->nombre_estado.'
					</div>
					<div class="col-md-3">
									<label>Municipio:</label>
								'.$this->nombre_municipio.'
					</div>	
				</div>
				<div class="row">
					<div class="col-md-3  col-md-offset-3">
									<label>Parroquia:</label>
								'.$this->nombre_parroquia.'
					</div>	
					<div class="col-md-3">
									<label>Rol:</label>
								'.$this->nombre_tipo_usuario.'
					</div>	
				</div>
				<div class="row">
					<div class="col-md-3  col-md-offset-3">
									<label>Ultima visita:</label>
								'.$this->ultima_actividad.'
					</div>	
					<div class="col-md-3">
									<label>Estatus:</label>
								'.($this->estatus==1 ? "Activo" : "Inactivo").'
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
				$boton=botones('actualizar');
				$titulo='Modificar Usuario';
				$bloqueo=true;
			}break;
			case 'registrar':{
				$boton=botones('registrar');
				$titulo='Agregar nuevo usuario';
			}break;
		}
		
		$html.='
	<script type="text/javascript" src="js/js_usuario_admin.js" ></script>

	<link rel="stylesheet" type="text/css" href="libreria/clave/style.css" />
	<link rel="stylesheet" type="text/css" href="css/usuario.css" />
	<script src="libreria/clave/script.js"></script>
	<form method="POST" autocomplete="off">
		<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
					<div class="col-md-3">'.btn_regresar('usuario_admin').'</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3"></div>
					'.$this->cedula($bloqueo).'
					<div class="col-md-3"><span style="float:right; color:red">(*) Campos obligatorios</span></div>
				</div>


				<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre(0).'
					'.$this->apellido(0).'
				</div>


				<div class="row">
					<div class="col-md-3"></div>
					'.$this->sexo(0).'
					'.$this->fecha_nacimiento(0).'
				</div>


				<div class="row">
					<div class="col-md-3"></div>
					'.$this->correo(0).'
				</div>
				<div class="row">
					<div class="col-md-3"></div>
					'.$this->telefono_movil(0).'
					'.$this->telefono_fijo(0).'
				</div>
				<div class="row">
					<div class="col-md-3"></div>
					'.$this->estados(0).'
					'.$this->municipios(0).'
					'.$this->parroquia(0).'
				</div>
				<div class="row">
					<div class="col-md-3"></div>
					'.$this->direccion(0).'
				</div>
				<div class="row">
					<div class="col-md-3"></div>
					
					'.$this->cod_tipo_usuario(0).'
					'.$this->cod_usuario().'
					'.$this->cod_institucion().'
				</div>
					
				<div class="row"><br>
					<div class="col-md-3"></div>
					'.$boton.'
				</div>			
			</div>
		</div>
		
	</form>
			';
		return $html;
	}
}
?>
