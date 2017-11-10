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
		<div>
			<label>Entrenamiento: </label>
			<select name="selectEntrenamiento">
				<?php foreach($records->result() as $row) { ?>
					<option value="<?= $row->ID ?>"><?= $row->Nombre ?></option>
				<?php } ?>
			</select>
		</div>
		<div>
			<label>Fecha: </label> <input name="fecha" type="date">
		</div>
		<div>
			<label>Turno: </label>
			<select name="selectTurno">
				<option value="1">Mañana</option>
				<option value="0">Tarde</option>
			</select>
		</div>
		</div> <!-- contenedor -->
	</div> <!-- selects -->

	<?php foreach($records2->result() as $row) { ?>
	<li class="list-group-item li-contenido"><?= $row->DNI ?> | <?= $row->Apellido ?> <?= $row->Nombre ?> <input name="checkeds[]" type="checkbox" value="<?= $row->DNI ?>"></li>
	<?php } ?>
	<div style="margin-top: 20px;">
	<input type="submit" value="Guardar" id="botonGuardar">
	<script>
		$("#botonGuardar").click(function(event){
		event.preventDefault();

		alert("A tu casa");
		console.log("a tu casa");

		$("#formAsistencia").submit();
		});
	</script>
		<!-- <?php echo form_submit('submit', 'Guardar', 'class="btn-primary"'); ?> -->
	</div>
		<?php echo form_close(); ?>
</body>
</html>