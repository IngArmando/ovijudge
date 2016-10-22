<?php
ini_set('display_errors','OFF');
error_reporting(E_ALL ^E_NOTICE ^E_DEPRECATED);
session_start();
date_default_timezone_set("America/Manaus"); 
//echo date('h:i:s',time());
//echo phpinfo();
//header("Expires: Sat, 26 Jul 2018 05:00:00 GMT");
//$_SESSION['cod_tipo_usuario']="";
//INCLUYE FUNCIONES GENERALES QUE SE PUEDEN UTILIZAR EN DISTINTAS PARTES DEL SISTEMA
require_once("libreria/funciones_generales.php");
require_once("libreria/funciones_generales_concurso.php");

//verificar_ip();
//verificar_actualizar_datos_personales();


if($_SESSION['cod_usuario']){
verificar_inactividad();
verificar_caducidad();
}

//ARCHIVO PRINCIPAL A CARGAR CUANDO SE ABRE LA PAGINA
$principal 			="principal";
//SANEAMOS EL METODO GET PARA EVITAR ATAQUES DE INJECCION SQL
$vista				=htmlspecialchars($_GET['vista'], ENT_QUOTES);
//DETECTAMOS EL USUARIO QUE ESTA ENTRANDO A LA PAGINA
$cod_tipo_usuario	=$_SESSION['cod_tipo_usuario'];
//EN CASO QUE EL USUARIO NO EXISTA O NO ESTE LOGUEADO ASIGNAMOS UN USUARIO POR DEFECTO
if(!$cod_tipo_usuario || !$_SESSION['vista_intranet']){
	
	$_SESSION['cod_tipo_usuario']=1;
	generar_privilegios(1);
}
//generar_privilegios(1);

	
//VERIFICAMOS SI EL USUARIO TIENE ACCESO A LA VISTA EN CASO CONTRARIO LO DEVOLVEMOS A LA PAGINA PRINCIPAL
if($vista){
	if($_SESSION['vista_'.$vista]!=true){
		$_SESSION['msj_tipo']='warning';
		$_SESSION['msj']='Estimado usuario, usted no tiene acceso a esta pagina, por favor contacte al administrador de nuestro sitio web.';
		$vista=$principal;
	}
}else{
		$vista=$principal;
	}

if(!$_GET['vista'] and !$_SESSION['login']){
	$vista="principal";	
}elseif(!$_GET['vista'] and $_SESSION['login']){
	$vista="intranet";
}
//INCLUIMOS EL CONTROLADOR DE LA PAGINA SOLICITADA
if(file_exists("control/control_".$vista.".php")){
include_once("control/control_".$vista.".php");
}
verificar_clave_default();
//INCLUIMOS LA CABEZERA DE LA PAGINA
require_once('vista/header.php');

//EN CASO DE QUE EXISTA UNA REDIRECCION ESTE CODIGO REDIRECCIONA
if($_SESSION['redireccion']){
	$redi=$_SESSION['redireccion'];
	$_SESSION['redireccion']="";
	exit('<script> window.location.href="'.$redi.'"; </script>');
}

//EN CASO DE QUE EXISTA UN MSJ ESTE CODIGO MUESTRA LOS MENSAJES

if($_SESSION['msj']){

	echo '
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-'.$_SESSION['msj_tipo'].' alert-dismissable" style="margin-bottom:1px; margin-top:0px">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>'.$_SESSION['msj'].'</b>
				</div>
			</div>
		</div>
	</div>
 ';
	$_SESSION['msj']="";
	$_SESSION['msj_tipo']="";
}

//AGREGAMOS LA VISTA
echo "<div class='container'>";
if(!file_exists("vista/".$vista.".php")){
	echo '<div style="text-align:center"><img src="images/construccion.fw.png"></div>';
}else{
	require_once("vista/".$vista.".php");
	echo $html_todo;
	}
echo "</div>";
//AGREGAMOS EL PIE DE PAGINA

require_once('vista/footer.php');

?>

<script>
/*
function nobackbutton(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function(){window.location.hash="no-back-button";}
}
onload=function(){
	nobackbutton();
}
*/
</script>




