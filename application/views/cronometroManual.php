<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>

<style>
.principal{
	margin-top: 50px;
}
</style>

		<a href="<?php echo base_url(); ?>cronometro" class="btn-primary" style="padding: 10px; text-decoration: none;"><<</a>

		<div class="principal">
			<h2>Gestión de Resultados:</h2>
			<div class="">	
				<?php echo $output; ?>
			</div>
		</div>
	</div>
</body>
</html>