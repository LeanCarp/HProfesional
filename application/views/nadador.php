		<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>

		<div class="nadadorCRUD">
			<div class="">	
				<h2>Gestión de Nadadores:</h2>
				<?php echo $output; ?>
			</div>
		</div>
	</div>
</body>
</html>