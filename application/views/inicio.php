		<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>

		<div class="datos-profesor">
				<h2>Mis datos:</h2>
				<div class="datos-profesor-item">
					<h6>PROFESOR, Profesor</h6>
					<h6>CLUB, Localidad</h6>
					<h6>Nadadores activos: XX</h6>
				</div>
		</div>
<!-- 		<div class="prox-eventos">
			<h2>Próximos eventos:</h2>
			<div class="">	
				<?php echo $output; ?>
			</div>
		</div> -->
		<div id="calendario"></div>
	</div>

</body>
</html>