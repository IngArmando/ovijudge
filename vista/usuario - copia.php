


<div class="panel panel-default">
<div class="panel-heading">
	<div class="row">
		<div class="col-xs-3 col-md-4" style="text-align:left">
					<?php
					if($mostrar_agregar==true)
					
						$parametro['tipo']='consulta_nuevo';
						echo mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro);
					?>
		</div>
		<div class="col-xs-5 col-md-4" style="text-align:center">		
			<span style="font-size:18px"><span class="glyphicon glyphicon-user"></span> Registro de usuarios </span>	
		</div>
		<div class="col-xs-4 col-md-4"  style="text-align:right">	
					
			<div style="float:right; margin-top:-4px; <?php if($mostrar_exportar==false) echo 'display:none;';?>" >
				Exportar en: 
					<a href="#" onClick ="$('#data_table').tableExport({type:'sql'});" class="btn btn-default btn-sm">  SQL</a>
					<a href="#" onClick ="$('#data_table').tableExport({type:'csv',escape:'false'});"  class="btn btn-default btn-sm"> CSV</a>
					<a href="#" onClick ="$('#data_table').tableExport({type:'excel',escape:'false'});"  class="btn btn-default btn-sm"> CALC</a>		
					<a href="#" onClick ="window.open('rep.php?&rep=<?php echo $_GET['vista']; ?>');"  class="btn btn-default btn-sm"> PDF</a>
			</div>
			
			<?php
			
			if($reporte_html==true || $mostrar_formulario==true){
				echo '
			<a class="btn btn-default btn-sm" href="'.$_SERVER["HTTP_REFERER"].'"  style="float:right;">
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
	echo '<form method="post" action="?vista=usuario" >';
	formulario($row_usuario['cedula'],$row_usuario['nombre'],$row_usuario['cod_tipo_usuario'],$row_usuario['apellido'],$row_usuario['sexo'],$row_usuario['correo'],$row_usuario['telefono_movil'],$row_usuario['telefono_fijo'],$row_usuario['fecha_nacimiento'],$row_usuario['clave'],$row_usuario['estatus'],$ultimo_id,$row_preguntas,$bloquear);
		if (function_exists('detalle_transaccion')) {
		echo detalle_transaccion();
	}
	$parametro['tipo']=$_REQUEST['evento'];
	echo mostrar_btn($_SESSION['cod_tipo_usuario'],$vista,$parametro)."</form>";

}elseif($resultado_listar>0){
	echo listar($usuario,$vista);
}elseif($reporte_html){
	echo reporte_html($row_usuario);
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

function listar($usuario,$vista){
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
			<th>Cedula</th><th>Nombre</th><th>Tipo de usuario</th><th>Apellido</th>
			<th>Sexo</th><th>Correo</th><th>Teléfono Movil</th><th>Telefono Fijo</th><th>Fecha de nacimiento (dd-mm-yyyy)</th><th>Estatus</th></tr>
			</thead>
			<tbody>
			';
			$i=0;

	while($row=$usuario->row()){
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
		</form>
	</td>
	<td>'.$row['cedula'].'</td>
	<td>'.$row['nombre'].'</td>
	<td>'.nombre_foraneo_cod_tipo_usuario($row['cod_tipo_usuario']).'</td>
	<td>'.$row['apellido'].'</td>
	<td>'.($row['sexo']=="m" ? "Masculino" : "Femenino").'</td>
	<td>'.$row['correo'].'</td><td>'.$row['telefono_movil'].'</td>
	<td>'.$row['telefono_fijo'].'</td>
	<td>'.date("d-m-Y",strtotime($row['fecha_nacimiento'])).'</td>
	<td>'.($row['estatus']==1 ? "Activo" : "Inactivo").'</td>
	</tr>';
	}
	$salida.='
	</tbody>
		</table>
		';
		return $salida;
	}
function reporte_html($row){
$html.='<div class="row">
			<div class="col-md-3 col-md-offset-3">
				<label>Cedula</label>
				'.$row['cedula'].'
			</div>
		</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-3">
			<label>Nombre</label>
				'.$row['nombre'].'
		</div>
		<div class="col-md-3">
			<label>Apellido</label>
			'.$row['apellido'].'
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-3">
			<label>Sexo</label>
				'.($row['sexo']=='m' ? 'Masculino' : 'Femenino').'
		</div>
		<div class="col-md-3">
			<label>Fecha de nacimiento</label>
			'.$row['fecha_nacimiento'].'
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<label>Correo</label>
			'.$row['correo'].'
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-3">
			<label>Teléfono Movil</label>
				'.$row['telefono_movil'].'
		</div>
		<div class="col-md-3">
			<label>Teléfono Fijo</label>
				'.$row['telefono_fijo'].'
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-3">
				<label>Estado:</label>
					'.$row['nombre_estado'].'
		</div>
		<div class="col-md-3">
						<label>Municipio:</label>
					'.$row['nombre_municipio'].'
		</div>	
	</div>
	<div class="row">
		<div class="col-md-4  col-md-offset-3">
						<label>Parroquia:</label>
					'.$row['nombre_parroquia'].'
		</div>	
	</div>
	
	';
	return $html;	
}

function formulario($cedula,$nombre,$cod_tipo_usuario,$apellido,$sexo,$correo,$telefono_movil,$telefono_fijo,$fecha_nacimiento,$clave,$estatus,$ultimo_id,$row_preguntas){
echo '
<script type="text/javascript" src="js/js_usuario.js" ></script>
<span style="float:right; color:red">(*) Campos obligatorios</span>
<link rel="stylesheet" type="text/css" href="libreria/clave/style.css" />
<script src="libreria/clave/script.js"></script>

	<div class="row">
		'.campo_cedula().'
	</div>


	<div class="row">
		'.campo_nombre().'
		'.campo_apellido().'
	</div>


	<div class="row">
		'.campo_sexo().'
		'.campo_fecha_nacimiento().'
	</div>


	<div class="row">
		'.campo_correo().'
	</div>
	<div class="row">
		'.campo_telefono_movil().'
		'.campo_telefono_fijo().'
	</div>
	<div class="row">
		'.campo_estados($cod_parroquia).'
		'.campo_municipios($cod_parroquia).'
		'.campo_parroquia($cod_parroquia).'
	</div>
	

'.($mostrar_cargo==true ? '
	<div class="row">
		<div class="col-md-3 col-md-offset-3">
			<label>
				Estatus
			</label>
				<br><input  '.($estatus=="0" ? "checked" : "").' type="radio" value="0" name="estatus"> INACTIVO<input '.($estatus=="1" ? "checked" : "").'  type="radio" value="1" name="estatus"> ACTIVO<br>
		</div>
				<div class="col-md-3">
			<label>
				Rol del usuario <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				'.combo_cod_tipo_usuario($cod_tipo_usuario, $bloquear).'
		</div>
	</div>
' : '<input type="hidden" name="estatus" value="1">
	 <input type="hidden" name="cod_tipo_usuario" value="2">').'
	';
if($_REQUEST['evento']=='nuevo' and $_SESSION['login']==true){

}else{

echo mostrar_preguntas_secretas($row_preguntas);	
	
}

if(($_REQUEST['evento']=="nuevo" and !$_SESSION['login']) || !$bloquear){		
	echo mostrar_clave($clave);
	}
	if($_GET['evento']=='nuevo'){
		echo captcha_facil();
		$_SESSION['activar']['captcha']=true;
	}

}


function captcha_facil(){
$html='<div style="text-align:center"> Por favor escribe las letras y/o numeros que vez en la imagen: <br>

<img src="libreria/captchafacil/captcha.php" / style="margin-bottom:4px"><br>
<input onkeyup="desactivar_registrar()" type="text" size="16" id="captcha" name="captcha" maxlength="5"/>
</div>
<script>
	function desactivar_registrar(){
	texto=0;
	texto=document.getElementById("captcha").value;
	if(texto.length==5)
	 document.getElementById("registrar").disabled=false;
	 else
	 document.getElementById("registrar").disabled=true;
	}
</script>
';
return $html;
}
function captcha(){
	$salida.='
	<br>
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
	<script type="text/javascript">
     var verifyCallback = function(response) {
        document.getElementById("registrar").disabled=false;
        document.getElementById("captcha").value=response;
      };
 var onloadCallback = function() {
        grecaptcha.render("html_element", {
          "sitekey" : "6LfJMf8SAAAAADc1LO_0skgQD5lyL1haYQ27d1_-",
          "callback" : verifyCallback,
        });
      };

</script>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
		
			<div style="margin:0 auto; width:310px" id="html_element"></div>
	</div>
	</div>
	<input type="hidden" name="captcha" value="" id="captcha">

	';
	return $salida;
	}
function mostrar_clave($clave){
		$html.= '

	<div class="row">
		<div class="col-md-3 col-md-offset-3">
			<label>
				Clave <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input required id="clave"  class="form-control"  type="password" name="clave" value="'.$clave.'" />

		</div>
		<div class="col-md-3">
			<label>
				Confirmar clave <span style="color:red" title="Campo obligatorio">(*)</span>
			</label>
				<input required id="con_clave"  class="form-control"  type="password" name="clave" value="'.$clave.'" />
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<div id="pswd_info">
				<h4>La contraseña debe cumplir con los siguientes requerimientos:</h4>
				<ul>
					<li id="letter" class="invalid">Al menos <strong>1 letra</strong></li>
					<li id="capital" class="invalid">Al menos <strong>1 letra en mayuscula</strong></li>
					<li id="number" class="invalid">Al menos <strong>1 numero</strong></li>
					<li id="especial" class="invalid">Al menos <strong>1 caracter especial</strong></li>
					<li id="length" class="invalid">Longitud min. de <strong>8 caracteres</strong></li>
					
				</ul>
			</div></div>
	</div>
		';	
		return $html;
}

		$nacionalidad_cedula=explode("-",$cedula)[0];
		if($nacionalidad_cedula){
			echo "
			<script> 
			window.onload=function(){
			cambiar_cedula_combo_cedula('$nacionalidad_cedula');
			};

			
			</script>";
		}
		
function combo_cod_tipo_usuario($valor){
	include_once("modelo/class_tipo_usuario.php");
	$tipo_usuario = new tipo_usuario;
	$tipo_usuario->listar();
	$salida.= '<div class="input-group">

	';
	$salida.= '<select style="z-index:1"  id="cod_tipo_usuario" class="form-control" name="cod_tipo_usuario" >'; 
	$salida.= '';
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




function mostrar_preguntas_secretas($row_preguntas){
	
	require_once("modelo/class_configurar.php");
	$configurar = new configurar;
	$configurar->consultar();
	$row=$configurar->row();
	for($i=0 ; $i<$row['pregunta_crear'] ; $i++){
		$salida.='
		<div class="row">
			<div class="col-md-3 col-md-offset-3">
				<label>Pregunta secreta '.($i+1).'  <span style="color:red" title="Campo obligatorio">(*)</span></label> 
				<input required name="pregunta[]" type="text" class="form-control" value="'.$row_preguntas[$i]['pregunta'].'">
			</div>
			<div class="col-md-3">
				<label>Respuesta secreta '.($i+1).'  <span style="color:red" title="Campo obligatorio">(*)</span></label>
				<input required type="text" name="respuesta[]" class="form-control" value="'.$row_preguntas[$i]['respuesta'].'">
			</div>
		</div>
		';
		
	}
	return $salida;
	
}



?>
<script>

function msj_eliminar(){
	return confirm("Esta seguro de eliminar este registro?");
}

		
		function cambiar_cedula_combo_cedula(valor){
			nacionalidad=document.getElementById("nacionalidad_cedula");
			boton=document.getElementById("button_cedula");
			nacionalidad.value=valor;
			boton.innerHTML=valor;
		}
	
	$(function(){
		$(".municipios").hide();
		$(".parroquias").hide();
		
	});
	function cambiar_municipio(a){
		
		$(".municipios").hide();
		$(".parroquias").hide();
		document.getElementById("cam_cod_municipio").selectedIndex=0;
		document.getElementById("cam_cod_parroquia").selectedIndex=0;
		$(".estado_"+a.value).show();
		}
	function cambiar_parroquias(a){
		
		$(".parroquias").hide();
		document.getElementById("cam_cod_parroquia").selectedIndex=0;
		$(".municipios_"+a.value).show();
		
		}
		
		
</script>
<?php
$_SESSION['activar']['captcha']=false;
function campo($tipo,$valor){
	switch($tipo){
		case 'Cedula':{
			exit($tipo);
		}
		break;
		case 'Fecha de nacimíentó':{
			exit($tipo);
		}
	}
}
?>

