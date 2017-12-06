<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript">

function desbloquearInputs(){
        $("#selectEstilo").prop('disabled', false);
        $("#selectCategoria").prop('disabled', false);
        $("#selectSexo").prop('disabled', false);
        $("#selectPileta").prop('disabled', false);
        $("#selectDistancia").prop('disabled', false);
        $("#Filtrar").prop('disabled', false);
}

function bloquearInputs(){
        $("#selectEstilo").prop('disabled', true);
        $("#selectCategoria").prop('disabled', true);
        $("#selectSexo").prop('disabled', true);
        $("#selectPileta").prop('disabled', true);
        $("#selectDistancia").prop('disabled', true);
        $("#Filtrar").prop('disabled', true);
}

$(document).ready(function() {                       
                $("#selectListado").change(function() {
                        if ($(this).val() != 0 && $('#selectEvento').val() != 0)
                        {
                                desbloquearInputs();
                        }
                        else
                        {
                                bloquearInputs();
                        }        
                        });

                $("#selectEvento").change(function() {
                        if ($(this).val() != 0 && $('#selectListado').val() != 0)
                        {
                                desbloquearInputs();
                        }
                        else
                        {
                                bloquearInputs();
                        }        
                        });
                });

function validarObtener(){
        var selectListado = $("#selectListado option:selected").val();
        var selectEstilo = $("#selectEstilo option:selected").val();
        var selectSexo = $("#selectSexo option:selected").val();
        var selectCategoria = $("#selectCategoria option:selected").val();
        var selectPileta = $("#selectPileta option:selected").val();
        var selectDistancia = $("#selectDistancia option:selected").val();

        if ((selectEstilo != 0) && (selectSexo != 0) && (selectCategoria != 0) && (selectPileta != 0) && (selectDistancia != 0))
        {
                return true;
        }
        else
        {
                return false;
        }
}

function obtenerMarcas(){
                if (validarObtener())
                {
                        var selectListado = $("#selectListado option:selected").val();
                        var selectEstilo = $("#selectEstilo option:selected").val();
                        var selectSexo = $("#selectSexo option:selected").val();
                        var selectCategoria = $("#selectCategoria option:selected").val();
                        var selectPileta = $("#selectPileta option:selected").val();
                        var selectDistancia = $("#selectDistancia option:selected").val();
                        var selectEvento = $("#selectEvento option:selected").val();

                        var parametros = {
                                        "selectListado" : selectListado,
                                        "selectEstilo" : selectEstilo,
                                        "selectSexo" : selectSexo,
                                        "selectCategoria" : selectCategoria,
                                        "selectPileta" : selectPileta,
                                        "selectDistancia" : selectDistancia,
                                        "selectEvento" : selectEvento
                        };

                        $.ajax({
                                data:  parametros,
                                url:   'mejoresMarcas/ObtenerMarcasPor',
                                type:  'post',
                                success:  function (response) {
                                        $("#output2").html(response);
                                }
                        });
                }
                else
                {
                        alert("Debe completar todos los campos");
                }
}
</script>

<style>
.nombres{
        background: #d6d5d5;
}

.li-contenido
{
	display: flex;
	justify-content: space-between;
}

.botonDetalle{
        background: #3D8BCD;
        color: white;
        padding: 0px 15px 0px 15px;
        border-radius: 5px;
        text-decoration: none;
}

.botonDetalle:hover{
        background: #d6d5d5;
        text-decoration: none;
}
</style>

                <div style="margin-bottom: 25px;">
                <select id="selectListado" name="selectListado">
                        <option value="0">Seleccionar listado</option>
                        <option value="1">Absoluto</option>
                        <option value="2">Récord</option>
                </select>
                <select id="selectEvento" name="selectEvento">
                        <option value="0">Seleccionar evento</option>
                        <option value="1">Entrenamiento</option>
                        <option value="2">Campeonato</option>
                </select>
                </div>
                <select id="selectEstilo" name="selectEstilo" disabled>
                        <option value="0">Estilo</option>
                        <?php foreach($estilos->result() as $estilo) { ?>
                                <option value="<?= $estilo->ID ?>"><?= $estilo->Nombre ?></option>
                        <?php } ?>
                </select>                    

                <select id="selectSexo" name="selectSexo" disabled>
                        <option value="0">Sexo</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                        <option value="3">Indistinto</option>
                </select>            

                <select id="selectCategoria" name="selectCategoria" disabled>
                        <option value="0">Categoría</option>
                        <?php foreach($categorias as $categoria) { ?>
                                <option value="<?= $categoria->ID ?>"><?= $categoria->Nombre ?></option>
                        <?php } ?>
                </select>

                <select id="selectPileta" name="selectPileta" disabled>
                        <option value="0">Tamaño de pileta</option>
                        <?php foreach($piletas->result() as $pileta) { ?>
                                <option value="<?= $pileta->ID ?>"><?= $pileta->Tamanio ?></option>
                        <?php } ?>
                </select>

                <select id="selectDistancia" name="selectDistancia" disabled>
                        <option value="0">Distancia</option>
                        <?php foreach($distancias->result() as $distancia) { ?>
                                <option value="<?= $distancia->ID ?>"><?= $distancia->Distancia ?></option>
                        <?php } ?>
                </select>

                <input type="button" class="btnFiltrar" id="Filtrar" value="Obtener marcas" onclick="obtenerMarcas()" disabled>

                <div id="output2" style="margin-top: 25px;">
                 <p>Seleccione un listado y luego cargue los valores por los que desea filtrar las Marcas.</p>
                </div>
        </div>
</body>
</html>