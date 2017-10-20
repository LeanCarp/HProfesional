		<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>

		<?php echo form_open("listarAsistencia/Hacerlo");  ?>
		<label>Fecha: </label> <input name="fecha" type="date">

		<label>Turno: </label>
		<select name="selectTurno">
			<option value="0">Mañana</option>
			<option value="1">Tarde</option>
		</select>

		<?php echo form_submit('submit', 'Filtrar', 'class="btn-primary"'); ?>
		<?php echo form_close(); ?>

		<div class="">
			<h2>Listar asistencia:</h2>
			<div class="">	
				<?php echo $output; ?>
			</div>
		</div>
	</div>
</body>
</html>