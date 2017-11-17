<?php foreach($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div id="example">
<div class="demo-section k-content wide">
    <div id="chart"  style="background: center no-repeat url('../content/shared/styles/world-map.png');"></div>
</div>
<button onclick="cargarGrafica()"> "Graficar" </button> 

<script>

//var dataChart={"titulo":"Probando Graficas","datosParciales":[{"metros":25,"Resultado1":3.1},{"metros":50,"Resultado1":3.24},{"metros":75,"Resultado1":3.38},{"metros":100,"Resultado1":3.58}],"categoriasMetros":[{"field":"Resultado1","categoryField":"metros","name":"0-25"},{"field":"Resultado2","categoryField":"metros","name":"25-50"},{"field":"Resultado3","categoryField":"metros","name":"50-75"},{"field":"Resultado4","categoryField":"metros","name":"75-100"}]}
var dataChart=null;
function cargarGrafica()
{
    $.ajax({
                    url: 'grafica/obtenerResultados',
                    dataType: 'json',
                    data: {
                    // our hypothetical feed requires UNIX timestamps
                    },
                    success: function(msg) {
                         dataChart = msg;
                         createChart();
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
</div>

</body>
</html>