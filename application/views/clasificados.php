<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/kendo.js"></script>

<script>

window.onload = obtenerClasificados();

function obtenerClasificados()
{
    var parametros = {
            /* "idPrueba" : idPrueba */
            "idPrueba" : <?php echo $idPrueba; ?>
    };

    $.ajax({
            data:  parametros,
            url:   '<?php echo base_url(); ?>clasificacion/obtenerClasificados',
            type:  'post',
            success:  function (response) {
                    $("#output2").html(response);
            }
    });

    clasificados = true;
}

function pdfExport(idName,fileName){ 
         if (clasificados)
         {
            kendo.drawing.drawDOM($('#'+idName)).then(function (group) {
                kendo.drawing.pdf.saveAs(group,fileName+'.pdf');
            });
         } 
         else
         {
             alert ("Debe realizar una consulta antes de exportar.");
         }
        
}
</script>

<style>
.li-contenido
{
	display: flex;
	justify-content: space-between;
}

.li-contenido p{
        margin: 0;
        padding: 0;
        font-weight: bold;
}

.nombres{
        background: #d6d5d5;
}

@media screen and (max-width:800px){
#output2 .li-contenido{
        flex-direction: column;
}
}

</style>

        <div id="contenido">
                <div id="output2" style="margin-top: 25px;"></div>
        </div>

        <button onclick="pdfExport('contenido', 'clasificacion-<?php echo date("Y-m-d"); ?>')" style="margin-top: 10px;">Exportar a PDF</button>
        <button onclick="history.back()" >Volver</button>

</div>
</body>
</html>