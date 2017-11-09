<!DOCTYPE html>
<head>
	<script src="<?= base_url(); ?>assets/js/jquery-3.2.1.slim.min.js" ></script>
	<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Habilitación Profesional</title>
	<meta charset="utf-8">
	
</head>

<script src="<?= base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script>

$(document).ready(function () {
var contador = 1;

//function main(){
	$(".menu-bar").click(function (){
			if (contador == 1)
			{
				$(".div-top").animate({
					left: '0'
				});
				$(".nav-izq").animate({
					left: '0'
				});
				contador = 0;
			}
			else
			{
				contador = 1;
				$(".div-top").animate({
					left: '-100%'
				});
				$(".nav-izq").animate({
					left: '-100%'
				});
			}
	});

	$( window ).resize(function() {
  if ($(window).width() > 800) {
				/* $(".div-top").animate({
					left: '0'
				});
				$(".nav-izq").animate({
					left: '0'
				}); */
				$(".div-top").css({'left':'0'});
				$(".nav-izq").css({'left':'0'});
				contador = 0;
  }
  else {
				contador = 1;
				$(".div-top").animate({
					left: '-100%'
				});
				$(".nav-izq").animate({
					left: '-100%'
				});
  } 
});

});

</script>

<style>

.menu-bar{
	display: none;
}

.tamaño{
	min-height: 100vh;
}

@media screen and (max-width:800px){
	.div-top{
		left: -100%;
		position: absolute;
		z-index: 3;
		width: 80%;
	}

	.div-top ul{
		display: flex;
		flex-direction: column;
	}

	.div-top ul li{
		display: block;
		border-bottom: 1px solid rgba(255,255,255, .3);
	}

	.nav-izq{
		margin-top:297px;
		left: -100%;
		position: absolute;
		z-index: 3;
		width: 80%;
		height: 100%;
	}

	.nav-izq ul{
		display: flex;
		flex-direction: column;
	}

	.nav-izq ul li{
		display: block;
		border-bottom: 1px solid rgba(255,255,255, .3);
		background: black;
	}

	.menu-bar{
		display: block;
		width: 100%;
		background: gray;
		border-bottom: 1px solid rgba(255,255,255, .3);
	}

	.menu-bar .bt-menu{
		display: block;
		padding: 10px;
		background: black;
		text-decoration: none;
		color: white;
	}

	.container{
		position: relative;
		z-index: 1;
	}
}

@media screen and (min-width: 800px) {
    .nav-izq{
			left: 0px;
		}

		.div-top{
			left: 0px;
		}
}
</style>

<body>
	<div class="menu-bar">
		<a href="#" class="bt-menu">Menú</a>
	</div>

	<div class="div-top">
		<ul class="nav nav-arriba">
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>">Inicio</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="#">Usuario</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>cronometro">Cronómetro</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>asistencia">Asistencia</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>configuracion">Configuración</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>logout">Salir</a>
		  </li>
		</ul>
	</div>
	<div class="row tamaño">
		<div class="nav-izq col-md-3"> <!-- col-md-3 -->
			<ul class="nav flex-column">
				<li class="nav-item nav-izq-item">
					<a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>nadador">Nadadores</a>
				</li>
				<li class="nav-item nav-izq-item">
					<a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>entrenamiento">Entrenamientos</a>
				</li>
				<li class="nav-item nav-izq-item">
					<a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>campeonato">Campeonatos</a>
				</li>
				<li class="nav-item nav-izq-item">
					<a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>historial">Historial de entrenamientos</a>
				</li>
			</ul>
		</div>		
		<div class="col-md-9 contenido-principal">
