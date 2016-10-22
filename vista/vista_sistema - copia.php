<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class="col-xs-4 col-md-4" style="text-align:left">
					<a <?php if($_GET['evento']=='nuevo') echo 'style="display:none;"';?> title="Agregar nuevo registro" class="btn btn-success btn-sm" href="?vista=vista_sistema&evento=nuevo">Agregar Vistas del sistema</a>
		</div>
		<div class="col-xs-3 col-md-4" style="text-align:center">		
			<span style="font-size:18px">Vistas del sistema</span>	
		</div>
		<div class="col-xs-5 col-md-4"  style="text-align:right">			
			<div style="float:right; margin-top:-4px; <?php if($mostrar_formulario==true) echo 'display:none;';?>" >
				Exportar en: 
					<a href="#" onClick ="$('#data_table').tableExport({type:'sql'});" class="btn btn-default btn-sm">  SQL</a>
					<a href="#" onClick ="$('#data_table').tableExport({type:'csv',escape:'false'});"  class="btn btn-default btn-sm"> CSV</a>
					<a href="#" onClick ="$('#data_table').tableExport({type:'excel',escape:'false'});"  class="btn btn-default btn-sm"> CALC</a>		
					<a href="#" onClick ="window.open('rep.php?&rep=<?php echo $_GET['vista']; ?>');"  class="btn btn-default btn-sm"> PDF</a>
			</div>
			<?php
			if($mostrar_formulario==true){
					echo '
				<a class="btn btn-default btn-sm" href="?vista=vista_sistema"  style="float:right;">
					<span class="glyphicon glyphicon-arrow-left"></span>
					Regresar
				</a>';
			}
			
			?>
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
	echo '<form method="post" action="?vista=vista_sistema">';
	formulario($row_vista_sistema['cod_vista_sistema'],$row_vista_sistema['nombre'],$row_vista_sistema['descripcion'],$row_vista_sistema['cod_servicio'],$ultimo_id,$row_vista_sistema['apertura'],$row_vista_sistema['registrar'],$row_vista_sistema['consultar'],$row_vista_sistema['eliminar'],$row_vista_sistema['desactivar'],$row_vista_sistema['actualizar'],$vista);
		if (function_exists('detalle_transaccion')) {
		echo detalle_transaccion();
	}
	echo botoness($mostrar_btn)."</form>";

}elseif($mostrar_formulario_consulta==true){
	formulario_consulta($row_vista_sistema['cod_vista_sistema'],$row_vista_sistema['nombre'],$row_vista_sistema['descripcion'],$row_vista_sistema['cod_servicio'],$ultimo_id,$row_vista_sistema['apertura'],$row_vista_sistema['registrar'],$row_vista_sistema['consultar'],$row_vista_sistema['eliminar'],$row_vista_sistema['desactivar'],$row_vista_sistema['actualizar'],$vista,$row_vista_sistema['nombre_servicio']);
}elseif($resultado_listar>0){
	echo listar($vista_sistema,$vista);
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

function listar($vista_sistema,$vista){
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
			<th>Nombre del archivo</th><th>Descripción</th><th>Servicio</th><th>Modulo</th></tr>
			</thead>
			<tbody>
			';
			$i=0;
	while($row=$vista_sistema->row()){
	$i++;
	$parametro['tipo']='botonera';
	$parametro['estatus']=$row['estatus'];
	$botonera=mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro);
	$ancho=strlen($botonera)/5.4;
	$salida.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:'.$ancho.'px"> <span style=" float:left; margin-right:1px;">'.$i.' 
		
		</span>
				'.$botonera.'
				<input type="hidden" name="cod_vista_sistema" value="'.$row['cod_vista_sistema'].'">
		</form>
	</td>
	<td>'.$row['nombre'].'</td><td>'.$row['descripcion'].'</td><td>'.nombre_foraneo_cod_servicio($row['cod_servicio']).'</td><td>'.$row['nombre_modulo'].'</td>
	</tr>';
	}
	
	$salida.='
	</tbody>
		</table>
		';
		return $salida;
	}

function formulario_modificar(){
echo '
<script type="text/javascript" src="js/js_vista_sistema.js" ></script>
<span style="float:right; color:red">(*) Campos obligatorios</span>


<input readonly id="cod_vista_sistema" class="form-control" type="hidden" name="cod_vista_sistema" value="'.$cod_vista_sistema.$ultimo_id.'" />

	<div class="row">
		<div class="col-md-3"></div>
		'.$this->nombre().'
	</div>


	<div class="row">
		<div class="col-md-3"></div>
		'.$this->descripcion().'
	</div>


	<div class="row">
		<div class="col-md-3"></div>
		'.$this->tipo_apertura().'
	</div>
	<div class="row">
		<div class="col-md-3"></div>
		'.$this->sevicio().'
	</div>

	<div class="row">
		<div class="col-md-3"></div>
		'.$this->eventos_vista().'
	</div>

	';
}
function formulario_consulta($cod_vista_sistema,$nombre,$descripcion,$cod_servicio,$ultimo_id,$apertura,$registrar,$consultar,$eliminar,$desactivar,$actualizar,$vista,$nombre_servicio){
echo '
	<div class="row">
		<div class="col-md-3 col-md-offset-3">
			<label>
				Nombre del archivo: 
			</label>
				'.$nombre.'
		</div>
		<div class="col-md-3 ">
			<label>
				Ventana: 
			</label><br>
			'.($apertura ? 'Misma Pagina (_SELF)' : 'Pagina Aparte (_BLANK)').'
		</div>
	</div>


	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<label>
				Descripción:
			</label>
				'.$descripcion.'
		</div>
	</div>


	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<label>
				Servicio:
			</label>
				'.$nombre_servicio.'
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<label>
				Eventos de la vista
			</label><br>
				<input disabled type="checkbox" name="consultar" value="1" '.($consultar=='1' ? 'checked' : '').' > Consultar
				<input disabled type="checkbox" name="registrar" value="1" '.($registrar=='1' ? 'checked' : '').' > Registrar
				<input disabled type="checkbox" name="actualizar" value="1" '.($actualizar=='1' ? 'checked' : '').' > Modificar
				<input disabled type="checkbox" name="eliminar" value="1" '.($eliminar=='1' ? 'checked' : '').' > Eliminar
				<input disabled type="checkbox" name="desactivar" value="1" '.($desactivar=='1' ? 'checked' : '').' > Desactivar
				
		</div>
	</div>

	';
}
function botoness($mostrar_btn){
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


function nombre_foraneo_cod_servicio($valor){
	include_once("modelo/class_servicio.php");
	$servicio = new servicio;
	$servicio->set_cod_servicio($valor);
	$servicio->consultar();
	$arreglo=$servicio->row();
	return $arreglo['nombre'];
}

?>
<script>

function msj_eliminar(){
	return confirm("Esta seguro de eliminar este registro?");
}

</script>
