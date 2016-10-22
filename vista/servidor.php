<?php
require_once("vista/campo/campo_servidor.php");
class vista_servidor extends campo_servidor{
	
		public function reporte_html_general($vista){
			$this->listar();
			$parametro["tipo"]="consulta_nuevo";			
			$html='<script>

			var sub_titulo_pdf="Reporte de Servidores";
			</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
			<div class="panel panel-default">
			<div class="panel-heading" style="text-align:center">
				<div class="row">
					<div class="col-xs-3 col-md-4" style="text-align:left">
						'.mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro).'					
					</div>		
					<div class="col-md-4" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Servidores</span>					
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
			<th style="text-align:center" >Nombre del servidor</th><th style="text-align:center" >Estado Actual</th><th style="text-align:center" >Tiempo</th></tr>
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
		$tiempo_servidor=date('d-m-Y h:i:s A',$row['polltime']);
		$tiempo_limite=strtotime ( '+1 minute' , $row['polltime']) ;
		if(strtotime('now')>$tiempo_limite){
			$dba = new db;
			$dba->ejecutar("UPDATE servidor SET active=0 WHERE nombre_servidor='".$row['nombre_servidor']."'");
			$row['active']=0;
			}
		$html.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
		
			</span>
				'.$botonera.'

							<input type="hidden" name="nombre_servidor" value="'.$row['nombre_servidor'].'">
		</form>
	</td>
	<td>'.$row['nombre_servidor'].'</td><td style="text-align:center"><span '.($row['active']==1 ? 'style="color:green" title="Encendido"' : 'style="color:red" title="Apagado"').'" class="glyphicon glyphicon-off"> </span></td><td>'.$tiempo_servidor.'</td>
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
					<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Consulta detallada de Servidor</span></div>
					<div class="col-md-3">'.btn_regresar('servidor').'</div>
				</div>
			</div>
			<div class="panel-body">
				
			<div class="row">
				<div class="col-md-3">
					<label>
						Nombre del servidor: '.$this->nombre_servidor.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Activo: '.$this->active.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Poll Tiempo: '.$this->polltime.'
					</label>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-3">
					<label>
						Restricción: '.$this->cod_restriccion.'
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
					$titulo='Modificar Servidor';
				}break;
				case 'registrar':{
					$boton=botones('registrar');
					$titulo='Agregar Nuevo Servidor';
				}break;
			}
		$html= '
			<form method="post" action="?vista=servidor">
			<script type="text/javascript" src="js/js_servidor.js" ></script>
			
			<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6"><span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> '.$titulo.'</span></div>
						<div class="col-md-2 col-md-offset-1">'.btn_regresar('servidor').'</div>
					</div>
				</div>
			<span style="float:right; color:red">(*) Campos obligatorios</span>
			<input readonly id="cod_modulo" class="form-control" type="hidden" name="cod_modulo" value="'.$this->cod_modulo.'" />

				
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->nombre_servidor().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->active().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->polltime().'
		</div>

	
		<div class="row">
					<div class="col-md-3"></div>
					'.$this->cod_restriccion().'
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
