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
</script>

		<div class="contenedor">
                        <select id="selectEstilo" name="selectEstilo">
                        <option value="0">Estilo</option>
                        <?php foreach($estilos->result() as $estilo) { ?>
                                <option value="<?= $estilo->ID ?>"><?= $estilo->Nombre ?></option>
                        <?php } ?>
                        </select>

                        <select id="selectCategoria" name="selectCategoria">
                        <option value="0">Categoría</option>
                        <?php foreach($categorias->result() as $categoria) { ?>
                                        <option value="<?= $categoria->ID ?>"><?= $categoria->Nombre ?></option>
                                <?php } ?>
                        </select>

                        <input type="button" class="btnFiltrar" id="Filtrar" value="Filtrar" onclick="realizarProceso()">
		</div>
		
		<div id="output" style="margin-top: 25px;"></div>
	</div>
</body>
</html>