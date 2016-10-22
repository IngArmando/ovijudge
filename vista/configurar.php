<form method="post" >
	<div class="panel panel-default">
		<div class="panel-heading">
			CONFIGURACIONES DE SEGURIDAD
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<label>Tiempo de caducidad para contraseñas</label><br>
					<select required class="form-control" name="caducidad" id="caducidad" >
						<option value="30">30 Dias</option>
						<option value="60">60 Dias</option>
						<option value="90">90 Dias</option>
						<option value="120">120 Dias</option>
						<option value="190">190 Dias</option>
					</select>
					<script>
					caducidad=document.getElementById("caducidad");
					caducidad.value=<?php echo $row_configurar['caducidad']; ?>
					</script>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<label>Cant. Preguntas de seguridad para crear</label>
					<input id="pregunta_crear" min="2" required type="number" name="pregunta_crear" class="form-control" value="<?php echo $row_configurar['pregunta_crear']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<label>Cant. Preguntas de seguridad para mostrar</label>
					<input id="pregunta_mostrar" min="2" required type="number" name="pregunta_mostrar" class="form-control" value="<?php echo $row_configurar['pregunta_mostrar']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<label>Nro. de intentos fallidos</label>
					<input required type="number" min="1" name="intentos_fallidos" class="form-control"  value="<?php echo $row_configurar['intentos_fallidos']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<label>Tiempo maximo de inactividad (Min.)</label>
					<input required type="number" min="1" name="inactividad" class="form-control"  value="<?php echo $row_configurar['inactividad']; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4" style="text-align:center"><br>
					<button type="submit" name="evento" value="editar" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-floppy-disk"> </span> Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	function validar(){
		
		pregunta_crear=document.getElementById("pregunta_crear");
		pregunta_mostrar=document.getElementById("pregunta_mostrar");
		if(pregunta_crear.value<pregunta_mostrar.value){
			
			alert("La cantidad de preguntas para mostrar no puede ser mayor a la cantidad de preguntas creadas.");
			return false;
		}
	}
</script>
