<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/headersStyles.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<title>Habilitación Profesional</title>
	<meta charset="utf-8">
</head>
<body>
<script>

desplegado = false;
function ocultarMenu(){
    if (desplegado)
    {
        $(".naveg-arriba").animate({left: '-100%'});
        $(".naveg-izquierda").animate({left: '-100%'});
        desplegado = false;
    }
    else
    {
        $(".naveg-arriba").animate({left: '0'});
        $(".naveg-izquierda").animate({left: '0'});
        desplegado = true;
    }
}

$(window).resize(function(){
        if ($( window ).width() >= 800 && desplegado == false)
        {
            $(".naveg-arriba").css("left", "0");
            $(".naveg-izquierda").css("left", "0");
            desplegado = true;
        }
        else if ($( window ).width() < 800 && desplegado == true)
        {
            $(".naveg-arriba").animate({left: '-100%'});
            $(".naveg-izquierda").animate({left: '-100%'});
            desplegado = false;
        }
});

</script>

    <div class="nav-movil">
        <p>Menú</p>
		<a href="#" class="bt-menu" onclick="ocultarMenu()"><☼></a>
	</div>

    <div class="naveg-arriba">
        <ul class="nav-arriba-lista">
            <li class="">
                <a href="<?php echo base_url(); ?>">Inicio</a>
            </li>
            <li class="">
                <a href="<?php echo base_url(); ?>cronometro">Cronómetro</a>
            </li>
            <li class="">
                <a href="<?php echo base_url(); ?>asistencia">Asistencia</a>
            </li>
            <li class="">
                <a href="<?php echo base_url(); ?>configuracion">Configuración</a>
            </li>
            <li class="">
                <a href="<?php echo base_url(); ?>auth/logout">Salir</a>
            </li>
        </ul>
    </div>
    <div class="contenedor">
        <div class="col-md-3 naveg-izquierda">
            <ul class="nav-izquierda-lista">
                <li class="">
                    <a href="<?php echo base_url(); ?>categoria">Categorías</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>estilo">Estilo</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>tamanoPileta">Tamaño de pileta</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>distancia">Distancia</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>tipoEntrenamiento">Tipo de entrenamiento</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>tipoCampeonato">Tipo de campeonato</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>auth/change_password">Usuario</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>club">Clubes</a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>localidad">Localidades</a>
                </li>                
            </ul>
        </div>      
        <div class="col-md-9 contenido">
            
<!--         </div>
    </div>
</body>
</html> -->