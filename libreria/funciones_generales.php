<?php
//FUNCION QUE GENERA LOS PRIVILEGIOS DEL USUARIO

function generar_privilegios($cod_tipo_usuario){
	   
		require_once("modelo/class_usuario.php");
		$usuario = new usuario;
		$usuario->set_cod_tipo_usuario($cod_tipo_usuario);
		$a=$usuario->privilegios();
		$_SESSION['vista_mision']=true;
		$_SESSION['vista_vision']=true;
		$_SESSION['vista_resena']=true;
		while($row_usuario = $usuario->row()){
			
			$nombre=$row_usuario['nombre'];
			$nombre=explode('&',$nombre);
			
			$_SESSION['vista_'.$nombre[0]]=true;
			$_SESSION['cod_vista_'.$nombre[0]]=$row_usuario['cod_vista_sistema'];
			
		}

			
}

function consultar_inactividad(){
	$tiempo_de_expiracion=tiempo_inactividad();
	require_once("modelo/class_usuario.php");
	$usuario = new usuario;
		
		$usuario->set_cod_usuario($_SESSION['cod_usuario']);
		if($usuario->consultar()>0){			
			$fecha_hora_vieja=date('Y-m-d h:i:s a', strtotime($usuario->ultima_actividad." +".$tiempo_de_expiracion." minute"));
			$fecha_hora_actual=date('Y-m-d h:i:s a', strtotime("now"));
			//exit($fecha_hora_vieja."s".$fecha_hora_actual);
			$datetime1 = new DateTime($fecha_hora_vieja);
			$datetime2 = new DateTime($fecha_hora_actual);
			if($datetime1 < $datetime2){
				return 1;
			}else{
				$usuario->actualizar_entrada();
			}
		}	
	
}
function consultar_inactividad_control_ajax(){
		require_once("../modelo/class_db.php");
		$db = new db;
		$db->ejecutar("SELECT * FROM configurar");
		$row=$db->row();
		$tiempo_de_expiracion=$row['inactividad'];
		$res=$db->ejecutar("SELECT usuario.*, tipo_usuario.nombre as nombre_tipo_usuario, persona.*, date_format(persona.fecha_nacimiento,'%d-%m-%Y') as fecha_nacimiento, date_format(usuario.ultima_actividad,'%d-%m-%Y %h:%i:%s %p') as ultima_actividad, municipio.nombre as nombre_municipio, parroquia.nombre as nombre_parroquia, estado.nombre as nombre_estado FROM usuario INNER JOIN persona ON persona.cedula=usuario.cedula INNER JOIN parroquia ON persona.cod_parroquia=parroquia.cod_parroquia INNER JOIN municipio ON municipio.cod_municipio=parroquia.cod_municipio INNER JOIN estado ON estado.cod_estado=municipio.cod_estado INNER JOIN tipo_usuario ON tipo_usuario.cod_tipo_usuario=usuario.cod_tipo_usuario WHERE cod_usuario='".$_SESSION['cod_usuario']."'");
		$row=$db->row();
		if($res>0){			
			$fecha_hora_vieja=date('Y-m-d h:i:s a', strtotime($row['ultima_actividad']." +".$tiempo_de_expiracion." minute"));
			$fecha_hora_actual=date('Y-m-d h:i:s a', strtotime("now"));
			//exit($fecha_hora_vieja."s".$fecha_hora_actual);
			$datetime1 = new DateTime($fecha_hora_vieja);
			$datetime2 = new DateTime($fecha_hora_actual);
			if($datetime1 < $datetime2){
				return 1;
			}
		}	
	
}

function verificar_inactividad(){
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		
		
	}else{
		if(consultar_inactividad()==1){
			session_start();
			session_unset();
			session_destroy();
			$_SESSION[]=array();
			session_start();
			$_SESSION['msj_tipo']='danger';
			$_SESSION['msj']='Disculpe, por razones de seguridad su sesión fue cerrada, intente de nuevo.';
			header("location:index.php");
			exit();		
		}
	}
	
}

function verificar_preguntas_seguridad(){
	require_once("modelo/class_pregunta_seguridad.php");
	$pregunta_seguridad = new pregunta_seguridad;
	if($_SESSION['cod_usuario']){
		$pregunta_seguridad->set_cedula($_SESSION['cedula']);
		if($pregunta_seguridad->consultar()==0){
				$_SESSION['redireccion']='index.php?vista=pregunta_seguridad';
				$_SESSION['msj_tipo']="info";
				$_SESSION['msj']="Por favor establesca sus preguntas de seguridad.";
				
		}
	}	
	
}

function verificar_caducidad(){
	require_once("modelo/class_usuario.php");
	$usuario = new usuario;
	if($_SESSION['cod_usuario']){
		$usuario->set_cod_usuario($_SESSION['cod_usuario']);
		if($usuario->consultar()>0){
			$row=$usuario->row();
			$fecha_clave=$usuario->fecha_clave;
			$clave		=$usuario->clave;
			$fecha_hora_actual=date("Y-m-d");
			$dias=dias_transcurridos($fecha_clave,$fecha_hora_actual);
			
			$dias_vencer=dias_vencer();
			$dias_restantes=$dias_vencer-$dias;
			//exit('Transcurrido: '.$dias.', Restante:'.$dias_restantes);
			if($dias>=$dias_vencer){
				if($_GET['vista']!='cambiar_pass'){
					$_SESSION['redireccion']='index.php?vista=cambiar_pass';
					$_SESSION['msj_tipo']='danger';
					$_SESSION['msj']='Estimado usuario su contraseña ha vencido, por favor cambiela inmediatamente.';
				}
				
			}elseif($dias_restantes<4){
				
				$mensaje="Estimado usuario su contraseña vence en ".$dias_restantes." dias, le recomendamos cambiarla inmediatamente.";
				$url="cambiar_pass";
				$cod_usuario=$_SESSION['cod_usuario'];
				$observacion=$clave;
				//registrar_notificacion($mensaje,$url,$cod_usuario,$observacion);
			}
		}
	}
}
function verificar_clave_default(){
	require_once("modelo/class_usuario.php");
	$usuario = new usuario;
	if($_SESSION['cod_usuario']){
		
		$usuario->set_cod_usuario($_SESSION['cod_usuario']);
		if($usuario->consultar()>0){

			$fecha_clave=$usuario->fecha_clave;
			$clave=$usuario->clave;
			$fecha_hora_actual=date("Y-m-d");
			if(is_numeric($clave)){
				if($_GET['vista']!='cambiar_pass'){
					$_SESSION['redireccion']='index.php?vista=cambiar_pass';
					$_SESSION['msj_tipo']='danger';
					$_SESSION['msj']='Estimado usuario por medidas de seguridad por favor cambie su clave.';
				}
				
			}
		}
	}
}

function verificar_notificaciones(){
		require_once("modelo/class_notificacion.php");
		$notificacion=new notificacion;
		$notificacion->set_cod_usuario($_SESSION['cod_usuario']);
		return $notificacion->verificar();
	
}
function registrar_notificacion($mensaje,$url,$cod_usuario,$observacion){
		require_once("modelo/class_notificacion.php");
		$notificacion=new notificacion;
		$notificacion->set_mensaje($mensaje);
		$notificacion->set_url($url);
		$notificacion->set_cod_usuario($cod_usuario);
		$notificacion->set_observacion($observacion);
		$notificacion->set_estatus(0);
		$notificacion->set_fecha_comparar(date('d-m-Y'));
		if($notificacion->consulta_repetido()==0){
			if($notificacion->no_repetir()==0){
				$notificacion->registrar();
			}
		}
}


function dias_vencer(){
		require_once("modelo/class_configurar.php");
		$configurar= new configurar;
		$configurar->consultar();
		$row=$configurar->row();
		return $row['caducidad'];
	
}
function tiempo_inactividad(){
		require_once("modelo/class_configurar.php");
		$configurar= new configurar;
		$configurar->consultar();
		$row=$configurar->row();
		return $row['inactividad'];
	
}

function dias_transcurridos($fecha_i,$fecha_f){
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}

function actualizar_ultima_actividad(){
	require_once("modelo/class_usuario.php");
	$usuario = new usuario;
	if($_SESSION['cedula']){
		$usuario->set_cedula($_SESSION['cedula']);
		$usuario->actualizar_entrada();
		}
	}
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function verificar_ip(){
	$ip=getUserIP();
	require_once("modelo/class_bloqueo_ip.php");
	$bloqueo_ip = new bloqueo_ip;
	$bloqueo_ip->set_ip($ip);
	if($bloqueo_ip->consultar()>0){
	exit("<script>alert('Estimado usuario, ha ocurrido un error en el sistema comuniquese con el administrador a traves del siguiente correo: ds000082@gmail.com')</script> <style> body {background-image:url('images/fondo.jpg'); background-repeat: no-repeat; background-size:100% }</style>");	
	}
}
function bloquear_ip(){
	require_once("modelo/class_bloqueo_ip.php");
	$bloqueo_ip = new bloqueo_ip;
	$bloqueo_ip->set_ip(getUserIP());
	$bloqueo_ip->set_agente($_SERVER['HTTP_USER_AGENT']);
	if($bloqueo_ip->consultar()==0){
		$bloqueo_ip->registrar();	
	}
}
function bloquear_usuario($cedula){
	require_once("modelo/class_usuario.php");
	$usuario= new usuario;
	$usuario->set_cedula($cedula);
	$usuario->bloquear_usuario();
}
function verificar_intentos_fallidos($cedula){
		session_start();
		require_once("modelo/class_configurar.php");
		$configurar = new configurar;
		$configurar->consultar();
		$row_configurar=$configurar->row();	
		
	if($_SESSION['intentos']>=$row_configurar['intentos_fallidos']){
		
		$_SESSION['msj_tipo']="danger";
		$_SESSION['msj']="Usuario Inactivo ó Bloqueado, Por favor contacte el administrador.";
		bloquear_usuario($cedula);
		header("location:index.php");
		$_SESSION['intentos']=0;
		exit();
	}
	return $row_configurar['intentos_fallidos']-$_SESSION['intentos'];
}

if($_SERVER['HTTP_USER_AGENT']=='Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; Netsparker)'){
	
	bloquear_ip();
	
}

function btn_eliminar_desactivar($estatus){
	if($estatus==1){
		return '<button type="submit" name="evento" value="eliminar" title="Eliminar" class="btn btn-danger btn-sm" onclick="return msj_eliminar()"><span class="glyphicon glyphicon-trash"></span></button>';
	}else{
		
		return '<button type="submit" name="evento" value="eliminar" title="Activar" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-font"></span></button>';
	}
}


function lemez_combo($id_combo,$value,$texto){
	
	echo '
	<script>
		function lemez_combo(id_combo,value,texto){
				select=opener.document.getElementById(id_combo,value,texto);
				cantidad_actual=select.options.length;
				select.options[cantidad_actual]= new Option(texto,value);
				select.selectedIndex=cantidad_actual;
				window.close();
		}
		lemez_combo("'.$id_combo.'","'.$value.'","'.$texto.'");
	</script>
	';
}
function mostrar_privilegios($cod_tipo_usuario,$vista){
	$cod_vista_sistema=$_SESSION['cod_vista_'.$vista];
	require_once('modelo/class_privilegio.php');
	$privilegio = new privilegio;
	$privilegio->set_cod_tipo_usuario($cod_tipo_usuario);
	$privilegio->set_cod_vista_sistema($cod_vista_sistema);
	$o=$privilegio->consulta_doble('cod_tipo_usuario','cod_vista_sistema');
	
	return $privilegio->row();	
}

function mostrar_btn($cod_tipo_usuario,$vista,$parametro){
		$tipo=$parametro['tipo'];
		$cod_usuario_reg=$parametro['cod_usuario_reg'];
		$row_privilegio=mostrar_privilegios($cod_tipo_usuario,$vista);
		
		switch($tipo){
			case 'botonera':{
				if($row_privilegio['consultar']){
					$html.='
					<button  type="submit" name="evento" value="reporte_html_individual" title="Consultar" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-search"></span></button>';
				}
				if($row_privilegio['actualizar'] || $cod_usuario_reg==$_SESSION['cod_usuario']){
					$html.='
					<button  type="submit" name="evento" value="formulario_modificar" title="Modificar" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></button>';
				}
				if($row_privilegio['desactivar'] || $cod_usuario_reg==$_SESSION['cod_usuario']){
					if($parametro['estatus']=='1')
						$html.=' <button type="submit" name="evento" value="desactivar" title="Desactivar" class="btn btn-warning btn-xs" ><span class="glyphicon glyphicon-ban-circle"></span></button>
						
						';
					else
						$html.=' <button type="submit" name="evento" value="activar" title="Activar" class="btn btn-info btn-xs btn_status_desactivo" ><span class="glyphicon glyphicon-ok"></span></button>';

				}
				if($row_privilegio['eliminar']){
					$html.='
					<button type="submit" name="evento" value="eliminar" title="Eliminar" class="btn btn-danger btn-xs" onclick="return msj_eliminar()"><span class="glyphicon glyphicon-remove"></span></button>';
				}				
			}
			break;
			case 'consulta_nuevo':{
				if($row_privilegio['registrar']){
					$html.='<a title="Agregar nuevo registro" class="btn btn-success btn-sm" href="'.$_SERVER['REQUEST_URI'].'&evento=formulario_registrar">Agregar nuevo</a>';
				}	
			}
			break;
			case 'consulta_modificar':{
				if($row_privilegio['actualizar']){
					$html.=botones('modificar');
				}	
			}
			break;
			case 'registrar':{
				if($row_privilegio['registrar']){
					$html.=botones('registrar');
				}	
			}
			break;
		}


	return $html;
}
function autorizar_si_registro($registrar){
	
}
function foto_perfil_peque($cedula){
	require_once("modelo/class_persona.php");
	$persona = new persona;
	$persona->set_cedula($cedula);
	$persona->consultar();
	if($persona->foto_perfil_peque){
		$foto=$persona->foto_perfil_peque;
	}else{
		
		$foto='chat/admin/images/img-no-avatar.gif';
		
	}
	return '<a href="?vista=dato_personal&evento=dato_personal_html"><img width="35px" src="'.$foto.'?leo='.rand(100,999).'" ></a>';
	
}

function botones($mostrar_btn){
$salida.='

	<div class="row">
		<div class="col-md-6  col-md-offset-3" style="text-align:center">
		';
		switch($mostrar_btn){
			case "registrar":{
			$salida.='
			<button onclick="return validar()" id="registrar" class="btn btn-default btn-lg"  type="submit" name="evento" value="registrar">
				<span class="glyphicon glyphicon-floppy-disk" > </span>
				Registrar
			</button>';
			}
			break;
			case "modificar":{
			$salida.='
			<button onclick="return validar()" id="modificar" class="btn btn-default btn-lg" type="submit" name="evento" value="modificar">
				<span class="glyphicon glyphicon-edit" > </span>
				Modificar
			</button>
			';
			}
			break;
			case "editar_volver":{
			$salida.='
			<input type="hidden" name="volver" value="true">
			<button  onclick="return validar()" id="modificar" class="btn btn-default" type="submit" name="evento" value="editar">
				<span class="glyphicon glyphicon-edit" > </span>
				Editar
			</button>
			';
			}	
			break;
			case "editar_limitado":{
				$salida.='
				<button  onclick="return validar()" id="modificar" class="btn btn-default" type="submit" name="evento" value="editar_limitado">
				<span class="glyphicon glyphicon-edit" > </span>
				Editar
				</button>';			
				
			}		
			break;
			case 'regresar':{
				$salida.='
			<a  class="btn btn-default btn-sm" href="'.$_SERVER["HTTP_REFERER"].'" >
				<span class="glyphicon glyphicon-arrow-left"></span>
				Regresar
			</a>';
				
			}
			break;
		
		
		}
			$salida.='

		</div>
    </div>';
    return $salida;
    
 }
 function btn_regresar($vista){
	 if($_GET['ref'])
	 $vista=$_GET['ref'];
	 		return '
			<a style="margin:0px; padding:3px" class="btn btn-default btn-sm" href="?vista='.$vista.'" >
				<span class="glyphicon glyphicon-arrow-left"></span>
				Regresar
			</a>';
}

?>
