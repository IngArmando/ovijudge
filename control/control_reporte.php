<?php
	if($_GET["reporte"]){
	$nombre_reporte=$_GET["reporte"];
	require_once("reporte/".$nombre_reporte.".php");
	}
	?>