<?php
ini_set("display_errors","on");
error_reporting(E_ALL ^E_NOTICE ^E_DEPRECATED);

session_start();
$tipo			=$_GET['tipo'];
$tabla			=htmlentities($_GET['tabla']);
$campo_primario	=htmlentities($_GET['campo_primario']);
$campo_mostrar	=htmlentities($_GET['campo_mostrar']);
$sincronizado	=$_GET['sincronizado'];
if($tipo>0){
	
	require_once("../modelo/class_db.php");
	$valor='';
	$db = new db;
	$i=$db->ejecutar("SELECT COUNT(*) FROM ".$tabla);
	$resultado=$db->row()[0];
	if($i==$_SESSION['sincronizado'][$tabla]){
		echo 0;
	}else{
		$_SESSION['sincronizado'][$tabla]=$i;
		echo combo($campo_primario,$campo_mostrar,$valor,$tabla);
	}
}elseif($sincronizado!=true){
	echo mostrar_javascript();
}
	

	 function combo($name,$campo_mostrar,$valor,$tabla){
		$db = new db;
		$db->ejecutar("SELECT * FROM ".$tabla);
		$salida.=' <div class="input-group">
		
		';
		$salida.='<select required  id="'.$name.'" class="form-control" name="'.$name.'" >'; 
		$salida.='<option value="">Seleccione</option>';
        while($row_db = $db->row()){
			$salida.='<option value='.$row_db[$name];	
			if($row_db[$name]== $valor) $salida.=' selected ';									
				$salida.='>'.$row_db[$campo_mostrar].'</option>';
		 	}
        	$salida.='</select>
        	<span class="input-group-btn">
				<a class="btn btn-default" target="_blank" href="?vista='.$tabla.'&sincronizado=true&evento=nuevo">
				Nuevo
				</a>
				
        	</span>
        	</div>';
        	return $salida;
	}

function mostrar_javascript(){
	$_SESSION['sincronizado']=array();
		$salida.='
		<script>
		xmlhttp=new XMLHttpRequest();

		function mostrar(div,tabla,campo_primario,campo_mostrar,tipo){
				xmlhttp.open("GET","libreria/lemez_sincronizado.php?tipo="+tipo+"&tabla="+tabla+"&campo_primario="+campo_primario+"&campo_mostrar="+campo_mostrar,false);
				xmlhttp.send();
				respuesta=xmlhttp.responseText;
				if(respuesta!=0){
					div.innerHTML=respuesta;
				}
				
		}
		</script>
		';
		return $salida;
}
?>

