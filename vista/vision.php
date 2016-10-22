<?php
	require_once("modelo/class_informacion.php");
	$informacion = new informacion;
	$informacion->set_cod_informacion(3);
	$informacion->consultar();
	$row_informacion=$informacion->row();
	
?>

	<ol class="breadcrumb">
	  <li><a href="index.php">Inicio</a></li>
	  <li class="active">Visión</li>
	</ol>
	<h1>Visión</h1>

<?php echo $row_informacion['descripcion'] ?>

