
<form method="post" >
<div class="panel panel-default">
	<div class="panel-heading">
		RESETEAR CLAVE DE USUARIOS
	</div>
	<div class="row">

		<div class="col-md-4 col-md-offset-4">
			<label>
				Cédula del usuario
			</label>
						<?php
						echo mostrar_cedula();
						?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<label>
				Clave de administrador
			</label>
			<input required type="password" name="clave_administrador" class="form-control">
			
		</div>

	</div>



	<div class="row">
		<div class="col-md-6 col-md-offset-3" style="text-align:center">
<br><br>
			<button class="btn btn-default btn-lg" type="submit" name="evento" value="cambiar">RESET</button>
		</div>
	</div>
	
</div>

<?php 
function mostrar_cedula(){
	
	
					$html= '

							<div class="input-group">
								<input type="hidden" name="nacionalidad" id="nacionalidad" value="V">
									<div class="input-group-btn">
										<button style="border-top-right-radius:0px; border-bottom-right-radius:0px; border-right:0px"  type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span id="button_nacionalidad">V</span> <span class="caret"></span></button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#"  onclick="return cambiar_rif_combo_usuario(\'V\')">V </a></li>
											<li><a href="#" onclick="return cambiar_rif_combo_usuario(\'E\')">E </a></li>
										</ul>
									</div>
								<input name="cedula" required pattern="^[0-9]+$" title="Solo debe escribir numeros" type="text" placeholder="Cedula" class="form-control">
							</div>
				

				';	
	return $html;
}
