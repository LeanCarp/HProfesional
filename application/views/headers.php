<!DOCTYPE html>
<head>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Habilitación Profesional</title>
	<meta charset="utf-8">
	
</head>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
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

/* 	$(document).scroll(function() {
			$(".div-top").animate({
				left: '-100%'
			});
			contador = 1;
	}); */

});

</script>

<style>

.menu-bar{
	display: none;
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
		z-index: 4;
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
		    <a class="nav-link" href="#">Planificación</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="#">Usuario</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>index.php/cronometro">Cronómetro</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>index.php/asistencia">Asistencia</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>index.php/configuracion">Configuración</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>auth/logout">Salir</a>
		  </li>
		</ul>
	</div>
	<div class="row">
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
