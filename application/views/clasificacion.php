<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/kendo.js"></script>

<script>
var clasificados = false;

$(document).ready(function(){
        $("#selectCampeonato").change(function(){
                $('#output').empty();
                $("#output2").empty();
                clasificados = false;
        });
});

function realizarProceso()
{
    var campeonato = $('#selectCampeonato').val();

    var parametros = {
            "campeonato" : campeonato
    };

    $.ajax({
            data:  parametros,
            url:   '<?php echo base_url(); ?>clasificacion/obtenerPruebas',
            type:  'post',
            success:  function (response) {
                    $("#output").html(response);
            }
    });
}

function obtenerClasificados(input)
{
    $('#output input').each(function () {
        $(this).css("background-color", "#E1E1E1");
    });

    var idPrueba = $(input).attr("id");
    $(input).css("background-color", "#3D8BCD");

    var parametros = {
            "idPrueba" : idPrueba
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

        <div class="contenedor">
                <label>Campeonatos: </label>
                <select name="selectCampeonato" id="selectCampeonato">
                <?php foreach($campeonatos->result() as $campeonato) { ?>
                <option value="<?= $campeonato->ID ?>"><?= $campeonato->nombre ?></option>
                <?php } ?>
                </select>

                <input type="button" id="obtenerPruebas" value="Obtener pruebas" onclick="realizarProceso()">
        </div>
        <div id="contenido">
                <div id="output" style="margin-top: 25px;"></div>

                <div id="output2" style="margin-top: 25px;"></div>
        </div>

                

        <button onclick="pdfExport('contenido', 'clasificacion-<?php echo date("Y-m-d"); ?>')" style="margin-top: 10px;">Exportar a PDF</button>

</div>
</body>
</html>