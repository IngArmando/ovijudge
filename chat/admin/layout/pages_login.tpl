<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr"> 
<head profile="http://gmpg.org/xfn/11"> 
 
	<title>Administrar Chat</title> 

	<link rel="stylesheet" type="text/css" href="includes/css/login-style.css"> 
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="includes/js/scripts.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			var emitter;
			$('#logo').animate({ 'marginLeft':'0%'}, 500, function () {
				emitter = new particle_emitter({
					image: ['./images/particle.gif'],
					center: ['50%', '140px'], offset: [-250, 0], radius: 0,
					size: 2, velocity: 100, decay: 1000, rate: 20
				}).start();
			});
			$('.fwdbutton').click(function() {
				emitter.stop();
				$('#logo').animate({ 'marginLeft':'-200%'}, 500, function () {
					document.forms['login'].submit();
				});
				
			});
			$(document).keypress(function(e) {
				if(e.keyCode == 13) {
					emitter.stop();
					$('#logo').animate({ 'marginLeft':'-200%'}, 500, function () {
						document.forms['login'].submit();
					});
				}
			});
			$('.login-form').illuminate({ 'intensity':'0.3','outGlow':'true','outerGlowSize':'30px','outerGlowColor':'#ffffff','blink':'false','color':'#ffffff'});
		});
	</script>
	
</head>
<body>
	<div style="margin: 0 auto; width: 550px; text-align: center; padding-top: 100px;">
		<div id="logo" style="margin-left: -200%; width: 521px; height: 69px;">
			<img id="logo2" src="./images/img-logo.png" alt="chat Logo" border="0" />
		</div>
		<div class="login-form">
			<form autocomplete="off" action="./" id="login" method="post"> 
				<div class="admin-panel-text">Panel para administrar el chat</div>
				<div style="clear: both;"></div>
				<div class="input-text">Usuario</div>
				<div class="input-box">
					<input class="text" id="username" name="username" value="{if !empty($username_post)}{$username_post}{/if}" type="text" />
				</div>
				<div style="clear: both;"></div>
				<div class="input-text">Clave</div>
				<div class="input-box">
					<input class="text" name="password" value="{if !empty($password_post)}{$password_post}{/if}"  type="password" />
					<input type="hidden" name="login" value="1" />
				</div>
				<div style="clear: both;"></div>
				<div class="button_container float">
					<div class="login-error">
						{$error}
					</div>
					<div class="floatr">
						<a class="fwdbutton">
							<span>Acceder</span>
						</a>
					</div>
					<div class="forgot">
						<a href="#" class="vtip" title="La clave solo es cambiada directamente en la tabla del administrador de la base de datos.">Recuperar clave</a><span class="forgot-big">&nbsp;&nbsp;&nbsp;|</span> 
					</div>
				</div>
				<div style="clear: both;"></div>
			</form> 
		</div>
	</div>
	<script type="text/javascript">
		document.getElementById("username").focus();
	</script>
</body>
</html>
