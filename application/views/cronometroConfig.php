        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        
        <script type="text/javascript">   
            $(document).ready(function() {                       
                $("#selectEvento").change(function() {
                    $("#selectEvento option:selected").each(function() {
                        eventoSeleccionado = $('#selectEvento').val();
                        $.post("<?php echo base_url(); ?>cronometro/llenarEventos", {
                            eventoSeleccionado : eventoSeleccionado
                        }, function(data) {
                            $("#selectEvento2").html(data);
                        });
                    });
                });
            });

            $(document).ready(function() {                       
                $("#selectEvento2").change(function() {
                    $("#selectEvento2 option:selected").each(function() {
                        eventoSeleccionado = $('#selectEvento2').val();
                        $.post("<?php echo base_url(); ?>cronometro/llenarPruebas", {
                            eventoSeleccionado : eventoSeleccionado
                        }, function(data) {
                            $("#selectPrueba").html(data);
                        });
                    });
                });
            });
        </script>  
        <div>
            <?php echo form_open("cronometro");  ?>
                <div class="selects">
                    <h4>Configuración del cronómetro:</h4>

                    <label>Seleccione: </label>
                    <select id="selectEvento" name="selectEvento">
                        <option value="0">Seleccione un evento</option>
                        <option value="1">Campeonato</option>
                        <option value="2">Entrenamiento</option>
                    </select>

                    <select id="selectEvento2" name="selectEvento2">
                       <option value="0">Seleccione entrenamiento/campeonato</option>
                    </select>

                    <select id="selectPrueba" name="selectPrueba">
                       <option value="0">Seleccione prueba</option>
                    </select>
                </div>
            <?php echo form_submit('submit', 'Aceptar', 'class="btn-primary"'); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</body>
</html>


