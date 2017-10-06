<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Habilitación Profesional</title>
	<meta charset="utf-8">
	
</head>
<body>
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
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>entrenamiento">Entrenamientos</a>
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>nadador">Nadadores</a>
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>campeonato">Campeonatos</a>
			  </li>
			  <li class="nav-item nav-izq-item">
			    <a class="nav-link nav-izq-link" href="<?php echo base_url(); ?>prueba">Prueba</a>
			  </li>
			</ul>
		</div>
		<div class="col-md-9 contenido-principal">
