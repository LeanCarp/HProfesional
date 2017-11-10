	<script type="text/javascript" src= "chart/Chart.min.js"></script>
	<script type="text/javascript" src ="chart/jquery-3.2.1.minjs"></script>

	<!--?//php echo form_open("reporteGrafico/Hacerlo");  ?-->
	<div class="selects">
		<h2>Gestión de Gráficas:</h2>
		<label>Nadador: </label>
		<select name="selectNadador">
			<?php foreach($records->result() as $row) { ?>
				<option value="<?= $row->DNI ?>"><?= $row->Nombre." " ?><?= $row->Apellido ?></option>
			<?php } ?>
		</select>
		<label>Estilo: </label>
		<select name="selectEstilo">
			<?php foreach($records1->result() as $row) { ?>
				<option value="<?= $row->ID ?>"><?= $row->Nombre?></option>
			<?php } ?>
		</select>
		<label>Tamaño Pileta: </label>
		<select name="selectTamañoPileta">
			<?php foreach($records2->result() as $row) { ?>
				<option value="<?= $row->ID ?>"><?= $row->Tamaño ?></option>
			<?php } ?>
		</select>
		<label>Distancia: </label>
		<select name="selectDistancia">
			<?php foreach($records3->result() as $row) { ?>
				<option value="<?= $row->ID ?>"><?= $row->Distancia?></option>
			<?php } ?>
		</select>
		<label>Fecha 1: </label> <input name="fecha1" type="date">
		<label>Fecha 2: </label> <input name="fecha2" type="date">

		<div style="margin-top: 20px;">
		<?php echo form_submit('submit', 'Graficar', 'class="btn-primary"'); ?>
		<!--<?php echo form_submit(['name'=> 'submit', 'value'=> 'Hacerlo']); ?>	-->
	</div>


	</div>




		
		<canvasid id="canvas" height="300" width="500"></canvas>
		<body>
			<script>



				var contexto = $("canvas").get(0).getContext("2d");
				var mychart = new Chart(contexto).Line(data);
			</script>
		</body>

		var data=  {}
        


	</div>
</body>
</html>
