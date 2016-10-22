<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class="col-xs-4 col-md-4" style="text-align:left">
					<a <?php if($_GET['evento']=='nuevo') echo 'style="display:none;"';?> title="Agregar nuevo registro" class="btn btn-success btn-sm" href="?vista=noticia&evento=nuevo">Agregar Noticias</a>
		</div>
		<div class="col-xs-3 col-md-4" style="text-align:center">		
			<span style="font-size:18px">Noticias</span>	
		</div>
		<div class="col-xs-5 col-md-4"  style="text-align:right">			

			<a class="btn btn-default btn-sm" href="?vista=noticia"  style="float:right; <?php if($_GET['evento']!='nuevo' and $_POST['evento']!='consultar') echo 'display:none;';?>">
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
	echo '<form method="post" action="?vista=noticia" enctype="multipart/form-data">';
	formulario($row_noticia['imagen'],$row_noticia['cod_noticia'],$row_noticia['titulo'],$row_noticia['descripcion'],$row_noticia['fecha_creacion'],$row_noticia['fecha_expiracion'],$row_noticia['cod_usuario'],$ultimo_id);
		if (function_exists('detalle_transaccion')) {
		echo detalle_transaccion();
	}
	echo botoness($mostrar_btn)."</form>";

}elseif($resultado_listar>0){
	echo listar($noticia);
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

function listar($noticia){

	$salida.='
			<script> var sub_titulo_pdf="Reporte de Noticias";</script>
			<script type="text/javascript" src="libreria/js_listado_general.js"></script>
					<table id="data_table" class="table table-striped table-bordered" width="100%" cellspacing="0">
			<thead>
			<tr>
			<th width="80px">
			Nro
			</th>
			<th>Titulo</th><th>Descripción</th><th>Fecha de creación</th><th>Fecha de Expiración</th><th>Usuario</th></tr>
			</thead>
			<tbody>
			';
			$i=0;
	while($row=$noticia->row()){
	$i++;
	$salida.='
	<tr>
	<td class="td_botones">
	
		<form method="post"  class="div_botones_listar" style=" margin:0px; display:inline-block; width:105px"> <span style=" float:left; margin-right:1px;">'.$i.' </span>
				<button type="submit" name="evento" value="consultar" title="Consultar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span></button>
				'.btn_eliminar_desactivar($row['estatus']).'
				<input type="hidden" name="cod_noticia" value="'.$row['cod_noticia'].'">
		</form>
	</td>
	<td>'.$row['titulo'].'</td>
	<td>'.$row['descripcion'].'</td>
	<td>'.$row['fecha_creacion'].'</td>
	<td>'.date("d-m-Y",strtotime($row['fecha_expiracion'])).'</td>
	<td> '.$row['usuario_nombre'].' '.$row['usuario_apellido'].'</td>
	</tr>';
	}
	
	$salida.='
	</tbody>
		</table>
		';
		return $salida;
	}

function formulario($imagen,$cod_noticia,$titulo,$descripcion,$fecha_creacion,$fecha_expiracion,$cod_usuario,$ultimo_id){
$html='
<script type="text/javascript" src="js/js_noticia.js" ></script>
<script src="libreria/nic/nicEdit-latest.js" type="text/javascript"></script>

<span style="float:right; color:red">(*) Campos obligatorios</span>


<input readonly id="cod_noticia" class="form-control" type="hidden" name="cod_noticia" value="'.$cod_noticia.$ultimo_id.'" />

	<div class="row">
		<div class="col-md-6 col-md-offset-1">
			<label>
				Titulo <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input id="titulo" class="form-control"  type="text" onkeyup="this.value=this.value.toUpperCase()" name="titulo" value="'.$titulo.'" />
		</div>
		<div class="col-md-3">
			<label>
				Imagen principal <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input id="imagen" class="form-control"  type="file" name="imagen" value="'.$imagen.'" />
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-1">
			<label>
				Fecha de creación
			</label>
				<input id="fecha_creacion" class="form-control" type="text" onkeyup="this.value=this.value.toUpperCase()" readonly name="fecha_creacion" value="'.($row_noticia['fecha_creacion'] ? $row_noticia["'fecha_creacion'"] : date("d-m-Y h:i:s")).'" />
		</div>
		
		<div class="col-md-3">
			<label>
				Fecha de Expiración <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input id="fecha_expiracion" class="form-control"  type="text" onkeyup="this.value=this.value.toUpperCase()" name="fecha_expiracion" value="'.($fecha_expiracion ? date("d-m-Y",strtotime($fecha_expiracion)) : "").'" />
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<label>
				Descripción <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<textarea name="descripcion" class="form-control" id="descripcion">'.htmlentities($descripcion).'</textarea>
		</div>
	</div>




	<div class="row">
		<div class="col-md-6 col-md-offset-3">

				<input id="cod_usuario"  class="form-control" readonly  type="hidden" onkeyup="this.value=this.value.toUpperCase()" name="cod_usuario" value="'.$_SESSION['cod_usuario'].'" />
		</div>
	</div>
		<script type="text/javascript">
			new nicEditor({fullPanel : true}).panelInstance("descripcion");
			</script>
						
	';

echo $html;
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
?>
<script>

function msj_eliminar(){
	return confirm("Esta seguro de eliminar este registro?");
}

</script>
