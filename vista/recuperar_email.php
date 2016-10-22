<form method="POST" autocomplete="off">
	<div class="panel panel-default">
		<div class="panel-heading">
			Recuperar clave
		</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
					<label>Ingrese el correo electronico que uso al registrarse</label>
					<input required <?php if($_SESSION['activar']['solo_lectura_correo']) echo 'readonly'; ?> type="email" name="correo" class="form-control" value="<?php echo $correo;?>">
					</div>

				</div>
					<?php 
					if($cantidad_preguntas_mostrar>0){
						echo '
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								Para continuar responda las siguientes preguntas de seguridad:
							</div>
						</div>'.preguntas($cantidad_preguntas_mostrar,$preguntas);
						echo btn_recuperar();
					}else{
						echo btn_siguiente();
					}
					?>
			</div>
		</div>
	</div>
</form>

<?php
	function btn_recuperar(){
			echo '
				<div class="row"><div class="col-md-6 col-md-offset-3" style="text-align:center"><br>
						<button type="submit" name="evento" value="recuperar" class="btn btn-default btn-lg">Recuperar</button>
					</div>
					</div>
					';
	}
	function btn_siguiente(){
			echo '
			<div class="row">
				<div class="col-md-6 col-md-offset-3" style="text-align:center"><br>
						<button type="submit" name="evento" value="preguntas" class="btn btn-default btn-lg">Siguiente</button>
					</div>
			</div>
		';
	}
	function preguntas($cant,$preguntas){
		if($cant>count($preguntas))
			$cant=count($preguntas);
			
		$pre_aleatorio=array_rand($preguntas,$cant);
		foreach($pre_aleatorio as $i){
			$salida.=$preguntas[$i];
			}
		return $salida;
	}
$_SESSION['activar']['solo_lectura_correo']=false;
?>
