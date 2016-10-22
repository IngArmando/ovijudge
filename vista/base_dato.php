<?php
class base_dato{
	
	public function formulario_respaldo(){
		$html='
	<form method="post">
	<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center">
					<div class="row">
					<div class="col-md-2"></div>
						<div class="col-md-8" style="text-align:center">
						<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> RESPALDO DE BASE DE DATOS</span>
					
						</div>
						<div class="col-md-2" style="text-align:right">
							'.btn_regresar('').'
						</div>
					</div>
				</div>
				<div class="body"><br>
					<div class="row">
						<div class="col-md-12" style="text-align:center">
							<button title="Los respaldos seran guardados en el directorio del servidor: archivos/respaldo/." name="evento" class="btn btn-default btn-lg" value="respaldo" >Crear nuevo respaldo</button>
						</div>
					</div>
					<br>
				</div>
				'.$this->listado_respaldo().'
	</div>
	</form>
						
		';
						return $html;
	}
	public function listado_respaldo(){
		$directorio = 'archivos/respaldo/';
		$ficheros  = scandir($directorio,SCANDIR_SORT_DESCENDING);
		$ficheros  = array_diff($ficheros, array('..', '.'));;
		$tr.='<tr  ><th style="text-align:center" >Ultimos Respaldos</th><th></th></tr>';	
		$i=0;
		foreach ($ficheros as $file){
			$i++;
			$tr.='<tr><td><input type="hidden" name="archivo" value="'.$file.'" >'.$file.'</td><td><button name="evento" value="restaurar" class="btn btn-default" onclick="if(!confirm(\'Esta seguro? para mayor seguridad primero realice un respaldo actual.\')) return false;">Restaurar</button></td></tr>';
			if($i==10)			
				break;
		}
		return '<table style="text-align:center" class="table table-striped">'.$tr.'</table>';
		
	}
}
?>
