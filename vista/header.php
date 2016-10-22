<!DOCTYPE html>
<html lang="es">
  <head>
	<link rel="shortcut icon" href="images/favicon-32x32.png"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Entrenamiento para Competencias Internacionales de Programación</title>
	<link href="css/combinado2.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" id="chat_css" media="all" href="chat/external.php?type=css" charset="utf-8" />
	<script type="text/javascript" src="libreria/jquery/js/jquery-2.1.0.min.php"></script>
	<script type="text/javascript" src="libreria/jquery/js/jquery-ui.min.php"></script>
	<script type="text/javascript" src="libreria/bootstrap-3.3.6/js/bootstrap.min.php"></script>
	<script type="text/javascript" src="libreria/combinado.js.php"></script>

	<!--Calendario con hora -->
	<?php
	if($lib_calendario){
			echo '
			<script type="text/javascript" src="libreria/datepicker_master/js/moment.js"></script>
			<script type="text/javascript" src="libreria/datepicker_master/js/bootstrap-datetimepicker.min.js"></script>
			';
		}
	?>
	<!-- TABLE EXPORT DATATABLE -->
	<?php
	if($lib_data_table){
		echo '
		<script type="text/javascript" src="libreria/DataTables-1.10.11/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/media/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/extensions/Buttons/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/extensions/jszip.min.js"></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/extensions/pdfmake.min.js"></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/extensions/vfs_fonts.js"></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/extensions/Buttons/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/extensions/Buttons/js/buttons.print.min.js "></script>
		<script type="text/javascript" src="libreria/DataTables-1.10.11/extensions/Buttons/js/buttons.colVis.min.js "></script>
		';
	}
	?>
  </head>
  <body>
   
      <div class="container">
		  	<div class="row  color-top">
				<div class="col-md-7" >
					<a href="index.php"><img title="Hecho en Venezuela" width="100%" src="images/logo_reporte.png">  </a> 
				</div>
				<div class="col-md-3" >
					
				</div>
				<div style="text-align:right" class="col-md-2 hidden-xs" >
					<img title="Olimpiada Venezolana de Informática" height="50px" src="images/logo-smashing.png">   
				</div>
			</div>
			<div class="navbar navbar-default " role="navigation">
			<div class="navbar-header ">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="index.php" id="logo"></a>
			</div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form" method="post" action="?vista=intranet" autocomplete="off">
            <div class="form-group">
				<?php
				if($_SESSION['login']==true){
					
					$veri_no=verificar_notificaciones();
					
					echo '<table style="margin-top:-5px; ">
					<tr>
					<td rowspan="2" style="padding:3px">
					'.foto_perfil_peque($_SESSION['cedula']).'
					</td>
						<td style="font-size: 9px">
								Usuario: '.$_SESSION['nombre_usuario'].' '.$_SESSION['apellido_usuario'].' <br>Rol: '.$_SESSION['nombre_tipo_usuario'].', Ultima visita: '.$_SESSION['ultima_visita'].'
						</td>
						<td rowspan="2" >
							<button type="submit" name="evento" value="salir" class="btn btn-primary"> '; 
							echo $_SESSION['texto_btn_session'];
							echo ' </button>
						</td>
					</tr>
					<tr>
						<td style="font-size:10px"><span id="fecha_header" ></span>
							<span id="reloj" style="margin-right:20px"></span>
						</td>
					</tr>
				</table></div><br>';
				}else{
					echo formulario_login();
				}
            ?>
            
            
          </form>
          <ul class="nav navbar-nav">
			  <li><a href="index.php">Inicio</a></li>
			 
			  <?php
			  if($_SESSION['login']!=true){
				  
			 echo '
			  <li><a href="?vista=ayuda">Ayuda</a></li>
			 <li><a href="index.php?vista=usuario&evento=nuevo&limitado=true">Registrarse</a></li>';
			}
			  
		if($_SESSION['login']==true){
			  include_once("modelo/class_modulo.php");
			  include_once("modelo/class_vista_sistema.php");
			  include_once("modelo/class_servicio.php");
			  include_once("modelo/class_privilegio.php");

			  $modulo_menu= new modulo;
			  $vista_menu= new vista_sistema;
			  $servicio_menu= new servicio;
			  $privilegio			= new privilegio;
			  $cod_tipo_usuario=$_SESSION['cod_tipo_usuario'];
			  $privilegio->set_cod_tipo_usuario($cod_tipo_usuario);
			  $privilegio->consultar_por_cod_tipo_usuario();
			  
			  
				while($row=$privilegio->row()){
					$modulos[$row['cod_modulo']]['abre_li_modulo']='
					<li class="dropdown"  >
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$row['nombre_modulo'].' <span class="caret"></span> </a>
						<ul class="dropdown-menu multi-level">
						';
					$modulos[$row['cod_modulo']]['cierra_li_modulo']='</ul></li>';
					$servicios[$row['cod_modulo']][$row['cod_servicio']]['abre_li_servicio']='<li class="dropdown-submenu" >';
					$servicios[$row['cod_modulo']][$row['cod_servicio']]['nombre_servicio']='<a  href="#"  data-toggle="dropdown">'.$row['nombre_servicio'].'</a>';
					$servicios[$row['cod_modulo']][$row['cod_servicio']]['abre_ul_servicio']='<ul class="dropdown-menu">';
					$servicios[$row['cod_modulo']][$row['cod_servicio']]['cierra_ul_servicio']='</ul>';
					$servicios[$row['cod_modulo']][$row['cod_servicio']]['cierra_li_servicio']='</li>';
					$vistas[$row['cod_modulo']][$row['cod_servicio']][$row['cod_vista_sistema']]['todo']='<li><a '.($row['tipo_apertura'] ? 'target="_blank"' : '').' href="?vista='.$row['nombre'].'" >'.$row['descripcion'].'</a></li>';

				}
				foreach($modulos as $cod_modulos=>$modulos){
					$salida.=$modulos['abre_li_modulo'];
					foreach($servicios[$cod_modulos] as $cod_servicios=>$servicios[$cod_modulos]){
						$i=0;
						foreach($vistas[$cod_modulos][$cod_servicios] as $cod_vista_sistemas=>$vistas[$cod_modulos][$cod_servicios]){
							$i++;
							$salida_vista.=$vistas[$cod_modulos][$cod_servicios]['todo'];	
						}
						if($i>1){
							$salida.=$servicios[$cod_modulos]['abre_li_servicio'].$servicios[$cod_modulos]['nombre_servicio'].$servicios[$cod_modulos]['abre_ul_servicio'].$salida_vista.$servicios[$cod_modulos]['cierra_ul_servicio'].$servicios[$cod_modulos]['cierra_li_servicio'];
						}else{
							$salida.=$salida_vista;
						}
						$salida_vista='';

					}
					$salida.=$modulos['cierra_li_modulo'];	
				}
				echo $salida;
				
			}
			
			  ?>
	</ul>
	
        </div>
       
      </div>
      
    </div>
    </div>
    <script>
    		function cambiar_rif_combo_usuario(valor){
			rif=document.getElementById("nacionalidad");
			boton=document.getElementById("button_nacionalidad");
			rif.value=valor;
			boton.innerHTML=valor;
		}
    </script>
<script type="text/javascript"> 
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
	var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); 
	var f=new Date(); 
	

	 	var hora=<?php echo time(); ?>;
		var tiempo_inactividad=<?php echo tiempo_inactividad()*60; ?>;
		var tiempo_actual=0;
		function ref_hora(){
			tiempo_actual++;
			if(tiempo_actual>(tiempo_inactividad-60)){
				confirmacion=confirm("Estimado usuario por medidas de seguridad su sesión sera cerrada dentro de 1 min. Si desea mas tiempo presione aceptar.");
				if(tiempo_actual>tiempo_inactividad){
					window.location.href='index.php';
				
				}else if(confirmacion){
						tiempo_actual=0;	
						$.get( "control/control_ajax.php?evento=extender_tiempo", function( data ) {
							if(data==1){
								window.location.href='index.php';
							}
						});
				}
			}
			
			
			var tiempo_actual_cliente	=hora-(240*60);
			var hours = parseInt( tiempo_actual_cliente / 3600 ) % 24;			
			var minutes = parseInt( tiempo_actual_cliente / 60 ) % 60;
			var seconds = tiempo_actual_cliente % 60;
			document.getElementById("reloj").innerHTML=addZero(hours)+":"+addZero(minutes)+":"+addZero(seconds)+" VEN";
			hora++;
		}
		function addZero(i) {
			if (i < 10) {
				i = "0" + i;
			}
			return i;
		}
		<?php if($_SESSION['cod_usuario']>0){
		echo '
		
		setInterval("ref_hora();",1000);
		document.getElementById("fecha_header").innerHTML=(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); 
		';
		}
		?>
</script> 
<?php

function formulario_login(){
		$html.='<div class="input-group" style="width:100%">
						<input type="hidden" name="nacionalidad" id="nacionalidad" value="V">
						<div class="input-group-btn" style="width:40px">
							<button style="border-top-right-radius:0px; border-bottom-right-radius:0px; border-right:0px"  type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span id="button_nacionalidad">V</span> <span class="caret"></span></button>
						    <ul class="dropdown-menu" role="menu">
								<li><a href="#"  onclick="return cambiar_rif_combo_usuario(\'V\')">V </a></li>
								<li><a href="#" onclick="return cambiar_rif_combo_usuario(\'E\')">E </a></li>
							</ul>
						</div>
				  <input name="cedula" required pattern="^[0-9]+$" title="Solo debe escribir numeros" type="text" onkeyup="this.value=this.value.toUpperCase()" placeholder="Usuario" class="form-control">
				  </div>
				</div>
				<div class="form-group">
				  <input required name="clave" type="password" placeholder="Clave" title="Introdusca su clave" class="form-control">
				</div>
				
				<button type="submit" name="evento" value="acceder" class="btn btn-primary">Acceder</button>
				';
		return $html;
}

?>

