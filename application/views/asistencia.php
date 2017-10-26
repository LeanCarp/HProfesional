<style type="text/css">
.selects{
	margin-bottom: 20px;
}

.li-contenido
{
	display: flex;
	justify-content: space-between;
}

</style>
	<a style="padding:5px;" class="btn-primary" href="<?php echo base_url(); ?>listarAsistencia">Listar asistencia</a>
	
	<?php echo form_open("asistencia/Hacerlo");  ?>
	<div class="selects">
		<h2>Gestión de Asistencias:</h2>

		<label>Entrenamiento: </label>
		<select name="selectEntrenamiento">
			<?php foreach($records->result() as $row) { ?>
				<option value="<?= $row->ID ?>"><?= $row->Nombre ?></option>
			<?php } ?>
		</select>

		<label>Fecha: </label> <input name="fecha" type="date">

		<label>Turno: </label>
		<select name="selectTurno">
			<option value="1">Mañana</option>
			<option value="0">Tarde</option>
		</select>
	</div>

	<?php foreach($records2->result() as $row) { ?>
	<li class="list-group-item li-contenido"><?= $row->DNI ?> | <?= $row->Apellido ?> <?= $row->Nombre ?> <input name="checkeds[]" type="checkbox" value="<?= $row->DNI ?>"></li>
	<?php } ?>
	<div style="margin-top: 20px;">
		<?php echo form_submit('submit', 'Guardar', 'class="btn-primary"'); ?>
		<!--<?php echo form_submit(['name'=> 'submit', 'value'=> 'Hacerlo']); ?>	-->
	</div>
		<?php echo form_close(); ?>
</body>
</html>