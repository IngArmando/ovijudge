<?php
$tipo = $_REQUEST['tipo'];
$evento=$_POST['evento'];
$titulo=$_POST['titulo'];
$descripcion=$_POST['descripcion'];
switch($evento){
	case "actualizar":{
		actualizar($titulo,$descripcion,$tipo);
		}
	break;
	
}
	
if($tipo){
	
	$row=consultar($tipo);
	$html=formulario($row['titulo'],$row['descripcion'],$tipo);
}



function formulario($titulo,$descripcion,$tipo){
	

$html.='
	<form method="POST">
	<div class="panel panel-default">
		<div class="panel-heading">
			Modificación de información principal
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<label>Titulo:</label>
					<input readOnly type="text" name="titulo" value="'.$titulo.'" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label>Descripción:</label>	
					<div>
					<textarea id="descripcion"  required name="descripcion" class="form-control">'.$descripcion.'</textarea>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3" style="text-align:center"><br>
					<button type="submit" name="evento" value="actualizar" class="btn btn-default btn-lg submit">Actualizar</button>
				</div>
			</div>
		</div>
		
	</div>
	</form>

	';
	$html.='<script src="libreria/nic/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>';
	return $html;
}
function consultar($tipo){
	
	require_once("modelo/class_informacion.php");
	$informacion = new informacion;
	$informacion->set_cod_informacion($tipo);
	$informacion->consultar();
	$row_informacion=$informacion->row();
	return $row_informacion;
	
}
function actualizar($titulo,$descripcion,$tipo){
	require_once("modelo/class_informacion.php");
	$informacion = new informacion;
	$informacion->set_cod_informacion($tipo);
	$informacion->set_titulo($titulo);
	$informacion->set_descripcion($descripcion);
	$informacion->actualizar();	
	$_SESSION['msj_tipo']="success";
	$_SESSION['msj']="Actualizado Correctamente";
}



?>
