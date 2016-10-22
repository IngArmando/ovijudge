


<div class="panel panel-default">
<div class="panel-heading">
	
				<a title="Agregar nuevo registro" class="btn btn-success btn-sm" href="?vista=mision_gobierno&evento=nuevo">Agregar MIsiones del Gobierno</a>
				
				
				
						<div style="float:right; margin-top:-4px; <?php if($_GET['evento']=='nuevo' || $_POST['evento']=='consultar') echo 'display:none;';?>" >
						Exportar en: 
							<a href="#" onClick ="$('#data_table').tableExport({type:'sql'});" class="btn btn-default btn-sm">  SQL</a>
							<a href="#" onClick ="$('#data_table').tableExport({type:'csv',escape:'false'});"  class="btn btn-default btn-sm"> CSV</a>
							<a href="#" onClick ="$('#data_table').tableExport({type:'excel',escape:'false'});"  class="btn btn-default btn-sm"> CALC</a>
							<a href="#" onClick ="$('#data_table').tableExport({type:'doc',escape:'false'});"  class="btn btn-default btn-sm"> WRITER</a>			
							<a href="#" onClick ="$('#data_table').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"  class="btn btn-default btn-sm"> PDF</a>
						</div>
				<a class="btn btn-default btn-sm" href="?vista=mision_gobierno"  style="float:right; <?php if($_GET['evento']!='nuevo' and $_POST['evento']!='consultar') echo 'display:none;';?>">
					<span class="glyphicon glyphicon-arrow-left"></span>
					Regresar
				</a>
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
	echo '<form method="post" action="?vista=mision_gobierno">';
	formulario($row_mision_gobierno['cod_mision_gobierno'],$row_mision_gobierno['nombre'],$ultimo_id);
		if (function_exists('detalle_transaccion')) {
		echo detalle_transaccion();
	}
	echo botones($mostrar_btn)."</form>";

}elseif($resultado_listar>0){
	echo listar($mision_gobierno);
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

function listar($mision_gobierno){
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
		<th>Nombre</th></tr>
			</thead>
			<tbody>
			';
			$i=0;
	while($row=$mision_gobierno->row()){
	$i++;
	$salida.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:105px"> <span style=" float:left; margin-right:1px;">'.$i.' </span>
				<button type="submit" name="evento" value="consultar" title="Consultar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span></button>
				<button type="submit" name="evento" value="eliminar" title="Eliminar" class="btn btn-danger btn-sm" onclick="return msj_eliminar()"><span class="glyphicon glyphicon-trash"></span></button>
				<input type="hidden" name="cod_mision_gobierno" value="'.$row['cod_mision_gobierno'].'">
		</form>
	</td>
	<td>'.$row['nombre'].'</td>
	</tr>';
	}
	
	$salida.='
	</tbody>
		</table>
		';
		return $salida;
	}

function formulario($cod_mision_gobierno,$nombre,$ultimo_id){
echo '
<script type="text/javascript" src="js/js_mision_gobierno.js" ></script>

<input readonly id="cod_mision_gobierno" class="form-control" type="hidden" name="cod_mision_gobierno" value="'.$cod_mision_gobierno.$ultimo_id.'" />

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<label>
				Nombre <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input id="nombre" class="form-control"  type="text" name="nombre" value="'.$nombre.'" />
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
				Guardar
			</button>';
			}
			break;
			case "editar":{
			$salida.='
			<button id="modificar" class="btn btn-default" type="submit" name="evento" value="editar">
				<span class="glyphicon glyphicon-edit" > </span>
				Modificar
			</button>
			';
			}
		
		}
			$salida.='

		</div>
    </div>';
    return $salida;
    
 }
?>
<script>

function msj_eliminar(){
	return confirm("Esta seguro de eliminar este registro?");
}

</script>
