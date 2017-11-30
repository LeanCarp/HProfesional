<script>
    //graficado se usa para saber si ya se graficó o no, para controlar si dejar exportar a PDF o no.
    var graficado=false;
//var dataChart={"titulo":"Probando Graficas","datosParciales":[{"metros":25,"Resultado1":3.1},{"metros":50,"Resultado1":3.24},{"metros":75,"Resultado1":3.38},{"metros":100,"Resultado1":3.58}],"categoriasMetros":[{"field":"Resultado1","categoryField":"metros","name":"0-25"},{"field":"Resultado2","categoryField":"metros","name":"25-50"},{"field":"Resultado3","categoryField":"metros","name":"50-75"},{"field":"Resultado4","categoryField":"metros","name":"75-100"}]}
    var dataChart=null;
    function cargarGrafica()
    {
        //var distancia = document.getElementById("selectDistancia").text;
        var distancia = $("#selectDistancia option:selected").val();
        var pileta = $("#selectTamañoPileta option:selected").val();
        var nadador = $("#selectNadador option:selected").val();
        var fecha1 =  $("#fecha1").val();
        var fecha2 = $("#fecha2").val();

        var parametros = {
                    "distancia" : distancia,
                    "pileta" : pileta,
                    "nadador" : nadador,
                    "fecha1" : fecha1,
                    "fecha2" : fecha2,
            };

        $.ajax({
                        data: parametros,
                        url: 'grafica/obtenerResultados',
                        type:  'post',
                        dataType: 'json',
                        success: function(msg) {
                            dataChart = msg;
                            //Si hay algun dato, se habilita la var que permite exportar a pdf.
                            if ((typeof dataChart) == 'string')
                            {
                                graficado=false;
                                $("#resultados").html(dataChart);
                                $("#chart").hide();
                            }
                            else
                            {
                                graficado=true;
                                $("#chart").show();
                                createChart();
                                $("#resultados").html("");
                                
                            }                   
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
     function pdfExport(idName,fileName){ 
         if (graficado)
         {
            kendo.drawing.drawDOM($('#'+idName)).then(function (group) {
                kendo.drawing.pdf.saveAs(group,fileName+'.pdf');
            });
         } 
         else
         {
             alert ("Debe realizar un grafico antes de exportar");
         }
        
      }

</script>

<?php foreach($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<style>
    .selects{
        display: block;
        font-size: 13px;
    }

    @media screen and (max-width:800px){
        .selects{
            display: flex;
            flex-direction: column;
        }
    }


</style>


<div class="selects">
		<h2>Gestión de Gráficas:</h2>
        <div class="selects" style="font-size: 13px;">
            <label>Nadador: </label>
            <select name="selectNadador" id="selectNadador">
                <?php foreach($nadadores as $row) { ?>
                    <option value="<?= $row->DNI ?>"><?= $row->Nombre." " ?><?= $row->Apellido ?></option>
                <?php } ?>
            </select>

            <label>Tamaño Pileta: </label>
            <select name="selectTamañoPileta" id="selectTamañoPileta">
                <?php foreach($piletas->result() as $row) { ?>
                    <option value="<?= $row->Tamanio ?>"><?= $row->Tamanio ?></option>
                <?php } ?>
            </select>
            <label>Distancia: </label>
            <select name="selectDistancia" id="selectDistancia">
                <?php foreach($distancias->result() as $row) { ?>
                    <option value="<?= $row->Distancia ?>"><?= $row->Distancia?></option>
                <?php } ?>
            </select>
            <label>Fecha 1: </label> <input id="fecha1" name="fecha1" type="date" value="<?php echo date('2010-01-01'); ?>">
            <label>Fecha 2: </label> <input id="fecha2" name="fecha2" type="date" value="<?php echo date('Y-m-d'); ?>">

            <div style="margin-top: 20px;">
            <!-- <?php echo form_submit('submit', 'Graficar', 'class="btn-primary"'); ?>
            <?php echo form_submit(['name'=> 'submit', 'value'=> 'Hacerlo']); ?>	 -->	
        </div>
        <button onclick="cargarGrafica()">Graficar</button> 


        <button onclick="pdfExport('forExportPDF', 'newFile')">Exportar a PDF</button>
    </div>

    
    <div id="forExportPDF">
        <div class="demo-section k-content wide">
            <div id="chart"></div>
        </div>
    </div>
    

 

<div id="resultados" style="margin-top: 30px; list-style: none"></div>



</div>

</body>
</html>