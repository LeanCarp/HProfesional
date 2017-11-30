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
                var select = $("#selectPrueba option:selected").val();
		var parametros = {
				"select" : select
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

                <select id="selectPrueba" name="selectPrueba">
                <option value="1">Categoría</option>
                <option value="2">Estilo</option>
                <option value="3">Absoluto</option>
                </select>

                <input type="button" class="btnFiltrar" id="Filtrar" value="Obtener marcas" onclick="obtenerMarcas()">

                <div id="output2" style="margin-top: 25px;"></div>
        </div>
</body>
</html>