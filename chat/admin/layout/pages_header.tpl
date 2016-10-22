<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr"> 
<head profile="http://gmpg.org/xfn/11"> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content="-1">
	
	<title>{$title|default:"chat Administration Panel"}</title> 

	<link rel="stylesheet" type="text/css" href="includes/css/style.css" /> 
	<link rel="stylesheet" href="includes/css/menu/core.css" type="text/css" media="screen">
	<link rel="stylesheet" href="includes/css/menu/styles/sblue.css" type="text/css" media="screen">
	<link rel="stylesheet" href="includes/css/itip/itip.css" type="text/css" media="screen">
	<link rel="stylesheet" href="includes/css/itip/animate.css" type="text/css" media="screen">
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script type="text/javascript" src="includes/css/itip/modernizr.js"></script>
	<script type="text/javascript" src="includes/css/itip/itip.min.js"></script>
	
	<!--[if (gt IE 9)|!(IE)]><!-->
		<link rel="stylesheet" href="includes/css/menu/effects/slide.css" type="text/css" media="screen">
	<!--<![endif]-->

	<!-- This piece of code, makes the CSS3 effects available for IE -->
	<!--[if lte IE 9]>
		<script src="includes/js/menu.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
			$(function() {
				$("#menu").menu({ 'effect' : 'slide' });
			});
		</script>
	<![endif]-->
	
	<script type="text/javascript">
		$(document).ready(function() {
{if !empty($login_post)}
			$('#logo').animate({ 'marginLeft':'0%'}, 500, function () {});
{/if}
			$('.admin_title_bg ul li').hover(
				function () {
					if (!$(this).hasClass('active_nav') && !$(this).hasClass('navHead')) {
						$(this).animate({
							marginLeft:5
						}, 150);
					}
				},
				function () {
					if (!$(this).hasClass('active_nav') && !$(this).hasClass('navHead')) {
						$(this).animate({
							marginLeft:0
						}, 150);
					}
				}
			);
		});
	</script>
</head> 
<body>
<div id="wrapper">
	<div id="topnav">
		<div id="topnavcontent">
			<div style="float: left; padding-top:8px; padding-left:20px;">
				<img id="logo" style="{if !empty($login_post)}margin-left: -400%; {/if}width: 196px; height: 26px;" src="images/img-logo.png" height="26" width="196" border="0" alt="" />
			</div>
			<div style="float: left; position: relative; top: 17px; padding-left: 20px;">
				<a href="../../">Ir a OVIJUDGE &#187;</a>
			</div>
			<div style="float: right; padding-top:17px;">
				Bienvenido, <a href="system.php?do=adminsettings">{$admin_username}</a> | <a href="index.php?do=logout">Cerrar sesión</a>
			</div>
		</div>
	</div>
	<div id="subnavwrapper">
		<div id="subnav">
			<ul class="menu sblue" id="menu">
			  <li><a href="./">Vista</a>
				<ul>
					<li><a href="./general.php?do=embedcodes">Codigos</a></li>
					<li><a href="./general.php?do=chatfeatures">Caracteristicas generales</a></li>
					<li><a href="./general.php?do=chatsettings">Configuración general</a></li>
				</ul>
			  </li>
			  {if $smarty.const.chat_EDITION != "lite"}
			  <li><a href="./manage.php?do=appsettings">Administrar{if $applications_have_update}<span class="bubble-top">{$applications_update_count}</span>{/if}</a>
				<ul>
					<li><a href="./manage.php?do=appsettings">Aplicaciones{if $applications_have_update}<span class="bubble">{$applications_update_count}</span>{/if}</a></li>
					<li><a href="./manage.php?do=traylinks">Links de barra</a></li>
					<li><a href="./manage.php?do=chatroomsettings">Salas de chat</a></li>
					<li><a href="./manage.php?do=notificationsettings">Notificaciones</a></li>
				</ul>
			  </li>
			  {/if}
			  <li><a href="./users.php?do=manageusers">Usuarios</a>
				<ul>
					<li><a href="./users.php?do=manageusers">Administrar usuarios</a></li>
					<li><a href="./users.php?do=manageadmins">administrar Mods/Admins</a></li>
					<li><a href="./users.php?do=groups">Permisos de grupos</a></li>
					<li><a href="./users.php?do=banusernames">Banear usuarios</a></li>
					<li><a href="./users.php?do=banip">Banear dirección IP</a></li>
				</ul>
			  </li>
			  <li><a href="./general.php?do=chatstyle">Apariencia{if $themes_have_update}<span class="bubble-top">{$themes_update_count}</span>{/if}</a>
				<ul>
					<li><a href="./general.php?do=chatstyle">Configuración general</a></li>
					<li><a href="./themes.php?do=smilies">Smilies</a></li>
					<li><a href="./themes.php?do=templates">Plantillas</a></li>
					<li><a href="./themes.php?do=managethemes">Temas{if $themes_have_update}<span class="bubble">{$themes_update_count}</span>{/if}</a></li>
				</ul>
			  </li>
			  <li><a href="./system.php?do=configsettings">Sistema{if $chat_has_update}<span class="bubble-top">1</span>{/if}</a>
				<ul>
					<li><a href="./system.php?do=adminsettings">Configuración de administrador</a></li>
					<li><a href="./system.php?do=configsettings">Configuración</a></li>
					<li><a href="./system.php?do=language">Lenguajes</a></li>
					<li><a href="./system.php?do=maintenance">Mantenimiento</a></li>
					<li><a href="./system.php?do=repair">Reparar chat</a></li>
					<li><a href="./system.php?do=update">Actualizar chat{if $chat_has_update}<span class="bubble">1</span>{/if}</a></li>
				</ul>
			  </li>
			<ul>
		</div>
	</div>
	{if !$install}
	<div class="notify-msg">
		Debe eliminar inmediatamente o cambiar el nombre del directorio de instalación de chat por razones de seguridad.
	</div>
	{/if}
	{if !$write}
	<div class="notify-msg">
		Es altamente recomendable que el Chmod incluye archivo config.php / a 644 o 444 antes de usar el chat.
	</div>
	{/if}
	{if !empty($error)}
	<div class="error-msg-wrapper">
		<div class="error-msg">
			{$error}
		</div>
	</div>
	{/if}
	{if !empty($msg)}
	<div class="success-msg-wrapper">
		<div class="success-msg">
			{$msg}
		</div>
	</div>
	{/if}
	<div id="content">
		<div id="leftcontent">
				{if empty($smarty.get.do) or $smarty.get.do eq '/' or $smarty.get.do eq 'chatfeatures' or $smarty.get.do eq 'chatsettings' or $smarty.get.do eq 'delete_history' or $smarty.get.do eq 'embedcodes'}
				<div class="admin_title_bg"> 
					<ul id ="menu-general"> 
						<li class="navHead">Inicio</li>
						<li {if empty($smarty.get.do) or $smarty.get.do eq '/' or $smarty.get.do eq 'delete_history'}class="active_nav"{/if}><a href="./">Overview</a></li> 
						<li {if $smarty.get.do eq 'embedcodes'}class="active_nav"{/if}><a href="general.php?do=embedcodes">Embed Codes</a></li> 
						<li {if $smarty.get.do eq 'chatfeatures'}class="active_nav"{/if}><a href="general.php?do=chatfeatures">General Features</a></li> 
						<li {if $smarty.get.do eq 'chatsettings'}class="active_nav"{/if}><a href="general.php?do=chatsettings">General Settings</a></li> 
					</ul> 
				</div>
				{/if}
				{if $smarty.get.do eq 'appsettings' or $smarty.get.do eq 'traylinks' or $smarty.get.do eq 'traylinksedit' or $smarty.get.do eq 'chatroomsettings' or $smarty.get.do eq 'notificationsettings' or $smarty.get.do eq 'appsedit' or $smarty.get.do eq 'chatroomedit' or $smarty.get.do eq 'chatroomlogs' or $smarty.get.do eq 'notificationsedit'}
				<div class="admin_title_bg">
					<ul id ="menu-manage">
						<li class="navHead">Manage</li>
						<li {if $smarty.get.do eq 'appsettings' or $smarty.get.do eq 'appsedit'}class="active_nav"{/if}><a href="manage.php?do=appsettings">Applications{if $applications_have_update} ({$applications_update_count}){/if}</a></li> 
						<li {if $smarty.get.do eq 'traylinks' or $smarty.get.do eq 'traylinksedit'}class="active_nav"{/if}><a href="manage.php?do=traylinks">Bar Links</a></li> 
						<li {if $smarty.get.do eq 'chatroomsettings' or $smarty.get.do eq 'chatroomedit' or $smarty.get.do eq 'chatroomlogs'}class="active_nav"{/if}><a href="manage.php?do=chatroomsettings">Chat Rooms</a></li> 
						<li {if $smarty.get.do eq 'notificationsettings' or $smarty.get.do eq 'notificationsedit'}class="active_nav"{/if}><a href="manage.php?do=notificationsettings">Notifications</a></li> 
					</ul>
					{if !empty($feature_disabled)}
						<div class="feature-disabled">
							<b>{$feature_disabled} Disabled</b><br />This feature is disabled and will not display in the bar regardless of these settings.  You can enable it under general features.
						</div>
					{/if}
				</div>
				{/if}
				{if $smarty.get.do eq 'banip' or $smarty.get.do eq 'banusernames' or $smarty.get.do eq 'manageusers' or $smarty.get.do eq 'manageadmins' or $smarty.get.do eq 'logs' or $smarty.get.do eq 'view' or $smarty.get.do eq 'actions' or $smarty.get.do eq 'groups' or $smarty.get.do eq 'groupsedit'}
				<div class="admin_title_bg"> 
					<ul id ="menu-users"> 
						<li class="navHead">Users</li>
						<li {if $smarty.get.do eq 'manageusers' or $smarty.get.do eq 'logs' or $smarty.get.do eq 'view'}class="active_nav"{/if}><a href="users.php?do=manageusers">Manage Users</a></li>
						<li {if $smarty.get.do eq 'manageadmins' or $smarty.get.do eq 'actions'}class="active_nav"{/if}><a href="users.php?do=manageadmins">Manage Mods/Admins</a></li>
						<li {if $smarty.get.do eq 'groups' or $smarty.get.do eq 'groupsedit'}class="active_nav"{/if}><a href="users.php?do=groups">Group Permissions</a></li>
						<li {if $smarty.get.do eq 'banusernames'}class="active_nav"{/if}><a href="users.php?do=banusernames">Ban Usernames</a></li>
						<li {if $smarty.get.do eq 'banip'}class="active_nav"{/if}><a href="users.php?do=banip">Ban IP Addresses</a></li>
					</ul> 
				</div>
				{/if}
				{if $smarty.get.do eq 'managethemes' or $smarty.get.do eq 'smilies' or $smarty.get.do eq 'templates' or $smarty.get.do eq 'chatstyle' or $smarty.get.do eq 'install' or $smarty.get.do eq 'edit'}
				<div class="admin_title_bg"> 
					<ul id ="menu-themes"> 
						<li class="navHead">Appearance</li>
						<li {if $smarty.get.do eq 'chatstyle'}class="active_nav"{/if}><a href="general.php?do=chatstyle">General Settings</a></li> 
						<li {if $smarty.get.do eq 'smilies'}class="active_nav"{/if}><a href="themes.php?do=smilies">Smilies</a></li> 
						<li {if $smarty.get.do eq 'templates'}class="active_nav"{/if}><a href="themes.php?do=templates">Templates</a></li> 
						<li {if $smarty.get.do eq 'managethemes' or $smarty.get.do eq 'install' or $smarty.get.do eq 'edit'}class="active_nav"{/if}><a href="themes.php?do=managethemes">Themes{if $themes_have_update} ({$themes_update_count}){/if}</a></li> 
					</ul> 
				</div>
				{/if}
				{if $smarty.get.do eq 'adminsettings' or $smarty.get.do eq 'configsettings' or $smarty.get.do eq 'language' or $smarty.get.do eq 'update' or $smarty.get.do eq 'repair' or $smarty.get.do eq 'maintenance' or $smarty.get.do eq 'maintenance2' or $smarty.get.do eq 'step1' or $smarty.get.do eq 'step2' or $smarty.get.do eq 'step3' or $smarty.get.do eq 'step5'}
				<div class="admin_title_bg"> 
					<ul id ="menu-system"> 
						<li class="navHead">System</li>
						<li {if $smarty.get.do eq 'adminsettings'}class="active_nav"{/if}><a href="system.php?do=adminsettings">Admin Settings</a></li> 
						<li {if $smarty.get.do eq 'configsettings'}class="active_nav"{/if}><a href="system.php?do=configsettings">Configuration</a></li> 
						<li {if $smarty.get.do eq 'language'}class="active_nav"{/if}><a href="system.php?do=language">Languages</a></li> 
						<li {if $smarty.get.do eq 'maintenance' or $smarty.get.do eq 'maintenance2'}class="active_nav"{/if}><a href="system.php?do=maintenance">Maintenance</a></li> 
						<li {if $smarty.get.do eq 'repair'}class="active_nav"{/if}><a href="system.php?do=repair">Repair chat</a></li> 
						<li {if $smarty.get.do eq 'update' or $smarty.get.do eq 'step1' or $smarty.get.do eq 'step2' or $smarty.get.do eq 'step3' or $smarty.get.do eq 'step5'}class="active_nav"{/if}><a href="system.php?do=update">Update chat{if $chat_has_update} (1){/if}</a></li> 
					</ul> 
				</div>
				{/if}
		</div>
		<div id="rightcontent">
