<?php
	require_once("vista/campo/campo_usuario.php");
	require_once("vista/campo/campo_persona.php");
	
	class dato_personal extends campo_usuario{
		
		public function formulario_dato_personal(){
				parent::consultar();
				$boton=botones('modificar');
				$titulo='Actualizar Datos Personales';
				$bloqueo=true;

		
		$html.='
			<script type="text/javascript" src="js/js_usuario_admin.js" ></script>

			<link rel="stylesheet" type="text/css" href="libreria/clave/style.css" />
			<link rel="stylesheet" type="text/css" href="css/usuario.css" />
			<script src="libreria/clave/script.js"></script>
			<form method="POST" autocomplete="off" enctype="multipart/form-data">
				<div class="panel panel-default">
					<div class="panel-heading" style="text-align:center">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
							<div class="col-md-3">'.btn_regresar('').'</div>
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
							'.$this->foto_perfil().'
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
	public function dato_personal_html(){
		require_once("modelo/class_tabla_posicion.php");
		require_once("modelo/class_det_usuario_equipo.php");
		$det_usuario_equipo= new det_usuario_equipo;
		$tabla_posicion= new tabla_posicion;
		$det_usuario_equipo->set_cod_usuario($this->cod_usuario);
		$det_usuario_equipo->consulta_por('cod_usuario');
		$row_det_usuario_equipo=$det_usuario_equipo->row();
		$nombre_equipo=$row_det_usuario_equipo['nombre_equipo'];
		$cod_equipo=$row_det_usuario_equipo['cod_equipo'];
		$tabla_posicion->set_cod_equipo($row_det_usuario_equipo['cod_equipo']);
		
		parent::consultar();
		$html.='
			<link rel="stylesheet" type="text/css" href="css/usuario.css" />
				<div class="panel panel-default">
					<div class="panel-heading" style="text-align:center">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> PERFIL</span></div>
							<div class="col-md-3">'.btn_regresar('').'</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
						<div class="col-md-2"></div>
							<div class="col-md-4" style="text-align:center">
									<div class="panel panel-default">
										<div class="panel-heading">
											Foto de perfil
										</div>
										<div class="panel-body">						
											<img width="100%" src="'.($this->foto_perfil ? $this->foto_perfil : 'chat/admin/images/img-no-avatar.gif').'"><br>
											'.($this->cod_usuario==$_SESSION['cod_usuario'] ? '<a href="?vista=dato_personal">Actualizar foto</a>' : '').'
										</div>
									</div>
							</div>

							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										Datos personales '.($this->cod_usuario==$_SESSION['cod_usuario'] ? '<a href="?vista=dato_personal" style="float:right"> Actualizar datos </a>' : '').'
									</div>
									<div class="panel-body">
										<b>Nombre:</b> '.$this->nombre.'
										'.$this->apellido.'<br>
										<b>Sexo:</b> '.($this->sexo=='m' ? 'Masculino' : 'Femenino').'<br>
										<b>Fecha de nacimiento:</b> '.$this->fecha_nacimiento.'<br>
										<b>Equipo:</b> <a href="?vista=equipo&cod_equipo='.$cod_equipo.'&evento=reporte_html_individual&ref=tabla_posicion">'.$nombre_equipo.'</a><br>
									</div>
									<div class="panel-heading">
										Estadísticas
									</div>
										<div class="panel-body">
											<b>Problemas resueltos:</b> '.$this->problemas_resueltos().'<br>
											<b>Puntaje individual:</b> '.$this->puntaje_individual().'<br>
											<b>Puntaje de equipo:</b> '.$tabla_posicion->puntaje_individual_equipo().'<br>
										</div>								
								</div>
							
							</div>
						</div>
	

						<div class="row">
							<div class="col-md-3">
							
							</div>

						</div>					
					</div>
				</div>
				
			</form>
					';
		return $html;		
		
		
	}
		
	}
?>
