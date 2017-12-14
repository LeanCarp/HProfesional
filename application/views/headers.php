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
						$(".div-top").animate({
							left: '0'
						});
						$(".nav-izq").animate({
							left: '0'
						});
						/* $(".div-top").css({'left':'0'});
						$(".nav-izq").css({'left':'0'}); */
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

.nav-izq-item{
	border-bottom: 1px solid rgba(255,255,255, .3);
}

/* .nav-izq:hover{
	color:black;
}

.nav-link:hover{
	color: black;
} */

@media screen and (max-width:800px){
	.div-top{
		left: -100%;
		position: absolute;
		z-index: 6;
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
		margin-top:212px;
		left: -100%;
		position: absolute;
		z-index: 6;
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
	}

	.menu-bar{
		

		display: flex;
		justify-content: space-between;
		background: black;
		border-bottom: 1px solid rgba(255,255,255, .3);
		color: white;
		position: sticky; /*Fixed ya que queremos que la posición sea en relación al navegador*/
		top: 0; /*El valor 0 indica que va a quedar arriba de todo*/
		left: 0; /*Para que el menu se ubique siempre en la parte izquierda de la pantalla*/
		width: 100%; /*100% para que ocupe todo el ancho del navegador*/
		padding: 10px 5px 10px 5px; 
		z-index: 10000;    
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

	.div-top{
		background: #3D8BCD;
	}

	.nav-link:hover{
		color: black;
	}

	.nav-izq-link{
		background: #3D8BCD;
	}
}

#imagen{
	width: 40px;
	display:block;
	margin-left: 5px;
	}

</style>

<body>
	<div class="menu-bar">
	<a class="navbar-brand"  href="<?php echo base_url(); ?>">
	<img id="imagen" src="<?= base_url(); ?>assets/imgs/iconNadador.png"></a>
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
					<a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>grafica">Gráficas</a>
				</li>
				<li class="nav-item nav-izq-item">
					<a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>historial">Historial de entrenamientos</a>
				</li>
				<li class="nav-item nav-izq-item">
					<a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>mejoresMarcas">Marcas</a>
				</li>
<!-- 				<li class="nav-item nav-izq-item">
					<a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>clasificacion">Clasificación</a>
				</li> -->
			</ul>
		</div>		
		<div class="col-md-9 contenido-principal">
