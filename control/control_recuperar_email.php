<?php
	$evento=$_POST['evento'];
	$correo=filter_var($_POST['correo'],FILTER_SANITIZE_EMAIL);
	$nueva_clave=rand(10000,99999);
	$para		=$correo;
	$de			='serenos.acarigua@gmail.com';
	$asunto		=htmlspecialchars('Nueva clave de acceso.', ENT_QUOTES);
	$mensaje	=htmlspecialchars('Su nueva clave para el acceso al sistema es: '.$nueva_clave.' por medidas de seguridad le recomendamos cambiarla inmediatamente.', ENT_QUOTES);
	$nombre		=htmlspecialchars('OVIJUDGE.', ENT_QUOTES);
	$pregunta	=$_POST['pregunta'];
	$respuesta	=$_POST['respuesta'];
	
	require_once("modelo/class_usuario.php");
	require_once("modelo/class_persona.php");
	require_once("modelo/class_pregunta_seguridad.php");
	require_once("modelo/class_configurar.php");
	switch($evento){
		case "recuperar":{
			$persona = new persona;
			$usuario = new usuario;
			
			$persona->set_correo($correo);
			if($persona->consulta_por('correo')>0){
				$row_persona=$persona->row();
				$cedula=$row_persona['cedula'];
				$usuario->set_cedula($cedula);
				if(verificar_respuesta($pregunta,$respuesta,$cedula)==true){
					$usuario->set_clave($nueva_clave);
					$usuario->cambiar_pass();
					$_SESSION['msj_tipo']="success";
					$_SESSION['msj']=enviar_correo($para,$de,$telefono,$asunto,$mensaje,$nombre,$nueva_clave);
				}else{
					$_SESSION['msj_tipo']="danger";
					$_SESSION['msj']="Sus respuestas son incorrectas, intente nuevamente.";
				}
				//mail($correo, 'Nueva clave' , 'Su nueva clave para el acceso a INIA es '.$nueva_clave);
				}else{
					$_SESSION['msj_tipo']="danger";
					$_SESSION['msj']="Disculpe, el correo introducido no existe.";
				}
			}
		break;
		case "preguntas":{
			$persona = new persona;
			$persona->set_correo($correo);
			if($persona->consulta_por('correo')>0){
				$row_persona=$persona->row();
				$pregunta_seguridad= new pregunta_seguridad;
				
				$pregunta_seguridad->set_cedula($row_persona['cedula']);
				
				$r=$pregunta_seguridad->consultar_lista();
				if($r>0){
					$_SESSION['activar']['solo_lectura_correo']=true;
					while($row_pregunta_seguridad=$pregunta_seguridad->row()){
						$preguntas[]='<div class="row">
						<div class="col-md-2  col-md-offset-3"><input type="hidden" name="pregunta[]" class="form-control" value="'.$row_pregunta_seguridad['cod_pregunta_seguridad'].'"><label>'.$row_pregunta_seguridad['pregunta'].':</label></div> <div class="col-md-4"> '.'<input type="text" required name="respuesta[]" class="form-control"> </div></div>';
					}
					$configurar= new configurar;
					$configurar->consultar();
					$row_configurar=$configurar->row();
					$cantidad_preguntas_mostrar=$row_configurar['pregunta_mostrar'];	
				}else{
					$_SESSION['msj_tipo']="danger";
					$_SESSION['msj']="Disculpe, usted no establecio preguntas de seguridad, por favor contacte el administrador.";					
				}
				
			}else{
				$_SESSION['msj_tipo']="danger";
				$_SESSION['msj']="Disculpe, el correo introducido no existe.";
			}
			
		}
		break;
		
}
		

function enviar_correo($para,$de,$telefono,$asunto,$mensaje,$nombre,$nueva_clave){
		if(filter_var($para,FILTER_VALIDATE_EMAIL) && filter_var($de,FILTER_VALIDATE_EMAIL)){
			date_default_timezone_set('Etc/UTC');
			require 'libreria/php_mailer/class.phpmailer.php';
			//Create a new PHPMailer instance
			$mail = new PHPMailer();
			//Tell PHPMailer to use SMTP
			$mail->IsSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug  = 0;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			//Set the hostname of the mail server
			$mail->Host       = 'smtp.gmail.com';
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port       = 587 or 465;
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			//Whether to use SMTP authentication
			$mail->SMTPAuth   = true;
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username   = "serenos.acarigua@gmail.com";
			//Password to use for SMTP authentication
			$mail->Password   = "14032002";
			//Set who the message is to be sent from
			$mail->SetFrom($de, $nombre);
			$mail->From = $de; 
			//$mail->FromName=$de;
			//Set an alternative reply-to address
			//$mail->AddReplyTo('replyto@example.com','First Last');
			//Set who the message is to be sent to
			$mail->AddAddress($para, '');
			//Set the subject line
			$mail->Subject = $asunto;
			//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
			$mensaje_listo="<b>Asunto:</b> ".$asunto."<br/><br/><b>Mensaje:</b> ".$mensaje;
			$mail->MsgHTML($mensaje_listo);
			//Replace the plain text body with one created manually
			//$mail->AltBody = $mensaje;
			//Attach an image file
			//$mail->AddAttachment('images/phpmailer_mini.gif');
			
			//Send the message, check for errors
			if(!$mail->Send()) {
				//CODIGO DE RROR
				$RR=$mail->ErrorInfo;
				//---
			  $msj_antes= "Su clave ha sido cambiada correctamente, aunque momentaneamente no podemos enviarsela por correo, por favor tome nota de su nueva clave que es: ".$nueva_clave;
			} else {
			  $msj_antes= "Felicidades, su nueva contraseña sera enviada en unos minutos a su correo electronico, le recomendamos revisar su CORREO NO DESEADO O SPAM.";
			}
		}else{
			$msj_antes= "Disculpe, pero ha introducido datos incorrectos.";
		}
		return $msj_antes;
}

function verificar_respuesta($pregunta,$respuesta,$cedula){
	$pregunta_seguridad= new pregunta_seguridad;
	$pregunta_seguridad->set_cedula($cedula);

	foreach($pregunta as $i=>$valor){
		$pregunta_seguridad->set_cod_pregunta_seguridad($valor);
		$pregunta_seguridad->set_respuesta($respuesta[$i]);
		if($pregunta_seguridad->verificar_respuesta()==0){
			return false;
		}
	}
	return true;
	
}

?>
