		<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>

		<div class="">
			<h2>Gestión de Categorías:</h2>
			<div class="">	
				<?php echo $output; ?>
			</div>
		</div>
	</div>
</body>
</html>