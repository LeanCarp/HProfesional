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

//var dataChart={"titulo":"Probando Graficas","datosParciales":[{"metros":25,"Resultado1":3.1},{"metros":50,"Resultado1":3.24},{"metros":75,"Resultado1":3.38},{"metros":100,"Resultado1":3.58}],"categoriasMetros":[{"field":"Resultado1","categoryField":"metros","name":"0-25"},{"field":"Resultado2","categoryField":"metros","name":"25-50"},{"field":"Resultado3","categoryField":"metros","name":"50-75"},{"field":"Resultado4","categoryField":"metros","name":"75-100"}]}
    var dataChart=null;

function cargarGrafica()
{
    //var distancia = document.getElementById("selectDistancia").text;
   var parciales =<?php echo json_encode($parciales); ?>;
    var fecha= '<?php echo $resultado->Fecha; ?>';
    var tamanio='<?php echo $prueba->Tamanio; ?>';

    var parametros = {
                "fecha" : fecha,
               "parciales" : parciales,
               "tamanio": tamanio
        };

    $.ajax({
                    data: parametros,
                    url: '<?php echo base_url()?>grafica/formatoParaGrafica',
                    type:  'post',
                    dataType: 'json',
                    success: function(msg) {
                        dataChart = msg;
                        //Si hay algun dato, se habilita la var que permite exportar a pdf.
                     
                            $("#chart").css("height","20em");
                            createChart();
                            $("#chart").show();
                            $("#resultados").html("");
                                            
                    }
    });
                
}

function createChart() {
        $("#chart").kendoChart({
            dataSource: {

                data: dataChart.datosParciales
            },
    
            title: {
                text: dataChart.titulo
            },
            legend: {
                position: "bottom"
            },
            chartArea: {
                background: ""
            },
            seriesDefaults: {
                type: "line",
                style: "smooth"
            },
              
            series: dataChart.categoriasMetros,
    
            valueAxis: {
                labels: {
                        format: "00"
                    },
                    line: {
                        visible: false
                    },
                    axisCrossingValue: -10
                },

            categoryAxis: {
                majorGridLines: {
                        visible: false
                    },
                labels: {
                    rotation: "auto"
                }
            },
    
            tooltip: {
                visible: true,
                template: "#= series.name  # Tiempo :  #= value #"
            }
        });
    }
</script>
<div id="contenido">

    <h4>Nadador: <?php echo $nadador->Apellido.', '.$nadador->Nombre.' (DNI: '.$nadador->DNI.')' ?></h4>
    <h5> <?php if ($prueba->EntrenamientoID == null) {echo 'Campeonato: ';  } else { echo 'Entrenamiento: '; }
         echo $evento->nombre; ?> </h5>
    <br>
    <h6> <?php echo 'Distancia: '.$prueba->Distancia.' m'; ?> </h6>
    <h6> <?php echo 'Tamaño pileta: '.$prueba->Tamanio.' m'; ?> </h6>
    <h6> <?php echo 'Estilo: '.$prueba->Nombre; ?> </h6>
    <br>
    <h6> <?php echo 'Resultado de la fecha: '.$resultado->Fecha; ?> </h6>
    <?php foreach($parciales as $parcial) { ?>
        <li class="list-group-item"><?php echo $parcial->Tiempo; ?></li>
    <?php } ?>
 

    <div class="demo-section k-content wide">
            <div id="chart"></div>
    </div>
<div id="resultados" style="margin-top: 30px; list-style: none"></div>
    

</div>



<br>
<input style="margin-bottom: 10px;" type="button" value="Volver" onclick="back()">
<button onclick="cargarGrafica()">Graficar</button> 
<button onclick="pdfExport('contenido', 'detalleMarca-nad<?php echo $nadador->DNI ?>')" style="margin-top: 10px;">Exportar a PDF</button>


            
</div>
</body>
</html>