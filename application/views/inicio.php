		<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>

		<div class="datos-profesor">
				<h2>Mis datos:</h2>
				<div class="datos-profesor-item">
					<h6>Cuba, Juan Pablo</h6>
					<h6>Club Neptunia, Gualeguaychú</h6>
					<h6>Nadadores activos:  <?php echo $activos ?> </h6>
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
</div>
</body>
</html>