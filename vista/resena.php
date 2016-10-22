<?php
	require_once("modelo/class_informacion.php");
	$informacion = new informacion;
	$informacion->set_cod_informacion(1);
	$informacion->consultar();
	$row_informacion=$informacion->row();
	
?>
	<ol class="breadcrumb">
	  <li><a href="index.php">Inicio</a></li>
	  <li class="active">Reseña</li>
	</ol>
	<h1>Reseña Historica</h1>

<?php echo $row_informacion['descripcion'] ?>

