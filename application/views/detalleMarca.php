<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/kendo.js"></script>

<script type="text/javascript">
function back()
{
    history.back();
}

function pdfExport(idName,fileName){ 
    kendo.drawing.drawDOM($('#'+idName)).then(function (group) {
        kendo.drawing.pdf.saveAs(group,fileName+'.pdf');
    });    
}
</script>
<div id="contenido">

    <h4>Nadador: <?php echo $nadador->Apellido.', '.$nadador->Nombre.' (DNI: '.$nadador->DNI.')' ?></h4>
    <h5> <?php if ($prueba->EntrenamientoID == null) {echo 'Campeonato: ';  } else { echo 'Entrenamiento: '; }
    echo $evento->nombre; ?> </h5>
    <h5> <?php echo 'Fecha inicio: '.$evento->inicio.' - Fecha fin: '.$evento->fin; ?> </h5>
    <br>
    <h6> <?php echo 'Distancia: '.$prueba->Distancia.' m'; ?> </h6>
    <h6> <?php echo 'Tamaño pileta: '.$prueba->Tamanio.' m'; ?> </h6>
    <h6> <?php echo 'Estilo: '.$prueba->Nombre; ?> </h6>
    <br>
    <h6> <?php echo 'Resultados de la fecha: '.$resultado->Fecha; ?> </h6>
    <?php foreach($parciales as $parcial) { ?>
        <li class="list-group-item"><?php echo $parcial->Tiempo; ?></li>
    <?php } ?>

</div>



<br>
<input style="margin-bottom: 10px;" type="button" value="Volver" onclick="back()">
<button onclick="pdfExport('contenido', 'detalleMarca-nad<?php echo $nadador->DNI ?>')" style="margin-top: 10px;">Exportar a PDF</button>


            
</div>
</body>
</html>