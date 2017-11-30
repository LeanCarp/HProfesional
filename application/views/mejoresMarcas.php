<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
function realizarProceso(){
                var estilo = $("#selectEstilo option:selected").val();
                var categoria = $("#selectCategoria option:selected").val();
		var parametros = {
				"estilo" : estilo,
				"categoria" : categoria
		};

        $.ajax({
                data:  parametros,
                url:   'mejoresMarcas/obtenerMarcas',
                type:  'post',
                success:  function (response) {
                        $("#output").html(response);
                }
        });
}

function obtenerMarcas(){
                var selectEstilo = $("#selectEstilo option:selected").val();
                var selectSexo = $("#selectSexo option:selected").val();
                var selectCategoria = $("#selectCategoria option:selected").val();
                var selectPileta = $("#selectPileta option:selected").val();
                var selectDistancia = $("#selectDistancia option:selected").val();
		var parametros = {
				"selectEstilo" : selectEstilo,
                                "selectSexo" : selectSexo,
                                "selectCategoria" : selectCategoria,
                                "selectPileta" : selectPileta,
                                "selectDistancia" : selectDistancia
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
</script>

                <!-- <select id="selectPrueba" name="selectPrueba">
                        <option value="1">Categoría</option>
                        <option value="2">Estilo</option>
                        <option value="3">Absoluto</option>
                </select> -->

                <select id="selectEstilo" name="selectEstilo">
                        <option value="0">Estilo</option>
                        <?php foreach($estilos->result() as $estilo) { ?>
                                <option value="<?= $estilo->ID ?>"><?= $estilo->Nombre ?></option>
                        <?php } ?>
                </select>                    

                <select id="selectSexo" name="selectSexo">
                        <option value="0">Sexo</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                </select>            

                <select id="selectCategoria" name="selectCategoria">
                        <option value="0">Categoría</option>
                        <?php foreach($categorias as $categoria) { ?>
                                <option value="<?= $categoria->ID ?>"><?= $categoria->Nombre ?></option>
                        <?php } ?>
                </select>

                <select id="selectPileta" name="selectPileta">
                        <option value="0">Tamaño de pileta</option>
                        <?php foreach($piletas->result() as $pileta) { ?>
                                <option value="<?= $pileta->ID ?>"><?= $pileta->Tamanio ?></option>
                        <?php } ?>
                </select>

                <select id="selectDistancia" name="selectDistancia">
                        <option value="0">Distancia</option>
                        <?php foreach($distancias->result() as $distancia) { ?>
                                <option value="<?= $distancia->ID ?>"><?= $distancia->Distancia ?></option>
                        <?php } ?>
                </select>

                <input type="button" class="btnFiltrar" id="Filtrar" value="Obtener marcas" onclick="obtenerMarcas()">

                <div id="output2" style="margin-top: 25px;"></div>
        </div>
</body>
</html>