<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<style type="text/css">
.selects{
	margin-bottom: 20px;
}

.li-contenido
{
	display: flex;
	justify-content: space-between;
}

.contenedor{
	display: flex;
}

@media screen and (max-width:800px){
.contenedor{
	flex-direction: column;
	font-size: 15px;
}
}

</style>

	<a style="padding:5px;" class="btn-primary" href="<?php echo base_url(); ?>listarAsistencia">Listar asistencia</a>
	
	<?php echo form_open("asistencia/Hacerlo", 'id="formAsistencia"');  ?>
	<div class="selects" style="margin-top: 25px;">
		<h2>Gestión de Asistencias:</h2>

		<div class="contenedor">
	<!--	<div>
			<label>Entrenamiento: </label>
			<select name="selectEntrenamiento">
				<?php foreach($entrenamientos->result() as $entrenamiento) { ?>
					<option value="<?= $entrenamiento->ID ?>"><?= $entrenamiento->nombre ?></option>
				<?php } ?>
			</select>
		</div>-->
		<div>
			<label>Fecha: </label> <input id="fecha" name="fecha" type="date" value="<?php echo date("Y-m-d");?>">
		</div>
		<div>
			<label>Turno: </label>
			<select id="selectTurno" name="selectTurno">
				<option value="1">Mañana</option>
				<option value="0">Tarde</option>
			</select>
		</div>
		</div> <!-- contenedor -->
	</div> <!-- selects -->

<script>
	function seleccionarTodos()
	{
		if ($("#checkAll").prop('checked') )
		{
			$("#listaNadadores li input").each(
			function () {
			$(this).prop('checked', true);
			});
		}
		else
		{
			$("#listaNadadores li input").each(
			function () {
			$(this).prop('checked', false);
			});
		}
	}

</script>
	<div style="display: flex; flex-direction: column; align-items: right;">
		<div><label> Seleccionar todos: </label> <input type="checkbox" id="checkAll" onclick="seleccionarTodos()"></div>
	</div>

	<div id="listaNadadores">
		<?php foreach($nadadores as $nadador) { ?>
		<li class="list-group-item li-contenido"><?= $nadador->DNI ?> | <?= $nadador->Apellido ?> <?= $nadador->Nombre ?> <input name="checkeds[]" type="checkbox" value="<?= $nadador->DNI ?>"></li>
		<?php } ?>
	</div>

	<div style="margin-top: 20px;">
	<input type="submit" value="Guardar" id="botonGuardar">

	<script> /* Script que controla los datos antes de hacer un Submit */
		function validarAsistencia()
		{
			var nadadores = [];
			$('#listaNadadores input:checked').each(function () {
				nadadores.push($(this).val());
			});
			var turno = $("#selectTurno option:selected").val();
			var fecha = $("#fecha").val();

			var parametros = {
					"turno" : turno,
					"fecha" : fecha,
					"nadadores" : nadadores
			};

			$.ajax({
					data:  parametros,
					url:   '<?php echo base_url(); ?>asistencia/validarAsistencia',
					type:  'post',
					dataType: 'json',
					success:  function (data) {
						if (data.valido == 'true')
						{
							alert("Ya se registró asistencia para esa fecha");
						}
						else
						{
							$("#formAsistencia").submit(); 
						}
					}
			});
		}


		$("#botonGuardar").click(function(event){
			event.preventDefault();

			var validar = false;
			$("#listaNadadores li input").each(
			function () {
				if( $(this).prop('checked') ) {
					validar = true;
				}
			});

			if ($("#fecha").val() == "")
			{
				validar = false;
			}

			if (validar)
			{
				validarAsistencia();
			}
			else
			{
				alert("Datos incorrectos o selección vacía");
			}

		});
	</script>

	</div>
		<?php echo form_close(); ?>
</body>
</html>