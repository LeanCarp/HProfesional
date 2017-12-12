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

/* $( window ).resize(function() {
  if ($(window).width() > 768) {
				/* $(".div-top").animate({
					left: '0'
				});
				$(".nav-izq").animate({
					left: '0'
				});
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
});  */

</script>

<style>

.menu-bar{
	display: none;
}

#imagen{
	width: 40px;
	}

	.nav-izq-item{
		border-bottom: 1px solid rgba(255,255,255, .3);
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
		margin-top:207px;
		left: -100%;
		position: absolute;
		z-index: 4;
		width: 80%;
		height: 100%;
	}

	.nav-izq:hover{
		color: #3D8BCD;
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

	.menu-bar{
		display: flex;
		justify-content: space-between;
		background: black;
		border-bottom: 1px solid rgba(255,255,255, .3);
		color: white;
	}
		.menu-bar p{
			margin: 0;
			padding: 10px;
		}
		.menu-bar a{
			margin: 0;
			padding: 10px;
		}
		.menu-bar a:hover{
			background: #3D8BCD;
		}

	.container{
		position: relative;
		z-index: 1;
	}

	#imagen{
	width: 40px;
	height: 40px;
	display:block;
	margin-left: 5px;
	}
}
</style>
	
</head>
<body>
	<div class="menu-bar">
	<img id="imagen" src="<?= base_url(); ?>assets/imgs/iconNadador.png">
		<a href="#" class="bt-menu"><img src="<?php echo base_url(); ?>assets/imgs/menu.png" alt=""></a>
	</div>

	<div class="div-top">
		<ul class="nav nav-arriba">
		  <li class="nav-item">
		    <a class="nav-link" href="<?php echo base_url(); ?>">Inicio</a>
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
				<li class="nav-item nav-izq-item">
		    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>auth/change_password">Usuario</a>
		  	</li>
				<li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>club">Clubes</a>
			  </li>
				<li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>localidad">Localidades</a>
			  </li>
			</ul>
		</div>
		<div class="col-md-9 contenido-principal">