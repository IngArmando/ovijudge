
    <!-- Carousel
    ================================================== -->
       <div class="row">
        <div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4><a href="?vista=mision" class="a-blanco">Misión</a></h4>
				</div>
			</div>
          
          
        </div>
        <div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4><a href="?vista=vision"class="a-blanco">Visión</a></h4>
				</div>
			</div>
       </div>
        <div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4><a href="?vista=resena"class="a-blanco">Historia</a></h4>
				</div>
			</div>
        </div>
      </div>
      <div class="row">
		  <div class="col-md-9">
			  <div class="row">
					<div class="col-md-12">
					<?php echo carrusel(); ?>
					</div>
				</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Noticias
						</div>
						<div class="panel-body">
							<?php echo mostrar_noticias();?>
						</div>
					</div>
				</div>
			</div>
			<?php
				echo mostrar_enlaces();
			?>			
			</div>
			<div class="col-md-3">
				<?php echo widget_twiter();?>
			</div>
			<br>
	</div>
	<br>


	</div>

   <div class="container">
         <!-- Example row of columns -->
<?php
	function mostrar_noticias(){
		require_once("modelo/class_noticia.php");
		$noticia = new noticia;
		if($noticia->listar_nuevas()>0){
	
			while($row_noticia=$noticia->row()){
				$i++;
				$titulo=$row_noticia['titulo'];
				$fecha_creacion=$row_noticia['fecha_creacion'];
				$descripcion=$row_noticia['descripcion'];
				$imagen=$row_noticia['imagen'];
				
$salida.='
<ul class="media-list" onclick="abrir_modal'.$i.'()">
  <li class="media">
    <a class="pull-left" href="#">
       '.($imagen ? '<img class="media-object" height="50px" src="images/noticia/'.$imagen.'" />' : "").'
    </a>
    <div class="media-body">
      <h4 class="media-heading"><span style="color:#aaa; font-size:12px" title="Fecha de publicación">'.$fecha_creacion.'</span> '.$titulo.'</h4>
      '.$descripcion.'
    </div>
  </li>
</ul>
<hr>

'.modal($titulo,$descripcion,$i,$imagen);
	}
		
	}else{
		$salida.='Actualmente no existen noticias.';
		}
	return $salida;		
		
}

function mostrar_enlaces(){
	$salida.='
		<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Enlaces Recomendados
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4 center">
							<a href="http://www.ovi.net.ve/" target="_blank"><img width="145" height="68" src="images/logo-smashing.png"></a>
						</div>
						<div class="col-md-4 center">
							<a href="https://icpc.baylor.edu/" target="_blank"><img width="254" height="90" src="images/logo-pixel.png" width="200"></a>
						</div>
						<div class="col-md-4 center">
							<a href="http://iutep.tec.ve/" target="_blank"><img width="209" height="65" src="images/logo-w.png"></a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>';
	return $salida;
	}
function widget_twiter(){
	        $salida.='                        <a class="twitter-timeline"  href="https://twitter.com/Mppeuct" data-widget-id="528380300162641920">Tweets por el @Mppeuct.</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          ';
            return $salida;
          
	
	}
function modal($titulo,$descripcion,$id,$imagen){
$salida.='
<div class="modal fade" id="myModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">'.$titulo.'</h4>
      </div>
      <div class="modal-body">

        '.$descripcion.'
        <div style="width:100%; text-align:center">
        '.($imagen ? ' <img style="margin: 0 auto" class="media-object" height="300px" src="images/noticia/'.$imagen.'" />' : "").'
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script>
function abrir_modal'.$id.'(){
$("#myModal'.$id.'").modal();
}

</script>
';
return $salida;

}
function carrusel(){
	$salida.='
			<div id="myCarousel" class="carousel slide" data-ride="carousel" >
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			  </ol>
			  <div class="carousel-inner">

				<div class="item active">
				  <img src="images/img1.jpg">
				  <div class="container">
					<div class="carousel-caption" style="color:#000">
</div>
				  </div>
				</div>
				<div class="item">
				  <img src="images/img2.jpg">
				  <div class="container">
					<div class="carousel-caption">

					</div>
				  </div>
				</div>
				<div class="item">
				  <img src="images/img3.jpg" >
				  <div class="container">
					<div class="carousel-caption" style="color:#000">
					</div>
				  </div>
				</div>
			  </div>
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
			  <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			</div><!-- /.carousel -->	<br>';
			return $salida;
}
?>
   
