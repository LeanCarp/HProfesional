<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Habilitación Profesional</title>
	<meta charset="utf-8">

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

#imagen{
	width: 40px;
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

	.nav-link: hover{
		color: #3D8BCD;
	}

	.nav-izq-link: hover{
		color: #3D8BCD;
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

	#imagen{
	width: 75px;
	height: 50px;
	display:block;
margin:auto;
	}
}
</style>
	
</head>
<body>
	<div class="menu-bar">
		<a href="#" class="bt-menu">Menú</a>
	</div>

	<div class="div-top">
		<ul class="nav nav-arriba">
			<li class="">
				<img id="imagen" src="<?= base_url(); ?>assets/wiki.png">
		  </li>
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
	<div class="container row">
		<div class="nav-izq col-md-3">
			<ul class="nav flex-column">
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>categoria">Categorías</a>
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>estilo">Estilo</a>
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>tamanoPileta">Tamaño de pileta</a>
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>distancia">Distancia</a>
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>tipoEntrenamiento">Tipo de entrenamiento</a>
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>tipoCampeonato">Tipo de campeonato</a>
			  </li>
			</ul>
		</div>
		<div class="col-md-9 contenido-principal">