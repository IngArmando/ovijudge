


<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class="col-xs-4 col-md-4" style="text-align:left">
					<a <?php if($_GET['evento']=='nuevo') echo 'style="display:none;"';?> title="Agregar nuevo registro" class="btn btn-success btn-sm" href="?vista=privilegio&evento=nuevo">Agregar Privilegios de usuarios</a>
		</div>
		<div class="col-xs-3 col-md-4" style="text-align:center">		
			<span style="font-size:18px">Privilegios de usuarios</span>	
		</div>
		<div class="col-xs-5 col-md-4"  style="text-align:right">			
			<div style="float:right; margin-top:-4px; <?php if($_GET['evento']=='nuevo' || $_POST['evento']=='consultar') echo 'display:none;';?>" >
			
			</div>
			<a class="btn btn-default btn-sm" href="?vista=privilegio"  style="float:right; <?php if($_GET['evento']!='nuevo' and $_POST['evento']!='consultar') echo 'display:none;';?>">
				<span class="glyphicon glyphicon-arrow-left"></span>
				Regresar
			</a>
		</div>
	</div>
</div>			
<div class="panel-body">

<style>
.row_campos_detalles div,.row_campos_detalles input,.row_campos_detalles select{
padding:0px;
margin:0px;
border-radius:0px;
height:20px;
}
.boton_menos,.boton_mas{
height:20px;
padding:2px 3px 2px 3px;
}
#th_button_nuevo{
text-align:center;
width:80px;
}
.td_botones button{
	float:left;
}
.div_botones_listar{

}
.div_botones_listar button{
margin-left:3px;
}
</style>
<?php 
if($mostrar_formulario==true){
	echo '<form method="post" action="?vista=privilegio">';
	formulario($row_privilegio['cod_vista_sistema'],$row_privilegio['cod_tipo_usuario'],$ultimo_id);
		if (function_exists('detalle_transaccion')) {
		echo detalle_transaccion();
	}
	echo botones($mostrar_btn)."</form>";

}elseif($resultado_listar>0){
	echo listar($privilegio);
}else{
	echo "No existen registros.";
}
?>

</div>
</div>

	</div>
</div>
<?php
//FUNCIONES

function listar($privilegio){
	$salida.='
	<script>
	$(function() {
	$("#data_table").dataTable({
	"scrollX": true
	});
	});
	</script>
		<table id="data_table" class="table table-striped">
			<thead>
			<tr>
			<th>
			Nro
			</th>
			<th>Vista</th><th>Tipo de usuario</th></tr>
			</thead>
			<tbody>
			';
			$i=0;
	while($row=$privilegio->row()){
	$i++;
	$salida.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:105px"> <span style=" float:left; margin-right:1px;">'.$i.' </span>
				<button type="submit" name="evento" value="consultar" title="Consultar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span></button>
				'.btn_eliminar_desactivar($row['estatus']).'
				<input type="hidden" name="cod_vista_sistema" value="'.$row['cod_vista_sistema'].'">
		</form>
	</td>
	<td>'.nombre_foraneo_cod_vista_sistema($row['cod_vista_sistema']).'</td><td>'.nombre_foraneo_cod_tipo_usuario($row['cod_tipo_usuario']).'</td>
	</tr>';
	}
	
	$salida.='
	</tbody>
		</table>
		';
		return $salida;
	}

function formulario($cod_vista_sistema,$cod_tipo_usuario,$ultimo_id){
echo '
<script type="text/javascript" src="js/js_privilegio.js" ></script>
<span style="float:right; color:red">(*) Campos obligatorios</span>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<label>
				Vista <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				'.combo_cod_vista_sistema($cod_vista_sistema).'
		</div>
	</div>


	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<label>
				Tipo de usuario <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				'.combo_cod_tipo_usuario($cod_tipo_usuario).'
		</div>
	</div>

	';
}
function botones($mostrar_btn){
$salida.='
<br><br>
	<div class="row">
		<div class="col-md-6  col-md-offset-3" style="text-align:center">
		';
		switch($mostrar_btn){
			case "registrar":{
			$salida.='
			<button id="registrar" class="btn btn-default"  type="submit" name="evento" value="'.($_GET['sincronizado']==true ? "registrar_sincronizado" : "registrar").'">
				<span class="glyphicon glyphicon-floppy-disk" > </span>
				Registrar
			</button>';
			}
			break;
			case "editar":{
			$salida.='
			<button id="modificar" class="btn btn-default" type="submit" name="evento" value="editar">
				<span class="glyphicon glyphicon-edit" > </span>
				Editar
			</button>
			';
			}
		
		}
			$salida.='

		</div>
    </div>';
    return $salida;
    
 }
function combo_cod_vista_sistema($valor){
	include_once("modelo/class_vista_sistema.php");
	$vista_sistema = new vista_sistema;
	$vista_sistema->listar();
	$salida.= '<div class="input-group">

	';
	$salida.= '<select  id="cod_vista_sistema" class="form-control" name="cod_vista_sistema" >'; 
	$salida.= '<option value="">Seleccione</option>';
	while($row_vista_sistema = $vista_sistema->row()){
		$salida.= '<option value="'.$row_vista_sistema["cod_vista_sistema"].'"';	
		if($row_vista_sistema["cod_vista_sistema"]== $valor) $salida.= " selected ";									
		$salida.= '>'.$row_vista_sistema["descripcion"]."</option>";
	}
	$salida.= '</select>';
	$salida.= '<span class="input-group-btn">
	<a href="?vista=vista_sistema&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
	

	</span>
	
	</div>';
	return $salida;
}

function nombre_foraneo_cod_vista_sistema($valor){
	include_once("modelo/class_vista_sistema.php");
	$vista_sistema = new vista_sistema;
	$vista_sistema->set_cod_vista_sistema($valor);
	$vista_sistema->consultar();
	$arreglo=$vista_sistema->row();
	return $arreglo['descripcion'];
}

function combo_cod_tipo_usuario($valor){
	include_once("modelo/class_tipo_usuario.php");
	$tipo_usuario = new tipo_usuario;
	$tipo_usuario->listar();
	$salida.= '<div class="input-group">

	';
	$salida.= '<select  id="cod_tipo_usuario" class="form-control" name="cod_tipo_usuario" >'; 
	$salida.= '<option value="">Seleccione</option>';
	while($row_tipo_usuario = $tipo_usuario->row()){
		$salida.= '<option value="'.$row_tipo_usuario["cod_tipo_usuario"].'"';	
		if($row_tipo_usuario["cod_tipo_usuario"]== $valor) $salida.= " selected ";									
		$salida.= '>'.$row_tipo_usuario["nombre"]."</option>";
	}
	$salida.= '</select>';
	$salida.= '<span class="input-group-btn">
	<a href="?vista=tipo_usuario&sincronizado=true&evento=nuevo" target="_blank" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"> </span> Agregar</a>
	

	</span>
	
	</div>';
	return $salida;
}

function nombre_foraneo_cod_tipo_usuario($valor){
	include_once("modelo/class_tipo_usuario.php");
	$tipo_usuario = new tipo_usuario;
	$tipo_usuario->set_cod_tipo_usuario($valor);
	$tipo_usuario->consultar();
	$arreglo=$tipo_usuario->row();
	return $arreglo['nombre'];
}

?>
<script>

function msj_eliminar(){
	return confirm("Esta seguro de eliminar este registro?");
}

</script>
