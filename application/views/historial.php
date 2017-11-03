<?php foreach($css_files as $file): ?>		
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>
			
			
		<div class="nadadores" style="margin-top: 10px;">
				<label>Nadadores: </label>
				<select name="selectNadadores" id="selectNadadores">
					<?php foreach($nadadores->result() as $nadador) { ?>
						<option id="<?= $nadador->DNI ?>" value="<?= $nadador->DNI ?>"><?= $nadador->Nombre ?> <?= $nadador->Apellido ?></option>
					<?php } ?>
				</select>		
			</div>


		<div id="calendarioHistorial" style="margin-top: 20px;"></div>
	    </div>
</body>
</html>