<?php
require_once("modelo/class_vista_sistema.php");
$vista_c= new vista_sistema;
$evento=$_POST['evento'];
$cod_vista_sistema=$_POST['cod_vista_sistema'];

switch($evento){
	case "actualizar":{
		$total=count($cod_vista_sistema);
		$vista_c->INICIAR_TRANSACCION();
		foreach($cod_vista_sistema as $i=>$valor){
			
			$vista_c->set_cod_vista_sistema($valor);
			$vista_c->set_posicion($i+1);
			$vista_c->actualizar_posicion();
			$total_bueno++;
		}
		if($total==$total_bueno){
			$vista_c->COMMIT();
			
		}else{
			$vista_c->ROLLBACK();
		}
	}
	default:{
		$html=vistas();
	}
	
}


function vistas(){
	$vista_sistema= new vista_sistema;
	$vista_sistema->listar_ordenado();
	while($row=$vista_sistema->row()){
	$tr.='<tr><td><input type="hidden" name="cod_vista_sistema[]" value="'.$row['cod_vista_sistema'].'">'.$row['posicion'].'</td><td>'.$row['nombre'].'</td><td>'.$row['descripcion'].'</td><td>'.$row['nombre_servicio'].'</td><td>'.$row['nombre_modulo'].'</td></tr>';
	}
	$table='<table id="tabla_posicion" class="table table-striped">'.$tr.'</table> <script>$(function() { $("#tabla_posicion").tableDnD(); });</script>';
	$btn_actualizar='<div style="text-align:center"><button class="btn btn-default btn-lg" name="evento" type="submit" value="actualizar">Actualizar</button></div>';
	return $table.$btn_actualizar;
}
?>
